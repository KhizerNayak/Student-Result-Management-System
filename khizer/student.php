<?php
session_start();


if ($_SESSION['type'] != 2) {
  header("location: index.php");
}


include 'conn.php';

function generate_random_string()
{
  $letters = range('A', 'Z');
  $random_letters = array_rand(array_flip($letters), 2);
  $random_numbers = mt_rand(1000, 9999);
  $random_string = implode('', $random_letters) . $random_numbers;
  return $random_string;
}

// Call the function to generate a random string
// $random_string = generate_random_string();



$alert = 0;
// $random_letters = generateRandomLetters();
// echo $random_letters;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {


  // echo 'sjhs';
  if (isset($_POST['class_div']) and isset($_POST['student_name'])) {

    while (True) {
      $random_string = generate_random_string();
      // echo $random_string;
      $sql = "SELECT * FROM `student` WHERE `username` = '$random_string'";
      $result = mysqli_query($conn, $sql);
      $num = mysqli_num_rows($result);
      // echo $num ;
      if ($num >= 1) {
        continue;
      } else {
        break;
      }

    }

    // echo 'shs';

    $class_div = $_POST['class_div'];
    $student_name = $_POST['student_name'];

    $file = $_FILES['student_pic'];
    $student_img = $file['name'];
    $tempsave = $file['tmp_name'];

    // $random_letters = generateRandomLetters();

    $sql = "SELECT * FROM `class` WHERE `sno` = $class_div";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $class_name = $row['class_name'];
    $username = $random_string;

    $password = mt_rand(1000, 9999);
    // echo $username ;

    $sql = "SELECT * FROM `student` WHERE `name` = '$student_name' AND `classno` = $class_div AND `img` = '$student_img'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    // echo $num ;
    if ($num >= 1) {
      $alert = 3;

    } else {

      // echo  $row['class_name'];
      // echo $class_div, $term_name, $class_name;

      $sql = "INSERT INTO `student` (`sno`, `name`, `username`, `password`, `classname`, `classno`, `img`, `time`) VALUES (NULL, '$student_name', '$username', '$password', '$class_name', '$class_div', '$student_img', current_timestamp());";
      $result = mysqli_query($conn, $sql);
      if (!$result) {
        $alert = 2;

      } else {
        $upload = 'studentimg/' . $student_img;
        move_uploaded_file($tempsave, $upload);
        $alert = 1;

      }

    }

  } elseif (isset($_POST['del_class_name']) and isset($_POST['del_student_username'])) {


    $class_name = $_POST['del_class_name'];
    $username = $_POST['del_student_username'];
    $image = $_POST['del_student_img'];
$filename = "studentimg/$image";

    $sql = "DELETE FROM `student`WHERE `classname` = '$class_name' AND `username` = '$username'";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
      $alert = 5;
    } else {
      $alert = 4;
      if (file_exists($filename)) {
        unlink($filename);
       
     } 
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
      echo alerts('success', 'Successful ', ' ' . $class_name . ' student - ' . $student_name . ' added successfully');
    } elseif ($alert == 2) {
      echo alerts('danger', 'Unsuccessful ', 'there is some problems subject not added');
    } elseif ($alert == 3) {
      echo alerts('warning', 'Unsuccessful ', 'The ' . $class_name . ' - ' . $student_name . ' is already added  ');
    } elseif ($alert == 4) {
      echo alerts('success', 'Successful ', '' . $class_name . ' student - ' . $username . ' deleted successsfully');
    } elseif ($alert == 5) {
      echo alerts('warning', 'Unsuccessful', 'their is some problem subject not deleted ');
    }
    ?>






    <div class="col-sm-12" id="mtable">
      <h4 class="display-4" id="innerhtml" style="text-align: center">Student List</h4>
      <br>



      <div class="row " id="addmore" style="display: none">
        <div class="col-lg-8 col-sm-12 offset-lg-2 card p-4">


          <form action="#" method="POST" enctype="multipart/form-data" style="margin-top: 10px;">
            <div class="row">
              <div class="form-group col-sm-6">
                <label for="class_div">Select Class and Division</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="bi bi-list"></i></span>
                  </div>


                  <select class="custom-select" id="class_div" name="class_div" required="">
                    <?php
                    $sql = "SELECT * FROM `class` order by time desc";
                    $result = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                      echo '
        <option value="' . $row['sno'] . '">' . $row['class_name'] . ' - ' . $row['div_name'] . '</option>

';
                    }
                    ?>

                  </select>

                </div>
              </div>
              <div class="form-group col-sm-6">
                <label for="student_name">Student Name</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">@</span>
                  </div>

                  <input type="text" class="form-control" name="student_name" id="student_name"
                    placeholder="Enter student Name" required="">

                </div>
              </div><br>

              <br><br>
              <div class="form-group col-sm-6">
                <label for="filecm">Select Picture</label>

                <input type="file" class="form-control-file" id="filecm" name="student_pic" accept="image/*"
                  required><br>

              </div>

            </div>
            <br>
            <input type="submit" class="btn  text-light float-end" style=" color: white; background:  #014e22  ; " name="sbt" value="Submit">
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


      <table class=" pt-4 pb-4 table table-dark" id="myTable">
        <thead>
          <tr>
            <th>Sr.no</th>
            <th>Picture</th>
            <th>Student Id</th>
            <th>Name</th>
            <th>Class and Division</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT * FROM `student` order by classname desc";
          $result = mysqli_query($conn, $sql);
          $sno = 0;
          while ($row = mysqli_fetch_assoc($result)) {
            $sno = $sno + 1;
            echo '
          
      <tr>
      <td>' . $sno . '</td>
      <td><img src="studentimg/' . $row['img'] . '" style="width:100px;"></td>
      <td>' . $row['username'] . '</td>
      <td>' . $row['name'] . '</td>
      <td>' . $row['classname'] . '</td>
      <td>
      <form  action="#" method="POST">
        <div style="display:none;">
          <input type="text" name="del_class_name" value="' . $row['classname'] . '">
          <input type="text" name="del_student_username" value="' . $row['username'] . '">
          <input type="text" name="del_student_img" value="' . $row['img'] . '">
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
            <td><img src="uploads/wihtkxp9g2sample.png" style="width:100px;"></td>
            <td>3DKS17</td>
            <td>Shahruk</td>
            <td>FYIT-yahya - A</td>
            <td><a href="deletecm.php?id=1"><i class="bi bi-trash-fill text-danger"></i></a></td>
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