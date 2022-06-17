<?php

  session_start();

  $_SESSION['session_name'] = "access_granted";

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
    Update Hotels Details
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
          <li class="active">
            <a href="RegisterHotel.php?status=no">
              <i class="nc-icon nc-single-copy-04"></i>
              <p>Register Hotels</p>
            </a>
          </li>
          <li>
            <a href="modifyHotel.php">
              <i class="nc-icon nc-tag-content"></i>
              <p>Modify Hotels</p>
            </a>
          </li>
          <li>
            <a href="./manage_gallery.php">
              <i class="nc-icon nc-album-2"></i>
              <p>Manage Gallery</p>
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
            <p class="navbar-brand" href="#pablo" style="position: relative;left: 420px;">Update Hotels Details</p>
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
          <div class="col-md-8">

          <?php

              if($_GET['status']=="success"){

                echo "<div id='msgDia' class='alert alert-success' style='position:relative; left:190px;'>
                      <button type='button' aria-hidden='true' class='close' data-dismiss='alert'>
                                            <i class='nc-icon nc-simple-remove'></i>
                                        </button>
                                        <span style='text-align:center;font-size:16px; font-weight:bold; position:relative;left:20px;'>Data Inserted Successfully!.</span>
                      </div>";

                 echo "<script>

                       $(document).ready(function(){
                            
                          $('#msgDia').delay(3000).fadeOut('slow');
                          
                      });

                 </script>";
              }
          ?>

            <div class="card stacked-form" style="position: relative;left: 190px;">
              
              <div class="card-body"> 

                <form method="post" action="../../PHP/updateHotelData.php">

                  <input type="text" style="display:none" id="idofupdate" name="idofupdate">
                  
                  <div class="form-group">
                      <label>Hotel Name</label>
                      <input type="text"  id="hotel_name" class="form-control" name="hotel_name">
                  </div>

                  <div class="form-group">
                      <label>Address</label>
                      <input type="text"  class="form-control" id="address" name="address">
                  </div>

                  <div class="form-group">
                      <label>District</label>
                      
                      <select class="form-control" id="district" name="district">
                      
                            <option value="Ampara">Ampara</option>  
                            <option value="Anuradhapura">Anuradhapura</option>
                            <option value="Badulla">Badulla</option>
                            <option value="Batticaloa">Batticaloa</option>
                            <option value="Colombo">Colombo</option>
                            <option value="Galle">Galle</option>
                            <option value="Gampaha">Gampaha</option>
                            <option value="Hambantota">Hambantota</option>
                            <option value="Jaffna">Jaffna</option>
                            <option value="Kandy">Kandy</option>
                            <option value="Kegalle">Kegalle</option>
                            <option value="Kilinochchi">Kilinochchi</option>
                            <option value="Kurunegala">Kurunegala</option>
                            <option value="Mannar">Mannar</option>
                            <option value="Matale">Matale</option>
                            <option value="Monaragala">Monaragala</option>
                            <option value="Mullaitivu">Mullaitivu</option>
                            <option value="Nuwara Eliya">Nuwara Eliya</option>
                            <option value="Polonnaruwa">Polonnaruwa</option>
                            <option value="Puttalam">Puttalam</option>
                            <option value="Ratnapura">Ratnapura</option>
                            <option value="Trincomalee">Trincomalee</option>
                            <option value="Vavuniya">Vavuniya</option>


                      </select>
                      
                  </div>

                  <div class="form-group">
                      <label>Email</label>
                      <input type="email" id="email" class="form-control" name="email">
                  </div>

                  <div class="form-group">
                      <label>Phone No</label>
                      <input type="text" class="form-control" name="phone" id="phone_no">
                  </div>


                  <div class="form-group">
                      <label>Website</label>
                      <input type="text"class="form-control" id="website" name="website">
                  </div>

                  <div class="form-group">
                      <label>Latitude</label>
                      <input type="text"  class="form-control" name="latitude" id="latitude">
                  </div>

                  <div class="form-group">
                      <label>Longitude</label>
                      <input type="text" class="form-control" name="longitude" id="longitude">
                  </div>


                  <input type="submit" value="Update" style="text-align: center;position: relative;left: 250px;" class="btn btn-success btn-wd" name="sub">

                </form>

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

  <script type="text/javascript">

    document.getElementById("phone_no").oninput = function(){

      var inputValue = this.value;
      var reg = new RegExp('^[0-9+]+$');
      rexVallue = reg.test(inputValue);

      if(rexVallue == false){

        this.value = "";
      }

    }

    document.getElementById("latitude").oninput = function(){

          var inputValue = this.value;
          var reg = new RegExp('^[0-9.]+$');
          rexVallue = reg.test(inputValue);

          if(rexVallue == false){

            this.value = "";
          }
    }


    document.getElementById("longitude").oninput = function(){

          var inputValue = this.value;
          var reg = new RegExp('^[0-9.]+$');
          rexVallue = reg.test(inputValue);

          if(rexVallue == false){

            this.value = "";
          }
    }

    <?php

        $id = $_GET['status'];

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "hotels";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {

          die("Connection failed: " . $conn->connect_error);
        
        }

        $sql = "SELECT * FROM hotel_details WHERE id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
    
            while($row = $result->fetch_assoc()) {

              echo "
              document.getElementById('idofupdate').value = '".$row['id']."'
              document.getElementById('hotel_name').value = '".$row['hotel_name']."'
              document.getElementById('address').value = '".$row['address']."'
              document.getElementById('district').value = '".$row['district']."'
              document.getElementById('email').value = '".$row['email']."'
              document.getElementById('phone_no').value = '".$row['phone']."'
              document.getElementById('website').value = '".$row['website']."'
              document.getElementById('latitude').value = '".$row['lat']."'
              document.getElementById('longitude').value = '".$row['lng']."'


              ";
            
            }

        }

    ?>

  </script>
</body>

</html>
