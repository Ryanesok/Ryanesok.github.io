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
    <title>Risk Register</title>
</head>
<body>
    <h1>Risk Register System</h1>
    <h3>Register page</h3>
    <a href="user.php">Kembali</a>
    <form action="" method="post">
        
        <label for="resiko">Nama Resiko:</label>
        <input type="text" id="resiko" name="resiko" required><br><br>
        
        <label for="divisi">Divisi:</label>
        <select id="divisi" name="divisi" required>
            <?php foreach ($db->enum("SHOW COLUMNS FROM resiko LIKE 'divisi'") as $divisi): ?>
                <option value="<?= $divisi; ?>"><?= $divisi; ?></option>
            <?php endforeach; ?>
        </select><br><br>
        
        <label for="tingkat">Tingkat:</label>
        <select id="tingkat" name="tingkat" required>
            <?php foreach ($db->enum("SHOW COLUMNS FROM resiko LIKE 'tingkat'") as $tingkat): ?>
                <option value="<?= $tingkat; ?>"><?= $tingkat; ?></option>
            <?php endforeach; ?>
        </select><br><br>
        
        <label for="penyebab">Penyebab:</label>
        <textarea id="penyebab" name="penyebab" required></textarea><br><br>
        
        <label for="sumber">Sumber:</label>
        <select id="sumber" name="sumber" required>
            <?php foreach ($db->enum("SHOW COLUMNS FROM resiko LIKE 'sumber'") as $sumber): ?>
                <option value="<?= $sumber; ?>"><?= $sumber; ?></option>
            <?php endforeach; ?>
        </select><br><br>
        <input type="hidden" name="mitigasi" value="">
        <input type="hidden" name="solusi" value="">
        <input type="hidden" name="status" value="<?= $data[0]['status'] = 'pending'?>">
        <input type="submit" name="tambah" value="Submit">
    </form>
</body>
</html>
<?php
    if(isset($_POST["tambah"])){
        $dataPost = $_POST;
        if($db->tambah($dataPost)){
            echo "<script>alert('Data berhasil ditambahkan!'); document.location.href = '../user/tambah.php';</script>";
        }else{
            echo "<script>alert('Gagal menambahkan data!'); document.location.href = '../user/tambah.php';</script>";
        }
    }
?>