<?php
    session_start();
    if(isset($_SESSION['login'])){
        header("Location: ../index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="">
</head>
<body>
    <h1>Risk Management Login page</h1>
    <p>Made by : ryanesok, bizer, DJ</p>
    <form action="login-process.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" placeholder="Username" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" placeholder="Password" required><br>
        <input type="submit" name="login" value="Login">
    </form>
    <p id="register">don't have account?<a href="register.php">Register</a></p>
</body>
</html>