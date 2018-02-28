<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</head>
<title>FlySpaces Food Delivery</title>
<body>
	<h1>Create Order</h1>
	<div>
		<form id="order" action="/flyspaces/api/insert.php" method="POST">
		<?php 

			$options = (array)json_decode(file_get_contents('option.json'));
			

		?>
		<div class="col-sm-2 text-right">
			<label for="name">Full Name
			<input type="text" name="name"></label>
		</div>
		<div class="col-sm-2 text-right">
			<label for="email">Email
			<input type="text" name="email"></label>
		</div>


		<div class="col-sm-12 row">
			<div class="form-group col-sm-2">
				 <label for="bread">Bread:</label>
				 <select class="form-control" name="bread" >
				    <?php
					foreach ($options['bread'] as $key => $value) {
						
						echo '<option value="'.$value.'">'.$value.'</option>';
						
					}
					?>
				</select>
			</div>

			<div class="form-group col-sm-2">
				 <label for="bread">Sauce:</label>
				 <select class="form-control" name="sauce">
				    <?php
					foreach ($options['sauce'] as $key => $value) {
						
						echo '<option value="'.$value.'">'.$value.'</option>';
						
					}
					?>
				</select>
			</div>

			<div class="form-group col-sm-2">
				 <label for="bread">Sandwich Type:</label>
				 <select class="form-control" name="sandwichType">
				    <?php
					foreach ($options['sandwichType'] as $key => $value) {
						
						echo '<option value="'.$value.'">'.$value.'</option>';
						
					}
					?>
				</select>
			</div>
		</div>
		<div class="col-sm-12 row">
			<div class="form-group col-sm-2">
				 <label for="bread">Cheese:</label>
				 <select class="form-control" name="cheese">
				    <?php
					foreach ($options['cheese'] as $key => $value) {
						
						echo '<option value="'.$value.'">'.$value.'</option>';
						
					}
					?>
				</select>
			</div>

			<div class="form-group col-sm-2">
				 <label for="bread">Veggies:</label>
				 <select class="form-control" name="veggies">
				    <?php
					foreach ($options['veggies'] as $key => $value) {
						
						echo '<option value="'.$value.'">'.$value.'</option>';
						
					}
					?>
				</select>
			</div>
		</div>
	</form>
	<div class="col-sm-12">
		<button type="submit" form="order" value="Submit">Submit</button>
	</div>
	</div>

</body>			
</html>