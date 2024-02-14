<?php
session_start();
$main_url = 'http://localhost/resultapp/student/login.php';
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0 shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php
    $redirect = $base_url."login";
    ?>
    <title>Logout</title>
    <?php include '../admin/includes/styles.php'; ?>
</head>

<body>

    <div class="container" style="margin-top: 20%;">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="section-title text-center">
                    <?php session_destroy(); ?>
                    <h6> Logout Successful </h6>
                    <div class="spinner-border text-info" role="status">
                        <span class="sr-only">Loading...</span>
                        <meta http-equiv='refresh' content='1; <?php echo $redirect; ?>'>
                    </div>
                    <p>Redirecting to the login page...</p>
                </div>
            </div>
        </div>


    </div>

</body>

</html>