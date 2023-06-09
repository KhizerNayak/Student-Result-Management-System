<?php
include 'conn.php';

session_start();


$thisfilename = "index.php";




$alert = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


  if (isset($_POST['del_notice_name']) and isset($_POST['del_notice_desc'])) {
    $notice_name = $_POST['del_notice_name'];
    $notice_desc = $_POST['del_notice_desc'];


    $sql = "DELETE FROM `notice`WHERE `heading` = '$notice_name' AND `description` = '$notice_desc'";

    $result = mysqli_query($conn, $sql);
    if (!$result) {
      $alert = 5;
    } else {
      $alert = 4;
    }
  } elseif (isset($_POST['del_event_name']) and isset($_POST['del_event_desc'])) {
    $event_name = $_POST['del_event_name'];
    $event_desc = $_POST['del_event_desc'];

echo$event_name,$event_desc;
    $sql = "DELETE FROM `event`WHERE `heading` = '$event_name' AND `describtion` = '$event_desc'";

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
    #logo1 {
      filter: drop-shadow(rgba(0, 0, 0, 0.7) 3px 3px 5px);
    }

    .notice {
      display: flex;
      flex-wrap: wrap;

      justify-content: center;
      padding-top: 30px;
      padding-bottom: 30px;
    }

    .notice .box {
      width: 400px;
      margin: 30px;
    }

    .snotice {
      display: block;
    }

    .notice .box .mhead {
      background: #0d2d62;
      color: white;
      padding: 8px;
      margin: 0;
    }

    .noticeboard {
      background: pink;
      padding: 0;
    }

    .noticeboard li {
      margin: none;
      list-style: none;
      border-top: 1px solid #b6b8b391;

      padding: 3px 6px;
      text-align: left;
      background: #f9f9f9;
    }

    .noticeboard li h4 {
      font-family: "Merriweather", "Times New Roman", Times, serif;
      color: #b80924;
    }

    .noticeboard li p {
      margin: 0;
      color: #888888;
    }

    .sevent li {
      display: flex;
    }

    .sevent li .date {
      background: #0d2d62;
      color: white;
      padding: 3px 15px;
      text-align: center;
      margin-right: 15px;
    }

    .about box1 {
      width: 1000px;
    }

    .about {
      display: flex;
      flex-wrap: wrap;

      margin-bottom: 70px;
      overflow: hidden;
    }

    .about .box1 {
      width: 200px;
      text-align: center;
    }

    .about .box {
      padding: 10px;
    }

    .about .box1 img {
      width: 150px;
    }

    .about .box2 {
      margin-left: 10px;
      width: 600px;
    }

    .about .box3 {
      background: #f9f9f9;
      width: 400px;
      padding: 10px;
      margin-left: 20px;
    }


    @media only screen and (max-width: 1000px) {


      .notice .box {
        margin: 20px auto 40px;
      }



      .about .box {
        margin: 20px auto;
      }



    }
  </style>
</head>

