<?php
	require_once 'config.php';
	session_start();

	$username = $artid = $quantity = $cvv = $stock = '';
	$username = $_POST['username'];
	$artid = $_POST['art_id'];
	$quantity = $_POST['quantity'];
	$stock = $_POST['stock'];
	?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Bought</title>
	<link href="style/bootstrap4/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style/otherstyle.css">
</head>
<body class ="jumbotron" >
	<div class = "cont" style="">
		<div class="thumbnails" style="margin-left: 30px">
			<div id="tb1" style="height:80px;margin-left: 20px;display: inline-block;">

				<img src="assets/Visa.png" style="width: 60px;height: 40px;">

			</div>
			<div id="tb2" style="height:80px;margin-left: 20px; display: inline-block;">

				<img src="assets/mastercard.jpg" style="width: 60px;height: 40px;">

			</div>
			<div id="tb3" style="height:80px;margin-left: 20px; display: inline-block;">

				<img src="assets/paypal.jpg" style="width: 60px;height: 40px;">

			</div>
			<div id="tb4" style="height:80px;margin-left: 20px; display: inline-block;">

				<img src="assets/Paytm.png" style="width: 60px;height: 40px;">

			</div>
			<div id="tb5" style="height:80px;margin-left: 20px; display: inline-block;">

				<img src="assets/Maestro.png" style="width: 60px;height: 40px;">

			</div>
		</div>
	</div>
	<form action="buy.php" method="post" class="form-inline">
	<div id="cl" style="margin-left: 30px">
		<input type="number" name="cvv" placeholder="cvv">
	</div>
	<div>
					<input type="hidden" name="username" value="<?php echo $username; ?>">
		            <input type="hidden" name="art_id" value="<?php echo $art_id; ?>">
		            <input type="hidden" name="quantity" value="<?php echo $quantity; ?>">
		            <input type="hidden" name="stock" value="<?php echo $stock; ?>">
		            <input type="submit" name="Buy" value="Buy" class="btn btn-secondary">
	
	</div>	
		 <?php echo $username. " " .$artid. " " .$stock;
		?> 
	</form>
</body>
</html>