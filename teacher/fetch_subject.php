<?php
session_start();
include '../admin/includes/database.php';
include '../admin/includes/functions.php';
$conn= new Functions();

$username = $_SESSION['teacher'];
$sql = "SELECT * FROM teachers WHERE username =:username";
$conn->query($sql);
$conn->bind(":username", $username);

$result = $conn->fetchSingle();
$tname = $result->name;

                                                                        
$dept = $_POST['dept'];
$exam = $_POST['exam'];

// Fetch subjects based on the specific department and exam
$sql = "SELECT * FROM subjects WHERE dept_name = :d AND semester = :s and t_name=:n";
$conn->query($sql);
$conn->bind(":d", $dept);
$conn->bind(":s", $exam);
$conn->bind(":n", $tname);
// Generate HTML of subject options
if ($conn->rowCount() > 0) {
    $result = $conn->fetchMultiple();
    ?>
    <option value=''>Select Subject</option>
    <?php
    foreach ($result as $s) {
        ?>
        <option value="<?php echo $s->subject_code; ?>"><?php echo $s->subject_name; ?></option>
        <?php
    }
} else {
    echo "<option value=''>Subject not found.</option>";
}
?>
