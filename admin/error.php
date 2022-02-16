<?php include 'views/head.php'; ?>
<body class="sidebar-fixed sidebar-dark header-fixed header-light" id="body">
    
<div class="mobile-sticky-body-overlay"></div>
  <div class="wrapper">
    <?php include 'views/sidebar_without_footer.php'; ?>
      
    <div class="page-wrapper">
    	<?php include 'views/header.php'; ?>	
    	<div class="content-wrapper">
    	  <div class="content">						
    	    <div class="error-wrapper rounded border bg-white px-5">
				<div class="row justify-content-center">
					<div class="col-xl-4">
						<h1 class="text-primary bold error-title">404</h1>
						<p class="pt-4 pb-5 error-subtitle">Looks like something went wrong.</p>
						<a href="index.php" class="btn btn-primary btn-pill">Back to Home</a>
					</div>
					<div class="col-xl-6 pt-5 pt-xl-0 text-center">
						<img src="assets/img/lightenning.png" class="img-responsive" alt="Error Page Image">
					</div>
				</div>
			</div>
    	  </div><!-- end content -->
    	</div><!-- end content-wrapper -->
<?php include 'views/footer.php'; ?>
