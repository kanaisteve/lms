<?php include 'views/head.php'; ?>
<body class="sidebar-fixed sidebar-dark header-fixed header-light" id="body">

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
									<h2>Sidebar Open</h2>
								</div>
								<div class="card-body">
									<blockquote class="blockquote">
										<p class="mb-0">Add class
											<code>sidebar-fixed</code> or
											<code>sidebar-static</code> to
											<code>&lt;body id="body"&gt;</code> like below.</p>
									</blockquote>
									<pre class="mt-4"><code>&lt;body id="body" class="sidebar-fixed"&gt;</code></pre>
									<blockquote class="blockquote">
										<p class="mb-0">or</p>
									</blockquote>
									<pre class="mt-4"><code>&lt;body id="body" class="sidebar-static"&gt;</code></pre>
								</div>
							</div>
						</div>
          </div>
        
        </div><!-- end content -->
      </div><!-- end content-wrapper -->
<?php include 'views/footer.php'; ?>