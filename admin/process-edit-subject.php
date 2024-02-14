<?php
include 'includes/database.php';
include 'includes/functions.php';
$conn= new Functions();


$subject_name = $_POST['subject_name'];

$teacher_name = $_POST['teacher_name'];
$subject_id = $_POST['subject_id'];  //actually getting the subject code!  // echo $subject_id, $subject_name,$teacher_name;



        //process  inserting of data into database
        $sql = "UPDATE subjects SET  t_name =:tname, subject_name =:subject_name, subject_code =:s WHERE subject_code =:s";
        $conn->query($sql);
       
        $conn->bind(":tname", $teacher_name);
        $conn->bind(":subject_name", $subject_name);
        $conn->bind(":s", $subject_id);

        $send = $conn->execute();
        if ($send) {
            $redirect = $conn->base_url().'subject';
            echo "<p class='alert alert-success alert-dismissible fade show' role='alert'>
            <i class='fas fa-check-circle'></i> Subject was updated successfully.
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">×</span>
            </button>
            <meta http-equiv='refresh' content='3; $redirect'>
        </p>";
        }else {
            echo "<p class='alert alert-danger alert-dismissible fade show' role='alert'>
            <i class='fas fa-ban'></i> An error occurred while updating data.
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">×</span>
            </button>
            <meta http-equiv='refresh' content='4; $redirect'>
        </p>";
        }
 




