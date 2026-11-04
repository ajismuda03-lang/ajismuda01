<?php
session_start();

// Proteksi Sesi Login Admin
if (!isset($_SESSION['admin_logged']) || $_SESSION['admin_logged'] !== true) {
    header("Location: login.php");
    exit();
}

include '../database/koneksi.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$query = "SELECT * FROM tabel_pemohon WHERE id = $id";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "<script>alert('Data tidak ditemukan!'); window.location.href='dashboard.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pemohon - <?= htmlspecialchars($data['nama_lengkap']); ?></title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .detail-container { max-width: 850px; margin: 30px auto; background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        .info-table { width: 100%; border-collapse: collapse; margin-bottom: 25px; }
        .info-table td { padding: 8px 12px; border-bottom: 1px solid #eee; }
        .info-table td.label { font-weight: bold; width: 30%; color: #555; background: #fcfcfc; }
        .docs-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 15px; margin-top: 15px; }
        .doc-card { border: 1px solid #e0e0e0; padding: 10px; text-align: center; border-radius: 6px; background: #fafafa; }
        .doc-card img { width: 100%; height: 130px; object-fit: cover; border-radius: 4px; margin-bottom: 8px; border: 1px solid #ddd; }
        .action-btns { margin-top: 30px; text-align: center; padding-top: 15px; border-top: 2px solid #eee; }
        .btn { padding: 10px 24px; color: white; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; font-size: 15px; font-weight: bold; margin: 0 5px; }
        .btn-success { background: #28a745; }
        .btn-danger { background: #dc3545; }
        .btn-success:hover { background: #218838; }
        .btn-danger:hover { background: #c82333; }
    </style>
</head>
<body>
    <div class="detail-container">
        <h2>Detail Pengajuan Pinjaman</h2>
        <a href="dashboard.php" style="color: #007bff; text-decoration: none; font-weight: bold;">&larr; Kembali ke Dashboard</a>
        <br><br>

        <table class="info-table">
            <tr><td class="label">Nama Lengkap</td><td><?= htmlspecialchars($data['nama_lengkap']); ?></td></tr>
            <tr><td class="label">NIK</td><td><?= htmlspecialchars($data['nik']); ?></td></tr>
            <tr><td class="label">Nomor HP / WA</td><td><?= htmlspecialchars($data['no_hp']); ?></td></tr>
            <tr><td class="label">Pekerjaan</td><td><?= htmlspecialchars($data['pekerjaan']); ?></td></tr>
            <tr><td class="label">Penghasilan / Bulan</td><td>Rp <?= number_format($data['penghasilan'], 0, ',', '.'); ?></td></tr>
            <tr><td class="label">Status Pernikahan</td><td><?= htmlspecialchars($data['status_nikah']); ?></td></tr>
            <tr><td class="label">Alamat Lengkap</td><td><?= nl2br(htmlspecialchars($data['alamat'])); ?></td></tr>
            <tr><td class="label">Jumlah Pinjaman</td><td><b>Rp <?= number_format($data['jumlah_pinjaman'], 0, ',', '.'); ?></b></td></tr>
            <tr><td class="label">Tenor</td><td><?= $data['tenor']; ?> Bulan</td></tr>
            <tr><td class="label">Jenis Agunan</td><td><?= htmlspecialchars($data['jenis_agunan']); ?></td></tr>
            <tr><td class="label">Status Pengajuan</td><td><b><?= isset($data['status']) ? $data['status'] : 'Pending'; ?></b></td></tr>
        </table>

        <h3>Berkas Persyaratan yang Diunggah</h3>
        <div class="docs-grid">
            <div class="doc-card">
                <p><strong>Foto KTP</strong></p>
                <?php if (!empty($data['file_ktp'])): ?>
                    <img src="../<?= $data['file_ktp']; ?>" alt="KTP Pemohon">
                    <a href="../<?= $data['file_ktp']; ?>" target="_blank" style="font-size: 13px;">[Lihat Full]</a>
                <?php else: ?><p style="color: red;">Tidak ada file</p><?php endif; ?>
            </div>

            <div class="doc-card">
                <p><strong>KTP Pasangan</strong></p>
                <?php if (!empty($data['file_ktp_pasangan'])): ?>
                    <img src="../<?= $data['file_ktp_pasangan']; ?>" alt="KTP Pasangan">
                    <a href="../<?= $data['file_ktp_pasangan']; ?>" target="_blank" style="font-size: 13px;">[Lihat Full]</a>
                <?php else: ?><p style="color: #777;">Tidak ada / Lajang</p><?php endif; ?>
            </div>

            <div class="doc-card">
                <p><strong>Kartu Keluarga (KK)</strong></p>
                <?php if (!empty($data['file_kk'])): ?>
                    <img src="../<?= $data['file_kk']; ?>" alt="KK">
                    <a href="../<?= $data['file_kk']; ?>" target="_blank" style="font-size: 13px;">[Lihat Full]</a>
                <?php else: ?><p style="color: red;">Tidak ada file</p><?php endif; ?>
            </div>

            <div class="doc-card">
                <p><strong>STNK Depan</strong></p>
                <?php if (!empty($data['file_stnk_depan'])): ?>
                    <img src="../<?= $data['file_stnk_depan']; ?>" alt="STNK Depan">
                    <a href="../<?= $data['file_stnk_depan']; ?>" target="_blank" style="font-size: 13px;">[Lihat Full]</a>
                <?php else: ?><p style="color: red;">Tidak ada file</p><?php endif; ?>
            </div>

            <div class="doc-card">
                <p><strong>STNK Belakang</strong></p>
                <?php if (!empty($data['file_stnk_belakang'])): ?>
                    <img src="../<?= $data['file_stnk_belakang']; ?>" alt="STNK Belakang">
                    <a href="../<?= $data['file_stnk_belakang']; ?>" target="_blank" style="font-size: 13px;">[Lihat Full]</a>
                <?php else: ?><p style="color: red;">Tidak ada file</p><?php endif; ?>
            </div>
        </div>

        <div class="action-btns">
            <form action="update_status.php" method="POST" style="display:inline;">
                <input type="hidden" name="id" value="<?= $data['id']; ?>">
                <input type="hidden" name="status" value="Disetujui">
                <button type="submit" class="btn btn-success" onclick="return confirm('Apakah Anda yakin ingin MENYETUJUI pengajuan ini?')">Setujui Pinjaman</button>
            </form>

            <form action="update_status.php" method="POST" style="display:inline;">
                <input type="hidden" name="id" value="<?= $data['id']; ?>">
                <input type="hidden" name="status" value="Ditolak">
                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin MENOLAK pengajuan ini?')">Tolak Pinjaman</button>
            </form>
        </div>
    </div>
</body>
</html>