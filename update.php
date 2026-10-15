<?php
require_once 'koneksi.php';

if (isset($_POST['update'])) {
    $plat_nomor = $_POST['plat_nomor'];
    $merk       = $_POST['merk'];
    $tahun      = $_POST['tahun'];
    $transmisi  = $_POST['transmisi'];
    $query = "UPDATE tabel_armada SET merk='$merk', tahun='$tahun', transmisi='$transmisi' WHERE plat_nomor='$plat_nomor'";
    $eksekusi = mysqli_query($koneksi, $query);
    if ($eksekusi) {
        echo "<script>
                alert('Data armada berhasil diperbarui!');
                window.location.href='tabel.php';
              </script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>