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
			        				<h2>Loans Unpaid</h2>
			        			</div>
			        			<div class="card-body" style="overflow-x: auto;">
			        				<table class="table table-hover ">
			        					<thead>
			        						<tr>
			        							<th scope="col">ID</th>
                                                <th scope="col">Date</th>
			        							<th scope="col">Customer</th>
			        							<th scope="col">Disbursed Amnt</th>
			        							<th scope="col">Duration</th>
			        							<th scope="col">Rate</th>
			        							<th scope="col">Overdue Amnt</th>
			        							<th scope="col">Status</th>
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
			        							<td><span class="badge badge-danger">Unpaid</span></td>
			        						</tr>
			        						<tr>
			        						    <td>2</td>
			        							<td>22-09-2020</td>
			        							<td>John Mbunji</td>
			        							<td>2000</td>
			        							<td>2 Weeks</td>
			        							<td>25%</td>
			        							<td>500.00</td>
			        							<td><span class="badge badge-danger">Unpaid</span></td>
			        						</tr>
			        						<tr>
			        						    <td>3</td>
			        							<td>20-09-2020</td>
			        							<td>Agatha Muchona</td>
			        							<td>2700</td>
			        							<td>3 Weeks</td>
			        							<td>30%</td>
			        							<td>810.00</td>
			        							<td><span class="badge badge-danger">Unpaid</span></td>
			        						</tr>
			        						<tr>
			        						    <td>4</td>
			        							<td>19-09-2020</td>
			        							<td>Lwambula Luputa</td>
			        							<td>4000</td> 
			        							<td>4 Weeks</td> 
			        							<td>35%</td>
			        							<td>1400.00</td>
			        							<td><span class="badge badge-danger">Unpaid</span></td>
			        						</tr>
			        						<tr>
			        						    <td>4</td>
			        							<td>19-09-2020</td>
			        							<td>Mulenga Banda</td>
			        							<td>1000</td>
			        							<td>4 Weeks</td>
			        							<td>35%</td>
			        							<td>350.00</td>
			        							<td><span class="badge badge-danger">Unpaid</span></td>
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