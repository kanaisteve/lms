<?php 
    include_once "admin/libs/users.php";
    
    $userObj = new Users();
    
    // Define variables and initialize with empty values
    $username = $email = $mobilenumber = $password = "";
    $username_err = $email_err = $mobilenumber_err = $password_err = $error = "";

    // Check if the user is already logged in, if yes then redirect him to welcome page
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) :
        if($_SESSION['userRole'] === 'admin') {
            header("location: admin/index.php");
        } else {
            header ("location: admin/indexCust.php"); 
        }
        exit;
    endif;
    
    if(isset($_POST['signin'])) :
        // ===== collect user form data ======
        $username = $_POST["username"];
        $password = $_POST["password"];

        /******** VALIDATION ************/
        // Check if username is empty
        if(empty($username)){
            $username_err = "Please enter your mobile number or email address.";
        } 

        // Check if password is empty
        if(empty($password)){
            $password_err = "Please enter your password.";
        }
        
        /********* SIGN IN *************/
        if(empty($username_err) && empty($password_err)) {
            if($userObj->login($username, $password)) {
                if(isset($_SESSION['userRole'])) {
                    if($_SESSION['userRole'] === 'admin') {
                        header("location: admin/index.php");
                    } else {
                        header ("location: admin/indexCust.php"); 
                    }
                }
            } else {
                $error = "Incorrect email or password";
            }
        }
    endif;
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
  
    <style>
        .card-header{
            background-color: #1976d2;
        }
        .logo{
            width: 250px;
            padding-top: 0.6rem;
        }
    </style>
  </head>

  <body class="bg-light-gray" id="body">
    <div class="container d-flex flex-column justify-content-between vh-100">
      <div class="row justify-content-center mt-5">
        <div class="col-xl-5 col-lg-6 col-md-10">
          <div class="card">
            <div class="card-header">
              <div class="app-brand" style="background-color:#1976d2; text-align:center;">
            
                   <svg class="brand-icon" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" width="30" height="33"
                    viewBox="0 0 30 33">
                    <g fill="none" fill-rule="evenodd">
                      <path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z" />
                      <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
                    </g>
                  </svg> 
                  <!--<img class="logo" src="admin/assets/img/"/>-->
        
              </div>
            </div>
            <div class="card-body p-5">
              <h4 class="text-dark mb-4">Sign In</h4>
              <span class="help-block text-danger"><?= $error; ?></span>
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="row">
                  <div class="col-md-12 mb-3 form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                    <input type="text" class="form-control input-lg" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;" name="username" id="username" value="<?php echo $username ?>" aria-describedby="usernameHelp" placeholder="Mobile No. or Email ID">
                    <span class="help-block text-danger"><?php echo $username_err; ?></span>
                  </div>
                  <div class="col-md-12 form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <input type="password" class="form-control input-lg" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;" name="password" id="password" placeholder="Password">
                    <span class="help-block text-danger"><?php echo $password_err; ?></span>
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
                    <input type="submit" name="signin" value="Sign In" class="btn btn-lg btn-block mb-4" style="color:#ffffff; background-color:#1976d2;">
                    <p>Don't have an account yet ?
                      <a style="color: #7DBCFF;" href="sign-up.php">Sign Up</a>
                    </p>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="copyright pl-0">
        <p class="text-center lead"><small>&copy; <?php echo date('Y'); ?> Copyright Loan Management System</small></p>
        <p class="text-center"><small>Version 2.1</small></a></p>
      </div>
    </div>
  </body>
</html>