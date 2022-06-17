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
    Manage Gallery
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
          <li class="active">
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
            <p class="navbar-brand" href="#pablo" style="position: relative;left: 420px;">Manage Gallery</p>
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

              if($_GET['status']=="error"){

                echo "<div id='msgDia' class='alert alert-danger col-md-12'>
                      <button type='button' aria-hidden='true' class='close' data-dismiss='alert'>
                                            <i class='nc-icon nc-simple-remove'></i>
                                        </button>
                                        <span style='text-align:center;font-size:16px; font-weight:bold; position:relative;left:20px;'>Uploading failed!. Please select only image files.</span>
                      </div>";

                 echo "<script>

                       $(document).ready(function(){
                            
                          $('#msgDia').delay(3000).fadeOut('slow');
                          
                      });

                 </script>";
              }else if($_GET['status']=="success"){

                  echo "<div id='msgDia' class='alert alert-success col-md-12'>
                      <button type='button' aria-hidden='true' class='close' data-dismiss='alert'>
                                            <i class='nc-icon nc-simple-remove'></i>
                                        </button>
                                        <span style='text-align:center;font-size:16px; font-weight:bold; position:relative;left:20px;'>Gallery was updated successfully!</span>
                      </div>";

                 echo "<script>

                       $(document).ready(function(){
                            
                          $('#msgDia').delay(3000).fadeOut('slow');
                          
                      });

                      </script>";
              }
            }
          ?>

            <div class="jumbotron">
              <h3>Select Hotel</h3>
              <hr class="my-4">

              <form method="post" action="../../PHP/manageGallery.php" enctype="multipart/form-data">
                  
                  <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">District:</label>
                    <div class="col-sm-5">
                        
                      <select class="form-control" name="district" id="district">
                            
                            <option disabled selected value> -- Select an option -- </option>
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
                  </div>
                  
                  <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Available Hotels:</label>
                    <div class="col-sm-5">
                      
                      <select class="form-control" name="hotel" id="districtData">

                        <option disabled selected value> -- Select an option -- </option>

                      </select>
                    </div>
                  </div>

                  <div id="other" style="display: none;">

                  <div class="form-group row">

                    <label for="inputPassword" class="col-sm-2 col-form-label">Profile Picture:</label>
                    <div class="col-sm-5">
                      
                        <div class="file-field">
                              <div class="btn btn-primary btn-sm float-left">
                                <span>Choose Image</span>
                                <input type="file" accept="image/*" id="profile_picture_btn" name="profile_picture">
                              </div>
                        </div>

                    </div>

                  </div>

                  <div id="profile_picture" style="display: none; margin-bottom: 50px;" class="col-md-3">
                    
                    <img src="" style="position: relative;left: 155px;" class="img-thumbnail"  id="profile_picture_img">

                    <button type="button" style="position: relative;left: 213px;" id="profile_picture_cancelBtn" class="btn btn-danger">Cancel</button>

                  </div>


                  <div class="form-group row">

                    <label for="inputPassword" class="col-sm-2 col-form-label">Cover Photo:</label>
                    <div class="col-sm-5">
                      
                        <div class="file-field">
                              <div class="btn btn-primary btn-sm float-left">
                                <span>Choose Image</span>
                                <input type="file" accept="image/*" id="cover_photo_btn" name="cover_photo">
                              </div>
                        </div>

                    </div>

                  </div>

                <div id="cover_photo" style="display: none;">
                    
                    <img src="" style="height: 380px;width: 100%;" class="img-thumbnail"  id="cover_photo_img">

                    <button type="button" style="position: relative;left: 430px;" id="cover_photo_cancelBtn" class="btn btn-danger">Cancel</button>

                </div>


                  <div id="sliderPart" style="position:relative;top: 20px;">
                  
                       <h3>Select Slider Images</h3>
                       <hr class="my-4">

                        <div class="form-group row">
                              
                              <label for="inputPassword" class="col-sm-2 col-form-label">Slider Images:</label>
                              <div class="col-sm-5">
                                
                                  <div class="file-field">
                                        <div style="position: relative; top: -5px;" class="btn btn-primary btn-sm float-left">
                                          <span>Choose Images</span>
                                          <input type="file" accept="image/*" multiple id="slider-photo-add" name="slider_images[]">
                                        </div>
                                  </div>

                                  <div class="file-field">
                                      
                                        <button type="button" style="position: relative;left: 10px; top: -5px;display:none;" id="slider_img_cancelBtn" class="btn btn-danger btn-sm float-left">Clear All</button>   
                                        
                                  </div>

                              </div>
                              
                              <div class="slider" id="slider_id">
                                    


                              </div>
                        </div>
                  </div>  

                  <div id="gallery_part" style="position:relative;top: 60px;">
                    
                      <h3>Select Gallery Images</h3>
                      <hr class="my-4">

                      <div class="form-group row">
                              
                              <label for="inputPassword" class="col-sm-2 col-form-label">Gallery Images:</label>
                              <div class="col-sm-5">
                                
                                  <div class="file-field">
                                        <div style="position: relative; top: -5px;" class="btn btn-primary btn-sm float-left">
                                          <span>Choose Images</span>
                                          <input type="file" accept="image/*" multiple id="gallery-photo-add" name="gallery_images[]">
                                        </div>
                                  </div>

                                  <div class="file-field">
                                      
                                        <button type="button" style="position: relative;left: 10px; top: -5px;display:none;" id="gallery_img_cancelBtn" class="btn btn-danger btn-sm float-left">Clear All</button>   
                                        
                                  </div>

                              </div>
                              
                              <div class="gallery" id="gallery_id">
                                    


                              </div>
                        </div>

                    
                  </div> 

                  </div>  

                     <input type="submit" name="sub" id="submitBtns" class="btn btn-warning" value="Upload" style="position: relative;left: 440px; top: 100px;display: none; margin-bottom:50px;">
    
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

    document.getElementById("district").onchange = function(){

      document.getElementById("districtData").innerHTML="";
     
      document.getElementById("districtData").innerHTML=" <option disabled selected value> -- Select an option -- </option>";

        var val = this.value;

              $.ajax({

                    type:'POST',
                    data:{district:val},
                    url:'../../PHP/ManageGalleryAJAX.php', 
                    success:function(result){

                      for(var a=0;a< result.length;a++){

                          document.getElementById("districtData").innerHTML+='<option value="'+result[a]+'">'+result[a]+'</option>';
                      }
                       
                    },
                    dataType:"json"

              }); 
        
    }

    document.getElementById("profile_picture_btn").onchange = function(){

        var file    = document.getElementById('profile_picture_btn').files[0];
        var reader  = new FileReader();

        preview = document.getElementById("profile_picture_img");

        reader.onloadend = function () {
          document.getElementById("profile_picture").style.display = "block";
          preview.src = reader.result;

        }

        if (file) {
          reader.readAsDataURL(file);
        } else {
          preview.src = "";
        }
      
    }

    document.getElementById("profile_picture_cancelBtn").onclick=function(){

      var file = document.getElementById('profile_picture_btn').value = "";
      document.getElementById("profile_picture").style.display = "none";


    }

    document.getElementById("districtData").onchange = function(){


          if(this.value!=""){


            document.getElementById("other").style.display = "block";

          }


    }

    document.getElementById("cover_photo_btn").onchange = function(){

        var file    = document.getElementById('cover_photo_btn').files[0];
        var reader  = new FileReader();

        preview = document.getElementById("cover_photo_img");

        reader.onloadend = function () {
          document.getElementById("cover_photo").style.display = "block";
          preview.src = reader.result;

        }

        
        if (file) {
          reader.readAsDataURL(file);
        } else {
          preview.src = "";
        }

    }

    document.getElementById("cover_photo_cancelBtn").onclick = function(){

      var file = document.getElementById('cover_photo_btn').value = "";
      document.getElementById("cover_photo").style.display = "none";
    }


    $(function() {
    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {  

        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {

                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img class="col-md-3 sliders">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);

                    document.getElementById("slider_img_cancelBtn").style.display = "block";
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };

    $('#slider-photo-add').on('change', function() {
        imagesPreview(this, 'div.slider');
    });
});

    document.getElementById("slider_img_cancelBtn").onclick = function(){

      document.getElementById("slider_id").innerHTML = "";
      document.getElementById("slider-photo-add").value = "";
      document.getElementById("slider_img_cancelBtn").style.display = "none";

     
    }

  $(function() {
    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {  

        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {

                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img class="col-md-3 sliders">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);

                    document.getElementById("gallery_img_cancelBtn").style.display = "block";
                    document.getElementById("submitBtns").style.display = "block";
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };

    $('#gallery-photo-add').on('change', function() {
        imagesPreview(this, 'div.gallery');
    });
});

    document.getElementById("gallery_img_cancelBtn").onclick = function(){

      document.getElementById("gallery_id").innerHTML = "";
      document.getElementById("gallery-photo-add").value = "";
      document.getElementById("gallery_img_cancelBtn").style.display = "none";
      document.getElementById("submitBtns").style.display = "none";

     
    }

    

  </script>
</body>

</html>
