<?php
// Sertakan koneksi database
include 'database/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data teks dari form dan amankan dengan mysqli_real_escape_string
    $namaLengkap    = mysqli_real_escape_string($conn, $_POST['namaLengkap']);
    $nik            = mysqli_real_escape_string($conn, $_POST['nik']);
    $noHp           = mysqli_real_escape_string($conn, $_POST['noHp']);
    $pekerjaan      = mysqli_real_escape_string($conn, $_POST['pekerjaan']);
    $penghasilan    = mysqli_real_escape_string($conn, $_POST['penghasilan']);
    $statusNikah    = mysqli_real_escape_string($conn, $_POST['statusNikah']);
    $alamat         = mysqli_real_escape_string($conn, $_POST['alamat']);
    $jumlahPinjaman = mysqli_real_escape_string($conn, $_POST['jumlahPinjaman']);
    $tenor          = mysqli_real_escape_string($conn, $_POST['tenor']);
    $jenisAgunan    = mysqli_real_escape_string($conn, $_POST['jenisAgunan']);

    // Konfigurasi Upload Folder
    $targetDir = "uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // Fungsi helper untuk upload file
    function uploadFile($fileInputName, $targetDir) {
        if (isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] == 0) {
            $fileName = time() . '_' . basename($_FILES[$fileInputName]['name']);
            $targetFilePath = $targetDir . $fileName;
            $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
            
            $allowedTypes = array('jpg', 'jpeg', 'png');
            if (in_array($fileType, $allowedTypes)) {
                if (move_uploaded_file($_FILES[$fileInputName]['tmp_name'], $targetFilePath)) {
                    return $targetFilePath;
                }
            }
        }
        return null;
    }

    // Proses upload berkas wajib & opsional
    $pathKtp          = uploadFile('fileKtp', $targetDir);
    $pathKtpPasangan  = uploadFile('fileKtpPasangan', $targetDir);
    $pathKk           = uploadFile('fileKk', $targetDir);
    $pathStnkDepan    = uploadFile('fileStnkDepan', $targetDir);
    $pathStnkBelakang = uploadFile('fileStnkBelakang', $targetDir);

    // Simpan ke Database beserta path filenya
    $query = "INSERT INTO tabel_pemohon (
                nama_lengkap, nik, no_hp, pekerjaan, penghasilan, status_nikah, alamat, 
                jumlah_pinjaman, tenor, jenis_agunan, file_ktp, file_ktp_pasangan, 
                file_kk, file_stnk_depan, file_stnk_belakang
              ) VALUES (
                '$namaLengkap', '$nik', '$noHp', '$pekerjaan', '$penghasilan', '$statusNikah', '$alamat', 
                '$jumlahPinjaman', '$tenor', '$jenisAgunan', '$pathKtp', '$pathKtpPasangan', 
                '$pathKk', '$pathStnkDepan', '$pathStnkBelakang'
              )";

    if (mysqli_query($conn, $query)) {
        echo "<script>
            alert('Pengajuan pinjaman berhasil dikirim dan disimpan!');
            window.location.href = 'index.php';
        </script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>