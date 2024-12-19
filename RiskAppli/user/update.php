<?php
    session_start();
    require '../resources/functions.php';
    $db = new Database();
    $db->checkLogin();

    $data_pending = $db->query("SELECT * FROM resiko WHERE status = 'pending'");

    if(isset($_POST["update"])){
        $id = $_POST['id'];
        $dataPost = $_POST;
        if($db->update($dataPost)){
            echo "<script>alert('Data berhasil diupdate!'); document.location.href = 'user.php';</script>";
        }else{
            echo "<script>alert('Gagal mengupdate data!'); document.location.href = 'update.php';</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data Resiko</title>
</head>
<body>
    <h1>Risk Register System</h1>
    <p>Update data berlaku untuk data yang masih berstatus pending</p>
    <a href="user.php">Kembali</a>
    <h3>Table Management Resiko</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Masalah</th>
                <th>Divisi</th>
                <th>Tingkat</th>
                <th>Penyebab</th>
                <th>Sumber</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php if(empty($data_pending)): ?>
                <tr><td colspan='7'>-- kosong --</td></tr>
            <?php else: ?>
                <?php foreach($data_pending as $row): ?>
                    <tr>
                        <form method="post" action="">
                            <td><?= $i; ?></td>
                            <td><input type="text" name="resiko" value="<?= $row['resiko']; ?>" required></td>
                            <td>
                                <select name="divisi" required>
                                    <?php foreach ($db->enum("SHOW COLUMNS FROM resiko LIKE 'divisi'") as $divisi): ?>
                                        <option value="<?= $divisi; ?>" <?= $divisi == $row['divisi'] ? 'selected' : ''; ?>><?= $divisi; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td>
                                <select name="tingkat" required>
                                    <?php foreach ($db->enum("SHOW COLUMNS FROM resiko LIKE 'tingkat'") as $tingkat): ?>
                                        <option value="<?= $tingkat; ?>" <?= $tingkat == $row['tingkat'] ? 'selected' : ''; ?>><?= $tingkat; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td><textarea name="penyebab" required><?= $row['penyebab']; ?></textarea></td>
                            <td>
                                <select name="sumber" required>
                                    <?php foreach ($db->enum("SHOW COLUMNS FROM resiko LIKE 'sumber'") as $sumber): ?>
                                        <option value="<?= $sumber; ?>" <?= $sumber == $row['sumber'] ? 'selected' : ''; ?>><?= $sumber; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td>
                                <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                <input type="hidden" name="mitigasi" value="<?= $row['mitigasi']; ?>">
                                <input type="hidden" name="solusi" value="<?= $row['solusi']; ?>">
                                <input type="hidden" name="status" value="<?= $row['status']; ?>">
                                <button type="submit" name="update">Update</button>
                            </td>
                        </form>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>