<?php

session_start();


if ($_SESSION['type'] != 2 ) {
  header("location: index.php");
}

include 'conn.php';

$alert = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 

  if (isset($_POST['class_name']) and isset($_POST['div_name'])) {


    $class_name = $_POST['class_name'];
    $div_name = $_POST['div_name'];
   $sql = "SELECT * FROM `class` WHERE `class_name` = '$class_name' AND `div_name` = '$div_name'";
   $result = mysqli_query($conn, $sql);
   $num = mysqli_num_rows($result);
   if ($num >= 1) {
    $alert = 3;
  }else{
    $sql = "INSERT INTO `class` (`sno`, `class_name`, `div_name`, `time`) VALUES (NULL, '$class_name', '$div_name', current_timestamp());";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $alert = 1;
    } else {
      $alert = 2;
    }
  }

   


  }

  if (isset($_POST['del_class_name']) and isset($_POST['del_div_name'])) {
    $class_name = $_POST['del_class_name'];
    $div_name = $_POST['del_div_name'];
    
    $sql = "SELECT * FROM `class` WHERE `class_name` = '$class_name' AND `div_name` = '$div_name'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result) ;
    $classno = $row['sno'];   
    echo $classno;
    $sql = "DELETE FROM `class` WHERE `class_name` = '$class_name' AND `div_name` = '$div_name'";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
      $alert = 5;
    } else {
      $alert = 4;
    }
    
    $sql = "DELETE FROM `term` WHERE `classno` = '$classno' ";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
      $alert = 5;
    } else {
      $alert = 4;
    }
    
    $sql = "DELETE FROM `subject` WHERE `classno` = $classno";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
      $alert = 5;
    } else {
      $alert = 4;
    }
    $sql = "DELETE FROM `student` WHERE `classno` = $classno";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
      $alert = 5;
    } else {
      $alert = 4;
    }
    $sql = "DELETE FROM `report` WHERE `classno` = $classno";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
      $alert = 5;
    } else {
      $alert = 4;
    }


  }

}


?>





<!DOCTYPE html>
<html lang="en">

<head>
  <?php include 'headcontent.php'; ?>



  <style>
    #navmenu1:hover {
      border: none;
    }

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
    echo alerts('success', 'Successful ', ' '.$class_name.' - '.$div_name.' added ');
  } elseif ($alert == 2) {
    echo alerts('danger', 'Unsuccessful ', 'there is some problems class & division not added ');
  } elseif ($alert == 3) {
    echo alerts('warning', 'Unsuccessful ', 'The '.$class_name.' - '.$div_name.' is already added  ');
  } elseif ($alert == 4) {
    echo alerts('success', 'Successful ', ''.$class_name.' - '.$div_name.' deleted successsfully');
  } elseif ($alert == 5) {
    echo alerts('warning', 'Unsuccessful ', 'their is some problem class & division not deleted ');
  }
    ?>


    <div class="col-sm-12" id="mtable">
      <h4 class="display-4" id="innerhtml" style="text-align: center">Class and Division</h4>
      <br>



      <div class="row" id="addmore" style="display: none">
        <div class="col-lg-8 col-sm-12 offset-lg-2 card">


          <form action="#" method="POST" style="margin-top: 10px">
            <div class="row">

              <div class="form-group col-sm-6">
                <label for="sub_name">Class Name</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">@</span>
                  </div>

                  <input type="text" class="form-control" name="class_name" onkeyup="search(this);" id="sub_name"
                    placeholder="Enter Class Name" required="" />

                </div>
              </div>


              <div class="form-group col-sm-6">
                <label for="sub_name">Division Name</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">@</span>
                  </div>

                  <input type="text" class="form-control" name="div_name" id="sub_name"
                    placeholder="Enter Division Name" />

                </div>
              </div>



            </div>
            <input type="submit" class="mb-3 btn  text-light float-end"  style=" color: white; background:  #014e22  ; " name="sbt" value="Submit" />
          </form>
          <br />
        </div>
      </div>


      <br>



      <div class="container">
        <button class="btn bg-dark float-end" style="color:white;" onclick="addmore();">
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
            <th>example</th>
            <th>Division Name</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $sql = "SELECT * FROM `class` order by class_name desc";
          $result = mysqli_query($conn, $sql);
          $sno = 0;
          while ($row = mysqli_fetch_assoc($result)) {
            $sno = $sno + 1;
            echo '
          <tr>
          <td>' . $sno . '</td>
          <td>' . $row['class_name'] . '</td>
          <td>' . $row['div_name'] . '</td>
          <td>
              <form  action="#" method="POST">
                <div style="display:none;">
                  <input type="text" name="del_class_name" value="' . $row['class_name'] . '">
                  <input type="text" name="del_div_name" value="' . $row['div_name'] . '">
                </div>
                  <button value="del_class" class="btn-none" type="submit"><i class="bi bi-trash-fill text-danger"></i></button>
              </form>
            </td>
        </tr>
';
          }
          ?>

<!-- 

          <tr>
            <td>2</td>
            <td>FYIT</td>
            <td>B</td>
            <td><a href="deletecd.php?id=2"> <i class="bi bi-trash-fill text-danger"></i></td>
            <td>
              <form action="#" method="POST">
                <div style="display:none;">
                  <input type="text" name="del_class_name" value="a">
                  <input type="text" name="del_div_name" value="a">
                </div>
                <button value="del_class" class="btn-none" type="submit"><i
                    class="bi bi-trash-fill text-danger"></i></button>
              </form>
            </td>

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