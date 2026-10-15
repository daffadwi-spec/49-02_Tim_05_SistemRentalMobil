<?php
require_once 'koneksi.php';

if (isset($_POST['simpan'])) {
    $plat_nomor = $_POST['plat_nomor']; 
    $merk       = $_POST['merk'];      
    $tahun      = $_POST['tahun'];      
    $transmisi  = $_POST['transmisi']; 
    $query = "INSERT INTO tabel_armada (plat_nomor, merk, tahun, transmisi) 
              VALUES ('$plat_nomor', '$merk', '$tahun', '$transmisi')";
    $eksekusi = mysqli_query($koneksi,$query);
    if ($eksekusi) {
        echo "<script>
                alert('Data armada berhasil disimpan!'); 
                window.location.href='tabel.php';
              </script>";
    } else {
        echo "Gagal menyimpan: " . mysqli_error($koneksi);
    }
}
?>