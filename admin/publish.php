<?php
session_start();


include 'includes/database.php';
include 'includes/functions.php';
$conn = new Functions();


$dept = $_POST['dept'];
$exam = $_POST['exam'];
$session = $_POST['session'];

 $exam = str_replace('-', ' ', $exam);
$flag=1;
$sql = "INSERT INTO publish (is_published, session, semester, dept_name) VALUES (:i, :ss, :s, :d)";
$conn->query($sql);
$conn->bind(":d", $dept);
$conn->bind(":ss", $session);
$conn->bind(":s", $exam);
$conn->bind(":i", $flag);
$conn->execute();


