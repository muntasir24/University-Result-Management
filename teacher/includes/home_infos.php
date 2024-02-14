<div class="row">
    
<?php

$x=$_SESSION['teacher']; 
?>

    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <?php

                        $sql = "SELECT name FROM teachers WHERE username =:u";
                        $conn->query($sql);
                        $conn->bind(":u", $x);
                        $name=$conn->fetchSingle();
                        $tname=$name->name;

echo "Teaching Total subjects";


                //select unread messages from the database
                $sql = "SELECT COUNT(subject_code) FROM subjects WHERE t_name =:teacher";
                $conn->query($sql);
                $conn->bind(":teacher", $tname);
                $subjects = $conn->fetchColumn();
                ?>
                <h3><?php echo $subjects; ?></h3>

                <p>Subjects</p>
            </div>
            <div class="icon">
                <i class="fas fa-table"></i>
            </div>
          
        </div>
    </div>
    <!-- ./col -->

   

</div>