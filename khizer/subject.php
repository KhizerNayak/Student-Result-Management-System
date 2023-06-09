<?php


session_start();


if ($_SESSION['type'] != 2) {
  header("location: index.php");
}


include 'conn.php';




$alert = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // echo 'sjhs';
  if (isset($_POST['class&term']) and isset($_POST['sub_name'])) {
    // echo 'shs';

    $class_term = $_POST['class&term'];
    $sub_name = $_POST['sub_name'];

    $sql = "SELECT * FROM `term` WHERE `sno` = $class_term";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $class_name = $row['classname'] . ' - ' . $row['term'];


    $sql = "SELECT * FROM `subject` WHERE `classname` = '$class_name' AND `termno` = '$class_term' AND `subject` = '$sub_name'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    // echo $num ;
    if ($num >= 1) {
      $alert = 3;
    } else {

      // echo  $row['class_name'];
      // echo $class_div, $term_name, $class_name;
      $sql = "INSERT INTO `subject` (`sno`, `classname`, `termno`, `subject`, `time`) VALUES (NULL, '$class_name', '$class_term', '$sub_name', current_timestamp());";
      $result = mysqli_query($conn, $sql);
      if (!$result) {
        $alert = 2;

      } else {

        $alert = 1;

      }

    }

  }

  elseif (isset($_POST['del_class_name']) and isset($_POST['del_sub_name'])) {
    $class_name = $_POST['del_class_name'];
    $sub_name = $_POST['del_sub_name'];

  
    $sql = "DELETE FROM `subject`WHERE `classname` = '$class_name' AND `subject` = '$sub_name'";
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
     echo alerts('success', 'Successful ', ' '. $class_name.' - '.$sub_name.' added successfully');
   } elseif ($alert == 2) {
     echo alerts('danger', 'Unsuccessful ', 'there is some problems subject not added');
   } elseif ($alert == 3) {
     echo alerts('warning', 'Unsuccessful ', 'The '. $class_name.' - '.$sub_name.' is already added  ');
   } elseif ($alert == 4) {
     echo alerts('success', 'Successful ', ''. $class_name.' - '.$sub_name.' deleted successsfully');
   } elseif ($alert == 5) {
     echo alerts('warning', 'Unsuccessful', 'their is some problem subject not deleted ');
   }
     ?>

     

    <div class="col-sm-12" id="mtable">
      <h4 class="display-4" id="innerhtml" style="text-align: center">Subject List</h4>
      <br>



      <div class="row" id="addmore" style="display: none">
        <div class="col-lg-8 col-sm-12 offset-lg-2 card">
          <form action="" method="POST" style="margin-top: 10px">
            <div class="row">
              <div class="form-group col-sm-6">
                <label for="cd">Select Term</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="bi bi-list"></i></span>
                  </div>
                  <select class="custom-select" id="cd" name="class&term" required="">
                    <?php
                    $sql = "SELECT * FROM `term` order by time desc";
                    $result = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                      $c_name =  $row['classno'];
                      $sqls = "SELECT * FROM `term` order by time desc";
                      $results = mysqli_query($conn, $sqls);
                      $name = mysqli_fetch_assoc($results);
                      echo '
        <option value="' . $row['sno'] . '">' . $name['classname'] . ' - ' . $row['term'] . '</option>

';
                    }
                    ?>
                    <!-- <option value="2">FYIT - B : BE UNIT TEST 1</option> -->
                  </select>
                </div>
              </div>

              <div class="form-group col-sm-6">
                <label for="sub_name">Subject Name</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">@</span>
                  </div>
                  <input type="text" class="form-control" name="sub_name" id="sub_name" placeholder="Enter Subject Name"
                    required />
                </div>
              </div>
            </div>
            <input type="submit" class="btn text-light float-end"  style=" color: white; background:  #014e22  ; " name="sbt" value="Submit" />
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
            <th>Subect Name</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT * FROM `subject` order by termname desc";
          $result = mysqli_query($conn, $sql);
          $sno = 0;
          while ($row = mysqli_fetch_assoc($result)) {
            $classno =  $row['classno'] ;
           
            $sqls = "SELECT * FROM `class` WHERE `sno` = $classno";
            $results = mysqli_query($conn, $sqls);
            $name = mysqli_fetch_assoc($results);
            $sno = $sno + 1;
            echo '

      <tr>
					<td>' . $sno . '</td>
					<td>' . $name['class_name'] . ' - '. $row['termname'].'</td>
					<td>' . $row['subject'] . '</td>
          <td>
          <form  action="#" method="POST">
            <div style="display:none;">
              <input type="text" name="del_class_name" value="' . $row['classno'] . '">
              <input type="text" name="del_sub_name" value="' . $row['subject'] . '">
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
            <td>3</td>
            <td>FYIT-yahya - A</td>
            <td>JAVA</td>
            <td><a href="deletesub.php?id=3"><i class="fas fa-trash text-danger"></i></a></td>
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