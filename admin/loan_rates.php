<?php 
    include 'views/head.php';
    include_once 'libs/loan_rate.php';
    
    $rateObj = new LoanRates($_POST); 

    // Edit(Update) loan rate in the lms_rates table using the id
    if(isset($_POST['btn_edit_rate'])) :      
        $rate = $rateObj->updateRate($_POST);
        if($rate) {
            header("location: loan_rates.php");   
        }
    endif;
    
	// Delete Interest Rate Record
	if(isset($_GET['delete'])) {
		$delete_item = $_GET['delete'];
        $rateObj->deleteRate($delete_item);
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
  						
						<div class="col-lg-6">
							<div class="card card-default">
  								<div class="card-body">
								    <!-- 1. Add New Loan Rate Script -->
									<?php 
										if(isset($_POST['btn_rate'])) :
                                            // validate entries
                                            $errors = $rateObj->validateForm();
                                            
											if(empty($errors)) {
											    $rateObj->addRate($_POST);
                                                header("location: loan_rates.php");   
											}
										endif;
									?>
									<!-- 1. Add New Interest Rate Form -->
  									<form action="" method="POST" class="form-group">
  										<div class="form-group">
  											<label for="rate">Duration</label>
											<input type="text" name="duration" value="<?php if(isset($_POST['duration'])) echo $_POST['duration'] ?>" class="form-control">
											<span class="help-block text-danger"><?php echo $errors['duration'] ?? '' ?></span>
										</div>
  										<div class="form-group">
  											<label for="rate">Interest Rate</label>
											<input type="text" name="rate" value="<?php if(isset($_POST['rate'])) echo $_POST['rate'] ?>" class="form-control">
											<span class="help-block text-danger"><?php echo $errors['rate'] ?? '' ?></span>
										</div>
										<div class="form-group">
                            				<input type="submit" name="btn_rate" class="btn btn-success" value="Add New Rate">
                        				</div>
									</form>

									<!-- 2. Edit Interest Rate Script -->
									<?php 
										if(isset($_GET['edit']) && !empty($_GET['edit'])) :
											$edit_id = $_GET['edit'];
											$rate = $rateObj->getRateById($edit_id); 	
									?>
										<br />
										<form action="" method="POST">
											<div class="form-group">
												<label for="">Edit Rates</label>
												<p>Editing interest rate for <?= $rate['interest_rate'] . "%"?></p>
											</div>
												<div class="form-group">
												    <input type="number" name="edit_duration" value="<?= $rate['loan_duration'] ?>" class="form-control">
												</div>
												<div class="form-group">
												    <input type="number" name="edit_rate" value="<?= $rate['interest_rate'] ?>" class="form-control">
												</div>
											<div class="form-group">
											    <input type="hidden" name="edit_id" value="<?= $rate['id']; ?>">
												<input type="submit" name="btn_edit_rate" class="btn btn-primary" value="Edit Interest Rate">
											</div>
										</form>
									<?php endif; ?>
								</div>
							</div>  
						</div>

						<!-- View All Categories -->
			        	<div class="col-lg-6">
			        		<div class="card card-default">
			        			<div class="card-body">
									<!-- Categories Table -->
			        				<table class="table table-hover">
			        					<thead>
			        						<tr>
			        							<th>Loan Duration</th>
                                                <th>Interest Rate</th>
			        							<th>Operations</th>
			        						</tr>
			        					</thead>
			        					<tbody>
											
			        						<tr>
                                                <?php 
                                                    $sn = 1;
                                                    $rates = $rateObj->getRates();
                                                    if($rates !== false) :
                                                        foreach ($rates as $rate) :
                                                ?>
													<td><?= $rate['loan_duration'] . " Week(s)"; ?></td>
                            						<td><?= $rate['interest_rate'] . "%"; ?></td>
													<td> 
														<a href="loan_rates.php?edit=<?= $rate['id']; ?>" class="btn btn-sm btn-info"><span class="fa fa-edit"></span></a> 
                            						 	<a href="loan_rates.php?delete=<?= $rate['id']; ?>"  class="btn btn-sm btn-danger" onclick="confirm('Are you sure want to delete this loan rate')"><span class="fa fa-trash"></span></a> 
													</td>
											</tr>
                                                <?php
                                                    $sn++;
                                                    endforeach; 
                                                    endif;
                                                ?>
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
