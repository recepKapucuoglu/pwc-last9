<?php
	require_once("inc.php");
	$getdata = http_build_query(
			array('code' => 'Test 123')
		);
		
		$opts = array('http' =>
		 array(
			'method'  => 'POST',
			'content' => $getdata
		)
		);

			$context  = stream_context_create($opts);
		

		$body = @file_get_contents('http://okul.pwc.com.tr/dosyalar/dahili/template/sifre_sifirlama.php?', false, $context);
		
		var_dump($body);
?>
