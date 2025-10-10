<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make Payment - Krishnakripa Residency</title>
</head>

<body>


    <form name="razorpay-form" id="razorpay-form" action="<?php echo base_url(); ?>Payment/callback" method="POST">
        <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" />
        <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?php echo $booking['booking_id']; ?>"/>
        <input type="hidden" name="merchant_trans_id" id="merchant_trans_id" value="<?php echo date("YmdHis"); ?>"/>
        <input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id" value="<?php echo $booking['uid']; ?>"/>
        <input type="hidden" name="merchant_surl_id" id="merchant_surl_id" value="<?php echo base_url(); ?>Payment/success"/>
        <input type="hidden" name="merchant_furl_id" id="merchant_furl_id" value="<?php echo base_url(); ?>"/>
        <input type="hidden" name="card_holder_name_id" id="card_holder_name_id" value="<?= $booking['customer_first_name'] ?>"/>
        <input type="hidden" name="merchant_total" id="merchant_total" value="<?= $booking['total_amount']*100 ?>"/>
        <input type="hidden" name="merchant_amount" id="merchant_amount" value="<?= $booking['total_amount'] ?>"/>
    </form>


    <div style="display:flex;align-items:center;justify-content:center;height:100dvh">


    <p>The payment is processing..</p>


    </div>

</body>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <script>
        var options = {
            key:            "<?= config_item('rp_public') ?>",
            amount:         "<?php echo $booking['total_amount']*100; ?>",
            name:           "<?php echo $booking['customer_first_name']; ?>",
            description:    "Payment for Order <?php echo $booking['uid']; ?>",
            netbanking:     true,
            currency:       "INR", // INR
            //callback_url  : "<?php echo base_url(); ?>Ord",
            prefill: {
                name:       "<?php echo $booking['customer_first_name']; ?>",
                email:      "<?php echo $booking['customer_email'] ?? ""; ?>",
                contact:    "<?php echo $booking['customer_email']; ?>"
            },
            notes: {
                order_id: "<?php echo $booking['uid']; ?>",
            },
            handler: function (transaction) {
                document.getElementById('razorpay_payment_id').value = transaction.razorpay_payment_id;
                document.getElementById('razorpay-form').submit();
            },
            "modal": {
                "ondismiss": function(){
                    //window.location.href = "<?php echo base_url(); ?>Order/Summary";
                }
            }
        };

        instance = new Razorpay(options);

        instance.on('payment.failed', function (response){
        // redirect to fail controller
        //window.location.href = "<?php echo base_url(); ?>Order/Summary";
        });

        instance.open();

    

    </script>




</html>