<body>
  <?php include 'nav.php';
  echo $nav_bar, $nav_logo; 
  
  
  ?>


  <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="img/corsl-img-2.png" class="d-block mx-auto w-100" alt="..." style="height: 30%; width: 100vw" />
      </div>
     
      <div class="carousel-item">
        <img src="img/corsl-img-3.png" class="d-block mx-auto w-100" alt="..." style="height: 30%; width: 100vw" />
      </div>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
      data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
      data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>


  <div class="container">


    <div class="container notice">
      <div class="box2 box snotice">


        <h4 class="fw-light mhead">Notice board </h4>
        <ul class="noticeboard">

          <?php
          $sql = "SELECT * FROM `notice` order by time desc";
          $result = mysqli_query($conn, $sql);

          $sno = 0;
          while ($sno == 10 or $row = mysqli_fetch_assoc($result)) {

            $sno = $sno + 1;

            ?>


            <li>
              <h4>
                <!-- <?php echo $row['heading']; ?>
                <?php


                if ($_SESSION['type'] == 2) {

                  ?>
                    <form action="#" method="POST">
                    <div style="display:none;">
                      <input type="text" name="del_notice_name" value="<?php echo $row['heading']; ?>">
                      <input type="text" name="del_notice_desc" value="<?php echo $row['description']; ?>">
                    </div>
                    <button value="del_class" class="btn-none float-end" type="submit"><i
                        class="bi bi-trash-fill text-danger"></i></button>
                  </form> 
                <?php } ?> 
              </h4>
              <p>
                <?php echo $row['description']; ?>
              </p>
              <br>

            </li>

            <?php





          }
          ?>
          <!--          
          <li>
            <h4>Khizer</h4>
            <p>this description </p>
          </li> -->

        </ul>

      </div>

      <div class="box3 box sevent">


        <h4 class="fw-light mhead">Events </h4>
        <ul class="noticeboard">


          <?php

          $current_date = date('Y-m-d');
          $sql = "DELETE FROM `event` WHERE `date` < '$current_date'";
          $result = mysqli_query($conn, $sql);


          $sql = "SELECT * FROM `event` order by date ASC";
          $result = mysqli_query($conn, $sql);
          $sno = 0;

          while ($sno == 10 or $row = mysqli_fetch_assoc($result)) {
            $sno = $sno + 1;
            $date = $row['date'];
            $date_arr = explode('-', $date);
            $day = $date_arr[2];
            $month_num = $date_arr[1];
            $month_name = date('F', mktime(0, 0, 0, $month_num, 10));


            ?>
            <li>
              <div class="date">
                <h3>
                  <?php echo $day; ?>
                </h3>
                <h6>
                  <?php echo $month_name; ?>
                </h6>
              </div>
              <div>
                <h4>
                  <?php echo $row['heading']; ?>
                </h4>
                <p>
                  <?php echo $row['describtion']; ?>
                </p>
              </div>
              <div class="container">
                <h4>
                  <?php


                  if ($_SESSION['type'] == 2) {

                    ?>
                    <form action="#" class="pt-4" method="POST">
                      <div style="display:none;">
                        <input type="text" name="del_event_name" value="<?php echo $row['heading'] ;?>">
                        <input type="text" name="del_event_desc" value="<?php echo $row['describtion'];?>">
                      </div>
                      <button value="del_class" class="btn-none float-end" type="submit"><i
                          class="bi bi-trash-fill text-danger"></i></button>
                    </form>

                  <?php } ?>
                </h4>
              </div>
            </li>

            <?php




          }
          ?>
          <!--           
        
          <li>
            <div class="date">
              <h3>28</h3>
              <h6>jul</h6>
            </div>
            <div>
              <h4>Khizer</h4>
              <p>this description </p>
            </div>
          </li> -->

        </ul>
      </div>



    </div>
    <hr>
  </div>


  <!-- about  -->

  <div class="about container">

    <div class="box1 box">
      <img src="img/noimg.jpg" alt="..." />
      <h4>Saima Ma'am</h4>
      <h6>
        principle <br />
        ms college of Degree
      </h6>
    </div>

    <div class="box2 box">
      <h3>From Principal's Desk</h3>
      <hr />
      <p style="text-align: justify">
        Welcome to M.S. College of Law which is affiliated to the 'University
        of Mumbai’ and is NAAC accredited also enjoys the recognition of the
        Bar Council- of India.<br /><br />The College is committed to render
        to its students the best of education in the field of Law and legal
        practice to enable them to be responsible lawyers to ensure the rule
        of law prevails in their society and the country in general.<br /><br />It
        will be our endeavor to take in to account the changes and
        developments taking place all-over the world so that our knowledge is
        in sync with that of the international community.<br /><br />Hope the
        regal-profession is given its due and treated with respect for which
        all of us should strive for.<br /><br />Good Luck.
      </p>
    </div>

    <div class="box3 box">
      <h4 class="text-bold">Mission</h4>
      <hr />
      <div class=" " style="color: #000">
        <strong>“Education for All”</strong><br />
        We admit students with low percentage and nurture them to improve in
        intelligence and wit by improving their performance and honing their
        skills in all respects for an overall development.<br />
        <br />
      </div>
      <br />
      <h4 class="text-bold">OUR VISION</h4>
      <hr />
      <div class=" " style="color: #000">
        The upliftment of Muslim Minority students through quality
        education.<br />
        <br />
      </div>
    </div>
  </div>

  <br /><br />

  <?php include 'footer.php'; ?>



</body>

</html>