<?php
include 'includes/database.php';
include 'includes/functions.php';
$conn= new Functions();

$name = $_POST['name'];
$dept = $_POST['class'];
$photo_name = $_FILES['photo']['name'];
$photo_tmpname = $_FILES['photo']['tmp_name'];
$photo_size = $_FILES['photo']['size'];
$username= ($_POST['username']);
$password = ($_POST['password']);



$photofilenameAr = explode('.', $photo_name);
$photo_extension = end($photofilenameAr);
$photo_ext = strtolower($photo_extension);

//check if image was selected
if(!empty($photo_name)) {
if ($photo_size > 2000000) {
echo "<p class='alert alert-danger alert-dismissible fade show' role='alert'>
    <i class='fas fa-ban'></i>  Photo size exceeded. Max size is 2MB.
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">×</span>
    </button>
</p>";
}
if ($photo_ext == 'png' || $photo_ext == 'jpg' || $photo_ext == 'jpeg' || $photo_ext == 'svg') {
$strgPath = "upload/" . $photo_name;
if (file_exists($strgPath)) {
echo "<p class='alert alert-danger alert-dismissible fade show' role='alert'>
    <i class='fas fa-ban'></i>  Photo with the same name already exists.
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">×</span>
    </button>
</p>";
} else {
$photo_upload = move_uploaded_file($photo_tmpname, $strgPath);
}
} else {
echo "<p class='alert alert-danger alert-dismissible fade show' role='alert'>
    <i class='fas fa-ban'></i> Only png, jpg, jpeg or svg formats are allowed. Photo did not upload.
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">×</span>
    </button>
</p>";

}
}

//perform validations for email
//check for email availability
$sql = "SELECT * FROM student WHERE reg_no =:username AND reg_no !=''";
$conn->query($sql);
$conn->bind(":username", $username);
if($conn->rowCount() > 0){
echo "<p class='alert alert-danger alert-dismissible fade show' role='alert'>
    <i class='fas fa-ban'></i> Registraton number already exists.
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">×</span>
    </button>
</p>";
return false;
}

else {

//process  inserting of data into database
$hashed_password = $conn->Password_Encryption($password);
    $sql = "INSERT INTO student (reg_no	,name ,password	,photo ,dept_name) 
          VALUES(:reg, :name  , :password, :photo, :dept )";
$conn->query($sql);
$conn->query($sql);
$conn->bind(":name", $name);
$conn->bind(":reg", $username);
$conn->bind(":dept", $dept);
$conn->bind(":photo", $photo_name);
$conn->bind(":password", $hashed_password);


$send = $conn->execute();
if ($send) {
    $redirect = $conn->base_url().'student';
echo "<p class='alert alert-success alert-dismissible fade show' role='alert'>
    <i class='fas fa-check-circle'></i> Student $name was added successfully.
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




