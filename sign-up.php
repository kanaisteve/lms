<?php
// Initialize the session
session_start();

// Include config file
require_once "admin/database/connect.php";
 
// Define variables and initialize with empty values
$firstname = $lastname = $email = $mobilenumber = $password = $confirm_password = "";
$firstname_err = $lastname_err = $email_err = $mobilenumber_err = $password_err  = $confirm_password_err = $firstname_err = $lastname_err = "";
 
// Set empty form vars for validation mapping
$_first_name = $_last_name = $_email = $_mobile_number = $_password = $_comfirm_password = "";

// Processing form data when form is submitted
if(isset($_POST["signup"])) {
  // ===== collect user form data ======
  $firstname = trim($_POST["firstname"]);
  $lastname = trim($_POST["lastname"]);
  $email = trim($_POST['email']);
  $mobilenumber = $_POST['mobilenumber'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];
  
  if(empty($_POST['merchantcode'])==false){
      if($_POST['merchantcode_password']=='lmg2020'){
      $acctype=$_POST['merchantcode'];
  }else{
      $acctype='user';
  }
      
  }else{
      $acctype='user';
  }

  // ===== verify if form values are not empty =====
  if(!empty($firstname) && !empty($lastname) && !empty($email) && !empty($mobilenumber) && !empty($password) && !empty($confirm_password)){
    // clean the form data before sending to database
    $_first_name = mysqli_real_escape_string($conn, $firstname);
    $_last_name = mysqli_real_escape_string($conn, $lastname);
    $_email = mysqli_real_escape_string($conn, $email);
    $_mobile_number = mysqli_real_escape_string($conn, $mobilenumber);
    $_password = mysqli_real_escape_string($conn, $password);
    $_confirm_password = mysqli_real_escape_string($conn, $confirm_password);

     // ============================== PREG_MATCH CONDITION ==================== 
     // i. First name validation
     if(!preg_match("/^[a-zA-Z ]*$/", $_first_name)) {
        $firstname_err = '<div class="alert alert-danger">
                Only letters and white space allowed.
            </div>';
    }
    // ii. Last name validation
    if(!preg_match("/^[a-zA-Z ]*$/", $_last_name)) {
        $lastname_err = '<div class="alert alert-danger">
                Only letters and white space allowed.
            </div>';
    }
    // iii. 10-digit only validation for mobile number
    if(!preg_match("/^[0-9]{10}+$/", $_mobile_number)) {
        $mobilenumber_err = '<div class="alert alert-danger">
                Only 10-digit mobile numbers allowed.
            </div>';
    }
    // iv. [character length check, must contain 1special character,lowercase,uppercase and digit] use 8 or more characters with a mix of letters, numbers & symboles
    // if(!preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{6,20}$/", $_password)) {
    //     $password_err = '<div class="alert alert-danger">
    //              Password should be between 6 to 20 charcters long, contains atleast one special chacter, lowercase, uppercase and a digit.
    //         </div>';
    // }
  } else {
    // ===== Error Handling (Display error(s) if any of the user input field is empty) =======
    if(empty($firstname)){
        //$fNameEmptyErr 
        $firstname_err = '<div class="text-danger">
            First name can not be blank.
        </div>';
    }
    if(empty($lastname)){
        //$lNameEmptyErr
        $lastname_error = '<div class="text-danger">
            Last name can not be blank.
        </div>';
    }
    if(empty($email)){
        //$emailEmptyErr
       $email_err = '<div class="text-danger">
            Email can not be blank.
        </div>';
    }
    if(empty($mobilenumber)){
        //$mobileEmptyErr 
        $mobilenumber_err = '<div class="text-danger">
            Mobile number can not be blank.
        </div>';
    }
    if(empty($password)){
        // $passwordEmptyErr 
        $password_err = '<div class="text-danger">
            Password can not be blank.
        </div>';
    }
    
    if(empty( $confirm_password)){
        // $confirmPasswordEmptyErr 
        $confirm_password_err = '<div class="text-danger">
            Confirm password can not be blank.
        </div>';
    } 
  }
 
  // ============================== BASIC VALIDATION ==================== 
  // first check the database to make sure
  // a user does not already exist with the same username and/or email
  $check_mobilenumber_email = "SELECT * FROM peri_users WHERE mobilenumber ='$mobilenumber' OR email='$email' LIMIT 1";
  echo $mobilenumber . ' ' . $email;
  $result = mysqli_query($conn, $check_mobilenumber_email);
  $user = mysqli_fetch_assoc($result);
  if ($user) { // if user exists
      if ($user['mobilenumber'] === $mobilenumber) {
          $mobilenumber_err = "Mobile number already exists.";
      }
      if ($user['email'] === $email) {
          $email_err = "Email already exists.";
      }
  }
  // ===== 1. Validate mobile number (verify if mobile number exists)=====
  if(empty($mobilenumber)){
      $username_err = "Please enter your mobile number.";
  } else{
      // check if mobile number already exists
      $check_mobilenumber = "SELECT id FROM peri_users WHERE mobilenumber = ?";
      
      if($stmt = mysqli_prepare($conn, $check_mobilenumber)){
          // Bind variables to the prepared statement as parameters
          mysqli_stmt_bind_param($stmt, "s", $param_mobilenumber );
          
          // Set parameters
          $param_mobilenumber = $_mobile_number ;
          
          // Attempt to execute the prepared statement
          if(mysqli_stmt_execute($stmt)){
              /* store result */
              mysqli_stmt_store_result($stmt);
              
              if(mysqli_stmt_num_rows($stmt) == 1){
                  $mobilenumber_err = "This mobile number is already taken.";
              } else{
                  $mobilenumber = $_mobile_number;
              }
          } else{
              echo "Oops! Something went wrong. Please try again later.";
          }
          // Close statement
          mysqli_stmt_close($stmt);
      }
  }

  // ===== 2. Validate email =====
  if(!filter_var($_email, FILTER_VALIDATE_EMAIL)) {
      $_emailErr = '<div class="text-danger">
              Email format is invalid.
          </div>';
  }
  
  // ===== 3. Validate password =====
  if(empty(trim($_POST["password"]))){
      $password_err = "Please enter a password.";     
  } elseif(strlen(trim($_POST["password"])) < 6){
      $password_err = "Password must have atleast 6 characters.";
  } else{
      $password = trim($_POST["password"]);
  }
  
  // ===== 4. Validate confirm password =====
  if(empty(trim($_POST["confirm_password"]))){
      $confirm_password_err = "Please confirm password.";     
  } else{
      $confirm_password = trim($_POST["confirm_password"]);
      if(empty($password_err) && ($password != $confirm_password)){
          $confirm_password_err = "Password did not match.";
      }
  }
  
  // Check input errors before inserting in database [insert if there are no errors]
  if(empty( $firstname_err) && empty( $lastname_err) && empty( $email_err) && empty( $mobilenumber_err) &&  empty($password_err) && empty($confirm_password_err)){
      
    // Add user into the users1 table
    $add_user = "INSERT INTO peri_users (firstname, lastname, email, mobilenumber, userpassword) VALUES (?, ?, ?, ?, ?)";
    
    if($stmt = mysqli_prepare($conn, $add_user)){
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "sssss", $param_firstname, $param_lastname, $param_email, $param_mobilenumber, $param_password);
      
      // Set parameters
      $param_firstname = $firstname;
      $param_lastname = $lastname;
      $param_email = $email;
      $param_mobilenumber = $mobilenumber;
      $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
      
      // Attempt to execute the prepared statement
      if(mysqli_stmt_execute($stmt)){
      
        // email activation
        // ....
        // Store data in session variables
        $_SESSION['firstname'] = $firstname;
        $_SESSION['lastname'] = $lastname;
        $_SESSION['email'] = $email;
        $_SESSION['success'] = "You are now logged in";
        // Redirect to login page
        header("location: sign-in.php");
      } else{
          echo "Something went wrong. Please try again later.";
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
    <title>Register User</title> 
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
            <!-- Header -->
            <div class="card-header">
              <div class="app-brand" style="background-color: #183b6b; text-align:center;>
                <a href="">
                  <img class="logo" src="admin/assets/img/peridot_white.png"/>
                </a>
              </div>
            </div>
            <!-- Body -->
            <div class="card-body p-5">
              <h4 class="text-dark mb-5">Sign Up</h4>
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="row">
                  <div class="form-group col-md-6 mb-4 <?php echo (!empty($firstname_err)) ? 'has-error' : ''; ?>">
                    <input type="text" class="form-control input-lg" name="firstname" id="firstname" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;" aria-describedby="firstNameHelp" placeholder="First Name">
                    <span class="help-block"><?php echo $firstname_err; ?></span>
                  </div>
                  <div class="form-group col-md-6 mb-4 <?php echo (!empty($lastname_err)) ? 'has-error' : ''; ?>">
                    <input type="text" class="form-control input-lg" name="lastname" id="lastname" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;" aria-describedby="lastNameHelp" placeholder="Last Name">
                    <span class="help-block"><?php echo $lastname_err; ?></span>
                  </div>
                  <div class="form-group col-md-12 mb-4 <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                    <input type="email" class="form-control input-lg" name="email" id="email" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;" aria-describedby="emailHelp" placeholder="Email ID">
                    <span class="help-block"><?php echo $email_err; ?></span>
                  </div>
                  <div class="form-group col-md-12 mb-4 <?php echo (!empty($mobilenumber_err)) ? 'has-error' : ''; ?>">
                    <input type="text" class="form-control input-lg" name="mobilenumber" id="mobilenumber" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;" aria-describedby="mobileNumberHelp" placeholder="Mobile Number">
                    <span class="help-block"><?php echo $mobilenumber_err; ?></span>
                  </div>
                  <div class="form-group col-md-12 <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <input type="password" class="form-control input-lg" name="password" id="password" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;" placeholder="Password">
                    <span class="help-block"><?php echo '<p class="text-danger">' .$password_err. '</p>'; ?></span>
                  </div>
                  <div class="form-group col-md-12 <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                    <input type="password" class="form-control input-lg" name="confirm_password" id="cpassword" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;" placeholder="Confirm Password">
                    <span class="help-block"><?php echo '<p class="text-danger">' .$confirm_password_err. '</p>'; ?></span>
                  </div>
                  <div class="col-md-12">
                    <div class="d-inline-block mr-3">
                      <label class="control control-checkbox">
                        <input type="checkbox" />
                        <div class="control-indicator"></div>
                        I Agree the terms and conditions
                      </label>
                    </div>
                    <input type="submit" name="signup" value="Sign Up" class="btn btn-lg btn-block mb-4" style="color:#ffffff; background-color:#183b6b;">
                    <p>Already have an account?
                      <a style="color:#5cdb94;" href="sign-in.php">Sign in</a>
                    </p>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="copyright pl-0">
        <p class="text-center">&copy; <?php echo date('Y'); ?> Copyright Loan Management Sys. by
          <a style="color:#5cdb94;" href="http://www.kanaitech.com/" target="_blank">Kanai Technologies LLC</a>.
        </p>
      </div>
    </div>
</body>
</html>