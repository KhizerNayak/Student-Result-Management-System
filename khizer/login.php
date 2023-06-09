<?php

session_start();

include 'conn.php';
$alert=0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // echo 'sjhs';
    if (isset($_POST['login_user']) and isset($_POST['login_password'])) {
      // echo 'shs';
  
      $user = $_POST['login_user'];
      $pass = $_POST['login_password'];
      $sql = "SELECT * FROM `student` WHERE `username` = '$user' AND `password` = '$pass'";
      $result = mysqli_query($conn, $sql);
      $num = mysqli_num_rows($result);
      // echo $num ;
      if ($num >= 1) {
       
      $_SESSION['loggedin'] = true;
      $_SESSION['username'] = $user;
      $_SESSION['type'] = 1;
      // echo $_SESSION['username'] ;

      header("location:index.php");
        
      } else {
       $alert=1;
       
      }

  
    }

}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'headcontent.php'; ?>
  </head>
  <body>
  <?php include 'nav.php'; echo$nav_bar ?>


    <div class="container p-5 mt-5 border" style="background: #f5f5f5">

    <?php
   
  if ($alert == 1) {
     echo alerts('danger', 'Unsuccessful ', 'Check User and Password is Incorrect');
   } 
     ?>

      <h4 class="display-4 text-center">Student Login</h4>
      <form class="my-5" action="#" method="POST">
        <div class="mb-3">
          <label for="studentuserid1" class="form-label">Student UserID</label>
          <input
            type="text"
            class="form-control"
            name="login_user"
            id="studentuserid1"
            aria-describedby="emailHelp"
            required
          />
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label"
            >User Password</label
          >
          <input
            type="password"
            class="form-control"
            name="login_password"
            id="exampleInputPassword1"
            required
          />
        </div>
        <br />
        <button
          type="submit"
          class="btn btn-primary float-end me-3"
          style="color: white; background: #014e22"
        >
          Submit
        </button>
      </form>
    </div>
  </body>
</html>
