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
        <title> Add a mark | <?php echo $varsity_name; ?></title>
        <style>
            /*.parsley-required, .parsley-pattern {*/
            /*    position: relative !important;*/
            /*    top: 10px !important;*/
            /*    left: 245px !important;*/
            /*    width: 200px !important;*/
            /*    list-style-type: none !important;*/
            /*}*/

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
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">Add a mark </h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?php echo $conn->base_url(); ?>">Home</a></li>
                                    <li class="breadcrumb-item active">Add a mark</li>
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
                            <div class="col-lg-12">

                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title"> <i class="fa fa-flask"></i> Mark</h3>
                                    </div>

                                    <form action="" class="form-horizontal" method="post" id="mark-add">
                                        <div class="card-body">
                                            <div class="form-row">
                                                <div class="col-md-3">
                                                    <label for="dept"> Department <span class="text-danger">*</span></label>
                                                    <select name="dept" id="dept" class="form-control select2 myclass" data-parsley-trigger="keyup" style="width: 100%;" required>
                                                        <option value="">Select Department</option>
                                                        <?php

                                                        $sql = "SELECT * FROM department";
                                                        $conn->query($sql);
                                                        $rowcount = $conn->rowCount();

                                                        if ($rowcount > 0) {
                                                            $result = $conn->fetchMultiple();
                                                            foreach ($result as $dept) {
                                                        ?> <option value="<?php echo $dept->dept_name; ?>"><?php echo $dept->dept_name; ?></option><?php
                                                                                                                                                }
                                                                                                                                            }

                                                                                                                                                    ?>

                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="session"> Session <span class="text-danger">*</span></label>
                                                    <select name="session" id="session" class="form-control select2" required data-parsley-trigger="keyup" style="width: 100%;">
                                                        <option value="">Select Session</option>


                                                        <?php

                                                        $sql = "SELECT distinct session FROM session ORDER BY session DESC  limit 4 ";
                                                        $conn->query($sql);
                                                        $rowcount = $conn->rowCount();

                                                        if ($rowcount > 0) {
                                                            $result = $conn->fetchMultiple();
                                                            foreach ($result as $s) {
                                                        ?> <option value="<?php echo $s->session; ?>"><?php echo $s->session; ?></option><?php
                                                                                                                                        }
                                                                                                                                    }

                                                                                                                                            ?>




                                                    </select>

                                                </div>

                                                <div class="col-md-3">
                                                    <label for="exam"> Exam <span class="text-danger">*</span></label>
                                                    <select name="exam" id="exam" class="form-control select2" required data-parsley-trigger="keyup" style="width: 100%;">
                                                        <option value="">Select Exam</option>
                                                        <?php
                                                        //fetch all exam year/semester information
                                                        $sql = "SELECT distinct semester FROM subjects order by semester aSC limit 8";
                                                        $conn->query($sql);
                                                        $rowcount = $conn->rowCount();

                                                        if ($rowcount > 0) {
                                                            $result = $conn->fetchMultiple();
                                                            foreach ($result as $exam) {
                                                        ?> <option value="<?php echo $exam->semester; ?>"><?php echo $exam->semester; ?></option><?php
                                                                                                                                                }
                                                                                                                                            }

                                                                                                                                                    ?>

                                                    </select>
                                                </div>



                                                <div class="col-md-3">
                                                    <label for="subject"> Subject <span class="text-danger">*</span></label>
                                                    <select name="subject" id="subject" class="form-control select2" required data-parsley-trigger="keyup" style="width: 100%;">
                                                        <option value="">Select Subject</option>


                                                    </select>
                                                </div>

                                                <input type="hidden" name="exam_year" value="<?php echo date('Y'); ?>">

                                                <div class="col-md-3" style="margin-top: 20px;">
                                                    <input type="submit" value="Mark" class="btn btn-success" id="mark">
                                                </div>

                                            </div>

                                        </div>


                                        <div id="success-msg">
                                        </div>

                                    </form>

                                </div>



                            </div>

                            <!-- display mark details here... -->
                            <div class="col-lg-12">
                                <div class="card card-info" id="display-details">

                                </div>
                            </div>






                        </div>



                    </div><!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <?php include 'includes/footer.php'; ?>
        <!-- Add logo  Modal start -->


        <script>
            $(function() {
                // Change event for department
                $('#dept').on('change', function() {
                    var dept = $(this).val();

                    // After getting the department value, get the selected exam value
                    var exam = $('#exam').val();

                    // Make an AJAX request to fetch subjects based on department and exam
                    $.ajax({
                        type: "POST",
                        url: "fetch_subject.php",
                        data: {
                            dept: dept,
                            exam: exam
                        },
                        success: function(html) {
                            $('#subject').html(html);
                        }
                    });
                });

                // Change event for exam
                $('#exam').on('change', function() {
                    // Get the selected exam value
                    var exam = $(this).val();

                    // After getting the exam value, get the selected department value
                    var dept = $('#dept').val();

                    // Make an AJAX request to fetch subjects based on department and exam
                    $.ajax({
                        type: "POST",
                        url: "fetch_subject.php",
                        data: {
                            dept: dept,
                            exam: exam
                        },
                        success: function(html) {
                            $('#subject').html(html);
                        }
                    });
                });
            });
        </script>



        <script>
            $('#mark-add').parsley();
            $('#mark-add').on('submit', function(event) {
                event.preventDefault();
                if ($('#mark-add').parsley().isValid()) {
                    $.ajax({
                        url: "<?php echo $base_url; ?>fetch-mark-details.php",
                        method: "POST",
                        data: new FormData(this),
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            $('#mark').attr('disabled', 'disabled');
                            $('#mark').val('Fetching details, pls wait ......');

                        },
                        success: function(data) {
                            $('#mark-add').parsley().reset();
                            $('#mark').attr('disabled', false);
                            $('#mark').val('Mark');
                            $('#display-details').html(data);
                        }
                    })
                }

            })
        </script>


        <!-- start -->
        <?php

        if (isset($_POST['submit_result'])) {
            $student_dept = $_POST['dept'];
            $attendence= $_POST['attendence']; // $student_first_ca_score 
            $mid = $_POST['mid'];             //  $student_second_ca_score
            $final = $_POST['final'];         // $student_exam_score  
             $session = $_POST['session'];
            $subject = $_POST['subject'];
            $reg_no = $_POST['reg_no'];
           // $score_id = $_POST['score_id'];
        

            $success_msg1 = '';
        

            foreach ($student_dept as $index => $result_details) {
                //check if details already exists in the results table
                $sql = "SELECT * FROM result WHERE reg_no =:r AND subject_code =:s AND dept_name =:d AND session =:ss";
                $conn->query($sql);
                $conn->bind(":r", $reg_no[$index]);
                $conn->bind(":s", $subject[$index]);
                $conn->bind(":d", $student_dept[$index]);
                $conn->bind(":ss", $session[$index]);
                $rowcount = $conn->rowCount();

                if ($rowcount > 0) {
                    $db_result = $conn->fetchSingle();

                    //update records

                    $sql = "UPDATE result SET reg_no =:r, dept_name =:d, session=:ss, subject_code =:s, attendence =:atd, mid=:mid, 
                    final=:f  WHERE reg_no =:r and dept_name =:d and session=:ss and subject_code =:s";
                    $conn->query($sql);
                    $conn->bind(":r", $reg_no[$index]);
                    $conn->bind(":d", $student_dept[$index]);
                    $conn->bind(":ss", $session[$index]);
                    $conn->bind(":s", $subject[$index]);
                    $conn->bind(":atd", $attendence[$index]);
                    $conn->bind(":mid", $mid[$index]);
                    $conn->bind(":f", $final[$index]);
                  

                    try {
                        $conn->execute();
                        $success_msg1 = "<script>
                            toastr['success']('Exam details updated successfully.');
                       </script>";
                    } catch (PDOException $err) {
                        $error = $err->getMessage();
                        $success_msg1 = "<script>
                            toastr['error']('$error');
                       </script>";
                    }
                } else {

                    //no records found, insert records afresh to db
                    $sql = "INSERT INTO result(reg_no, dept_name,session, subject_code, attendence, mid,final)
                        VALUES(:r, :d, :ss, :sc, :a, :m, :f)";
                    $conn->query($sql);
                    $conn->bind(":r", $reg_no[$index]);
                    $conn->bind(":d", $student_dept[$index]);
                    $conn->bind(":sc", $subject[$index]);
                    $conn->bind(":ss", $session[$index]);
                    $conn->bind(":a", $attendence[$index]);
                    $conn->bind(":m", $mid[$index]);
                    $conn->bind(":f", $final[$index]);

                    try {
                        $conn->execute();
                        $success_msg1 = "<script>
                         toastr['success']('Exam details added successfully.');
                         </script>";
                    } catch (PDOException $err) {
                        $error = $err->getMessage();
                        $success_msg1 =  "<script>
                         toastr['error']('$error');
                         </script>";
                    }

                    
                }

         

              

                
            }

            //echo success msg variable

            echo $success_msg1;
            
        }
        ?>









        <!-- end -->



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