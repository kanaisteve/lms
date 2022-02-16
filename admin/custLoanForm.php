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
							<h2>Apply For a Loan</h2>
						</div>
	
						<div class="card-body" style="overflow-y: auto;">
						    <!-- Apply for a loan form -->
  							<form id="form_to_submit" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" class="form-group">
  							    <div class="row">
<?php  
    // Define variables and initialize with empty values
    $firstname = $middlename = $lastname = $email = $mobileno = $idno = $profession = $employer = $gender = $dob = $address =$town_city = $province = $loanamount = $loantype = $interestrate = $loanduration = $collateral_val = $brandname = $serialnumber = $description = $img = "";
    $firstname_err = $middlename_err = $lastname_err = $email_err = $mobileno_err = $idno_err = $profession_err  = $employer_err = $gender_err = $dob_err = $address_err = $town_city_err = $province_err = $loanamount_err = $loantype_err = $interestrate_err = $loanduration_err = $collateral_val_err = $brandname_err = $serialnumber_err = $description_err = $img_err = "";
 
    // Set empty form vars for validation mapping
    $_first_name = $_last_name = $_email = $_mobile_number = $_profession = $_employer = $_gender = $_dob = $_town_city = $_province = $_img = "";
    
    // Processing form data when form is submitted
    if(isset($_POST["btn_loanapply"])) {
        // Collect personal details
        $firstname = $_POST['firstname'];
        $middlename = $_POST['middlename'];
        $lastname = $_POST['lastname'];
        $mobileno = $_POST['mobileno'];
        $email = $_POST['email']; 
        $idno = $_POST['idno']; 
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $address = $_POST['address'];
        $town_city = $_POST['town_city'];
        $province = $_POST['province'];
        
        // Collect loan details
        $loanamount = $_POST['loanamount'];
        $loantype = $_POST['loantype'];
        $interestrate = $_POST['rate'];
        $loanduration = $_POST['duration'];
        $collateral_val = $_POST['collateral'];
        
        $rate = $interestrate / 100;
        $interest_value = $rate * $loanamount;
        
        $brandname = $_POST['brandname'];
        $serialnumber = $_POST['serialnumber'];
        $description = $_POST['description'];
      
        $brandname2 = $_POST['brandname2'];
        $serialnumber2 = $_POST['serialnumber2'];
        $description2 = $_POST['description2'];
      
        $brandname3 = $_POST['brandname3'];
        $serialnumber3 = $_POST['serialnumber3'];
        $description3 = $_POST['description3'];
      
        $brandname4 = $_POST['brandname4'];
        $serialnumber4 = $_POST['serialnumber4'];
        $description4 = $_POST['description4'];
        
        // Uploand Documents
        $idfront_img = $_FILES['idfront']['name'];
        $idfront_tmp = $_FILES['idfront']['tmp_name'];
        
        $idback_img = $_FILES['idback']['name'];
        $idback_tmp = $_FILES['idback']['tmp_name'];
        
        $collateral1_img = $_FILES['collateral1']['name'];
        $collateral1_tmp = $_FILES['collateral1']['tmp_name'];
        
        $collateral2_img = $_FILES['collateral2']['name'];
        $collateral2_tmp = $_FILES['collateral2']['tmp_name'];
        
        $collateral3_img = $_FILES['collateral3']['name'];
        $collateral3_tmp = $_FILES['collateral3']['tmp_name'];
        
        $collateral4_img = $_FILES['collateral4']['name'];
        $collateral4_tmp = $_FILES['collateral4']['tmp_name'];
        
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
        
            // if(empty($email)){
            //     //$emailEmptyErr
            //   $email_err = '<div class="text-danger">
            //         Email can not be blank.
            //     </div>';
            // }
            
        if(empty($mobileno)){
            //$mobileEmptyErr 
            $mobileno_err = '<div class="text-danger">
                Mobile number can not be blank.
            </div>';
        }
            
            if(empty($loanamount)){
                // $loanamountEmptyErr 
                $loanamount_err = '<div class="text-danger">
                    Loan amount can not be blank.
                </div>';
            }
            
            if(empty( $collateral_val)){
                // $collateral_valEmptyErr 
                $collateral_val_err = '<div class="text-danger">
                    Collateral value can not be blank.
                </div>';
            } 
            
            if(empty( $brandname)){
                // $brandnameEmptyErr 
                $brandname_err = '<div class="text-danger">
                    Brand name can not be blank.
                </div>';
            } 
            
            if(empty( $serialnumber)){
                // $serialnumberEmptyErr 
                $serialnumber_err = '<div class="text-danger">
                    Serial number can not be blank.
                </div>';
            } 
        
        // ============================== BASIC VALIDATION ==================== 
        // first check the database to make sure
        // a user does not already exist with the same username and/or email
        $check_mobilenumber_email = "SELECT * FROM peri_loan_applications WHERE mobileno ='$mobileno' OR email='$email' LIMIT 1";
        $result = mysqli_query($conn, $check_mobilenumber_email);
        $user = mysqli_fetch_assoc($result);
        if ($user) { // if user exists
            if ($user['mobileno'] === $mobileno) {
                $mobileno_err = '<div class="text-danger">
                    Mobile number already exists.
                </div>';
            }
            if ($user['email'] === $email) {
                $email_err = '<div class="text-danger">
                    Email already exists.
                </div>';
            }
        }
        
        // Check all the input errors, if any one or more exists dipslay an alert warning user
        if(!empty( $firstname_err) || !empty( $lastname_err) || !empty( $email_err) || empty( $mobilenumber_err) ||  !empty($collateral_val_err) || !empty($loanamount_err) || !empty($brandname_err) || !empty($serialnumber_err) || !empty($description_err)) {
            echo '
                    <div class="alert alert-warning col-sm-12" role="alert">
                        Loan application form was not recorded in the database due to some error in some input field. Please fill in all the required fields below.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    				<span aria-hidden="true">&times;</span>
		    			</button>
                    </div>';
        }
        
        // Check input errors before inserting in database [insert if there are no errors]
        if(empty( $firstname_err) && empty( $lastname_err) && empty( $email_err) && empty( $mobilenumber_err) &&  empty($collateral_val_err) && empty($loanamount_err) && empty($brandname_err) && empty($serialnumber_err) && empty($description_err)) {
    
            // insert loan application details into the loan_applications table
            $add_loan = "INSERT INTO peri_loan_applications (firstname, middlename, lastname, mobileno, email, idno, gender, dob, address, city_town, state, loan_amount, loan_type, loan_rate, loan_duration, earnings, collateral_value, brandname, serialnumber, description, brandname2, serialnumber2, description2, brandname3, serialnumber3, description3, brandname4, serialnumber4, description4, loan_status, nrc_front, nrc_back, collateral1, collateral2, collateral3, collateral4) 
                VALUES ('$firstname', '$middlename', '$lastname', '$mobileno', '$email', '$idno', '$gender', '$dob', '$address', '$town_city', '$province', '$loanamount', '$loantype', '$interestrate', '$loanduration', '$interest_value', '$collateral_val', '$brandname', '$serialnumber', '$description','$brandname2', '$serialnumber2', '$description2','$brandname3', '$serialnumber3', '$description3','$brandname4', '$serialnumber4', '$description4', 'pending', '$idfront_img', '$idback_img', '$collateral1_img', '$collateral2_img', '$collateral3_img', '$collateral4_img')";
            $result = mysqli_query($conn, $add_loan);
        
            if($result){
                echo '
                    <div class="alert alert-success" role="alert">
                        New Record has been saved in the database
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    				<span aria-hidden="true">&times;</span>
		    			</button>
                    </div>';
                // upload image to respective folder
                // move_uploaded_file($cust_tmp, "assets/img/loans/$cust_img");
                move_uploaded_file($idfront_tmp, "assets/img/loans/$idfront_img");
                move_uploaded_file($idback_tmp, "assets/img/loans/$idback_img");
                move_uploaded_file($collateral1_tmp, "assets/img/loans/$collateral1_img");
                move_uploaded_file($collateral2_tmp, "assets/img/loans/$collateral2_img");
                move_uploaded_file($collateral3_tmp, "assets/img/loans/$collateral3_img");
                move_uploaded_file($collateral4_tmp, "assets/img/loans/$collateral4_img");
            } else {
                echo "Query Failed!" . mysqli_error($conn);
            }
        }
        
        // Close connection
        mysqli_close($conn);
    }
