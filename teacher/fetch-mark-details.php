<?php
session_start();
error_reporting(0);

include '../admin/includes/database.php';
include '../admin/includes/functions.php';
$conn= new Functions();
$output = '';


$dept = $_POST['dept'];
$exam = $_POST['exam'];
$session = $_POST['session'];
$subject = $_POST['subject'];





$sql = "SELECT subject_name FROM subjects WHERE subject_code = :sbj";  //subject code passing and getting the subject
$conn->query($sql);
$conn->bind(":sbj", $subject);
$db_subject = $conn->fetchColumn();




$count = 1;
//fetch students names based on the selected department and session
$sql = "SELECT * from student WHERE dept_name = :dpt AND session =:ss order by reg_no ASC";
$conn->query($sql);
$conn->bind(":dpt", $dept);
$conn->bind(":ss", $session);
$rowCount = $conn->rowCount();
if ($rowCount > 0) {
    $result = $conn->fetchMultiple();
    $output = "<div class='card-body'>";
    $output .= "<div class='col-md-12 jumbotron'>
               <h3 class='text-center'>Mark Details</h3>
               <div class='text-center'>
                 <span class='text-center' style='display: inline-block;'>Class: <span>$dept</span></span><br>
                 <span class='text-center' style='display: inline-block;'>Examination: <span>$exam</span></span><br>
                 <span class='text-center' style='display: inline-block;'>Section: <span>$session</span></span><br>
                 <span class='text-center' style='display: inline-block;'>Subject: <span>$db_subject</span></span>
                  </div>
         
         </div>";

    $output .= "<form method='post' action='' id='add-exam-scores'>";
    $output .= "<div class='table-responsive'>";
    $output .= "<table class='table table-bordered table-hover table-stripped' id='teacher'>
                        <thead>
                        <th>#</th>
                      
                        <th>Name</th>
                        <th>Reg No</th>
                        <th>Attendence</th>
                        <th>Mid marks</th>
                        <th>Final</th>
                    </thead>";
    $output .= "<tbody>";
    foreach ($result as $student) {
        //fetch exam and test scores from database if it exists

        $sql = "SELECT * FROM result WHERE reg_no = :r AND subject_code=:sc AND dept_name=:d AND session =:ss";
        $conn->query($sql);
        $conn->bind(":r", $student->reg_no);
        $conn->bind(":sc", $subject);
        $conn->bind(":ss", $session);
        $conn->bind(":d", $dept);

        $details = $conn->fetchSingle();

        $existing_attendence_score = $details->attendence;
        $existing_mid_score = $details->mid;
        $existing_final_score = $details->final;
        // $score_id = $details->id;

        //second rowcount if statement


        $reg_no = $student->reg_no;
        $output .= "<tr>
                     <td>$count</td>                   
                     <td><input type='hidden' name='student_name[]' value='$student->name'>$student->name</td>
                     <td><input type='hidden' name='reg_no[]' value='$reg_no'>$reg_no</td>
                     <td><input type='number' name='attendence[]' placeholder='Attendence' class='form-control' max='10' min='0' value='$existing_attendence_score'></td>
                     <td><input type='number' name='mid[]' placeholder='Mid Marks' class='form-control' max='30' min='0' value='$existing_mid_score'></td>
                     <td><input type='number' name='final[]' placeholder='Final' class='form-control' max='60' min='0' value='$existing_final_score'></td>
                <input type='hidden' name='dept[]' value='$dept'>
                <input type='hidden' name='subject[]' value='$subject'>
                <input type='hidden' name='session[]' value='$session'>
                   <input type='hidden' name='score_id[]' value='$score_id'>

                </tr>";
        $count++;
    } //first rowcount if statement

    $output .= "</tbody>";


    $output .= "</table>";
    $output .= "</div>";
    $output .= "<tr><td colspan='4'><input type='submit' name='submit_result' value='Add Mark' class='btn btn-dark'></td></tr>";
    $output .= "</form>";
    $output .= "</div>";

    echo $output;
} else {
    echo "<p style='padding: 30px; text-align: center; '>No Students found for the selected class.</p>";
}
