<!-- Add New User Script -->
<?php
    // Define variables and initialize with empty values
    $firstname = $lastname = $email = $mobilenumber = $password = $confirm_password = "";
    $firstname_err = $lastname_err = $email_err = $mobilenumber_err = $password_err  = $confirm_password_err = $firstname_err = $lastname_err = "";
 
    // Set empty form vars for validation mapping
    $_first_name = $_last_name = $_email = $_mobile_number = $_password = $_comfirm_password = "";

    // Processing form data when form is submitted
    if(isset($_POST['btn_add_user'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $user_role = $_POST['user_role'];
        $mobilenumber = $_POST['mobilenumber'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
    
        //echo $first_name . " " . $last_name;

        $user_img = $_FILES['uImage']['name'];
        $user_tmp = $_FILES['uImage']['tmp_name'];
        
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
        $result = mysqli_query($conn, $check_mobilenumber_email);
        $user = mysqli_fetch_assoc($result);
        if ($user) { // if user exists
            if ($user['mobilenumber'] === $mobilenumber) {
                $mobilenumber_err = '<div class="text-danger">
                    Mobile number already exists.
                </div>';
            }
            if ($user['email'] === $email) {
                $email_err = '<div class="text-danger">
                    Email already exists.
                </div>';
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
                        $mobilenumber_err = '<div class="text-danger">
                            This mobile number is already taken.
                        </div>';
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
            $password_err = '<div class="text-danger">
                Please enter a password.
            </div>';     
        } elseif(strlen(trim($_POST["password"])) < 6){
            $password_err = '<div class="text-danger">
                Password must have atleast 6 characters.
            </div>';  
        } else{
            $password = trim($_POST["password"]);
        }
        
        // ===== 4. Validate confirm password =====
        if(empty(trim($_POST["confirm_password"]))){
            $confirm_password_err = '<div class="text-danger">
                Please confirm password.
            </div>'; 
        } else{
            $confirm_password = trim($_POST["confirm_password"]);
            if(empty($password_err) && ($password != $confirm_password)){
                $confirm_password_err = '<div class="text-danger">
                    Password did not match.
                </div>';
            }
        }
    
        // insert user information into the users table
        //$query = "INSERT INTO dsa_users (username, userpassword, firstname, lastname, email, user_role, profile_image) 
            //VALUES ('$user_name', '$user_password', '$first_name', '$last_name', '$user_email', '$user_role', //'$user_img')";
        //$result = mysqli_query($conn, $query);
        
    // Check input errors before inserting in database [insert if there are no errors]
    if(empty( $firstname_err) && empty( $lastname_err) && empty( $email_err) && empty( $mobilenumber_err) &&  empty($password_err) && empty($confirm_password_err)){
        
        // Add user information into the users table
        $add_user = "INSERT INTO peri_users (firstname, lastname, email, mobilenumber, userpassword, profile_image, user_role) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        if($stmt = mysqli_prepare($conn, $add_user)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssss", $param_firstname, $param_lastname, $param_email, $param_mobilenumber, $param_password, $param_profileimg, $param_userrole);
          
            // Set parameters
            $param_firstname = $firstname;
            $param_lastname = $lastname;
            $param_email = $email;
            $param_mobilenumber = $mobilenumber;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_profileimg = $user_img;
            $param_userrole = $user_role;
          
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
          
                // email activation
                // ....
                
                echo '
                    <div class="alert alert-success" role="alert">
                        Record has been saved in the database.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    			<span aria-hidden="true">&times;</span>
			    		</button>
                    </div>';
                move_uploaded_file($user_tmp, "./assets/img/user/$user_img");
                
                // Store data in session variables
                //$_SESSION['firstname'] = $firstname;
                //$_SESSION['lastname'] = $lastname;
                //$_SESSION['email'] = $email;
                //$_SESSION['success'] = "You are now logged in";
                
                // Redirect to login page
                //header("location: sign-in.php");
            } else{
                echo '
                    <div class="alert alert-success" role="alert">
                        Something went wrong.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    			<span aria-hidden="true">&times;</span>
			    		</button>
                    </div>';
            }
          
          // Close statement
          mysqli_stmt_close($stmt);
        }
    }
      
    // Close connection
    mysqli_close($conn);    
        
    //     if($result){
    //         echo '
    //             <div class="alert alert-success" role="alert">
    //                 Record has been saved in the database
    //                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				// 		<span aria-hidden="true">&times;</span>
				// 	</button>
    //             </div>';
    //         move_uploaded_file($user_tmp, "./assets/img/user/$user_img");
    //     } else {
    //         echo "Query Failed!";
    //     }
        
    }
?>

<!-- Add New User -->
<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="">First Name</label>
        <input type="text" name="firstname" placeholder="First Name" class="form-control">
        <span class="help-block"><?php echo $firstname_err; ?></span>
    </div>

    <div class="form-group">
        <label for="">Last Name</label>
        <input type="text" name="lastname" placeholder="Last Name" class="form-control">
        <span class="help-block"><?php echo $lastname_err; ?></span>
    </div>

    <div class="form-group">
        <label for="">User Role</label>
        <select name="user_role" id="" class="form-control">
            <option value="customer" id="">Customer</option>
            <option value="admin" id="">Admin</option>
        </select>
    </div>

    <div class="form-group">
        <label for="">Mobile Number</label>
        <input type="text" name="mobilenumber" placeholder="Mobile Number" class="form-control">
         <span class="help-block"><?php echo $mobilenumber_err; ?></span>
    </div>

    <div class="form-group">
        <label for="">User Image</label>
        <input type="file" name="uImage" class="form-control-file">
    </div>

    <div class="form-group">
        <label for="">User Email</label>
        <input type="email" name="email" placeholder="User Email" class="form-control">
        <span class="help-block"><?php echo $email_err; ?></span>
    </div>

    <div class="form-group">
        <label for="">User Password</label>
        <input type="password" name="password" placeholder="Password" class="form-control">
        <span class="help-block"><?php echo '<p class="text-danger">' .$password_err. '</p>'; ?></span>
    </div>
    
    <div class="form-group">
        <label for="">Confirm User Password</label>
        <input type="password" name="confirm_password" id="cpassword" placeholder="Confirm Password" class="form-control">
        <span class="help-block"><?php echo '<p class="text-danger">' .$confirm_password_err. '</p>'; ?></span>
    </div>

    <div class="form-group">
        <input type="submit" name="btn_add_user" class="btn btn-md btn-primary" value="Add User">
    </div>
</form>