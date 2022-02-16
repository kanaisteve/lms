<?php 
    include 'views/head.php';
    
    // include database file 
    include 'libs/users.php';
    $userObj = new Users();
?>
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
							<?php 
                                $sn = 1;
                                $customers = $userObj->getCustomers();
                                if($customers !== false) :
                                    foreach ($customers as $customer) :
                            ?>
							<table class="table table-hover" id="cust-table">
								<thead>
									<tr>
										<th scope="col">No.</th>
										<th scope="col">Name</th>
										<th scope="col">Email ID</th>
										<th scope="col">Phone No</th>
										<!--<th scope="col">Location</th>-->
										<!--<th scope="col">Gender</th>-->
										<th scope="col">Status</th>
										<th scope="col">Action</th>
									</tr>
								</thead>
								<tbody>
									<tr>
									    <td><?= $sn; ?></td>
									    <td><?php echo $customer['firstname'] . " " . $customer['middlename']. " " . $customer['lastname']; ?></td>
									    <td><?= $customer['email']; ?></td>
									    <td><?= $customer['mobilenumber']; ?></td>
									    <td><span class="badge badge-success">active</span></td>
									    <td>
									    	<a href="viewCustomer.php?mobile=<?= $customer['mobilenumber'] ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
									    	<a href="loanedit.php?id=<?= $customer['mobilenumber'] ?>" class="btn btn-warning btn-sm"><i class="far fa-edit"></i></a>
									    	<!--<a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>-->
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

        </div><!-- end content -->
      </div><!-- end content-wrapper -->
<?php include 'views/footer.php'; ?>
