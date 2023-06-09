<?php



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['msgname']) and isset($_POST['msgemail'])) {

      
      $name = $_POST['msgname'];
      $email = $_POST['msgemail'];
      $message = $_POST['msgcomment'];
      $sql = "INSERT INTO `message` (`sno`, `name`, `email`, `message`, `time`) VALUES (NULL, '$name', '$email', '$message', current_timestamp());";
      $result = mysqli_query($conn, $sql);

  } 


}

?>
<footer> 
    <div id="contact" class="container">
      <hr>
      <div class="contact">
        <div class="box1 box">
          <a class="reveal-inline-block" href="#">
            <img src="img/logo-1.png" alt="" width="170" height="172">
            <br>
            <div>
              <h6>M.S. College of Law </h6>
              <h7>Mumbra</h7>
            </div>
          </a>

        </div>

        <div class="box2 box">
          <h4>Contact us </h4>
          <hr>
          <div class="line1">
            <i class="bi bi-telephone-fill"></i>
            <h6 class="fw-light">022-254903000 / 0505 / 0909</h6>
          </div>
          <div class="line2">
            <i class="bi bi-geo-alt-fill"></i>
            <h6 class="fw-light">kadar palace ,  Kausa, Mumbra, Thane – 400612</h6>
          </div>
          <div class="line3">
            <i class="bi bi-envelope-open-fill"></i>
            <h6 class="lw-light text-danger"> example@gmail.com</h6>

          </div>

          <div class="line4">
            <i class="bi bi-facebook"></i>
            <i class="bi bi-instagram"></i>
            <i class="bi bi-twitter"></i>
            <i class="bi bi-google"></i>
          </div>
        </div>

        <div class="box3 box">
          <h4 style="padding-left: 10px ;">review</h4>
          <hr>
          <form action="#" method="post">
            <input type="text" class="form-control" name="msgname" id="msgname" aria-describedby="emailHelp"
              placeholder="name" required>
            <input type="email" class="form-control" name="msgemail" id="msgemail" aria-describedby="emailHelp"
              placeholder="email" required>
            <textarea class="form-control" placeholder="Leave a comment here" name="msgcomment" id="msgcomment" required></textarea>
            <button type="submit" class="btn btn-primary float-end"  style=" color: white; background:  #014e22  ; " >Submit</button>

          </form>

        </div>

      </div>

    </div>
  </footer>

  