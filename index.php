<!DOCTYPE html>
<html>
<head>
    <title>Input Armada</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <h2>Silahkan Pilih Armada Yang Ingin Anda Sewa</h2>
        
        <form method="POST" action="simpan.php">
            <div class="form-group">
                <label>Plat Nomor:</label>
                <input type="text" name="plat_nomor" required>
            </div>
            
            <div class="form-group">
                <label>Merk:</label>
                <input type="text" name="merk" required>
            </div>
            
            <div class="form-group">
                <label>Tahun:</label>
                <input type="number" name="tahun" required>
            </div>
            
            <div class="form-group">
                <label>Transmisi:</label>
                <select name="transmisi">
                    <option value="Manual">Manual</option>
                    <option value="Matic">Matic</option>
                </select>
            </div>
            
            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
        </form>

        <a href="tabel.php" class="btn btn-secondary">Lihat Data Armada</a>
    </div>
</body>
</html>