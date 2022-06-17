<!DOCTYPE html>
<html>
<head>
	
	<title>Search Available Hotels</title>
	<meta charset="utf-8">
	 <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
	 <script src="../assets/js/core/jquery.min.js"></script>

</head>
<body>

	<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
	      <a class="navbar-brand" href="SearchHotel.php" style="position: relative;left: 550px;">The Sri Lankan Hotels</a>
	 
	      <div class="collapse navbar-collapse" id="navbarCollapse">

	        <form class="form-inline mt-2 mt-md-0">
	          <a style="position: relative;left: 980px;" class="btn btn-outline-success my-2 my-sm-0" href="../../index.php">Go to the website</a>
	        </form>
	      </div>
    </nav>
     <?php

              if(isset($_GET['status'])){

              if($_GET['status']=="error"){

                echo "<div id='msgDia' style='position:relative;left:168px;' class='alert alert-danger col-md-9'>
                      <button type='button' aria-hidden='true' class='close' data-dismiss='alert'>
                                            <i class='nc-icon nc-simple-remove'></i>
                                        </button>
                                        <span style='text-align:center;font-size:16px; font-weight:bold; position:relative;left:20px;'>Please select a hotel!.</span>
                      </div>";

                 echo "<script>

                       $(document).ready(function(){
                            
                          $('#msgDia').delay(3000).fadeOut('slow');
                          
                      });

                 </script>";
              }
            }
          ?>

     <main role="main" class="container">
	      <div class="jumbotron" style="height: 400px;">

	     
	        <h2 style="text-align: center; position:relative;top: -30px;">Search for Hotel Availability</h2>

	        <div class="col-md-6">

	        <form method="post" action="preview.php">

		    <select style="position: relative;left: 280px; top:20px;" class="form-control" name="district" id="district">
	 			 
	 			  <option selected value=""> -- Select District -- </option>
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


			 <select style="position: relative;left: 280px; top:40px;"  name="hotel" id="districtData" class="form-control">
	 			 
	 			  <option selected value=""> -- Available Hotels -- </option>

			</select>

				<input type="submit" name="sub" style="position: relative;left: 425px;top: 90px;" value="Get Information" class="btn btn-success btn-lg">

			</form>

	        
	        
	      </div>
	      </div>
    </main>

    <script>
    	
      document.getElementById("district").onchange = function(){

      document.getElementById("districtData").innerHTML="";
     
      document.getElementById("districtData").innerHTML=" <option disabled selected value> -- Available Hotels -- </option>";

        var val = this.value;

              $.ajax({

                    type:'POST',
                    data:{district:val},
                    url:'../../PHP/ManageGalleryAJAX2.php', 
                    success:function(result){

                      for(var a=0;a< result.length;a++){

                          document.getElementById("districtData").innerHTML+='<option value="'+result[a]+'">'+result[a]+'</option>';
                      }
                       
                    },
                    dataType:"json"

              }); 
        
    }


    </script>

</body>
</html>