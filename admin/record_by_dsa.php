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
			        			<div class="card-header card-header-border-bottom">
			        				<h2>My Records</h2>
			        			</div>
			        			<div class="card-body" style="overflow-y: auto;">
			        				<table class="table table-hover ">
			        					<thead>
		                                    <tr>
		                                    	<th scope="col">Date</th>
		                                    	<th scope="col">Time</th>
		                                    	<th scope="col">Name</th>
		                                    	<th scope="col">Mobile No.</th>
		                                    	<th scope="col">Gender</th>
		                                    	<th scope="col">Town/City</th>
		                                    	<th scope="col">Province</th>
		                                    </tr>
			        					</thead>
			        					<tbody>
			        						<tr>
                                                <?php 
                                                $query = "SELECT * FROM dsa_records WHERE entered_by = '$fullName'";
                                                $result = mysqli_query($conn, $query);
                                                while($row = mysqli_fetch_array($result)) {  ?>
                                                    <td><?= $row['date']; ?></td>
                                                    <td><?= $row['time']; ?></td>
                                                    <td><?php echo $row['firstname'] . " " . $row['lastname']; ?></td>
                                                    <td><?= $row['mobileno']; ?></td>
                                                    <td><?= $row['gender']; ?></td>
                                                    <td><?= $row['town_city']; ?></td>
                                                    <td><?= $row['state']; ?></td>
                                                    <!--<td><?php // $row['age']; ?></td>-->
			        						</tr>
			        						<?php } ?>
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