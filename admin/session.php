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
        <title> Sessions | <?php echo $varsity_name; ?></title>
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
                                <h1 class="m-0">Sessions </h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?php echo $conn->base_url(); ?>">Home</a></li>
                                    <li class="breadcrumb-item active">Sessions</li>
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
                                            Manage Sessions
                                        </h3>
                                    </div>
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <a href="<?php echo $conn->base_url(); ?>add-session">Add session
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <h3 class="card-title text-center" style="font-size: 15px;">
                                            Please select a Department to view the session
                                            <i class="fa fa-info-circle" data-toggle="tooltip" title="N:B: 
                                        click to see session and students in each session"></i>

                                        </h3>
                                        <br><br>
                                        <div>
                                            <?php
                                            $sql = "SELECT d.dept_name, COUNT(s.session) as tot_session  FROM department d LEFT JOIN session s ON d.dept_name = s.dept_name   GROUP BY d.dept_name";
                                            $conn->query($sql);
                                            $result = $conn->fetchMultiple();
                                            $n = 0;

                                            foreach ($result as $dept) {
                                                $dept_id = $dept->dept_name;

                                                // badge color array
                                                $badge_color = array('bg-success', 'bg-purple', 'bg-warning', 'bg-info', 'bg-danger', 'bg-teal');

                                                // enable or disable link based on the number of available sessions
                                                $link = $base_url . "session/$dept_id";
                                            ?>
                                                <a class="btn btn-app" style="min-width:120px; height: 90px;" <?php if ($dept->tot_session != 0) {
                                                                                                                    echo "href='$link'";
                                                                                                                } ?>>
                                                    <span class="badge <?php echo $badge_color[$n]; ?>" data-toggle="tooltip" title=" having <?php echo $dept->tot_session; ?> session(s) in <?php echo $dept_id; ?>">
                                                        <?php echo $dept->tot_session; ?>
                                                    </span>
                                                    <i class="fas fa-users" style="font-size: 50px;"> </i>
                                                    <?php echo ucwords($dept_id); ?>
                                                </a>
                                            <?php
                                                $n++;
                                            }
                                            ?>

                                        </div>

                                        <?php
                                        if (isset($_GET['session'])) {

                                            $session = ucwords(str_replace('-', ' ', $_GET['session']));
                                            $sql = "SELECT * FROM session WHERE dept_name = :session";
                                            $conn->query($sql);
                                            $conn->bind(":session", $session);
                                            $result = $conn->fetchMultiple();

                                            $sql = "SELECT dept_name FROM department WHERE dept_name =:dept_name";
                                            $conn->query($sql);
                                            $conn->bind(":dept_name", $session);
                                            $class_name = $conn->fetchColumn();

                                        ?>
                                            <div class="card-header" style="background: #c3570f; color: #fff; margin: 20px 0 2px;">
                                                <h3 class="card-title" style="font-size: 15px;">
                                                    <i class="fa fa-star"></i>
                                                    Viewing Section details for Department <?php echo $class_name; ?>
                                                </h3>
                                            </div>

                                            <table id="section" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Session</th>
                                                        <th>Students</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 1;
                                                    if ($conn->rowCount() > 0) {
                                                        foreach ($result as $session_details) :
                                                            $name = $session_details->session;
                                                            $capacity = $session_details->capacity;



                                                    ?>
                                                            <tr>
                                                                <td><?php echo $i++; ?></td>
                                                                <td><?php echo $name; ?></td>
                                                                <td><?php echo $capacity; ?></td>

                                                                <td>

                                                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#delete-section<?php echo $section_id; ?>">
                                                                        <i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <tr>
                                                            <td colspan="5" class="text-center">No Data in table</td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>

                                                <tfoot>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Session</th>
                                                        <th>Capacity</th>
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


            <script>
                $('[data-toggle ="tooltip"]').tooltip();
            </script>

            <script>
                $(function() {
                    $("#section").DataTable({
                        "responsive": true,
                        "lengthChange": false,
                        "autoWidth": false,
                        "buttons": ["copy", "csv", "pdf", "print"]
                    }).buttons().container().appendTo('#section_wrapper .col-md-6:eq(0)');
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