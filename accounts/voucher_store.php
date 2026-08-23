<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "../component/connection.php";
var_dump($_POST);

// if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
//     header("Location: voucher_create.php");
//     exit;
// }

// $type_str     = $_POST['type'] ?? '';
// $voucher_date = $_POST['voucher_date'] ?? '';
// $narration    = trim($_POST['narration'] ?? '');
// $account_ids  = $_POST['account_id'] ?? [];
// $drs          = $_POST['dr'] ?? [];
// $crs          = $_POST['cr'] ?? [];
// $remarks      = $_POST['remarks'] ?? [];
// $created_by   = $_SESSION['user_id'];

// $typeMap = ['payment_vouchers' => 1, 'receive_vouchers' => 2, 'journal_vouchers' => 3];
// $voucher_type = $typeMap[$type_str] ?? null;

// $errors = [];
// if (!$voucher_type) $errors[] = "Invalid voucher type.";
// if (empty($voucher_date)) $errors[] = "Voucher date is required.";
// if (empty($narration)) $errors[] = "Narration is required.";
// if (count($account_ids) < 2) $errors[] = "A voucher needs at least 2 account lines.";

// $total_dr = 0;
// $total_cr = 0;
// $rows = [];

// foreach ($account_ids as $i => $acc_id) {
//     $dr = (float) ($drs[$i] ?? 0);
//     $cr = (float) ($crs[$i] ?? 0);
//     $remark = trim($remarks[$i] ?? '');

//     if ($dr == 0 && $cr == 0) continue;
//     if ($dr > 0 && $cr > 0) {
//         $errors[] = "A single line cannot have both Debit and Credit filled.";
//         continue;
//     }

//     $rows[] = ['account_id' => (int) $acc_id, 'dr' => $dr, 'cr' => $cr, 'remark' => $remark];
//     $total_dr += $dr;
//     $total_cr += $cr;
// }

// if (count($rows) < 2) $errors[] = "At least 2 non-empty lines are required.";
// if (round($total_dr, 2) !== round($total_cr, 2)) {
//     $errors[] = "Total Debit (" . number_format($total_dr, 2) . ") must equal Total Credit (" . number_format($total_cr, 2) . ").";
// }
// if ($total_dr == 0) $errors[] = "Voucher amount cannot be zero.";

// if (!empty($errors)) {
//     $_SESSION['error'] = implode(' ', $errors);
//     header("Location: voucher_create.php?type=$type_str");
//     exit;
// }

// $conn->begin_transaction();
// try {
//     $prefixMap = [1 => 'PAY', 2 => 'RCV', 3 => 'JRN'];
//     $prefix = $prefixMap[$voucher_type];

//     $stmt = $conn->prepare("SELECT voucher_no FROM payment_vouchers WHERE voucher_type = ? ORDER BY id DESC LIMIT 1");
//     $stmt->bind_param("i", $voucher_type);
//     $stmt->execute();
//     $last = $stmt->get_result()->fetch_assoc();
//     $nextNum = $last ? ((int) substr($last['voucher_no'], strlen($prefix) + 1) + 1) : 1;
//     $voucher_no = $prefix . '-' . str_pad($nextNum, 4, '0', STR_PAD_LEFT);

//     $stmt = $conn->prepare(
//         "INSERT INTO payment_vouchers (voucher_no, voucher_date, voucher_type, narration, created_by)
//          VALUES (?, ?, ?, ?, ?)"
//     );
//     $stmt->bind_param("ssisi", $voucher_no, $voucher_date, $voucher_type, $narration, $created_by);
//     $stmt->execute();
//     $voucher_id = $conn->insert_id;

//     $stmt = $conn->prepare(
//         "INSERT INTO payment_voucher_details (payment_voucher_id, account_head_id, debit_amount, credit_amount)
//          VALUES (?, ?, ?, ?)"
//     );
//     foreach ($rows as $r) {
//         $stmt->bind_param("iidd", $voucher_id, $r['account_id'], $r['dr'], $r['cr']);
//         $stmt->execute();
//     }

//     $conn->commit();
//     $_SESSION['success'] = "Voucher $voucher_no posted successfully.";
//     header("Location: voucher_view.php?id=$voucher_id");
//     exit;

// } catch (Exception $e) {
//     $conn->rollback();
//     $_SESSION['error'] = "Failed to post voucher: " . $e->getMessage();
//     header("Location: voucher_create.php?type=$type_str");
//     exit;
// }