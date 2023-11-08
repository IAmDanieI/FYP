<?php 
session_start();
?>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../css/header.css">
</head>

<header>
<div class="header">
	<div class="logo">
		<a href="../admin/manageusers.php">Biometric Attendance System - Admin</a>
	</div>
</div>

<!-- ... (your existing code) ... -->
<div class="topnav" id="myTopnav">
    <a href="ManageUsers.php">Manage Users</a>
    <div class="topnav-right">
        <a>Currently logged in as: <?php echo $_SESSION['username']; ?></a>
        <a href="logout.php">Sign Out</a>
    </div>
    <a href="javascript:void(0);" class="icon" onclick="navFunction()">
        <i class="fa fa-bars"></i>
    </a>
</div>
<!-- ... (your existing code) ... -->

</header>
<script>
	function navFunction() {
	var x = document.getElementById("myTopnav");
	if (x.className === "topnav") {
	x.className += " responsive";
	} else {
	x.className = "topnav";
	}
	}
</script>


	

	
