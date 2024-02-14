<?php
session_start();
error_reporting(0);
if (isset($_SESSION['username'])) {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php include('includes/styles.php'); ?>
        <title> Subject | <?php echo $varsity_name; ?></title>
        <style>
            .card-title a {
                font-size: 16px;
                border-bottom: 1px solid #707478;
                color: #707478;
            }

            .card-title a:hover {
                border-bottom: 1px solid #1A2229;
                color: #1A2229;
            }

            .btn-app:first-child {
                margin-left: 0 !important;
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
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">Subject </h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?php echo $conn->base_url(); ?>">Home</a></li>
                                    <li class="breadcrumb-item active">Subjects</li>
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
                            <section class="col-lg-12 connectedSortable">
                                <div class="card">
                                    <div class="card-header" style="background: #17a2b8; color: #fff;">
                                        <h3 class="card-title" style="font-size: 15px;">
                                            <i class="fa fa-star"></i>
                                            Manage Subjects
                                        </h3>
                                    </div>
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <a href="<?php echo $conn->base_url(); ?>add-subject">Add a subject
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <h3 class="card-title text-center" style="font-size: 15px;">
                                            Please select a Department to view available subjects
                                           

                                        </h3>
                                        <br><br>
                                        <div>
                                            <?php
                                            $sql = "SELECT d.dept_name, COUNT(s.subject_code) as subjects_available FROM department d  JOIN subjects s ON d.dept_name = s.dept_name  GROUP BY d.dept_name";
                                            $conn->query($sql);
                                            $result = $conn->fetchMultiple();
                                            $n = 0;

                                            foreach ($result as $dept) {
                                                $dept_id = $dept->dept_name;

                                                // badge color array
                                                $badge_color = array('bg-success', 'bg-purple', 'bg-warning', 'bg-info', 'bg-danger', 'bg-teal');

                                                // enable or disable link based on the number of available subjects
                                                $link = $base_url . "subject/$dept_id";

                                            ?>
                                                <a class="btn btn-app" style="min-width:120px; height: 90px;" <?php
                                                                                                                if ($dept->subjects_available != 0) {
                                                                                                                    echo "href='$link'";
                                                                                                                }
                                                                                                                ?>>
                                                    <span class="badge <?php echo $badge_color[$n]; ?>" data-toggle="tooltip" title="<?php echo $dept->subjects_available; ?> subject(s) available in Department <?php echo $dept_id; ?>">
                                                        <?php echo $dept->subjects_available; ?>
                                                    </span>
                                                    <i class="fas fa-users" style="font-size: 50px;"></i>
                                                    <?php echo ucwords($dept_id); ?>
                                                </a>
                                            <?php
                                                $n++;
                                            }
                                            ?>


                                        </div>
                                        <?php
                                        // Debugging
                                        //var_dump($_GET);

                                        if (isset($_GET['dept'])) {
                                            //  echo "The 'subject' parameter is set.";
                                        } else {
                                            //echo "The 'subject' parameter is not set.";
                                        }
                                        ?>
                                        <?php
                                        if (isset($_GET['dept'])) {
                                            $dept = ucwords($_GET['dept']);
                                            $sql = "SELECT * FROM subjects WHERE dept_name = :dept";
                                            $conn->query($sql);
                                            $conn->bind(":dept", $dept);
                                            $result = $conn->fetchMultiple();

                                            $sql = "SELECT dept_name FROM department WHERE dept_name =:dept_name";
                                            $conn->query($sql);
                                            $conn->bind(":dept_name", $dept);
                                            $class_name = $conn->fetchColumn();

                                        ?>
                                            <div class="card-header" style="background: #c3570f; color: #fff; margin: 20px 0 2px;">
                                                <h3 class="card-title" style="font-size: 15px;">
                                                    <i class="fa fa-star"></i>
                                                    Viewing Subject details for Department <?php echo $class_name; ?>
                                                </h3>
                                            </div>

                                            <table id="subject" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>

                                                        <th>Subject Code</th>
                                                        <th>Subject Name</th>
                                                        <th>Teacher</th>
                                                        <th>Credit</th>
                                                        <th>Semester</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 1;
                                                    if ($conn->rowCount() > 0) {
                                                        foreach ($result as $subject_details) :

                                                            $subject_code = $subject_details->subject_code;
                                                            $subject_name = $subject_details->subject_name;
                                                            $teacher_name = $subject_details->t_name;
                                                            $credit = $subject_details->credit;
                                                            $semester=$subject_details->semester;



                                                    ?>
                                                            <tr>
                                                                <td><?php echo $i++; ?></td>
                                                                <td><?php echo $subject_code; ?></td>
                                                                <td><?php echo $subject_name; ?></td>
                                                                <td><?php echo $teacher_name; ?></td>
                                                                <td><?php echo $credit; ?></td>
                                                                <td><?php echo $semester;?></td>
                                                                <td>
                                                                    <a href="<?php echo $base_url; ?>edit-subject/<?php echo $subject_code; ?>" data-toggle="tooltip" title="Edit">
                                                                        <i class="fa fa-edit"></i>
                                                                    </a>&nbsp;
                                                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#delete-subject<?php echo $subject_code; ?>">
                                                                        <i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <tr>
                                                            <td colspan="7" class="text-center">No Data in table</td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>

                                                <tfoot>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Subject Code</th>
                                                        <th>Subject Name</th>
                                                        <th>Teacher</th>
                                                        <th>Credit</th>
                                                        <th>Semester</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </tfoot>

                                            </table>


                                        <?php
                                        }

                                        ?>




                                    </div>
                                </div>
                            </section>




                        </div>



                    </div><!-- /.row (main row) -->
                </section>
            </div><!-- /.container-fluid -->
            <!-- /.content -->

            <!-- /.content-wrapper -->

            <?php include 'includes/footer.php'; ?>
            <?php
            foreach ($result as $subject_details) {
                $subject_name = $subject_details->subject_name;
                $subject_code = $subject_details->subject_code;

                $credit = $subject_details->credit;

                $teacher_name = $subject_details->t_name;

            ?>
                <!--          Delete subject modal start-->
                <div class="modal fade" id="delete-subject<?php echo $subject_code; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete subject <?php echo $subject_name; ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h4>
                                    Are you sure you want delete subject <span style="color: #f00; text-transform: uppercase;"><?php echo $subject_name; ?></span>
                                    <br>
                                    <span class="text-warning">This action cannot be undone</span>
                                </h4>
                                <form action="" method="post">
                                    <div class="form-group">
                                        <input type="hidden" name="id" value="<?php echo $subject_code; ?>">
                                    </div>
                                    <div class="modal-footer" style="margin-bottom: -10px;">

                                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                                        <input type="submit" class="btn btn-outline-danger" value="Delete subject" id="submit" name="delete_subject">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--          Delete teacher modal end -->

            <?php
            }

            //delete teacher script

            if (isset($_POST['delete_subject'])) {
                $id = $_POST['id'];
                //sql
                $sql = "DELETE FROM subjects WHERE subject_code =:id";
                $conn->query($sql);
                $conn->bind(":id", $id);
                $redirect = $base_url . 'subject';

                try {
                    $conn->execute();
                    echo "<p class='alert alert-success alert-dismissible fade show' role='alert'>
                    <i class='fas fa-check-circle'></i>Subject data deleted successfully.
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                             <span aria-hidden=\"true\">×</span>
                  </button>
                   <meta http-equiv='refresh' content='3; $redirect'>
                  
           </p>";
                } catch (PDOException $err) {
                    echo $err->getMessage();
                }
            }
            ?>

            <script>
                $('[data-toggle ="tooltip"]').tooltip();
            </script>

            <script>
                $(function() {
                    $("#subject").DataTable({
                        "responsive": true,
                        "lengthChange": false,
                        "autoWidth": false,
                        "buttons": ["copy", "csv", "pdf", "print"]
                    }).buttons().container().appendTo('#subject_wrapper .col-md-6:eq(0)');
                    $('#example2').DataTable({
                        "paging": true,
                        "lengthChange": false,
                        "searching": true,
                        "ordering": true,
                        "info": true,
                        "autoWidth": false,
                        "responsive": true
                    });
                });
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