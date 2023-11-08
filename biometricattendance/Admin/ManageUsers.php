<!DOCTYPE html>
<html>
<head>
  <title>Manage Users</title>
  <link rel="stylesheet" type="text/css" href="../css/manageusers.css">
  <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha1256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
  <script src="js/jquery-2.2.3.min.js"></script>
  <script src="../js/manage_users.js"></script>
  <script>
    $(document).ready(function(){
      $.ajax({
        url: "manage_users_up.php"
      }).done(function(data) {
        $('#manage_users').html(data);
      });

      setInterval(function(){
        $.ajax({
          url: "manage_users_up.php"
        }).done(function(data) {
          $('#manage_users').html(data);
        });
      }, 5000);

      // Function to validate name input
      function validateName() {
        var nameInput = document.getElementById('name');
        var nameValue = nameInput.value;

        if (nameValue.length > 100) {
          alert('Name cannot be more than 100 characters.');
          nameInput.value = ''; // Clear the input
          return false;
        }

        return true;
      }

      // Function to validate fingerprint ID input
      function validateFingerprintID() {
        var fingeridInput = document.getElementById('fingerid');
        var fingeridValue = fingeridInput.value;

        if (fingeridValue > 127) {
          alert('Fingerprint ID cannot be more than 127.');
          fingeridInput.value = ''; // Clear the input
          return false;
        }

        return true;
      }

      // Function to validate serial number input
      function validateSerialNumber() {
        var numberInput = document.getElementById('number');
        var numberValue = numberInput.value;

        if (numberValue.length !== 8) {
          alert('Serial Number must be 8 numbers.');
          numberInput.value = ''; // Clear the input
          return false;
        }

        return true;
      }

      // Function to validate the entire form
      function validateForm() {
        return validateName() && validateFingerprintID() && validateSerialNumber();
      }

      // Click event for user_add button
      $(".user_add").on("click", function() {
        if (validateForm()) {
          // Proceed with adding the user
          // Add your code here to handle adding the user
        }
      });

      // Click event for user_upd button
      $(".user_upd").on("click", function() {
        if (validateForm()) {
          // Proceed with updating the user
          // Add your code here to handle updating the user
        }
      });
    });
  </script>
</head>
<body>
  <?php include '../Admin/header.php';?>
  <main>
    <h1 class="slideInDown animated">Add, Update & Remove Student</h1>
    <div class="form-style-5 slideInDown animated">
      <div class="alert">
        <label id="alert"></label>
      </div>
      <form>
        <fieldset>
          <legend><span class="number">1</span> User Fingerprint ID:</legend>
          <label>Enter Fingerprint ID between 1 & 127:</label>
          <input type="number" name="fingerid" id="fingerid" placeholder="User Fingerprint ID..." oninput="validateFingerprintID()">
          <button type="button" name="fingerid_add" class="fingerid_add">Add Fingerprint ID</button>
        </fieldset>
        <fieldset>
          <legend><span class="number">2</span> User Info</legend>
          <input type="text" name="name" id="name" placeholder="User Name..." oninput="validateName()">
          <input type="text" name="number" id="number" placeholder="Serial Number..." oninput="validateSerialNumber()">
          <input type="email" name="email" id="email" placeholder="User Email...">
        </fieldset>
        <fieldset>
          <legend><span class="number">3</span> Additional Info</legend>
          <label>
            Time In:
            <input type="time" name="timein" id="timein">
            <input type="radio" name="gender" class="gender" value="Female">Female
            <input type="radio" name="gender" class="gender" value="Male" checked="checked">Male
          </label >
        </fieldset>
        <button type="button" name="user_add" class="user_add">Add User</button>
        <button type="button" name="user_upd" class="user_upd">Update User</button>
        <button type="button" name="user_rmo" class="user_rmo">Remove User</button>
      </form>
    </div>

    <div class="section">
      <!--User table-->
      <div class="tbl-header slideInRight animated">
        <table cellpadding="0" cellspacing="0" border="0">
          <thead>
            <tr>
              <th>Finger .ID</th>
              <th>Name</th>
              <th>Gender</th>
              <th>S.No</th>
              <th>Date</th>
              <th>Time in</th>
            </tr>
          </thead>
        </table>
      </div>
      <div class="tbl-content slideInRight animated">
        <table cellpadding="0" cellspacing="0" border="0">
          <div id="manage_users"></div>
      </div>
    </div>
  </main>
</body>
</html>
