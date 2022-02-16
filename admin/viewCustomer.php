<?php include 'views/head.php'; ?>
<body class="sidebar-fixed sidebar-dark header-fixed header-light" id="body">
<div class="mobile-sticky-body-overlay"></div>
  <div class="wrapper">
    <?php include 'views/sidebar_without_footer.php'; ?>

    <div class="page-wrapper">
      <?php include 'views/header.php'; ?>

      <div class="content-wrapper">
        <div class="content">							
        	<div class="breadcrumb-wrapper">
				<h1>View Customer Details</h1>	
        		<nav aria-label="breadcrumb">
        			<ol class="breadcrumb p-0">
        				<li class="breadcrumb-item">
        					<a href="index.html">
        						<span class="mdi mdi-home"></span>                
        					</a>
        				</li>
        				<li class="breadcrumb-item">Customers</li>
        				<li class="breadcrumb-item">View</li>
        			</ol>
        		</nav>
        	</div>

            <!-- Row 1 - Basic Information -->
			<div class="row">
				<div class="col-lg-12">
					<div class="card card-default">
						<div class="card-header card-header-border-bottom">
							<h2>Basic Information</h2>
						</div>
						<div class="card-body" style="overflow-x: auto;">
						    <div class="row">
						        <?php
						        if(isset($_GET['mobile'])) :
                                    $cust_ID = $_GET['mobile'];
                                    $nrcFront = "";
                                    
                                    $loan_query = "SELECT * FROM lms_loans WHERE mobileno = '$cust_ID'";
                                    $loan_result = $mysqli->query($loan_query);
                                    
                                    while($customer = $loan_result->fetch_assoc()) : 
                                        $custNum = $customer['mobileno'];        
                                        $loanamount = $customer['loan_amount'];        
                                        $loanrate = $customer['loan_rate'];       
                                        $loanduration = $customer['loan_duration'];       
                                        $interest = $customer['earning'];       
                                        $collateral_value = $customer['collateral_val'];  
                                        $loanstatus = $customer['loan_status'];  
                                        
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
                                        
                                        $collateral1_img = $customer['collateral1'];       
                                        $collateral2_img = $customer['collateral2'];       
                                        $collateral3_img = $customer['collateral3'];       
                                        $collateral4_img = $customer['collateral4'];
                                        
                                        $nrcFront = $customer['nrc_front'];       
                                        $nrcBack = $customer['nrc_back'];       
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
                                    endwhile;
                                endif;
                                ?>
						        
						        <?php if($cust_img != "") : ?>
						        <div class="container text-center" id="custImg">
						            <img width="150" height="120" class="img-responsive mb-3"  src="assets/img/user/<?= $cust_img ?>" id="cust_img">
						        </div>
						        <?php endif; ?>
						        
						        <div class="col-sm-6">
							        <table class="table table-hover table-bordered">
							        	<tbody>
							        		<tr>
							        			<td>First Name</td>
							        			<td><?php echo $firstname; ?></td>
							        		</tr>
							        		<tr>
							        			<td>Middle Name</td>
							        			<td><?php echo $middlename; ?></td>
							        		</tr>
							        		<tr>
							        			<td>Last Name</td>
							        			<td><?php echo $lastname; ?></td>
							        		</tr>
							        		<tr>
							        			<td>Identity No</td>
							        			<td><?php echo $idno; ?></td>
							        		</tr>
							        		<tr>
							        			<td>Mobile No.</td>
							        			<td><?php echo $mobileno; ?></td>
							        		</tr>
							        		<tr>
							        			<td>Email</td>
							        			<td><?php echo $email; ?></td>
							        		</tr>
							        	</tbody>
							        </table> 
						        </div>
						        
						        
						        <div class="col-sm-6">
							        <table class="table table-hover table-bordered">
							        	<tbody>
							        		<tr>
							        			<td>Date of Birth</td>
							        			<td><?php echo $dob; ?></td>
							        		</tr>
							        		<tr>
							        			<td>Gender</td>
							        			<td><?php echo $gender; ?></td>
							        		</tr>
							        		<tr>
							        			<td>Address</td>
							        			<td><?php echo $address; ?></td>
							        		</tr>
							        		<tr>
							        			<td>City</td>
							        			<td><?php echo $city_town; ?></td>
							        		</tr>
							        		<tr>
							        			<td>Province</td>
							        			<td><?php echo $province; ?></td>
							        		</tr>
							        		<tr>
							        			<td>Country</td>
							        			<td>Zambia</td>
							        		</tr>
							        	</tbody>
							        </table> 
							     </div>
							     
			    				     <?php if($idno == "" || $gender == "" || $address == "" || $city_town == "" || $province == "") { ?>
			    				     <div class="col-sm-12">
			    				            <p class="h6 text-center text-danger mt-1"><i class="fas fa-exclamation-circle"></i> Ask customer to update their user profile.</p>
			    				     </div>
			    				     <?php } ?>
			    				     
			    			        <?php if($nrcFront != "") { ?>
			    			        <div class="col-sm-12">
			    			            <p class="lead mt-2">Uploaded NRC Images</p>
			    				        <table class="table table-hover table-bordered">
			    				        	<tbody>
			    				        		<tr>
			    				        			<td>NRC Front</td>
			    				        			<td><img width="50" height="50" onclick="openFullscreen(this);" class="img-responsive"  src="assets/img/loans/<?= $nrcFront ?>" id="collateral1"></td>
			    				        		</tr>
			    				        		<tr>
			    				        			<td>NRC Back</td>
			    				        			<td><img width="50" height="50" onclick="openFullscreen(this);" class="img-responsive"  src="assets/img/loans/<?= $nrcBack ?>" id="collateral2"></td>
			    				        		</tr>
			    				        	</tbody>
			    				        </table> 
			    				     </div>
			    				     <?php } else { ?>
			    				     <div class="col-sm-12">
			    				            <p class="h6 text-center text-danger mt-3"><i class="fas fa-exclamation-circle"></i> This customer has not uploaded any photo of their id (NRC, Drivers License, or Passport)</p>
			    				     </div>
			    				     <?php } ?>
						    </div>
						</div>
					</div>
				</div>
			</div> 

            
            <?php if(mysqli_num_rows($loan_result)) { ?>
                <!-- Row 2 - Loan Information -->
			    <div class="row">
			    	<div class="col-lg-12">
			    		<div class="card card-default">
			    			<div class="card-header card-header-border-bottom">
			    				<h2>Loan Information</h2>
			    			</div>
			    			<div class="card-body" style="overflow-x: auto;">
			    			    <div class="row">
			    			        <div class="col-sm-6">
			    				        <table class="table table-hover table-bordered">
			    				        	<tbody>
			    				        		<tr>
			    				        			<td>Loan Amount</td>
			    				        			<td>ZMW <?php echo $loanamount; ?></td>
			    				        		</tr>
			    				        		<tr>
			    				        			<td>Loan Duration</td>
			    				        			<td><?php echo $loanduration; ?> Week(s)</td>
			    				        		</tr>
			    				        		<tr>
			    				        			<td>Loan Rate</td>
			    				        			<td><?php echo $loanrate; ?>%</td>
			    				        		</tr>
			    				        		<tr>
			    				        			<td>Loan Status</td>
			    				        			<td><?php echo $loanstatus; ?></td>
			    				        		</tr>
			    				        	</tbody>
			    				        </table> 
			    			        </div>
			    			        <div class="col-sm-6">
			    				        <table class="table table-hover table-bordered">
			    				        	<tbody>
			    				        		<tr>
			    				        			<td>Interest Earning</td>
			    				        			<td>ZMW <?php echo $interest; ?></td>
			    				        		</tr>
			    				        		<tr>
			    				        			<td>Collateral Value</td>
			    				        			<td>ZMW <?php echo $collateral_value; ?></td>
			    				        		</tr>
			    				        		<tr>
			    				        			<td>Total Owing</td>
			    				        			<td>ZMW <?php echo $loanamount + $interest; ?></td>
			    				        		</tr>
			    				        	</tbody>
			    				        </table> 
			    				     </div>
			    			    </div>
			    			</div>
			    		</div>
			    	</div>
			    </div> 

                <!-- Row 3 - Collateral Information -->
			    <div class="row">
			    	<div class="col-lg-12">
			    		<div class="card card-default">
			    			<div class="card-header card-header-border-bottom">
			    				<h2>Collateral Information</h2>
			    			</div>
			    			<div class="card-body" style="overflow-x: auto;">
			    			    <div class="row">
			    			        <div class="col-sm-12">
			    			            <p class="lead mt-0">Collateral Details</p>
			    				        <table class="table table-hover table-bordered">
			    					        <thead>
			    					        	<tr>
			    					        		<th scope="col">ID</th>
			    					        		<th scope="col">Brand</th>
			    					        		<th scope="col">Serial Number</th>
			    					        		<th scope="col">Description</th>
			    					        	</tr>
			    					        </thead>
			    				        	<tbody>
			    				        		<tr>
			    				        			<td>1</td>
			    				        			<td><?php echo $brandname; ?></td>
			    				        			<td><?php echo $serialnumber; ?></td>
			    				        			<td><?php echo $description; ?></td>
			    				        		</tr>
			    				        		<?php if($brandname2 != "") { ?>
			    				        		<tr>
			    				        			<td>2</td>
			    				        			<td><?php echo $brandname2; ?></td>
			    				        			<td><?php echo $serialnumber2; ?></td>
			    				        			<td><?php echo $description2; ?></td>
			    				        		</tr>
			    				        		<?php } ?>
			    				        		
			    				        		<?php if($brandname3 != "") { ?>
			    				        		<tr>
			    				        			<td>3</td>
			    				        			<td><?php echo $brandname3; ?></td>
			    				        			<td><?php echo $serialnumber3; ?></td>
			    				        			<td><?php echo $description3; ?></td>
			    				        		</tr>
			    				        		<?php } ?>
			    				        		
			    				        		<?php if($brandname4 != "") { ?>
			    				        		<tr>
			    				        			<td>4</td>
			    				        			<td><?php echo $brandname4; ?></td>
			    				        			<td><?php echo $serialnumber4; ?></td>
			    				        			<td><?php echo $description4; ?></td>
			    				        		</tr>
			    				        		<?php } ?>
			    				        	</tbody>
			    				        </table> 
			    			        </div>
			    			        
			    			        <div class="col-sm-12">
			    			            <p class="lead mt-2">Uploaded Collateral Images</p>
			    				        <table class="table table-hover table-bordered">
			    				        	<tbody>
			    				        		<tr  id="firstCollat">
			    				        			<td>1st Collateral</td>
			    				        			<td><img width="50" height="50" onclick="openFullscreen(this);" class="img-responsive"  src="assets/img/loans/<?= $collateral1_img ?>" id="collateral1"></td>
			    				        		</tr>
			    				        		
			    				        		<?php if($collateral2_img != "") { ?>
			    				        		<tr id="secondCollat">
			    				        			<td>2nd Collateral</td>
			    				        			<td><img width="50" height="50" onclick="openFullscreen(this);" class="img-responsive"  src="assets/img/loans/<?= $collateral2_img ?>" id="collateral2"></td>
			    				        		</tr>
			    				        		<?php } ?> 
			    				        		
			    				        		<?php if($collateral3_img != "") { ?>
			    				        		<tr id="thirdCollat">
			    				        			<td>3rd Collateral</td>
			    				        			<td><img width="50" height="50" onclick="openFullscreen(this);" class="img-responsive"  src="assets/img/loans/<?= $collateral3_img ?>" id="collateral3"></td>
			    				        		</tr>
			    				        		<?php } ?> 
			    				        		
			    				        		<?php if($collateral4_img != "") { ?>
			    				        		<tr id="fourthCollat">
			    				        			<td>4th Collateral</td>
			    				        			<td><img width="50" height="50" onclick="openFullscreen(this);" class="img-responsive"  src="assets/img/loans/<?= $collateral4_img ?>" id="collateral4"></td>
			    				        		</tr>
			    				        		<?php } ?> 
			    				        	</tbody>
			    				        </table> 
			    				        <?php 
                                            $query = "SELECT * FROM lms_loans WHERE mobileno = '$mobileNumber'";
                                            $result = $mysqli->query($query);
            
                                            while($row = $result->fetch_assoc()) { 
                                                $rate = $row['loan_rate'] / 100;
                                                $mobileNo = $row['mobileno'];
                                            }
                                        ?>
			    				        <div class="text-center pt-2">
			    				            <!--<a href="viewCustomer.php?mobile=<?php //echo $row['mobileno'] ?>" class="btn btn-md btn-primary"><span class="far fa-eye"></span></a>-->
                                            <?php if ($loanstatus == 'pending'){ ?>
                                                <a href="index.php?approve=<?= $custNum ?>" class="btn btn-sm btn-success"><i class="far fa-check-circle"></i> Approve</a>
                                            <?php } ?>
                                            <?php if ($loanstatus == 'approved'){ ?>
                                                <a href="loans_approved.php?disburse=<?= $custNum ?>" class="btn btn-sm btn-info"><span class="fas fa-check"> Disburse</span></a>
                                            <?php } ?>
                                            <?php if ($loanstatus == 'disbursed'){ ?>
                                                <a href="loans_disbursed.php?clear=<?= $custNum ?>" class="btn btn-sm btn-success"><i class="far fa-thumbs-up"></i> Clear Loan</a>
                                                <a href="loans_defaulted.php?default=<?= $custNum ?>" class="btn btn-sm btn-warning ml-1"><i class="fas fa-exclamation-triangle"></i> Default</a>
                                            <?php } ?>
                                            <?php if ($loanstatus != 'disbursed' && $loanstatus != 'cleared' && $loanstatus != 'rejected' && $loanstatus != 'defaulted'){ ?>
			                                    <a href="index.php?reject=<?= $custNum ?>" class="btn btn-sm btn-danger ml-1"><i class="far fa-times-circle"></i> Reject Loan</span></a>
			                                <?php } ?>
			                                <?php if ($loanstatus == 'defaulted'){ ?>
			    				                <div class="col-sm-12">
			    				                       <p class="h6 text-center text-danger mt-1"><i class="fas fa-exclamation-circle"></i> Customer has defaulted.</p>
			    				                </div>
			                                <?php } ?>
			    				        </div>
			    				     </div>
			    			    </div>
			    			</div>
			    		</div>
			    	</div>
			    </div> 
			<?php } ?>

        </div><!-- end content -->
      </div><!-- end content-wrapper -->
