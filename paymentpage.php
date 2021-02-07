<?php
	session_start();
	require("functions.php");	//file which has required functions
?>	 	
		
<html>
<head><title>Payment Page </title>
<script language="JavaScript">
        function successClicked()
        {
            document.paymentpage.submit();
        }
        function failClicked()
        {
            document.paymentpage.status.value = "N";
            document.paymentpage.submit();
        }
        function pendingClicked()
        {
            document.paymentpage.status.value = "P";
            document.paymentpage.submit();
        }
</script>
</head>
<body bgcolor="white">

<?php
		
	$key = "C9rYiQd98eTmUBcdMxRvMVkHFEtGjer3"; //replace ur 32 bit secure key , Get your secure key from your Reseller Control panel
	
	//This filter removes data that is potentially harmful for your application. It is used to strip tags and remove or encode unwanted characters.
	$_GET = filter_var_array($_GET, FILTER_SANITIZE_STRING);
	
	//Below are the  parameters which will be passed from foundation as http GET request
	$paymentTypeId = $_GET["paymenttypeid"];  //payment type id
	$transId = $_GET["transid"];			   //This refers to a unique transaction ID which we generate for each transaction
	$userId = $_GET["userid"];               //userid of the user who is trying to make the payment
	$userType = $_GET["usertype"];  		   //This refers to the type of user perofrming this transaction. The possible values are "Customer" or "Reseller"
	$transactionType = $_GET["transactiontype"];  //Type of transaction (ResellerAddFund/CustomerAddFund/ResellerPayment/CustomerPayment)
	$invoiceIds = $_GET["invoiceids"];		   //comma separated Invoice Ids, This will have a value only if the transactiontype is "ResellerPayment" or "CustomerPayment"
	$debitNoteIds = $_GET["debitnoteids"];	   //comma separated DebitNotes Ids, This will have a value only if the transactiontype is "ResellerPayment" or "CustomerPayment"
	$description = $_GET["description"];
	$sellingCurrencyAmount = $_GET["sellingcurrencyamount"]; //This refers to the amount of transaction in your Selling Currency
	$accountingCurrencyAmount = $_GET["accountingcurrencyamount"]; //This refers to the amount of transaction in your Accounting Currency
	$redirectUrl = $_GET["redirecturl"];  //This is the URL on our server, to which you need to send the user once you have finished charging him
	
	// reseller club extra code for aamarpay payment gateway 
	$name = $_GET["name"];
	$emailAddr = $_GET["emailAddr"];
	$address1 = $_GET["address1"];
	$city = $_GET["city"];
	$state = $_GET["state"];
	$country = $_GET["country"];
	$telNo = $_GET["telNo"];
	$zip = $_GET["zip"];	
	// create a random value for transaction id
	function rand_string( $length ) {
		$str="";
		$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$size = strlen( $chars );
		for( $i = 0; $i < $length; $i++) { $str .= $chars[ rand( 0, $size - 1 ) ]; }
		return $str;
	}	
	$cur_random_value=rand_string(10);	

	//checksum for validation
	$checksum = $_GET["checksum"];

	//database file all data store before payment being processing 
	include('payment_dbfile.php');

	echo "File paymentpage.php<br>";
	echo "Checksum Verification..............";

	// verify checksum then code goes
	if(verifyChecksum($paymentTypeId, $transId, $userId, $userType, $transactionType, $invoiceIds, $debitNoteIds, $description, $sellingCurrencyAmount, $accountingCurrencyAmount, $key, $checksum)){
		//YOUR CODE GOES HERE
		
		// aamarpay payment gateway required code start here 

		function redirect_to_merchant($url) {

			?>
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head><script type="text/javascript">
				function closethisasap() { document.forms["redirectpost"].submit(); } 
			</script></head>
			<body onLoad="closethisasap();">
			
				<form name="redirectpost" method="post" action="<?php echo 'https://sandbox.aamarpay.com/'.$url; ?>"></form>
			</body>
			</html>
		<?php	
			exit;
		} 
		$url = 'https://sandbox.aamarpay.com/request.php';
		$fields = array(
			'store_id' => 'aamarpay', 'amount' => $sellingCurrencyAmount, 'payment_type' => 'VISA',
			'currency' => 'BDT', 'tran_id' => "$cur_random_value",
			'cus_name' => $name, 'cus_email' => $emailAddr,
			'cus_add1' => $address1, 'cus_add2' => $address2,
			'cus_city' => $city, 'cus_state' => $state, 'cus_postcode' => $zip,
			'cus_country' => $country, 'cus_phone' => $telNo,
			'cus_fax' => 'Not¬Applicable', 'ship_name' => 'imtiaz',
			'ship_add1' => 'House B-121, Road 21', 'ship_add2' => 'Mohakhali',
			'ship_city' => 'Dhaka', 'ship_state' => 'Dhaka',
			'ship_postcode' => '1212', 'ship_country' => 'Bangladesh',
			'desc' => "test_description", 'success_url' => 'https://bitbirds.com/postpayment.php',
			'fail_url' => 'http://localhost/edu/fail.php',
			'cancel_url' => 'http://localhost/edu/cancel.php',
			'opt_a' => $transId, 'opt_b' => $redirectUrl,
			'opt_c' => $accountingCurrencyAmount, 'opt_d' => '',
			'signature_key' => '28c78bb1f45112f5d40b956fe104645a');
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		$fields_string = rtrim($fields_string, '&'); 
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_VERBOSE, true);
		curl_setopt($ch, CURLOPT_URL, $url);  
		curl_setopt($ch, CURLOPT_POST, count($fields)); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$url_forward = str_replace('"', '', stripslashes(curl_exec($ch)));	
		curl_close($ch); 

		redirect_to_merchant($url_forward);	
		
		// aamarpay payment gateway required code End
	}	
?>
</body>
</html>
