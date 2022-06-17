<?php

	if(isset($_POST['sub'])){
		
		$district = $_POST['district'];
		$hotel = $_POST['hotel'];

		if($district == "" && $hotel == ""){

			$Communication_protocol = $_SERVER['SERVER_PROTOCOL'];

			$Communication_protocol = explode ("/", $Communication_protocol); 
			$Communication_protocol = strtolower($Communication_protocol[0]);

			$Domain_name = $_SERVER['HTTP_HOST'];

			header("Location:".$Communication_protocol."://".$Domain_name."/Hotel_Info_With_Google_Map/Dashboard/examples/SearchHotel.php?status=error");


		}else{

			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "hotels";

			$id = "";
			$hotel_name ="";

			$lat = "";
			$lng = "";
			$des = ""; 

			$conn = new mysqli($servername, $username, $password, $dbname);
			
			// Check connection
			
			if ($conn->connect_error) {

			    die("Connection failed: " . $conn->connect_error);

			} 

			$sql = "SELECT * FROM hotel_details WHERE district = '$district' && hotel_name = '$hotel'";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
			    
			    while($row = $result->fetch_assoc()) {
			        
			    	$id = $row['id'];
			    	$hotel_name = $row['hotel_name'];
			    	$district = $row['district'];
			    	$email_id = $row['email'];
			    	$phone = $row['phone'];
			    	$website = $row['website'];
			    	$address = $row['address'];
			    	$lat = $row['lat'];
			    	$lng = $row['lng'];
			    	$des = $row['description'];

			    }
			}

			$sql2 = "SELECT * FROM gallery where hotel_id = $id";
			$result2 = $conn->query($sql2);

			$profile_picture_path = '';
			$cover_photo_path = '';
			$slider_images_path = '';
			$gallery_images_path = '';


			if ($result2->num_rows > 0) {
			    
			    while($row = $result2->fetch_assoc()) {
			        
			    	$profile_picture_path = $row['profile_picture_path'];
			    	$cover_photo_path = $row['cover_photo_path'];
			    	$slider_images_path = $row['slider_image_path'];
			    	$gallery_images_path = $row['gallery_image_path'];

			    }
			}

			$json_data = file_get_contents("../$slider_images_path");
			$json_a = json_decode($json_data, true);

			$slider_length = count($json_a['Slider_Data']);

			$slider_images = array();

			for($i=0; $i < $slider_length; $i++){

				array_push($slider_images,$json_a["Slider_Data"][$i]['url']);
			}


			$json_data_2 = file_get_contents("../$gallery_images_path");
			$json_a_2 = json_decode($json_data_2, true);

			$gallery_length_2 = count($json_a_2['Gallery_Data']);

			$gallery_images = array();

			for($i=0; $i < $gallery_length_2; $i++){

				array_push($gallery_images,$json_a_2["Gallery_Data"][$i]['url']);
			}

		}

	}

?>

<!DOCTYPE html>
<html>
<head>
	
	<title>Information of the hotel</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!--===============================================================================================-->	
		<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
		<link rel="stylesheet" type="text/css" href="css/util.css">
		<link rel="stylesheet" type="text/css" href="css/main.css">
	<!--===============================================================================================-->
		<link href="../assets/css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
	<!--===============================================================================================-->

	  <link href="../assets/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
	<!--===============================================================================================-->


	<style>

		.btn:focus, .btn:active, button:focus, button:active {
		  outline: none !important;
		  box-shadow: none !important;
		}

		#image-gallery .modal-footer{
		  display: block;
		}

		.thumb{
		  margin-top: 15px;
		  margin-bottom: 15px;
		}

	</style>

