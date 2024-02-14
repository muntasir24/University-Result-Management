<?php
session_start();
include "../admin/includes/database.php";
include "../admin/includes/functions.php";

$conn= new Functions();
$redirect = $conn->student_url();
if(!empty($_POST['old_password']) && !empty($_POST['new_password'])){

    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $student = $_POST['reg_no'];

    $sql ="SELECT * FROM student WHERE reg_no =:student";
    $conn->query($sql);
    $conn->bind(":student", $student);
    $result = $conn->fetchSingle();
    $db_password = $result->password;
    $existing_password = $conn->password_check($old_password, $db_password);


    //check if entered password matches with db
    if(!$existing_password){
        echo "<script>
               toastr['error']('Old password is wrong');
           </script>";
    }else{
        //all checks passed, update users password
        $sql = "UPDATE student SET password =:password WHERE reg_no=:student";
        $conn->query($sql);
        $conn->bind(":password", $conn->Password_Encryption($new_password));
        $conn->bind(":student", $student);

        try{
            //execute
            $conn->execute();
            echo "<script>
              toastr['success']('Password Updated Successfully. Redirecting to Account Dashboard...');
        </script> <meta http-equiv='refresh' content='3; $redirect'>";

        }catch (PDOException $err){
            $error= $err->getMessage();
            echo "<script>
               toastr['error']('An error occurred $error');
           </script>";
        }

    }

}else{
    echo "<script>
              toastr['error']('Both fields are required.');
        </script>";
}
