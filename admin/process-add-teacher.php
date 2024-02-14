<?php
include 'includes/database.php';
include 'includes/functions.php';
$conn= new Functions();

if(!empty($_POST['name']) && !empty($_POST['dept_name'])
&& !empty($_POST['username']) && !empty($_POST['password']) ){
$name = $_POST['name'];
$dept_name = $_POST['dept_name'];
$username = ($_POST['username']);
$password = ($_POST['password']);





//name validation
$sql = "SELECT * FROM teachers WHERE name =:name";
$conn->query($sql);
$conn->bind(":name", $name);
if($conn->rowCount() > 0){
echo "<p class='alert alert-danger alert-dismissible fade show' role='alert'>
    <i class='fas fa-ban'></i>Teacher name already exists.
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">×</span>
    </button>
</p>";
return false;
} 
//check for username availability
$sql = "SELECT * FROM teachers WHERE username =:username";
$conn->query($sql);
$conn->bind(":username", $username);
if($conn->rowCount() > 0){
echo "<p class='alert alert-danger alert-dismissible fade show' role='alert'>
    <i class='fas fa-ban'></i> Username already exists.
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">×</span>
    </button>
</p>";
return false;
}else {

//process  inserting of data into database
$hashed_password = $conn->Password_Encryption($password);
$sql = "INSERT INTO teachers (name, dept_name, username, password)
VALUES(:name, :dept_name, :username, :password)";
$conn->query($sql);
$conn->bind(":name", $name);
$conn->bind(":dept_name", $dept_name);
$conn->bind(":username", $username);
$conn->bind(":password", $hashed_password);
        try {

            $conn->execute();
            $send=1;
        } catch (PDOException $err) {
            $send=0;
            echo "Wrong Department name or Department name must exist";
        }


if ($send) {
echo "<p class='alert alert-success alert-dismissible fade show' role='alert'>
    <i class='fas fa-check-circle'></i> Teacher $name was added successfully.
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">×</span>
    </button>
    <meta http-equiv='refresh' content='1; teacher'>
</p>";
} else {
echo "<p class='alert alert-danger alert-dismissible fade show' role='alert'>
    <i class='fas fa-ban'></i> An error occurred while adding data.Maybe Department not addet yet
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">×</span>
    </button>
    <meta http-equiv='refresh' content='4; teacher'>
</p>";
}
}
}else{
echo "<p class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
    <i class='fas fa-ban'></i>
    Fields marked (*) are required.
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>×</span>
    </button>
</p>";
}



