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
        	<div class="breadcrumb-wrapper">
				<h1>Table</h1>	
        		<nav aria-label="breadcrumb">
        			<ol class="breadcrumb p-0">
        				<li class="breadcrumb-item">
        					<a href="index.html">
        						<span class="mdi mdi-home"></span>                
        					</a>
        				</li>
        				<li class="breadcrumb-item">Customers</li>
        			</ol>
        		</nav>
        	</div>

            <!-- Row 1 - Customer List -->
			<div class="row">
				<div class="col-lg-12">
					<div class="card card-default">
						<div class="card-header card-header-border-bottom">
							<h2>Customers</h2>
						</div>
						<div class="card-body" style="overflow-x: auto;">
							<table class="table table-hover" id="cust-table">
								<thead>
									<tr>
										<th scope="col">ID</th>
										<th scope="col">Name</th>
										<th scope="col">Email ID</th>
										<th scope="col">Phone No</th>
										<th scope="col">Location</th>
										<th scope="col">Gender</th>
										<th scope="col">Status</th>
										<th scope="col">Action</th>
									</tr>
								</thead>
								<tbody>
									<tr>
                                        <?php 
                                        $query = "SELECT * FROM peri_loan_applications";
                                        $result = mysqli_query($conn, $query);
            
                                        while($row = mysqli_fetch_array($result)) { ?>
										<td><?= $row['loan_id']; ?></td>
										<td><?php echo $row['firstname'] . " " . $row['middlename']. " " . $row['lastname']; ?></td>
										<td><?= $row['email']; ?></td>
										<td><?= $row['mobileno']; ?></td>
										<td><?php echo $row['city_town']. ", " . $row['state']; ?></td>
										<td><?= $row['gender']; ?></td>
										<td><span class="badge badge-success">active</span></td>
										<td>
											<a href="viewCustomer.php?id=<?= $row['loan_id'] ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
											<a href="loanedit.php?id=<?= $row['loan_id'] ?>" class="btn btn-warning btn-sm"><i class="far fa-edit"></i></a>
											<!--<a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>-->
										</td>
									</tr>
								    <?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div> 

        </div><!-- end content -->
      </div><!-- end content-wrapper -->
<?php include 'views/footer.php'; ?>
