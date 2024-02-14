<?php

$sql = "SELECT * FROM student WHERE reg_no = :r";
$conn->query($sql);
$conn->bind(":r", $_SESSION['student']);
$query = $conn->rowCount();
if ($query) {
    $result = $conn->fetchSingle();
    $name = $result->name;
}

?>


