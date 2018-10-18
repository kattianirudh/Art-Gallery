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
    <style type="text/css">
      .dropcaps:first-letter {
        margin: 0em 0 -0.05em 0;
        padding: 0 0.065em 0 0;
        font-size: 5em;
        line-height: 0.85em;
        float: left;
      }
      p {
        font-size: 130%;
      }
    </style>
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
          <li class="nav-item active">
            <a class="nav-link" href="about.php">About</a>
          </li>
        </ul>
        <a class="navbar-brand btn btn-dark float-right" href="#"><?php echo ucfirst($username); ?></a>
        <a class="navbar-brand btn btn-danger float-right" href="logout.php">Logout</a>
      </div>
    </nav>
  </header>


    <!-- Content -->
    <main role="main" class="jumbotron">
      <div class="lead" style="padding: 0.6em;">

        <h1 class="head1 text-center display-4">
          About
        </h1>
        <hr>
        <div class="container">
          <p class="dropcaps">
            The art is at the centre of everything we do here. We believe that the access to beautiful and special objects is an important part of people’s personal and cultural life.<br>
            Serving our clients is our major ambition. We cherish the role that we have earned as cultural stewards of the objects that pass through our hands.
          </p>
          <p>
            The Gallery houses a significant collection of the world's most famous artworks covering the period from 1400 AD to the present. Historical works by renowned artists such as Edvard Munch and Leonardo da Vinci, master works by Vincent van Gogh, and Salvador Dali.
            The collection is sourced from other public and private collections internationally.
          </p>
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