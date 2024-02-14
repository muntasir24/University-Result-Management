<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include('includes/styles.php');?>
    <title> view Teacher | <?php echo $varsity_name; ?></title>
    <style>
        .parsley-required, .parsley-pattern {
            position: relative !important;
            top: 10px !important;
            left: 245px !important;
            width: 200px !important;
            list-style-type: none !important;
        }

        .fa-upload{
            background: #709561;
            padding: 5px;
            border-radius: 2px;
            color: white;
            font-size: 11px;
            cursor: pointer;
        }

        .fa-eye{
            cursor: pointer;
            background: #f59c1a;
            padding: 5px;
            border-radius: 2px;
            color: white;
            font-size: 11px;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <?php include('includes/notifications.php');?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->

    <?php include('includes/sidebar.php');?>
    <?php
      if(isset($_GET['teacher'])){
          $teacher_username = $_GET['teacher'];
          $sql = "SELECT * FROM teachers WHERE username =:username";
          $conn->query($sql);
          $conn->bind(":username", $teacher_username);
          $result = $conn->fetchSingle();
          $db_username = $result->username;
          if($teacher_username == $db_username){
              $teacher_name = $result->name;


    ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Viewing <?php echo $teacher_name; ?> </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo $conn->base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo $conn->base_url();?>teacher">All teachers</a></li>
                            <li class="breadcrumb-item active"><?php echo $teacher_name; ?></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>



        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">View teacher's data below</h3>
                            </div>

                            <form action="" class="form-horizontal" method="post" id="teacher-add">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 col-form-label">Teachers's name <span
                                                style="color: #f00;">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="name" required
                                                   data-parsley-trigger="keyup" name="name" value="<?php echo $teacher_name;  ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="dept_name" class="col-sm-3 col-form-label">Department<span
                                                style="color: #f00;">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="dept_name" class="form-control" required
                                                   data-parsley-trigger="keyup" value="<?php echo $result->dept_name;  ?>">
                                        </div>
                                    </div>

                                   
                                   

                                    <div class="form-group row">
                                        <label for="username" class="col-sm-3 col-form-label">Username <span
                                                style="color: #f00;">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="username" required
                                                   name="username" value="<?php echo $result->username;  ?>">
                                        </div>
                                    </div>

                                </div>

                            </form>

                        </div>
                    </div>

                   


                </div>


            </div><!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
}else{
    //redirect back to the teacher's page
    header("Location: ../teacher");
}
?>
<?php }else{
    //redirect back to the teacher's page
    header("Location: teacher");
}
?>

<?php include 'includes/footer.php'; ?>
<!-- Add logo  Modal start -->

<script>
    $('[data-toggle ="tooltip"]').tooltip();
</script>

    <?php
