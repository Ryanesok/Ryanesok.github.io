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
    <title>Hapus Data Resiko</title>
</head>
<body>
    <h1>Risk Register System</h1>
    <p>Data resiko yang masih berstatus pending dapat ditarik kembali oleh user</p>
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
                <th>Mitigasi</th>
                <th>Solusi</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php 
                $data_pending = array_filter($data, function($row) {
                    return $row['status'] == 'pending';
                });

                if(empty($data_pending)){
                    echo "<tr><td colspan='10'>-- kosong --</td></tr>";
                } else {
                    foreach($data_pending as $row): 
            ?>
                <tr>
                    <form method="post" action="">
                        <td><?= $i; ?></td>
                        <td><?= $row["resiko"] ?></td>
                        <td><?= $row["divisi"] ?></td>
                        <td><?= $row["tingkat"] ?></td>
                        <td><?= $row["penyebab"] ?></td>
                        <td><?= $row["sumber"] ?></td>
                        <td><?= $row["mitigasi"] ?></td>
                        <td><?= $row["solusi"] ?></td>
                        <td><?= $row["status"] ?></td>
                        <td>
                            <input type="hidden" name="id" value="<?= $row['id']; ?>">
                            <button type="submit" name="submit" onclick="return confirm('Apakah Anda yakin ingin menarik kembali data ini?');">Tarik</button>
                        </td>
                    </form>
                </tr>
            <?php 
                        $i++;
                    endforeach;
                }
            ?>
        </tbody>
    </table>
</body>
</html>
<?php
if(isset($_POST['submit'])) {
    $id = $_POST['id'];
    if($db->hapus($id) > 0) {
        echo "<script>alert('Data berhasil ditarik kembali!'); document.location.href = 'hapus.php';</script>";
    } else {
        echo "<script>alert('Gagal menarik data!'); document.location.href = 'hapus.php';</script>";
    }
}
?>