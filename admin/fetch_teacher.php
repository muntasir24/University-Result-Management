<?php
session_start();
include 'includes/database.php';
include 'includes/functions.php';
$conn= new Functions();

if(!empty($_POST['dept_name'])){
    $deptID = $_POST['dept_name'];

    //fetch teacher's data based on the specific dept
    $sql = "SELECT * FROM teachers WHERE dept_name = :d ";
    $conn->query($sql);
    $conn->bind(":d", $deptID);
    //generate HTML of teacher option
    if($conn->rowCount() > 0){
        $result = $conn->fetchMultiple();

        ?> <option value=''>Select Teacher</option><?php
        foreach ($result as $t) {
            
            ?> <option value="<?php echo $t->name; ?>"><?php echo $t->name; ?></option><?php
        }
    }else{
        echo "<option value=''>Section not found.</option>";
    }
}else{
    echo "<option value=''>error occurred.</option>";
}