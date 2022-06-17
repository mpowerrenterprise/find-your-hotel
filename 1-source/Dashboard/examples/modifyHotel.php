<?php

  session_start();

  if(isset($_SESSION['session_name'])==false && $_SESSION['session_name'] !="access_granted"){

    redirection();

  }


function redirection(){

    $Communication_protocol = $_SERVER['SERVER_PROTOCOL'];

    $Communication_protocol = explode ("/", $Communication_protocol); 
    $Communication_protocol = strtolower($Communication_protocol[0]);

    $Domain_name = $_SERVER['HTTP_HOST'];

    header("Location:".$Communication_protocol."://".$Domain_name."/Hotel_Info_With_Google_Map/admin_login.php"); 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Modify Hotels
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />

  <script src="../assets/js/core/jquery.min.js"></script>
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="../assets/img/logo-small.png">
          </div>
        </a>
        <a href="http://www.creative-tim.com" class="simple-text logo-normal">
          Admin
          <!-- <div class="logo-image-big">
            <img src="../assets/img/logo-big.png">
          </div> -->
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li>
            <a href="Dashboard.php" id="dashboard_id">
              <i class="nc-icon nc-bank"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li>
            <a href="RegisterHotel.php?status=no">
              <i class="nc-icon nc-single-copy-04"></i>
              <p>Register Hotels</p>
            </a>
          </li>
          <li class="active">
            <a href="modifyHotel.php">
              <i class="nc-icon nc-tag-content"></i>
              <p>Modify Hotels</p>
            </a>
          </li>
          <li>
            <a href="./manage_gallery.php">
              <i class="nc-icon nc-album-2"></i>
              <p>Create Gallery</p>
            </a>
          </li>

          <li>
            <a href="../../index.php" target="_blank">
              <i class="nc-icon nc-tv-2"></i>
              <p>Preview</p>
            </a>
          </li>

          <li>
            <a href="./settings.php">
              <i class="nc-icon nc-lock-circle-open"></i>
              <p>Settings</p>
            </a>
          </li>
          <li>
            <a href="logout.php" id="logout_id">
              <i class="nc-icon nc-spaceship"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <p class="navbar-brand" href="#pablo" style="position: relative;left: 420px;">Modify Hotels</p>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>

        </div>

      </nav>

      <div class="content">
        <div class="row">
          <div class="col-md-12">

                              <div class="card table-with-links">
                                <div class="card-body table-full-width">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th>Hotel Name</th>
                                                <th>Address</th>
                                                <th>District</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Website</th>
                                                <th>Latitude</th>
                                                <th>longitude</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
    <?php

              $servername = "localhost";
              $username = "root";
              $password = "";
              $dbname = "hotels";

              $conn = new mysqli($servername, $username, $password, $dbname);

              if ($conn->connect_error) {
              
                  die("Connection failed: " . $conn->connect_error);
              
              } 

              $sql = "SELECT * FROM hotel_details";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {

                  while($row = $result->fetch_assoc()) {
                     echo "<tr>";

                     echo "<td class='text-center id'>".$row['id']."</td>";

                     echo "<td>".$row['hotel_name']."</td>";

                     echo "<td>".$row['address']."</td>";

                     echo "<td>".$row['district']."</td>";

                     echo "<td>".$row['email']."</td>";

                     echo "<td>".$row['phone']."</td>";

                     echo "<td>".$row['website']."</td>";

                     echo "<td>".$row['lat']."</td>";

                     echo "<td>".$row['lng']."</td>";

                     echo "<td class='td-actions'>";

                     $Communication_protocol = $_SERVER['SERVER_PROTOCOL'];

				    $Communication_protocol = explode ("/", $Communication_protocol); 
				    $Communication_protocol = strtolower($Communication_protocol[0]);

				    $Domain_name = $_SERVER['HTTP_HOST'];


                     echo "<a href='".$Communication_protocol."://".$Domain_name."/Hotel_Info_With_Google_Map/Dashboard/examples/updateHotel.php?status=".$row['id']." ' rel='tooltip' class='fa fa-edit btn btn-success btn-link btn-xs' data-original-title='Edit Profile' name='update' data-id-value='ds'>";

                     echo "</a>";


                     echo "<a href='".$Communication_protocol."://".$Domain_name."/Hotel_Info_With_Google_Map/PHP/deleteHotel.php?status=".$row['id']."' rel='tooltip' name='delete' class='fa fa-times btn btn-danger btn-link btn-xs' data-original-title='Remove'>";

                     echo "</a>";

                     echo "</td>";

                     echo "</tr>";
                  
                  }

                }


    ?>

                </tbody>
              </table>
            </div>
          </div>
          </div>
        </div>
      </div>
      <footer class="footer footer-black  footer-white ">
        <div class="container-fluid">
          <div class="row">
            <div class="credits ml-auto">
              <span class="copyright">
                © 2019, made by G.Guna (Batch 03 BCAS Campus) 
              </span>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB4SGiAb7Y8Yle40rl3CokFQ2UlF62bBts"></script>
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->

  <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
  <script>
    $(document).ready(function() {
      demo.initGoogleMaps();
    });
  </script>

</body>

</html>
