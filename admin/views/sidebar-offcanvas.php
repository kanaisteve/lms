<?php include 'views/head.php'; ?>
<body class="sidebar-fixed-offcanvas sidebar-collapse sidebar-dark header-fixed header-light" id="body">    
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
									<div class="card-header  justify-content-between">
										<h2>Sidebar Offcanvas </h2>
									</div>
									<div class="card-body">
										<blockquote class="blockquote">
											<p class="mb-0">Add class
												<code>sidebar-static-offcanvas sidebar-collapse</code> or
												<code>sidebar-fixed-offcanvas sidebar-collapse</code> to
												<code>&lt;body id="body"&gt;</code> like below.</p>
										</blockquote>
										<pre class="mt-4"><code>&lt;body id="body" class="sidebar-static-offcanvas sidebar-collapse"&gt;</code></pre>
										<blockquote class="blockquote">
											<p class="mb-0">or</p>
										</blockquote>
										<pre class="mt-4"><code>&lt;body id="body" class="sidebar-fixed-offcanvas sidebar-collapse"&gt;</code></pre>
									</div>
								</div>
							</div>
            </div>

            <script>
              window.onload = function () {
                window.isCollapsed = true;
              };
            </script>
          </div><!-- end content -->
        </div><!-- end content-wrapper -->
<?php include 'views/footer.php'; ?>
