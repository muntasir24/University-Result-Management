<?php
session_start();
error_reporting(0);
include "includes/database.php";
include "includes/functions.php";

$conn = new Functions();
$base_url = $conn->base_url();
$output = '';



$dept = $_POST['class'];
$exam = $_POST['exam'];
$session = $_POST['session'];


// Use a regular expression to extract only the digits
if (preg_match_all('/\d+/', $exam, $matches)) {
    $extractedDigits = implode('', $matches[0]);
    // This will output 41 for "4th Year 1st Semester"
} else {
    // Handle the case where no digits are found
    echo "No digits found in the input.";
}

$sem = $extractedDigits;
$exam = str_replace(' ', '-', $exam);




$count = 1;

//fetch students names based on the selected class
$sql = "SELECT * FROM student WHERE dept_name = :d AND session =:ss";
$conn->query($sql);
$conn->bind(":d", $dept);
$conn->bind(":ss", $session);

$rowCount = $conn->rowCount();

if ($rowCount > 0) {

    $result = $conn->fetchMultiple();
    $output = "<div class='card-body'>";
    $output .= "<div class='col-md-12 jumbotron'>
                   <h3 class='text-center'>Student Details</h3>
                   <div class='text-center'>
                   <span class='text-center' style='display: inline-block;'>Department: <span>$dept</span></span><br>
                   <span class='text-center' style='display: inline-block;'>Examination: <span>$exam</span></span><br>
                   <span class='text-center' style='display: inline-block;'>Session: <span>$session</span></span><br>
                  </div>

            </div>";

    //----------------------------------------------------------------------------------------------------------------------------------------------------------------------
?>

    <form action="" class="form-horizontal" method="post" id="publish-result">

        <input type="hidden" name="session" value="<?php echo $session; ?>">
        <input type="hidden" name="dept" value="<?php echo $dept; ?>">
        <input type="hidden" name="exam" value="<?php echo $exam; ?>">

        <div class="col-md-3" style="margin-top: 30px;">
            <input type="submit" value="Publish Result" class="btn btn-success" id="publish">
        </div>

    </form>


    <script>
        $('#publish-result').parsley();
        $('#publish-result').on('submit', function(event) {
            event.preventDefault();
            if ($('#publish-result').parsley().isValid()) {
                $.ajax({
                    url: "<?php echo $base_url; ?>publish.php",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#publish').attr('disabled', 'disabled');
                        $('#publish').val('Fetching details, pls wait ......');
                    },
                    success: function(data) {
                        $('#publish-result').parsley().reset();
                        $('#publish').attr('disabled', false);
                        $('#publish').val('Publish Result');
                        $('#display-details').html(data);
                    }
                })
            }

        })
    </script>


<?php
//-----------------------------------------------------------doing things in same page bt action="";












    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------
    $output .= "<div class='table-responsive'>";
    $output .= "<table class='table table-bordered table-hover table-stripped' id='teacher'>
                 <thead>
                        <th>#</th>
                        <th>Name</th>
                        <th>Reg No</th>
                        <th>Action</th>
                    </thead>";

    $output .= "<tbody>";

    foreach ($result as $student) {
        $name = $student->name;
        $reg_no = $student->reg_no;

        // Replace spaces with hyphens in the name
        $name_url = str_replace(' ', '-', $name);

        // Ensure variables are defined before using them
        $result_url = $base_url . "generate_report/" . urlencode($session) . "/" . urlencode($dept) . "/" . urlencode($name_url) . "/" . urlencode($exam) . "/" . urlencode($reg_no) . "/" . urlencode($sem);

        // Echo the generated URL for debugging
        //  echo $result_url;

        $output .= "<tr>
        <td>$count</td>
        <td>$student->name</td>
        <td>$reg_no</td>
        <td>
            <a href='$result_url' target='_blank'><i class=\"fa fa-check-square\"></i></a>
        </td>
    </tr>";

        $count++;
    }


    $output .= "</tbody>";
    $output .= "</table>";
    $output .= "</div>";
    $output .= "</div>";

    echo $output;
} else {
    echo "<p style='padding: 30px; text-align: center; '> No Students found for the selected details.</p>";
}
