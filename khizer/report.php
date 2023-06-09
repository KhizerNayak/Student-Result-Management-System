<?php

session_start();
$alert = 0 ;

if ($_SESSION['loggedin'] != true) {
    header("location: login.php");
}

include 'conn.php';

if (isset($_SESSION['type']) and $_SESSION['type'] == 1) {
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM `student` WHERE `username` = '$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $student_image = 'studentimg/' . $row['img'];

}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['marks'])) {
        $class_div = $_POST['class_div'];
        $term = $_POST['term'];
        $termno = $_POST['termno'];
        $student = $_POST['student'];

        $sqlsub = "SELECT * FROM `subject` WHERE `classno` =  $class_div AND `termname` = '$term'";
        $resultsub = mysqli_query($conn, $sqlsub);
        $sno = 0;
        while ($rowsub = mysqli_fetch_assoc($resultsub)) {
            $sub_n = $rowsub['subject'];
            $sub_m = $_POST[$sub_n];
            // echo $sub_n, $sub_m;

            $sqlcheckmark = "SELECT * FROM `report` WHERE `classno` = $class_div  AND `termno` = $termno AND `studentuser` = '$student'  AND `subject` = '$sub_n'  ";
            $resultcheckmark = mysqli_query($conn, $sqlcheckmark);
            $num = mysqli_num_rows($resultcheckmark);

            if ($num >= 1) {
                $sqlupdate = "UPDATE `report` SET `marks` = '$sub_m'  WHERE `studentuser` = '$student'  AND `subject` = '$sub_n' ";
                $resultupdate = mysqli_query($conn, $sqlupdate);
                
                if (!$resultupdate) {
                   
                    $alert = 2 ;
                }else{
                    $alert = 1 ;
                }
            } else {
                $sqlinsert = "INSERT INTO `report` (`sno`, `classno`, `termname`, `termno`, `studentuser`, `subject`, `marks`, `time`) VALUES (NULL, ' $class_div', ' $term', '$termno', '$student', '$sub_n', '$sub_m', current_timestamp());";
                $resultinsert = mysqli_query($conn, $sqlinsert);
                   
                if (!$resultinsert) {
                   
                    $alert = 2 ;
                }else{
                    $alert = 1 ;
                }
            }
        }
    }
}
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {


//     if (isset($_POST['class_div']) ) {
//    $class_div  =$_POST['class_div'];
//    $report =  ;

//     }
// }



?>


<!doctype html>
<html lang="en">

<head>
    <?php include 'headcontent.php'; ?>

</head>

<body>

    <!-- nav include  -->
    <?php include 'nav.php';
    echo $nav_bar;




    if ($alert == 1) {
      echo alerts('success', 'Successful ', ' Successfully updated Marks');
    } elseif ($alert == 2) {
      echo alerts('danger', 'Unsuccessful ', 'There is some proble marks not added');
    }
    


    if ($_SESSION['type'] == 2) {
        ?>

        <!-- admin  report -->
        <!--        form to get clas from admin  -->

        <div class="container my-5">
            <div class="row" style="padding-top:20px; ">
                <div class="col-lg-12 col-sm-12 my-2">
                    <h4 class="text-center">Reports</h4>
                </div>
            </div>
            <div class="row ">
                <div class="col-lg-8 col-sm-12 offset-lg-2 card py-2">
                    <form action="#" method="POST" style="margin-top: 10px;">
                        <div class="row">
                            <div class="form-group col-sm-6 offset-sm-3">
                                <label for="term">Select Term</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="bi bi-list"></i></span>
                                    </div>
                                    <select class="custom-select" id="term" name="class_div" required="">
                                        <option value="">Choose Class</option>
                                        <?php
                                        $sql = "SELECT * FROM `class` order by class_name desc";
                                        $result = mysqli_query($conn, $sql);
                                        $sno = 0;
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $sno = $sno + 1;
                                            echo '  <option value="' . $row['sno'] . '">' . $row['class_name'] . ' - ' . $row['div_name'] . '</option>';
                                        } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="float-end btn text-light " style=" color: white; background:  #014e22  ; " name="term_sbt" value="Submit">
                    </form>
                    <br>
                </div>
            </div>
        </div>




        <!--  show data of marksheeet of student and update  for admin -->
        <div class="border row" style="padding: 2%; diplay:flex; justify-content: center;">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
             

                if (isset($_POST['class_div'])) {
                    $class_div = $_POST['class_div'];
                    $sql = "SELECT * FROM `student` WHERE `classno` = $class_div order by classname desc";
                    $result = mysqli_query($conn, $sql);
                    $num = mysqli_num_rows($result);
                    if ($num >= 1) {


                        while ($row = mysqli_fetch_assoc($result)) {
                            $studentuser = $row['username'];
                            ?>

                            <div class="col-sm-4 mx-2" style="margin-top:30px;border: 1px solid black;padding: 20px;">
                                <h4 class="text-center display-4">
                                    <?php echo $row['name']; ?>
                                </h4><br><br>
                                <?php
                                $sqlterm = "SELECT * FROM `term` WHERE `classno` = $class_div ";
                                $resultterm = mysqli_query($conn, $sqlterm);
                                while ($rowterm = mysqli_fetch_assoc($resultterm)) {
                                    ?>
                                    <form action="#" method="POST">
                                        <h4 class="text-center">
                                            <?php echo $rowterm['term']; ?>
                                        </h4>

                                        <?php
                                        $termname = $rowterm['term'];
                                        $termno = $rowterm['sno'];
                                        $sqlsub = "SELECT * FROM `subject` WHERE `classno` =  $class_div AND `termname` = '$termname' ";
                                        $resultsub = mysqli_query($conn, $sqlsub);
                                        while ($rowsub = mysqli_fetch_assoc($resultsub)) {
                                            $subject = $rowsub['subject'];
                                            $sqlmark = "SELECT * FROM `report` WHERE `classno` =  $class_div AND `termno` = $termno AND `studentuser` = '$studentuser' AND `subject` = '$subject' ";
                                            $resultmark = mysqli_query($conn, $sqlmark);
                                            $nummark = mysqli_num_rows($resultmark);
                                            if ($nummark >= 1) {
                                                $rowmark = mysqli_fetch_assoc($resultmark);
                                                $marks = $rowmark['marks'];
                                                ?>
                                                <div class="form-group  col-sm-12">
                                                    <label>
                                                        <?php echo $rowsub['subject']; ?>
                                                    </label>
                                                    <input type="text" name="<?php echo $rowsub['subject']; ?>" value="<?php echo $marks; ?>"
                                                        class="form-control" required="">
                                                </div>
                                                <br>
                                            <?php } else { ?>
                                                <div class="form-group  col-sm-12">
                                                    <label>
                                                        <?php echo $rowsub['subject']; ?>
                                                    </label>
                                                    <input type="text" name="<?php echo $rowsub['subject']; ?>" value="not set /100" class="form-control"
                                                        required="">
                                                </div>
                                                <br>
                                                <?php
                                            }
                                        } ?>

                                        <input type="hidden" name="marks" value="1">
                                        <input type="hidden" name="class_div" value="<?php echo $class_div; ?>">
                                        <input type="hidden" name="term" value="<?php echo $rowterm['term']; ?>">
                                        <input type="hidden" name="termno" value="<?php echo $rowterm['sno']; ?>">
                                        <input type="hidden" name="student" value="<?php echo $row['username']; ?>">
                                        <input type="submit" class="btn bg-dark text-light float-right" name="report_sbt" value="Update">
                                    </form>
                                <?php } ?>
                            </div>
                        <?php }
                    } else {


                        ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>NULL !</strong> no student added in this class
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php
                    }
                }
            } ?>
            <br>
        </div>


    <?php } else if ($_SESSION['type'] == 1) {
        ?>





            <!-- student report  -->
            <div class="container mb-3 my-5 py-2">
                <?php

                $studentuser = $_SESSION['username'];
                $sql = "SELECT * FROM `student` WHERE `username` = '$studentuser'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $studentname = $row['name'];
                ?>

                <div class="row mb-5" style="padding-top:20px; ">
                    <div class="col-lg-12 col-sm-12">
                        <h4 class="text-center"><img class="rounded-circle border" style="width:70px; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;" src="<?php echo $student_image; ?>"
                                style="width:75px;vertical-align: middle;">&ensp; Hello!&ensp;<?php echo$studentname;?></h4>
                    </div>
                </div>
                <div class="row my-5">
                    <?php

                    $class_div = $row['classno'];
                    $class_name = $row['classname'];

                    $sql = "SELECT * FROM `term` WHERE `classno` = $class_div ";
                    $result = mysqli_query($conn, $sql);
                    $num = mysqli_num_rows($result);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $term = $row['term'];
                        $termno = $row['sno'];
                        ?>
                        <div class="card my-3">
                            <div class="card-header text-center bg-dark">
                                <h4 style="color:white;">
                                <?php echo $term; ?>
                                </h4>
                            </div>
                            <div class="card-body">

                                <?php
                                $sqlsub = "SELECT * FROM `subject` WHERE `classno` = $class_div AND `termname` = '$term'";
                                $resultsub = mysqli_query($conn, $sqlsub);
                                $rowsub = mysqli_fetch_assoc($resultsub);
                                while ($rowsub = mysqli_fetch_assoc($resultsub)) {
                                    $subject = $rowsub['subject'];

                                    $sqlmark = "SELECT * FROM `report` WHERE `termno` = $termno AND `studentuser` = '$studentuser' AND `subject` = '$subject'";
                                    $resultmark = mysqli_query($conn, $sqlmark);
                                    $rowmark = mysqli_fetch_assoc($resultmark);
                                    $nummark = mysqli_num_rows($resultmark);

                                    if ($nummark >= 1) {
                                        $marks = $rowmark['marks'];
                                        ?>

                                        <div class="card-text text-center">
                                            <label><b>
                                                <?php echo $subject; ?>
                                                </b> :
                                            <?php echo $marks; ?>/100
                                            </label>
                                        </div>
                                        <br>
                                    <?php
                                    } else {
                                        ?>

                                        <div class="card-text text-center">
                                            <label><b>
                                                <?php echo $subject; ?>
                                                </b> : not set /100 </label>
                                        </div>
                                        <br>

                                    <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                <?php } ?>


                </div>
            </div>


    <?php } ?>

    <?php include 'footer.php'; ?>

</body>

</html>