<?php
 
  // Include config file
  require_once "admin/database/connect.php";

  // Check if the user is already logged in, if yes then redirect him to welcome page
  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
      header("location: index.php");
      exit;
  }

 
// Define variables and initialize with empty values
$username = $email = $mobilenumber = $password = "";
$username_err = $email_err = $mobilenumber_err = $password_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["signin"])) {

    // ===== collect user form data ======
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    // Check if username is empty
    if(empty($username)){
        $username_err = "Please enter your mobile number or email address.";
    } 

    // Check if password is empty
    if(empty($password)){
        $password_err = "Please enter your password.";
    }

    // first check the database to make sure
    // a user does not already exist with the same username and/or email
    $check_email_mobileno = "SELECT * FROM peri_users WHERE mobilenumber='$username' OR email='$username' LIMIT 1";
    $result = mysqli_query($conn, $check_email_mobileno);
    $user = mysqli_fetch_assoc($result);
    if ($user) { // if user exists
        $email = $user['email'];
        $mobilenumber = $user['mobilenumber'];
        $firstname = $user['firstname'];
        $lastname =  $user['lastname'];
        //$acctype =  $user['account_type'];
        $userRole = $user['user_role'];
        $userImg = $user['profile_image'];
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $select_email_mobileno = "SELECT id, firstname, lastname, email, mobilenumber, userpassword FROM peri_users WHERE email= ? OR mobilenumber = ? LIMIT 1";
        
        if($stmt = mysqli_prepare($conn, $select_email_mobileno)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss",  $param_username, $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                  // Bind result variables
                  mysqli_stmt_bind_result($stmt, $id, $firstname, $lastname, $email, $mobilenumber, $hashed_password);
                  if(mysqli_stmt_fetch($stmt)){
                    /*
                    echo 'ID: '.$id.'<br>';
                    echo 'Email: '.$email.'<br>';
                    echo 'Mobile No.: '.$mobilenumber.'<br>';
                    echo 'Hashed Password: '.$hashed_password.'<br>';
                    echo 'Password: '.$password.'<br>';
                    */

                    if(password_verify($password, $hashed_password)){
                      // Password is correct, so start a new session
                      session_start();
                      
                      // Store data in session variables
                      $_SESSION["loggedin"] = true;
                      $_SESSION["id"] = $id;
                      $_SESSION["email"] = $email; 
                      $_SESSION["mobilenumber"] = $mobilenumber;     
                      $_SESSION["fullName"] = $firstname.' '.$lastname;     
                      //$_SESSION["accounttype"] = $acctype;                            
                      $_SESSION["userRole"] = $userRole;                            
                      $_SESSION["userImg"] = $userImg;                            
                      
                        // Redirect user to welcome page
                        if(isset($_SESSION['userRole'])) {
                            if($_SESSION['userRole'] === 'admin') {
                                header("location: admin/index.php");
                            } else {
                                header ("location: admin/indexCust.php");
                            }
                        }
                    } else {
                      // Display an error message if password is not valid
                      $password_err = "The password you entered was not valid.";
                    }
                  }
                } else{
                  // Display an error message if username doesn't exist
                  $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />  
    <title>Sign In</title> 
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet"/>
    <link href="https://cdn.materialdesignicons.com/3.0.39/css/materialdesignicons.min.css" rel="stylesheet" /> 
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    
    <!-- SLEEK CSS -->
    <link id="sleek-css" rel="stylesheet" href="admin/assets/css/sleek.css" />    
  </head>
  
<style>
    .card-header{
        background-color: #183b6b;
    }
    .logo{
        width: 250px;
        padding-top: 0.6rem;
    }
</style>

  <body class="bg-light-gray" id="body">
    <div class="container d-flex flex-column justify-content-between vh-100">
      <div class="row justify-content-center mt-5">
        <div class="col-xl-5 col-lg-6 col-md-10">
          <div class="card">
            <div class="card-header">
              <div class="app-brand" style="background-color: #183b6b; text-align:center;">
            
                  <!-- <svg class="brand-icon" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" width="30" height="33"
                    viewBox="0 0 30 33">
                    <g fill="none" fill-rule="evenodd">
                      <path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z" />
                      <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
                    </g>
                  </svg> -->
                  <img class="logo" src="admin/assets/img/peridot_white.png"/>
        
              </div>
            </div>
            <div class="card-body p-5">
              <h4 class="text-dark mb-5">Sign In</h4>
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="row">
                  <div class="col-md-12 mb-4 form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                    <input type="text" class="form-control input-lg" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;" name="username" id="username" value="<?php echo $username ?>" aria-describedby="usernameHelp" placeholder="Mobile No. or Email ID">
                    <span class="help-block"><?php echo $username_err; ?></span>
                  </div>
                  <div class="col-md-12 form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <input type="password" class="form-control input-lg" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;" name="password" id="password" placeholder="Password">
                    <span class="help-block"><?php echo $password_err; ?></span>
                  </div>
                  <div class="col-md-12">
                    <div class="d-flex my-2 justify-content-between">
                      <div class="d-inline-block mr-3">
                        <label class="control control-checkbox">Remember me
                          <input type="checkbox" />
                          <div class="control-indicator"></div>
                        </label>
                
                      </div>
                      <!--<p><a class="text-blue" href="#">Forgot Your Password?</a></p>-->
                    </div>
                    <input type="submit" name="signin" value="Sign In" class="btn btn-lg btn-block mb-4" style="color:#ffffff; background-color:#183b6b;">
                    <p>Don't have an account yet ?
                      <a style="color: #5cdb94" href="sign-up.php">Sign Up</a>
                    </p>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="copyright pl-0">
        <p class="text-center">&copy; <?php echo date('Y'); ?> Copyright Loan Management System by
          <a style="color: #5cdb94" href="http://www.kanaitech.com/" target="_blank">Kanai Technologies LLC.</a>
        </p>
      </div>
    </div>
  </body>
</html>