</head>
<body>

		<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
		      <a class="navbar-brand" href="SearchHotel.php" style="position: relative;left: 550px;">The Sri Lankan Hotels</a>
		 
		      <div class="collapse navbar-collapse" id="navbarCollapse">

		        <form class="form-inline mt-2 mt-md-0">
			          <a style="position: relative;left: 925px;" class="btn btn-outline-success my-2 my-sm-0" href="../../index.php">Go to the website</a>

			          <a class="btn btn-outline-primary" style='color: red; position: relative;left:-387px;' href="SearchHotel.php">Go Back</a>
		        </form>

		      </div>
	    </nav>

	    <div>

		    <div class="jumbotron" style="height: 430px; margin-left: 50px; margin-right: 50px;">
		    	
		    	<img src="<?php echo $cover_photo_path;?>" style="height: 380px;width: 1186px; position: relative; top: -40px;border: 2px solid green;"></div>

		    </div>


		    <div class="jumbotron" style="height: 360px; width: 320px; margin-left: 50px; position: relative;top: -300px; left: 50px;">
		    	
		    	<img src="<?php echo $profile_picture_path;?>"   style="height: 310px;width: 280px; position: relative; top: -40px; left: -2px; border: 2px solid red;">
		    	<h4 style="position: relative;top: -110px; left: 300px;text-decoration: underline; font-weight: bold;"><?php echo $hotel_name?></h4>

		    </div>

	</div>

	<hr style="position: relative;top: -300px;">

	<div class=".container-fluid">

	<div class="col-md-10">
	
	<div class="limiter" style="position: relative;left:112px; top: -283px;">
		<div class="container-table100" style="background-color: #E9ECEF;">
			<h3 style="text-align: center;">Hotel Details</h3>
			<div class="wrap-table100">

					<div class="table">

						<div class="row header">
							<div class="cell">
								Attributes
							</div>
							<div class="cell" style="position: relative;left: 100px;">
								Information
							</div>
						</div>

						<div class="row">
							<div class="cell">
								<span style="font-weight: bold;">Hotel Name:</span> 
							</div>
							<div class="cell" style="position: relative;left: 100px;">
								<?php echo $hotel_name;?>
							</div>
						</div>

						<div class="row">
							<div class="cell">
								<span style="font-weight: bold;">District: </span>
							</div>
							<div class="cell" style="position: relative;left: 100px;">
								<?php echo $district;?>
							</div>
						</div>

						<div class="row">
							<div class="cell">
								
								<span style="font-weight:bold;">Email ID: </span>

							</div>
							<div class="cell" style="position: relative;left: 100px;">
								<?php echo $email_id;?>
							</div>
						</div>

						<div class="row">
							<div class="cell" style="font-weight: bold;">
								<span style="font-weight:bold;">Phone No: </span>
							</div>
							<div class="cell" style="position: relative;left: 100px;">
								<?php echo $phone;?>
							</div>
						</div>


						<div class="row">
							<div class="cell" style="font-weight: bold;">
								<span style="font-weight:bold;">Website: </span>
							</div>
							<div class="cell" style="position: relative;left: 100px;">
								<?php echo $website;?>
							</div>
						</div>

						<div class="row">
							<div class="cell" style="font-weight: bold;">
								<span style="font-weight:bold;">Address: </span>
							</div>
							<div class="cell" style="position: relative;left: 100px;">
								<?php echo $address;?>
							</div>
						</div>
					</div>
			</div>
		<div class="card text-white bg-success mb-3">
		  <div class="card-header"><h5 class="card-title">Description of the Hotel</h5></div>
		  <div class="card-body">    
		    <p class="card-text"><?php echo $des;?></p>
		  </div>
		</div>
		</div>
	</div>

	</div>

	<div class="col-md-10" style="position: relative;left: 115px; top: -240px;">
		
		<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
		  <div class="carousel-inner">

		  	<?php

		  		$htmlSliderData = array();

		  		for($i = 0; $i < $slider_length;$i++){

		  			if($i == 0){

		  			array_push($htmlSliderData,'<div class="carousel-item active">
				      <img class="d-block w-100" src="'.$slider_images[$i].'" style="height: 650px; border: 5px solid gray;">
				    </div>');
		  			}else{

		  			array_push($htmlSliderData,'<div class="carousel-item">
				      <img class="d-block w-100" src="'.$slider_images[$i].'" style="height: 650px; border: 5px solid gray;">
				    </div>');

		  			}

		  			

		  		}

		  		for($a = 0;$a < count($htmlSliderData); $a++){

		  			echo $htmlSliderData[$a];
		  		}

		  	?>

		  </div>
		  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
		    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
		  </a>
		  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
		    <span class="carousel-control-next-icon" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
		  </a>
		</div>

	</div>
	</div>

	<div class="container" style="position: relative;left: 28px;top: -200px;">
	<div class="row">
		<div class="row">

			<?php

				$gallery_images_arr = array(); 

				for($r=0; $r < $gallery_length_2;$r++){

					array_push($gallery_images_arr,'<div class="col-md-4">
		                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
		                   data-image="'.$gallery_images[$r].'"
		                   data-target="#image-gallery">
		                    <img class="img-thumbnail"
		                         src="'.$gallery_images[$r].'">
		                </a>
		            </div>');
				}

				for($t=0;$t < $gallery_length_2;$t++){

					echo $gallery_images_arr[$t];

				}

			?>

        </div>


        <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="image-gallery-title"></h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img id="image-gallery-image" class="img-responsive col-md-12" src="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary float-left" id="show-previous-image"><i class="fa fa-arrow-left"></i>
                        </button>

                        <button type="button" id="show-next-image" class="btn btn-secondary float-right"><i class="fa fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>

      <div class="content container" style="position: relative; top: -160px; left: 14px;">
        <div class="row">
          <div class="col-md-12">
            <div class="card" style="border: 1px solid black;">
              <div class="card-header ">
                Google Maps
              </div>
              <div class="card-body ">
                <div id="map" class="map"></div>
              </div>
            </div>
          </div>
        </div>
      </div>

		<footer class="navbar navbar-expand-md navbar-dark bg-dark" style="margin-bottom:-10px;">
		 
		 	<p style="color: white; position: relative;left: 340px; top: 3px;">Copyright ©2019 All rights reserved | This website was made by G.Guna (Batch 03)</p>
		      <div class="collapse navbar-collapse" id="navbarCollapse">

		        <form class="form-inline mt-2 mt-md-0">
			          <a style="position: relative;left: 620px;" class="btn btn-outline-success my-2 my-sm-0" href="../../index.php">Go to the website</a>

			          <a class="btn btn-outline-primary" style='color: red; position: relative;left: -690px;' href="SearchHotel.php">Go Back</a>
		        </form>

		      </div>
	    </footer>

	<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	
	<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	
	<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	
	<!--===============================================================================================-->
<script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
	<script src="js/main.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB4SGiAb7Y8Yle40rl3CokFQ2UlF62bBts"></script>
  <!-- Chart JS -->
   <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
    <script src="../assets/js/plugins/bootstrap-notify.js"></script>
	<script src="../assets/demo/demo2.js"></script>
<script>
    $(document).ready(function() {
      demo.initGoogleMaps(<?php echo $lat;?>,<?php echo $lng;?>);
    });
</script>

	<script>
		
let modalId = $('#image-gallery');

$(document)
  .ready(function () {

    loadGallery(true, 'a.thumbnail');

    //This function disables buttons when needed
    function disableButtons(counter_max, counter_current) {
      $('#show-previous-image, #show-next-image')
        .show();
      if (counter_max === counter_current) {
        $('#show-next-image')
          .hide();
      } else if (counter_current === 1) {
        $('#show-previous-image')
          .hide();
      }
    }

    /**
     *
     * @param setIDs        Sets IDs when DOM is loaded. If using a PHP counter, set to false.
     * @param setClickAttr  Sets the attribute for the click handler.
     */

    function loadGallery(setIDs, setClickAttr) {
      let current_image,
        selector,
        counter = 0;

      $('#show-next-image, #show-previous-image')
        .click(function () {
          if ($(this)
            .attr('id') === 'show-previous-image') {
            current_image--;
          } else {
            current_image++;
          }

          selector = $('[data-image-id="' + current_image + '"]');
          updateGallery(selector);
        });

      function updateGallery(selector) {
        let $sel = selector;
        current_image = $sel.data('image-id');
        $('#image-gallery-title')
          .text($sel.data('title'));
        $('#image-gallery-image')
          .attr('src', $sel.data('image'));
        disableButtons(counter, $sel.data('image-id'));
      }

      if (setIDs == true) {
        $('[data-image-id]')
          .each(function () {
            counter++;
            $(this)
              .attr('data-image-id', counter);
          });
      }
      $(setClickAttr)
        .on('click', function () {
          updateGallery($(this));
        });
    }
  });

// build key actions
$(document)
  .keydown(function (e) {
    switch (e.which) {
      case 37: // left
        if ((modalId.data('bs.modal') || {})._isShown && $('#show-previous-image').is(":visible")) {
          $('#show-previous-image')
            .click();
        }
        break;

      case 39: // right
        if ((modalId.data('bs.modal') || {})._isShown && $('#show-next-image').is(":visible")) {
          $('#show-next-image')
            .click();
        }
        break;

      default:
        return; // exit this handler for other keys
    }
    e.preventDefault(); // prevent the default action (scroll / move caret)
  });


	</script>


</body>
</html>