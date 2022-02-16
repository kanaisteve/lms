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
                    <!-- Row 1 -->
                    <div class="row">
						<div class="col-md-6 col-lg-6 col-xl-3">
							<div class="card widget-block p-4 rounded bg-white border">
						        <?php 
						        	$loans_disbursed_query = "SELECT SUM(loan_amount) as total_loans_disbursed FROM peri_loan_applications  WHERE loan_status = 'disbursed'";
						        	$total_loans_disbursed = mysqli_query($conn, $loans_disbursed_query);
						        	$row=mysqli_fetch_array($total_loans_disbursed);
                                    if($row['total_loans_disbursed']>0){
                                        $loansdisbursed = $row['total_loans_disbursed'];   
                                    }else{
                                        $loansdisbursed = '0';    
                                    }
						        ?>
								<div class="card-block">
									<!-- <i class="mdi mdi-cart-outline text-danger mr-4"></i> -->
                                    <i class="fas fa-coins text-danger mr-4"></i>
									<h4 class="text-primary my-2">ZMW <?php echo $loansdisbursed; ?></h4>
									<p>Loans Disbursed</p>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-lg-6 col-xl-3">
							<div class="card widget-block p-4 rounded bg-white border">
								<?php 
                                    $borrowers_query = "SELECT * FROM peri_loan_applications WHERE loan_status = 'pending'";
                                    $borrowers_result = mysqli_query($conn, $borrowers_query);
                                    $num_borrowers = mysqli_num_rows($borrowers_result);
                                ?>
								<div class="card-block">
									<!-- <i class="mdi mdi-cart-outline text-danger mr-4"></i> -->
                                    <i class="fas fa-chart-line text-primary mr-4"></i>
									<h4 class="text-primary my-2"><?php echo $num_borrowers ?></h4>
									<p>Total Pendings</p>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-lg-6 col-xl-3">
							<div class="card widget-block p-4 rounded bg-white border">
						        <?php 
						        	$earnings_query = "SELECT SUM(earnings) as total_earnings FROM peri_loan_applications  WHERE loan_status = 'disbursed'";
						        	$total_earnings = mysqli_query($conn, $earnings_query);
						        	$row=mysqli_fetch_array($total_earnings);
                                    if($row['total_earnings']>0){
                                        $totalearning = $row['total_earnings'];   
                                    }else{
                                        $totalearning = '0';    
                                    }
						        ?>
								<div class="card-block">
									<!-- <i class="mdi mdi-diamond text-success mr-4"></i> -->
                                    <i class="fas fa-money-bill-wave text-success mr-4"></i>
									<h4 class="text-primary my-2">ZMW <?php echo $totalearning; ?></h4>
									<p>Interest Earnings</p>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-lg-6 col-xl-3">
							<div class="card widget-block p-4 rounded bg-white border">
								<div class="card-block">
						            <?php 
						            	$collateral_query = "SELECT SUM(collateral_value) as total_collateral FROM peri_loan_applications  WHERE loan_status = 'disbursed'";
						            	$total_collateral = mysqli_query($conn, $collateral_query);
						            	$row=mysqli_fetch_array($total_collateral);
                                        if($row['total_collateral']>0){
                                            $totalcollateral = $row['total_collateral'];   
                                        }else{
                                            $totalcollateral = '0';    
                                        }
						            ?>
                                    <i class="fas fa-cubes  text-warning mr-4"></i>
									<h4 class="text-primary my-2">ZMW <?php echo $totalcollateral; ?></h4>
									<p>Collateral</p>
								</div>
							</div>
						</div>
					</div>	
									 
                     <!--Row 2 -->
                     <div class="row">
        <!--                <div class="col-xl-3 col-sm-6">-->
        <!--                  <div class="card card-mini mb-4">-->
        <!--                    <div class="card-body">-->
								<!--<?php 
        //                             $af_query = "SELECT * FROM  lms_available_funds";
								// 	$af_result = mysqli_query($conn, $af_query);
								// 	$row = mysqli_fetch_assoc($af_result);
								// 	$af = $row['available_amount'];
                                    ?>
                                <!--<h2 class="mb-1">ZMW <?php //echo $af ?></h2>-->
        <!--                        <p>Available Funds</p>-->
        <!--                    </div>-->
        <!--                  </div>-->
        <!--                </div>-->
                        <!--<div class="col-xl-3 col-sm-6">-->
                        <!--    <div class="card card-mini mb-4">-->
                        <!--        <div class="card-body">-->
                        <!--            <h2 class="mb-1">53</h2>-->
                        <!--            <p>No. of Unpaid</p>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!--<div class="col-xl-3 col-sm-6">-->
                        <!--    <div class="card card-mini  mb-4">-->
                        <!--        <div class="card-body">-->
                        <!--            <h2 class="mb-1">ZMW 9,503</h2>-->
                        <!--            <p>Total Unpaid</p>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!--<div class="col-xl-3 col-sm-6">-->
                        <!--    <div class="card card-mini mb-4">-->
                        <!--      <div class="card-body">-->
                        <!--        <h2 class="mb-1">ZMW 71,503</h2>-->
                        <!--        <p>Overdue Amount</p>-->
                        <!--      </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                    </div> 
					
					<!-- Row 0 -->
					<!--<div class="row">-->
						<!--<div class="col-md-6 col-lg-6 col-xl-6">-->
  							<!-- Total User -->
							<!--<a href="users.php">-->
							<!--	<div class="media widget-media p-4 rounded bg-white border">-->
							<!--		<i class="fas fa-users mr-4"></i>-->
							<!--		<div class="media-body align-self-center">-->
                            	        <?php 
                            	            //$user_query = "SELECT * FROM dsa_users";
                            	            //$user_result = mysqli_query($conn, $user_query);
                            	            //$num_users = mysqli_num_rows($user_result);
                            	        ?>
										<!--<h4 class="mb-2" ><?php //$num_users ?></h4>-->
						<!--				<p>Users</p>-->
						<!--			</div>-->
						<!--		</div>-->
						<!--	</a>-->
						<!--</div>-->
						<!--<div class="col-md-6 col-lg-6 col-xl-6">-->
  							<!-- Total Data Colle -->
							<!--<a href="data_collected.php">-->
								<!--<div class="media widget-media p-4 rounded bg-white border">-->
									<!--<i class="fas fa-briefcase mr-4 text-danger"></i>-->
									<!--<div class="media-body align-self-center">-->
										<?php 
                            	            //$data_collected_query = "SELECT * FROM dsa_records";
                            	            //$data_collected_result = mysqli_query($conn, $data_collected_query);
                            	            //$num_data_collected = mysqli_num_rows($data_collected_result);
                            	        ?>
										<!--<h4 class="mb-2"><?php //$num_data_collected ?></h4>-->
										<!--<p>Data Collected</p>-->
					<!--				</div>-->
					<!--			</div>-->
					<!--		</a>-->
					<!--	</div>-->
					<!--</div>-->
                    
			        <div class="row">
			        	<div class="col-lg-12">
			        		<div class="card card-default">
			        			<div class="card-header card-header-border-bottom">
			        				<h2>Loans Awaiting Approval</h2>
			        			</div>
			        			<div class="card-body" style="overflow-x: auto;">
			        				<table class="table table-hover" id="pending-table">
			        					<thead>
			        						<tr>
			        							<th scope="col">ID</th>
                                                <th scope="col">Date</th>
			        							<th scope="col">Customer</th>
			        							<th scope="col">Principal</th>
			        							<th scope="col">Duration</th>
			        							<th scope="col">IR</th>
			        							<th scope="col">Earning</th>
			        							<th scope="col">Status</th>
			        							<th scope="col">Action</th>
			        						</tr>
			        					</thead>
								        <tbody>
								        	<tr>
                                                <?php 
                                                $query = "SELECT * FROM peri_loan_applications WHERE loan_status = 'pending'";
                                                $result = mysqli_query($conn, $query);
            
                                                while($row = mysqli_fetch_array($result)) { 
                                                $rate = $row['loan_rate'] / 100;
                                                ?>
								        		<td><?= $row['loan_id']; ?></td>
								        		<td><?= $row['date_created']; ?></td>
								        		<td><?php echo $row['firstname'] . " " . $row['middlename']. " " . $row['lastname']; ?></td>
								        		<td><?= $row['loan_amount']; ?></td>
								        		<td><?= $row['loan_duration'] . " Week(s)"; ?></td>
								        		<td><?= $row['loan_rate'] . "%"; ?></td>
								        		<td><?= $rate * $row['loan_amount']; ?></td>
								        		<td><span class="badge badge-warning"><?= $row['loan_status']; ?></span></td>
			                                    <td>
                                                    <a href="viewCustomer.php?id=<?= $row['loan_id'] ?>" class="btn btn-sm btn-primary"><span class="far fa-eye"></span></a>
                                                    <a href="index.php?approve=<?= $row['loan_id'] ?>" class="btn btn-sm btn-success"><span class="fas fa-check"></span></a>
			                                    	<a href="index.php?reject=<?= $row['loan_id'] ?>" class="btn btn-sm btn-danger"><span class="fas fa-times"></span></a>
			                                    </td>
								        	</tr>
								        	<?php } ?>
								        </tbody>
			        				</table>
			        			</div>
			        		</div>
			        	</div>
			        </div>
          
                    <!-- Row 6 -->
		            <div class="row"><div></div>
		
                </div><!-- end content -->
            </div><!-- end content-wrapper -->
        </div><!-- end page-wrapper -->
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
        $sql_loans = "UPDATE peri_loan_applications SET loan_status = 'approved' WHERE loan_id = '$approve_id'";
        $sql_result = mysqli_query($conn, $sql_loans);

        if($sql_result) {
            header('location: index.php');
        }
    }

    // Change loan status to rejected
    if(isset($_GET['reject'])) {
        $reject_id = $_GET['reject'];
        $sql_loans = "UPDATE peri_loan_applications SET loan_status = 'rejected' WHERE loan_id = '$reject_id'";
        $sql_result = mysqli_query($conn, $sql_loans);

        if($sql_result) {
            header('location: index.php');
        }
    }
?>
