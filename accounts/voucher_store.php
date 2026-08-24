<?php
require_once "../component/connection.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: {$base_url}accounts/payment_vouchers.php");
    exit;
}

// ---- 1. Collect and validate header fields ----
$voucher_type = isset($_POST['voucher_type']) ? (int) $_POST['voucher_type'] : 0;
$voucher_date = $_POST['voucher_date'] ?? '';
$narration    = trim($_POST['narration'] ?? '');
$created_by   = $_SESSION['user_id'] ?? null;

if (!in_array($voucher_type, [1, 2, 3], true)) {
    die("Invalid voucher type.");
}
if (empty($voucher_date) || empty($narration) || empty($created_by)) {
    die("Missing required fields.");
}

// ---- 2. Collect line items ----
$account_ids = $_POST['account_id'] ?? [];
$drs         = $_POST['dr'] ?? [];
$crs         = $_POST['cr'] ?? [];
$remarksArr  = $_POST['remarks'] ?? [];

if (count($account_ids) < 2) {
    die("At least 2 account lines are required.");
}
if (count($account_ids) !== count($drs) || count($account_ids) !== count($crs)) {
    die("Malformed line data.");
}

// ---- 3. Validate Dr = Cr and Dr/Cr exclusivity per line ----
$total_dr = 0;
$total_cr = 0;
$lines = [];

foreach ($account_ids as $i => $account_id) {
    $dr = isset($drs[$i]) ? (float) $drs[$i] : 0;
    $cr = isset($crs[$i]) ? (float) $crs[$i] : 0;
    $remark = trim($remarksArr[$i] ?? '');

    if ($dr > 0 && $cr > 0) {
        die("Line " . ($i + 1) . " cannot have both Debit and Credit.");
    }
    if ($dr == 0 && $cr == 0) {
        continue; // skip empty rows
    }

    $lines[] = [
        'account_id' => (int) $account_id,
        'dr' => $dr,
        'cr' => $cr,
        'remarks' => $remark
    ];

    $total_dr += $dr;
    $total_cr += $cr;
}

if (count($lines) < 2) {
    die("At least 2 valid account lines are required.");
}
if (round($total_dr, 2) !== round($total_cr, 2)) {
    die("Total Debit must equal Total Credit. Dr: $total_dr, Cr: $total_cr");
}

// ---- 4. Generate voucher number ----
$type_prefix = ['1' => 'PV', '2' => 'RV', '3' => 'JV'][$voucher_type];
$voucher_no = $type_prefix . '-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -5));

// ---- 5. Insert header + details inside a transaction ----
$crud->conn->begin_transaction();

try {
    $header_result = $crud->common_insert('payment_vouchers', [
        'voucher_no'   => $voucher_no,
        'voucher_date' => $voucher_date,
        'voucher_type' => $voucher_type,
        'narration'    => $narration,
        'created_by'   => $created_by
    ]);

    if (!$header_result['status']) {
        throw new Exception("Header insert failed: " . $header_result['message']);
    }

    $voucher_id = $header_result['data']; // insert_id

    foreach ($lines as $line) {
        $detail_result = $crud->common_insert('payment_voucher_details', [
            'payment_voucher_id' => $voucher_id,
            'account_head_id'    => $line['account_id'],
            'debit_amount'       => $line['dr'],
            'credit_amount'      => $line['cr'],
            'remarks'            => $line['remarks']
        ]);

        if (!$detail_result['status']) {
            throw new Exception("Detail insert failed: " . $detail_result['message']);
        }
    }

    $crud->conn->commit();
            $redirect_map = [
            1 => 'payment_vouchers.php',
            2 => 'receipt_vouchers.php',
            3 => 'journal_vouchers.php'
        ];
        $redirect_page = $redirect_map[$voucher_type] ?? 'payment_vouchers.php';

        header("Location: {$base_url}accounts/{$redirect_page}?success=1");
    exit;

} catch (Exception $e) {
    $crud->conn->rollback();
    die("Voucher creation failed: " . $e->getMessage());
}
