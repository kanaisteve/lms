<!--
  ====================================
  ——— LEFT SIDEBAR WITH FOOTER
  =====================================
-->
<aside class="left-sidebar bg-sidebar">
    <div id="sidebar" class="sidebar sidebar-with-footer">
        <!-- Aplication Brand -->
        <div class="app-brand">
            <a href="/index.php">
                <svg
                  class="brand-icon"
                  xmlns="http://www.w3.org/2000/svg"
                  preserveAspectRatio="xMidYMid"
                  width="30"
                  height="33"
                  viewBox="0 0 30 33"
                >
                    <g fill="none" fill-rule="evenodd">
                        <path
                          class="logo-fill-blue"
                          fill="#7DBCFF"
                          d="M0 4v25l8 4V0zM22 4v25l8 4V0z"
                        />
                        <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
                    </g>
                </svg>
                <span class="brand-name">UI Kit</span>
            </a>
        </div>
        
        <!-- begin sidebar scrollbar -->
        <div class="sidebar-scrollbar">
            <!-- sidebar menu -->
            <ul class="nav sidebar-inner" id="sidebar-menu">
                <li  class="has-sub active expand" >
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#dashboard"
                      aria-expanded="false" aria-controls="dashboard">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span class="nav-text">Dashboard</span> <b class="caret"></b>
                    </a>
                    <ul  class="collapse show"  id="dashboard"
                      data-parent="#sidebar-menu">
                        <div class="sub-menu">
                            <li  class="active" >
                                <a class="sidenav-item-link" href="kanaitech.php">
                                    <span class="nav-text">Kanaitech</span>
                                </a>
                                <a class="sidenav-item-link" href="index.php">
                                    <span class="nav-text">Ecommerce</span>
                                </a>
                            </li>
                            <li>
                                <a class="sidenav-item-link" href="analytics.php">
                                    <span class="nav-text">Analytics</span>
                                    <span class="badge badge-success">new</span>
                                </a>
                            </li>
                        </div>
                    </ul>
                </li>
                <li class="has-sub" >
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#ui-elements"
                      aria-expanded="false" aria-controls="ui-elements">
                        <i class="mdi mdi-folder-multiple-outline"></i>
                        <span class="nav-text">UI Elements</span> <b class="caret"></b>
                    </a>
                    <ul  class="collapse"  id="ui-elements" data-parent="#sidebar-menu">
                        <div class="sub-menu">
                            <!-- Components -->
                            <li  class="has-sub" >
                                <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#components"
                                  aria-expanded="false" aria-controls="components">
                                    <span class="nav-text">Components</span> <b class="caret"></b>
                                </a>
                                <ul  class="collapse"  id="components">
                                    <div class="sub-menu">
                                        <li ><a href="alert.php">Alert</a></li> 
                                        <li ><a href="badge.php">Badge</a></li> 
                                        <li ><a href="breadcrumb.php">Breadcrumb</a></li> 
                                        <li ><a href="button-default.php">Button Default</a></li> 
                                        <li ><a href="button-dropdown.php">Button Dropdown</a></li> 
                                        <li ><a href="button-group.php">Button Group</a></li> 
                                        <li ><a href="button-social.php">Button Social</a></li> 
                                        <li ><a href="button-loading.php">Button Loading</a></li> 
                                        <li ><a href="card.php">Card</a></li> 
                                        <li ><a href="carousel.php">Carousel</a></li> 
                                        <li ><a href="collapse.php">Collapse</a></li> 
                                        <li ><a href="list-group.php">List Group</a></li> 
                                        <li ><a href="modal.php">Modal</a></li> 
                                        <li ><a href="pagination.php">Pagination</a></li> 
                                        <li ><a href="popover-tooltip.php">Popover & Tooltip</a></li> 
                                        <li ><a href="progress-bar.php">Progress Bar</a></li> 
                                        <li ><a href="spinner.php">Spinner</a></li> 
                                        <li ><a href="switcher.php">Switcher</a></li> 
                                        <li ><a href="table.php">Table</a></li> 
                                        <li ><a href="tab.php">Tab</a></li> 
                                    </div>
                                </ul>
                            </li>   

                            <!-- Icons -->
                            <li class="has-sub" >
                                <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#icons"
                                  aria-expanded="false" aria-controls="icons">
                                  <span class="nav-text">Icons</span> <b class="caret"></b>
                                </a>
                                <ul  class="collapse"  id="icons">
                                    <div class="sub-menu">  
                                        <li ><a href="material-icon.php">Material Icon</a></li> 
                                        <li ><a href="flag-icon.php">Flag Icon</a></li> 
                                    </div>
                                </ul>
                            </li>   

                            <!-- Forms -->
                            <li class="has-sub" >
                                <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#forms"
                                  aria-expanded="false" aria-controls="forms">
                                    <span class="nav-text">Forms</span> <b class="caret"></b>
                                </a>
                                <ul  class="collapse"  id="forms">
                                    <div class="sub-menu">  
                                        <li ><a href="basic-input.php">Basic Input</a></li> 
                                        <li ><a href="input-group.php">Input Group</a></li> 
                                        <li ><a href="checkbox-radio.php">Checkbox & Radio</a></li> 
                                        <li ><a href="form-validation.php">Form Validation</a></li> 
                                        <li ><a href="form-advance.php">Form Advance</a></li> 
                                    </div>
                                </ul>
                            </li>   

                            <!-- Maps -->
                            <li  class="has-sub" >
                                <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#maps"
                                  aria-expanded="false" aria-controls="maps">
                                    <span class="nav-text">Maps</span> <b class="caret"></b>
                                </a>
                                <ul class="collapse"  id="maps">
                                    <div class="sub-menu">  
                                        <li ><a href="google-map.php">Google Map</a></li> 
                                        <li ><a href="vector-map.php">Vector Map</a></li> 
                                    </div>
                                </ul>
                            </li>   

                            <!-- Widgets -->
                            <li class="has-sub" >
                                <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#widgets"
                                  aria-expanded="false" aria-controls="widgets">
                                  <span class="nav-text">Widgets</span> <b class="caret"></b>
                                </a>
                                <ul class="collapse"  id="widgets">
                                    <div class="sub-menu">  
                                        <li ><a href="general-widget.php">General Widget</a></li> 
                                        <li ><a href="chart-widget.php">Chart Widget</a></li> 
                                    </div>
                                </ul>
                            </li> 
                            
                            <!-- Bootstrap 3 -->
                            <li class="has-sub" >
                                <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#bootstrap3"
                                  aria-expanded="false" aria-controls="bootstrap3">
                                    <span class="nav-text">Bootstrap 3</span> <b class="caret"></b>
                                </a>
                                <ul class="collapse"  id="bootstrap3">
                                    <div class="sub-menu">
                                        <li><a href="typography.php">Typography</a></li>
                                        <li><a href="components.php">Components</a></li>
                                        <li><a href="pricing-box.php">Pricing Box</a></li>
                                        <li><a href="blog-rightsidebar.php">Blog Right Sidebar</a></li>
                                        <li><a href="blog-leftsidebar.php">Blog Left Sidebar</a></li>
                                        <li><a href="post-rightsidebar.php">Post Right Sidebar</a></li>
                                        <li><a href="post-leftsidebar.php">Post Left Sidebar</a></li>
                                    </div>
                                </ul>
                            </li>   
                        </div>
                    </ul>
                </li> 

                <!-- Charts -->
                <li  class="has-sub" >
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#charts"
                      aria-expanded="false" aria-controls="charts">
                      <i class="mdi mdi-chart-pie"></i>
                      <span class="nav-text">Charts</span> <b class="caret"></b>
                    </a>
                    <ul  class="collapse"  id="charts"
                      data-parent="#sidebar-menu">
                        <div class="sub-menu">
                            <li ><a href="chartjs.php"><span class="nav-text">ChartJS</span></a></li>                        
                        </div>
                    </ul>
                </li>

                <!-- Pages -->
                <li  class="has-sub" >
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#pages"
                      aria-expanded="false" aria-controls="pages">
                        <i class="mdi mdi-image-filter-none"></i>
                        <span class="nav-text">Pages</span> <b class="caret"></b>
                    </a>
                    <ul  class="collapse"  id="pages"
                      data-parent="#sidebar-menu">
                        <div class="sub-menu">
                            <li >
                                <a class="sidenav-item-link" href="user-profile.php">
                                    <span class="nav-text">User Profile</span>
                                </a>
                            </li>
                            <li >
                                <a class="sidenav-item-link" href="services.php">
                                    <span class="nav-text">Services</span>  
                                </a>
                            </li>   
                            <li  class="has-sub" >
                                <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#authentication"
                                  aria-expanded="false" aria-controls="authentication">
                                    <span class="nav-text">Authentication</span> <b class="caret"></b>
                                </a>
                                <ul  class="collapse"  id="authentication">
                                    <div class="sub-menu">  
                                        <li ><a href="sign-in.php">Sign In</a></li> 
                                        <li ><a href="sign-up.php">Sign Up</a></li> 
                                    </div>
                                </ul>
                            </li> 
                            <li  class="has-sub" >
                                <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#others"
                                  aria-expanded="false" aria-controls="others">
                                    <span class="nav-text">Others</span> <b class="caret"></b>
                                </a>
                                <ul  class="collapse"  id="others">
                                    <div class="sub-menu">  
                                        <li ><a href="invoice.php">invoice</a></li> 
                                        <li ><a href="error.php">Error</a></li> 
                                    </div>
                                </ul>
                            </li>                        
                        </div>
                    </ul>
                </li>

                <!-- Documentation -->
                <li  class="has-sub" >
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#documentation"
                      aria-expanded="false" aria-controls="documentation">
                        <i class="mdi mdi-book-open-page-variant"></i>
                        <span class="nav-text">Documentation</span> <b class="caret"></b>
                    </a>
                    <ul  class="collapse"  id="documentation" data-parent="#sidebar-menu">
                        <div class="sub-menu">    
                                <li class="section-title">Getting Started</li>
                                <li >
                                    <a class="sidenav-item-link" href="introduction.php">
                                        <span class="nav-text">Introduction</span>  
                                    </a>
                                </li>
                                <li >
                                    <a class="sidenav-item-link" href="setup.php">
                                        <span class="nav-text">Setup</span> 
                                    </a>
                                </li>   
                                <li >
                                    <a class="sidenav-item-link" href="customization.php">
                                        <span class="nav-text">Customization</span> 
                                    </a>
                                </li>
                                <li class="section-title">
                                  Layouts
                                </li>
                          <li class="has-sub" >
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#headers"
                              aria-expanded="false" aria-controls="headers">
                              <span class="nav-text">Layout Headers</span> <b class="caret"></b>
                            </a>
                            <ul  class="collapse"  id="headers">
                                <div class="sub-menu">  
                                    <li ><a href="header-fixed.php">Header Fixed</a></li> 
                                    <li ><a href="header-static.php">Header Static</a></li> 
                                    <li ><a href="header-light.php">Header Light</a></li> 
                                    <li ><a href="header-dark.php">Header Dark</a></li> 
                                </div>
                            </ul>
                          </li>
                            <!-- Layout Sidebar -->
                            <li  class="has-sub" >
                                <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#sidebar-navs"
                                  aria-expanded="false" aria-controls="sidebar-navs">
                                  <span class="nav-text">layout Sidebars</span> <b class="caret"></b>
                                </a>
                                <ul  class="collapse"  id="sidebar-navs">
                                    <div class="sub-menu">
                                        <li ><a href="sidebar-open.php">Sidebar Open</a></li> 
                                        <li ><a href="sidebar-minimized.php">Sidebar Minimized</a></li> 
                                        <li ><a href="sidebar-offcanvas.php">Sidebar Offcanvas</a></li> 
                                        <li ><a href="sidebar-with-footer.php">Sidebar With Footer</a></li> 
                                        <li ><a href="sidebar-without-footer.php">Sidebar Without Footer</a></li> 
                                        <li ><a href="right-sidebar.php">Right Sidebar</a></li>
                                    </div>
                                </ul>
                            </li>
                            <li >
                                <a class="sidenav-item-link" href="rtl.php"><span class="nav-text">RTL Direction</span></a>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
        <hr class="separator" />
        <div class="sidebar-footer">
            <div class="sidebar-footer-content">
                <h6 class="text-uppercase">
                    Cpu Uses <span class="float-right">40%</span>
                </h6>
                <div class="progress progress-xs">
                    <div
                      class="progress-bar active"
                      style="width: 40%;"
                      role="progressbar"
                    ></div>
                </div>
                <h6 class="text-uppercase">
                    Memory Uses <span class="float-right">65%</span>
                </h6>
                <div class="progress progress-xs">
                    <div
                      class="progress-bar progress-bar-warning"
                      style="width: 65%;"
                      role="progressbar"
                    ></div>
                </div>
            </div>
        </div>
    </div>
</aside>