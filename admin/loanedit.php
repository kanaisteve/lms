<?php 
    //connect to database
    include_once('database/connect.php');
    
    $loantypes = "SELECT * FROM peri_loan_types";
    $loantype_result = mysqli_query($conn, $loantypes); ?>


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
                                    
                                    $cust_query = "SELECT * FROM peri_loan_applications WHERE loan_id = '$cust_ID'";
                                    $result = mysqli_query($conn, $cust_query);
                                    while($customer = mysqli_fetch_assoc($result)) {
                                        $customer_id = $customer['loan_id'];
                                        $firstname = $customer['firstname'];
                                        $middlename = $customer['middlename'];
                                        $lastname = $customer['lastname'];
                                        $mobileno = $customer['mobileno'];
                                        $email = $customer['email'];
                                        $idno = $customer['idno'];
                                        $gender = $customer['gender'];
                                        $dob = $customer['dob'];
                                        $address = $customer['address'];
                                        $city_town = $customer['city_town'];       
                                        $province = $customer['state'];   
                                        $cust_img = $customer['profile_img'];   
                                        
                                        $loanamount = $customer['loan_amount'];       
                                        $loantype = $customer['loan_type'];       
                                        $loanrate = $customer['loan_rate'];       
                                        $loanduration = $customer['loan_duration'];       
                                        $interest = $customer['earnings'];       
                                        $collateral_value = $customer['collateral_value'];  
                                        
                                        $brandname = $customer['brandname'];       
                                        $serialnumber = $customer['serialnumber'];       
                                        $description = $customer['description'];       
                                        
                                        $brandname2 = $customer['brandname2'];       
                                        $serialnumber2 = $customer['serialnumber2'];       
                                        $description2 = $customer['description2'];       
                                        
                                        $brandname3 = $customer['brandname3'];       
                                        $serialnumber3 = $customer['serialnumber3'];       
                                        $description3 = $customer['description3'];       
                                        
                                        $brandname4 = $customer['brandname4'];       
                                        $serialnumber4 = $customer['serialnumber4'];       
                                        $description4 = $customer['description4']; 
                                        
                                        $idfront_img = $customer['nrc_front']; 
                                        $idback_img = $customer['nrc_back']; 
                                        
                                        $collateral1_img = $customer['collateral1'];       
                                        $collateral2_img = $customer['collateral2'];       
                                        $collateral3_img = $customer['collateral3'];       
                                        $collateral4_img = $customer['collateral4'];       
                                    }
                                }
                                
                                
                                // Edit(Update) loan details in the peri_loans table using the loanID
                                if(isset($_POST['update_loan'])) {
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
                                    $loanAmount = $_POST['loanamount'];
                                    $loanType = $_POST['loantype'];
                                    $interestRate = $_POST['rate'];
                                    $loanDuration = $_POST['duration'];
                                    $collateralVal = $_POST['collateral'];
        
                                    $rate = $interestRate / 100;
                                    $interestValue = $rate * $loanAmount;
        
                                    $brandName = $_POST['brandname'];
                                    $serialNumber = $_POST['serialnumber'];
                                    $desc = $_POST['description'];
      
                                    $brandName2 = $_POST['brandname2'];
                                    $serialNumber2 = $_POST['serialnumber2'];
                                    $desc2 = $_POST['description2'];
      
                                    $brandName3 = $_POST['brandname3'];
                                    $serialNumber3 = $_POST['serialnumber3'];
                                    $desc3 = $_POST['description3'];
      
                                    $brandName4 = $_POST['brandname4'];
                                    $serialNumber4 = $_POST['serialnumber4'];
                                    $desc4 = $_POST['description4'];
        
                                    // Uploand Documents
                                    $idfrontImg = $_FILES['idfront']['name'];
                                    $idfrontTmp = $_FILES['idfront']['tmp_name'];
        
                                    $idbackImg = $_FILES['idback']['name'];
                                    $idbackTmp = $_FILES['idback']['tmp_name'];
        
                                    $collateral1Img = $_FILES['collateral1']['name'];
                                    $collateral1Tmp = $_FILES['collateral1']['tmp_name'];
        
                                    $collateral2Img = $_FILES['collateral2']['name'];
                                    $collateral2Tmp = $_FILES['collateral2']['tmp_name'];
        
                                    $collateral3Img = $_FILES['collateral3']['name'];
                                    $collateral3Tmp = $_FILES['collateral3']['tmp_name'];
        
                                    $collateral4Img = $_FILES['collateral4']['name'];
                                    $collateral4Tmp = $_FILES['collateral4']['tmp_name'];

                                    // updating the image in the db
                                    if(empty($idfrontImg)) {
                                        $idfrontImg = $idfront_img;
                                    }
                                    
                                    if(empty($idbackImg)) {
                                        $idbackImg = $idback_img;
                                    }
                                    
                                    if(empty($collateral1Img)) {
                                        $collateral1Img = $collateral1_img;
                                    }
                                    
                                    if(empty($collateral2Img)) {
                                        $collateral2Img = $collateral2_img;
                                    }
                                    
                                    if(empty($collateral3Img)) {
                                        $collateral3Img = $collateral3_img;
                                    }
                                    
                                    if(empty($collateral4Img)) {
                                        $collateral4Img = $collateral4_img;
                                    }

                                    // update loan details
                                    $update_query = "UPDATE peri_loan_applications SET firstname = '$firstName', middlename = '$middleName', lastname='$lastName', mobileno = '$mobileNo', email='$emailId',  idno = '$idNo', gender = '$sex', dob = '$dateOfBirth', address = '$street', city_town='$townCity', state = '$state', loan_amount = '$loanAmount', loan_type = '$loanType', loan_rate = '$interestRate', loan_duration = '$loanDuration', earnings = '$interestValue', collateral_value = '$collateralVal', brandname = '$brandName', serialnumber = '$serialNumber', description = '$desc', brandname2 = '$brandName2', serialnumber2 = '$serialNumber2', description2 = '$desc2', brandname3 = '$brandName3', serialnumber3 = '$serialNumber3', description3 = '$desc3', brandname4 = '$brandName4', serialnumber4 = '$serialNumber4', description4 = '$desc4', nrc_front = '$idfrontImg', nrc_back = '$idbackImg', collateral1 = '$collateral1Img', collateral2 = '$collateral2Img', collateral3 = '$collateral3Img', collateral4 = '$collateral4Img' WHERE loan_id = '$cust_ID'";
                                        
                                    $update_result = mysqli_query($conn, $update_query);

                                    // check update result and notify
                                    if($update_result) {
                                        // move image from database to local folder
                                        move_uploaded_file($idfrontTmp, "assets/img/loans/" . $idfrontImg);
                                        move_uploaded_file($idbackTmp, "assets/img/loans/" . $idbackImg);
                                        
                                        move_uploaded_file($collateral1Tmp, "assets/img/loans/" . $collateral1Img);
                                        move_uploaded_file($collateral2Tmp, "assets/img/loans/" . $collateral2Img);
                                        move_uploaded_file($collateral3Tmp, "assets/img/loans/" . $collateral3Img);
                                        move_uploaded_file($collateral4Tmp, "assets/img/loans/" . $collateral4Img);
                                        
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
                                                <option value="male" id="">Male</option>
                                                <option value="female" id="">Female</option>
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
  							        
  							        <div class="col-sm-12">
  							            <p class="lead mb-3 mt-3 font-weight-medium">Loan Details</p>
  							        </div>
								    
								    <!-- Loan Amount -->
  							        <div class="col-sm-12">
  								        <div class="form-group">
  								        	<label for="loanamount">Loan Amount</label>
								        	<input type="text" name="loanamount" value="<?php echo $loanamount; ?>" class="form-control" placeholder="5000">
								        	<span class="help-block"><?php //echo $loanamount_err; ?></span>
								        </div> 
  							        </div>
								    
								    <!-- Loan Type -->
  							        <div class="col-sm-6">
  								        <div class="form-group">
  								        	<label for="loantype">Loan Type</label>
                                            <select id="loantype"  onchange="changerate(this.value); changeduration(this.value);" class="form-group form-control" name="loantype">
                                                <option value="<?php if(!empty($loantype)){echo $loantype;} else {echo 'none';} ?>"><?php if(!empty($loantype)){echo $loantype;} else {echo "Select Loan Type:";} ?></option>
                                                <?php 
                                                    while($row = mysqli_fetch_assoc($loantype_result)) { 
                                                    $rate = $row['rate']; 
                                                    $loan_type_id = $row['id']; 
                                                    $loan_type = $row['loan_type']; ?>
                                                    
                                                    <option value="<?php echo $loan_type; ?>"><?php echo $loan_type; ?></option>
                                                    
                                            <?php } ?>
                                            </select>
								        </div> 
  							        </div>
  							        
								    <!-- Interest Rate -->
								    <div class="col-sm-3">
  								        <div class="form-group">
  								        	<label for="rate">Interest Rate</label>
								        	<input type="number" value="<?php echo $loanrate; ?>" name="rate" id="rate" class="form-control">
								        </div>
								    </div>
  							        
  							        <!-- Loan Duration -->
  							        <div class="col-sm-3">
  								        <div class="form-group">
  								        	<label for="duration">Duration</label>
								        	<input type="number" value="<?php echo $loanduration; ?>" name="duration" id="duration" class="form-control">
								        </div>
								    </div>
								    
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
								    
								    <!-- Collateral -->
  							        <div class="col-sm-12">
  								        <div class="form-group">
  								        	<label for="collateral">Collateral Value</label>
								        	<input type="text" name="collateral" value="<?php echo $collateral_value; ?>" class="form-control" placeholder="5000">
								        	<span class="help-block"><?php //echo $collateral_val_err; ?></span>
								        </div> 
  							        </div>
  							        
  							        <!-- Collateral Details -->
						            <div class="col-sm-12">
						                <p class="lead mt-0">Collateral Details</p>
							            <table class="table table-bordered">
								            <thead>
								            	<tr>
								            		<th scope="col">S/N</th>
								            		<th scope="col">Brand</th>
								            		<th scope="col">Serial Number</th>
								            		<th scope="col">Description</th>
								            	</tr>
								            </thead>
							            	<tbody>
							            		<tr>
							            			<td class="pb-0">1</td>
							            			<td class="pb-0">
  								                        <div class="form-group">
								                        	<input type="text" name="brandname" value="<?php echo $brandname; ?>" class="form-control">
								                        	<span class="help-block"><?php //echo $brandname_err; ?></span>
								                        </div> 
								                    </td>
							            			<td class="pb-0">
							            			    <div class="form-group">
								            	            <input type="text" name="serialnumber" value="<?php echo $serialnumber; ?>" class="form-control">
								            	            <span class="help-block"><?php //echo $serialnumber_err; ?></span>
								                        </div>
							            			</td>
							            			<td class="pb-0">
							            			    <div class="form-group">
								            	            <textarea cols="30" rows="3" name="description" class="form-control" value="<?php echo $description; ?>"><?php echo $description; ?>
								            	            </textarea>
								            	            <span class="help-block mb-0"><?php //echo $description_err; ?></span>
								                        </div> 
							            			</td>
							            		</tr>
							            		<tr>
							            			<td class="pb-0">2</td>
							        			<td class="pb-0">
  								                        <div class="form-group">
								                    	<input type="text" name="brandname2" value="<?php echo $brandname2; ?>" class="form-control" placeholder="Samsung">
								                        	<!--<span class="help-block"><?php //echo $brandname_err; ?></span>-->
								                        </div> 
								                    </td>
							            			<td class="pb-0">
							            			    <div class="form-group">
								            	            <input type="text" name="serialnumber2" value="<?php echo $serialnumber2; ?>" class="form-control" placeholder="789654123">
								            	            <!--<span class="help-block"><?php //echo $serialnumber_err; ?></span>-->
								                        </div>
							            			</td>
							            			<td class="pb-0">
							            			    <div class="form-group">
								            	            <textarea cols="30" rows="3" name="description2" class="form-control" placeholder="Description about collateral"><?php echo $description2; ?>
								            	            </textarea>
								            	            <!--<span class="help-block"><?php //echo $description_err; ?></span>-->
								                        </div> 
							            			</td>
							            		</tr>
							            		<tr>
							            			<td class="pb-0">3</td>
							            			<td class="pb-0">
  								                        <div class="form-group">
								                        	<input type="text" name="brandname3" value="<?php echo $brandname3; ?>" class="form-control" placeholder="Samsung">
								                        	<!--<span class="help-block"><?php //echo $brandname_err; ?></span>-->
								                        </div> 
							            			</td>
							            			<td class="pb-0">
							            			    <div class="form-group">
								            	            <input type="text" name="serialnumber3" value="<?php echo $serialnumber3; ?>" class="form-control" placeholder="789654123">
								            	            <!--<span class="help-block"><?php //echo $serialnumber_err; ?></span>-->
								                        </div>
							            			</td>
							            			<td class="pb-0">
							            			    <div class="form-group">
								            	            <textarea cols="30" rows="3" name="description3" class="form-control" placeholder="Description about collateral"><?php echo $description3; ?>
								            	            </textarea>
								            	            <!--<span class="help-block"><?php //echo $description_err; ?></span>-->
								                        </div> 
							            			</td>
							            		</tr>
							            		<tr>
							            			<td class="pb-0">4</td>
							            			<td class="pb-0">
  								                        <div class="form-group">
								                        	<input type="text" name="brandname4" value="<?php echo $brandname4; ?>" class="form-control" placeholder="Samsung">
								                        	<!--<span class="help-block"><?php //echo $brandname_err; ?></span>-->
								                        </div> 
							            			</td>
							            			<td class="pb-0">
							            			    <div class="form-group">
								            	            <input type="text" name="serialnumber4" value="<?php echo $serialnumber4; ?>" class="form-control" placeholder="789654123">
								            	            <!--<span class="help-block"><?php //echo $serialnumber_err; ?></span>-->
								                        </div>
							            			</td>
							            			<td class="pb-0">
							            			    <div class="form-group">
								            	            <textarea cols="30" rows="3" name="description4" class="form-control" placeholder="Description about collateral"><?php echo $description4; ?>
								            	            </textarea>
								            	            <!--<span class="help-block"><?php //echo $description_err; ?></span>-->
								                        </div> 
							            			</td>
							            		</tr>
							            	</tbody>
							            </table> 
						            </div>
  							        
  							        <!-- Employer -->
  							       <!-- <div class="col-sm-12">-->
  								      <!--  <div class="form-group">-->
  								      <!--  	<label for="employer">Employer</label>-->
								        <!--	<input required type="text" id="form_employer" name="employer" placeholder="Kanai Technologies LLC." class="form-control">-->
								        <!--	<span class="help-block"><?php echo $employer_err; ?></span>-->
								        <!--</div> -->
  							       <!-- </div>-->
  							        
  							        <!-- Profession -->
  							       <!-- <div class="col-sm-6">-->
  								      <!--  <div class="form-group">-->
  								      <!--  	<label for="jobtitle">Job Title</label>-->
								        <!--	<input required type="text" id="form_profession" name="profession" placeholder="Software Developer" class="form-control">-->
								        <!--	<span class="help-block"><?php echo $profession_err; ?></span>-->
								        <!--</div> -->
  							       <!-- </div>-->
								    
								    <!-- Salary -->
  							       <!-- <div class="col-sm-6">-->
  								      <!--  <div class="form-group">-->
  								      <!--  	<label for="salary">Salary</label>-->
								        <!--	<input type="text" name="salary" class="form-control" placeholder="8000">-->
								        <!--</div> -->
  							       <!-- </div>-->
  							        
  							        <div class="col-sm-12">
  							            <p class="lead mb-3 mt-3 font-weight-medium">Upload Documents</p>
  							        </div>
								    
								    <!-- Upload NRC Front -->
  							        <div class="col-sm-6">
  							            <label class="text-dark mt-2 font-weight-medium">NRC Front</label>
  								        <div class="form-group">
  							                <img width="150" height="120" onclick="openFullscreen(this);" class="img-responsive mt-0 mb-1" src="./assets/img/user/<?= $idfront_img ?>">
                                            <input type="file" value="<?php echo $idfront; ?>" name="idfront" class="form-control-file">
                                        </div>
  							        </div>
								    
								    <!-- Upload NRC Back -->
  							        <div class="col-sm-6">
  							            <label class="text-dark mt-2 font-weight-medium">NRC Back</label>
  								       <div class="form-group">
  							                <img width="150" height="120" onclick="openFullscreen(this);" class="img-responsive mt-0 mb-1" src="assets/img/loans/<?= $idback_img ?>">
                                            <input type="file" value="<?php echo $idback; ?>" name="idback" class="form-control-file">
                                        </div>
  							        </div>
                                
                                    <!-- Upload Collateral -->
                                    <div class="col-sm-6">
                                        <label class="text-dark mt-2 font-weight-medium">1st Collateral</label>
                                        <div class="form-group">
  							                <img width="150" height="120" onclick="openFullscreen(this);" class="img-responsive mt-0 mb-1" src="assets/img/loans/<?= $collateral1_img ?>">
                                            <input type="file" value="<?php echo $collateral1_img; ?>" name="collateral1" class="form-control-file">
                                        </div>
                                    </div>
                                    
                                    <!-- Upload 2nd Collateral -->
                                    <div class="col-sm-6">
                                        <label class="text-dark mt-2 font-weight-medium">2nd Collateral</label>
                                        <div class="form-group">
  							                <img width="150" height="120" onclick="openFullscreen(this);" class="img-responsive mt-0 mb-1" src="assets/img/loans/<?= $collateral2_img; ?>">
                                            <input type="file" value="<?php echo $collateral2_img; ?>" name="collateral2" class="form-control-file">
                                        </div>
                                    </div>
                                    
                                    <!-- Upload 3rd Collateral -->
                                    <div class="col-sm-6">
                                        <label class="text-dark mt-2 font-weight-medium">3rd Collateral</label>
                                        <div class="form-group">
  							                <img width="150" height="120" onclick="openFullscreen(this);" class="img-responsive mt-0 mb-1" src="assets/img/loans/<?= $collateral3_img; ?>">
                                            <input type="file" value="<?php echo $collateral3_img; ?>" name="collateral3" class="form-control-file">
                                        </div>
                                    </div>
                                    
                                    <!-- Upload 4th Collateral -->
                                    <div class="col-sm-6">
                                        <label class="text-dark mt-2 font-weight-medium">4th Collateral</label>
                                        <div class="form-group">
  							                <img width="150" height="120" onclick="openFullscreen(this);" class="img-responsive mt-0 mb-1" src="assets/img/loans/<?= $collateral4_img; ?>">
                                            <input type="file" value="<?php echo $collateral4_img; ?>" name="collateral4" class="form-control-file">
                                        </div>
                                    </div>
                                
                                    <!-- Pay Slip -->
                                    <!--<div class="col-sm-6">-->
                                    <!--    <label class="text-dark mt-2 font-weight-medium">Pay Slip</label>-->
                                    <!--    <div class="form-group">-->
                                    <!--        <input type="file" name="payslip" class="form-control-file">-->
                                    <!--    </div>-->
                                    <!--</div>-->
  							        
  							        <!-- Submit Button -->
  							        <div class="col-sm-12">
								        <div class="form-group mt-2">
                            	        	<input type="submit" name="update_loan" style="" class="btn btn-primary" value="Edit Loan Details" onclick="">
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