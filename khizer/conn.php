<?php

/*
$servername = "sql207.epizy.com";
$serverusername = "epiz_33668293";
$serveruserpassword = "8L7OtcmjZ8NVxT";
$serverdatabase = "epiz_33668293_post";
*/
$servername = "localhost";
$serverusername = "root";
$serveruserpassword = "";
$serverdatabase = "khizer";

// Create a connection
$conn = mysqli_connect($servername, $serverusername, $serveruserpassword, $serverdatabase);

// Die if connection was not successful
if (!$conn) {
  die("Sorry we failed to connect: ". mysqli_connect_error());
}


function alerts($color, $sucs, $sucsdesc) {
  echo '<div class="alert alert-'.$color.' alert-dismissible fade show" role="alert">
  <strong> '. $sucs .'!</strong> '.$sucsdesc.'
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

?>