<?php include 'views/footer.php'; ?>

<?php 
    // Delete User from db
    if(isset($_GET['delete'])) {
        $loan_ID = $_GET['delete'];
        $loan_query = "DELETE FROM peri_users WHERE id = '$loan_ID'";
        $result = mysqli_query($conn, $loan_query);
        if($result) {
            header("location: index.php");
        }
    }

    // Change loan status to approved
    if(isset($_GET['approve'])) {
        $approve_id = $_GET['approve'];
        $sql_loans = "UPDATE peri_loans SET loan_status = 'approved' WHERE mobileno = '$approve_id'";
        $sql_result = mysqli_query($conn, $sql_loans);

        if($sql_result) {
            header('location: index.php');
        }
    }
    
    // Change loan status to approved
    if(isset($_GET['disburse'])) {
        $disburse_id = $_GET['disburse'];
        $sql_loans = "UPDATE peri_loans SET loan_status = 'disbursed' WHERE mobileno = '$disburse_id'";
        $sql_result = mysqli_query($conn, $sql_loans);

        if($sql_result) {
            header('location: loans_approved.php');
        }
    }

    // Change loan status to rejected
    if(isset($_GET['reject'])) {
        $reject_id = $_GET['reject'];
        $sql_loans = "UPDATE peri_loans SET loan_status = 'rejected' WHERE mobileno = '$reject_id'";
        $sql_result = mysqli_query($conn, $sql_loans);

        if($sql_result) {
            header('location: index.php');
        }
    }

    // Change loan status to default
    if(isset($_GET['default'])) {
        $default_id = $_GET['default'];
        $sql_loans = "UPDATE peri_loans SET loan_status = 'defaulted' WHERE mobileno = '$default_id'";
        $sql_result = mysqli_query($conn, $sql_loans);

        if($sql_result) {
            header('location: viewCustomer.php');
        }
    }
?>
