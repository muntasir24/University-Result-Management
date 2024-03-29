<?php
session_start();

include "../admin/includes/database.php";
include "../admin/includes/functions.php";

$login = new Functions();
if(!empty($_POST['username']) && !empty($_POST['password'])){
    $username = $_POST['username'];
    $password = ($_POST['password']);
    if(!$login->teacherLoginCheck($username, $password)){
        echo "<script>
              toastr['error']('Double check your details.');
        </script>";
    }else{
        //process login
      
        $sql = "SELECT * FROM teachers WHERE username =:username ";
        $login->query($sql);
        $login->bind(":username", $_POST['username']);

        try{
            $result = $login->fetchSingle();
            $username = $result->username;
            $_SESSION['teacher'] = $username;
            echo "<script>
              toastr['success']('Login Successful. Redirecting to Account Dashboard...');
        </script> <meta http-equiv='refresh' content='3; index'>";

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



