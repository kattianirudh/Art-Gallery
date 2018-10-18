<?php
	require_once 'config.php';
	session_start();

	$username = $artid = $quantity = $cvv = $bought = '';
	$username = $_POST['username'];
	$artid = $_POST['art_id'];
	$quantity = $_POST['quantity'];
	$cvv = $_POST['cvv'];

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
<body class="jumbotron">

	<div class="text-center display-4 lead">
		<?php

			
			if (isset($quantity) && $quantity !=0) {

				$sql_check_stock = "SELECT stock FROM art WHERE art.art_id = $artid;";

					$result_stock = mysqli_query($link, $sql_check_stock);
					$row_stock = mysqli_fetch_assoc($result_stock);
					$stock = $row_stock['stock'];

					// if($quantity > $stock){
					// 	$bought = "Quantity not available";
					// 	echo $stock;
					// }

					// else{

						$bought = "Congratulations, <strong>" . ucfirst($username) ."</strong><br>
							You've bought <strong>". $quantity ."</strong> art piece(s).<br>";

						$stock = $stock - $quantity;
						$sql_update_stock = "UPDATE art SET art.stock = '$stock' WHERE art.art_id = '$artid';";
						$res_update_stock = mysqli_query($link, $sql_update_stock);


						$sql_username = "SELECT id FROM customer WHERE username='$username';";
						$result_uname = mysqli_query($link, $sql_username);
				    	$row_uname = mysqli_fetch_assoc($result_uname);
				    	$id = $row_uname['id'];

						$sql_update_count = "CALL update_count('$id','$artid','$quantity');";
						$result = mysqli_query($link, $sql_update_count);

					// }

						
						echo "<br>".$bought;
				}

			
		    else{
		    	echo "Quantity can't be 0!!!<br>";
		    }

		?>
		<br>
		<a href="home.php" class="btn btn-secondary">Back to Home</a>
	</div>

</body>
</html>