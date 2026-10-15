<?php 
require_once 'koneksi.php'; 

if (isset($_GET['hapus'])) {
    $plat = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM tabel_armada WHERE plat_nomor='$plat'");
    echo "<script>alert('Data berhasil dihapus!'); window.location.href='tabel.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Armada</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="table-container" style="width: 750px;">
        <h2>Data Armada</h2>
        <table>
            <thead>
                <tr>
                    <th>Plat Nomor</th>
                    <th>Merk</th>
                    <th>Tahun</th>
                    <th>Transmisi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $data = mysqli_query($koneksi, "SELECT * FROM tabel_armada");
                while($d = mysqli_fetch_array($data)){
                ?>
                    <tr>
                        <td><?php echo $d['plat_nomor']; ?></td>
                        <td><?php echo $d['merk']; ?></td>
                        <td><?php echo $d['tahun']; ?></td>
                        <td><?php echo $d['transmisi']; ?></td>
                        <td style="text-align: center;">
                            <a href="edit.php?plat_nomor=<?php echo $d['plat_nomor']; ?>" class="btn-aksi btn-edit">Edit</a>
                            <a href="tabel.php?hapus=<?php echo $d['plat_nomor']; ?>" class="btn-aksi btn-hapus" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        
        <a href="index.php" class="btn btn-secondary">Tambah Armada Baru</a>
    </div>
</body>
</html>