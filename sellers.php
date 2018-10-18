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
          <li class="nav-item active">
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
      <h1>
        Our Sellers
      </h1>
    </div>


    <div class="container">
        <div class="card-deck">
    <?php

      $sql = "SELECT seller_id, seller_name, seller_phone FROM sellers ORDER BY seller_name;";
      $result = mysqli_query($link, $sql);
      for ($i=0; $i < mysqli_num_rows($result); $i++) {
        $j = 1;

        while ($row = mysqli_fetch_assoc($result)) {

          $seller_id =  $row['seller_id'];
              $seller_name = $row['seller_name'];
              $seller_phone = $row['seller_phone'];
          // echo "<strong>".$seller_name." ".$seller_phone."</strong><br>";

          $query = "SELECT seller_name, seller_phone, art_title, artist FROM art, sellers WHERE art.seller_id = sellers.seller_id AND sellers.seller_id = $seller_id ORDER BY art_title;";

          $query_result = mysqli_query($link, $query);
          ?>
              <div class="card border-success mb-4 text-center" style="width: 20rem; ">
                  <h4 class="card-header display-4"><?php echo ucfirst($seller_name);?></h4>
                <div class="card-body">
                  <h4 class="card-title text-muted">Art They Sell</h4>
                

          <?php

            while ($query_row = mysqli_fetch_assoc($query_result)) {
              $art_title =  $query_row['art_title'];
              $artist = $query_row['artist'];
              
              
          ?>
                  <ul class="list-group">
                    <li class="list-group-item list-group-item-action"><?php echo "<b><em>".$art_title."</em></b> by <em>".$artist."</em>"; ?></li>
                  </ul>

          <?php
           
           }

          ?>
                </div>
                <div class="card-footer">
                  <?php echo "<b>Contact :</b> ".$seller_phone; ?>
                </div>
              </div>
                  

              <?php
          
          if ($j%2 == 0) {
            echo '</div><br><div class="card-deck">';
          }
          $j++;
        }
        
        }
      

    ?>
  </div></div>
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