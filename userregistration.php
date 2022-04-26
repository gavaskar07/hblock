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
	if( empty($_POST['username']) || empty($_POST['password'])|| empty($_POST['email']) || empty($_POST['phoneno']) )
    	{
        	echo "<div class='alert alert-danger'>Error: Please fille the details</div>";
    	}
	else{
	///Start of storing the value in the variable
        $ucode = $_POST['ucode'];
        $aadarno = $_POST['aadarno'];
        $location = $_POST['location'];
        $email = $_POST['email'];
		$phoneno = $_POST['phoneno'];
		$username = $_POST['username'];
		$password = $_POST['password'];
   ///End of storing the value in the variable
   ///start of sql query
   		if(isset($_REQUEST['save']))
        {
        $sql = "INSERT INTO `user`(`ucode`, `aadarno`, `location`, `email`, `phoneno`, `username`, `password`)VALUES('$ucode','$aadarno','$location','$email','$phoneno','$username','$password')";
		}
		else
		{
		 $id= $_REQUEST['id'];
		 $sql = "UPDATE `user` SET `ucode`='$ucode',`aadarno`='$aadarno',`location`='$location',`email`='$email',`phoneno`='$phoneno',`username`='$username',`password`='$password' WHERE id='$id'";
		}
	///end of sql query
        	if( $con->query($sql) === TRUE)
			{   
			if(isset($_REQUEST['save']))
				echo "<div class='alert alert-success'>Successfully Updated User Details</div>";
				echo"<script>window.location='userregistration.php'</script>";
       		 }
			 else
			{
            echo "<div class='alert alert-danger'>Error: There was an error while adding user details</div>";
        	}
    	}
}
//End of Insert/Edit operation
if($action == 'delete')
{
	$id= $_REQUEST['id'];
		$sql = "DELETE FROM user WHERE id='$id'";  
	if( $con->query($sql) === TRUE)
			{   
			
				echo "<div class='alert alert-success'>User Details Deleted Sucessfully</div>";
				echo"<script>window.location='userregistration.php'</script>";
       		 }
			 else
			{
            echo "<div class='alert alert-danger'>Error: There was an error while adding new user</div>";
        	}
}
?>
<div class="container-fluid">
   <h1 class="mt-4">User Setting</h1>
   	<ol class="breadcrumb mb-4">
   		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
   		<li class="breadcrumb-item active">User Settings</li>
   </ol>
<div class="card mb-8">
<div class="card mb-8">
<div class="card-body">
<?php if($action == 'edit' or $action == 'add' )
	{
		$id = $_REQUEST['id'];
		$sql = "SELECT * FROM user where id='$id'";
		$result = $con->query($sql);
		$row = $result->fetch_assoc()
?>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="box">
        	<form action="" method="POST" enctype="multipart/form-data" >
        	<label for="firstname">User Code</label>
       		<input type="text" id="ucode" name="ucode" value="<?php if($action=="edit"){ echo $row['ucode'];}else { if(isset($_POST['ucode'])){echo $_POST['ucode'];}else{ echo "";}} ?>" class="form-control"><br>
        	<label for="lastname">Aaadar No</label>
        	<input type="text" name="aadarno" id="aadarno" value="<?php if($action=="edit"){ echo $row['aadarno'];}else {if(isset($_POST['aadarno'])){echo $_POST['aadarno'];}else{ echo "";}} ?>" class="form-control"><br>
        	<label for="address">Location</label>
       		<input type="text" name="location" id="location" value="<?php if($action=="edit"){ echo $row['location'];}else {echo "";} ?>" class="form-control"><br>		
        	<label for="contact">E-Mail</label>
        	<input type="text" name="email" id="email" value="<?php if($action=="edit"){ echo $row['email'];}else {echo "";} ?>" class="form-control"><br>
        	<label for="address">Mobile No</label>
			<input type="text" name="phoneno" id="phoneno" value="<?php if($action=="edit"){ echo $row['phoneno'];}else {echo "";} ?>" class="form-control"><br>
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
  <a href="userregistration.php" class='btn btn-danger'>Cancel</a>
</form>
    </div>
    </div>
<?php
	}
		else
			{
				$sql = "SELECT * FROM user";
					$result = $con->query($sql);
?>
<center><a href="userregistration.php?action=add&id=0" class="btn btn-primary">Add New User</a>
</center>
<div class="card mb-4">
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr>
<th>Sl.No </th>
<th>User Code</th>
<th>Aaadar No</th>
<th>Location</th>
<th>E-Mail</th>
<th>Mobile No</th>
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
        echo "<td>".$row['ucode'] . "</td>";
        echo "<td>".$row['aadarno'] . "</td>";
        echo "<td>".$row['location'] . "</td>";
		echo "<td>".$row['email'] . "</td>";
		echo "<td>".$row['phoneno'] . "</td>";
		echo "<td>".$row['username'] . "</td>";
        echo "<td><a href='userregistration.php?action=edit&id=".$row['id']."' class='btn btn-info'>Edit</a></td>";
		echo "<td><a href='userregistration.php?action=delete&id=".$row['id']."' class='btn btn-danger'>Delete</a></td>";
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