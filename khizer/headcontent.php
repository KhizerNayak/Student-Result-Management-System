<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Khizer</title>
<link href="cdn/bootstrap/bootstrap-5.3.0-alpha3-dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">


<link rel="stylesheet" href="cdn/bootstrap-icon/bootstrap-icons-1.10.4/font/bootstrap-icons.css">


<script src="cdn/bootstrap/bootstrap-5.3.0-alpha3-dist/js/bootstrap.bundle.min.js"
  integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>


<!-- data table  -->

<!-- table style -->
<link href="cdn/DataTables/datatables.min.css" rel="stylesheet" />

<!--   jquery  -->
<script src="cdn/jquery/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
  crossorigin="anonymous"></script>

<!-- data table script add after jquery  -->
<script src="cdn/DataTables/DataTables-1.13.4/js/jquery.dataTables.min.js"></script>

<!-- data table script  -->
<script>
  $(document).ready(function () {
    $("#myTable").DataTable();
  });
</script>

<!-- search button in data table script -->
<script>
  function addmore() {
    var a = document.getElementById("addmore");

    if (a.style.display == "none") {
      a.style.display = "block";
    } else {
      a.style.display = "none";
    }
  }
  //  for search  function 
  function search(a) {
    let value = a.value.toUpperCase();
    $("#myTable tbody tr").filter(function () {
      $(this).toggle($(this).text().toUpperCase().indexOf(value) > -1);
    });
  }

</script>

<!--  data table end  -->


<style>
  a {
    color: #8e9296;
  }

  .btn-none {
    background: none;
    color: inherit;
    border: none;
    padding: 0;
    font: inherit;

    outline: inherit;
  }

  #navmenu1:hover {
    border: none;
  }

  /* footer */
  footer .contact {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    padding-top: 40px;
  }



  footer .contact .box1 {
    display: flex;
    justify-content: center;
    padding: 20px;
    width: 250px;
  }

  footer .contact .box1 a {

    color: black;
    text-decoration: none;
  }

  footer .contact .box1 div {
    display: block;
    text-align: center;
  }

  footer .contact .box2 {
    width: 400px;
    padding: 20px;
  }

  footer .contact .box2 div {
    display: flex;
    align-items: center;
    padding: 5px 10px;
  }

  footer .contact .box2 div i {
    padding: 5px;
    margin-left: 5px;
    margin-right: 10px;
  }

  footer .contact .box3 {
    background: #f1f3f5;
    width: 500px;
    padding: 30px;
    border-radius: 20px;
  }

  footer .contact .box3 .form-control {
    margin: 20px 10px;
  }

  @media only screen and (max-width: 1000px) {


    footer .contact .box {
      margin: auto;
      display: block;
    }

  }

  button {
    color: white;
    background: #014e22;
  }
</style>