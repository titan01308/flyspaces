<?php
		
		$url = $_SERVER['HTTP_HOST'].'/flyspaces/api/index.php/orderlist';
		$client = curl_init();
		$options = array(
		    CURLOPT_URL				=> $url, 
		    CURLOPT_CUSTOMREQUEST 	=> "POST", 
		    CURLOPT_RETURNTRANSFER	=> true, 
		    CURLOPT_POSTFIELDS 		=> $_POST,
		    );
		curl_setopt_array( $client, $options );

		$response = json_decode(curl_exec($client));

		$httpCode = curl_getinfo($client, CURLINFO_HTTP_CODE);

		curl_close($client);

		if($httpCode=="201"){ 
			echo '<h1>'.$response->success.'</h1>';
		} else { 
			echo '<h1>'.$response->error.'</h1>';
		}
?>		
<div class="col-sm-12">
		<a href="/FlySpaces">Back</button>
	</div>