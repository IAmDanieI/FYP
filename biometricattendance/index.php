<?php
// Include the header file
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Student List</title>
    <link rel="stylesheet" type="text/css" href="css/Users.css">
    <script>
        $(window).on("load resize ", function () {
            var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
            $('.tbl-header').css({ 'padding-right': scrollWidth });
        }).resize();
    </script>
</head>

<body>
    <main>
        <section>
            <!-- User table -->
            <h1 class="slideInDown animated">Student List</h1>
            <div class="tbl-header slideInRight animated">
                <table cellpadding="0" cellspacing="0" border="0">
                    <thead>
                        <tr>
                            <th>ID | Name</th>
                            <th>Student Number</th>
                            <th>Gender</th>
                            <th>Finger ID</th>
                            <th>Date</th>
                            <th>Time In</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="tbl-content slideInRight animated">
                <table cellpadding="0" cellspacing="0" border="0">
                    <tbody>
                        <?php
                        // Connect to database
                        require 'db.php';
                        $sql = "SELECT * FROM users WHERE NOT username='' ORDER BY id DESC";
                        $result = mysqli_stmt_init($con);
                        if (!mysqli_stmt_prepare($result, $sql)) {
                            echo '<p class="error">SQL Error</p>';
                        } else {
                            mysqli_stmt_execute($result);
                            $resultl = mysqli_stmt_get_result($result);
                            if (mysqli_num_rows($resultl) > 0) {
                                while ($row = mysqli_fetch_assoc($resultl)) {
                        ?>
                                    <tr>
                                        <td><?php echo $row['id'] . " | " . $row['username']; ?></td>
                                        <td><?php echo $row['serialnumber']; ?></td>
                                        <td><?php echo $row['gender']; ?></td>
                                        <td><?php echo $row['fingerprint_id']; ?></td>
                                        <td><?php echo $row['user_date']; ?></td>
                                        <td><?php echo $row['time_in']; ?></td>
                                    </tr>
                        <?php
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>

</html>
