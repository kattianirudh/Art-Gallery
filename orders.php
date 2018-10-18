<?php
  // Include config file
    require_once 'config.php';

  //start session, if it exists
  session_start();

  if(!isset($_SESSION['username'])){ 
      header("Location: index.php");
    }
  $username = $_SESSION['username'];
 
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Art Gallery</title>

    <!-- Bootstrap core CSS -->
    <link href="style/bootstrap4/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <!-- <link href="navbar-top-fixed.css" rel="stylesheet"> -->

    <!-- Custom styles for this footer -->
    <link href="style/sticky-footer-navbar.css" rel="stylesheet">
    
    <!-- Other Custom Style -->
    <link rel="stylesheet" type="text/css" href="style/otherstyle.css">
  </head>

  <body>

    <header class="sticky-top">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <div class="navbar-brand display-2" id="nav1"><strong>Art Gallery</strong></div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="sellers.php">Sellers</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="orders.php">Orders</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
        </ul>
        <a class="navbar-brand btn btn-dark float-right" href="#"><?php echo ucfirst($username); ?></a>
        <a class="navbar-brand btn btn-danger float-right" href="logout.php">Logout</a>
        </div>
      </div>
    </nav>
  </header>


    <!-- Content -->
    <main role="main">
      
    <div class="jumbotron text-center head1">
      <h1>
        Your Orders
      </h1>
    </div>

    <div class="container">
        <div class="card-deck">

    <?php

      //art title, artist, art price, seller name, count
    $sql = "SELECT a.art_title, a.artist, a.art_price, p.count, s.seller_name, p.purchase_amt
            FROM art a, purchases p, sellers s, customer c
            WHERE a.art_id = p.art_id AND c.id = p.id AND a.seller_id = s.seller_id 
            AND c.username = '$username';";
    $result = mysqli_query($link, $sql);
    if (!$result || mysqli_num_rows($result) == 0) {
      echo '<div class="container jumbotron text-center display-4" style="padding: 2em;">No Orders yet!</div>';
    } 
    else {
      $i = 1;
    while($row = mysqli_fetch_assoc($result)) {
      $art_title =  $row['art_title'];
      $artist = $row['artist'];
      $art_price = $row['art_price'];
      $count = $row['count'];
      $seller_name = $row['seller_name'];
      $purchase_amt = $row['purchase_amt'];

    ?>

      <div class="card border-dark mb-3 text-center" style="width: 20rem;">
        <h3 class="card-header"><?php echo $art_title;?></h3>
        <div class="card-body">
          <h6 class="text-muted"><em>By:</em> <?php echo $artist; ?></h6>
          <ul class="list-group list-group-flush">
            <li class="list-group-item border-success"><strong>Price:</strong> $<?php echo $art_price;?></li>
            <li class="list-group-item border-success"><strong>Sold By:</strong> <?php echo $seller_name;?></li>
          </ul>
        </div>
        <div class="card-footer">
          <strong>Quantity Bought: </strong>
          <span class="badge badge-primary badge-pill"><?php echo $count; ?></span>
          <br>
          <strong>Amount spent: </strong>
          <span class="badge badge-primary badge-pill"><?php echo "$".$purchase_amt; ?></span>
        </div>
      </div>




    <?php 
     
      if ($i%2 == 0) {
        echo '</div><br><div class="card-deck">';
      }
      $i++;
      }
    }
    
    
    mysqli_close($link);
    ?>
  </div> <!-- for card deck -->
</div> 
<!-- for container of card deck -->



    </main>


    <footer class="footer">
      <div class="container text-center">
        <span class="text-muted">&copy; Anirudh Katti, 2017.</span>
      </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script type="text/javascript" src="style/bootstrap4/js/bootstrap.js"></script>
  </body>
</html>