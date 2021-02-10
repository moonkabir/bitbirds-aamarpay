<?php
define('DB_SERVER','localhost');
define('DB_USER','bitbirdc_resellerclub');
define('DB_PASS' ,')Z&,=!Ihve7R');
define('DB_NAME', 'bitbirdc_resellerclub_db');
$connection = mysqli_connect( DB_SERVER, DB_USER, DB_PASS, DB_NAME );
if (!$connection) {
    echo "Cannot connect to database";
    throw new Exception( "Cannot connect to database" );
}else {
    $tran_id = $a['pg_txnid']??'';
    $mer_txnid = $a['mer_txnid']??'null';
    $amount = $a['amount']??'';
    $cus_name = $a['cus_name']??'';
    $cus_email = $a['cus_email']??'';
    $cus_add1 = $a['opt_a']??'';
    $cus_city = $a['opt_c']??'';
    $tran_id_reseller = $a['opt_d']??'';
    $redirectUrl = $a['opt_b']??'';
    $cus_phone = $a['cus_phone']??'';
    $desc = $a['desc']??'';
    $pay_status = $a['pay_status']??'';
    $status_code = $a['status_code']??'';
    $cardnumber = $a['cardnumber']??'';
    $approval_code = $a['approval_code']??'';
    $payment_processor = $a['payment_processor']??'';
    $bank_trxid = $a['bank_trxid']??'';
    $payment_type = $a['payment_type']??'';
    $error_code = $a['error_code']??'';
    $date_processed = $a['date_processed']??'';
    $rec_amount = $a['rec_amount']??'';
    $processing_charge = $a['processing_charge']??'';
    $ip = $a['ip']??'';
    $verify_status = $a['verify_status']??'';

    // if($tran_id && $mer_txnid && $amount && $cus_name && $cus_email && $cus_add1 && $cus_city && $tran_id_reseller && $redirectUrl && $cus_phone && $desc && $pay_status && $status_code && $cardnumber && $approval_code && $payment_processor && $bank_trxid && $payment_type && $error_code && $date_processed && $processing_charge && $ip && $verify_status){
        $query = "INSERT INTO `post_payment`(`tran_id`, `mer_txnid`, `amount`, `cus_name`, `cus_email`, `cus_add1`, `cus_city`, `tran_id_reseller`, `redirectUrl`, `cus_phone`, `description`, `pay_status`, `status_code`, `cardnumber`, `approval_code`, `payment_processor`, `bank_trxid`, `payment_type`, `error_code`, `date_processed`, `rec_amount`, `processing_charge`, `ip`, `verify_status`) VALUES ('{$tran_id}','{$mer_txnid}','{$amount}','{$cus_name}','{$cus_email}','{$cus_add1}','{$cus_city}','{$tran_id_reseller}','{$redirectUrl}','{$cus_phone}','{$desc}','{$pay_status}','{$status_code}','{$cardnumber}','{$approval_code}','{$payment_processor}','{$bank_trxid}','{$payment_type}','{$error_code}','{$date_processed}','{$rec_amount}','{$processing_charge}','{$ip}','{$verify_status}')";
        // echo "<pre>Debug: $query</pre>\n";
        mysqli_query($connection, $query);
        // $result = mysqli_query($connection, $query);
        // if ( false===$result ) {
        //     printf("error: %s\n", mysqli_error($connection));
        // }
        // else {
        //     echo 'done.';
        // }
    // }else{
    //     echo "Payment file missing"; 
    //     die();
    // }
}