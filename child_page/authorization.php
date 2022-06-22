<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>

    <link rel="stylesheet" href="../style/authorization.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>

<body>
    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">

        <div class="signup">
            <form action="../clear_php/signup.php" method="POST">
                <label for="chk" aria-hidden="true">Sign up</label>
                <input type="text" name="nickname" placeholder="Nickname" required="">
                <input type="Email" name="Email" placeholder="Email" required="">
                <input type="password" name="password" placeholder="Password" required="">
                <input type="password" name="password_confirm" placeholder="Password confirm" required="">
                <button type="submit">Sign up</button>
                <p class="msg">
                    <?php
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                    ?>
                </p>
            </form>
            <button class="back_btn"><a href="index.php" class="back">Back</a></button>
        </div>

        <div class="login">
            <form action="../clear_php/signin.php" method="POST">
                <label for="chk" aria-hidden="true">Login</label>
                <input type="text" name="nickname" placeholder="Nickname/Email" required="">
                <input type="password" name="password" placeholder="Password" required="">
                <button type="submit">Login</button>
                </p>
            </form>
        </div>
    </div>
</body>

</html>