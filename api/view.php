<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</head>
<title>FlySpaces Food Delivery</title>
<body>
	<div class="row col-sm-12">
		<h1>View Order</h1>
	</div>
	<div>
		<form id="order" action="/flyspaces/api/index.php/orderlist" method="POST">
		<?php 

			$id = $_GET['id'];

			$url = $_SERVER['HTTP_HOST'].'/flyspaces/api/index.php/orderlist/'.$id;
					
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
			$data = json_decode($response);
			$option = json_decode($data->orders);

		?>
		<div class="col-sm-2 text-right">
			<label for="name">Full Name
			<input type="text" name="name" value="<?php echo $data->name; ?>" disabled></label>
		</div>
		<div class="col-sm-2 text-right">
			<label for="email">Email
			<input type="text" name="email" value="<?php echo $data->email; ?>" disabled></label>
		</div>


		<div class="col-sm-12 row">
			<div class="form-group col-sm-2">
				 <label for="bread">Bread:</label>
				 <select class="form-control" disabled name="bread" >
				    <?php	
						echo '<option value="'.$option->bread.'" selected>'.$option->bread.'</option>';
					?>
				</select>
			</div>

			<div class="form-group col-sm-2">
				 <label for="bread">Sauce:</label>
				 <select class="form-control" disabled name="sauce">
				    <?php	
						echo '<option value="'.$option->sauce.'" selected>'.$option->sauce.'</option>';
					?>
				</select>
			</div>

			<div class="form-group col-sm-2">
				 <label for="bread">Sandwich Type:</label>
				 <select class="form-control" disabled name="sandwichType">
				    <?php	
						echo '<option value="'.$option->sandwichType.'" selected>'.$option->sandwichType.'</option>';
					?>
				</select>
			</div>
		</div>
		<div class="col-sm-12 row">
			<div class="form-group col-sm-2">
				 <label for="bread">Cheese:</label>
				 <select class="form-control" disabled name="cheese">
				    <?php	
						echo '<option value="'.$option->cheese.'" selected>'.$option->cheese.'</option>';
					?>
				</select>
			</div>

			<div class="form-group col-sm-2">
				 <label for="bread">Veggies:</label>
				 <select class="form-control" disabled name="veggies">
				    <?php	
						echo '<option value="'.$option->veggies.'" selected>'.$option->veggies.'</option>';
					?>
				</select>
			</div>
		</div>
	</form>
	<div class="col-sm-12">
		<a href="/FlySpaces">Back</button>
	</div>
	</div>

</body>			
</html>