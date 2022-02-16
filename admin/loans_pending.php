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
                                                <?php 
                                                $query = "SELECT * FROM peri_loan_applications WHERE loan_status = 'pending'";
                                                $result = mysqli_query($conn, $query);
            
                                                while($row = mysqli_fetch_array($result)) { ?>
			        						    <td><?= $row['loan_id']; ?></td>
			        							<td><?= $row['date_created']; ?></td>
			        							<td><?php echo $row['firstname'] . " " . $row['middlename']. " " . $row['lastname']; ?></td>
			        							<td><?= $row['loan_amount']; ?></td>
			        							<td><?= $row['loan_duration'] . " Week(s)"; ?></td>
			        							<td><?= $row['loan_rate'] . "%"; ?></td>
			        							<td><?= $row['earnings']; ?></td>
			        							<td><span class="badge badge-warning"><?= $row['loan_status']; ?></span></td>
			                                    <td>
                                                    <a href="viewCustomer.php?id=<?= $row['loan_id'] ?>" class="btn btn-sm btn-primary"><span class="far fa-eye"></span></a>
                                                    <a href="loans_pending.php?approve=<?= $row['loan_id'] ?>" class="btn btn-sm btn-success"><span class="fas fa-check"></span></a>
			                                    	<a href="loans_pending.php?reject=<?= $row['loan_id'] ?>" class="btn btn-sm btn-danger"><span class="fas fa-times"></span></a>
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
    // Delete Loan from db
    if(isset($_GET['delete'])) {
        $loan_ID = $_GET['delete'];
        $loan_query = "DELETE FROM dsa_users WHERE id = '$loan_ID'";
        $result = mysqli_query($conn, $loan_query);
        if($result) {
            header("location: loans_pending.php");
        }
    }

    // Change loan status to approved
    if(isset($_GET['approve'])) {
        $approve_id = $_GET['approve'];
        $sql_loans = "UPDATE peri_loan_applications SET loan_status = 'approved' WHERE mobileno = '$approve_id'";
        $sql_result = mysqli_query($conn, $sql_loans);

        if($sql_result) {
            header('location: loans_pending.php');
        }
    }

    // Change loan status to rejected
    if(isset($_GET['reject'])) {
        $reject_id = $_GET['reject'];
        $sql_loans = "UPDATE peri_loan_applications SET loan_status = 'rejected' WHERE mobileno = '$reject_id'";
        $sql_result = mysqli_query($conn, $sql_loans);

        if($sql_result) {
            header('location: loans_pending.php');
        }
    }
?>
