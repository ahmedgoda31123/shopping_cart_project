<?php
    include 'config.php';
    
    if (isset($_POST['submit'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pass = md5($_POST['password']);
        $cpass = md5($_POST['cpassword']);

        if ($pass === $cpass) {
            $query = "SELECT * FROM user_info WHERE `email` = '" . $email . "' AND
            `password` = '" . $pass . "';";
            $select = mysqli_query($conn, $query) or die('query failed');

            if (mysqli_num_rows($select)) {
                $message[] = 'user already exists!';
            } else {
                $query = "INSERT INTO user_info (`name`, `email`, `password`) VALUES 
                ('" . $name . "', '" . $email . "', '" . $pass . "');";
                mysqli_query($conn, $query) or die('query failed');
                $message[] = 'registered successfully!';
                header('Location: login.php');
            }
        }
        else {
            $message[] = 'the two passwords are not identical!';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php 
        if (isset($message)) {
            foreach($message as $message) {
                echo '<div class="message" onclick="this.remove();">' . $message . '</div>';
            }
        }
    ?>

    <div class="form-container">
        <form method="POST">
            <h3>register now</h3>
            <input type="text" name="name" required placeholder="enter username" class="box">
            <input type="email" name="email" required placeholder="enter email" class="box">
            <input type="password" name="password" required placeholder="enter password" class="box">
            <input type="password" name="cpassword" required placeholder="confirm password" class="box">
            <input type="submit" name="submit" class="btn" value="register now">
            <p>already have an account? <a href="login.php">login now</a></p>
        </form>
    </div>
</body>
</html>