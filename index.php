<?php
/*****this is to tweak*****/
$pass_check="12345";
$upload_local_dir="Z:/xampp/htdocs/upload/uploads";
$upload_url="/upload/uploads";
/*************************/

/***Actual code starts here...***/

$result ="";

if($_POST){

$uploadtype = $_POST['uploadtype'];
//get the url
$password = $_POST['password'];
$url = $_POST['url'];

if ($password == $pass_check)
{

 if (($uploadtype == "url") && (filter_var($url, FILTER_VALIDATE_URL)))
 {
  
    //add time to the current filename
	$result = "Error: invalid url";
	$path = parse_url($url, PHP_URL_PATH);
	if(!empty($path))
	{
      $file_ext = pathinfo($path, PATHINFO_EXTENSION);
	  $txt = basename(pathinfo($path,PATHINFO_BASENAME),".".$file_ext);
	  
	  $name = $txt.time();
	  if (!empty($file_ext))
	          $name = $name.".".$file_ext;
 
       $contents = file_get_contents($url);
	   
	   if ($contents != FALSE)
	   {
         $dir = $upload_local_dir."/".$name;
         $upload = file_put_contents($dir,$contents);   
  
         //check success
         if($upload)  {
         $result= "Success: <a href='".$upload_url."/".$name."' target='_blank'>File uploaded</a>";
         }
         else
         {
          $result= "Error: Please check free space and directory permissions...";
         }
	   }
	   else
	   {
	      $result = "Error: Download failed...";
	   }
	 }
  }
  elseif (($uploadtype == "file") && ( $_FILES['filebutton']['error'] !== UPLOAD_ERR_NO_FILE))
  {
      if(isset($_FILES['filebutton'])){
      $file_name = $_FILES['filebutton']['name'];
      $file_size =$_FILES['filebutton']['size'];
      $file_tmp =$_FILES['filebutton']['tmp_name'];
      $file_type=$_FILES['filebutton']['type'];
      $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
	  $txt = basename(pathinfo($file_name,PATHINFO_BASENAME),".".$file_ext);
      
	  $new_name = $txt.time();
	  if (!empty($file_ext))
	          $new_name = $new_name.".".$file_ext;
	  
	  if (move_uploaded_file($file_tmp,$upload_local_dir."/".$new_name))
	  {
      $result= "Success: <a href='".$upload_url."/".$new_name."' target='_blank'>File uploaded</a>";
      }
	  else
	  {
       $result= "Error: Cannot upload file!";
      }
   }
  }
  else
  {
     $result = "Probably you missed something...";
  }
}
else
{
$result =  "Error: Password does not match...";
}  

}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta content="text/html; charset=utf-8" http-equiv="content-type">
    <script type="text/javascript" src="http://code.jquery.com/jquery-3.1.0.slim.min.js"></script>
        <script type="text/javascript" src="js/code.js"></script>
     	<link rel="stylesheet" href="css/style.css" />
    <title>Image Uploader Script</title>
  </head>
  <body>
    <form class="form-horizontal" id="upload-form" method="post" enctype="multipart/form-data">
      <fieldset>
        <!-- Form Name -->
        <legend>Uploader</legend>
        
        <!-- Multiple Radios -->
        <div class="form-group"> <label class="col-md-4 control-label" for="uploadtype">Upload type</label>
          <div class="col-md-4">
            <div class="radio"> <label for="uploadtype-file"> <input name="uploadtype"

                  id="uploadtype-file" value="file" checked="checked" type="radio">
                Upload file </label> </div>
            <div class="radio"> <label for="uploadtype-url"> <input name="uploadtype"

                  id="uploadtype-url" value="url" type="radio"> Set URL </label>
            </div>
          </div>
		<hr>
        </div>
		
        <!-- Text input-->
        <div class="form-group" id="id_url"> <label class="col-md-4 control-label" for="url">Enter
            URL</label>
          <div class="col-md-4"> <input id="url_data" name="url" placeholder="http://funny.com/cat.jpg"

              class="form-control input-md" type="text"> <span class="help-block">Enter
              URL of image</span> </div>
		<hr>
        </div>
		
        <!-- File Button -->
        <div class="form-group" id="id_file"> <label class="col-md-4 control-label" for="filebutton">Select
            file to upload</label>
          <div class="col-md-4"> <input id="file_data" name="filebutton" class="input-file"

              type="file"> </div>
	    <hr>
        </div>
		
		<!-- Password input-->
        <div class="form-group"> <label class="col-md-4 control-label" for="password">Password</label>
          <div class="col-md-4"> <input id="password" name="password" placeholder="password"

              class="form-control input-md" required="" type="password"> <span

              class="help-block">Enter your password</span> </div>
		<hr>
        </div>
		
        <!-- Button -->
        <div class="form-group"> <label class="col-md-4 control-label" for="submit_button">Press
            to upload</label>
          <div class="col-md-4"> <button id="submit_button" name="submit_button"

              class="btn btn-primary">Process</button> </div>
        </div>
		
      </fieldset>
    </form>
	<div id="result">
	  <?php echo $result ?>
	</div>
    </body>
</html>
