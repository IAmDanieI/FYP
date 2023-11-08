<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Attendance</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    /* Add this style to your head */
    canvas#studentAttendanceChart {
      max-height: 440px; /* Adjust the max height as needed */
      overflow: hidden;
      display: block; /* Ensure the canvas is treated as a block element */
      margin-bottom: 20px; /* Adjust the padding as needed */

      
    }
  </style>
</head>

<?php
session_start();
// Connect to the database
require 'connectDB.php';

// Initialize row counter
$rowCount = 0;

// Query to get the total number of students from the 'users' table
$sqlTotalStudents = "SELECT COUNT(*) AS totalStudents FROM users";
$resultTotalStudents = mysqli_query($conn, $sqlTotalStudents);
$rowTotalStudents = mysqli_fetch_assoc($resultTotalStudents);
$totalStudents = $rowTotalStudents['totalStudents'];

if (isset($_POST['log_date'])) {
  if ($_POST['date_sel'] != 0) {
    $_SESSION['seldate'] = $_POST['date_sel'];
  } else {
    $_SESSION['seldate'] = date("Y-m-d");
  }
}

if ($_POST['select_date'] == 1) {
  $_SESSION['seldate'] = date("Y-m-d");
} else if ($_POST['select_date'] == 0) {
  $seldate = $_SESSION['seldate'];
}

$sql = "SELECT * FROM users_logs WHERE checkindate='$seldate' ORDER BY id DESC";
$result = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($result, $sql)) {
  echo '<p class="error">SQL Error</p>';
} else {
  mysqli_stmt_execute($result);
  $resultl = mysqli_stmt_get_result($result);

  if (mysqli_num_rows($resultl) > 0) {
    while ($row = mysqli_fetch_assoc($resultl)) {
      $rowCount++; // Increment the row counter
    }
  }
}
?>

<!-- Display the total number of students -->
<div class="text-container" style="text-align: center;">
  <!-- Display the total number of students present -->
  <p>Total Number of Students Present: <?php echo $rowCount; ?></p>
  
  <?php
    $attendancePercentage = ($rowCount / $totalStudents) * 100;
    echo '<p>Attendance Percentage: ' . number_format($attendancePercentage, 2) . '%</p>';
  ?>

  <!-- Display the total number of students -->
  <p>Total Number of Students: <?php echo $totalStudents; ?></p>
</div>
<!-- Add the canvas for the bar chart with adjusted height -->
<canvas id="studentAttendanceChart" width="400" height="150"></canvas>

<script>
  // Get the total number of students present and absent from PHP
  var totalStudentsPresent = <?php echo $rowCount; ?>;
  var totalAbsentStudents = <?php echo ($totalStudents - $rowCount); ?>;

  // Create a bar chart using Chart.js
  var ctx = document.getElementById('studentAttendanceChart').getContext('2d');
  var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Total Students Present', 'Total Absent Students'],
      datasets: [{
        label: 'Number of Students',
        data: [totalStudentsPresent, totalAbsentStudents],
        backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)'],
        borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>

</body>
</html>
