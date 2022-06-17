<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotels";

$id = '';

$profile_success = "no";
$cover_success = "no";
$slider_success = "no";
$gallery_success = "no";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);

} 



	if(isset($_POST['sub'])){

		$profile_picture_path = "";
		$cover_photo_path = "";

		$profile_picture_image = $_FILES['profile_picture'];
		$profile_picture_image_name = $profile_picture_image['name'];
		$profile_picture_image_error = $profile_picture_image['error'];
		$profile_picture_image_temp = $profile_picture_image['tmp_name'];

		$profile_picture_image_fileExtension = explode('.',$profile_picture_image_name);

		$profile_picture_image_fileExtension = strtolower(end($profile_picture_image_fileExtension));

		$profile_picture_image_allowed_typed = array('jpg','png','gif','jpeg','bmp','tiff');

		$district = $_POST['district'];
		$hotel_name = $_POST['hotel'];
		



		$sql = "SELECT id FROM hotel_details WHERE district = '$district' AND hotel_name = '$hotel_name'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
    
		    while($row = $result->fetch_assoc()) {
		         
		         $id = $row["id"];

		   	}
		
		}



		if(in_array($profile_picture_image_fileExtension, $profile_picture_image_allowed_typed)){


			if (!file_exists('../Gallery_Images/'.$id)) {
    			
    			mkdir('../Gallery_Images/'.$id, 0777, true);

    			if (!file_exists('../Gallery_Images/'.$id.'/Slider')) {
    			
    				mkdir('../Gallery_Images/'.$id.'/Slider', 0777, true);
			
				}

				if (!file_exists('../Gallery_Images/'.$id.'/Gallery')) {
    			
    				mkdir('../Gallery_Images/'.$id.'/Gallery', 0777, true);
			
				}

				if (!file_exists('../Gallery_Images/'.$id.'/Profile_Picture')) {
    			
    				mkdir('../Gallery_Images/'.$id.'/Profile_Picture', 0777, true);
			
				}

				if (!file_exists('../Gallery_Images/'.$id.'/Cover_Photo')) {
    			
    				mkdir('../Gallery_Images/'.$id.'/Cover_Photo', 0777, true);
			
				}
			
			}

			if (!file_exists('../Gallery_Images_XML/'.$id)) {
    			
    			mkdir('../Gallery_Images_XML/'.$id, 0777, true);

    			if (!file_exists('../Gallery_Images_XML/'.$id.'/Slider')) {
    			
    				mkdir('../Gallery_Images_XML/'.$id.'/Slider', 0777, true);

    				fopen('../Gallery_Images_XML/'.$id.'/Slider/Data.json', "w") or die("Unable to open file!");
			
				}

				if (!file_exists('../Gallery_Images_XML/'.$id.'/Gallery')) {
    			
    				mkdir('../Gallery_Images_XML/'.$id.'/Gallery', 0777, true);

    				fopen('../Gallery_Images_XML/'.$id.'/Gallery/Data.json', "w") or die("Unable to open file!");
			
				}
			
			}

			//Upload Profile Picture. 
			$Profile_ex = explode(".",$profile_picture_image_name);
			$extension = end($Profile_ex);

			$Profile_pic_name = "profile.".$extension;
			move_uploaded_file($profile_picture_image_temp,"../Gallery_Images/".$id."/Profile_Picture/".$Profile_pic_name);
			$profile_picture_path = "../../Gallery_Images/".$id."/Profile_Picture/".$Profile_pic_name;
			$profile_success = "yes";
			


		}else{

			$Communication_protocol = $_SERVER['SERVER_PROTOCOL'];

			$Communication_protocol = explode ("/", $Communication_protocol); 
			$Communication_protocol = strtolower($Communication_protocol[0]);

			$Domain_name = $_SERVER['HTTP_HOST'];
		 	

			header("Location:".$Communication_protocol."://".$Domain_name."/Hotel_Info_With_Google_Map/Dashboard/examples/manage_gallery.php?status=error");
		}


		$cover_photo_image = $_FILES['cover_photo'];
		$cover_photo_image_name = $cover_photo_image['name'];
		$cover_photo_image_name_error = $cover_photo_image['error'];
		$cover_photo_image_name_temp = $cover_photo_image['tmp_name'];

		$cover_photo_image_name_fileExtension = explode('.',$cover_photo_image_name);

		$cover_photo_image_name_fileExtension = strtolower(end($cover_photo_image_name_fileExtension));

		$cover_photo_image_name_allowed_typed = array('jpg','png','gif','jpeg','bmp','tiff');


		if(in_array($cover_photo_image_name_fileExtension, $cover_photo_image_name_allowed_typed)){


			//Upload Profile Picture. 
			$cover_photo_ex = explode(".",$cover_photo_image_name);
			$cover_extension = end($cover_photo_ex);

			$cover_pic_name = "cover.".$cover_extension;
			move_uploaded_file($cover_photo_image_name_temp,"../Gallery_Images/".$id."/Cover_Photo/".$cover_pic_name);

			$cover_photo_path = "../../Gallery_Images/".$id."/Cover_Photo/".$cover_pic_name;

			$cover_success = 'yes';
			

		}else{


			$Communication_protocol = $_SERVER['SERVER_PROTOCOL'];

			$Communication_protocol = explode ("/", $Communication_protocol); 
			$Communication_protocol = strtolower($Communication_protocol[0]);

			$Domain_name = $_SERVER['HTTP_HOST'];
		 	

			header("Location:".$Communication_protocol."://".$Domain_name."/Hotel_Info_With_Google_Map/Dashboard/examples/manage_gallery.php?status=error");

		}

		$total = count($_FILES['slider_images']['name']);

		  $JSONFile = fopen("../Gallery_Images_XML/".$id."/Slider/Data.json", 'a');

		  fwrite($JSONFile, '{"Slider_Data":['.PHP_EOL."");

		  $failed_status = "no";

		for( $i=0; $i < $total ; $i++ ) {

			 //Get the temp file path
 			 $tmpFilePath = $_FILES['slider_images']['tmp_name'][$i];

 			   if ($tmpFilePath != ""){

 			   	$name = $_FILES['slider_images']['name'][$i];
 			   	$extension = explode('.',$name);
 			   	$extension = end($extension);

 			   	$extension = strtolower($extension);

 			   	$slider_images_allowed_typed = array('jpg','png','gif','jpeg','bmp','tiff');

 			if(in_array($extension, $slider_images_allowed_typed)){
			    
				    $newFilePath = "../Gallery_Images/".$id."/Slider/" . ($i+1).".".$extension;

				    //Upload the file into the temp dir
				    move_uploaded_file($tmpFilePath, $newFilePath);
				    
				    $slider_success = 'yes';

				    $data = array('picNum'=> ($i+1), 'url'=> '../../Gallery_Images/'.$id.'/Slider/' . ($i+1).".".$extension);

				    $AsJSONData = json_encode($data);

	        
				    if ($i == $total - 1) {
				     
				     	fwrite($JSONFile, '    '.$AsJSONData.PHP_EOL."");

				    }else{

						fwrite($JSONFile, '    '.$AsJSONData.','.PHP_EOL."");			    	
				    }
			 	  
			} else{

				$Communication_protocol = $_SERVER['SERVER_PROTOCOL'];

				$Communication_protocol = explode ("/", $Communication_protocol); 
				$Communication_protocol = strtolower($Communication_protocol[0]);

				$Domain_name = $_SERVER['HTTP_HOST'];

				fopen('../Gallery_Images_XML/'.$id.'/Slider/Data.json', 'w+');

				$slider_success='no';
			 	

				header("Location:".$Communication_protocol."://".$Domain_name."/Hotel_Info_With_Google_Map/Dashboard/examples/manage_gallery.php?status=error");

				}
			}

	}

		if($slider_success == "yes"){

			fwrite($JSONFile, ']}'.PHP_EOL."");

			$slider_images_path = "../Gallery_Images_XML/".$id."/Slider/Data.json";

			fclose($JSONFile);

		}

		  $total = count($_FILES['gallery_images']['name']);

		  $JSONFile = fopen("../Gallery_Images_XML/".$id."/Gallery/Data.json", 'a');

		  fwrite($JSONFile, '{"Gallery_Data":['.PHP_EOL."");

		for( $i=0; $i < $total ; $i++ ) {

			 //Get the temp file path
 			 $tmpFilePath = $_FILES['gallery_images']['tmp_name'][$i];

 			   if ($tmpFilePath != ""){

 			   	$name = $_FILES['gallery_images']['name'][$i];
 			   	$extension = explode('.',$name);
 			   	$extension = end($extension);

 			   	$extension = strtolower($extension);

 			   	$gallery_images_allowed_typed = array('jpg','png','gif','jpeg','bmp','tiff');


 			   	if(in_array($extension, $gallery_images_allowed_typed)){
			    
				    $newFilePath = "../Gallery_Images/".$id."/Gallery/" . ($i+1).".".$extension;

				    //Upload the file into the temp dir
				    move_uploaded_file($tmpFilePath, $newFilePath);
				    $gallery_success = 'yes';

				    $data = array('picNum'=> ($i+1), 'url'=> '../../Gallery_Images/'.$id.'/Gallery/' . ($i+1).".".$extension);

				    $AsJSONData = json_encode($data);

	        
				    if ($i == $total - 1) {
				     
				     	fwrite($JSONFile, '    '.$AsJSONData.PHP_EOL."");

				    }else{

						fwrite($JSONFile, '    '.$AsJSONData.','.PHP_EOL."");			    	
				    }
			 	  
			} else{

				$Communication_protocol = $_SERVER['SERVER_PROTOCOL'];

				$Communication_protocol = explode ("/", $Communication_protocol); 
				$Communication_protocol = strtolower($Communication_protocol[0]);

				$Domain_name = $_SERVER['HTTP_HOST'];

				fopen('../Gallery_Images_XML/'.$id.'/Slider/Data.json', 'w+');

				$gallery_success = "no";
			 	

				header("Location:".$Communication_protocol."://".$Domain_name."/Hotel_Info_With_Google_Map/Dashboard/examples/manage_gallery.php?status=error");

				}
 			   	
			}

	}

		if($gallery_success == "yes"){

			fwrite($JSONFile, ']}'.PHP_EOL."");

			$gallery_images_path = "../Gallery_Images_XML/".$id."/Gallery/Data.json";

			fclose($JSONFile);

		}

		
		if($profile_success == "yes" && $cover_success == "yes" && $slider_success == 'yes' && $gallery_success == 'yes'){

		    $sql2 = "UPDATE hotel_details SET gallery = 'true' where id = '$id'";
	 			   $conn->query($sql2);


	 	    $sql3 = "INSERT INTO gallery  VALUES ('','$id','$profile_picture_path','$cover_photo_path','$slider_images_path','$gallery_images_path')";
	 	    $conn->query($sql3);

	 		$Communication_protocol = $_SERVER['SERVER_PROTOCOL'];

			$Communication_protocol = explode ("/", $Communication_protocol); 
			$Communication_protocol = strtolower($Communication_protocol[0]);

			$Domain_name = $_SERVER['HTTP_HOST'];
		 	

			header("Location:".$Communication_protocol."://".$Domain_name."/Hotel_Info_With_Google_Map/Dashboard/examples/manage_gallery.php?status=success");

		}else{


			deleteDirectory("../Gallery_Images/".$id);
			deleteDirectory("../Gallery_Images_XML/".$id);
		 	
		}

}

function deleteDirectory($dir) {
    if (!file_exists($dir)) {
        return true;
    }

    if (!is_dir($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }

    }

    return rmdir($dir);
}


?>