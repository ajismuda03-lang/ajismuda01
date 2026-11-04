<?php
session_start();
if (!isset($_SESSION['admin_logged']) || $_SESSION['admin_logged'] !== true) {
    header("Location: login.php");
    exit();
}

include '../database/koneksi.php';

$keyword = isset($_GET['cari']) ? mysqli_real_escape_string($conn, $_GET['cari']) : '';

if ($keyword != '') {
    $query = "SELECT * FROM tabel_pemohon WHERE nama_lengkap LIKE '%$keyword%' OR nik LIKE '%$keyword%' ORDER BY created_at DESC";
} else {
    $query = "SELECT * FROM tabel_pemohon ORDER BY created_at DESC";
}

$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Sistem Pinjaman</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .admin-container { max-width: 1100px; margin: 30px auto; background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        .header-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 10px; }
        .btn-logout { background: #dc3545; color: white; padding: 7px 15px; text-decoration: none; border-radius: 4px; font-weight: bold; }
        .search-box { display: flex; gap: 8px; margin-bottom: 20px; }
        .search-box input[type="text"] { padding: 8px 12px; width: 300px; border: 1px solid #ccc; border-radius: 4px; }
        .btn-search { background: #007bff; color: white; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer; }
        .btn-reset { background: #6c757d; color: white; padding: 8px 12px; border-radius: 4px; text-decoration: none; font-size: 14px; display: inline-flex; align-items: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #e0e0e0; padding: 12px; text-align: left; font-size: 14px; }
        th { background-color: #007bff; color: white; }
        .badge-pending { background: #ffc107; padding: 5px 10px; border-radius: 4px; color: #000; font-weight: bold; }
        .badge-disetujui { background: #28a745; padding: 5px 10px; border-radius: 4px; color: white; font-weight: bold; }
        .badge-ditolak { background: #dc3545; padding: 5px 10px; border-radius: 4px; color: white; font-weight: bold; }
        .btn-detail { background: #17a2b8; color: white; padding: 6px 12px; text-decoration: none; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="header-bar">
            <div>
                <h2>Dashboard Admin</h2>
                <span>Login sebagai: <b><?= htmlspecialchars($_SESSION['username']); ?></b></span>
            </div>
            <a href="logout.php" class="btn-logout">Logout</a>
        </div>

        <form action="" method="GET" class="search-box">
            <input type="text" name="cari" placeholder="Cari nama pemohon atau NIK..." value="<?= htmlspecialchars($keyword); ?>">
            <button type="submit" class="btn-search">Cari</button>
            <?php if ($keyword != ''): ?>
                <a href="dashboard.php" class="btn-reset">Reset</a>
            <?php endif; ?>
        </form>
        
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama Lengkap</th>
                    <th>NIK</th>
                    <th>Jumlah Pinjaman</th>
                    <th>Tenor</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $status = isset($row['status']) ? $row['status'] : 'Pending';
                        $badgeClass = 'badge-pending';
                        if ($status == 'Disetujui') $badgeClass = 'badge-disetujui';
                        if ($status == 'Ditolak') $badgeClass = 'badge-ditolak';
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($row['created_at'])); ?></td>
                    <td><?= htmlspecialchars($row['nama_lengkap']); ?></td>
                    <td><?= htmlspecialchars($row['nik']); ?></td>
                    <td>Rp <?= number_format($row['jumlah_pinjaman'], 0, ',', '.'); ?></td>
                    <td><?= $row['tenor']; ?> Bulan</td>
                    <td><span class="<?= $badgeClass; ?>"><?= $status; ?></span></td>
                    <td><a href="detail.php?id=<?= $row['id']; ?>" class="btn-detail">Detail / Berkas</a></td>
                </tr>
                <?php 
                    }
                } else {
                    echo "<tr><td colspan='8' style='text-align:center;'>Tidak ada data pengajuan pinjaman.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>