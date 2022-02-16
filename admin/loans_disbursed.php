<?php 
    include 'views/head.php';
    
    // include database file 
    include 'libs/loans.php';
    $loanObj = new Loans();
    
    // Change loan status to cleared
    if(isset($_GET['clear']) && !empty($_GET['clear'])) {
        $clear_id = $_GET['clear'];
        $loanObj->clearLoan($clear_id);
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
                    
			        <div class="row">
			        	<div class="col-lg-12">
			        		<div class="card card-default">
			        			<div class="card-header card-header-border-bottom">
			        				<h2>Loans Disbursed</h2>
			        			</div>
			        			<div class="card-body" style="overflow-x: auto;">
                                    <?php 
                                        $sn = 1;
                                        $loans = $loanObj->fetchDisbursedLoans();
                                        if($loans !== false) :
                                            foreach ($loans as $loan) :
                                            $rate = $loan['loan_rate'] / 100;
                                    ?>
			        				<table class="table table-hover" id="disbursed-table">
			        					<thead>
			        						<tr>
			        							<th scope="col">ID</th>
                                                <th scope="col">Date</th>
			        							<th scope="col">Customer</th>
			        							<th scope="col">Disbursed Amnt</th>
			        							<th scope="col">Duration</th>
			        							<th scope="col">Days Left</th>
			        							<th scope="col">Rate</th>
			        							<th scope="col">Earning</th>
			        							<th scope="col">Status</th>
			        							<th scope="col">Action</th>
			        						</tr>
			        					</thead>
			        					<tbody>
			        						<tr>
			        						    <td><?= $sn; ?></td>
			        							<td><?= $date = $loan['date_created']; ?></td>
			        							<td><?= $loan['name']; ?></td>
			        							<!--<td><?php //echo $row['firstname'] . " " . $row['middlename']. " " . $row['lastname']; ?></td>-->
			        							<td><?= $loan['loan_amount']; ?></td>
			        							<td><?= $duration = $loan['loan_duration'] . " Week(s)"; ?></td>
			        							<td><?php 
			        							    $days = "";
                                                    if($duration == 1) {
                                                        $days = 7;
                                                    } else if ($duration == 2) {
                                                        $days = 14;
                                                    } else if ($duration == 3) {
                                                        $days = 21;
                                                    } else if ($duration == 4) {
                                                        $days = 28;
                                                    }
			        							    $loanDate = date_create($date);
                                                    $days = $days.' days';
                                                    date_add($loanDate, date_interval_create_from_date_string($days));
                                    
                                    
                                                    $currentDate = date("Y-m-d");
                                                    $currentDate = date_create($currentDate);
                                                    $dateRemaining = date_diff($currentDate,$loanDate);
                                                    echo $dateRemaining->format("%a");   
			        							?></td>
			        							<td><?= $loan['loan_rate'] . "%"; ?></td>
			        							<td><?= $loan['earning']; ?></td>
			        							<td><span class="badge badge-success"><?= $loan['loan_status']; ?></span></td>
			                                    <td>
                                                    <a href="viewCustomer.php?mobile=<?= $loan['mobileno'] ?>" class="btn btn-sm btn-primary"><span class="far fa-eye"></span></a>
                                                    <!--<a href="viewCustomer.php?id=<?php //echo $row['loan_id'] ?>" class="btn btn-sm btn-primary"><span class="far fa-eye"></span></a>-->
                                                    <a href="loans_disbursed.php?clear=<?= $loan['mobileno'] ?>" class="btn btn-sm btn-info"><span class="fas fa-check"></span></a>
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