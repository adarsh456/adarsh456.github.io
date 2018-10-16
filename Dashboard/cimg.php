<?php
    require("../config/config.php");
    require("../config/db.php");

    session_start();
	//$aid = $_SESSION["aid"];
	
	$cid = $_GET['cid'];
	date_default_timezone_set('Asia/Kolkata');
	$h = date('H');
	$m = date('i');
	$s = date('s');

	$query = "SELECT * from images where cid = $cid";
	$result = mysqli_query($conn, $query);
	$images = mysqli_fetch_all($result,MYSQLI_ASSOC);

	if(isset($_POST['submit'])){
		
		$file=$_FILES['file'];//returns an Associative array


		$fileName = $file['name'];
		$fileType = $file['type'];
		$fileTmpName = $file['tmp_name'];
		$fileError = $file['error'];
		$fileSize= $file['size'];

		$fileExt = explode('.', $fileName);//breaks down the string in two parts
	
		$fileActExt = strtolower(end($fileExt));//makes the extension in lower case

		$allowed =array('png','jpeg','jpg');//this are allowed file extensions

		if(in_array($fileActExt, $allowed)){    //checks for the extension in array
			if($fileError === 0){				//error=0->file successfully uploaded
				if($fileSize < 8000000){		//size limit=8mb
					$fileNameNew =  $cid. "-" .$h. "-" .$m. "-" .$s.".".$fileActExt;	  
					  

					$fileDestination = 'uploads/'.$fileNameNew;

                    move_uploaded_file($fileTmpName, $fileDestination); 
                    $query = "INSERT into images(cid,imagename) VALUES('$cid','$fileNameNew')";
                    $result = mysqli_query($conn,$query);
                    header('Location:cimg.php?cid='.$cid);                                         
					
				}else{
					echo "the file is too big";
				}

			}else{
				echo "Error occured while uploading the file";
			}
		}else{
			echo "you cannot upload file of this extension";
		}
	}	
 ?>



<?php include('inc/header.php')?>

	<br>


	<form method="POST" action="<?php $_SERVER['PHP_SELF'] ;?>" enctype="multipart/form-data" style="margin-bottom:10px;" >
		<!--enctype='multipart/form-data is an encoding type that allows files to be sent through a POST. Quite simply, without this encoding the files cannot be sent through POST. If you want to allow a user to upload a file via a form, you must use this enctype.-->
		<input type="file" name="file">
		<button type="submit" name="submit">submit</button>
	</form>
	<table class="table mx-auto" style="width:70%;"> 
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Image</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($images as $image) : ?>
    <tr>
      <th><?php echo $image['iid']; ?></th>
      <td><img style="width:300px; height:200px;" src="uploads/<?php echo $image['imagename']; ?>"> </td>
	</tr>
	<?php endforeach; ?>
  </tbody>
</table>

    <?php include('inc/footer.php');?>