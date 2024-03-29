<?php ob_start(); ?>
<?php
session_start();
if (isset($_SESSION['username'])) {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php include('includes/styles.php'); ?>
        <title> Edit Student | <?php echo $varsity_name; ?></title>
        <style>
            .parsley-required,
            .parsley-pattern {
                position: relative !important;
                top: 10px !important;
                left: 245px !important;
                width: 200px !important;
                list-style-type: none !important;
            }

            .fa-upload {
                background: #709561;
                padding: 5px;
                border-radius: 2px;
                color: white;
                font-size: 11px;
                cursor: pointer;
            }

            .fa-eye {
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
            <?php include('includes/notifications.php'); ?>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->

            <?php include('includes/sidebar.php'); ?>
            <?php $base_url = $conn->base_url(); ?>
            <?php
            if (isset($_GET['student'])) {
                $student_reg_no = $_GET['student'];
                $sql = "SELECT * FROM student WHERE reg_no =:reg_no";
                $conn->query($sql);
                $conn->bind(":reg_no", $student_reg_no);
                $result = $conn->fetchSingle();
                $db_reg_no = $result->reg_no;
                if ($student_reg_no == $db_reg_no) {
                    $student_name = $result->name;
                    $reg_no = $result->reg_no;
                    $deptid = $result->dept_name;
                    //   $sectionid = $result->sectionid;


                    $sql = "SELECT dept_name FROM department WHERE dept_name =:dept_name";
                    $conn->query($sql);
                    $conn->bind(":dept_name", $deptid);
                    $deptName = $conn->fetchColumn();

                    //fetch student section

                    // $sql = "SELECT name FROM sections WHERE class =:id AND id =:sectionid";
                    // $conn->query($sql);
                    // $conn->bind(":id", $classid);
                    // $conn->bind(":sectionid", $sectionid);
                    // $sectionName = $conn->fetchColumn();



            ?>
                    <!-- Content Wrapper. Contains page content -->
                    <div class="content-wrapper">
                        <!-- Content Header (Page header) -->
                        <div class="content-header">
                            <div class="container-fluid">
                                <div class="row mb-2">
                                    <div class="col-sm-6">
                                        <h1 class="m-0">Editing <?php echo $student_name; ?> </h1>
                                    </div><!-- /.col -->
                                    <div class="col-sm-6">
                                        <ol class="breadcrumb float-sm-right">
                                            <li class="breadcrumb-item"><a href="<?php echo $conn->base_url(); ?>">Home</a></li>
                                            <li class="breadcrumb-item"><a href="<?php echo $conn->base_url(); ?>student">All students</a></li>
                                            <li class="breadcrumb-item active"><?php echo $student_name; ?></li>
                                        </ol>
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                            </div><!-- /.container-fluid -->
                        </div>
                        <!-- /.content-header -->

                        <!-- Main content -->
                        <section class="content">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="card card-info">
                                            <div class="card-header">
                                                <h3 class="card-title">Editing student's data</h3>
                                            </div>
                                            <form action="" class="form-horizontal" method="post" id="student-edit">
                                                <div class="card-body">
                                                    <div class="form-group row">
                                                        <label for="name" class="col-sm-2 col-form-label"> Name <span style="color: #f00;">*</span></label>
                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control" id="name" required="true" name="name" value="<?php echo $student_name; ?>">
                                                        </div>


                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="reg_no" class="col-sm-2 col-form-label"> Registration Number <span style="color: #f00;">*</span></label>
                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control" id="reg_no" required="true" name="reg_no" value="<?php echo $reg_no; ?>">
                                                        </div>

                                                        <label for="session" class="col-sm-1 col-form-label">Session</label>
                                                        <div class="col-sm-3">
                                                            <?php
                                                            //fetch 
                                                            $sql = "SELECT DISTINCT session FROM session ORDER BY session DESC LIMIT 4";
                                                            $conn->query($sql);
                                                            $details = $conn->fetchMultiple();

                                                            ?>

                                                          <select name="session" id="session" class="form-control" required>

                                                                 <option value=""><?php echo $result->session  ?></option>
                                                                 <?php
                                                                 foreach($details as $s){
                                                                    ?>
                                                                       <option value="<?php echo $s->session?>"> <?php echo $s->session ?> </option>

                                                                 <?php } ?>

                                                          </select>


                                                        </div>

                                                    </div>





                                                    <div class="form-group row">
                                                        <label for="class" class="col-sm-2 col-form-label"> Department </label>
                                                        <div class="col-sm-4">
                                                            <?php
                                                            //fetch 
                                                            $sql = "SELECT * FROM department";
                                                            $conn->query($sql);
                                                            $details = $conn->fetchMultiple();

                                                            ?>
                                                            <select name="dept" id="dept" class="form-control" required>
                                                                <option value=""> <?php echo $result->dept_name ?></option>
                                                                <?php

                                                                foreach ($details as $class) {
                                                                ?>
                                                                    <option value="<?php echo $class->dept_name ?>"> <?php echo $class->dept_name ?> </option>
                                                                <?php
                                                                }
                                                                ?>

                                                            </select>
                                                        </div>
                                                    </div>



                                                    <label for="state" class="col-sm-2 col-form-label"></label>
                                                    <div class="col-sm-4">
                                                        <input type="submit" name="update_student" value="Update" class="btn btn-success" id="submit">
                                                    </div>

                                                </div>





                                        </div>
                                        <div id="success-msg">
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
                } else {
                    //redirect back to the teacher's page
                    header("Location: ../student");
                }
    ?>
<?php } else {
                //redirect back to the teacher's page
                header("Location: student");
            }
?>

<?php include 'includes/footer.php'; ?>
<!-- Add logo  Modal start -->

<script>
    $('[data-toggle ="tooltip"]').tooltip();
</script>





<script>
    $('#student-edit').parsley();
    $('#student-edit').on('submit', function(event) {
        event.preventDefault();
        if ($('#student-edit').parsley().isValid()) {
            $.ajax({
                url: "<?php echo $conn->base_url(); ?>process-edit-student.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#submit').attr('disabled', 'disabled');
                    $('#submit').val('Updating student details, pls wait ......');

                },
                success: function(data) {
                    $('#student-edit').parsley().reset();
                    $('#submit').attr('disabled', false);
                    $('#submit').val('Update');
                    $('#success-msg').html(data);
                }
            })
        }

    })
</script>



<?php
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
        <title> Login to continue | <?php echo $varsity_name; ?> </title>

        <?php include 'includes/styles.php'; ?>
        <?php
        $conn = new Functions();
        $base_url = $conn->base_url();
        $redirect = $base_url . "login";
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
                        <p>Redirecting to the login page...</p>
                    </div>
                </div>
            </div>
        </div>

    <?php

}

    ?>