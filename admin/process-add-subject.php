<?php
include 'includes/database.php';
include 'includes/functions.php';
$conn = new Functions();


    $subject_code = $_POST['subject_code'];
  
    $subject_name = $_POST['subject_name'];
    $credit = $_POST['credit'];

    $teacher_name = $_POST['teacher_name'];
    $dept_id = $_POST['dept_name'];

    $sql = "SELECT dept_name FROM department WHERE dept_name =:dept_name";
    $conn->query($sql);
    $conn->bind(":dept_name", $dept_id);
    $className = $conn->fetchColumn();



    //perform validations for email
    //check for email availability
    $sql = "SELECT * FROM subjects WHERE subject_code =:subject_code";
    $conn->query($sql);
    $conn->bind(":subject_code", $subject_code);
    if ($conn->rowCount() > 0) {
        echo "<p class='alert alert-danger alert-dismissible fade show' role='alert'>
    <i class='fas fa-ban'></i> Subject code $subject_code already exists in the system.
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">×</span>
    </button>
</p>";
        return false;
    }
    else {
        //process  inserting of data into database
        $sql = "INSERT INTO subjects(subject_code,	subject_name,	dept_name,	t_name,	credit)	

        VALUES (:subject_code, :subject_name, :dept_id, :teacher_name, :credit)";
        $conn->query($sql);
        $conn->bind(":subject_code", $subject_code);
     
        $conn->bind(":teacher_name", $teacher_name);
        $conn->bind(":credit", $credit);       
        $conn->bind(":subject_name", $subject_name);
        
        $conn->bind(":dept_id", $dept_id);    // ekhane always variable and varibale boshbe

        $send = $conn->execute();
        $redirect = $conn->base_url() . 'subject';
        if ($send) {
            echo "<p class='alert alert-success alert-dismissible fade show' role='alert'>
                    <i class='fas fa-check-circle'></i> Subject $subject_name was added successfully.
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                             <span aria-hidden=\"true\">×</span>
                  </button>
                  <meta http-equiv='refresh' content='3; $redirect'>
           </p>";
        } else {
            echo "<p class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <i class='fas fa-ban'></i> An error occurred while adding data.
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                             <span aria-hidden=\"true\">×</span>
                  </button>
                  <meta http-equiv='refresh' content='4; $redirect'>
           </p>";
        }
    }
