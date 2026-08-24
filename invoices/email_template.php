<?php
if (!isset($invoice) || !isset($details)) {
    return;
}

$invoice_date = date('d-m-Y', strtotime($invoice->invoice_date));
$payment_method = $invoice->payment_method ?? 0;
$payment_method_name = 'N/A';
if ($payment_method == 0) {
    $payment_method_name = 'Bkash';
} elseif ($payment_method == 1) {
    $payment_method_name = 'Cash';
} elseif ($payment_method == 2) {
    $payment_method_name = 'Nagad';
} elseif ($payment_method == 3) {
    $payment_method_name = 'Card';
} elseif ($payment_method == 4) {
    $payment_method_name = 'Bank';
}

$due_amount = ($invoice->grand_total ?? 0) - ($invoice->paid_amount ?? 0);
?>
<div style="font-family: Arial, Helvetica, sans-serif; background: #f4f7fb; padding: 30px; color: #1f2937;">
    <div style="max-width: 820px; margin: 0 auto; background: #ffffff; border: 1px solid #e5e7eb; border-radius: 12px; overflow: hidden;">
        <div style="padding: 30px;">
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse;">
                <tr>
                    <td style="padding-bottom: 20px; border-bottom: 1px solid #e5e7eb;">
                        <h2 style="margin: 0; color: #1d4ed8; font-size: 28px;">Technova Training Institute</h2>
                        <p style="margin: 6px 0 0; color: #6b7280; font-size: 14px;">123, Dhaka, Bangladesh</p>
                        <p style="margin: 4px 0 0; color: #6b7280; font-size: 14px;">Phone: +880 1234 567890</p>
                    </td>
                    <td align="right" style="padding-bottom: 20px; border-bottom: 1px solid #e5e7eb;">
                        <h3 style="margin: 0 0 8px; font-size: 22px; color: #111827;">Invoice #: <span style="font-weight: bold;"><?php echo htmlspecialchars($invoice->invoice_no); ?></span></h3>
                        <p style="margin: 4px 0; color: #6b7280; font-size: 14px;">Date: <?php echo $invoice_date; ?></p>
                        <p style="margin: 4px 0; color: #6b7280; font-size: 14px;">Status: 
                            <?php
                            if ($invoice->payment_status == 0) {
                                echo '<span style="display:inline-block;padding:4px 8px;border-radius:9999px;background:#fef3c7;color:#92400e;font-weight:bold;">Pending</span>';
                            } elseif ($invoice->payment_status == 1) {
                                echo '<span style="display:inline-block;padding:4px 8px;border-radius:9999px;background:#dcfce7;color:#166534;font-weight:bold;">Paid</span>';
                            } elseif ($invoice->payment_status == 2) {
                                echo '<span style="display:inline-block;padding:4px 8px;border-radius:9999px;background:#dbeafe;color:#1d4ed8;font-weight:bold;">Partial</span>';
                            }
                            ?>
                        </p>
                    </td>
                </tr>
            </table>

            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-top: 26px; border-collapse: collapse;">
                <tr>
                    <td valign="top" width="50%" style="padding-right: 20px;">
                        <h4 style="margin: 0 0 10px; font-size: 14px; letter-spacing: 1px; color: #6b7280; text-transform: uppercase;">Bill To:</h4>
                        <h5 style="margin: 0; font-size: 22px; color: #111827; font-weight: bold;">
                            <?php echo htmlspecialchars($invoice->trainee_name ?? 'N/A'); ?>
                        </h5>
                    </td>
                    <td valign="top" width="50%" align="right" style="padding-left: 20px;">
                        <h4 style="margin: 0 0 10px; font-size: 14px; letter-spacing: 1px; color: #6b7280; text-transform: uppercase;">Payment Info:</h4>
                        <p style="margin: 4px 0; font-size: 14px; color: #374151;"><strong>Transaction ID:</strong> <?php echo htmlspecialchars($invoice->transaction_id ?? 'N/A'); ?></p>
                        <p style="margin: 4px 0; font-size: 14px; color: #374151;"><strong>Payment Method:</strong> <?php echo htmlspecialchars($payment_method_name); ?></p>
                    </td>
                </tr>
            </table>

            <table width="100%" cellpadding="10" cellspacing="0" border="1" bordercolor="#e5e7eb" style="margin-top: 24px; border-collapse: collapse; width: 100%;">
                <thead>
                    <tr style="background: #f3f4f6;">
                        <th style="padding: 12px; text-align: left; font-size: 13px; color: #374151;">#</th>
                        <th style="padding: 12px; text-align: left; font-size: 13px; color: #374151;">Batch</th>
                        <th style="padding: 12px; text-align: left; font-size: 13px; color: #374151;">Price</th>
                        <th style="padding: 12px; text-align: left; font-size: 13px; color: #374151;">Discount</th>
                        <th style="padding: 12px; text-align: left; font-size: 13px; color: #374151;">VAT</th>
                        <th style="padding: 12px; text-align: right; font-size: 13px; color: #374151;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($details as $detail) {
                    ?>
                    <tr>
                        <td style="padding: 12px; font-size: 13px; color: #374151; border-top: 1px solid #e5e7eb;"><?php echo $i++; ?></td>
                        <td style="padding: 12px; font-size: 13px; color: #374151; border-top: 1px solid #e5e7eb;"><?php echo htmlspecialchars($detail->batch_name ?? 'N/A'); ?></td>
                        <td style="padding: 12px; font-size: 13px; color: #374151; border-top: 1px solid #e5e7eb;">
                            <?php echo number_format((float) ($detail->price ?? 0), 2); ?>
                        </td>
                        <td style="padding: 12px; font-size: 13px; color: #374151; border-top: 1px solid #e5e7eb;">
                            <?php echo number_format((float) ($detail->discount_amount ?? 0), 2); ?>
                        </td>
                        <td style="padding: 12px; font-size: 13px; color: #374151; border-top: 1px solid #e5e7eb;">
                            <?php echo number_format((float) ($detail->vat ?? 0), 2); ?>
                        </td>
                        <td style="padding: 12px; font-size: 13px; color: #374151; border-top: 1px solid #e5e7eb; text-align: right; font-weight: bold;">
                            <?php echo number_format((float) ($detail->sub_total ?? 0), 2); ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" style="padding: 12px; text-align: right; font-size: 13px; color: #374151; font-weight: bold;">Sub Total</td>
                        <td style="padding: 12px; text-align: right; font-size: 13px; color: #374151; font-weight: bold;">
                            <?php echo number_format((float) ($invoice->sub_total ?? 0), 2); ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" style="padding: 12px; text-align: right; font-size: 13px; color: #374151; font-weight: bold;">Discount</td>
                        <td style="padding: 12px; text-align: right; font-size: 13px; color: #374151; font-weight: bold;">
                            - <?php echo number_format((float) ($invoice->discount_amount ?? 0), 2); ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" style="padding: 12px; text-align: right; font-size: 13px; color: #374151; font-weight: bold;">VAT</td>
                        <td style="padding: 12px; text-align: right; font-size: 13px; color: #374151; font-weight: bold;">
                            + <?php echo number_format((float) ($invoice->vat ?? 0), 2); ?>
                        </td>
                    </tr>
                    <tr style="background: #f9fafb;">
                        <td colspan="5" style="padding: 12px; text-align: right; font-size: 18px; color: #111827; font-weight: bold;">Grand Total</td>
                        <td style="padding: 12px; text-align: right; font-size: 18px; color: #111827; font-weight: bold;">
                            <?php echo number_format((float) ($invoice->grand_total ?? 0), 2); ?> BDT
                        </td>
                    </tr>
                </tfoot>
            </table>

            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-top: 24px; border-top: 1px solid #e5e7eb; padding-top: 20px;">
                <tr>
                    <td valign="top" width="50%" style="padding-right: 20px;">
                        <h4 style="margin: 0 0 8px; font-size: 14px; letter-spacing: 1px; color: #6b7280; text-transform: uppercase;">Notes:</h4>
                        <p style="margin: 0; font-size: 14px; color: #4b5563; line-height: 1.6;">
                            <?php echo nl2br(htmlspecialchars($invoice->notes ?? 'No notes')); ?>
                        </p>
                    </td>
                    <td valign="top" width="50%" align="right" style="padding-left: 20px;">
                        <h4 style="margin: 0 0 8px; font-size: 14px; letter-spacing: 1px; color: #6b7280; text-transform: uppercase;">Payment Summary:</h4>
                        <p style="margin: 4px 0; font-size: 14px; color: #374151;"><strong>Paid Amount:</strong> <?php echo number_format((float) ($invoice->paid_amount ?? 0), 2); ?> BDT</p>
                        <p style="margin: 4px 0; font-size: 14px; color: #374151;"><strong>Due Amount:</strong> <?php echo number_format((float) $due_amount, 2); ?> BDT</p>
                    </td>
                </tr>
            </table>

            <div style="margin-top: 30px; padding-top: 18px; border-top: 1px solid #e5e7eb; text-align: center; color: #6b7280; font-size: 14px;">
                Thank you for choosing Technova Training Institute!
            </div>
        </div>
    </div>
</div>
