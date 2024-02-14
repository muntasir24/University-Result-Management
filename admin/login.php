<?php
session_start();
include 'includes/database.php';
include 'includes/functions.php';

$conn = new Functions();

//fetch varsity details from database
$sql = "SELECT * FROM general_settings";
$conn->query($sql);
$result = $conn->fetchSingle();
$admin_login_bg = $result->admin_login_bg;
$base_url = $conn->base_url();

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login | <?php echo $result->varsity_name; ?></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>plugins/toastr/toastr.min.css">
    <link rel="icon" href="<?php echo $base_url; ?>upload/<?php echo $result->logo; ?>" type="image/png" sizes="320x32">
    <!--    <link rel="stylesheet" href="">logo-->

    <style>
        body {
            background-image: url('<?php echo $base_url . "upload/" . $admin_login_bg ?>');
            background-position: center;
            -webkit-background-size: black;
            background-size: 50%;
            background-repeat: no-repeat;
            -webkit-background-clip: border-box;
            -moz-background-clip: border-box;
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

        .btn-primary.focus,
        .btn-primary:focus {
            color: #fff;
            background-color: #38582b;
            border-color: #38582b;
            box-shadow: 0 0 0 0 rgba(38, 143, 255, .5);
        }

        .card-primary.card-outline {
            border-top: 3px solid #b1793e;
        }

        .btn-primary:not(:disabled):not(.disabled):active {
            background-color: #38582b;
            border-color: #38582b;
        }

        body {
            background-color: #f8f9fa;
        }

        .login-box {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            width: 400px;
            border: none;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            text-align: center;
            background-color: rgba(255, 255, 255, 0.9);
            /* White background with opacity */
            border-radius: 20px;
            padding: 20px;
        }

        .form-control {
            border-radius: 20px;
            margin-bottom: 15px;
        }

        .btn-primary {
            background-color: #382521;
            border-color: #382521;
            border-radius: 20px;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #517978;
            border-color: #517978;
        }

        .footer-link {
            color: #374923;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card">
            <div class="card-body login-card-body">
                <h4 class="mb-4">Sign in to Your Account</h4>
                <form action="" method="post" id="login_form">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="username" name="username" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group">
                        <input type="password" class="form-control" placeholder="password" name="password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>

                <p class="mt-3">
                    <a href="<?php echo "https://www.shu.edu.bd/"; ?>" class="footer-link">Back to Home</a>
                </p>
                <div id="msg"></div>
            </div>
        </div>
    </div>>

    <script src="<?php echo $base_url; ?>plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo $base_url; ?>plugins/toastr/toastr.min.js"></script>
    <script src="<?php echo $base_url; ?>dist/js/adminlte.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo $base_url; ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script>
        $(function() {
            $('#login_form').on('submit', function(event) {
                event.preventDefault();
                let formData = $(this).serialize();
                $.ajax({
                    type: "POST",
                    url: "<?php echo $base_url; ?>process-login.php",
                    data: formData,
                    beforeSend: function() {
                        $('#msg').html("Signing In..... Please wait.");
                    },
                    success: function(response) {
                        $('#msg').html(response);
                    }
                })
            })
        })
    </script>

</body>

</html>