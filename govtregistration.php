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
        $sql = "INSERT INTO `agency`( `gcode`, `gname`, `state`, `country`, `username`, `password`)  VALUES('$hcode','$hname','$location','$gstno','$username','$password')";
		echo $sql;
    }
		else
		{
		 $id= $_REQUEST['id'];
		 $sql = "UPDATE `agency` SET `gcode`='$hcode',`gname`='$hname',`state`='$location',`country`='$gstno',`username`='$username',`password`='$password' WHERE id='$id'";
		}
        echo  $sql;
	///end of sql query
        	if( $con->query($sql) === TRUE)
			{   
			if(isset($_REQUEST['save']))
				echo "<div class='alert alert-success'>Successfully Updated Govt.Agency Details</div>";
				echo"<script>window.location='govtregistration.php'</script>";
       		 }
			 else
			{
            echo "<div class='alert alert-danger'>Error: There was an error while adding/updating Govt.Agency details</div>";
        	}
    	}
}
//End of Insert/Edit operation
if($action == 'delete')
{
	$id= $_REQUEST['id'];
		$sql = "DELETE FROM agency WHERE id='$id'";  
	if( $con->query($sql) === TRUE)
			{   
			
				echo "<div class='alert alert-success'>Govt.Agency Details Deleted Sucessfully</div>";
				echo"<script>window.location='govtregistration.php'</script>";
       		 }
			 else
			{
            echo "<div class='alert alert-danger'>Error: There was an error while adding new Govt.Agency</div>";
        	}
}
?>
<div class="container-fluid">
   <h1 class="mt-4">Govt.Agency Setting</h1>
   	<ol class="breadcrumb mb-4">
   		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
   		<li class="breadcrumb-item active">Govt.Agency Settings</li>
   </ol>
<div class="card mb-8">
<div class="card mb-8">
<div class="card-body">
<?php if($action == 'edit' or $action == 'add' )
	{
		$id = $_REQUEST['id'];
		$sql = "SELECT * FROM agency where id='$id'";
		$result = $con->query($sql);
		$row = $result->fetch_assoc()
?>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="box">
        	<form action="" method="POST" enctype="multipart/form-data" >
        	<label for="firstname">Govt Agency Code</label>
       		<input type="text" id="hcode" name="hcode" value="<?php if($action=="edit"){ echo $row['gcode'];}else { if(isset($_POST['gcode'])){echo $_POST['hcode'];}else{ echo "";}} ?>" class="form-control"><br>
        	<label for="lastname">Govt Agency Name</label>
        	<input type="text" name="hname" id="hname" value="<?php if($action=="edit"){ echo $row['gname'];}else {if(isset($_POST['gname'])){echo $_POST['hname'];}else{ echo "";}} ?>" class="form-control"><br>
        	<label for="address">Govt Agency State</label>
       		<input type="text" name="location" id="location" value="<?php if($action=="edit"){ echo $row['country'];}else {echo "";} ?>" class="form-control"><br>		
        	<label for="address">Govt Agency County</label>
			<input type="text" name="gstno" id="gstno" value="<?php if($action=="edit"){ echo $row['state'];}else {echo "";} ?>" class="form-control"><br>
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
				$sql = "SELECT * FROM agency";
					$result = $con->query($sql);
?>
<center><a href="govtregistration.php?action=add&id=0" class="btn btn-primary">Add New Govt.Agency</a>
</center>
<div class="card mb-4">
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr>
<th>Sl.No </th>
<th>Govt Agency code</th>
<th>Govt Agency Name</th>
<th>Country</th>
<th>State</th>
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
        echo "<td>".$row['gcode'] . "</td>";
        echo "<td>".$row['gname'] . "</td>";
        echo "<td>".$row['country'] . "</td>";
		echo "<td>".$row['state'] . "</td>";
		echo "<td>".$row['username'] . "</td>";
        echo "<td><a href='govtregistration.php?action=edit&id=".$row['id']."' class='btn btn-info'>Edit</a></td>";
		echo "<td><a href='govtregistration.php?action=delete&id=".$row['id']."' class='btn btn-danger'>Delete</a></td>";
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