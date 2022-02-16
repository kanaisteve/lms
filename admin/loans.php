<?php include 'views/head.php'; ?>
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
			        				<table class="table table-hover ">
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
			        						    <td>1</td>
			        							<td>23-09-2020</td>
			        							<td>Moya Chilangi</td>
			        							<td>1000</td>
			        							<td>1 Week</td>
			        							<td>20%</td>
			        							<td>200.00</td>
			        							<td><span class="badge badge-warning">Pending</span></td>
			                                    <td>
                                                    <a href="./records.php?edit_record=<?= $row['id'] ?>" class="btn btn-sm btn-primary"><span class="far fa-eye"></span></a>
                                                    <a href="./records.php?edit_record=<?= $row['id'] ?>" class="btn btn-sm btn-success"><span class="fas fa-check"></span></a>
			                                    	<a href="./records.php?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger"><span class="fas fa-times"></span></a>
			                                    </td>
			        						</tr>
			        						<tr>
			        						    <td>2</td>
			        							<td>22-09-2020</td>
			        							<td>John Mbunji</td>
			        							<td>2000</td>
			        							<td>2 Weeks</td>
			        							<td>25%</td>
			        							<td>500.00</td>
			        							<td><span class="badge badge-warning">Pending</span></td>
			                                    <td>
                                                    <a href="./records.php?edit_record=<?= $row['id'] ?>" class="btn btn-sm btn-primary"><span class="far fa-eye"></span></a>
                                                    <a href="./records.php?edit_record=<?= $row['id'] ?>" class="btn btn-sm btn-success"><span class="fas fa-check"></span></a>
			                                    	<a href="./records.php?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger"><span class="fas fa-times"></span></a>
			                                    </td>
			        						</tr>
			        						<tr>
			        						    <td>3</td>
			        							<td>20-09-2020</td>
			        							<td>Agatha Muchona</td>
			        							<td>2700</td>
			        							<td>3 Weeks</td>
			        							<td>30%</td>
			        							<td>810.00</td>
			        							<td><span class="badge badge-warning">Pending</span></td>
			                                    <td>
                                                    <a href="./records.php?edit_record=<?= $row['id'] ?>" class="btn btn-sm btn-primary"><span class="far fa-eye"></span></a>
                                                    <a href="./records.php?edit_record=<?= $row['id'] ?>" class="btn btn-sm btn-success"><span class="fas fa-check"></span></a>
			                                    	<a href="./records.php?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger"><span class="fas fa-times"></span></a>
			                                    </td>
			        						</tr>
			        						<tr>
			        						    <td>4</td>
			        							<td>19-09-2020</td>
			        							<td>Lwambula Luputa</td>
			        							<td>4000</td> 
			        							<td>4 Weeks</td> 
			        							<td>35%</td>
			        							<td>1400.00</td>
			        							<td><span class="badge badge-warning">Pending</span></td>
			                                    <td>
                                                    <a href="./records.php?edit_record=<?= $row['id'] ?>" class="btn btn-sm btn-primary"><span class="far fa-eye"></span></a>
                                                    <a href="./records.php?edit_record=<?= $row['id'] ?>" class="btn btn-sm btn-success"><span class="fas fa-check"></span></a>
			                                    	<a href="./records.php?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger"><span class="fas fa-times"></span></a>
			                                    </td>
			        						</tr>
			        						<tr>
			        						    <td>4</td>
			        							<td>19-09-2020</td>
			        							<td>Mulenga Banda</td>
			        							<td>1000</td>
			        							<td>4 Weeks</td>
			        							<td>35%</td>
			        							<td>350.00</td>
			        							<td><span class="badge badge-warning">Pending</span></td>
			                                    <td>
                                                    <a href="./records.php?edit_record=<?= $row['id'] ?>" class="btn btn-sm btn-primary"><span class="far fa-eye"></span></a>
                                                    <a href="./records.php?edit_record=<?= $row['id'] ?>" class="btn btn-sm btn-success"><span class="fas fa-check"></span></a>
			                                    	<a href="./records.php?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger"><span class="fas fa-times"></span></a>
			                                    </td>
			        						</tr>
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
<?php include 'views/footer.php'; ?><?php include 'views/head.php'; ?>
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
			        			<div class="card-body">
			        				<table class="table table-hover ">
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
			        						    <td>1</td>
			        							<td>23-09-2020</td>
			        							<td>Moya Chilangi</td>
			        							<td>1000</td>
			        							<td>1 Week</td>
			        							<td>20%</td>
			        							<td>200.00</td>
			        							<td><span class="badge badge-warning">Pending</span></td>
			                                    <td>
                                                    <a href="./records.php?edit_record=<?= $row['id'] ?>" class="btn btn-sm btn-primary"><span class="far fa-eye"></span></a>
                                                    <a href="./records.php?edit_record=<?= $row['id'] ?>" class="btn btn-sm btn-success"><span class="fas fa-check"></span></a>
			                                    	<a href="./records.php?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger"><span class="fas fa-times"></span></a>
			                                    </td>
			        						</tr>
			        						<tr>
			        						    <td>2</td>
			        							<td>22-09-2020</td>
			        							<td>John Mbunji</td>
			        							<td>2000</td>
			        							<td>2 Weeks</td>
			        							<td>25%</td>
			        							<td>500.00</td>
			        							<td><span class="badge badge-warning">Pending</span></td>
			                                    <td>
                                                    <a href="./records.php?edit_record=<?= $row['id'] ?>" class="btn btn-sm btn-primary"><span class="far fa-eye"></span></a>
                                                    <a href="./records.php?edit_record=<?= $row['id'] ?>" class="btn btn-sm btn-success"><span class="fas fa-check"></span></a>
			                                    	<a href="./records.php?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger"><span class="fas fa-times"></span></a>
			                                    </td>
			        						</tr>
			        						<tr>
			        						    <td>3</td>
			        							<td>20-09-2020</td>
			        							<td>Agatha Muchona</td>
			        							<td>2700</td>
			        							<td>3 Weeks</td>
			        							<td>30%</td>
			        							<td>810.00</td>
			        							<td><span class="badge badge-warning">Pending</span></td>
			                                    <td>
                                                    <a href="./records.php?edit_record=<?= $row['id'] ?>" class="btn btn-sm btn-primary"><span class="far fa-eye"></span></a>
                                                    <a href="./records.php?edit_record=<?= $row['id'] ?>" class="btn btn-sm btn-success"><span class="fas fa-check"></span></a>
			                                    	<a href="./records.php?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger"><span class="fas fa-times"></span></a>
			                                    </td>
			        						</tr>
			        						<tr>
			        						    <td>4</td>
			        							<td>19-09-2020</td>
			        							<td>Lwambula Luputa</td>
			        							<td>4000</td> 
			        							<td>4 Weeks</td> 
			        							<td>35%</td>
			        							<td>1400.00</td>
			        							<td><span class="badge badge-warning">Pending</span></td>
			                                    <td>
                                                    <a href="./records.php?edit_record=<?= $row['id'] ?>" class="btn btn-sm btn-primary"><span class="far fa-eye"></span></a>
                                                    <a href="./records.php?edit_record=<?= $row['id'] ?>" class="btn btn-sm btn-success"><span class="fas fa-check"></span></a>
			                                    	<a href="./records.php?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger"><span class="fas fa-times"></span></a>
			                                    </td>
			        						</tr>
			        						<tr>
			        						    <td>4</td>
			        							<td>19-09-2020</td>
			        							<td>Mulenga Banda</td>
			        							<td>1000</td>
			        							<td>4 Weeks</td>
			        							<td>35%</td>
			        							<td>350.00</td>
			        							<td><span class="badge badge-warning">Pending</span></td>
			                                    <td>
                                                    <a href="./records.php?edit_record=<?= $row['id'] ?>" class="btn btn-sm btn-primary"><span class="far fa-eye"></span></a>
                                                    <a href="./records.php?edit_record=<?= $row['id'] ?>" class="btn btn-sm btn-success"><span class="fas fa-check"></span></a>
			                                    	<a href="./records.php?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger"><span class="fas fa-times"></span></a>
			                                    </td>
			        						</tr>
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