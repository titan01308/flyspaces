<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</head>
<title>FlySpaces Food Delivery</title>
<body>

	<div class="col-sm-12" style="margin-bottom: 10px;">
		<h1>Order List</h1>
		<a href="/flyspaces/create.php">Create Order</a>
	</div>

	<div class="col-sm-12 text-center">
		<table class="table">
		    <thead>
		      <tr>
		        <th>ID</th>
		        <th>Full Name</th>
		        <th>Email</th>
		        <th>Options</th>
		      </tr>
		    </thead>
		    <tbody>
		     	<?php

					$url = $_SERVER['HTTP_HOST'].'/flyspaces/api/index.php/orderlist';
		
					$client = curl_init();
					$options = [ 
						CURLOPT_URL				=> $url, 
					    CURLOPT_CUSTOMREQUEST 	=> "GET",
					    CURLOPT_RETURNTRANSFER	=> true,
				    ];
					curl_setopt_array( $client, $options );
					$response = curl_exec($client);
					$httpCode = curl_getinfo($client, CURLINFO_HTTP_CODE);
					curl_close($client);
					$result = null;

					if($httpCode == '200') {
						$data = json_decode($response);

						foreach($data as $key => $val) {
							echo '<tr>';
							echo '<td>'.$val->id.'</td>';
							echo '<td>'.$val->name.'</td>';
							echo '<td>'.$val->email.'</td>';
							echo '<td>
								<a href="/flyspaces/api/view.php/?id='.$val->id.'">View</a>
								<a href="/flyspaces/edit.php/?id='.$val->id.'">Edit</a>
								<a href="/flyspaces/api/delete.php/?id='.$val->id.'">Delete</a>
							</td>';

						
							echo '</tr>';
						}
					} else {
						echo '<tr>';
						echo 'No Order Found!';
						echo '</tr>';	
					}

				?>
		    </tbody> 
	  	</table>
	</div>	
</body>
</html>