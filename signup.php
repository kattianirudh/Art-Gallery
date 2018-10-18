<?php

    // Include config file
    require_once 'config.php';
     
    // Define variables and initialize with empty values
    $username = $name = $password = $confirm_password = $phone = $address = "";
    $username_err = $name_err = $password_err = $confirm_password_err = $phone_err = $address_err = "";
     
    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        //Get name
        if(isset($_POST["name"])){
            if(empty(trim($_POST["name"]))){
                $name_err = "Please enter a name.";
            } else{
                $name = trim($_POST["name"]);
            }
        }
     
        // Validate username
        if(isset($_POST["username"])){
            if(empty(trim($_POST["username"]))){
                $username_err = "Please enter a username.";
            } else{
                // Prepare a select statement
                $sql = "SELECT id FROM customer WHERE username = ?";
                
                if($stmt = mysqli_prepare($link, $sql)){

                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "s", $param_username);
                    
                    // Set parameters
                    $param_username = trim($_POST["username"]);

                    // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                        /* store result */
                        mysqli_stmt_store_result($stmt);
                        
                        if(mysqli_stmt_num_rows($stmt) == 1){
                            $username_err = "This username is already taken.";
                        } else{
                            $username = trim($_POST["username"]);
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                }
                 
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }

        //Validate phone number
        if(isset($_POST["phone"])){
            if (empty(trim($_POST["phone"]))) {
                $phone_err = "Please enter a phone number.";
            } 
            else{
                $phone = trim($_POST["phone"]);
            }
        }

        //Get addresss
        if(isset($_POST["address"])){
            if(empty(trim($_POST["address"]))) {
                $address_err = "Please enter an address.";
            }
            else {
                $address = trim($_POST["address"]);
            }
        }
        
        // Validate password
        if(isset($_POST["password"])){
            if(empty(trim($_POST["password"]))){
                $password_err = "Please enter a password.";     
            } elseif(strlen(trim($_POST["password"])) < 6){
                $password_err = "Password must have atleast 6 characters.";
            } else{
                $password = trim($_POST["password"]);
            }
        }
        
        // Validate confirm password
        if(isset($_POST["confirm_password"])){
            if(empty(trim($_POST['confirm_password']))){
                $confirm_password_err = 'Please confirm password.';     
            } else{
                $confirm_password = trim($_POST['confirm_password']);
                if($password != $confirm_password){
                    $confirm_password_err = 'Password did not match.';
                }
            }
        }
        
        // Check input errors before inserting in database
        if(empty($username_err) && empty($name_err) && empty($password_err) && empty($confirm_password_err) && empty($phone_err)){
            
            // Prepare an insert statement
            $sql = "INSERT INTO customer (username, password, name, phone, address) VALUES (?, ?, ?, ?, ?)";
             
            if($stmt = mysqli_prepare($link, $sql)){
                
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_password, $name, $phone, $address);
                
                // Set parameters
                $param_username = $username;
                $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Redirect to login page
                    header("location: index.php");
                } 
                else{
                    echo "Something went wrong. Please try again later.";
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
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous"> -->
	<link rel="stylesheet" type="text/css" href="style/bootstrap4/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="style/loginstyle.css">
</head>
<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    	<div class="login_box text-center loginbox">
                <h3 class="credentials">Sign Up</h3><br>
                <table>
                	<tr>
                        <td><input class="form-control form-control-lg <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>" type="text" name="name" placeholder="Your Name" value="<?php echo $name;?>"><span class="help-block"><?php echo $name_err; ?></span></td>
                    </tr>
                    <tr>
                        <td><input class="form-control form-control-lg <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>" type="text" name="username" placeholder="Username" value="<?php echo $username;?>"><span class="help-block"><?php echo $username_err; ?></span></td>
                    </tr>
                    <tr>
                        <td><input class="form-control form-control-lg <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>" type="tel" name="phone" placeholder="Phone" value="<?php echo $phone;?>"><span class="help-block"><?php echo $phone_err; ?></span></td>
                    </tr>
                    <tr>
                        <td><input class="form-control form-control-lg <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>" type="text" name="address" placeholder="Address" value="<?php echo $address;?>"><?php echo $address_err; ?></td>
                    </tr>
                    <tr>
                        <td><input class="form-control form-control-lg <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>" type="password" name="password" placeholder="Password" value="<?php echo $password;?>"><span class="help-block"><?php echo $password_err; ?></span></td>
                    </tr>
                    <tr>
                        <td><input class="form-control form-control-lg <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>" type="password" name="confirm_password" placeholder="Confirm Password" value="<?php echo $confirm_password;?>"><span class="help-block"><?php echo $confirm_password_err; ?></span></td>
                    </tr>
                </table><br>
                <button class="btn btn-secondary" type="submit">Submit</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
                <hr>
                <button type="submit" formaction="index.php" class="btn btn-secondary" id="signup">Back</button>
    	</div>
    </form>
	<script type="text/javascript" src="style/bootstrap4/js/bootstrap.js"></script>
</body>
</html>