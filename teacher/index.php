<?php
session_start();
if(isset($_SESSION['teacher'])){
    $username = $_SESSION['teacher'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include('../admin/includes/styles.php');?>
    <title> Teacher Dashboard | <?php echo $varsity_name; ?></title>
   
    
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <?php include('includes/notifications.php');?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->

    <?php include('includes/sidebar.php');?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-8">
                        <h1 class="m-0"> Quick Links </h1>
                        <?php
                        $sql = "SELECT * FROM teachers WHERE username =:username";
                        $conn->query($sql);
                        $conn->bind(":username", $_SESSION['teacher']);
                        $result = $conn->fetchSingle();
                        $teacher_name = $result->name;

                        ?>
                        <p class="m-0">Welcome: <span style='color: green; font-weight: bold; font-size: 18px; text-transform: uppercase;'><?php echo ucwords($teacher_name); ?></span>
                         
                               
                        
                    </div><!-- /.col -->
                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <?php include 'includes/home_infos.php'; ?>
                <!-- /.row -->
                <!-- Main row -->
               
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php include '../admin/includes/footer.php'; ?>

   
    <?php
    }else{
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
     

        <?php include '../admin/includes/styles.php'; ?>
           <title> Login to continue | <?php echo $varsity_name; ?> </title>
        <?php
        $conn = new Functions();
        $base_url = $conn->main_url();
        $redirect = $base_url."/teacher/login";
        ?>

        <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    </head>
    <body>
    <div class="container" style="margin-top: 20%;">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="section-title text-center">
                    <h6> You need to login to continue </h6>
                    <div class="spinner-border text-info" role="status">
                        <span class="sr-only">Loading...</span>
                        <meta http-equiv='refresh' content='3; <?php echo $redirect; ?>'>
                    </div>
                    <p>Redirecting to the login  page...</p>
                </div>
            </div>
        </div>
    </div>

    <?php

    }

    ?>
