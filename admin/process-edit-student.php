<?php
session_start();
include 'includes/database.php';
include 'includes/functions.php';

$conn = new Functions();

$name = $_POST['name'];
$sessionNEW = $_POST['session'];
$dept = $_POST['dept'];
$reg = $_POST['reg_no'];

// process student data updating
$sql = "UPDATE student SET name=:name, session=:sessionNEW, dept_name=:dept,  reg_no=:reg WHERE reg_no=:reg";
$conn->query($sql);
$conn->bind(":name", $name);
$conn->bind(":sessionNEW", $sessionNEW);
$conn->bind(":dept", $dept);
$conn->bind(":reg", $reg);

$send = $conn->execute();

if ($send) {
    echo "<p class='alert alert-success alert-dismissible fade show' role='alert'>
            <i class='fas fa-check-circle'></i> Student $name was updated successfully.
          <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                     <span aria-hidden=\"true\">×</span>
          </button>
          <meta http-equiv='refresh' content='3; student'>
   </p>";
} else {
    echo "<p class='alert alert-danger alert-dismissible fade show' role='alert'>
            <i class='fas fa-ban'></i> An error occurred while updating data.
          <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                     <span aria-hidden=\"true\">×</span>
          </button>
          <meta http-equiv='refresh' content='4; student'>
   </p>";
}
