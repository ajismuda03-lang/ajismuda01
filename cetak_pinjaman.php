<?php
include 'database/koneksi.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$query = "SELECT * FROM tabel_pemohon WHERE id = $id";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    die("<h3 style='text-align:center; margin-top:50px;'>Data bukti pengajuan tidak ditemukan!</h3>");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bukti Pengajuan - <?= htmlspecialchars($data['nama_lengkap']); ?></title>
    <style>
        body { font-family: Arial, sans-serif; color: #333; line-height: 1.5; padding: 20px; }
        .receipt-container { max-width: 600px; margin: 0 auto; border: 1px solid #ccc; padding: 30px; border-radius: 8px; background: #fff; }
        .header { text-align: center; border-bottom: 2px solid #333; padding-bottom: 15px; margin-bottom: 20px; }
        .table-info { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .table-info td { padding: 8px 10px; border-bottom: 1px solid #eee; font-size: 14px; }
        .table-info td.label { font-weight: bold; width: 40%; color: #555; }
        .status-box { text-align: center; margin-top: 20px; padding: 10px; background: #f8f9fa; border: 1px dashed #ccc; border-radius: 5px; }
        .btn-print { display: block; width: 100%; padding: 12px; background: #28a745; color: white; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; text-align: center; text-decoration: none; margin-top: 20px; }
        @media print {
            .btn-print, .no-print { display: none; }
            body { padding: 0; }
            .receipt-container { border: none; padding: 0; box-shadow: none; }
        }
    </style>
</head>
<body>
    <div class="receipt-container">
        <div class="header">
            <h2>BUKTI PENGAJUAN PINJAMAN</h2>
            <p>Sistem Layanan Pinjaman Online</p>
        </div>

        <table class="table-info">
            <tr><td class="label">ID Pengajuan</td><td>#<?= $data['id']; ?></td></tr>
            <tr><td class="label">Tanggal Daftar</td><td><?= date('d/m/Y H:i', strtotime($data['created_at'])); ?></td></tr>
            <tr><td class="label">Nama Lengkap</td><td><?= htmlspecialchars($data['nama_lengkap']); ?></td></tr>
            <tr><td class="label">NIK</td><td><?= htmlspecialchars($data['nik']); ?></td></tr>
            <tr><td class="label">Nomor HP / WA</td><td><?= htmlspecialchars($data['no_hp']); ?></td></tr>
            <tr><td class="label">Jumlah Pinjaman</td><td><b>Rp <?= number_format($data['jumlah_pinjaman'], 0, ',', '.'); ?></b></td></tr>
            <tr><td class="label">Tenor</td><td><?= $data['tenor']; ?> Bulan</td></tr>
            <tr><td class="label">Jenis Agunan</td><td><?= htmlspecialchars($data['jenis_agunan']); ?></td></tr>
        </table>

        <div class="status-box">
            <p style="margin: 0; font-size: 13px; color: #666;">Status Pengajuan Saat Ini:</p>
            <h3 style="margin: 5px 0 0; color: 
                <?php 
                    $status = isset($data['status']) ? $data['status'] : 'Pending';
                    if ($status == 'Disetujui') echo '#28a745';
                    elseif ($status == 'Ditolak') echo '#dc3545';
                    else echo '#e0a800';
                ?>">
                <?= strtoupper($status); ?>
            </h3>
        </div>

        <button onclick="window.print()" class="btn-print">Cetak Bukti (Print / Save PDF)</button>
        
        <div class="no-print" style="text-align: center; margin-top: 15px;">
            <a href="cek_status.php" style="color: #007bff; text-decoration: none; font-size: 14px;">&larr; Kembali ke Cek Status</a>
        </div>
    </div>
</body>
</html>