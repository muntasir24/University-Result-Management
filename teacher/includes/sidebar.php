<?php
$change_style = "font-size: 13px; color: #17a2b8; padding: 4px;";

$base_url = $conn->base_url();
$teacher_url = $conn->main_url()."/teacher";
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo $base_url; ?>" class="brand-link">
        <img src="<?php echo $conn->base_url(); ?>upload/<?php echo $logo; ?>" alt="<?php echo $logo; ?>" class="brand-image img-circles elevation-4" style="opacity: .8">
        <span class="brand-text font-weight-light" style="visibility: hidden;">Teacher</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->

        <!-- SidebarSearch Form -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="<?php echo $teacher_url;  ?>" <?php
                    if(basename($_SERVER['SCRIPT_NAME']) == 'index.php'){
                        //APPLY THE ACTIVE CLASS
                        echo 'class = "nav-link active"';
                    }else{
                        echo 'class = "nav-link"';
                    }
                    ?>>
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>




              

                <!-- start mark sidebar content -->
                <li <?php
                if(basename($_SERVER['SCRIPT_NAME']) == 'mark.php'
                    || basename($_SERVER['SCRIPT_NAME']) == 'view-mark.php'
                    || basename($_SERVER['SCRIPT_NAME']) == 'add-mark.php'){
                    //APPLY THE ACTIVE CLASS
                    echo 'class = "nav-item menu-open"';
                }else{
                    echo 'class = "nav-item"';
                }
                ?>>
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-bookmark"></i>
                        <p>
                            Mark
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo $teacher_url;?>/mark"
                                <?php   if(basename($_SERVER['SCRIPT_NAME']) == 'mark.php'
                                    || basename($_SERVER['SCRIPT_NAME']) == 'add-mark.php'
                                    || basename($_SERVER['SCRIPT_NAME']) == 'view-mark.php'){
                                    //APPLY THE ACTIVE CLASS
                                    echo 'class = "nav-link active"';
                                }else{
                                    echo 'class = "nav-link"';
                                }
                                ?>>
                                <i class="fas fa-flask nav-icon" style="<?php echo $change_style; ?>"></i>
                                <p> Mark </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- end mark sidebar content -->


        

   

                

                <li class="nav-item">
                    <a href="<?php echo $teacher_url;?>/logout" <?php
                    if(basename($_SERVER['SCRIPT_NAME']) == 'logout.php'){
                        //APPLY THE ACTIVE CLASS
                        echo 'class = "nav-link active"';
                    }else{
                        echo 'class = "nav-link"';
                    }
                    ?>>
                        <i class="nav-icon fas fa-lock"></i>
                        <p>Logout
                        </p>
                    </a>
                </li>





            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>