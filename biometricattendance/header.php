<?php 
session_start();
if (!isset($_SESSION['username'])) {
    // Redirect to the login page
    header("Location: login.php");
    exit();
}
?>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/header.css">
</head>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/6540beaff2439e1631ea3be6/1he2ehnd8';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
<header>
<div class="header">
	<div class="logo">
		<a href="index.php">Biometric Attendance System</a>
	</div>
</div>

<div class="topnav" id="myTopnav">
    <a href="index.php">Students</a>
    <a href="UsersLog.php">Student Attendance Log</a>
    <div class="dropdown">
        <button class="dropbtn">Statistics
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
            <a href="StatisticsBar.php">Bar Chart</a>
            <a href="StatisticsPie.php">Pie Chart</a>
        </div>
    </div>
    <div class="topnav-right">
    <?php
    $username = $_SESSION['username'];
    echo '<a ' . ($username ? 'class="no-hover"' : '') . '>Currently logged in as: ' . $username . '</a>';
    ?>
    <a href="logout.php">Sign Out</a>
</div>
    <a href="javascript:void(0);" class="icon" onclick="navFunction()">
        <i class="fa fa-bars"></i>
    </a>
</div>

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


	

	
