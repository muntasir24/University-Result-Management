<?php
session_start();

include "../admin/includes/database.php";
include "../admin/includes/functions.php";

$login = new Functions();
if(!empty($_POST['reg_no']) && !empty($_POST['password'])){
    $reg_no = $_POST['reg_no'];
    $password = ($_POST['password']);
if(!$login->studentLoginCheck($reg_no, $password)){
    echo "<script>
              toastr['error']('Wrong registration num or password.');
        </script>";
}else{
    //process login
    //$status = 'on';
    $sql = "SELECT * FROM student WHERE reg_no =:r";
    $login->query($sql);
    $login->bind(":r", $_POST['reg_no']);
    //$login->bind(":on", $status);

    try{
        $result = $login->fetchSingle();
        $reg_no = $result->reg_no;
        $_SESSION['student'] = $reg_no;
        echo "<script>
              toastr['success']('Login Successful. Redirecting to Account Dashboard...');
        </script> <meta http-equiv='refresh' content='1; index'>";

        echo  "<div class='text-center'>
                <div class='spinner-border text-info' role='status'>
                    <span class='sr-only'> Working...</span>
                </div>
                </div>";

    }catch (PDOException $err){
        $error = $err->getMessage();
        echo "<script>
              toastr['error'](' An internal error occurred $error');
        </script>";
    }



}



}else{

    echo "<script>
              toastr['error']('Both fields are required.');
        </script>";
}



