
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
  						
						<div class="col-lg-6">
							<div class="card card-default">
  								<div class="card-body">
								    <!-- 1. Add New Loan Rate Script -->
									<?php 
										if(isset($_POST['btn_loantype'])) {
											$loantype = $_POST['loantype'];
											$duration = $_POST['duration'];
											$unit = $_POST['unit'];
											$interestrate = $_POST['rate'];
				
											// validation
											if($loantype == "") {
												echo '<p class="alert alert-danger"> Please enter loan type.</p>';
											} else if($duration == "") {
											    echo '<p class="alert alert-danger"> Please enter duration.</p>';
											} else if($interestrate == "") {
											    echo '<p class="alert alert-danger"> Please enter interest rate.</p>';
											} else {
												$query = "INSERT INTO peri_loan_types (loan_type, duration, units, rate) VALUES ('$loantype', '$duration', '$unit', '$interestrate')";
												$result = mysqli_query($conn, $query);
												
												if($result) {
												    echo '<p class="alert alert-success"> Successfully added new loan type</p>';	
												}
											}

										}
									?>
									<!-- 1. Add New Interest Rate Form -->
  									<form action="" method="POST" class="form-group">
  									    <div class="row">
  									        <div class="col-sm-12">
  										        <div class="form-group">
  										        	<label for="loantype">Loan Type</label>
										        	<input type="text" name="loantype" class="form-control">
										        </div> 
  									        </div>
  									        <div class="col-sm-6">
  										        <div class="form-group">
  										        	<label for="duration">Duration</label>
										        	<input type="number" name="duration" class="form-control">
										        </div>
										    </div>
  									        <div class="col-sm-6">
  										        <div class="form-group">
  										        	<label for="unit">Unit</label>
										        	<select class="form-control" id="unit" name="unit">
										        	    <option value="Week(s)" id="">Week(s)</option>
										        	    <option value="Month(s)" id="">Month(s)</option>
										        	    <option value="Year(s)" id="">Year(s)</option>
										        	</select>
										        </div>
										    </div>
										    <div class="col-sm-12">
  										        <div class="form-group">
  										        	<label for="rate">Interest Rate</label>
										        	<input type="number" name="rate" class="form-control">
										        </div>
										    </div>
										<div class="form-group">
                            				<input type="submit" name="btn_loantype" class="btn btn-success" value="Add New Loan Type">
                        				</div>
  									        
  									    </div>
									</form>

									<!-- 2. Edit Loan Types Script -->
									<?php 
										if(isset($_GET['edit'])) {
											$edit_id = $_GET['edit'];
											$query = "SELECT * FROM peri_loan_types WHERE id = '$edit_id'";
											$result = mysqli_query($conn, $query);
											$row = mysqli_fetch_assoc($result);
									?>
											<br />
  									        <form action="loan_type_update.php" method="POST" class="form-group">
  									            <div class="row">
  									                <div class="col-sm-12">
												        <div class="form-group">
												        	<label for="">Edit Loan Types</label>
												        	<p>Editing loan type of <?= $row['loan_type']; ?> with interest of <?= $row['rate'] . "%"?></p>
												        </div>
  									        	        <div class="form-group">
  									        	        	<label for="loantype">Loan Type</label>
									        	        	<input type="text" name="loantype"  value="<?= $row['loan_type'] ?>" class="form-control">
									        	        </div> 
  									                </div>
  									                <div class="col-sm-6">
  									        	        <div class="form-group">
  									        	        	<label for="duration">Duration</label>
									        	        	<input type="number" name="duration" class="form-control" value="<?= $row['duration'] ?>">
									        	        </div>
									        	    </div>
  									                <div class="col-sm-6">
  									        	        <div class="form-group">
  									        	        	<label for="unit">Unit</label>
									        	        	<select class="form-control" id="unit" name="unit">
									        	        	    <option value="<?= $row['units'] ?>" id=""><?= $row['units'] ?></option>
									        	        	    <option value="Week(s)" id="">Week(s)</option>
									        	        	    <option value="Month(s)" id="">Month(s)</option>
									        	        	    <option value="Year(s)" id="">Year(s)</option>
									        	        	</select>
										        </div>
									        	    </div>
									        	    <div class="col-sm-12">
  									        	        <div class="form-group">
  										        	<label for="rate">Interest Rate</label>
									        	        	<input type="number" name="rate" value="<?= $row['rate'] ?>" class="form-control">
									        	        </div>
									        	    </div>
									        	    <input type="hidden" name="edit_id" value="<?= $row['id']; ?>">
									        	    <div class="form-group">
                            		        	    	<input type="submit" name="btn_edit_loantype" class="btn btn-info" value="Edit Loan Type">
                        			        	    </div>
  									        
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
			        							<th>Loan Type</th>
			        							<th>Duration</th>
                                                <th>Rate</th>
			        							<th>Action</th>
			        						</tr>
			        					</thead>
			        					<tbody>
											
			        						<tr>
											<?php 
												$query = "SELECT * FROM peri_loan_types";
												$result = mysqli_query($conn, $query);
												while($row = mysqli_fetch_assoc($result)) { ?>
													<td><?= $row['loan_type']; ?></td>
													<td><?php echo $row['duration'] . " " . $row['units']; ?></td>
                            						<td><?= $row['rate'] . "%"; ?></td>
													<td> 
														<a href="loan_types.php?edit=<?= $row['id']; ?>" class="btn btn-sm btn-info"><span class="fa fa-edit"></span></a> 
                            						 	<a href="loan_types.php?delete=<?= $row['id']; ?>"  class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></a> 
													</td>
											</tr>	
											<?php
												} // end while loop
											?>
			        						
											<?php 
												// Delete Loan Type Record
												if(isset($_GET['delete'])) {
													$delete_item = $_GET['delete'];
													$query = "DELETE FROM peri_loan_types WHERE id='$delete_item'";
													$result = mysqli_query($conn, $query);
												
													if($result) {
														header("location: loan_types.php");
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
