<?php
include 'includes/database.php';
include 'includes/functions.php';
$conn = new Functions();


    $session = $_POST['name'];
  
    $dept_name = $_POST['class'];


    //fetch name of department
    $sql = "SELECT dept_name FROM department WHERE dept_name=:dept_name";
    $conn->query($sql);
    $conn->bind(":dept_name", $dept_name);
    $className = $conn->fetchColumn();

    //perform validations for email
    //check for email availability
    $sql = "SELECT * FROM session WHERE session =:session AND dept_name =:dept_name";
    $conn->query($sql);
    $conn->bind(":session", $session);
    $conn->bind(":dept_name", $dept_name);
    if ($conn->rowCount() > 0) {
        echo "<p class='alert alert-danger alert-dismissible fade show' role='alert'>
    <i class='fas fa-ban'></i> Section name already exists for  $className
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">×</span>
    </button>
</p>";
        return false;
    } else {
    //process  inserting of data into database
    $sql = "INSERT INTO session (session,dept_name) 
        VALUES (:session,:dept_name)";
    $conn->query($sql);
    $conn->bind(":session", $session);
    $conn->bind(":dept_name", $dept_name);
 

    $send = $conn->execute();
    $redirect = $conn->base_url() . 'session';
    if ($send) {
        echo "<p class='alert alert-success alert-dismissible fade show' role='alert'>
                    <i class='fas fa-check-circle'></i> Section was added successfully.
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                             <span aria-hidden=\"true\">×</span>
                  </button>
                  <meta http-equiv='refresh' content='2; $redirect'>
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
