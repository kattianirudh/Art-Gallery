<?php
  // Include config file
    require_once 'config.php';
  //start session, if it exists
  session_start();
  
    $art_id = $result = $row = $art_title = $artist = $art_description = $art_price = $art_url = "";
    $username = $_SESSION['username'];

    //Propagate art id from home page for particular button using POST
    if(!isset($_POST['art_id'])){ 
      header("Location: home.php");
    }
    $art_id = $_POST['art_id'];

    //sql to obtain details about selected art
    $sql = "SELECT art_title, artist, art_price, description, photo, seller_name, stock FROM art, art_description, sellers WHERE art.art_id = art_description.art_id and art.seller_id = sellers.seller_id and art.art_id = $art_id;";

    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
    $art_title =  $row['art_title'];
    $artist = $row['artist'];
    $art_price = $row['art_price'];
    $art_description = $row['description'];
    $art_url = $row['photo'];
    $seller_name = $row['seller_name'];
    $stock=$row['stock'];
   
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
          <li class="nav-item">
            <a class="nav-link" href="orders.php">Orders</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
        </ul>
        <a class="navbar-brand btn btn-dark float-right" href="#"><?php echo ucfirst($username); ?></a>
        <a class="navbar-brand btn btn-danger float-right" href="logout.php">Logout</a>
      </div>
    </nav>
    </header>

    <!-- Content -->
    <main role="main">
      
    <div class="jumbotron text-center head1">
      <h2>
        <?php echo $art_title; ?>
      </h2>
      <h4 class="text-muted">
          By: <?php echo $artist;?>
      </h4>
    </div>
    

  <div class="container">
    <div class="row">
        <div class="col-md-4"><img class="img-thumbnail" src="assets/<?php echo $art_url;?>" height=300 width=300 style="position: relative;" alt="Art Image"></div>
        <div class="col-md-8">
          <div class="row">
            <div class="col-md-8"><p><?php echo $art_description;?></p></div>
          </div>
          <div class="row">
            <div class="col-md-8"><strong>Price: $<?php echo $art_price;?></strong><hr></div>
            <div class="col-md-8"><strong>Stock Left: <?php echo $stock;?></strong><hr>
            </div>
          </div>
          <div class="row">
            <div class="col-md-2">Quantity: </div>
            <div class="col-md-6">
            <form method="post" class="input-group" action="billing2.php">
              <input type="hidden" name="username" value="<?php echo $username; ?>">
              <input type="hidden" name="art_id" value="<?php echo $art_id; ?>">
              <input type="hidden" name="stock" value="<?php echo $stock; ?>">
              <input type="text" name="quantity" placeholder="Quantity" class="form-control" value="1">
              <input type="submit" class="btn btn-primary" name="buy" value="Buy" class="form-control">
              <a class="btn btn-secondary" href="home.php" class="form-control">Back</a>
            </form>
            </div>
          </div>
          
      </div>
    </div>
              
    <?php

    // function echoval($value='', $art_id='')
    // {
    //   // echo $value;
    //   $_POST['art_id'] = $art_id;
    //   echo '<script type="text/javascript">alert("Bought");</script>';
    // }
    //   if(isset($_POST['buy'])){
    //     echo echoval($_POST['buy'], $art_id);
    //   }
      

    ?>






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