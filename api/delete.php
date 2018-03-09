<?php
		$id = $_GET['id']; 
		$url = $_SERVER['HTTP_HOST'].'/flyspaces/api/index.php/orderlist/'.$id;
		$client = curl_init();
		$options = array(
		    CURLOPT_URL				=> $url,
		    CURLOPT_CUSTOMREQUEST 	=> "DELETE", 
		    CURLOPT_RETURNTRANSFER	=> true, 
		    );
		curl_setopt_array( $client, $options );
		$response = json_decode(curl_exec($client));
		$httpCode = curl_getinfo($client, CURLINFO_HTTP_CODE);
		curl_close($client);

		if($httpCode=="200"){
			echo '<h1>'.$response->success.'</h1>';
		}else{
			echo '<h1>'.$response->error.'</h1>';
		}
		//delete
?>		
<div class="col-sm-12">
		<a href="/FlySpaces">Back</button>
	</div>

