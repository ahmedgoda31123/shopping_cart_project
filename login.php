<?php
    include 'config.php';
    session_start();

    if (isset($_POST['submit'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pass = md5($_POST['password']);

        $query = "SELECT * FROM user_info WHERE `email` = '" . $email . "' AND
        `password` = '" . $pass . "';";
        $select = mysqli_query($conn, $query) or die('query failed');

        if (mysqli_num_rows($select)) {
            $row = mysqli_fetch_assoc($select);
            $_SESSION['user_id'] = $row['id'];
            header('Location: index.php');
        } else {
            $message[] = 'incorrect username or password!';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>

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
            <h3>login now</h3>
            <input type="email" name="email" required placeholder="enter email" class="box">
            <input type="password" name="password" required placeholder="enter password" class="box">
            <input type="submit" name="submit" class="btn" value="login now">
            <p>don't have an account? <a href="register.php">register now</a></p>
        </form>
    </div>
</body>
</html>