?>
  							        
  							        <div class="col-sm-12">
  							            <p class="lead mb-3 mt-0 font-weight-medium">Loan Details</p>
  							        </div>
								    
								    <!-- Loan Amount -->
  							        <div class="col-sm-12">
  								        <div class="form-group">
  								        	<label for="loanamount">Loan Amount</label>
								        	<input type="text" name="loanamount" value="<?php echo $loanamount; ?>" class="form-control" placeholder="5000">
								        	<span class="help-block"><?php echo $loanamount_err; ?></span>
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
								        	<input type="number" value="<?php echo $interestrate; ?>" name="rate" id="rate" class="form-control">
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
								        	<input type="text" name="collateral" value="<?php echo $collateral_val; ?>" class="form-control" placeholder="5000">
								        	<span class="help-block"><?php echo $collateral_val_err; ?></span>
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
								                        	<input type="text" name="brandname" value="<?php echo $brandname; ?>" class="form-control" placeholder="Samsung">
								                        	<span class="help-block"><?php echo $brandname_err; ?></span>
								                        </div> 
								                    </td>
							            			<td class="pb-0">
							            			    <div class="form-group">
								            	            <input type="text" name="serialnumber" value="<?php echo $serialnumber; ?>" class="form-control" placeholder="789654123">
								            	            <span class="help-block"><?php echo $serialnumber_err; ?></span>
								                        </div>
							            			</td>
							            			<td class="pb-0">
							            			    <div class="form-group">
								            	            <textarea cols="30" rows="3" name="description" class="form-control" placeholder="Description about collateral"><?php echo $description; ?>
								            	            </textarea>
								            	            <span class="help-block mb-0"><?php echo $description_err; ?></span>
								                        </div> 
							            			</td>
							            		</tr>
							            		<tr>
							            			<td class="pb-0">2</td>
							        			<td class="pb-0">
  								                        <div class="form-group">
								                    	<input type="text" name="brandname2" value="<?php echo $brandname; ?>" class="form-control" placeholder="Samsung">
								                        	<!--<span class="help-block"><?php //echo $brandname_err; ?></span>-->
								                        </div> 
								                    </td>
							            			<td class="pb-0">
							            			    <div class="form-group">
								            	            <input type="text" name="serialnumber2" value="<?php echo $serialnumber; ?>" class="form-control" placeholder="789654123">
								            	            <!--<span class="help-block"><?php //echo $serialnumber_err; ?></span>-->
								                        </div>
							            			</td>
							            			<td class="pb-0">
							            			    <div class="form-group">
								            	            <textarea cols="30" rows="3" name="description2" class="form-control" placeholder="Description about collateral"><?php echo $description; ?>
								            	            </textarea>
								            	            <!--<span class="help-block"><?php //echo $description_err; ?></span>-->
								                        </div> 
							            			</td>
							            		</tr>
							            		<tr>
							            			<td class="pb-0">3</td>
							            			<td class="pb-0">
  								                        <div class="form-group">
								                        	<input type="text" name="brandname3" value="<?php echo $brandname; ?>" class="form-control" placeholder="Samsung">
								                        	<!--<span class="help-block"><?php //echo $brandname_err; ?></span>-->
								                        </div> 
							            			</td>
							            			<td class="pb-0">
							            			    <div class="form-group">
								            	            <input type="text" name="serialnumber3" value="<?php echo $serialnumber; ?>" class="form-control" placeholder="789654123">
								            	            <!--<span class="help-block"><?php //echo $serialnumber_err; ?></span>-->
								                        </div>
							            			</td>
							            			<td class="pb-0">
							            			    <div class="form-group">
								            	            <textarea cols="30" rows="3" name="description3" class="form-control" placeholder="Description about collateral"><?php echo $description; ?>
								            	            </textarea>
								            	            <!--<span class="help-block"><?php echo $description_err; ?></span>-->
								                        </div> 
							            			</td>
							            		</tr>
							            		<tr>
							            			<td class="pb-0">4</td>
							            			<td class="pb-0">
  								                        <div class="form-group">
								                        	<input type="text" name="brandname4" value="<?php echo $brandname; ?>" class="form-control" placeholder="Samsung">
								                        	<!--<span class="help-block"><?php //echo $brandname_err; ?></span>-->
								                        </div> 
							            			</td>
							            			<td class="pb-0">
							            			    <div class="form-group">
								            	            <input type="text" name="serialnumber4" value="<?php echo $serialnumber; ?>" class="form-control" placeholder="789654123">
								            	            <!--<span class="help-block"><?php //echo $serialnumber_err; ?></span>-->
								                        </div>
							            			</td>
							            			<td class="pb-0">
							            			    <div class="form-group">
								            	            <textarea cols="30" rows="3" name="description4" class="form-control" placeholder="Description about collateral"><?php echo $description; ?>
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
                                            <input type="file" value="<?php echo $idfront; ?>" name="idfront" class="form-control-file">
                                        </div>
  							        </div>
								    
								    <!-- Upload NRC Back -->
  							        <div class="col-sm-6">
  							            <label class="text-dark mt-2 font-weight-medium">NRC Back</label>
  								       <div class="form-group">
                                            <input type="file" value="<?php echo $idback; ?>" name="idback" class="form-control-file">
                                        </div>
  							        </div>
                                
                                    <!-- Upload Collateral -->
                                    <div class="col-sm-6">
                                        <label class="text-dark mt-2 font-weight-medium">1st Collateral</label>
                                        <div class="form-group">
                                            <input type="file" value="<?php echo $collateral1_img; ?>" name="collateral1" class="form-control-file">
                                        </div>
                                    </div>
                                    
                                    <!-- Upload 2nd Collateral -->
                                    <div class="col-sm-6">
                                        <label class="text-dark mt-2 font-weight-medium">2nd Collateral</label>
                                        <div class="form-group">
                                            <input type="file" value="<?php echo $collateral2_img; ?>" name="collateral2" class="form-control-file">
                                        </div>
                                    </div>
                                    
                                    <!-- Upload 3rd Collateral -->
                                    <div class="col-sm-6">
                                        <label class="text-dark mt-2 font-weight-medium">3rd Collateral</label>
                                        <div class="form-group">
                                            <input type="file" value="<?php echo $collateral3_img; ?>" name="collateral3" class="form-control-file">
                                        </div>
                                    </div>
                                    
                                    <!-- Upload 4th Collateral -->
                                    <div class="col-sm-6">
                                        <label class="text-dark mt-2 font-weight-medium">4th Collateral</label>
                                        <div class="form-group">
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
                            	        	<input type="submit" name="btn_loanapply" style="background-color:#dc3545; color:#fff" class="btn" value="Apply for Loan" onclick="add_confirm()">
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