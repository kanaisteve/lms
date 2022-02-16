<?php
// Define variables and initialize with empty values
$firstname = $lastname = $email = $mobilenumber = $loantype = $company = $profession = $salary = $gender = $dob = $town_city = $province = $img = "";
$firstname_err = $lastname_err = $email_err = $mobilenumber_err = $loantype_err  = $company_err = $profession_err = $salary_err = $gender_err = $dob_err = $town_city_err = $province_err = $img_err = "";
 
// Set empty form vars for validation mapping
$_first_name = $_last_name = $_email = $_mobile_number = $_loantype = $_company = $_profession = $_salary = $_gender = $_dob = $_town_city = $_province = $_img = "";

// Processing form data when form is submitted
if(isset($_POST["btn_add_applyloan"])) {
    // ===== collect user form data ======
    $firstname = trim($_POST["firstname"]);
    $lastname = trim($_POST["lastname"]);
    $email = trim($_POST['email']);
    $mobilenumber = $_POST['mobilenumber'];
    $profession = $_POST['profession'];
    $company = $_POST['company'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $town_city = $_POST['town_city'];
    $province = $_POST['province'];

    $user_img = $_FILES['uImage']['name'];
    $user_tmp = $_FILES['uImage']['tmp_name'];

  // ===== verify if form values are not empty =====
  if(!empty($firstname) && !empty($lastname) && !empty($email) && !empty($mobilenumber) && !empty($profession) && !empty($company) && !empty($town_city) && !empty($province)){
    // clean the form data before sending to database
    $_first_name = mysqli_real_escape_string($conn, $firstname);
    $_last_name = mysqli_real_escape_string($conn, $lastname);
    $_email = mysqli_real_escape_string($conn, $email);
    $_mobile_number = mysqli_real_escape_string($conn, $mobilenumber);
    $_profession = mysqli_real_escape_string($conn, $profession);
    $_company = mysqli_real_escape_string($conn, $company);
    $_town_city = mysqli_real_escape_string($conn, $town_city);
    $_province = mysqli_real_escape_string($conn, $province);
    $_img = mysqli_real_escape_string($conn, $img);

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
    // if(empty($profession)){
    //     // professionEmptyErr 
    //     $profession_err = '<div class="text-danger">
    //         Profession can not be blank.
    //     </div>';
    // }
    
    // if(empty($company)){
    //     // companyEmptyErr 
    //     $company_err = '<div class="text-danger">
    //         Company can not be blank.
    //     </div>';
    // } 
    
    // if(empty($town_city)){
    //     // town_cityEmptyErr 
    //     $company_err = '<div class="text-danger">
    //         Town or City can not be blank.
    //     </div>';
    // } 
  }
 
  // ============================== BASIC VALIDATION ==================== 
  // first check the database to make sure
  // a user does not already exist with the same username and/or email
  $check_mobilenumber_email = "SELECT * FROM kt_contacts WHERE mobilenumber ='$mobilenumber' OR email='$email' LIMIT 1";
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
      $check_mobilenumber = "SELECT id FROM kt_contacts WHERE mobilenumber = ?";
      
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
  
  // Check input errors before inserting in database [insert if there are no errors]
  if(empty( $firstname_err) && empty( $lastname_err) && empty( $email_err) && empty( $mobilenumber_err)){
      
    // Add contact into the kt_contacts table
    $add_contact = "INSERT INTO kt_contacts (firstname, lastname, email, mobilenumber, profession, company, gender, dob, town_city, state, profile_img) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    if($stmt = mysqli_prepare($conn, $add_contact)){
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "sssssssssss", $param_firstname, $param_lastname, $param_email, $param_mobilenumber, $param_profession, $param_comapany, $param_city, $param_state, $param_gender, $param_dob, $param_img);
      
      // Set parameters
      $param_firstname = $firstname;
      $param_lastname = $lastname;
      $param_email = $email;
      $param_mobilenumber = $mobilenumber;
      $param_profession = $profession;
      $param_company = $company;
      $param_city = $town_city;
      $param_state = $province;
      $param_gender = $gender;
      $param_dob = $dob;
      $param_img = $user_img;
      
      // Attempt to execute the prepared statement
      if(mysqli_stmt_execute($stmt)){
        // Redirect to login page
            echo '
                <div class="alert alert-success" role="alert">
                    Contact has been saved in the database
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
                </div>';
            move_uploaded_file($user_tmp, "./assets/img/contacts/$user_img");
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

<?php include 'views/head.php'; ?>
<body class="sidebar-fixed sidebar-dark header-fixed header-light" id="body">
<div class="mobile-sticky-body-overlay"></div>
  <div class="wrapper">
    <?php include 'views/sidebar_without_footer.php'; ?>

    <div class="page-wrapper">
      <?php include 'views/header.php'; ?>

      <div class="content-wrapper">
        <div class="content">							
    <!--    	<div class="breadcrumb-wrapper">-->
				<!--<h1>Records</h1>	-->
    <!--    		<nav aria-label="breadcrumb">-->
    <!--    			<ol class="breadcrumb p-0">-->
    <!--    				<li class="breadcrumb-item">-->
    <!--    					<a href="index.html">-->
    <!--    						<span class="mdi mdi-home"></span>                -->
    <!--    					</a>-->
    <!--    				</li>-->
    <!--    				<li class="breadcrumb-item">View All Records</li>-->
    <!--    			</ol>-->
    <!--    		</nav>-->
    <!--    	</div> -->

			<div class="row">
				<div class="col-lg-12">
					<div class="card card-default">
						<div class="card-header card-header-border-bottom">
							<h2>Apply For Loan</h2>
						</div>
	
						<div class="card-body" style="overflow-y: auto;">
						    <!-- Apply for new loan -->
                            <form id="form_to_submit" action="" method="POST" enctype="multipart/form-data">
                                <!-- Customer Name -->
                                <label class="text-dark mt-0 font-weight-medium">Customer Name</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-account-outline"></i>
                                        </span>
                                    </div>
                                    <input type="text" id="form_idno" name="idno" class="form-control">
                                    <span class="help-block"><?php echo $mobilenumber_err; ?></span>
                                </div>
                                <p style="font-size: 90%">ex. John Muchona</p>
                                
                                <!-- NRC No. -->
                                <label class="text-dark mt-4 font-weight-medium">Identity No.</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-security-account-outline"></i>
                                        </span>
                                    </div>
                                    <input type="text" id="form_idno" name="idno" class="form-control">
                                    <span class="help-block"><?php echo $mobilenumber_err; ?></span>
                                </div>
                                <p style="font-size: 90%">ex. 341905/82/1</p>
                                
                                <!-- Mobile Number -->
                                <label class="text-dark mt-4 font-weight-medium">Mobile Number</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-phone"></i>
                                        </span>
                                    </div>
                                    <input type="text" id="form_number" name="mobileno" class="form-control" data-mask="(260) 975-651046" maxlength="14">
                                    <span class="help-block"><?php echo $mobilenumber_err; ?></span>
                                </div>
                                <p style="font-size: 90%">ex. (260) 975-651046</p>
                                
                                <!-- Email -->
                                <label class="text-dark mt-4 font-weight-medium">Email</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-email-outline"></i>
                                        </span>
                                    </div>
                                    <input type="text" id="form_email" name="email" class="form-control">
                                    <span class="help-block"><?php echo $email_err; ?></span>
                                </div>
                                <p style="font-size: 90%">ex. johnk@gmail.com</p>
    
                                <!-- Loan Type -->
                                <label class="text-dark mt-4 font-weight-medium">Loan Type</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-timetable"></i>
                                        </span>
                                    </div>
                                    <input type="text" id="form_loantype" name="loantype" class="form-control">
                                    <span class="help-block"><?php echo $loantype_err; ?></span>
                                </div>
                                <p style="font-size: 90%">ex. House Loan</p>
    
                                <!-- Loan Amount -->
                                <label class="text-dark mt-4 font-weight-medium">Loan Amount</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="font-size: 60%">
                                            ZMW
                                        </span>
                                    </div>
                                    <input type="text" id="form_loanamount" name="loanamount" class="form-control">
                                    <span class="help-block"><?php echo $loantype_err; ?></span>
                                </div>
                                <p style="font-size: 90%">ex. 10000</p>
    
                                <!-- Loan Duration -->
                                <label class="text-dark mt-4 font-weight-medium">Loan Duration</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="font-size: 100%">
                                            <i class="mdi mdi-timer"></i>
                                        </span>
                                    </div>
                                    <input type="text" id="form_duration" name="duration" class="form-control">
                                    <span class="help-block"><?php echo $loantype_err; ?></span>
                                </div>
                                <!--<p style="font-size: 90%">ex. 10000</p>-->
    
                                <!-- Loan Rate -->
                                <label class="text-dark mt-4 font-weight-medium">Loan Rate</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="font-size: 100%">
                                            %
                                        </span>
                                    </div>
                                    <input type="text" id="form_duration" name="duration" class="form-control">
                                    <span class="help-block"><?php echo $loantype_err; ?></span>
                                </div>
                                <!--<p style="font-size: 90%">ex. 10000</p>-->
    
                                <!-- Loan Rate -->
                                <label class="text-dark mt-4 font-weight-medium">Collateral Value</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="font-size: 60%">
                                            ZMW
                                        </span>
                                    </div>
                                    <input type="text" id="form_duration" name="duration" class="form-control">
                                    <span class="help-block"><?php echo $loantype_err; ?></span>
                                </div>
                                <p style="font-size: 90%">ex. 5000</p>
                                
                                <!-- Gender -->
                                <label class="text-dark mt-4 font-weight-medium">Gender</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <!--<i class="mdi mdi-account-search-outline"></i>-->
                                            <i class="mdi mdi-human-male-male"></i>
                                        </span>
                                    </div>
                                     <select name="gender" id="form_gender" class="form-control">
                                        <option value="male" id="">Male</option>
                                        <option value="female" id="">Female</option>
                                    </select>
                                    <span class="help-block"><?php echo $mobilenumber_err; ?></span>
                                </div>
                                
                                <!-- Date of Birth -->
                                <label class="text-dark mt-4 font-weight-medium">Date of Birth</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-calendar-day"></i>
                                        </span>
                                    </div>
                                    <input required type="date" id="form_dob" name="dob" class="form-control">
                                    <span class="help-block"><?php echo $dob_err; ?></span>
                                </div>
    
                                <!-- City / Town -->
                                <label class="text-dark mt-4 font-weight-medium">City / Town</label></label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-city-variant-outline"></i>
                                        </span>
                                    </div>
                                    <input required type="text" id="form_city" name="town_city" class="form-control">
                                    <span class="help-block"><?php echo $town_city_err; ?></span>
                                </div>
                                <p style="font-size: 90%">ex. Lusaka</p>
                                
                                <!-- State -->
                                <label class="text-dark mt-4 font-weight-medium">Province</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-domain"></i>
                                        </span>
                                    </div>
                                    <select name="province" id="form_province" class="form-control">
                                        <option value="Lusaka" id="">Lusaka</option>
                                        <option value="Copperbelt" id="">Copperbelt</option>
                                        <option value="Central" id="">Central</option>
                                        <option value="Southern" id="">Southern</option>
                                        <option value="Western" id="">Western</option>
                                        <option value="North-Western" id="">North-Western</option>
                                        <option value="Eastern" id="">Eastern</option>
                                        <option value="Northern" id="">Northern</option>
                                        <option value="Luapula" id="">Luapula</option>
                                        <option value="Muchinga" id="">Muchinga</option>
                                    </select>
                                    <span class="help-block"><?php echo $province_err; ?></span>
                                </div>
    
                                <!-- Employer -->
                                <label class="text-dark mt-4 font-weight-medium">Employer</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-city"></i>
                                        </span>
                                    </div>
                                    <input required type="text" id="form_company" name="company" class="form-control">
                                    <span class="help-block"><?php echo $company_err; ?></span>
                                </div>
                                <p style="font-size: 90%">ex. Kanai Technologies LLC</p>
    
                                <!-- Job Title -->
                                <label class="text-dark mt-4 font-weight-medium">Job Title</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-briefcase"></i>
                                        </span>
                                    </div>
                                    <input required type="text" id="form_profession" name="profession" class="form-control">
                                    <span class="help-block"><?php echo $profession_err; ?></span>
                                </div>
                                <p style="font-size: 90%">ex. Software Developer</p>
    
                                <!-- Salary -->
                                <label class="text-dark mt-4 font-weight-medium">Salary</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="font-size: 60%">
                                            ZMW
                                        </span>
                                    </div>
                                    <input type="text" id="form_salary" name="salary" class="form-control">
                                    <span class="help-block"><?php echo $salary_err; ?></span>
                                </div>
                                <p style="font-size: 90%">ex. 10000</p>
                                
                                <!-- Upload NRC Front -->
                                <label class="text-dark mt-4 font-weight-medium">NRC Front</label>
                                <div class="form-group">
                                    <input type="file" name="idfront" class="form-control-file">
                                </div>
                                
                                <!-- Upload NRC Back -->
                                <label class="text-dark mt-2 font-weight-medium">NRC Back</label>
                                <div class="form-group">
                                    <input type="file" name="idback" class="form-control-file">
                                </div>
                                
                                <!-- Upload Collateral -->
                                <label class="text-dark mt-2 font-weight-medium">Collateral</label>
                                <div class="form-group">
                                    <input type="file" name="collateral" class="form-control-file">
                                </div>
                                
                                <!-- Upload Pay Slip -->
                                <label class="text-dark mt-2 font-weight-medium">Pay Slip</label>
                                <div class="form-group">
                                    <input type="file" name="payslip" class="form-control-file">
                                </div>
                                
                                <div class="form-group mt-2">
                                    <input name="btn_add_applyloan" style="background-color:#dc3545; color:#fff" class="btn" value="Apply for Loan" onclick="add_confirm()">
                                </div>
                            </form>
						</div>	
					</div>
				</div>
			</div> 					
        </div><!-- end content -->
      </div><!-- end content-wrapper -->
<?php include 'views/footer.php'; ?>

<script type="text/javascript">
    function add_confirm(){
        var a = document.getElementById('form_firstname').value;
        var b = document.getElementById('form_lastname').value;
        var c = document.getElementById('form_number').value;
        var d = document.getElementById('form_gender').value;
        var e = document.getElementById('form_city').value;
        var f = document.getElementById('form_province').value;
        var g = "Full Name: " + a +" "+ b + '\n' + "Mobile No: " + c+'\n' + "Gender: " + d +'\n'+ "Town/City: " + e +'\n'+ "Province: " + f;
        
     var r = confirm(g);   
     if(r == true){
         document.getElementById('form_to_submit').submit();
     }
     
    }
</script>