<?php 
    include 'views/head.php'; 
    include_once 'libs/loan_form.php';
    
    $loanformObj  = new LoanForm($_POST);
    
    // collect loan details for particular customer
    $loan = $loanformObj->getLoanDetails($mobileNumber);
    $loanStatus = $loan['loan_status'];
?>


<body class="sidebar-fixed sidebar-dark header-fixed header-light" id="body">
<div class="mobile-sticky-body-overlay"></div>
  <div class="wrapper">
    <?php include 'views/sidebar_without_footer.php'; ?>

    <div class="page-wrapper">
      <?php include 'views/header.php'; ?>

      <div class="content-wrapper">
        <div class="content">	
			<div class="row">
				<div class="col-lg-12">
					<div class="card card-default">
						<div class="card-header card-header-border-bottom">
							<h2>Apply For a Loan</h2>
						</div>
						<div class="card-body" style="overflow-y: auto;">
						    <?php if(!isset($loanStatus)) { $loanStatus = ''; }
						    if($loanStatus == 'pending' || $loanStatus == 'disbursed' || $loanStatus == 'approved' ) {
						        echo '<p>You currently have a loan. Please clear your loan to apply for another one.</p>';
						    } else { 
						    ?>
						    <!-- Apply for a loan form -->
  							<form id="form_to_submit" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" class="form-group">
  							    <div class="row">
                                    <?php  
                                        // Processing form data when form is submitted
                                        if(isset($_POST["btn_loanapply"])) { 
                                            // validate entries
                                            $errors = $loanformObj->validateLoanForm();
                                            
                                            // Check input errors before inserting in database [insert if there are no errors]
                                            if(empty($errors)) {
                                                $loanformObj->applyLoan($_POST, $fullName_Sess, $mobileNumber,$email_Sess);
                                                echo '
                                                    <div class="alert alert-success col-sm-12" role="alert">
                                                        You have successfully applied for a loan.
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	    		                           	    <span aria-hidden="true">&times;</span>
		    	    		                            </button>
                                                    </div>';
                                                // header("location: ./indexCust.php");
                                            }
                                        }
                                    ?>
  							        <div class="col-sm-12">
  							            <p class="lead mb-3 mt-0 font-weight-medium">Loan Details</p>
  							        </div>
								    
								    <!-- Loan Amount -->
  							        <div class="col-sm-6">
  								        <div class="form-group">
  								        	<label for="loanamount">Loan Amount</label>
								        	<input type="text" name="loanamount" value="<?php if(isset($_POST['loanamount'])) echo $_POST['loanamount'] ?>" class="form-control" placeholder="5000">
                                            <span class="help-block text-danger"><?php echo $errors['loanamount'] ?? '' ?>. </span>
								        </div> 
  							        </div>
  							        
  							        <!-- Loan Duration -->
  							        <div class="col-sm-3">
  								        <div class="form-group">
  								        	<label for="loantype">Loan Duration</label>
  								        	
  								        	<?php $defaultLoanDuration = '1'; ?>
                                            <select id="loantype"  onchange="changerate(this.value);" class="form-group form-control" name="duration">
                                                <option>-- Choose Loan Duration --</option>
                                                <option value="1" <?php //if($defaultLoanDuration == '1'){echo("selected");}?>>1 Week</option>
                                                <option value="2" <?php //if($defaultLoanDuration == '2'){echo("selected");}?>>2 Weeks</option>
                                                <option value="3" <?php //if($defaultLoanDuration == '3'){echo("selected");}?>>3 Weeks</option>
                                                <option value="4" <?php //if($defaultLoanDuration == '4'){echo("selected");}?>>4 Weeks</option>
                                            </select>
								        </div> 
  							        </div>
  							        
								    <!-- Interest Rate -->
								    <div class="col-sm-3">
  								        <div class="form-group">
  								        	<label for="rate">Interest Rate</label>
								        	<input type="number" name="rate" id="rate" class="form-control">
								        </div>
								    </div>
  							        <script>
  							            function changerate(duration) {
  							                if (duration == 1) {
  							                    document.getElementById('rate').value='15';
  							                }
  							                if (duration == 2) {
  							                    document.getElementById('rate').value='20';
  							                }
  							                
  							                if (duration == 3) {
  							                    document.getElementById('rate').value='25';
  							                }
  							                
  							                
  							                if (duration == 4) {
  							                    document.getElementById('rate').value='30';
  							                }
  							            }
  							        </script>
  							        
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
								            		<th scope="col">Price(ZMW)</th>
								            	</tr>
								            </thead>
							            	<tbody>
							            		<tr>
							            			<td class="pb-0">1</td>
							            			<td class="pb-0">
  								                        <div class="form-group">
								                        	<input type="text" name="brandname" value="<?php if(isset($_POST['brandname'])) echo $_POST['brandname'] ?>" class="form-control" placeholder="Brand Name">
                                                            <span class="help-block text-danger"><?php echo $errors['brandname'] ?? '' ?>. </span>
								                        </div> 
								                    </td>
							            			<td class="pb-0">
							            			    <div class="form-group">
								            	            <input type="text" name="serialnumber" value="<?php if(isset($_POST['serialnumber'])) echo $_POST['serialnumber'] ?>" class="form-control" placeholder="789654123">
                                                            <span class="help-block text-danger"><?php echo $errors['serialnumber'] ?? '' ?>. </span>
								                        </div>
							            			</td>
							            			<td class="pb-0">
							            			    <div class="form-group">
								            	            <textarea cols="30" rows="3" name="description" class="form-control" placeholder="Description about collateral"> <?php if(isset($_POST['description'])) echo $_POST['description'] ?>
								            	            </textarea>
                                                            <span class="help-block text-danger"><?php echo $errors['description'] ?? '' ?>. </span>
								                        </div> 
							            			</td>
							            			<td class="pb-0">
  								                        <div class="form-group">
								                        	<input type="number" name="price1" id="price1" value="<?php echo $price1; ?>" class="form-control item-price" placeholder="2000">
                                                            <span class="help-block text-danger"><?php echo $errors['price1'] ?? '' ?>. </span>
								                        </div> 
								                    </td>
							            		</tr>
							            		<tr>
							            			<td class="pb-0">2</td>
							        			<td class="pb-0">
  								                        <div class="form-group">
								                    	<input type="text" name="brandname2" value="<?php if(isset($_POST['brandname2'])) echo $_POST['brandname2'] ?>" class="form-control" placeholder="Brand Name">
								                        </div> 
								                    </td>
							            			<td class="pb-0">
							            			    <div class="form-group">
								            	            <input type="text" name="serialnumber2" value="<?php if(isset($_POST['serialnumber2'])) echo $_POST['serialnumber2'] ?>" class="form-control" placeholder="789654123">
								                        </div>
							            			</td>
							            			<td class="pb-0">
							            			    <div class="form-group">
								            	            <textarea cols="30" rows="3" name="description2" class="form-control" placeholder="Description about collateral"> <?php if(isset($_POST['description2'])) echo $_POST['description2'] ?>
								            	            </textarea>
                                                            <span class="help-block text-danger"><?php echo $errors['description2'] ?? '' ?>. </span>
								                        </div> 
							            			</td>
							            			<td class="pb-0">
  								                        <div class="form-group">
								                        	<input type="number" id="price2" name="price2" value="<?php if(isset($_POST['price2'])) echo $_POST['price2'] ?>" class="form-control item-price" placeholder="7000">
                                                            <span class="help-block text-danger"><?php echo $errors['price2'] ?? '' ?>. </span>
								                        </div> 
								                    </td>
							            		</tr>
							            		<tr>
							            			<td class="pb-0">3</td>
							            			<td class="pb-0">
  								                        <div class="form-group">
								                        	<input type="text" name="brandname3" id="brandname3" value="<?php if(isset($_POST['brandname3'])) echo $_POST['brandname3'] ?>" class="form-control" placeholder="Brand Name">
                                                            <span class="help-block text-danger"><?php echo $errors['brandname3'] ?? '' ?>. </span>
								                        </div> 
							            			</td>
							            			<td class="pb-0">
							            			    <div class="form-group">
								            	            <input type="text" name="serialnumber3" id="serialnumber3" value="<?php if(isset($_POST['serialnumber3'])) echo $_POST['serialnumber3'] ?>" class="form-control" placeholder="789654123">
                                                            <span class="help-block text-danger"><?php echo $errors['serialnumber3'] ?? '' ?>. </span>
								                        </div>
							            			</td>
							            			<td class="pb-0">
							            			    <div class="form-group">
								            	            <textarea cols="30" rows="3" id="description3" name="description3" class="form-control" placeholder="Description about collateral"><?php if(isset($_POST['description3'])) echo $_POST['description3'] ?>
								            	            </textarea>
                                                            <span class="help-block text-danger"><?php echo $errors['description3'] ?? '' ?>. </span>
								                        </div> 
							            			</td>
							            			<td class="pb-0">
  								                        <div class="form-group">
								                        	<input type="number" id="price3" name="price3" value="<?php echo $price1; ?>" class="form-control item-price" placeholder="10000">
                                                            <span class="help-block text-danger"><?php echo $errors['price3'] ?? '' ?>. </span>
								                        </div> 
								                    </td>
							            		</tr>
							            		<tr>
							            			<td class="pb-0">4</td>
							            			<td class="pb-0">
  								                        <div class="form-group">
								                        	<input type="text" name="brandname4" id="brandname4" value="<?php if(isset($_POST['brandname4'])) echo $_POST['brandname4'] ?>" class="form-control" placeholder="Brand Name">
                                                            <span class="help-block text-danger"><?php echo $errors['brandname4'] ?? '' ?>. </span>
								                        </div> 
							            			</td>
							            			<td class="pb-0">
							            			    <div class="form-group">
								            	            <input type="text" name="serialnumber4" id="serialnumber4" value="<?php if(isset($_POST['serialnumber4'])) echo $_POST['serialnumber4'] ?>" class="form-control" placeholder="789654123">
                                                            <span class="help-block text-danger"><?php echo $errors['serialnumber4'] ?? '' ?>. </span>
								                        </div>
							            			</td>
							            			<td class="pb-0">
							            			    <div class="form-group">
								            	            <textarea cols="30" rows="3" id="description4" name="description4" class="form-control" placeholder="Description about collateral"><?php if(isset($_POST['description4'])) echo $_POST['description4'] ?>
								            	            </textarea>
                                                            <span class="help-block text-danger"><?php echo $errors['description4'] ?? '' ?>. </span>
								                        </div> 
							            			</td>
							            			<td class="pb-0">
  								                        <div class="form-group">
								                        	<input type="number" id="price4" name="price4" value="<?php echo $price1; ?>" class="form-control item-price" placeholder="25000">
                                                            <span class="help-block text-danger"><?php echo $errors['price4'] ?? '' ?>. </span>
								                        </div> 
								                    </td>
							            		</tr>
							            	</tbody>
							            </table> 
						            </div>
								    
								    <!-- Collateral -->
  							        <div class="col-sm-12">
  								        <div class="form-group">
  								        	<label for="collateral">Collateral Value</label>
								        	<input type="number" id="collateral_val" name="collateral" value="<?php echo $collateral_val; ?>" class="form-control" placeholder="5000">
                                            <span class="help-block text-danger"><?php echo $errors['collateral'] ?? '' ?>. </span>
								        </div> 
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
                                            <input type="file" name="idfront" class="form-control-file">
                                        </div>
  							        </div>
								    
								    <!-- Upload NRC Back -->
  							        <div class="col-sm-6">
  							            <label class="text-dark mt-2 font-weight-medium">NRC Back</label>
  								       <div class="form-group">
                                            <input type="file" name="idback" class="form-control-file">
                                        </div>
  							        </div>
                                
                                    <!-- Upload Collateral -->
                                    <div class="col-sm-6">
                                        <label class="text-dark mt-2 font-weight-medium">Photos for 1st Collateral</label>
                                        <div class="form-group">
                                            <input type="file" value="<?php echo $collateral1_img; ?>" name="collateral1[]" class="form-control-file" multiple>
                                        </div>
                                    </div>
                                    
                                    <!-- Upload 2nd Collateral -->
                                    <div class="col-sm-6">
                                        <label class="text-dark mt-2 font-weight-medium">Photos for 2nd Collateral</label>
                                        <div class="form-group">
                                            <input type="file" value="<?php echo $collateral2_img; ?>" name="collateral2[]" class="form-control-file" multiple>
                                        </div>
                                    </div>
                                    
                                    <!-- Upload 3rd Collateral -->
                                    <div class="col-sm-6" id="collateral3_container">
                                        <label class="text-dark mt-2 font-weight-medium">Photos for 3rd Collateral</label>
                                        <div class="form-group">
                                            <input type="file" value="<?php echo $collateral3_img; ?>" name="collateral3[]" class="form-control-file" multiple>
                                        </div>
                                    </div>
                                    
                                    <!-- Upload 4th Collateral -->
                                    <div class="col-sm-6" id="collateral4_container">
                                        <label class="text-dark mt-2 font-weight-medium">Photos for 4th Collateral</label>
                                        <div class="form-group">
                                            <input type="file" value="<?php echo $collateral4_img; ?>" name="collateral4[]" class="form-control-file" multiple>
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
                            	        	<input type="submit" name="btn_loanapply" style="background-color:#1976d2; color:#fff" class="btn" value="Apply for Loan" onclick="add_confirm()">
                        		        </div>
  							        </div>
  							        
  							    </div>
							</form>
							<?php } ?>
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