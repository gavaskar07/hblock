<?php
require_once 'header.php';
require_once 'config.php';
$type= $_GET['type'];
?>
<div class="container-fluid">
   <h1 class="mt-4">Import Data From Excel-<?php echo $_GET['type']; ?></h1>
   	<ol class="breadcrumb mb-4">
   		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
   		<li class="breadcrumb-item active">Import Data From Excel-<?php echo $_GET['type']; ?></li>
   </ol>
<div class="card mb-8">
<div class="card mb-8">
<div class="card-body">
<?php

if(isset($_POST['Import']))
{
$type=$_POST['type'];
	
if($type=="user_setting")
{
    echo $filename=$_FILES["file"]["tmp_name"];
	if($_FILES["file"]["size"] > 0)
		{

		  	$file = fopen($filename, "r");
	         while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
			   $sql = "INSERT INTO user_setting(user_name,pass_word,email,mobile,address,status)VALUES('$emapData[0]','$emapData[1]','$emapData[2]','$emapData[3]','$emapData[4]','$emapData[5]')";
			   echo $sql. "</br>";
			   $con->query($sql);
			 }
			 echo "<div class='alert alert-success'>User Details Uploaded Sucessfully</div>";
			 echo "<script>window.location='user_setting.php'</script>";
		}
}
else if($type=="masters")
{
 echo $filename=$_FILES["file"]["tmp_name"];
	if($_FILES["file"]["size"] > 0)
		{

		  	$file = fopen($filename, "r");
	         while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
			   $sql = "INSERT INTO masters(mcontent,status) VALUES('$emapData[0]','$emapData[1]')";
			   echo $sql. "</br>";
			   $con->query($sql);
			 }
			 echo "<div class='alert alert-success'>Masters  Details Uploaded Sucessfully</div>";
			 echo "<script>window.location='masters.php'</script>";
}
}
else if($type=="achievement")
{
 echo $filename=$_FILES["file"]["tmp_name"];
	if($_FILES["file"]["size"] > 0)
		{

		  	$file = fopen($filename, "r");
	         while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
			   $sql = "INSERT INTO achievement(achievement_type_id,aname,ano,acategory,adate,vyear,alink,aexam,image_url)VALUES('$emapData[0]','$emapData[1]','$emapData[2]','$emapData[3]','$emapData[4]','$emapData[5]','$emapData[6]','$emapData[7]','$emapData[8]')";
			   echo $sql. "</br>";
			   $con->query($sql);
			 }
			 echo "<div class='alert alert-success'>Achievements Details Uploaded Sucessfully</div>";
			 echo "<script>window.location='achievement.php'</script>";
}
}	
else if($type=="achievement_type")
{
 echo $filename=$_FILES["file"]["tmp_name"];
	if($_FILES["file"]["size"] > 0)
		{

		  	$file = fopen($filename, "r");
	         while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
			   $sql = "INSERT INTO achievement_type(a_type)VALUES('$emapData[0]')";
			   echo $sql. "</br>";
			   $con->query($sql);
			 }
			 echo "<div class='alert alert-success'>Achievement type Details Uploaded Sucessfully</div>";
			 echo "<script>window.location='achievement_type.php'</script>";
}
}	
else if($type=="article_blog")
{
 echo $filename=$_FILES["file"]["tmp_name"];
	if($_FILES["file"]["size"] > 0)
		{

		  	$file = fopen($filename, "r");
	         while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
			   $sql = "INSERT INTO article_blog(user_setting_id,a_name,pdate,tags,content,type)VALUES('$emapData[0]','$emapData[1]','$emapData[2]','$emapData[3]','$emapData[4]','$emapData[5]')";
			   echo $sql. "</br>";
			   $con->query($sql);
			 }
			 echo "<div class='alert alert-success'>Article Details Uploaded Sucessfully</div>";
			 echo "<script>window.location='article_blog.php'</script>";
}
}	
else if($type=="appointment")
{
 echo $filename=$_FILES["file"]["tmp_name"];
	if($_FILES["file"]["size"] > 0)
		{

		  	$file = fopen($filename, "r");
	         while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
			   $sql = "INSERT INTO appointment(adate,a_from,a_to,a_subject,a_description,a_email,a_mobileno)VALUES('$emapData[0]','$emapData[1]','$emapData[2]','$emapData[3]','$emapData[4]','$emapData[5]','$emapData[6]')";
			   echo $sql. "</br>";
			   $con->query($sql);
			 }
			 echo "<div class='alert alert-success'>Appointment Details Uploaded Sucessfully</div>";
			 echo "<script>window.location='appointment.php'</script>";
}
}		
else if($type=="legends")
{
 echo $filename=$_FILES["file"]["tmp_name"];
	if($_FILES["file"]["size"] > 0)
		{

		  	$file = fopen($filename, "r");
	         while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
			   $sql = "INSERT INTO legends(l_name,email,mobile,address,biodata,t_known,status)VALUES('$emapData[0]','$emapData[1]','$emapData[2]','$emapData[3]','$emapData[4]','$emapData[5]','$emapData[6]')";
			   echo $sql. "</br>";
			   $con->query($sql);
			 }
			 echo "<div class='alert alert-success'>legends Details Uploaded Sucessfully</div>";
			 echo "<script>window.location='legends.php'</script>";
}
}		
}
?>


<form action="" method="post" name="upload_excel" enctype="multipart/form-data">
					<fieldset>
						<legend>Import CSV/Excel file</legend>
						<div class="control-group">
							<div class="controls">
								<input type="file" name="file" id="file" class="input-large">
							</div>
						</div>
						<input type="hidden" name="type" value="<?php echo $_GET['type']; ?>"/>
						<div class="control-group">
							<div class="controls">
							<button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Upload</button>
							</div>
						</div>
					</fieldset>
				</form>
				</div>
</div>
</div>
</div>
 </div>
<?php
require_once 'footer.php';
?>