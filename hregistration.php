<!---
INSERT INTO `user`(`id`, `ucode`, `aadarno`, `location`, `email`, `phoneno`, `username`, `password`)
 VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8])

UPDATE `company`.`user_setting`
SET
`id` = <{id: }>,
`user_name` = <{user_name: }>,
`pass_word` = <{pass_word: }>,
`email` = <{email: }>,
`mobile` = <{mobile: }>,
`address` = <{address: }>,
`status` = <{status: }>
WHERE `id` = <{expr}>;

DELETE FROM `company`.`user_setting`
WHERE <{where_expression}>;
-->
<?php
require_once 'header.php';
require_once 'config.php';
$action = "";
if(isset($_REQUEST['action']))
{
	$action = $_REQUEST['action'];
}
?>
<?php
//Start of Insert/Edit operation
if(isset($_REQUEST['save']) or isset($_REQUEST['edit']))
{
	if( empty($_POST['username']) || empty($_POST['password'])|| empty($_POST['hcode']) || empty($_POST['hname']) )
    	{
        	echo "<div class='alert alert-danger'>Error: Please fille the details</div>";
    	}
	else{
	///Start of storing the value in the variable
        $hcode = $_POST['hcode'];
        $hname = $_POST['hname'];
        $location = $_POST['location'];
        $gstno = $_POST['gstno'];
		$username = $_POST['username'];
		$password = $_POST['password'];
   ///End of storing the value in the variable
   ///start of sql query
   		if(isset($_REQUEST['save']))
        {
        $sql = "INSERT INTO `hospital`(`hcode`, `hname`, `location`, `gstno`, `username`, `password`) VALUES('$hcode','$hname','$location','$gstno','$username','$password')";
		echo $sql;
    }
		else
		{
		 $id= $_REQUEST['id'];
		 $sql = "UPDATE `hospital` SET `hcode`='$hcode',`hname`='$hname',`location`='$location',`gstno`='$gstno',`username`='$username',`password`='$password' WHERE id='$id'";
		}
	///end of sql query
        	if( $con->query($sql) === TRUE)
			{   
			if(isset($_REQUEST['save']))
				echo "<div class='alert alert-success'>Successfully Updated Hospital Details</div>";
				echo"<script>window.location='hregistration.php'</script>";
       		 }
			 else
			{
            echo "<div class='alert alert-danger'>Error: There was an error while adding Hospital details</div>";
        	}
    	}
}
//End of Insert/Edit operation
if($action == 'delete')
{
	$id= $_REQUEST['id'];
		$sql = "DELETE FROM hospital WHERE id='$id'";  
	if( $con->query($sql) === TRUE)
			{   
			
				echo "<div class='alert alert-success'>Hospital Details Deleted Sucessfully</div>";
				echo"<script>window.location='hregistration.php'</script>";
       		 }
			 else
			{
            echo "<div class='alert alert-danger'>Error: There was an error while adding new user</div>";
        	}
}
?>
<div class="container-fluid">
   <h1 class="mt-4">Hospital Setting</h1>
   	<ol class="breadcrumb mb-4">
   		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
   		<li class="breadcrumb-item active">Hospital Settings</li>
   </ol>
<div class="card mb-8">
<div class="card mb-8">
<div class="card-body">
<?php if($action == 'edit' or $action == 'add' )
	{
		$id = $_REQUEST['id'];
		$sql = "SELECT * FROM hospital where id='$id'";
		$result = $con->query($sql);
		$row = $result->fetch_assoc()
?>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="box">
        	<form action="" method="POST" enctype="multipart/form-data" >
        	<label for="firstname">Hospital Code</label>
       		<input type="text" id="hcode" name="hcode" value="<?php if($action=="edit"){ echo $row['hcode'];}else { if(isset($_POST['hcode'])){echo $_POST['hcode'];}else{ echo "";}} ?>" class="form-control"><br>
        	<label for="lastname">Hospital Name</label>
        	<input type="text" name="hname" id="hname" value="<?php if($action=="edit"){ echo $row['hname'];}else {if(isset($_POST['hname'])){echo $_POST['hname'];}else{ echo "";}} ?>" class="form-control"><br>
        	<label for="address">Location</label>
       		<input type="text" name="location" id="location" value="<?php if($action=="edit"){ echo $row['location'];}else {echo "";} ?>" class="form-control"><br>		
        	<label for="address">GST No</label>
			<input type="text" name="gstno" id="gstno" value="<?php if($action=="edit"){ echo $row['gstno'];}else {echo "";} ?>" class="form-control"><br>
			<label for="address">User Name</label>
			<input type="text" name="username" id="username" value="<?php if($action=="edit"){ echo $row['username'];}else {echo "";} ?>" class="form-control"><br>
			<label for="address">Password</label>
			<input type="text" name="password" id="password" value="<?php if($action=="edit"){ echo $row['password'];}else {echo "";} ?>" class="form-control"><br>
			<label for="contact">Status</label>
<br>
<?php
	if($action=="edit")
  	{
?>
  <button type="submit" class="btn btn-success" name="edit" >Save</button>
<?php
  }
  else
  {
?>
    <button type="submit" class="btn btn-success" name="save" >Save</button>
<?php  
  }
  ?>
  <a href="hregistration.php" class='btn btn-danger'>Cancel</a>
</form>
    </div>
    </div>
<?php
	}
		else
			{
				$sql = "SELECT * FROM hospital";
					$result = $con->query($sql);
?>
<center><a href="hregistration.php?action=add&id=0" class="btn btn-primary">Add New Hospital</a>
</center>
<div class="card mb-4">
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr>
<th>Sl.No </th>
<th>Hospital code</th>
<th>Hospital Name</th>
<th>Location</th>
<th>GST No</th>
<th>User Name</th>
<th>Delete</th>
<th>Edit</th>
</tr>
</thead>
<tbody>
<?php
$sno=0;
    while( $row = $result->fetch_assoc())
	{
		echo "<tr>";
		echo "<td>". ++$sno . "</td>";
        echo "<td>".$row['hcode'] . "</td>";
        echo "<td>".$row['hname'] . "</td>";
        echo "<td>".$row['location'] . "</td>";
		echo "<td>".$row['gstno'] . "</td>";
		echo "<td>".$row['username'] . "</td>";
        echo "<td><a href='hregistration.php?action=edit&id=".$row['id']."' class='btn btn-info'>Edit</a></td>";
		echo "<td><a href='hregistration.php?action=delete&id=".$row['id']."' class='btn btn-danger'>Delete</a></td>";
        echo "</tr>";
    }
?>
</tbody>
</table>
<?php
	}
?>
</div>
</div>
</div>
</div>
 </div>
<?php
require_once 'footer.php';
?>