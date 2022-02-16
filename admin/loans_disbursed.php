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
                    
			        <div class="row">
			        	<div class="col-lg-12">
			        		<div class="card card-default">
			        			<div class="card-header card-header-border-bottom">
			        				<h2>Loans Disbursed</h2>
			        			</div>
			        			<div class="card-body" style="overflow-x: auto;">
			        				<table class="table table-hover" id="disbursed-table">
			        					<thead>
			        						<tr>
			        							<th scope="col">ID</th>
                                                <th scope="col">Date</th>
			        							<th scope="col">Customer</th>
			        							<th scope="col">Disbursed Amnt</th>
			        							<th scope="col">Duration</th>
			        							<th scope="col">Rate</th>
			        							<th scope="col">Earning</th>
			        							<th scope="col">Status</th>
			        							<th scope="col">Action</th>
			        						</tr>
			        					</thead>
			        					<tbody>
			        						<tr>
                                                <?php 
                                                $query = "SELECT * FROM peri_loan_applications WHERE loan_status = 'disbursed'";
                                                $result = mysqli_query($conn, $query);
            
                                                while($row = mysqli_fetch_array($result)) { ?>
			        						    <td><?= $row['loan_id']; ?></td>
			        							<td><?= $row['date_created']; ?></td>
			        							<td><?php echo $row['firstname'] . " " . $row['middlename']. " " . $row['lastname']; ?></td>
			        							<td><?= $row['loan_amount']; ?></td>
			        							<td><?= $row['loan_duration'] . " Week(s)"; ?></td>
			        							<td><?= $row['loan_rate'] . "%"; ?></td>
			        							<td><?= $row['earnings']; ?></td>
			        							<td><span class="badge badge-success"><?= $row['loan_status']; ?></span></td>
			                                    <td>
                                                    <!--<a href="viewCustomer.php?id=<?php //echo $row['loan_id'] ?>" class="btn btn-sm btn-primary"><span class="far fa-eye"></span></a>-->
                                                    <a href="loans_disbursed.php?clear=<?= $row['loan_id'] ?>" class="btn btn-sm btn-info"><span class="fas fa-check"></span></a>
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
    // Change loan status to approved
    if(isset($_GET['clear'])) {
        $clear_id = $_GET['clear'];
        $sql_loans = "UPDATE peri_loan_applications SET loan_status = 'cleared' WHERE loan_id = '$clear_id'";
        $sql_result = mysqli_query($conn, $sql_loans);

        if($sql_result) {
            header('location: loans_disbursed.php');
        }
    }
?>