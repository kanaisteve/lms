<?php 
    include 'views/head.php'; 
    
    // set timezone
    date_default_timezone_set('Africa/Lusaka');
    
    include 'libs/loans.php'; 
    include_once 'libs/loan_form.php';
    $loanObj = new Loans();
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
                    <!-- Row 1 -->
                    <div class="row">
                        <!-- How much client got as a loan -->
						<div class="col-md-6 col-lg-6 col-xl-3">
							<div class="card widget-block p-4 rounded bg-white border">
								<div class="card-block">
									<!-- <i class="mdi mdi-cart-outline text-danger mr-4"></i> -->
                                    <i class="fas fa-coins text-danger mr-4"></i>
									<h4 class="text-primary my-2">ZMW <?php echo $loanObj->currentLoan($mobileNumber); ?></h4>
									<p>Current Loan</p>
								</div>
							</div>
						</div>
						
						<!-- How much is customer owing -->
						<div class="col-md-6 col-lg-6 col-xl-3">
							<div class="card widget-block p-4 rounded bg-white border">
								<div class="card-block">
									<!-- <i class="mdi mdi-cart-outline text-danger mr-4"></i> -->
                                    <i class="fas fa-chart-line text-primary mr-4"></i>
									<h4 class="text-primary my-2"><?php echo $loanObj->totalOwing($mobileNumber); ?></h4>
									<p>Total Owing</p>
								</div>
							</div>
						</div>
						
						<?php if($loanStatus == 'disbursed') : ?>
						<!-- Number of days remaining to pay back the loan (should be counting down) -->
						<div class="col-md-6 col-lg-6 col-xl-3">
							<div class="card widget-block p-4 rounded bg-white border">
								<?php
                                ?>
								<div class="card-block">
                                    <i class="fas fa-money-bill-wave text-success mr-4"></i>
									<h4 class="text-primary my-2">
									    <?php echo $loanObj->daysLeft($mobileNumber); ?>
									</h4>
									<p>Days Remaing to Repay</p>
								</div>
							</div>
						</div>
						<?php endif; ?>
						
						<?php if($loanStatus == 'disbursed') : ?>
						<!-- when you suppose to pay back loan -->
						<div class="col-md-6 col-lg-6 col-xl-3">
							<div class="card widget-block p-4 rounded bg-white border">
								<div class="card-block">
                                    <i class="fas fa-cubes  text-warning mr-4"></i>
									<h4 class="text-primary my-2"><?php echo $loanObj->dueDate($mobileNumber); ?></h4>
									<p>Due Date</p>
								</div>
							</div>
						</div>
						<?php endif; ?>
					</div>	
      
			        <div class="row">
			        	<div class="col-lg-12">
			        		<div class="card card-default">
			        			<div class="card-header card-header-border-bottom">
			        				<h2>Loan History</h2>
			        			</div>
			        			<div class="card-body" style="overflow-x: auto;">
                                    <?php 
                                        $sn = 1;
                                        $loans = $loanObj->fetchLoansByMobileNo($mobileNumber);
                                        if($loans !== false) :
                                            foreach ($loans as $loan) :
                                            $rate = $loan['loan_rate'] / 100;
                                    ?>
			        				<table class="table table-hover" id="pending-table">
			        					<thead>
			        						<tr>
			        							<th scope="col">ID</th>
                                                <th scope="col">Loan Date</th>
			        							<th scope="col">Customer</th>
			        							<th scope="col">Principal</th>
			        							<th scope="col">Duration</th>
			        							<th scope="col">IR</th>
			        							<th scope="col">Interest Amnt</th>
			        							<th scope="col">Total Owing</th>
			        							<th scope="col">Status</th>
			        							<th scope="col">Action</th>
			        						</tr>
			        					</thead>
								        <tbody>
								        	<tr>
								        		<td><?= $loan['loan_id']; ?></td>
								        		<td><?= $loan['date_created']; ?></td>
								        		<td><?= $loan['name']; ?></td>
								        		<!--<td><?php //echo $row['firstname'] . " " . $row['middlename']. " " . $row['lastname']; ?></td>-->
								        		<td><?= $loan['loan_amount']; ?></td>
								        		<td><?= $loan['loan_duration'] . " Week(s)"; ?></td>
								        		<td><?= $loan['loan_rate'] . "%"; ?></td>
								        		<td><?= $rate * $loan['loan_amount']; ?></td>
								        		<td><?= ($rate * $loan['loan_amount']) + $loan['loan_amount']; ?></td>
								        		<td><span class="badge badge-warning"><?= $loan['loan_status']; ?></span></td>
			                                    <td>
                                                    <a href="viewLoanDetails.php?id=<?= $mobileNumber ?>" class="btn btn-sm btn-primary"><span class="far fa-eye"></span></a>
                                                    <!--<a href="index.php?approve=<?php //echo $row['loan_id'] ?>" class="btn btn-sm btn-success"><span class="fas fa-check"></span></a>-->
			                                    	<!--<a href="index.php?reject=<?php //$row['loan_id'] ?>" class="btn btn-sm btn-danger"><span class="fas fa-times"></span></a>-->
			                                    </td>
								        	</tr>
								        	<?php
								        	    $sn++;
								        	    endforeach; 
								        	?>
								        </tbody>
			        				</table>
			        				<?php endif; ?>
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
        $loan_query = "DELETE FROM lms_users WHERE id = '$loan_ID'";
        $result = mysqli_query($conn, $loan_query);
        if($result) {
            header("location: index.php");
        }
    }

    // Change loan status to approved
    if(isset($_GET['approve'])) {
        $approve_id = $_GET['approve'];
        $sql_loans = "UPDATE lms_loan_applications SET loan_status = 'approved' WHERE loan_id = '$approve_id'";
        $sql_result = mysqli_query($conn, $sql_loans);

        if($sql_result) {
            header('location: index.php');
        }
    }

    // Change loan status to rejected
    if(isset($_GET['reject'])) {
        $reject_id = $_GET['reject'];
        $sql_loans = "UPDATE lms_loan_applications SET loan_status = 'rejected' WHERE loan_id = '$reject_id'";
        $sql_result = mysqli_query($conn, $sql_loans);

        if($sql_result) {
            header('location: index.php');
        }
    }
?>
