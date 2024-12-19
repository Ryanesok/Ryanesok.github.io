<?php
    session_start();
    require '../resources/functions.php';
    $db = new Database();
    $db->checkLogin();

    $data = $db->query("SELECT * FROM resiko");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Homepage</title>
</head>
<body>
    <h1>Risk Register System</h1>
    <p>Selamat datang, <?= $_SESSION['username']; ?></p>   
    <a href="../process/login.php">Home</a> | <a href="tambah.php">Register</a> | <a href="hapus.php">Delete</a> | <a href="update.php">Update</a>
    <h3>Table Management Resiko</h3>
    <table>
        <thead>
            <th>No</th>
            <th>Masalah</th>
            <th>Divisi</th>
            <th>Tingkat</th>
            <th>Penyebab</th>
            <th>Sumber</th>
            <th>Mitigasi</th>
            <th>Solusi</th>
            <th>Status</th>
        </thead>
        <tbody>
            <?php $i = 1;?>
            <?php 
                if(empty($data)){
                    echo "<tr><td colspan='8'>-- kosong --</td></tr>";
                }else{
                    foreach($data as $row): 
            ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= $row["resiko"] ?></td>
                    <td><?= $row["divisi"] ?></td>
                    <td><?= $row["tingkat"] ?></td>
                    <td><?= $row["penyebab"] ?></td>
                    <td><?= $row["sumber"] ?></td>
                    <td><?= $row["mitigasi"] ?></td>
                    <td><?= $row["solusi"] ?></td>
                    <td><?= $row["status"] ?></td>
                    <?php $i++?>
                </tr>
            <?php endforeach;
                }
            ?>
        </tbody>
    </table>
</body>
</html>