<?php
    // Include config file
    require_once 'config.php';
     
    // Define variables and initialize with empty values
    $username = $password = "";
    $username_err = $password_err = "";
     
    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
     
        // Check if username is empty
        if (isset($_POST["username"])) {
            if(empty(trim($_POST["username"]))){
                $username_err = 'Please enter username.';
            } else{
                $username = trim($_POST["username"]);
            }
        }
        
        
        // Chdeck if password is empty
        if (isset($_POST["password"])) {
            if(empty(trim($_POST['password']))){
                $password_err = 'Please enter your password.';
            } else{
                $password = trim($_POST['password']);
            }
        }
        
        // Validate credentials
        if(empty($username_err) && empty($password_err)){
            // Prepare a select statement
            $sql = "SELECT username, password FROM customer WHERE username = ?";
            
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_username);
                
                // Set parameters
                $param_username = $username;
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Store result
                    mysqli_stmt_store_result($stmt);
                    
                    // Check if username exists, if yes then verify password
                    if(mysqli_stmt_num_rows($stmt) == 1){                    
                        // Bind result variables
                        mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                        if(mysqli_stmt_fetch($stmt)){
                            if(password_verify($password, $hashed_password)){
                                /* Password is correct, so start a new session and
                                save the username to the session */
                                session_start();
                                $_SESSION['username'] = $username;      
                                header("location: home.php");
                            } else{
                                // Display an error message if password is not valid
                                $password_err = 'The password you entered was not valid.';
                            }
                        }
                    } else{
                        // Display an error message if username doesn't exist
                        $username_err = 'No account found with that username.';
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
            
            // Close statement
            mysqli_stmt_close($stmt);
        }
        
        // Close connection
        mysqli_close($link);
    }
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Art Gallery</title>

    <!-- Bootstrap CDN -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous"> -->

    <!-- Local Bootstrap file -->
	<link rel="stylesheet" type="text/css" href="style/bootstrap4/css/bootstrap.css">
    <!-- Custom Style for this page -->
    <link rel="stylesheet" type="text/css" href="style/loginstyle.css">
</head>

<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    	<div class="login_box text-center loginbox">
                <h3 class="credentials">Enter Credentials</h3><br>
                <table>
                    <tr class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                        <!-- <td>ID</td> -->
                        <td><input class="form-control form-control-lg <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>" type="text" name="username" placeholder="Username" value="<?php echo $username; ?>"><span class="help-block"><?php echo $username_err; ?></span></td>
                    </tr>
                    <tr class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                        <!-- <td>Password</td> -->
                        <td><input class="form-control form-control-lg" type="password" name="password" placeholder="Password"><span class="help-block"><?php echo $password_err; ?></span></td>
                    </tr>
                </table><br>
                <button class="btn btn-secondary">Enter</button>
                <hr>
                <button type="submit" formaction="signup.php" class="btn btn-secondary" id="signup">Sign Up</button>
       </div>
    </form>
	<script type="text/javascript" src="style/bootstrap4/js/bootstrap.js"></script>
</body>
</html>