					
    
				  <!-- Modal -->
				  <div class="modal fade" id="timeoutModal" tabindex="-1" role="dialog" aria-labelledby="timeoutModalLabel" aria-hidden="true">
				  	<div class="modal-dialog" role="document">
				  		<div class="modal-content">
				  			<div class="modal-header">
				  				<h5 class="modal-title" id="exampleModalLabel">Session Expiration</h5>
				  				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  					<span aria-hidden="true">&times;</span>
				  				</button>
				  			</div>
				  			<div class="modal-body">
				  				Because you have been inactive, your session is about to expire.
				  			</div>
				  			<div class="modal-footer">
				  				<button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">Close</button>
				  			</div>
				  		</div>
				  	</div>
				  </div>
                <footer class="footer mt-auto">
                    <div class="copyright bg-white">
                        <p>Copyright &copy; <span id="copy-year">2019</span> Loan Management System.</p
                        <p>Designed by <a style="color: #5cdb94" href="http://www.kanaitech.com/" target="_blank">Kanaitech.</a></p>
                    </div>
                    <script>
                        var d = new Date();
                        var year = d.getFullYear();
                        document.getElementById("copy-year").innerHTML = year;
                    </script>
                </footer>
            </div><!-- end wrapper -->
        </div><!-- end mobile-sticky-body-overlay -->

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCn8TFXGg17HAUcNpkwtxxyT9Io9B_NcM" defer></script>
        <script src="assets/plugins/jquery/jquery.min.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/plugins/toaster/toastr.min.js"></script>
        <script src="assets/plugins/slimscrollbar/jquery.slimscroll.min.js"></script>
        <script src="assets/plugins/charts/Chart.min.js"></script>
        <script src="assets/plugins/ladda/spin.min.js"></script>
        <script src="assets/plugins/ladda/ladda.min.js"></script>
        <script src="assets/plugins/jquery-mask-input/jquery.mask.min.js"></script>
        <script src="assets/plugins/select2/js/select2.min.js"></script>
        <script src="assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
        <script src="assets/plugins/jvectormap/jquery-jvectormap-world-mill.js"></script>
        <script src="assets/plugins/daterangepicker/moment.min.js"></script>
        <script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
        <script src="assets/plugins/jekyll-search.min.js"></script>
        <script src="assets/js/sleek.js"></script>
        <script src="assets/js/chart.js"></script>
        <script src="assets/js/date-range.js"></script>
        <script src="assets/js/map.js"></script>
        <script src="assets/js/custom.js"></script>
        
        <!-- JS Link for Datatables -->
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                setInterval(check_user, 2000);
                function check_user() {
                    $.ajax({
                        url: './check_user.php',
                        method: 'POST',
                        data: 'type=logout',
                        success: function(response) {
                            if (response == "logout") {
                                $("#timeoutModal").modal('show');
                                // $("#timeoutModal").modal({
                                //     backdrop: 'static',
                                //     keybord: false,
                                // });

                                setTimeout(() => {
                                    $("#timeoutModal").modal('hide')
                                        window.location.href="./logout.php";
                                }, 10000);
                            }
                        }
                    });
                }  
                
                // $("table").DataTable({
                //     order:[0, 'DESC']
                // });
                
                $('#cust-table').DataTable();
                $('#pending-table').DataTable({
                    order:[0, 'DESC']
                });
                $('#approved-table').DataTable();
                $('#rejected-table').DataTable();
                $('#disbursed-table').DataTable();
                $('#cleared-table').DataTable();
                
                $('#collateral3_container').hide();
                $('#collateral4_container').hide();
            });
    
                        
            $('#brandname3').change(function() {
                if($('#brandname3').val() == "") {
                    $('#collateral3_container').hide();
                } 
                else {
                    $('#collateral3_container').show();
                }
            });
                        
            $('#brandname4').change(function() {
                if($('#brandname4').val() == "") {
                    $('#collateral4_container').hide();
                } 
                else {
                    $('#collateral4_container').show();
                }
            });
            
            
            // add the value to the collateral value
            $('#price1').change(function() {
                let price1 = Number($('#price1').val());
                $('#collateral_val').val(price1);
            });
            
            // add price2 to the collateral value on change event
            $('#price2').change(function() {
                let currentTotal = Number($('#collateral_val').val());
                let price2 = Number($('#price2').val());
                let total = currentTotal + price2;
                $('#collateral_val').val(total);
            });
            
            // add price3 to the collateral value on change event
            $('#price3').change(function() {
                let currentTotal = Number($('#collateral_val').val());
                let price3 = Number($('#price3').val());
                let total = currentTotal + price3;
                $('#collateral_val').val(total);
            });
            
            // add price4 to the collateral value on change event
            $('#price4').change(function() {
                let currentTotal = Number($('#collateral_val').val());
                let price4 = Number($('#price4').val());
                let total = currentTotal + price4;
                $('#collateral_val').val(total);
            });
        </script>
        
        <script>
            function openFullscreen(a) {
                var elem = a;
                if (elem.requestFullscreen) {
                    elem.requestFullscreen();
                } else if (elem.webkitRequestFullscreen) { /* Safari */
                    elem.webkitRequestFullscreen();
                } else if (elem.msRequestFullscreen) { /* IE11 */
                    elem.msRequestFullscreen();
                }
            }
        </script>
    </body>
</html>