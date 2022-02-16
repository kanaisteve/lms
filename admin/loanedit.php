<?php
    include 'views/head.php'; 
    $loantypes = "SELECT * FROM peri_loan_types";
    $loantype_result = $mysqli->query($loantypes); 
?>

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
							<h2>Edit Customer Details</h2>
						</div>
	
						<div class="card-body" style="overflow-y: auto;">
						    <!-- Apply for a loan form -->
  							<form id="form_to_submit" action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $_GET['id']; ?>" method="POST" enctype="multipart/form-data" class="form-group">
  							    
  							    <div class="row">
						        <?php
						        // Collect client loan details using their id and display in the respective input fields. 
						        if(isset($_GET['id'])) {
                                    $cust_ID = $_GET['id'];
                                    
                                    $cust_query = "SELECT * FROM lms_loans WHERE mobileno = '$cust_ID'";
                                    $result = $mysqli->query($cust_query);
                                    while($customer = mysqli_fetch_assoc($result)) :  
                                        $loanamount = $customer['loan_amount'];       
                                        $loanrate = $customer['loan_rate'];       
                                        $loanduration = $customer['loan_duration'];       
                                    endwhile;
                                    
                                    $user_query = "SELECT * FROM lms_users WHERE mobilenumber = '$cust_ID' AND user_role = 'customer'";
                                    $user_result = $mysqli->query($user_query);
                                    while($cust = $user_result->fetch_assoc()) :
                                        $firstname = $cust['firstname'];
                                        $middlename = $cust['middlename'];
                                        $lastname = $cust['lastname'];
                                        $mobileno = $cust['mobilenumber'];
                                        $occupation = $cust['occupation'];
                                        $email = $cust['email'];
                                        $idno = $cust['idno'];
                                        $gender = $cust['gender'];
                                        $dob = $cust['dob'];
                                        $address = $cust['address'];
                                        $city_town = $cust['city'];       
                                        $province = $cust['state'];   
                                        $cust_img = $cust['profile_image'];
                                        $idfront_img = ['id_back'];
                                        $idback_img = ['id_front'];
                                    endwhile;
                                }
                                
                                
                                // Edit(Update) loan details in the peri_loans table using the loanID
                                if(isset($_POST['update_cust'])) {
                                    // Collect personal details
                                    $firstName = $_POST['firstname'];
                                    $middleName = $_POST['middlename'];
                                    $lastName = $_POST['lastname'];
                                    $mobileNo = $_POST['mobileno'];
                                    $emailId = $_POST['email']; 
                                    $idNo = $_POST['idno']; 
                                    $sex = $_POST['gender'];
                                    $dateOfBirth = $_POST['dob'];
                                    $street = $_POST['address'];
                                    $townCity = $_POST['town_city'];
                                    $state = $_POST['province'];
        
                                    // Collect loan details
                                    // $loanDuration = $_POST['duration'];
                                    
                                    // Uploand Documents
                                    // $idfrontImg = $_FILES['idfront']['name'];
                                    // $idfrontTmp = $_FILES['idfront']['tmp_name'];
        
                                    // $idbackImg = $_FILES['idback']['name'];
                                    // $idbackTmp = $_FILES['idback']['tmp_name'];

                                    // updating the image in the db
                                    if(empty($idfrontImg)) {
                                        $idfrontImg = $idfront_img;
                                    }
                                    
                                    if(empty($idbackImg)) {
                                        $idbackImg = $idback_img;
                                    }
                                    

                                    // update loan details
                                    $update_query = "UPDATE lms_users SET firstname = '$firstName', middlename = '$middleName', lastname='$lastName', mobilenumber = '$mobileNo', email='$emailId',  idno = '$idNo', gender = '$sex', dob = '$dateOfBirth', address = '$street', city='$townCity', state = '$state' WHERE mobilenumber = '$cust_ID'";
                                        
                                    $update_result = $mysqli->query($update_query);

                                    // check update result and notify
                                    if($update_result) {
                                        // move image from database to local folder
                                        // move_uploaded_file($idfrontTmp, "assets/img/idPhotos/" . $idfrontImg);
                                        // move_uploaded_file($idbackTmp, "assets/img/idPhotos/" . $idbackImg);
                                        
                                        // move_uploaded_file($collateral1Tmp, "assets/img/loans/" . $collateral1Img);
                                        // move_uploaded_file($collateral2Tmp, "assets/img/loans/" . $collateral2Img);
                                        // move_uploaded_file($collateral3Tmp, "assets/img/loans/" . $collateral3Img);
                                        // move_uploaded_file($collateral4Tmp, "assets/img/loans/" . $collateral4Img);
                                        
                                        echo '
                                            <div class="alert alert-success" role="alert">
                                                Client loan details have been updated in the database
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    		                        		<span aria-hidden="true">&times;</span>
		    		                        	</button>
                                            </div>';
                                            
                                        header("location: customer_list.php");
                                        
                                    } else {
                                        echo "Something is wrong!" . mysqli_error($conn);
                                    }                   
                                }
                                ?>
  							        <div class="col-sm-12">
  							            <p class="lead mb-3 font-weight-medium">Personal Details</p>
  							        </div>
  							        <!-- First Name -->
  							        <div class="col-sm-4">
  							            <label class="text-dark mt-0">First Name</label>
  								        <div class="form-group">
  								            
  								            
  								            <input type="hidden" name="id" value="<?php echo $GET['id']; ?>"/>
  								            
								        	<input type="text" name="firstname" value="<?php echo $firstname; ?>" placeholder="John" class="form-control">
								        	<span class="help-block"><?php //echo $firstname_err; ?></span>
								        </div>
								    </div>
								    <!-- Middle Name -->
  							        <div class="col-sm-4">
  							            <label class="text-dark mt-0">Middle Name</label>
  								        <div class="form-group">
								        	<input type="text" placeholder="Chona" value="<?php echo $middlename; ?>" name="middlename" class="form-control">
								        	<span class="help-block"><?php //echo $middlename_err; ?></span>
								        </div>
								    </div>
								    <!-- Last Name -->
  							        <div class="col-sm-4">
  							            <label class="text-dark mt-0">Last Name</label>
  								        <div class="form-group">
								        	<input type="text" placeholder="Muchona" value="<?php echo $lastname; ?>" name="lastname" class="form-control">
								        	<span class="help-block"><?php //echo $lastname_err; ?></span>
								        </div>
								    </div>
  							        
								    <!-- Mobile Number -->
  							        <div class="col-sm-6">
  								        <div class="form-group">
  								        	<label for="mobileno">Mobile No.</label>
								        	<input type="text" name="mobileno" value="<?php echo $mobileno; ?>" class="form-control" placeholder="(260) 975-651046">
								        	<span class="help-block"><?php //echo $mobileno_err; ?></span>
								        </div> 
  							        </div>
  							        
								    <!-- Email -->
  							        <div class="col-sm-6">
  								        <div class="form-group">
  								        	<label for="email">Email</label>
								        	<input type="email" name="email" value="<?php echo $email; ?>" class="form-control" placeholder="johnm@gmail.com">
								        	<span class="help-block"><?php //echo $email_err; ?></span>
								        </div> 
  							        </div>
								    
								    <!-- Identity No. -->
  							        <div class="col-sm-4">
  								        <div class="form-group">
  								        	<label for="loantype">Identity No.</label>
								        	<input type="text" name="idno" value="<?php echo $idno; ?>" class="form-control" placeholder="341905/82/1">
								        	<span class="help-block"><?php //echo $idno_err; ?></span>
								        </div> 
  							        </div>
  							        
  							        <!-- Gender -->
  							        <div class="col-sm-4">
  							            <div class="form-group">
                                            <label for="">Gender</label>
                                            <select name="gender" id="form_gender" class="form-control">
                                                <option value="Male" id="">Male</option>
                                                <option value="Female" id="">Female</option>
                                            </select>
                                        </div>
  							        </div>
  							        
  							        <!-- Date of Birth -->
  							        <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="">Date of Birth</label>
                                            <input type="date" value="<?php echo $dob; ?>" id="form_dob" name="dob" class="form-control">
                                            <span class="help-block"><?php //echo $dob_err; ?></span>
                                        </div>
  							        </div>
  							        
  							        <!-- Address -->
  							        <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input type="text" id="form_address" value="<?php echo $address; ?>" name="address" placeholder="Plot 23, Nsombo Rd, Kaunda Square" class="form-control">
                                            <span class="help-block"><?php //echo $address_err; ?></span>
                                        </div>
                                    </div>
  							        
  							        <!-- City / Town -->
  							        <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="">Town/City</label>
                                            <input type="text" id="form_city" value="<?php echo $city_town; ?>" name="town_city" placeholder="Lusaka" class="form-control">
                                            <span class="help-block"><?php //echo $town_city_err; ?></span>
                                        </div>
                                    </div>
  							        
  							        <!-- State -->
  							        <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="province">Province</label>
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
  							        
  							        <!--<div class="col-sm-12">-->
  							        <!--    <p class="lead mb-3 mt-3 font-weight-medium">Loan Details</p>-->
  							        <!--</div>-->
  							        
  							        <!-- Loan Duration -->
  							   <!--     <div class="col-sm-3">-->
  								  <!--      <div class="form-group">-->
  								  <!--      	<label for="duration">Duration</label>-->
								    <!--    	<input type="number" value="<?php //echo $loanduration; ?>" name="duration" id="duration" class="form-control">-->
								    <!--    </div>-->
								    <!--</div>-->
								    
								    <!-- Units -->
  							   <!--     <div class="col-sm-6">-->
  								  <!--      <div class="form-group">-->
  								  <!--      	<label for="unit" class="mt-2"></label>-->
								    <!--    	<select class="form-control" id="unit" name="unit">-->
								    <!--    	    <option value="Week(s)" id="">Week(s)</option>-->
								    <!--    	    <option value="Month(s)" id="">Month(s)</option>-->
								    <!--    	    <option value="Year(s)" id="">Year(s)</option>-->
								    <!--    	</select>-->
								    <!--    </div>-->
								    <!--</div>-->
  							        
  							        <script>
  							            function changerate(loantype) {
  							                <?php
                                                $loantypes = "SELECT * FROM peri_loan_types";
                                                $result = mysqli_query($conn, $loantypes);
                                                while($row = mysqli_fetch_assoc($result)) {  ?>
  							                    
  							                    if(loantype=='<?php echo $row['loan_type']; ?>') {
  							                        document.getElementById('rate').value='<?php echo $row['rate']; ?>';
  							                    }
  							                <?php } ?>
  							            }
  							            
  							            function changeduration(loantype) {
  							                <?php
                                                $loantypes = "SELECT * FROM peri_loan_types";
                                                $result = mysqli_query($conn, $loantypes);
                                                while($row = mysqli_fetch_assoc($result)) {  ?>
  							                    
  							                    if(loantype=='<?php echo $row['loan_type']; ?>') {
  							                        document.getElementById('duration').value='<?php echo $row['duration']; ?>';
  							                    }
  							                <?php } ?>
  							            }
  							        </script>
  							        
  							        <!-- Submit Button -->
  							        <div class="col-sm-12">
								        <div class="form-group mt-2">
                            	        	<input type="submit" name="update_cust" style="" class="btn btn-primary" value="Edit Loan Details" onclick="">
                        		        </div>
  							        </div>
  							        
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