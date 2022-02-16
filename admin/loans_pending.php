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
			        				<h2>Loans Pending</h2>
			        			</div>
			        			<div class="card-body" style="overflow-x: auto;">
                                    <?php 
                                        $sn = 1;
                                        $loans = $loanObj->fetchPendingLoans();
                                        if($loans !== false) :
                                            foreach ($loans as $loan) :
                                    ?>
			        				<table class="table table-hover" id="pending-table">
			        					<thead>
			        						<tr>
			        							<th scope="col">ID</th>
                                                <th scope="col">Date</th>
			        							<th scope="col">Customer</th>
			        							<th scope="col">Loan Amount</th>
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
			        						    <!--<td><?php //echo $row['firstname'] . " " . $row['middlename']. " " . $row['lastname']; ?></td>-->
			        						    <td><?= $loan['loan_amount']; ?></td>
			        						    <td><?= $loan['loan_duration'] . " Week(s)"; ?></td>
			        						    <td><?= $loan['loan_rate'] . "%"; ?></td>
			        						    <td><?= $loan['earning']; ?></td>
			        						    <td><span class="badge badge-warning"><?= $loan['loan_status']; ?></span></td>
			                                    <td>
                                                    <a href="viewCustomer.php?mobile=<?= $loan['mobileno'] ?>" class="btn btn-sm btn-primary"><span class="far fa-eye"></span></a>
                                                    <a href="loans_pending.php?approve=<?= $loan['mobileno'] ?>" class="btn btn-sm btn-success"><i class="far fa-check-circle"></i></a>
			                                       	<a href="loans_pending.php?reject=<?= $loan['mobileno'] ?>" class="btn btn-sm btn-danger"><i class="far fa-times-circle"></i></a>
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
