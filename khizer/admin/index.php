<?php
session_start();
include '../conn.php';
if (isset($_SESSION['type']) and $_SESSION['type']==2) {
    header("location: ../index.php");
    //  header("location: ../index.php");
  }

$alert = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // echo 'sjhs';
    if (isset($_POST['login_user']) and isset($_POST['login_password'])) {
        // echo 'shs';

        $user = $_POST['login_user'];
        $pass = $_POST['login_password'];
        $sql = "SELECT * FROM `admin` WHERE `user` = '$user' AND `pass` = '$pass'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        // echo $num ;
        if ($num >= 1) {

            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $user;
            $_SESSION['type'] = 2;

            header("location: ../index.php");

        } else {
            $alert = 1;

        }


    }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>M.s College STDPR</title>
    <link href="../cdn/bootstrap/bootstrap-5.3.0-alpha3-dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">


    <link rel="stylesheet" href="../cdn/bootstrap-icon/bootstrap-icons-1.10.4/font/bootstrap-icons.css">


    <script src="../cdn/bootstrap/bootstrap-5.3.0-alpha3-dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>

</head>

<body>

<div class="container p-5 mt-5 border" style="background: #f5f5f5">
    <?php
   
  if ($alert == 1) {
     echo alerts('danger', 'Unsuccessful ', 'Check User and Password is Incorrect');
   } 
     ?>


        <h4 class="display-4 text-center">Admin Login</h4>
        <form class="my-5" action="#" method="POST">
            <div class="mb-3">
                <label for="studentuserid1" class="form-label">Admin UserID</label>
                <input type="text" class="form-control" name="login_user" id="studentuserid1"
                    aria-describedby="emailHelp" required />
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Admin Password</label>
                <input type="password" class="form-control" name="login_password" id="exampleInputPassword1" required />
            </div>
            <br />
            <button type="submit" class="btn btn-primary float-end me-3" style="color: white; background: #014e22">
                Submit
            </button>
        </form>
    </div>
</body>

</html>