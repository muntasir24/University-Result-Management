<?php
session_start();
//error_reporting(0);
require('TCPDF-main/tcpdf.php');
include 'includes/database.php';
include 'includes/functions.php';

$conn = new Functions();
$redirect = $conn->base_url();
$back_to_terminal_report = $conn->base_url() . "result";

if (isset($_GET['dept']) and isset($_GET['session']) and isset($_GET['name']) and isset($_GET['reg_no'])) {
    $name = str_replace('-', ' ', $_GET['name']);
    $exam = str_replace('-', ' ', $_GET['exam']);
    $sem = $_GET['sem'];
    $reg_no = $_GET['reg_no'];
    $dept = $_GET['dept'];
    $session = $_GET['session'];



    $zero = 0;
    $sql = "SELECT * FROM result WHERE reg_no =:r AND attendence != :zero AND mid != :zero AND final != :zero
            AND dept_name =:d AND CAST(LEFT(SUBSTRING_INDEX(result.subject_code, '-', -1), 2) AS SIGNED)=:sem AND session =:ss ORDER BY subject_code ASC";
    $conn->query($sql);
    $conn->bind(":r", $reg_no);
    $conn->bind(":zero", $zero);
    $conn->bind(":d", $dept);
    $conn->bind(":sem", $sem);
    $conn->bind(":ss", $session);
    $rowcount = $conn->rowCount();

//echo $rowcount;

    if ($rowcount > 0) {
        $result = $conn->fetchMultiple();

        //    foreach($result as $x){

        //     echo $x->grade_point;
        //    }

        $sql = "SELECT * FROM subjects_view WHERE dept_name=:d AND semester=:sm";
        $conn->query($sql);
        $conn->bind(":d", $dept);
        $conn->bind(":sm", $exam);
        $details = $conn->fetchSingle();
        $totSubj = $details->tot_subjects;

        $sql = "SELECT * FROM cgpa WHERE reg_no=:r AND dept_name =:d AND session =:ss and semester=:sm";
        $conn->query($sql);
        $conn->bind(":r", $reg_no);
        $conn->bind(":d", $dept);
        $conn->bind(":ss", $session);
        $conn->bind(":sm", $sem);
        $details = $conn->fetchSingle();
        $cgpa = $details->cgpa;


        class PDF extends TCPDF
        {
            public $conn;

            //students variables




            public function Header()
            {
                $conn = new Functions();
                //fetch all available school  information
                $sql = "SELECT * FROM general_settings";
                $conn->query($sql);
                $result_set = $conn->fetchSingle();
                $varsity_logo = $result_set->logo;
                $varsity_name = $result_set->varsity_name;
                $phone_no = $result_set->phone_no;
                $email = $result_set->email;
                $address = $result_set->address;
                $varsity_website = "https://www.shu.edu.bd/";
                

                $imageFile = "upload/$varsity_logo";
                $this->Image($imageFile, 25, 1, 20, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
                $this->Ln(2);
                $this->SetFont('helvetica', 'B', 20);
                $this->cell(205, 2, "$varsity_name", 0, 1, "C");
          

               
                    $this->SetFont('helvetica', 'B', 10);
                    $this->cell(200, 2, "Website:    $varsity_website", 0, 1, "C");
                    $this->SetFont('helvetica', '');
                    $this->cell(86, 0, '__________________________________________________________________________________________________', 0, '', '', '');
           
                
                $this->Ln();
                $this->SetFont('helvetica', '');
                $conn = new Functions();
                global  $name;
                global $dept;
                global $session;
                global $reg_no;
                global $exam;
                global $cgpa;

                //fetch student profile image
                $sql = "SELECT photo FROM student WHERE reg_no =:r";
                $conn->query($sql);
                $conn->bind(":r", $reg_no);
                $photo = $conn->fetchColumn();
                if (empty($photo)) {
                    $img_file = 'upload/default.png';
                } else {
                    $img_file = "upload/$photo";
                }


                $html = "
              <div class='row'>
                 <div class='col-md-3'>
                   <h3>$varsity_name</h3>   
                   <span>$address</span>
                   <p><strong>Phone:</strong> $phone_no</p>  
                   <p><strong>Email:</strong> $email</p>  
                </div>
              </div>
              <style>
                h3{font-size: 13px; text-transform: lowercase !important;}  
                p{font-size: 13px; line-height: 10px;} 
                span{font-size: 13px;}
             </style>
            ";
                $html2 = "
              <div class='row'>
                 <div class='col-md-3'>
                   <p><strong>Name:</strong> $name</p>
                  <p><strong>Reg No:</strong> $reg_no </p>
                  <p><strong>Department:</strong> $dept &nbsp; <strong>Session:</strong> $session</p>
                   <p><strong>Exam:</strong> $exam </p>
                   
                  
                </div>
              </div>
              <style>
                h3{font-size: 13px;}  
                h3 span{font-weight: 400 !important; font-size: 11px;}
                p{font-size: 13px; line-height: 10px;} 
                div{padding-right: 20px;}
             </style>
            ";


              
                $html3 = "
              <div class='row'>
                 <div class='col-md-3'>
                   <p><strong>CGPA: </strong>$cgpa</p>
                </div>
              </div>
              <style> 
                p{font-size: 15px; line-height: 10px;} 
                div{padding-right: 20px;}
             </style>
            ";


                $this->WriteHtmlCell(50, 10, '', 15, $html);
                $this->WriteHtmlCell(455, 20, 70, 16, $html2);
                $this->WriteHtmlCell(40, 20, 120, 16, $html3);
                $this->Image($img_file, 170, 28, 32, 32, '', '', '', false, 300, '', false, false, 0);
            }

            public function Footer()
            {

                $this->SetY(-245);
                $this->Ln(8);
                $this->SetFont('times', 'B', '10');
                $this->MultiCell(189, 5, 'RESULT REPORT', 0, 'L', 0, 1, '', '', true);
            }
        }





//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        // create new PDF document
        $pdf = new PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

      
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor("Sheikh Hasina University");
        $pdf->SetTitle('Terminal Report');


        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


        // ---------------------------------------------------------

        // set font
        $pdf->SetFont('helvetica', '', 10);

        // add a page
        $pdf->AddPage();

        //-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------  



        //add background image
        // $bg = 'upload/logobg.png';

    
        //     $pdf->Image($bg, 170, 28, 32, 32, '', '', '', false, 300, '', false, false, 0);
        

        //-------------------------------------------

        $pdf->Ln(38);
        $pdf->SetFillColor(224, 225, 255);
    


       if($rowcount<=$totSubj){
            $pdf->Cell(65, 8, 'Subject', 1, 0, 'L', 1);
            $pdf->Cell(25, 8, 'Attendance', 1, 0, 'L', 1);
            $pdf->Cell(25, 8, 'Mid Mark', 1, 0, 'L', 1);
            $pdf->Cell(25, 8, 'Final', 1, 0, 'L', 1);
            $pdf->Cell(25, 8, 'Letter Grade', 1, 0, 'L', 1);
            $pdf->Cell(25, 8, 'Grade Point', 1, 1, 'L', 1);
        foreach ($result as $report_details) {
            $subject = $report_details->subject_code;

            //==========================================================//

            // Use a prepared statement to fetch subject details
            $sql = "SELECT * FROM subjects WHERE subject_code = :sbj";
            $conn->query($sql);
            $conn->bind(":sbj", $subject);
            $details = $conn->fetchSingle();
            $subjectName = $details->subject_name;

            //==========================================================//

            $at = $report_details->attendence;
            $mid = $report_details->mid;
            $final = $report_details->final;
            $letter_grade = $report_details->letter_grade;
            $gp=$report_details->grade_point;

            //show the values
            $pdf->Ln(8); //this will reduce the line height of each subject
            $pdf->Cell(65, 8, $subjectName, 1, 0, "L"); // Use $subjectName instead of $subject
            $pdf->Cell(25, 8, $at, 1, 0, "L");
            $pdf->Cell(25, 8, $mid, 1, 0, "L");
            $pdf->Cell(25, 8, $final, 1, 0, "L");
            $pdf->Cell(25, 8, $letter_grade, 1, 0, "L");
            $pdf->Cell(25, 8, $gp, 1, 0, "L");
        }
    }
    else{
            $pdf->Cell(150, 8, 'RESULT NOT PUBLISHED', 1, 0, 'C', 1);
    }

        $pdf->Ln();
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('times', 'N', '10');
        $pdf->Cell(40, 7, "", 0, 0, "L");

        // Set the timezone to Asia/Dhaka
        date_default_timezone_set('Asia/Dhaka');

        // Get the current date and time
        $now = date('F d, Y \a\t g:ia');

        // Set text color to red
        $pdf->SetTextColor(255, 0, 0);
        $pdf->SetFont('times', 'N', '10');
        $pdf->Cell(80, 5, "This result was generated on $now", 0, 0, "L");


    } else {

?>
        <script>
            alert('Student results details have not been added yet for the selected term. Pls add marks before viewing terminal report.');
        </script>
        <meta http-equiv="refresh" content="4; <?php echo $back_to_terminal_report; ?>">
<?php

    }
} else {
    //return back to index page

    header("location: $redirect");
}
// ---------------------------------------------------------

// close and output PDF document
$pdf->Output('result.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
