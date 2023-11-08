<!DOCTYPE html>
<html>
<head>
  <title>Users Logs</title>
  <link rel="stylesheet" type="text/css" href="css/userslog.css">
  <script src="https://code.jquery.com/jquery-3.3.1.js"
          integrity="sha1256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
          crossorigin="anonymous">
  </script>
  <script src="js/jquery-2.2.3.min.js"></script>
  <script src="js/user_log.js"></script>
  <script>
    $(document).ready(function(){
        $.ajax({
          url: "user_chart_pie.php",
          type: 'POST',
          data: {
              'select_date': 1,
          }
        });
      setInterval(function(){
        $.ajax({
          url: "user_chart_pie.php",
          type: 'POST',
          data: {
              'select_date': 0,
          }
          }).done(function(data) {
            $('#userslog').html(data);
          });
      },5000);
    });
  </script>
  <style>
    /* Add this style to hide the table */
    #userslog table {
      display: none;
    }    
  </style>
</head>
<body>
  <?php include 'header.php'; ?> 
  <main>
    <section>
      <!-- User chart and date selection -->
      <h1 class="slideInDown animated">Student's Daily Statistics</h1>
      <div class="form-style-5 slideInDown animated">
        <form method="POST" action="Export_Excel.php">
          <input type="date" name="date_sel" id="date_sel">
          <button type="button" name="user_log" id="user_log">Select Date</button>
          <input type="submit" name="To_Excel" value="Export to Excel">
        </form>
      </div>
      <div class="tbl-content slideInRight animated">
        <div id="userslog"></div>
      </div>
    </section>
    <footer>
    <p>&copy; 2023 Biometric Attendance System</p>
  </footer>
  </main>
</body>
</html>
