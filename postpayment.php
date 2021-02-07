<?php 
	 session_start();
	 session_save_path("./"); //path on your server where you are storing session
	//file which has required functions
	require("functions.php");	
 ?>
<html>
<head><title>Post Payment</title></head>
<body bgcolor="white">
<font size=4>

<?php
	if($_POST['pay_status']=="Successful"){
		$merTxnId= $_POST['mer_txnid']; 
	}
	$curl_handle=curl_init();
	curl_setopt($curl_handle,CURLOPT_URL,"https://sandbox.aamarpay.com/api/v1/trxcheck/request.php?request_id=$merTxnId&store_id=aamarpay&signature_key=28c78bb1f45112f5d40b956fe104645a &type=json");

	curl_setopt($curl_handle, CURLOPT_VERBOSE, true);
	curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
	$buffer = curl_exec($curl_handle);
	curl_close($curl_handle);
	$a = (array)json_decode($buffer);

	$key = "C9rYiQd98eTmUBcdMxRvMVkHFEtGjer3"; //replace ur 32 bit secure key , Get your secure key from your Reseller Control panel

	$transId = $a['opt_a'];		 //Pass the same transid which was passsed to your Gateway URL at the beginning of the transaction.
	//Call data from database in the payment table
	define('DB_SERVER','localhost');
	define('DB_USER','bitbirdc_resellerclub');
	define('DB_PASS' ,')Z&,=!Ihve7R');
	define('DB_NAME', 'bitbirdc_resellerclub_db');
	$connection = mysqli_connect( DB_SERVER, DB_USER, DB_PASS, DB_NAME );
	if (!$connection) {
		echo "Cannot connect to database";
		throw new Exception( "Cannot connect to database" );
	}else {
		if($transId){
			$query = "SELECT * FROM `payment` WHERE `tran_id` = '{$transId}'";
			$result = mysqli_query($connection,$query);
            if(mysqli_num_rows($result)>0){
				$data = mysqli_fetch_assoc($result);
				$redirectUrl = $data['redirecturl'];
				$sellingCurrencyAmount = $data['sellingCurrencyAmount'];
				$accountingCurrencyAmount = $data['accountingCurrencyAmount'];
			}
		}
	}

	// $redirectUrl = $a['opt_b'];  // redirectUrl received from foundation
	// // $transId = $a['opt_a'];		 //Pass the same transid which was passsed to your Gateway URL at the beginning of the transaction.
	// $sellingCurrencyAmount = $a['amount'];
	// $accountingCurrencyAmount = $a['opt_c'];

	if($a['pay_status'] = "Successful"){
		$status = "Y";
	}else{
		$status = "N";
	}
		
	// Transaction status received from your Payment Gateway
	//This can be either 'Y' or 'N'. A 'Y' signifies that the Transaction went through SUCCESSFULLY and that the amount has been collected.
	//An 'N' on the other hand, signifies that the Transaction FAILED.

	/**HERE YOU HAVE TO VERIFY THAT THE STATUS PASSED FROM YOUR PAYMENT GATEWAY IS VALID.
	* And it has not been tampered with. The data has not been changed since it can * easily be done with HTTP request. 
	*
	**/
	
	srand((double)microtime()*1000000);
	$rkey = rand();


	$checksum =generateChecksum($transId,$sellingCurrencyAmount,$accountingCurrencyAmount,$status, $rkey,$key);

	echo "File: postpayment.php<br>";
	echo "redirecturl: ".$redirectUrl."<br>";
	echo "List of Variables to send back<br>";
	echo "transid : ".$transId."<br>";
	echo "status : ".$status."<br>";
	echo "rkey : ".$rkey."<br>";
	echo "checksum : ".$checksum."<br><br>";
	
	// db file after payment  
	include('postpayment_dbfile.php');

?>
	<form name="f1" action="<?php echo $redirectUrl;?>">
		<input type="hidden" name="transid" value="<?php echo $transId;?>">
		<input type="hidden" name="status" value="<?php echo $status;?>">
		<input type="hidden" name="rkey" value="<?php echo $rkey;?>">
		<input type="hidden" name="checksum" value="<?php echo $checksum;?>">
		<input type="hidden" name="sellingamount" value="<?php echo $sellingCurrencyAmount;?>">
		<input type="hidden" name="accountingamount" value="<?php echo $accountingCurrencyAmount;?>">
		<input type="submit" value="Click here to Continue"><BR>
	</form>
	
	<script>
		var form = $('<form name="f1" action="<?php echo $redirectUrl;?>">' +
			'<input type="hidden" name="transid" value="<?php echo $transId;?>">' +
			'<input type="hidden" name="status" value="<?php echo $status;?>">' +
			'<input type="hidden" name="rkey" value="<?php echo $rkey;?>">' +
			'<input type="hidden" name="checksum" value="<?php echo $checksum;?>">' +
			'<input type="hidden" name="sellingamount" value="<?php echo $sellingCurrencyAmount;?>">' +
			'<input type="hidden" name="accountingamount" value="<?php echo $accountingCurrencyAmount;?>">' +
			'</form>');
		$('body').append(form);
		$(form).submit();
		window.location.href = "<?php echo $redirectUrl ?>";
	</script>
</font>
</body>
</html>