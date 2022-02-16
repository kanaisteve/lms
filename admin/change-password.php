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
    <!--    	 <div class="breadcrumb-wrapper">-->
				<!--<h1>Posts</h1>	-->
    <!--    		<nav aria-label="breadcrumb">-->
    <!--    			<ol class="breadcrumb p-0">-->
    <!--    				<li class="breadcrumb-item">-->
    <!--    					<a href="index.html">-->
    <!--    						<span class="mdi mdi-home"></span>                -->
    <!--    					</a>-->
    <!--    				</li>-->
    <!--    				<li class="breadcrumb-item">Posts</li>-->
    <!--    			</ol>-->
    <!--    		</nav>-->
    <!--    	</div> -->
			<div class="row">
				<div class="col-lg-12">
					<div class="card card-default">
						<div class="card-header card-header-border-bottom">
							<h2>Change Password</h2>
						</div>
						<div class="card-body" style="overflow-x: auto;">
	                        <?php if (isset($_GET['error'])) { ?>
	                            <div class="alert alert-dismissible fade show alert-danger mb-0" role="alert">
	                                <?php echo $_GET['error'] ?>
	                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                                    <span aria-hidden="true">×</span>
	                                </button>
	                            </div>
	                        <?php } ?>
	                        <?php if (isset($_GET['success'])) { ?>
	                            <div class="alert alert-dismissible fade show alert-danger mb-0" role="alert">
	                                <?php echo $_GET['success'] ?>
	                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                                    <span aria-hidden="true">×</span>
	                                </button>
	                            </div>
	                        <?php } ?>
							<!-- Update Perosonal Details Form -->
  							<form id="form_to_submit" action="change-p.php" method="POST" enctype="multipart/form-data" class="form-group">
  							    
  							    <div class="row pt-3">
                                    <div class="col-sm-12 col-md-12">
  							            <!-- Old Password -->
  							            <label class="text-dark mt-0">Current Password</label>
  								        <div class="form-group">
								            <input type="password" name="oldpass" class="form-control">
								            <span class="help-block"><?php //echo $oldpass_err; ?></span>
								        </div>
                                                    
								        <!-- New Password -->
  							            <label class="text-dark mt-0">New Password</label>
  								        <div class="form-group">
								            <input type="password" name="newpass" class="form-control">
								        	<span class="help-block"><?php //echo $newpass_err ?></span>
								        </div>
								                        
								        <!-- Confirm New Password -->
  							            <label class="text-dark mt-0">Re-type New Password</label>
  								        <div class="form-group">
								        	<input type="password" name="confirmpass" class="form-control">
								        	<span class="help-block"><?php //echo $lastname_err; ?></span>
								        </div>
                                    </div>
                                    <!-- /End Column One -->
                                                    
  							        <!-- Submit Button -->
  							        <div class="col-sm-12">
								        <div class="form-group mt-2">
                            	       	    <input type="submit" name="update_password" style="" class="btn btn-primary" value="Change Password" onclick="">
                        		        </div>
  							       </div>
  							        
  							   </div>
							</form>
						</div>	
					</div>
				</div>
			</div> 					
        </div><!-- end content -->
      </div><!-- end content-wrapper -->
<?php include 'views/footer.php'; ?>