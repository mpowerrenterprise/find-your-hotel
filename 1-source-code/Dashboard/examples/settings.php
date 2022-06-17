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
    Credentials Change
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

  <style>
    
    .sliders:hover{

      border: 2px solid red;
      

    }

    .sliders{

       margin-bottom:10px;

    }

    .pass_show{position: relative} 

    .pass_show .ptxt { 

    position: absolute; 

    top: 50%; 

    right: 10px; 

    z-index: 1; 

    color: #f36c01; 

    margin-top: -10px; 

    cursor: pointer; 

    transition: .3s ease all; 

    } 

.pass_show .ptxt:hover{color: #333333;} 

  </style>

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
          
          <li>
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
            <a href="./manage_gallery.php">
              <i class="nc-icon nc-tv-2"></i>
              <p>Preview</p>
            </a>
          </li>

          <li class="active">
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
            <p class="navbar-brand" href="#pablo" style="position: relative;left: 420px;">Credentials Change</p>
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

             <?php

              if(isset($_GET['status'])){

              if($_GET['status']=="curPass"){

                echo "<div id='msgDia' class='alert alert-danger col-md-12'>
                      <button type='button' aria-hidden='true' class='close' data-dismiss='alert'>
                                            <i class='nc-icon nc-simple-remove'></i>
                                        </button>
                                        <span style='text-align:center;font-size:16px; font-weight:bold; position:relative;left:20px;'>The Current Password is Wrong!</span>
                      </div>";

                 echo "<script>

                       $(document).ready(function(){
                            
                          $('#msgDia').delay(3000).fadeOut('slow');
                          
                      });

                 </script>";

              }else if($_GET['status']=="retypedPass"){

                echo "<div id='msgDia' class='alert alert-danger col-md-12'>
                      <button type='button' aria-hidden='true' class='close' data-dismiss='alert'>
                                            <i class='nc-icon nc-simple-remove'></i>
                                        </button>
                                        <span style='text-align:center;font-size:16px; font-weight:bold; position:relative;left:20px;'>The Confirm password does not match!</span>
                      </div>";

                 echo "<script>

                       $(document).ready(function(){
                            
                          $('#msgDia').delay(3000).fadeOut('slow');
                          
                      });

                 </script>";
              
              }else if($_GET['status'] == "success"){

                  echo "<div id='msgDia' class='alert alert-success col-md-12'>
                      <button type='button' aria-hidden='true' class='close' data-dismiss='alert'>
                                            <i class='nc-icon nc-simple-remove'></i>
                                        </button>
                                        <span style='text-align:center;font-size:16px; font-weight:bold; position:relative;left:20px;'>The Password Changed Successfully!.</span>
                      </div>";

                 echo "<script>

                       $(document).ready(function(){
                            
                          $('#msgDia').delay(3000).fadeOut('slow');
                          
                      });

                 </script>";

              }

            }
          ?>

          <div class="col-sm-4" style='position: relative;left: 340px;top: 30px;'>


            <form method="post" action="../../PHP/changePassword.php">
              
                <label>Current Password</label>
                <div class="form-group pass_show"> 
                      <input type="password" name="curPass"  class="form-control"> 
                  </div> 
                 
                 <label>New Password</label>
                  <div class="form-group pass_show"> 
                      <input type="password" name="newPass" class="form-control"> 
                  </div> 

                 <label>Confirm Password</label>
                  <div class="form-group pass_show"> 
                      <input type="password" name="comPass" class="form-control"> 
                  </div> 
                  <input type="submit" name="sub" style='position: relative;left: 106px;' value="Change" class="btn btn-success">

            </form>
                  
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

    $(document).ready(function(){
    $('.pass_show').append('<span class="ptxt">Show</span>');  
    });
      

    $(document).on('click','.pass_show .ptxt', function(){ 

    $(this).text($(this).text() == "Show" ? "Hide" : "Show"); 

    $(this).prev().attr('type', function(index, attr){return attr == 'password' ? 'text' : 'password'; }); 

    });  
     

  </script>
</body>

</html>
