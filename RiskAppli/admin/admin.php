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
    <title>Homepage Admin</title>
</head>
<body>
    <h1>Risk Management System</h1>
    <p>Selamat datang, <?= $_SESSION['username'];?> </p>
    <a href="../process/logout.php">Logout</a> | <a href="MitigasiSolusi.php">Tambah Solusi</a> | <a href="hapus.php">Hapus</a>
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
                    <td>
                        <?php 
                            $enum_status = $db->enum("SHOW COLUMNS FROM resiko LIKE 'status'");
                            if($row['status'] != "pending"){
                                echo $row["status"];
                            }else{
                                echo '<form method="post" action="admin.php?id='.$row["id"].'">';
                                echo '<select name="status">';
                                foreach($enum_status as $status){
                                    $selected = ($status == 'pending') ? 'selected' : '';
                                    echo '<option value="'.$status.'" '.$selected.'>'.$status.'</option>';
                                }
                                echo '</select>';
                                echo '<input type="submit" name="submit" value="Submit">';
                                echo '</form>';
                            }
                        ?>
                    </td>
                    <?php $i++?>
                </tr>
            <?php endforeach;
                }
            ?>
        </tbody>
    </table>
</body>
</html>
<?php
if(isset($_POST['submit'])) {
    $id = $_GET['id'];
    $status = $_POST['status'];
    $db->approval($id, $status);
    header('Location: admin.php');
    exit;
}
?>