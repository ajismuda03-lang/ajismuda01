<?php
include 'database/koneksi.php';

$hasil = null;
$error = null;

if (isset($_POST['cari'])) {
    $nik = mysqli_real_escape_string($conn, $_POST['nik']);
    $query = "SELECT * FROM tabel_pemohon WHERE nik = '$nik' ORDER BY created_at DESC LIMIT 1";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $hasil = mysqli_fetch_assoc($result);
    } else {
        $error = "Data pengajuan dengan NIK tersebut tidak ditemukan.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Status Pengajuan Pinjaman</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container" style="max-width: 500px; margin-top: 50px;">
        <h2>Cek Status Pengajuan Pinjaman</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="nik">Masukkan NIK (16 Digit):</label>
                <input type="text" id="nik" name="nik" maxlength="16" required placeholder="Contoh: 3201xxxxxxxxxxxx">
            </div>
            <button type="submit" name="cari" class="btn-submit">Cek Status</button>
        </form>

        <p style="text-align: center; margin-top: 15px;">
            <a href="index.php" style="color: #007bff; text-decoration: none;">&larr; Kembali ke Form Pendaftaran</a>
        </p>

        <?php if ($error): ?>
            <div style="margin-top: 20px; padding: 12px; background: #f8d7da; color: #721c24; border-radius: 4px; text-align: center;">
                <?= $error; ?>
            </div>
        <?php endif; ?>

        <?php if ($hasil): ?>
            <div style="margin-top: 25px; background: #f9f9f9; padding: 20px; border-radius: 6px; border: 1px solid #ddd;">
                <h3 style="margin-top: 0; text-align: center; border-bottom: 2px solid #ddd; padding-bottom: 8px;">Hasil Pencarian</h3>
                <p><strong>Nama Lengkap:</strong> <?= htmlspecialchars($hasil['nama_lengkap']); ?></p>
                <p><strong>Jumlah Pinjaman:</strong> Rp <?= number_format($hasil['jumlah_pinjaman'], 0, ',', '.'); ?></p>
                <p><strong>Tenor:</strong> <?= $hasil['tenor']; ?> Bulan</p>
                <p><strong>Tanggal Pengajuan:</strong> <?= date('d/m/Y H:i', strtotime($hasil['created_at'])); ?></p>
                <p><strong>Status Saat Ini:</strong> 
                    <span style="padding: 5px 10px; border-radius: 4px; font-weight: bold; color: white; background: 
                        <?php 
                            $status = isset($hasil['status']) ? $hasil['status'] : 'Pending';
                            if ($status == 'Disetujui') echo '#28a745';
                            elseif ($status == 'Ditolak') echo '#dc3545';
                            else echo '#ffc107; color: #000;';
                        ?>">
                        <?= $status; ?>
                    </span>
                </p>

                <div style="margin-top: 20px; text-align: center;">
                    <a href="cetak_bukti.php?id=<?= $hasil['id']; ?>" target="_blank" style="display: block; background: #007bff; color: white; padding: 10px; border-radius: 4px; text-decoration: none; font-weight: bold;">
                        🖨️ Cetak / Unduh Bukti Pengajuan
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>