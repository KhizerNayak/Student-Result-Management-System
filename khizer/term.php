<?php

session_start();


if ($_SESSION['type'] != 2) {
  header("location: index.php");
}


include 'conn.php';

// echo "ff";

$alert = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // echo 'sjhs';
  if (isset($_POST['class_div_no']) and isset($_POST['term_name'])) {
    // echo 'shs';

    $class_div = $_POST['class_div_no'];
    $term_name = $_POST['term_name'];
    $no_of_sub = $_POST['no_of_sub'];



    $sql = "SELECT * FROM `class` WHERE `sno` = $class_div";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $class_name = $row['class_name'] . ' - ' . $row['div_name'];


    $sql = "SELECT * FROM `term` WHERE `term` = '$term_name' AND `classno` = '$class_div' AND `classname` = '$class_name'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    // echo $num ;
    if ($num >= 1) {
      $alert = 3;
    } else {

      // echo  $row['class_name'];
      // echo $class_div, $term_name, $class_name;

      $no = 1;
      for ($x = 1; $x <= $no_of_sub; $x++) {
        $sub_na = $no . 'subject_name';
        $sub_name = $_POST['' . $sub_na . ''];
        // echo  $sub_name ;
        $sql = "INSERT INTO `subject` (`sno`, `classno`, `termname`, `subject`, `time`) VALUES (NULL, '$class_div', '$term_name', '$sub_name', current_timestamp());";
        $result = mysqli_query($conn, $sql);
        $no += 1;
      }



      $sql = "INSERT INTO `term` (`sno`, `term`, `classno`, `classname`, `time`) VALUES (NULL, '$term_name', '$class_div', '$class_name', current_timestamp());";
      $result = mysqli_query($conn, $sql);
      if (!$result) {
        $alert = 2;

      } else {

        $alert = 1;

      }

    }




  }


  if (isset($_POST['del_class_no']) and isset($_POST['del_term_name'])) {
    // echo ' jsd';
    $class_no = $_POST['del_class_no'];
    $term_name = $_POST['del_term_name'];
    $sql = "DELETE FROM `subject` WHERE `termname` = '$term_name' AND `classno` = '$class_no'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $alert = 4;
    } else {
      $alert = 5;
    }
    $sql = "DELETE FROM `term` WHERE `term` = '$term_name' AND `classno` = '$class_no'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $alert = 4;
    } else {
      $alert = 5;
    }
  }

}


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <?php include 'headcontent.php'; ?>

  <style>
    #exampleDataList1 {
      border: 1px solid black;
    }

    #mtable {
      padding: 40px 20px 50px;
      border: 1px solid black;
      overflow: scroll;
    }

    #myTable_filter {
      display: none;
    }

    #myTable_filter input {
      /* background-color: pink; */
      border-radius: 20px;
    }

    #exampleDataList1 {

      width: 50%;

      /*  left: 50%;
      top: 5%; */
    }
  </style>
</head>

<body>

<?php include 'nav.php'; echo$nav_bar,$nav_logo; ?>




  <!-- view of  -->


  <!-- subject view  -->

  <div class="row" style="margin: 5% 5%">

    <?php

    if ($alert == 1) {
      echo alerts('success', 'Successful', ' Term Added successsfully');
    } elseif ($alert == 2) {
      echo alerts('danger', 'Unsuccessful', 'there is some problems term not added');
    } elseif ($alert == 3) {
      echo alerts('warning', 'Unsuccessful', 'This Term  is already added  ');
    } elseif ($alert == 4) {
      echo alerts('success', 'Successful', ' Term is  deleted successsfully');
    } elseif ($alert == 5) {
      echo alerts('warning', 'Unsuccessful', 'their is some problem term not deleted ');
    }
    ?>




    <div class="col-sm-12" id="mtable">
      <h4 class="display-4" id="innerhtml" style="text-align: center">Terms</h4>
      <br>



      <div class="row" id="addmore" style="display: none">
        <div class="col-lg-8 col-sm-12 offset-lg-2 card">
          <form action="#" method="POST" style="margin-top: 10px">
            <div class="row">
              <div class="form-group col-sm-6">
                <label for="cd">Select Term</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="bi bi-list"></i></span>
                  </div>
                  <select class="custom-select" id="cd" name="class_div_no" required="">
                    <?php
                    $sql = "SELECT * FROM `class` order by time desc";
                    $result = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                      echo '
        <option value="' . $row['sno'] . '">' . $row['class_name'] . ' - ' . $row['div_name'] . '</option>

