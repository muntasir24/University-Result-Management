<?php
error_reporting(0);
session_start();
if($_SESSION['teacher']){
    header('location: index');
}

include "../admin/includes/database.php";
include "../admin/includes/functions.php";

$conn = new Functions();

//fetch school details

$sql = "SELECT * FROM general_settings";
$conn->query($sql);
$details = $conn->fetchSingle();
$logo = $details->logo;
$varsity_name = $details->varsity_name;
$main_url = 'http://localhost/resultapp';
$footer = $details->footer;
$teacher_login_bg = $school_details->teacher_login_bg;

if(empty($teacher_login_bg)){
    $login_bg = $main_url."/student/upload/logobg.png";
}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Teacher login </title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?php echo $main_url; ?>/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo $main_url; ?>/admin/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?php echo $main_url; ?>/admin/plugins/toastr/toastr.min.css">
    <link rel="icon" href="<?php echo $main_url; ?>/admin/upload/<?php echo $logo; ?>" type="image/png">

    <style>
        body{
            background-image: url(<?php echo $login_bg; ?>);
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            background-clip: border-box;
        }
        .btn-primary {
            color: #fff;
            background-color: #334722;
            border-color: #334722;
            box-shadow: none;
        }
        .btn-primary:hover {
            color: #fff;
            background-color: #517978;
            border-color: #517978;
        }
        .btn-primary.focus, .btn-primary:focus {
            color: #fff;
            background-color: #38582b;
            border-color: #38582b;
            box-shadow: 0 0 0 0 rgba(38,143,255,.5);
        }
        .card-primary.card-outline {
            border-top: 3px solid #b1793e;
        }
        .btn-primary:not(:disabled):not(.disabled):active{
            background-color: #38582b;
            border-color: #38582b;
        }

    </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <p>
                <i class="fas fa-lock fa-5x" style=" background: #1b2626; padding: 30px; border-radius: 40%; color: white;"></i>
            </p>
            <a href="index" class="h1" style="color: #1b2626;"><b>Welcome</b></a>
        </div>


        <div class="card-body">
            <p class="login-box-msg"> Please sign in to start your session</p>

            <form action="" method="post" id="login_form">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Username" name="username">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="password" name="password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block" style="background-color: #382521; border-color: #382521;">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>

            </form>

            <div id="msg"></div>

            

        </div>

    </div>
</div> <!-- Login Box-->



<!-- jQuery -->
<script src="<?php echo $main_url; ?>/admin/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap 4 -->
<script src="<?php echo $main_url; ?>/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $main_url; ?>/admin/dist/js/adminlte.js"></script>
<script src="<?php echo $main_url; ?>/admin/plugins/toastr/toastr.min.js"></script>

<script>
    $(document).ready(function(){
        $('#login_form').on('submit', function (e){
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: "post",
                url: "process-login.php",
                data: formData,
                success: function (response){
                    $('#msg').html(response);
                }
            })
        })
    })
</script>
</body>
</html>
