<?php
session_start();

// Proteksi Sesi Login Admin
if (!isset($_SESSION['admin_logged']) || $_SESSION['admin_logged'] !== true) {
    header("Location: login.php");
    exit();
}

include '../database/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id     = intval($_POST['id']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $query = "UPDATE tabel_pemohon SET status = '$status' WHERE id = $id";

    if (mysqli_query($conn, $query)) {
        echo "<script>
            alert('Status pengajuan berhasil diperbarui menjadi: $status');
            window.location.href = 'detail.php?id=$id';
        </script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>