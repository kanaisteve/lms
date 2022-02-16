<?php
    //connect to database
    include_once('database/connect.php');
    
    include 'views/head.php'; ?>
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
										if(isset($_POST['btn_rate'])) {
											// collect new interest rate duration
											$duration = $_POST['duration'];
											$interest_rate = $_POST['rate'];
				
											// validation
											if($duration == "") {
												echo '<p class="alert alert-danger"> Please enter loan duration.</p>';
											} else if($interest_rate == "") {
											    echo '<p class="alert alert-danger"> Please enter interest rate.</p>';
											}
											else {
												$query = "INSERT INTO peri_rates (loan_duration, interest_rate) VALUES ('$duration', '$interest_rate')";
												$result = mysqli_query($conn, $query);
											}

										}
									?>
									<!-- 1. Add New Interest Rate Form -->
  									<form action="" method="POST" class="form-group">
  										<div class="form-group">
  											<label for="rate">Duration</label>
											<input type="text" name="duration" class="form-control">
										</div>
  										<div class="form-group">
  											<label for="rate">Interest Rate</label>
											<input type="text" name="rate" class="form-control">
										</div>
										<div class="form-group">
                            				<input type="submit" name="btn_rate" class="btn btn-success" value="Add New Rate">
                        				</div>
									</form>

									<!-- 2. Edit Interest Rate Script -->
									<?php 
										if(isset($_GET['edit'])) {
											$edit_id = $_GET['edit'];
											$query = "SELECT * FROM peri_rates WHERE id = '$edit_id'";
											$result = mysqli_query($conn, $query);
											$row = mysqli_fetch_assoc($result);
									?>
											<br />
											<form action="loan_rate_update.php" method="POST">
												<div class="form-group">
													<label for="">Edit Rates</label>
													<p>Editing interest rate for <?= $row['interest_rate'] . "%"?></p>
												</div>
													<div class="form-group">
													    <input type="text" name="edit_duration" value="<?= $row['loan_duration'] ?>" class="form-control">
													</div>
													<div class="form-group">
													    <input type="text" name="edit_rate" value="<?= $row['interest_rate'] ?>" class="form-control">
													</div>
													
													<input type="hidden" name="edit_id" value="<?= $row['id']; ?>">
												<div class="form-group">
													<input type="submit" name="btn_edit_rate" class="btn btn-primary" value="Edit Interest Rate">
												</div>
											</form>
									<?php
										}
									?>
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
												$query = "SELECT * FROM peri_rates";
												$result = mysqli_query($conn, $query);
												while($row = mysqli_fetch_assoc($result)) { ?>
													<td><?= $row['loan_duration'] . " Weeks"; ?></td>
                            						<td><?= $row['interest_rate'] . "%"; ?></td>
													<td> 
														<a href="loan_rates.php?edit=<?= $row['id']; ?>" class="btn btn-sm btn-info"><span class="fa fa-edit"></span></a> 
                            						 	<a href="loan_rates.php?delete=<?= $row['id']; ?>"  class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></a> 
													</td>
											</tr>	
											<?php
												} // end while loop
											?>
			        						
											<?php 
												// Delete Interest Rate Record
												if(isset($_GET['delete'])) {
													$delete_item = $_GET['delete'];
													$query = "DELETE FROM peri_rates WHERE id='$delete_item'";
													$result = mysqli_query($conn, $query);
												
													if($result) {
														header("location: loan_rates.php");
													}
												}
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
