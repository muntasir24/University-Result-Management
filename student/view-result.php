<?php

session_start();
//error_reporting('0');
if (isset($_SESSION['student'])) {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <?php include '../admin/includes/styles.php'; ?>
        <title>View Terminal Report | <?php echo $varsity_name; ?></title>
    </head>

    <body class="hold-transition sidebar-mini layout-fixed">

        <div class="wrapper">
            <!-- Navbar -->
            <?php include 'includes/notifications.php'; ?>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <?php include "includes/sidebar.php"; ?>



            <?php
            $reg_no = $_SESSION['student'];


            //get users information from the database

            $sql = "SELECT * FROM student WHERE reg_no = :r";
            $conn->query($sql);
            $conn->bind(":r", $reg_no);
            $row_count = $conn->rowCount();
            $result = $conn->fetchSingle();
            $dept = $result->dept_name;
            $session = $result->session;
            $name = $result->name;



            ?>

            <div class="content-wrapper">

                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">View Terminal Report</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                                    <li class="breadcrumb-item active">View Terminal Report </li>
                                </ol>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->


                <section class="content">

                    <div class="content-fluid">
                        <div class="row">
                            <section class="col-lg-12 contentSortable">

                                <div class="card">
                                    <div class="card-header" style="background: #17a2b8; color: white;">
                                        <h3 class="card-title" style="font-size: 15px;"> <i class="fa fa-star"></i> Showing <?php echo $name . "'s"; ?> terminal report </h3>
                                    </div>

                                    <div class="card-body">
                                        <table id="teacher" class='table table-bordered table-striped'>
                                            <thead>
                                                <tr>
                                                    <th>Semester</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                <?php
                                                $row_count = $conn->rowCount();

                                                if ($row_count > 0) {


                                                ?>
                                                    <td>
                                                        <div class="col-md-3">
                                                            <form action="<?php echo $conn->student_url(); ?>generate-report" method='post' target="_blank">
                                                                <select name="exam" id="exam" class="form-control select2" required data-parsley-trigger="keyup" style="width: 100%;">
                                                                    <option value="">Select Exam</option>
                                                                    <?php
                                                                    // fetch all exam year/semester information
                                                                    $sql = "SELECT distinct semester FROM subjects order by semester aSC limit 8";
                                                                    $conn->query($sql);
                                                                    $rowcount = $conn->rowCount();

                                                                    if ($rowcount > 0) {
                                                                        $result = $conn->fetchMultiple();
                                                                        foreach ($result as $exam) {
                                                                    ?>
                                                                            <option value="<?php echo $exam->semester; ?>"><?php echo $exam->semester; ?></option>
                                                                    <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                                <!-- Add other input fields here if needed -->
                                                                <input type="hidden" name="name" value="<?php echo $name; ?>">
                                                                <input type="hidden" name="dept" value="<?php echo $dept; ?>">
                                                                <input type="hidden" name="session" value="<?php echo $session; ?>">
                                                                <input type="hidden" name="reg_no" value="<?php echo $reg_no; ?>">
                                                                <td>
                                                                 <input type="submit" name="generate-report" value="View Result" class="btn btn-success" title="View Result">
                                                                </td>                                                                
                                                            </form>
                                                        </div>
                                                    </td>

                                                <?php

                                                } else {

                                                ?>
                                                    <tr>
                                                        <td colspan="5" class="text-center"> <?php echo "No result found for user $name. Pls check back later." ?></td>
                                                    </tr>

                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>


                                    </div>
                                </div>
                            </section>
                        </div>

                    </div>

                </section>


            </div>

        </div>

        </div>

        <?php include '../admin/includes/footer.php'; ?>



        <script>
            $(document).ready(function() {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>




        <?php


        ?>


    <?php

} else {
    ?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <?php include '../admin/includes/style.php'; ?>
            <title>Login to continue | <?php echo $school_name; ?></title>
        </head>

        <body>

            <div class="container" style='margin-top: 20%;'>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="section-title text-center">
                            <h6>You need to login to continue. </h6>
                            <div class="spinner-border text-info" role='status'>
                                <span class='sr-only'>Loading....</span>
                                <meta htt-equiv='refresh' content='3; <?php $student_login_link; ?>'>
                                <p>Redireting to the login page ...</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </body>

        </html>

    <?php


}
    ?>