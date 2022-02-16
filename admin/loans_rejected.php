<?php 
    include 'views/head.php';
    
    // include database file 
    include 'libs/loans.php';
    $loanObj = new Loans();
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
			        				<h2>Rejected Loans</h2>
			        			</div>
			        			<div class="card-body" style="overflow-x: auto;">
                                    <?php 
                                        $sn = 1;
                                        $loans = $loanObj->fetchRejectedLoans();
                                        if($loans !== false) :
                                            foreach ($loans as $loan) :
                                            $rate = $loan['loan_rate'] / 100;
                                    ?>
			        				<table class="table table-hover" id="rejected-table">
			        					<thead>
			        						<tr>
			        							<th scope="col">ID</th>
                                                <th scope="col">Date</th>
			        							<th scope="col">Customer</th>
			        							<th scope="col">Disbursed Amnt</th>
			        							<th scope="col">Duration</th>
			        							<th scope="col">Rate</th>
			        							<th scope="col">Interest Amnt</th>
			        							<th scope="col">Status</th>
			        						</tr>
			        					</thead>
			        					<tbody>
			        						<tr>
			        						    <td><?= $sn; ?></td>
			        							<td><?= $loan['date_created']; ?></td>
			        							<td><?= $loan['name']; ?></td>
			        							<!--<td><?php //echo $loan['firstname'] . " " . $loan['middlename']. " " . $row['lastname']; ?></td>-->
			        							<td><?= $loan['loan_amount']; ?></td>
			        							<td><?= $loan['loan_duration'] . " Week(s)"; ?></td>
			        							<td><?= $loan['loan_rate'] . "%"; ?></td>
			        							<td><?= $loan['earning']; ?></td>
			        							<td><span class="badge badge-danger"><?= $loan['loan_status']; ?></span></td>
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