<?php
    require '../resources/functions.php';
    $db = new Database();
    $enum_role = $db->enum("SHOW COLUMNS FROM users LIKE 'role'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Account</title>
</head>
<body>
    <h1>Daftar Akun</h1>
    <p>Sudah punya akun? <a href="login.php">Login</a></p>
    <form action="register-process.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br>
        <label for="role">Role:</label><br>
        <select id="role" name="role" onchange="showMessage()" required>
            <option value="">Pilih Role</option>
            <?php foreach($enum_role as $role):?>
                <option value="<?= $role;?>"><?= $role?></option>
            <?php endforeach;?>
        </select><br>
        <p id="message"></p>
        <input type="submit" value="Daftar">
    </form>
    <script>
        function showMessage() {
            var role = document.getElementById("role").value;
            if (role == "Admin") {
                var message = "Admin membantu mencari solusi dan pencegahan masalah yang diajukan oleh user";
                var confirmation = "Apakah Anda yakin ingin menjadi admin?";
            } else if (role == "User") {
                var message = "User memberikan keluhan dan masalah yang sedang berlangsung";
                var confirmation = "Apakah Anda yakin ingin menjadi user?";
            }
            document.getElementById("message").innerHTML = message + "<br>" + confirmation;
        }
    </script>
</body>
</html>