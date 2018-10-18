<?php
  // Include config file
    require_once 'config.php';

  //start session, if it exists
  session_start();

  if(!isset($_SESSION['username'])){ 
      header("Location: index.php");
    }
  $username = $_SESSION['username'];
  $art_id = $art_title = $art_url = $art_description = "";

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

    </script>

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
          <li class="nav-item active">
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
        <h1>
          Welcome, <?php echo ucfirst($username); ?>
        </h1>
        <!-- <hr class="my-4"> -->
        <h4 class="text-muted">
          Browse The Collection
        </h4>
      </div>

      <div class="container">
        <div class="card-deck">
          <?php
            $sql = "SELECT art.art_id, artist, art_title, art_price, description, photo FROM art, art_description WHERE art.art_id = art_description.art_id;";
            
            $result = mysqli_query($link, $sql);
            if (mysqli_num_rows($result) > 0) {
                $i = 1;
                // output data of each row
                while($row = mysqli_fetch_assoc($result)) {
                  $art_id = $row['art_id'];
                  $artist = $row['artist'];
                  $art_title =  $row['art_title'];
                  $art_price = $row['art_price'];
                  $art_description = $row['description'];
                  $art_url = $row['photo'];

          ?>
                
              <div class="card border-dark mb-3" style="width: 20rem; ">
                <img class="card-img-top" src="assets/<?php echo $art_url;?>" height=300 width=300 style="position: relative;" alt="Art Image">
                <div class="card-body">
                  <h4 class="card-title"><?php echo $art_title;?></h4>
                  <h6>By: <?php echo $artist; ?></h6>
                </div>
                <!-- <ul class="list-group list-group-flush">
                  <li class="list-group-item border-success">Price: $<?php echo $art_price;?></li>
                </ul> -->
                <div class="card-footer">
                    <button type="button" class="btn btn-primary" name="buy" data-toggle="modal" data-target="#infoModal<?php echo $art_id ?>">More</button>
                </div>
              </div>


          <!-- Modal for info about art and buying it  -->
          <div class="modal fade" id="infoModal<?php echo $art_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">

            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $art_title; ?></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>

                <div class="modal-body">
                  <p>
                    <strong>
                    Price to be paid: $<?php echo $art_price; ?>
                    </strong>
                  </p>
                </div>
                      
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <form method="post" action="buyart.php">
                    <input type="hidden" name="art_id" value="<?php echo $art_id; ?>">
                    <input type="submit" class="btn btn-primary" value="Details" name="Buy">
                  </form>
                </div>
              </div>
            </div>

          </div>

          <?php 
                    if ($i%3 == 0) {
                      echo '</div><br><div class="card-deck">';
                    }
                    $i++;
                    }
                  } else {
                      echo "No results";
                  }


            mysqli_close($link);

            
          ?>
        </div>

      </div>
      
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