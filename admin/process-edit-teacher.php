<?php
include 'includes/database.php';
include 'includes/functions.php';
$conn = new Functions();

if (
    !empty($_POST['name']) && !empty($_POST['dept_name']) && !empty($_POST['username']) 
) {
    $name = $_POST['name'];
    $dept_name= $_POST['dept_name'];
   
    $username = ($_POST['username']);
    

    //process  inserting of data into database
    $sql = "UPDATE teachers SET name=:name, dept_name=:dept_name, username=:username
         WHERE username =:username";
    $conn->query($sql);
    $conn->bind(":name", $name);
    $conn->bind(":dept_name", $dept_name);
    
    $conn->bind(":username", $username);
 

    $send = $conn->execute();
    if ($send) {
        echo "<p class='alert alert-success alert-dismissible fade show' role='alert'>
    <i class='fas fa-check-circle'></i> Teacher $name was updated successfully.
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">×</span>
    </button>
    <meta http-equiv='refresh' content='1; '>
</p>";
    } else {
        echo "<p class='alert alert-danger alert-dismissible fade show' role='alert'>
    <i class='fas fa-ban'></i> An error occurred while updating data.
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">×</span>
    </button>
    <meta http-equiv='refresh' content='4; teacher'>
</p>";
    }
} else {
    echo "<p class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
    <i class='fas fa-ban'></i>
    Fields marked (*) are required.
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>×</span>
    </button>
</p>";
}
