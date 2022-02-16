<?php 
    include 'views/head.php'; 
	
	//connect to database
    include_once('database/connect.php');
	// Collect client loan details using their id and display in the respective input fields. 
    $cust_query = "SELECT * FROM peri_users WHERE mobilenumber = '$mobileNumber'";
    $result = mysqli_query($conn, $cust_query);
    
    while($customer = mysqli_fetch_assoc($result)) {
        $customer_id = $customer['id'];
        $firstname = $customer['firstname'];
        $middlename = $customer['middlename'];
        $lastname = $customer['lastname'];
        $avatar = $customer['profile_image'];
        $mobileno = $customer['mobilenumber'];
        $email = $customer['email'];
        $idno = $customer['idno'];
        $occupation = $customer['occupation'];
        $gender = $customer['gender'];
        $dob = $customer['dob'];
        $address = $customer['address'];
        $city_town = $customer['city'];       
        $province = $customer['state'];        
    }              
?>

<body class="sidebar-fixed sidebar-dark header-fixed header-light" id="body">
<div class="mobile-sticky-body-overlay"></div>
  <div class="wrapper">
  	<?php include 'views/sidebar_without_footer.php'; ?>
      
    <div class="page-wrapper">
      <?php include 'views/header.php'; ?>

      <div class="content-wrapper">
        <div class="content">							
          <div class="bg-white border rounded">
						<div class="row no-gutters">
							<div class="col-lg-4 col-xl-3">
								<div class="profile-content-left pt-5 pb-3 px-3 px-xl-5">
									<div class="card text-center widget-profile px-0 border-0">
										<div class="card-img mx-auto rounded-circle">
											<img src="assets/img/user/<?php echo htmlspecialchars($_SESSION["userImg"]); ?>" alt="user image">
										</div>
										<div class="card-body">
											<h4 class="py-2 text-dark"><?php echo htmlspecialchars($_SESSION["fullName"]); ?></h4>
											<p><?php echo htmlspecialchars($_SESSION["email"]); ?></p>
											<!--<a class="btn btn-primary btn-pill btn-lg my-4" href="#">Follow</a>-->
										</div>
									</div>
									<hr class="w-100">
									<div class="contact-info pt-4">
										<h5 class="text-dark mb-1">Contact Information</h5>
										<p class="text-dark font-weight-medium pt-4 mb-2">Email address</p>
										<p><?php echo htmlspecialchars($_SESSION["email"]); ?></p>
										<p class="text-dark font-weight-medium pt-4 mb-2">Phone Number</p>
										<p><?php echo $mobileNumber; ?></p>
										<p class="text-dark font-weight-medium pt-4 mb-2">Birthday</p>
										<p>Nov 15, 1990</p>
										<p class="text-dark font-weight-medium pt-4 mb-2">Social Profile</p>
										<p class="pb-3 social-button">
											<a href="#" class="mb-1 btn btn-outline btn-twitter rounded-circle">
												<i class="mdi mdi-twitter"></i>
											</a>
											<a href="#" class="mb-1 btn btn-outline btn-linkedin rounded-circle">
												<i class="mdi mdi-linkedin"></i>
											</a>
											<a href="#" class="mb-1 btn btn-outline btn-facebook rounded-circle">
												<i class="mdi mdi-facebook"></i>
											</a>
											<a href="#" class="mb-1 btn btn-outline btn-skype rounded-circle">
												<i class="mdi mdi-skype"></i>
											</a>
										</p>
									</div>
								</div>
							</div>
							<div class="col-lg-8 col-xl-9">
								<div class="profile-content-right py-5">
									<ul class="nav nav-tabs px-3 px-xl-5 nav-style-border" id="myTab" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" id="timeline-tab" data-toggle="tab" href="#timeline" role="tab" aria-controls="timeline" aria-selected="true">Personal Info</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Change Avatar</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">Change Password</a>
										</li>
									</ul>
									<div class="tab-content px-3 px-xl-5" id="myTabContent">
										<div class="tab-pane fade show active" id="timeline" role="tabpanel" aria-labelledby="timeline-tab">
										    
										    <!-- Update Perosonal Details Form -->
  							                <form id="form_to_submit" action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $_GET['id']; ?>" method="POST" enctype="multipart/form-data" class="form-group">
  							    
  							                    <div class="row pt-4">
						                            <?php
                                                    // Edit(Update) personal details in the peri_users table using the mobile number session.
                                                    if(isset($_POST['update_details'])) {
                                                        // Collect personal details
                                                        $firstName = $_POST['firstname'];
                                                        $middleName = $_POST['middlename'];
                                                        $lastName = $_POST['lastname'];
                                                        $mobileNo = $_POST['mobileno'];
                                                        $emailId = $_POST['email']; 
                                                        $idNo = $_POST['idno']; 
                                                        $occupation = $_POST['occupation']; 
                                                        $sex = $_POST['gender'];
                                                        $dateOfBirth = $_POST['dob'];
                                                        $street = $_POST['address'];
                                                        $townCity = $_POST['town_city'];
                                                        $state = $_POST['province'];

                                                        // update personal details
                                                        $update_query = "UPDATE peri_users SET firstname = '$firstName', middlename = '$middleName', lastname='$lastName', mobilenumber = '$mobileNo', email='$emailId',  idno = '$idNo', occupation = '$occupation', gender = '$sex', dob = '$dateOfBirth', address = '$street', city ='$townCity', state = '$state' WHERE mobilenumber = '$mobileNumber'";
                                        
                                                        $update_result = mysqli_query($conn, $update_query);
                 
                                                        // check update result and notify
                                                        if($update_result) {
                                                            echo '
                                                                <div class="alert alert-success" role="alert">
                                                                    Client loan details have been updated in the database
                                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    		                                            		<span aria-hidden="true">&times;</span>
		    		                                            	</button>
                                                                </div>';
                                            
                                                            header("location: user-profile.php");
                                        
                                                        } else {
                                                            echo "Something is wrong!" . mysqli_error($conn);
                                                        }  
                                                    }
                                                    ?>
                                                    <div class="col-sm-12 col-md-6">
  							                            <!-- First Name -->
  							                            <label class="text-dark mt-0">First Name</label>
  								                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="mdi mdi-account-outline"></i>
                                                                </span>
                                                            </div>
  								                            <input type="hidden" name="id" value="<?php echo $GET['id']; ?>"/>
  								            
								                            <input type="text" name="firstname" value="<?php echo $firstname; ?>" placeholder="John" class="form-control">
								                            <span class="help-block"><?php //echo $firstname_err; ?></span>
								                        </div>
                                                    
								                        <!-- Middle Name -->
  							                            <label class="text-dark mt-0">Middle Name</label>
  								                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="mdi mdi-account-outline"></i>
                                                                </span>
                                                            </div>
								                        	<input type="text" placeholder="Chona" value="<?php echo $middlename; ?>" name="middlename" class="form-control">
								                        	<span class="help-block"><?php //echo $middlename_err; ?></span>
								                        </div>
								                        
								                        <!-- Last Name -->
  							                            <label class="text-dark mt-0">Last Name</label>
  								                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="mdi mdi-account-outline"></i>
                                                                </span>
                                                            </div>
								                        	<input type="text" placeholder="Muchona" value="<?php echo $lastname; ?>" name="lastname" class="form-control">
								                        	<span class="help-block"><?php //echo $lastname_err; ?></span>
								                        </div>
  							        
								                        <!-- Mobile Number -->
  								                        <label for="mobileno">Mobile No.</label>
  								                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="mdi mdi-phone"></i>
                                                                </span>
                                                            </div>
								                        	<input type="text" name="mobileno" value="<?php echo $mobileno; ?>" class="form-control" placeholder="(260) 975-651046">
								                        	<span class="help-block"><?php //echo $mobileno_err; ?></span>
  							                            </div>
  							        
								                        <!-- Email -->
								                        <label for="email">Email</label>
  								                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="mdi mdi-account-outline"></i>
                                                                </span>
                                                            </div>
								                        	<input type="email" name="email" value="<?php echo $email; ?>" class="form-control" placeholder="johnm@gmail.com">
								                        	<span class="help-block"><?php //echo $email_err; ?></span>
								                        </div> 
								    
								                        <!-- Identity No. -->
								                        <label for="loantype">Identity No.</label>
  								                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="mdi mdi-security-account-outline"></i>
                                                                </span>
                                                            </div>
								                        	<input type="text" name="idno" value="<?php echo $idno; ?>" class="form-control" placeholder="341905/82/1">
								                        	<span class="help-block"><?php //echo $idno_err; ?></span>
								                        </div> 
                                                    </div>
                                                    <!-- /End Column One -->
                                                    
                                                    <!-- Column Two -->
                                                    <div class="col-sm-12 col-md-6">
								                        <!-- Occupation -->
  							                            <label class="text-dark mt-0">Occupation</label>
  								                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="mdi mdi-briefcase"></i>
                                                                </span>
                                                            </div>
								                        	<input type="text" placeholder="Accountant" value="<?php echo $occupation; ?>" name="occupation" class="form-control">
								                        	<span class="help-block"><?php //echo $occupation_err; ?></span>
								                        </div>
								                        
  							                            <!-- Gender -->
                                                        <label for="">Gender</label>
  							                            <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="mdi mdi-human-male-male"></i>
                                                                </span>
                                                            </div>
                                                            <select name="gender" id="form_gender" class="form-control">
                                                                <option value="male" id="">Male</option>
                                                                <option value="female" id="">Female</option>
                                                            </select>
                                                        </div>
  							        
  							                            <!-- Date of Birth -->
  							                            <label for="">Date of Birth</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="fas fa-calendar-day"></i>
                                                                </span>
                                                            </div>
                                                            <input type="date" value="<?php echo $dob; ?>" id="form_dob" name="dob" class="form-control">
                                                            <span class="help-block"><?php //echo $dob_err; ?></span>
                                                        </div>
  							        
  							                            <!-- Address -->
                                                        <label for="address">Address</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="mdi mdi-city-variant-outline"></i>
                                                                </span>
                                                            </div>
                                                            <input type="text" id="form_address" value="<?php echo $address; ?>" name="address" placeholder="Plot 23, Nsombo Rd, Kaunda Square" class="form-control">
                                                            <span class="help-block"><?php //echo $address_err; ?></span>
                                                        </div>
  							        
  							                            <!-- City / Town -->
  							                            <label for="">Town/City</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="mdi mdi-city-variant-outline"></i>
                                                                </span>
                                                            </div>
                                                            <input type="text" id="form_city" value="<?php echo $city_town; ?>" name="town_city" placeholder="Lusaka" class="form-control">
                                                            <span class="help-block"><?php //echo $town_city_err; ?></span>
                                                        </div>
  							        
  							                            <!-- State -->
  							                            <label for="province">Province</label>
                                                        <div class="input-group">
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
                                                            <span class="help-block"><?php //echo $province_err; ?></span>
                                                        </div>
                                                    </div>
  							                        <!-- Submit Button -->
  							                        <div class="col-sm-12">
								                        <div class="form-group mt-2">
                            	                        	<input type="submit" name="update_details" style="" class="btn btn-primary" value="Update Details" onclick="">
                        		                        </div>
  							                        </div>
  							        
  							                   </div>
							                </form>
											
										</div>
										
										<!-- Change Avatar Content -->
										<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                            <?php 
                                            // Edit(Update) user in the users table using the userID
                                            if(isset($_POST['btn_update_user'])) {
        
                                                $userImg = $_FILES['image']['name'];
                                                $userTmp = $_FILES['image']['tmp_name'];

                                                // updating the image in the db
                                                if(empty($userImg)) {
                                                    $userImg = $user_image;
                                                }

                                                // update user
                                                $update_query = "UPDATE peri_users SET avatar = '$userImg' WHERE mobilenumber = '$mobileNumber'";
                                                $update_result = mysqli_query($conn, $update_query);

                                                // check update result and notify
                                                if($update_result) {
                                                    // move image from database to local folder
                                                    move_uploaded_file($userTmp, "./assets/img/user/" . $userImg);
                                                    echo '
                                                        <div class="alert alert-success" role="alert">
                                                            Record has been updated in the database
                                                        </div>
                                                        ';
                                                    header("location: users.php");
                                                } else {
                                                    echo "Something is wrong!" . mysqli_error($conn);
                                                }                   
                                            }
                                            ?>

                                            <!-- Update Avatar -->
                                            <form action="" method="POST" enctype="multipart/form-data">

                                                <div class="form-group">
                                                    <img width="150" height="120" class="img-responsive mt-3 mb-1" src="./assets/img/user/<?= $avatar ?>">
                                                    <input type="file" name="image" class="form-control-file mt-2">
                                                </div>

                                                <div class="form-group">
                                                    <input type="submit" name="btn_update_avatar" class="btn btn-primary" value="Change Avatar">
                                                </div>
                                            </form>
										</div>
										
										<!-- Change Avatar Content -->
										<div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
										    
										    <!-- Update Perosonal Details Form -->
  							                <form id="form_to_submit" action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $_GET['id']; ?>" method="POST" enctype="multipart/form-data" class="form-group">
  							    
  							                    <div class="row pt-4">
						                            <?php
                                                    // Edit(Update) personal details in the peri_users table using the mobile number session.
                                                    if(isset($_POST['update_password'])) {
                                                        // Collect personal details
                                                        $oldPassword = $_POST['oldpass'];
                                                        $newPassword = $_POST['newpass'];
                                                        $confirmNewPassword = $_POST['confirm'];

                                                        // update personal details
                                                        $update_query = "UPDATE peri_users SET firstname = '$firstName', middlename = '$middleName', lastname='$lastName' WHERE mobilenumber = '$mobileNumber'";
                                        
                                                        $update_result = mysqli_query($conn, $update_query);
                 
                                                        // check update result and notify
                                                        if($update_result) {
                                                            echo '
                                                                <div class="alert alert-success" role="alert">
                                                                    Client loan details have been updated in the database
                                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    		                                            		<span aria-hidden="true">&times;</span>
		    		                                            	</button>
                                                                </div>';
                                            
                                                            header("location: user-profile.php");
                                        
                                                        } else {
                                                            echo "Something is wrong!" . mysqli_error($conn);
                                                        }  
                                                    }
                                                    ?>
                                                    <div class="col-sm-12 col-md-12">
  							                            <!-- Old Password -->
  							                            <label class="text-dark mt-0">Current Password</label>
  								                        <div class="form-group">
  								                            <input type="hidden" name="id" value="<?php echo $GET['id']; ?>"/>
  								            
								                            <input type="text" name="oldpass" class="form-control">
								                            <span class="help-block"><?php //echo $oldpass_err; ?></span>
								                        </div>
                                                    
								                        <!-- New Password -->
  							                            <label class="text-dark mt-0">New Password</label>
  								                        <div class="form-group">
								                        	<input type="text" name="newpass" class="form-control">
								                        	<span class="help-block"><?php //echo $newpass_err; ?></span>
								                        </div>
								                        
								                        <!-- Confirm New Password -->
  							                            <label class="text-dark mt-0">Re-type New Password</label>
  								                        <div class="form-group">
								                        	<input type="text" name="confirm" class="form-control">
								                        	<span class="help-block"><?php //echo $lastname_err; ?></span>
								                        </div>
                                                    </div>
                                                    <!-- /End Column One -->
                                                    
  							                        <!-- Submit Button -->
  							                        <div class="col-sm-12">
								                        <div class="form-group mt-2">
                            	                        	<input type="submit" name="update_password" style="" class="btn btn-primary" value="Change Password" onclick="">
                        		                        </div>
  							                        </div>
  							        
  							                   </div>
							                </form></div>
									</div>
								</div>
							</div>
						</div>
          </div><!-- END ROW -->
        </div><!-- end content -->
      </div><!-- end content-wrapper -->
<?php include 'views/footer.php'; ?>
