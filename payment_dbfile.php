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
    if($name && $emailAddr && $address1 && $city && $state && $country && $telNo && $zip && $cur_random_value && $checksum && $redirectUrl && $accountingCurrencyAmount && $sellingCurrencyAmount && $description && $debitNoteIds && $invoiceIds && $transactionType && $userType && $userId && $transId && $paymentTypeId ){
        $query = "INSERT INTO `payment`(`name`, `emailAddr`, `address1`, `city`, `state`, `country`, `telNo`, `zip`, `tran_id`, `checksum`, `redirecturl`, `showingamount`, `pay_amount`, `description`, `debitnoteids`, `invoiceids`, `transactiontype`, `usertype`, `userId`, `transid`, `paymenttypeid`) VALUES ('{$name}','{$emailAddr}','{$address1}','{$city}','{$state}','{$country}','{$telNo}','{$zip}','{$cur_random_value}','{$checksum}','{$redirectUrl}','{$accountingCurrencyAmount}','{$sellingCurrencyAmount}','{$description}','{$debitNoteIds}','{$invoiceIds}','{$transactionType}','{$userType}','{$userId}','{$transId}','{$paymentTypeId}')"; 
        mysqli_query($connection, $query);
    }
}