';
                    }
                    ?>
                    <!-- <option value="3">FYIT-yahya - A : Unit Test Sem 2</option> -->
                  </select>


                </div>
              </div>

              <div class="form-group col-sm-6">
                <label for="sub_name">Term</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="bi bi-list"></i></span>
                  </div>
                  <select class="custom-select px-5" id="term_name" name="term_name" required>
                  <option value="term-1">Term-1</option>
                  <option value="term-2">Term-2</option>

                  </select>
                 


                </div>

              </div>
              <br>
              <br>
              <div class="form-group col-sm-6  pb-3 pt-5">
                <label for="no_of_sub">No Of Subject : </label>
                <input type="number" id="no_of_sub" name="no_of_sub" onkeypress="sub_name();"
                  placeholder="type and enter" required>

              </div>
              <br>
              <br>
              <div class="form-group ps-5 pt-5 ">
                <h4 class="diplay-5"> subject name</h4><br>
                <input type="text" name="1subject_name" onclick="sub_name();" placeholder="1 subject name"
                  required><br><br>
                <div class="" id="subjectname">


                  <input type="text" name="2subject_name" onclick="sub_name();" placeholder="2 subject name"
                    required><br><br>
                  <input type="text" name="3subject_name" onclick="sub_name();" placeholder="3 subject name"
                    required><br><br>
                  <input type="text" name="4subject_name" onclick="sub_name();" placeholder="4 subject name"
                    required><br><br>

                </div>
                <script>
                  function sub_name() {
                    let a = document.getElementById('no_of_sub').value;

                    let no_a = a - 1;
                    let sub_name = document.getElementById("subjectname");
                    let b = ""
                    let no = 2;
                    for (let i = 0; i < no_a; i++) {

                      b += '<input type="text" name="' + no + 'subject_name"  placeholder="' + no + 'subject name" required><br><br>';
                      no += 1;
                    }
                    sub_name.innerHTML = b;
                    console.log(b);
                  }
                </script>
              </div>
            </div>
            <input type="submit" class="btn text-light float-end" style=" color: white; background:  #014e22  ; " name="sbt" value="Submit" />
          </form>



          <br />
        </div>
      </div>

      <br>



      <div class="container">
        <button class="btn bg-dark float-end" style="color: white" onclick="addmore();">
          add more
        </button>
      </div>
      <br>
      <br>
      <input class="form-control float-end" list="datalistOptions" onkeyup="search(this);" id="exampleDataList1"
        placeholder="Type to search...">


      <table class="pt-4 pb-4 table table-dark" id="myTable">

        <thead>
          <tr>
            <th>Sr.no</th>
            <th>Class and Division</th>
            <th>Term Name</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $sql = "SELECT * FROM `term` order by classname desc";
          $result = mysqli_query($conn, $sql);
          $sno = 0;
          while ($row = mysqli_fetch_assoc($result)) {
            $sno = $sno + 1;
            echo '
         
        <tr>
        <td>' . $sno . '</td>
        <td>' . $row['classname'] . '</td>
        <td>' . $row['term'] . '</td>
        <td>
        <form  action="#" method="POST">
          <div style="display:none;">
            <input type="text" name="del_class_no" value="' . $row['classno'] . '">
            <input type="text" name="del_term_name" value="' . $row['term'] . '">
          </div>
            <button value="del_class" class="btn-none" type="submit"><i class="bi bi-trash-fill text-danger"></i></button>
        </form>
      </td>
      </tr>
';
          }
          ?>

          <!-- <tr>
            <td>1</td>
            <td>FYIT-yahya - A</td>
            <td>Unit Test Sem 1</td>
            <td><a href="deletesub.php?id=1"><i class="bi bi-trash-fill text-danger"></i></a></td>
          </tr> -->

        </tbody>
      </table>

    </div>
  </div>


  <?php include 'footer.php'; ?>







  <script>
    function addmore() {
      var a = document.getElementById("addmore");

      if (a.style.display == "none") {
        a.style.display = "block";
      } else {
        a.style.display = "none";
      }
    }

  </script>


</body>

</html>