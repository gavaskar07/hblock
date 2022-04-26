<?php
session_start();
require_once 'header.php';
//session_start();
?>
<div class="container-fluid">
                        <h1 class="mt-4">Home Page</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Home Page</li>
                        </ol>
  <div class="card mb-8">
                            <div class="card-body">
                                Welcome  <?php echo $_SESSION['uname']; ?> to Company V1.0
                            </div>
                        </div>
                     
                      </div>
                       <?php
require_once 'footer.php';
?>