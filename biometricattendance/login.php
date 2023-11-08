<!DOCTYPE html>
<html>
<head>
    <script>
        // Check if the page is the login page
        if (window.location.href.includes("login.php")) {
            // Disable back button
            history.pushState(null, null, document.URL);
            window.addEventListener('popstate', function () {
                history.pushState(null, null, document.URL);
            });

            // Redirect to login page if the user presses the back button
            window.onbeforeunload = function() {
                window.location.href = "login.php";
            };
        }
    </script>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" href="css/stylelogin.css"/>
</head>
<body>
<?php
    require('db.php');
    session_start();

    // When form submitted, check and create user session.
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);

        // Check that the user exists in the database
        $query = "SELECT * FROM `lecturer` WHERE username='$username'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);

        if ($rows == 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                $_SESSION['username'] = $username;
                // Redirect to user dashboard page
                header("Location: index.php");
            } else {
                echo "<div class='form'>
                    <h3>Incorrect Password.</h3><br/>
                    <p class='link'>Click here to <a href='../biometricattendance/login.php'>Login</a> again.</p>
                    </div>";
            }
        } else {
            echo "<div class='form'>
                <h3>Incorrect Username.</h3><br/>
                <p class='link'>Click here to <a href='../biometricattendance/login.php'>Login</a> again.</p>
                </div>";
        }
    } else {
?>
    <form class="form" method="post" name="login">
        <h1 class="login-title">Lecturer Login</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true"/>
        <input type="password" class="login-input" name="password" placeholder="Password"/>
        <input type="submit" value="Login" name="submit" class="login-button"/>
    </form>
<?php
    }
?>
</body>
</html>
