<?php

include('includes/database.php');
include('includes/functions.php');

$conn = new Functions();

if(!empty($_POST['name'])){
    $name = $_POST['name'];
    
    $phone_no = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $footer = $_POST['footer'];
   
  
    $settings_id = $_POST['settings_id'];
    $main_url = 'http://localhost/resultapp';
   

    //perform validations

    $sql = "SELECT * FROM general_settings WHERE varsity_name =:varsityname AND varsity_name != '' AND id !=:settings_id";
    $conn->query($sql);
    $conn->bind(":varsityname", $name);
    $conn->bind(":settings_id", $settings_id);
    if($conn->rowCount() > 0){
        echo "<script>
                toastr['error']('Name of school already exists.');
             </script>";
        return false;
    }

    $sql = "SELECT * FROM general_settings WHERE phone_no =:phoneno AND phone_no != ''  AND id !=:settings_id";
    $conn->query($sql);
    $conn->bind(":phoneno", $phone_no);
    $conn->bind(":settings_id", $settings_id);
    if($conn->rowCount() > 0){
        echo "<script>
              toastr['error']('Phone number already exists.');
             </script>";
        return false;
    }

    //check if email already exists
    $sql = "SELECT * FROM general_settings WHERE email =:email AND email != '' AND id !=:settings_id";
    $conn->query($sql);
    $conn->bind(":email", $email);
    $conn->bind(":settings_id", $settings_id);
    if($conn->rowCount() > 0){
        echo "<script>
              toastr['error']('Administrative email already exists.');
             </script>";
        return false;
    }else{

        //process  updating of data into database
        $sql = "UPDATE general_settings SET varsity_name =:varsityname,  phone_no =:phoneno, email =:email,
               address =:address, footer =:footer,  
              main_url =:main_url";
        $conn->query($sql);
        $conn->bind(":varsityname", ucwords($name));
 
        $conn->bind(":phoneno", $phone_no);
        $conn->bind(":email", $email);
        $conn->bind(":main_url", $main_url);
     
        $conn->bind(":address", $address);
        $conn->bind(":footer", $footer);

        $send = $conn->execute();
        if ($send) {
            echo "<script>
                 toastr['success']('Settings have been updated successfully.');
             </script><meta http-equiv='refresh' content='2; settings'>";

        } else {
            echo "<script>
                toastr['error']('An error occurred while updating data');
             </script><meta http-equiv='refresh' content='2; settings'>";
        }



    }


}else{
    echo "<script>
                toastr['error']('All fields are required.');
             </script>";
}