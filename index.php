<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Company-info</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
		<script language="javascript" type="text/javascript" src="datetimepicker_css.js"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.html">CompanyV1.0 Beta</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
              
            </ul>
        </nav>
        <?php
//require_once 'menu.php';
?>
            <div id="layoutSidenav_content">
                <main>
<?php
require_once 'config.php';
if(isset($_POST['submit_1']))
{
session_start();
//check with the table user_setting
$sql = "SELECT * FROM user where username='$_POST[user_name]' and password='$_POST[pass_word]'";
echo $sql;
		$result = $con->query($sql);
		//$row = $result->fetch_assoc()
		$userid="";
		 while( $row = $result->fetch_assoc())
	{
	$userid=$row['id'];
	$_SESSION['userid']=$row['id'];
	$_SESSION['uname']=$row['user_name'];
	echo"<script>window.location='home.php'</script>";
	}
	if($userid<>"")
	{
	echo "<div class='alert alert-danger'>Error: Please fille the details</div>";
	}
}
?>
<div class="container-fluid">
</br>
                        <h1 class="mt-4">Welcome to company Info AdminPage</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">ompany Info AdminPage</li>
                        </ol>
  <div class="card mb-8">
                            <div class="card-body">
                                <div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="box">
        	<form action="index.php" method="POST">
        	<label for="firstname">User Name</label>
       		<input type="text" id="user_name" name="user_name"  class="form-control"><br>
        	<label for="lastname">Password</label>
        	<input type="password" name="pass_word" id="pass_word" class="form-control"><br>
			<button type="submit" class="btn btn-success" name="submit_1" >sign in</button>
                            </div>
                        </div>
                     </form>
                      </div>
                       <?php
require_once 'footer.php';
?>