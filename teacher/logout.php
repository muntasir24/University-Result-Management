<?php
session_start();
//echo $_SESSION['teacher'];
?>


<?php include '../admin/includes/styles.php'; ?>
<?php
$conn = new Functions();
$redirect = $main_url . "/teacher/login";
?>
<title>Logout | <?php echo $varsity_name; ?></title>

<?php
session_destroy();
echo '<h6>Logout Successful</h6>';
?>
<meta http-equiv='refresh' content='1; <?php echo $redirect; ?>'>
<p>Redirecting to the login page...</p>