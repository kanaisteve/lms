<?php
    include_once "admin/libs/users.php";
    include_once 'admin/libs/user_validator.php';
    
    // Processing form data when form is submitted
    if(isset($_POST["signup"])) :
        // create a uservalidator and users object to access their methods
        $validation = new UserValidator($_POST);
        $userObj = new Users();
        
        // validate entries
        $errors = $validation->validateForm();
        
        // register a user if their are not errors
        if(empty($errors)) {
            $userObj->register($_POST);
      
            // email activation
            // ....
            
            // Redirect to login page
            header("location: sign-in.php");
        } else {
            echo "";
        }
    endif;
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
            background-color: #1976d2;
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
              <div class="app-brand" style="background-color: #1976d2; text-align:center;">
                <svg class="brand-icon" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" width="30" height="33"
                    viewBox="0 0 30 33">
                    <g fill="none" fill-rule="evenodd">
                      <path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z" />
                      <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
                    </g>
                  </svg>  
              </div>
            </div>
            <div class="card-body p-5">
              <h4 class="text-dark mb-5">Sign Up</h4>
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="row">
                  <div class="form-group col-md-6 mb-4 <?php echo (!empty($firstname_err)) ? 'has-error' : ''; ?>">
                    <input type="text" class="form-control input-lg" name="firstname" value="<?php if(isset($_POST['firstname'])) echo $_POST['firstname'] ?>" id="firstname" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;" aria-describedby="firstNameHelp" placeholder="First Name">
                    <span class="help-block text-danger"><?php echo $errors['firstname'] ?? '' ?></span>
                  </div>
                  <div class="form-group col-md-6 mb-4 <?php echo (!empty($lastname_err)) ? 'has-error' : ''; ?>">
                    <input type="text" class="form-control input-lg" name="lastname" id="lastname" value="<?php if(isset($_POST['lastname'])) echo $_POST['lastname'] ?>" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;" aria-describedby="lastNameHelp" placeholder="Last Name">
                    <span class="help-block text-danger"><?php echo $errors['lastname'] ?? '' ?></span>
                  </div>
                  <div class="form-group col-md-12 mb-2 <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                    <input type="email" class="form-control input-lg" name="email" id="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'] ?>" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;" aria-describedby="emailHelp" placeholder="Email ID">
                    <span class="help-block text-danger"><?php echo $errors['email'] ?? '' ?>. </span>
                    <!--<span class="help-block text-danger"><?php //echo $email_err ?? '' ?></span>-->
                  </div>
                  <div class="form-group col-md-12 mb-2 <?php echo (!empty($mobilenumber_err)) ? 'has-error' : ''; ?>">
                    <input type="text" class="form-control input-lg" name="mobilenumber" id="mobilenumber" value="<?php if(isset($_POST['mobilenumber'])) echo $_POST['mobilenumber'] ?>" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;" aria-describedby="mobileNumberHelp" placeholder="Mobile Number">
                    <span class="help-block text-danger"><?php echo $errors['mobilenumber'] ?? '' ?>. </span>
                    <!--<span class="help-block text-danger"><?php //echo $mobileno_err; ?></span>-->
                  </div>
                  <div class="form-group col-md-12 <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <input type="password" class="form-control input-lg" name="password" id="password" value="<?php if(isset($_POST['password'])) echo $_POST['password'] ?>" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;" placeholder="Password">
                    <span class="help-block text-danger"><?php echo $errors['password'] ?? '' ?></span>
                  </div>
                  <div class="form-group col-md-12 <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                    <input type="password" class="form-control input-lg" name="confirm_password" id="cpassword" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;" placeholder="Confirm Password">
                    <span class="help-block text-danger"><?php echo $errors['confirm_password'] ?? '' ?></span>
                  </div>
                  <div class="col-md-12">
                    <div class="d-inline-block mr-3">
                      <label class="control control-checkbox">
                        <input type="checkbox" />
                        <div class="control-indicator"></div>
                        I Agree the terms and conditions
                      </label>
                    </div>
                    <input type="submit" name="signup" value="Sign Up" class="btn btn-lg btn-block mb-4" style="color:#ffffff; background-color:#1976d2;">
                    <p>Already have an account?
                      <a style="color:#7DBCFF;" href="sign-in.php">Sign in</a>
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