<?php

session_start();


if ($_SESSION['type'] != 2 ) {
  header("location: index.php");
}
include 'conn.php';




$alert = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // echo 'sjhs';
  if (isset($_POST['n_head']) and isset($_POST['n_desc'])) {
    // echo 'shs';

    $n_head = $_POST['n_head'];
    $n_desc = $_POST['n_desc'];

    $n_date = date("Y/m/d");

    $sql = "SELECT * FROM `notice` WHERE `heading` = '$n_head' AND `description` = '$n_desc' AND `date` = '$n_date'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    // echo $num ;
    if ($num >= 1) {

      $alert = 3;

    } else {

      $sql = "INSERT INTO `notice` (`sno`, `heading`, `description`, `date`, `time`) VALUES (NULL, '$n_head', '$n_desc', '$n_date', current_timestamp());";
      $result = mysqli_query($conn, $sql);
      if (!$result) {
        $alert = 2;

      } else {

        $alert = 1;

      }
    }
  }
  elseif (isset($_POST['e_head']) and isset($_POST['e_desc'])) {
    // echo 'shs';

    $e_head = $_POST['e_head'];
    $e_desc = $_POST['e_desc'];
    $e_date = $_POST['e_date'];
// echo $e_head,$e_desc,$e_date;
    $sql = "SELECT * FROM `event` WHERE `heading` = '$e_head' AND `describtion` = '$e_desc' AND `date` = '$e_date'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    // echo $num ;
    if ($num >= 1) {

      $alert = 3;

    } else {

      $sql = "INSERT INTO `event` (`sno`, `heading`, `describtion`, `date`, `time`) VALUES (NULL, '$e_head', '$e_desc', '$e_date', current_timestamp());";
      $result = mysqli_query($conn, $sql);
      if (!$result) {
        $alert = 2;

      } else {

        $alert = 1;

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


  <div class="container border p-5">

    <form action="#" method="POST">
      <div class="mb-3 ">
        <h4>Add Notice</h4><br>
        <label for="noticeheading" class="form-label">Notice Heading</label>
        <input type="text" class="form-control" name="n_head" id="noticeheading" required>
      </div>
      <div class="mb-3">
        <label for="noticedesc" class="form-label">Notice Description</label>
        <input type="text" class="form-control" name="n_desc" id="noticedesc" required>
      </div>

      <button type="submit" class="btn btn-primary float-end"  style=" color: white; background:  #014e22  ; " >Submit</button>
      <br>
    </form>
  </div>

  <br><br><br>

  <div class="container border p-5">

  <form action="#" method="POST">
      <div class="mb-3 ">
        <h4>Add Event</h4><br>
        <label for="eventheading" class="form-label">Event Heading</label>
        <input type="text" class="form-control" name="e_head" id="eventheading"  required>
      </div>
      <div class="mb-3">
        <label for="eventdesc" class="form-label">Event Description</label>
        <input type="text" class="form-control" name="e_desc" id="eventdesc" required>
      </div>
      <div class="mb-3">
        <label for="eventdate" class="form-label">Date Of Event</label>
        <input type="date" class="form-control" name="e_date" id="eventdate" required>
      </div>
<br>
      <button type="submit" class="btn btn-primary float-end"  style=" color: white; background:  #014e22  ; " >Submit</button>
      <br>
    </form>
  </div>

  <br><br><br>



  <div class="container border p-4" id="message">





    <br>
    <br>
    <h4 class="ps-4">Message</h4>
    <input class="form-control float-end" list="datalistOptions" onkeyup="search(this);" id="exampleDataList1"
      placeholder="Type to search...">


    <table class=" pt-4 pb-4 table table-dark" id="myTable">
      <thead>



        <tr>
          <th>Sr.no</th>
          <th>Name</th>
          <th>Email</th>
          <th>Message</th>
          <th>Time</th>
        </tr>
      </thead>
      <tbody>

        <?php
        $sql = "SELECT * FROM `message` order by time desc";
        $result = mysqli_query($conn, $sql);

        $sno = 0;
        while ($row = mysqli_fetch_assoc($result)) {
          $sno = $sno + 1;
          echo '

         <tr>
            <td>' . $sno . '</td>
            <td>' . $row['name'] . '</td>
            <td>' . $row['email'] . '</td>
            <td>' . $row['message'] . '</td>
            <td>' . $row['time'] . '</td>
          </tr>

';


        }
        ?>
        <!-- 
        <tr>
          <td>1</td>
          <td>yahya</td>
          <td>yahya@gmail.com</td>
          <td>this is my message</td>
          <td>11pm-5-april-2023</td>
        </tr> -->

      </tbody>
    </table>
    <br><br>

  </div>
  <br><br><br>


  <?php include 'footer.php'; ?>




  <!--  this is for data table  -->

  <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script> -->
   

<!--   
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script> -->

   
 

</body>

</html>