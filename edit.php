<?php
require_once 'koneksi.php';
$plat_nomor = $_GET['plat_nomor'];
$query = mysqli_query($koneksi, "SELECT * FROM tabel_armada WHERE plat_nomor='$plat_nomor'");
$d = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Armada</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container"> 
        <h2>Edit Data Armada</h2>
        
        <form method="POST" action="update.php">
            <div class="form-group">
                <label>Plat Nomor:</label>
                <input type="text" name="plat_nomor" value="<?php echo $d['plat_nomor']; ?>" readonly style="background-color: #e9ecef;">
            </div>
            
            <div class="form-group">
                <label>Merk:</label>
                <input type="text" name="merk" value="<?php echo $d['merk']; ?>" required>
            </div>
            
            <div class="form-group">
                <label>Tahun:</label>
                <input type="number" name="tahun" value="<?php echo $d['tahun']; ?>" required>
            </div>
            
            <div class="form-group">
                <label>Transmisi:</label>
                <select name="transmisi">
                    <option value="Manual" <?php if($d['transmisi'] == 'Manual') echo 'selected'; ?>>Manual</option>
                    <option value="Matic" <?php if($d['transmisi'] == 'Matic') echo 'selected'; ?>>Matic</option>
                </select>
            </div>
            
            <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
        </form>

        <a href="tabel.php" class="btn btn-secondary">Batal</a>
    </div>
</body>
</html>