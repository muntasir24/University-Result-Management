
                                                                          
<?php
session_start();
include 'includes/database.php';
include 'includes/functions.php';
$conn = new Functions();

$dept = $_POST['dept'];
$exam = $_POST['exam'];

// Fetch subjects based on the specific department and exam
$sql = "SELECT * FROM subjects WHERE dept_name = :d AND semester = :s";
$conn->query($sql);
$conn->bind(":d", $dept);
$conn->bind(":s", $exam);

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
