<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Attendance</title>
  <!-- Include Chart.js library -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <!-- Styles for the canvas -->
  <style>
    /* Add this style to your head */
    canvas#studentAttendanceChart {
      max-height: 500px; /* Adjust the max height as needed */
      overflow: hidden;
      display: block; /* Ensure the canvas is treated as a block element */
      margin-bottom: 20px; /* Adjust the padding as needed */
    }

    /* Added styles for centering the text */
    .text-container {
      text-align: center;
    }
  </style>
</head>
<body>

<?php
// Start PHP session
session_start();
// Include database connection script
require 'connectDB.php';

// Initialize row counter
$rowCount = 0;

// Query to get the total number of students from the 'users' table
$sqlTotalStudents = "SELECT COUNT(*) AS totalStudents FROM users";
$resultTotalStudents = mysqli_query($conn, $sqlTotalStudents);
$rowTotalStudents = mysqli_fetch_assoc($resultTotalStudents);
$totalStudents = $rowTotalStudents['totalStudents'];

// Check if a date is selected, otherwise use the current date
if (isset($_POST['log_date'])) {
  if ($_POST['date_sel'] != 0) {
    $_SESSION['seldate'] = $_POST['date_sel'];
  } else {
    $_SESSION['seldate'] = date("Y-m-d");
  }
}

// Check if the 'select_date' POST variable is set
if ($_POST['select_date'] == 1) {
  // Set the selected date to the current date
  $_SESSION['seldate'] = date("Y-m-d");
} else if ($_POST['select_date'] == 0) {
  // Use the selected date from the session
  $seldate = $_SESSION['seldate'];
}

// Query to get attendance logs for the selected date
$sql = "SELECT * FROM users_logs WHERE checkindate='$seldate' ORDER BY id DESC";
$result = mysqli_stmt_init($conn);

// Check if the SQL statement is prepared successfully
if (!mysqli_stmt_prepare($result, $sql)) {
  // Display an error message if SQL preparation fails
  echo '<p class="error">SQL Error</p>';
} else {
  // Execute the prepared statement
  mysqli_stmt_execute($result);
  // Get the result set
  $resultl = mysqli_stmt_get_result($result);

  // Check if there are rows in the result set
  if (mysqli_num_rows($resultl) > 0) {
    // Loop through the result set and increment the row counter
    while ($row = mysqli_fetch_assoc($resultl)) {
      $rowCount++;
    }
  }
}

// Calculate percentage of attendance
$attendancePercentage = ($rowCount / $totalStudents) * 100;
?>

<!-- Centered text container -->
<div class="text-container">
  <!-- Display the total number of students present -->
  <p>Total Number of Students Present: <?php echo $rowCount; ?></p>
  
  <!-- Display the percentage of attendance -->
  <p>Attendance Percentage: <?php echo number_format($attendancePercentage, 2); ?>%</p>

  <!-- Display the total number of students -->
  <p>Total Number of Students: <?php echo $totalStudents; ?></p>
</div>

<!-- Add the canvas for the pie chart with adjusted height -->
<canvas id="studentAttendanceChart" width="400" height="200"></canvas>

<script>
  // Get the total number of students present and absent from PHP
  var totalStudentsPresent = <?php echo $rowCount; ?>;
  var totalAbsentStudents = <?php echo ($totalStudents - $rowCount); ?>;

  // Create a pie chart using Chart.js
  var ctx = document.getElementById('studentAttendanceChart').getContext('2d');
  var myPieChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ['Total Absent Students', 'Total Students Present'],
      datasets: [{
        label: 'Number of Students',
        data: [totalAbsentStudents, totalStudentsPresent],
        backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(75, 192, 192, 0.2)'],
        borderColor: ['rgba(255, 99, 132, 1)', 'rgba(75, 192, 192, 1)'],
        borderWidth: 1
      }]
    }
  });
</script>

</body>
</html>
