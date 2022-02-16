<?php include 'views/head.php'; ?>
<body class="sidebar-fixed sidebar-dark header-fixed header-light" id="body">
<div class="mobile-sticky-body-overlay"></div>
  <div class="wrapper">
    <?php include 'views/sidebar_without_footer.php'; ?>

    <div class="page-wrapper">
      <?php include 'views/header.php'; ?>

      <div class="content-wrapper">
        <div class="content">							
        	<!-- <div class="breadcrumb-wrapper">
				<h1>Posts</h1>	
        		<nav aria-label="breadcrumb">
        			<ol class="breadcrumb p-0">
        				<li class="breadcrumb-item">
        					<a href="index.html">
        						<span class="mdi mdi-home"></span>                
        					</a>
        				</li>
        				<li class="breadcrumb-item">Posts</li>
        			</ol>
        		</nav>
        	</div> -->

			<div class="row">
				<div class="col-lg-12">
					<div class="card card-default">
						<div class="card-header card-header-border-bottom">
							<h2>DSA Records</h2>
						</div>
	
						<div class="card-body" style="overflow-y: auto;">
							<?php 
								if(isset($_GET['opt'])) {
									$opt = $_GET['opt'];
								} else {
									$opt = '';
								}

								switch($opt) {
									case 'add_record':
										require_once 'admin_includes/add_record.php';
									break;
									case 'edit_record':
										require_once 'admin_includes/edit_record.php';
									break;
									default:
										require_once 'admin_includes/view_all_records.php';
									break;
								}
							?>
						</div>	
					</div>
				</div>
			</div> 					
        </div><!-- end content -->
      </div><!-- end content-wrapper -->
<?php include 'views/footer.php'; ?>