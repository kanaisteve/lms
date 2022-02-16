<?php 
    include 'views/head.php';
    include_once 'libs/users.php';
    $userObj = new Users();
    
    // Collect client details using their mobileno 
    $customer = $userObj->getUserByMobileNo($mobileNumber);
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
											<img src="assets/img/avatar/<?= $customer['avatar'] ?>" alt="user image">
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
										<p class="text-dark font-weight-medium pt-4 mb-2">UserId</p>
										<p><?php echo $userId; ?></p>
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
											<a class="nav-link" id="id-tab" data-toggle="tab" href="#id" role="tab" aria-controls="id" aria-selected="false">Upload ID</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">Change Password</a>
										</li>
									</ul>
									<div class="tab-content px-3 px-xl-5" id="myTabContent">
										<div class="tab-pane fade show active" id="timeline" role="tabpanel" aria-labelledby="timeline-tab">
										    
										    <!-- Update Perosonal Details Form -->
  							                <form id="form_to_submit" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" class="form-group">
  							    
  							                    <div class="row pt-4">
						                            <?php
                                                    /* Edit(Update) personal details in the lms_users table using the mobile number session. */
                                                    if(isset($_POST['update_details'])) {
                                                        $details = $userObj->updateProfile($_POST);
                                                        if($details){
                                                            header("location: user-profile.php");
                                                        } else {
                                                            return $details;
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
  								            
								                            <input type="text" name="firstname" value="<?php echo $customer['firstname']; ?>" placeholder="John" class="form-control">
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
								                        	<input type="text" placeholder="Chona" value="<?php echo $customer['middlename']; ?>" name="middlename" class="form-control">
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
								                        	<input type="text" placeholder="Muchona" value="<?php echo $customer['lastname']; ?>" name="lastname" class="form-control">
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
								                        	<input type="text" name="mobileno" value="<?php echo $customer['mobilenumber']; ?>" class="form-control" placeholder="(260) 975-651046">
								                        	<span class="help-block"><?php //echo $mobileno_err; ?></span>
  							                            </div>
  							                            
								                        <!-- Payment Number -->
  								                        <label for="mobileno">Payment No.</label>
  								                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="mdi mdi-phone"></i>
                                                                </span>
                                                            </div>
								                        	<input type="text" name="paymentno" value="<?php echo $customer['paymentnumber']; ?>" class="form-control" placeholder="(260) 975-651046">
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
								                        	<input type="email" name="email" value="<?php echo $customer['email']; ?>" class="form-control" placeholder="johnm@gmail.com">
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
								                        	<input type="text" name="idno" value="<?php echo $customer['idno']; ?>" class="form-control" placeholder="341905/82/1">
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
								                        	<input type="text" placeholder="Accountant" value="<?php echo $customer['occupation']; ?>" name="occupation" class="form-control">
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
                                                            <select name="gender" id="form_gender" class="form-control" value="Female">
                                                                <option value="Male" id="" <?php if($customer['gender'] == 'Male'){echo("selected");}?>>Male</option>
                                                                <option value="Female" id="" >Female</option>
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
                                                            <input type="date" value="<?php echo $customer['dob']; ?>" id="form_dob" name="dob" class="form-control">
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
                                                            <input type="text" id="form_address" value="<?php echo $customer['address']; ?>" name="address" placeholder="Plot 23, Nsombo Rd, Kaunda Square" class="form-control">
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
                                                            <input type="text" id="form_city" value="<?php echo $customer['city']; ?>" name="town_city" placeholder="Lusaka" class="form-control">
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
                                                                    <option value="Lusaka" id="" <?php if($customer['state'] == 'Lusaka'){echo("selected");}?>>Lusaka</option>
                                                                    <option value="Copperbelt" id="" <?php if($customer['state'] == 'Copperbelt'){echo("selected");}?>>Copperbelt</option>
                                                                    <option value="Central" id="" <?php if($customer['state'] == 'Central'){echo("selected");}?>>Central</option>
                                                                    <option value="Southern" id="" <?php if($customer['state'] == 'Southern'){echo("selected");}?>>Southern</option>
                                                                    <option value="Western" id="" <?php if($customer['state'] == 'Western'){echo("selected");}?>>Western</option>
                                                                    <option value="North-Western" id="" <?php if($customer['state'] == 'North-Western'){echo("selected");}?>>North-Western</option>
                                                                    <option value="Eastern" id="" <?php if($customer['state'] == 'Eastern'){echo("selected");}?>>Eastern</option>
                                                                    <option value="Northern" id="" <?php if($customer['state'] == 'Northern'){echo("selected");}?>>Northern</option>
                                                                    <option value="Luapula" id="" <?php if($customer['state'] == 'Luapula'){echo("selected");}?>>Luapula</option>
                                                                    <option value="Muchinga" id="">Muchinga</option>
                                                                </select>
                                                            <span class="help-block"><?php //echo $province_err; ?></span>
                                                        </div>
                                                    </div>
  							                        <!-- Submit Button -->
  							                        <div class="col-sm-12">
								                        <div class="form-group mt-2">
  								                            <input type="hidden" name="id" value="<?php echo $customer['id']; ?>"/>
                            	                        	<input type="submit" name="update_details" style="background-color:#1976d2; color:#fff" class="btn" value="Update Details" onclick="">
                        		                        </div>
  							                        </div>
  							        
  							                   </div>
							                </form>
											
										</div>
										
										<!-- Change Avatar Content -->
										<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                            <?php 
                                                if (isset($_FILES['image']['name'])){
                                                    unlink("./assets/img/avatar/" . $customer['avatar']);
                                                }
                                                // Edit(Update) user in the users table using the userID
                                                if(isset($_POST['btn_update_avatar'])) {
                                                    $result = $userObj->changeAvatar($_POST, $mobileNumber);
                                                    if($result){
                                                        header("location: user-profile.php");
                                                    } else {
                                                        return $result;
                                                    }
                                                }
                                            ?>

                                            <!-- Update Avatar -->
                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">

                                                <div class="form-group">
                                                    <img width="150" height="120" class="img-responsive mt-3 mb-1" src="./assets/img/avatar/<?= $customer['avatar'] ?>">
                                                    <input type="file" name="image" class="form-control-file mt-2">
                                                </div>

                                                <!-- submit btn -->
                                                <div class="form-group">
                                                    <input type="submit" name="btn_update_avatar" class="btn btn-primary" value="Change Avatar">
                                                </div>
                                            </form>
										</div>
										
										<!-- Upload ID -->
										<div class="tab-pane fade" id="id" role="tabpanel" aria-labelledby="id-tab">
                                            <?php 
                                            // Edit(Update) id Photos in the users table using the userID
                                            if(isset($_POST['btn_update_id'])) {
                                                if (isset($_FILES['front']['name'])){
                                                    unlink("./assets/img/idPhotos/" . $customer['id_front']);
                                                }
                                                if (isset($_FILES['back']['name'])){
                                                    unlink("./assets/img/idPhotos/" . $customer['id_back']); 
                                                }
                                                
                                                $result = $userObj->uploadId($_POST, $mobileNumber);
                                                if($result){
                                                    header("location: user-profile.php");
                                                } else {
                                                    // display error msg or popup error msg
                                                    return $result;
                                                }           
                                            }
                                            ?>

                                            <!-- Update ID -->
                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">

                                                <div class="form-group">
                                                    <img width="150" height="120" class="img-responsive mt-3 mb-1" src="./assets/img/idPhotos/<?= $customer['id_front'] ?>">
                                                    <input type="file" name="front" class="form-control-file mt-2">
                                                </div>
                                                <div class="form-group">
                                                    <img width="150" height="120" class="img-responsive mt-3 mb-1" src="./assets/img/idPhotos/<?= $customer['id_back'] ?>">
                                                    <input type="file" name="back" class="form-control-file mt-2">
                                                </div>

                                                <!-- submit btn -->
                                                <div class="form-group">
                                                    <input type="submit" style="background-color:#1976d2; color:#fff" name="btn_update_id" class="btn" value="Upload ID">
                                                </div>
                                            </form>
										</div>
										
										<!-- Change Password -->
										<div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
						                    <?php
                                            if(isset($_POST['update_password'])) :
                                                // $result = $userObj->changePassword($_POST, $userId);
                                                // echo $result;
                                                
                                                echo $userObj->changePassword($_POST, $userId);
                                                // if($result){
                                                //     echo '<p>password update was successful</p>';
                                                // } else {
                                                //   echo '<p>password update failed</p>'; 
                                                // }
                                                // Get input fields
                                                // $newdata['old_password'] = $_POST['oldpass'];
                                                // $newdata['new_password'] = $_POST['newpass'];
                                                // $newdata['con_password'] = $_POST['confirm'];

                                                // // check if current password is correct
                                                // if ($newdata['new_password'] != "" && $newdata['old_password'] != "" && $newdata['con_password']) {
                                                //     if ($newdata['new_password'] == $newdata['con_password']) {
                                                //         if ($user->changePassword($customer['id'])) {
                                                //             $success = "Your new password updated successfully.";
                                                //         } else {
                                                //             $error = "Old Password is not match";
                                                //         }
                                                //     } else {
                                                //         $error = "New Password and confirm password do not match";
                                                //     }
                                                // } else {
                                                //     $error = "Please fill all fields";
                                                // }
                                            endif;
                                            ?>
										    
										    <!-- Update Perosonal Details Form -->
  							                <form id="form_to_submit" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" class="form-group">
  							    
  							                    <div class="row pt-4">
                                                    <div class="col-sm-12 col-md-12">
  							                            <!-- Old Password -->
  							                            <label class="text-dark mt-0">Current Password</label>
  								                        <div class="form-group">
								                            <input type="password" name="oldpass" class="form-control">
								                            <span class="help-block"><?php //echo $oldpass_err; ?></span>
								                        </div>
                                                    
								                        <!-- New Password -->
  							                            <label class="text-dark mt-0">New Password</label>
  								                        <div class="form-group">
								                        	<input type="password" name="newpass" class="form-control">
								                        	<span class="help-block"><?php //echo $newpass_err ?></span>
								                        </div>
								                        
								                        <!-- Confirm New Password -->
  							                            <label class="text-dark mt-0">Re-type New Password</label>
  								                        <div class="form-group">
								                        	<input type="password" name="confirmpass" class="form-control">
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
							                </form>
							            </div>
									</div>
								</div>
							</div>
						</div>
          </div><!-- END ROW -->
        </div><!-- end content -->
      </div><!-- end content-wrapper -->
<?php include 'views/footer.php'; ?>