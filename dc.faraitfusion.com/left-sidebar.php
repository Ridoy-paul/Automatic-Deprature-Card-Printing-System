<?php
if(isset($_SESSION['username'])){
     $username =  $_SESSION['username'];
     
    $f_query=query("SELECT * FROM `admin` where username='$username' || gmail = '$username'");
    confirm($f_query);
    $f_rows=fetch_array($f_query);
    $type = $f_rows['type'];
    $ID = $f_rows['id'];
    
    if ($type == 'Admin'){
        ?><aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index.php" class="brand-link bg-light">
            <img src="media/passportLogo.png"  class="brand-image" style="text-align: center;">
            <span class="brand-text font-weight-light"></span>
        </a>
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                              <i class="nav-icon fas fa-users"></i>
                              <p>
                                CRM
                                <i class="right fas fa-angle-right"></i>
                              </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="add-crm.php" class="nav-link">
                                        <i class="nav-icon fas fa-user-plus"></i>
                                        <p>
                                            Add CRM
                                            <span class="right badge badge-danger">New</span>
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="active-crm.php" class="nav-link">
                                        <i class="nav-icon fas fa-child"></i>
                                        <p>
                                            Active CRM
                                            <span class="right badge badge-danger">See All</span>
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="deactive-crm.php" class="nav-link">
                                        <i class="nav-icon fas fa-user-slash"></i>
                                        <p>
                                           Deactivated CRM
                                            <span class="right badge badge-danger">See All</span>
                                        </p>
                                    </a>
                                </li>
                            </ul>
                    </li>
                    <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                              <i class="nav-icon fas fa-plane"></i>
                              <p>
                                Flight Type
                                <i class="right fas fa-angle-right"></i>
                              </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="add-flight-type.php" class="nav-link">
                                        <i class="nav-icon fas fa-fighter-jet"></i>
                                        <p>
                                            Add Flight Type
                                            <span class="right badge badge-primary">New</span>
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="active-flight-type.php" class="nav-link">
                                        <i class="nav-icon fas fa-seedling"></i>
                                        <p>
                                            All Flight Type
                                            <span class="right badge badge-primary">See All</span>
                                        </p>
                                    </a>
                                </li>
                                <!--<li class="nav-item">-->
                                <!--    <a href="deactive-flight-type.php" class="nav-link">-->
                                <!--        <i class="nav-icon fas fa-paper-plane"></i>-->
                                <!--        <p>-->
                                <!--           Deactivated Flight Type-->
                                <!--            <span class="right badge badge-primary">See All</span>-->
                                <!--        </p>-->
                                <!--    </a>-->
                                <!--</li>-->
                            </ul>
                    </li>
                    
                    <li class="nav-item has-treeview">
                        <a href="setting-passport.php" class="nav-link">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>
                                Setting
                            </p>
                        </a>
                    </li>
                    
                    <li class="nav-item has-treeview">
                        <a href="index.php" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Scan Passport
                            </p>
                        </a>
                    </li>
                    
                      <li class="nav-item has-treeview bg-danger">
                        <a href="all-scanned-passport.php" class="nav-link">
                          <i class="nav-icon fas fa-id-card-alt"></i>
                          <p>
                            All Scanned Passport
                            <i class="right"></i>
                          </p>
                        </a>
                      </li>
                      <li class="nav-item has-treeview">
                        <a href="passport-report.php" class="nav-link">
                          <i class="nav-icon fa fa-file"></i>
                          <p>
                            Report
                            <i class="right"></i>
                          </p>
                        </a>
                      </li>
                      
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside><?php
    }
    else if($type == "CRM"){
        ?>
        
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index.php" class="brand-link bg-light">
            <img src="media/passportLogo.png"  class="brand-image">
            <span class="brand-text font-weight-light"></span>
        </a>
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                         <li class="nav-item has-treeview">
                            <a href="index.php" class="nav-link active bg-danger">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Scan Passport
                                </p>
                            </a>
                        </li>
                        
                        <li class="nav-item has-treeview">
                                    <a href="/client-profile.php" class="nav-link">
                                    <i class="nav-icon fas fa-id-card-alt"></i>
                                    <p>
                                        Profile
                                        <span class="right badge badge-danger"></span>
                                    </p>
                                </a>
                          </li>
                        <li class="nav-item has-treeview">
                            <a href="all-scanned-passport.php" class="nav-link">
                              <i class="nav-icon fas fa-file-invoice"></i>
                              <p>
                                All Scanned Passport
                                <i class="right"></i>
                              </p>
                            </a>
                          </li>
                          <li class="nav-item has-treeview">
                            <a href="crm-summery.php?crmID=<?php echo $ID; ?>" class="nav-link">
                                <i class="nav-icon fas fa-info-circle"></i>
                                <p>
                                    Summery
                                </p>
                            </a>
                        </li>
                         
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
        
        <?php
    }
    
}
?>
<!-- Main Sidebar Container -->
    
