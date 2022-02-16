<?php
    //connect to database
    include_once('database/connect.php');
    
    include 'views/head.php'; 
?>
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
                                        
                                        $collateral1_img = $customer['collateral1'];       
                                        $collateral2_img = $customer['collateral2'];       
                                        $collateral3_img = $customer['collateral3'];       
                                        $collateral4_img = $customer['collateral4'];       
                                    }
                                }
                                ?>
						        <div class="container text-center" id="custImg">
						            <img width="150" height="120" class="img-responsive mb-3"  src="assets/img/user/<?= $cust_img ?>" id="cust_img">
						        </div>
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
						    </div>
						</div>
					</div>
				</div>
			</div> 

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
							        			<td><?php echo $loanamount; ?></td>
							        		</tr>
							        		<tr>
							        			<td>Loan Type</td>
							        			<td><?php echo $loantype; ?></td>
							        		</tr>
							        		<tr>
							        			<td>Loan Duration</td>
							        			<td><?php echo $loanduration; ?></td>
							        		</tr>
							        	</tbody>
							        </table> 
						        </div>
						        <div class="col-sm-6">
							        <table class="table table-hover table-bordered">
							        	<tbody>
							        		<tr>
							        			<td>Loan Rate</td>
							        			<td><?php echo $loanrate; ?></td>
							        		</tr>
							        		<tr>
							        			<td>Interest Earning</td>
							        			<td><?php echo $interest; ?></td>
							        		</tr>
							        		<tr>
							        			<td>Collateral Value</td>
							        			<td><?php echo $collateral_value; ?></td>
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
							        		<tr>
							        			<td>2</td>
							        			<td><?php echo $brandname2; ?></td>
							        			<td><?php echo $serialnumber2; ?></td>
							        			<td><?php echo $description2; ?></td>
							        		</tr>
							        		<tr>
							        			<td>3</td>
							        			<td><?php echo $brandname3; ?></td>
							        			<td><?php echo $serialnumber3; ?></td>
							        			<td><?php echo $description3; ?></td>
							        		</tr>
							        		<tr>
							        			<td>4</td>
							        			<td><?php echo $brandname4; ?></td>
							        			<td><?php echo $serialnumber4; ?></td>
							        			<td><?php echo $description4; ?></td>
							        		</tr>
							        	</tbody>
							        </table> 
						        </div>
						        <div class="col-sm-12">
						            <p class="lead mt-2">Uploaded Collateral Images</p>
							        <table class="table table-hover table-bordered">
							        	<tbody>
							        		<tr>
							        			<td>1st Collateral</td>
							        			<td><img width="50" height="50" onclick="openFullscreen(this);" class="img-responsive"  src="assets/img/loans/<?= $collateral1_img ?>" id="collateral1"></td>
							        		</tr>
							        		<tr>
							        			<td>2nd Collateral</td>
							        			<td><img width="50" height="50" onclick="openFullscreen(this);" class="img-responsive"  src="assets/img/loans/<?= $collateral2_img ?>" id="collateral2"></td>
							        		</tr>
							        		<tr>
							        			<td>3rd Collateral</td>
							        			<td><img width="50" height="50" onclick="openFullscreen(this);" class="img-responsive"  src="assets/img/loans/<?= $collateral3_img ?>" id="collateral3"></td>
							        		</tr>
							        		<tr>
							        			<td>4th Collateral</td>
							        			<td><img width="50" height="50" onclick="openFullscreen(this);" class="img-responsive"  src="assets/img/loans/<?= $collateral4_img ?>" id="collateral4"></td>
							        		</tr>
							        	</tbody>
							        </table> 
							     </div>
						    </div>
						</div>
					</div>
				</div>
			</div> 

        </div><!-- end content -->
      </div><!-- end content-wrapper -->
<?php include 'views/footer.php'; ?>
