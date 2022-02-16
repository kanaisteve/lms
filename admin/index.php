<?php 
    include 'views/head.php';
    
    // include database file 
    include 'libs/loans.php';
    $loanObj = new Loans();
    
    // Change loan status to approved
    if(isset($_GET['approve'])  && !empty($_GET['approve'])) {
        $approve_id = $_GET['approve'];
        $loanObj->approveLoan($approve_id);
    }

    // Change loan status to rejected
    if(isset($_GET['reject'])  && !empty($_GET['reject'])) {
        $reject_id = $_GET['reject'];
        $loanObj->rejectLoan($reject_id);
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
                    <!-- Row 1 -->
                    <div class="row">
						<div class="col-md-6 col-lg-6 col-xl-3">
							<div class="card widget-block p-4 rounded bg-white border">
						        <a href="loans_disbursed.php">
								    <div class="card-block">
								    	<!-- <i class="mdi mdi-cart-outline text-danger mr-4"></i> -->
                                        <p class="lead text-dark">No. of Disbursed: <?php echo $loanObj->countLoansDisbursed(); ?></p>
								    	<h4 class="text-primary my-2">ZMW <?php echo $loanObj->totalLoansDisbursed(); ?></h4>
								    	<p class="text-muted">Loans Disbursed</p>
								    </div>
								</a>
							</div>
						</div>
						<div class="col-md-6 col-lg-6 col-xl-3">
							<div class="card widget-block p-4 rounded bg-white border">
                                <a href="loans_pending.php">
								    <div class="card-block">
								    	<!-- <i class="mdi mdi-cart-outline text-danger mr-4"></i> -->
                                        <!--<i class="fas fa-chart-line text-primary mr-4"></i>-->
                                        <p class="lead text-dark">No. of Pending: <?php echo $loanObj->countLoansPending(); ?></p>
								    	<h4 class="text-primary my-2">ZMW <?php echo $loanObj->totalLoansPending(); ?></h4>
								    	<p class="text-muted">Total Pendings</p>
								    </div>
								</a>
							</div>
						</div>
						<div class="col-md-6 col-lg-6 col-xl-3">
							<div class="card widget-block p-4 rounded bg-white border">
						        <a href="loans_cleared.php">
								    <div class="card-block">
								    	<!-- <i class="mdi mdi-diamond text-success mr-4"></i> -->
                                        <i class="fas fa-money-bill-wave text-success mr-4"></i>
								    	<h4 class="text-primary my-2">ZMW <?php echo $loanObj->totalEarnings(); ?></h4>
								    	<p class="text-muted">Interest Earnings</p>
								    </div>
								</a>
							</div>
						</div>
						<div class="col-md-6 col-lg-6 col-xl-3">
							<div class="card widget-block p-4 rounded bg-white border">
								<div class="card-block">
                                    <i class="fas fa-cubes  text-warning mr-4"></i>
									<h4 class="text-primary my-2">ZMW <?php echo $loanObj->totalCollateral(); ?></h4>
									<p>Collateral</p>
								</div>
							</div>
						</div>
					</div>	
                    
			        <div class="row">
			        	<div class="col-lg-12">
			        		<div class="card card-default">
			        			<div class="card-header card-header-border-bottom">
			        				<h2>Loans Awaiting Approval</h2>
			        			</div>
			        			<!--<h5 class="ml-4">Hello: <?php //echo $loanObj->totalLoans(); ?></h5>-->
			        			<div class="card-body" style="overflow-x: auto;">
                                    <?php 
                                        $sn = 1;
                                        $loans = $loanObj->fetchPendingLoans();
                                        if($loans !== false) :
                                            foreach ($loans as $loan) :
                                            $rate = $loan['loan_rate'] / 100;
                                    ?>
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
								        		<td><?= $sn; ?></td>
								        		<td><?= $loan['date_created']; ?></td>
								        		<td><?= $loan['name']; ?></td>
								        		<td><?= $loan['loan_amount']; ?></td>
								        		<td><?= $loan['loan_duration'] . " Week(s)"; ?></td>
								        		<td><?= $loan['loan_rate'] . "%"; ?></td>
								        		<td><?= $rate * $loan['loan_amount']; ?></td>
								        		<td><span class="badge badge-warning"><?= $loan['loan_status']; ?></span></td>
			                                    <td>
                                                    <a href="viewCustomer.php?mobile=<?= $loan['mobileno'] ?>" class="btn btn-sm btn-primary"><span class="far fa-eye"></span></a>
                                                    <a href="index.php?approve=<?= $loan['mobileno'] ?>" class="btn btn-sm btn-success"><i class="far fa-check-circle"></i></a>
			                                    	<a href="index.php?reject=<?= $loan['mobileno'] ?>" class="btn btn-sm btn-danger"><i class="far fa-times-circle"></i></a>
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
