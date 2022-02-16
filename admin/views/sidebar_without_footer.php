<!--
====================================
——— LEFT SIDEBAR WITH OUT FOOTER
=====================================
-->
<aside class="left-sidebar bg-sidebar" style="overflow-y: auto;">
    <div id="sidebar" class="sidebar sidebar-with-footer">
        <!-- Aplication Brand -->
        <div class="app-brand" style="background-color: #1976d2;">
          <a href="#" style="padding-left:0.9rem;">
            <svg class="brand-icon" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" width="30" height="33"
              viewBox="0 0 30 33">
              <g fill="none" fill-rule="evenodd">
                <path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z" />
                <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
              </g>
            </svg>
            
            <!--<img style="width:40px; " class="logo" src="./assets/img/peridot-img.png"/>-->
            <span class="brand-name">Loan System</span>
          </a>
        </div>  
        <!-- begin sidebar scrollbar -->
        <div class="sidebar-scrollbar" style="overflow-y: auto;">
            <!-- sidebar menu -->
            <ul class="nav sidebar-inner" id="sidebar-menu" style="overflow-y: auto;">
                <?php 
                if(isset($_SESSION['userRole'])) {
                    if($_SESSION['userRole'] === 'admin') { ?> 
                        <!-- Dashboard -->
                        <li >
                            <a class="sidenav-item-link" href="index.php">
                                <i class="mdi mdi-apps"></i>
                                <span class="nav-text">Dashboard</span>   
                            </a>
                        </li>    
                        <!-- Customer List -->
                        <li >
                            <a class="sidenav-item-link" href="customer_list.php">
                                <i class="mdi mdi-account-group"></i>
                                <span class="nav-text">Customers</span>   
                            </a>
                        </li> 
                        <!-- Loan Application Form -->
                        <!--<li >-->
                        <!--    <a class="sidenav-item-link" href="loanapply.php">-->
                        <!--        <i class="mdi mdi-file-cabinet"></i>-->
                        <!--        <span class="nav-text">Loan Form</span>   -->
                        <!--    </a>-->
                        <!--</li> -->
                        <!-- Loans -->
                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#reports"
                              aria-expanded="false" aria-controls="reports">
                              <i class="mdi mdi-file-document-outline"></i>
                              <span class="nav-text">Loans</span> <b class="caret"></b>
                            </a>
                            <ul  class="collapse"  id="reports" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <!--<li >-->
                                    <!--    <a class="sidenav-item-link" href="./transaction_details.php">-->
                                    <!--      <span class="nav-text">Transaction Details</span>   -->
                                    <!--    </a>-->
                                    <!--</li>-->
                                    <li >
                                        <a class="sidenav-item-link" href="loans_pending.php">
                                          <span class="nav-text">Pending Loans</span>   
                                          <!--<span class="badge badge-success">new</span>   -->
                                        </a>
                                    </li>
                                    <li >
                                        <a class="sidenav-item-link" href="loans_approved.php">
                                          <span class="nav-text">Loans Approved</span>   
                                          <!--<span class="badge badge-success">new</span>   -->
                                        </a>
                                    </li>  
                                    <li >
                                        <a class="sidenav-item-link" href="loans_rejected.php">
                                          <span class="nav-text">Rejected Loans</span>   
                                          <!--<span class="badge badge-success">new</span>   -->
                                        </a>
                                    </li> 
                                    <li >
                                        <a class="sidenav-item-link" href="loans_disbursed.php">
                                          <span class="nav-text">Loans Disbursed</span>   
                                        </a>
                                    </li>
                                    <li >
                                        <a class="sidenav-item-link" href="loans_cleared.php">
                                          <span class="nav-text">Loans Cleared</span>   
                                          <!--<span class="badge badge-success">new</span>   -->
                                        </a>
                                    </li>  
                                    <li >
                                        <a class="sidenav-item-link" href="loans_defaulted.php">
                                          <span class="nav-text">Loans Defaulted</span>   
                                          <!--<span class="badge badge-success">new</span>   -->
                                        </a>
                                    </li>  
                                </div>
                            </ul>
                        </li> 
                        <!-- Manage -->
                        <li class="has-sub" >
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#manage"
                              aria-expanded="false" aria-controls="manage">
                              <i class="mdi mdi-archive"></i>
                              <span class="nav-text">Manage</span> <b class="caret"></b>
                            </a>
                            <ul  class="collapse"  id="manage" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li >
                                        <a class="sidenav-item-link" href="./loan_rates.php">
                                          <span class="nav-text">Interest Rates</span>   
                                        </a>
                                    </li> 
                                    <!--<li >-->
                                    <!--    <a class="sidenav-item-link" href="./loan_types.php">-->
                                    <!--      <span class="nav-text">Loan Types</span>   -->
                                    <!--    </a>-->
                                    <!--</li> -->
                                </div>
                            </ul>
                        </li>
                        
                        <!-- User Management -->
                        <li class="has-sub" >
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#user-management"
                              aria-expanded="false" aria-controls="user-management">
                              
                              <i class="mdi mdi-account-supervisor"></i>
                              <span class="nav-text">Users</span> <b class="caret"></b>
                            </a>
                            <ul  class="collapse"  id="user-management" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li >
                                        <a class="sidenav-item-link" href="./users.php">
                                          <span class="nav-text">View All Users</span>   
                                        </a>
                                    </li> 
                                    <li >
                                        <a class="sidenav-item-link" href="./users.php?opt=add_user">
                                          <span class="nav-text">Add New User</span>   
                                          <span class="badge badge-success">new</span>   
                                        </a>
                                    </li> 
                                </div>
                            </ul>
                        </li> 
                <?php          
                    }
                }
                ?>
                 
                <?php 
                if(isset($_SESSION['userRole'])) {
                    if($_SESSION['userRole'] === 'customer') { ?>
                        <!-- Dashboard -->
                        <li >
                            <a class="sidenav-item-link" href="indexCust.php">
                                <i class="mdi mdi-apps"></i>
                                <span class="nav-text">Dashboard</span>   
                            </a>
                        </li> 
                        <!-- Loan Form -->
                        <li >
                            <a class="sidenav-item-link" href="custLoanForm.php">
                                 <i class="far fa-file-alt"></i>
                                <span class="nav-text">Loan Form</span>   
                            </a>
                        </li>  
                        <!-- User Profile -->
                        <li class="has-sub" >
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#profile"
                              aria-expanded="false" aria-controls="profile">
                              <i class="mdi mdi-account-circle-outline"></i>
                              <span class="nav-text">Profile</span> <b class="caret"></b>
                            </a>
                            <ul  class="collapse"  id="profile" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li >
                                        <a class="sidenav-item-link" href="user-profile.php">
                                          <span class="nav-text">User Profile</span>   
                                        </a>
                                    </li> 
                                    <li >
                                        <a class="sidenav-item-link" href="change-password.php">
                                          <span class="nav-text">Change Password</span>   
                                        </a>
                                    </li> 
                                </div>
                            </ul>
                        </li>
                <?php          
                    }
                }
                ?>
            </ul>
        </div>
    </div>
</aside>