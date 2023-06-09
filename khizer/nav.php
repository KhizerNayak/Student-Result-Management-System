<?php

if (isset($_SESSION['loggedin']) and $_SESSION['loggedin'] == true) {
    $loggedin1 = '
    
    <a class="nav-link active float-start pe-5" aria-current="page" href="logout.php">
    <button class="btn  " style=" color: white; background:  #014e22  ; ">Logout</button>
</a> ';

}else{
    $loggedin1 = '
    <a class="nav-link active float-start pe-5" aria-current="page" href="login.php">
    <button class="btn  " style=" color: white; background:  #014e22  ; ">Login</button>
</a>
    ';
}

if (isset($_SESSION['type'] ) and $_SESSION['type'] == 2) {
    $adminlink1 = '

<li class="nav-item">
    <a class="nav-link active" aria-current="page" href="class.php">Class & Div</a>
</li>

<li class="nav-item">
    <a class="nav-link active" aria-current="page" href="term.php">Term</a>
</li>

<li class="nav-item">
    <a class="nav-link active" aria-current="page" href="subject.php">Subject</a>
</li>

<li class="nav-item">
    <a class="nav-link active" aria-current="page" href="student.php">Student</a>
</li>

<li class="nav-item">
    <a class="nav-link active" aria-current="page" href="notice.php">Notice</a>
</li>

<li class="nav-item">
    <a class="nav-link active" aria-current="page" href="notice.php#message">Messages</a>
</li>



';
} else {
    $adminlink1 = '';

}
$nav_bar = '

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Yahya</a>
            <button class="navbar-toggler" id="navmenu1" type="button" style="border:none;" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Dashboard</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="report.php">Report</a>
                    </li>
                    ' . $adminlink1 . '

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#contact">Contact us</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="about.php">About</a>
                    </li>

                </ul>
              '.$loggedin1.'
               


            </div>
        </div>
    </nav> ';


$nav_logo = '

    <div class="pt-5 pb-3 text-center">
        <img src="img/logo-1.png" id="logo1" class="rounded" alt="..." style="width:15%; ">
        <div class="unit-body text-xl-left">
            <div class="mt-3 ">
                <h4 class="fw-normal ">Habib Educational &amp; Welfare Society"s </h4>
            </div>
            <div class="mb-4 rd-navbar-brand-title">
                <h3 class="">M.S. College of Law </h3>
            </div>

        </div>
    </div>';

?>