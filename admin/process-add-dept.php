<?php
include 'includes/database.php';
include 'includes/functions.php';
$conn = new Functions();


    $name = $_POST['name'];
    $teacher_name = $_POST['teacher_name'];

    $sql = "SELECT * FROM department WHERE dept_name =:name";
    $conn->query($sql);
    $conn->bind(":name", $name);   //same as variable
  
    if ($conn->rowCount() > 0) {
        echo "<p class='alert alert-danger alert-dismissible fade show' role='alert'>
    <i class='fas fa-ban'></i> Department Chairman already exits.
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">×</span>
    </button>
</p>";
        return false;
    }
   else {

//process  inserting of data into database
$sql = "INSERT INTO department (dept_name, chairman_name) 
        VALUES (:name, :teacher_name)";
$conn->query($sql);
$conn->bind(":name", $name);

$conn->bind(":teacher_name", $teacher_name);

$send = $conn->execute();
$redirect = $conn->base_url().'dept';
if($send){
    echo "<p class='alert alert-success alert-dismissible fade show' role='alert'>
                    <i class='fas fa-check-circle'></i> Department was added successfully.
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                             <span aria-hidden=\"true\">×</span>
                  </button>
                  <meta http-equiv='refresh' content='3; $redirect'>
           </p>";
}else{
    echo "<p class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <i class='fas fa-ban'></i> An error occurred while adding data.
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                             <span aria-hidden=\"true\">×</span>
                  </button>
                  <meta http-equiv='refresh' content='4; $redirect'>
           </p>";
}

}