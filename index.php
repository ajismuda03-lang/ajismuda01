<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pengajuan Pinjaman Online</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Formulir Pengajuan Pinjaman</h2>
        <form action="proses.php" method="POST" enctype="multipart/form-data">
            
            <!-- Data Pribadi -->
            <div class="form-group">
                <label for="namaLengkap">Nama Lengkap (Sesuai KTP):</label>
                <input type="text" id="namaLengkap" name="namaLengkap" required>
            </div>

            <div class="form-group">
                <label for="nik">NIK (16 Digit):</label>
                <input type="text" id="nik" name="nik" maxlength="16" required>
            </div>

            <div class="form-group">
                <label for="noHp">Nomor HP / WhatsApp:</label>
                <input type="text" id="noHp" name="noHp" required>
            </div>

            <div class="form-group">
                <label for="pekerjaan">Pekerjaan:</label>
                <input type="text" id="pekerjaan" name="pekerjaan" required>
            </div>

            <div class="form-group">
                <label for="penghasilan">Penghasilan Per Bulan (Rp):</label>
                <input type="number" id="penghasilan" name="penghasilan" required>
            </div>

            <div class="form-group">
                <label for="statusNikah">Status Pernikahan:</label>
                <select id="statusNikah" name="statusNikah" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="Belum Menikah">Belum Menikah</option>
                    <option value="Menikah">Menikah</option>
                    <option value="Duda/Janda">Duda/Janda</option>
                </select>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat Lengkap:</label>
                <textarea id="alamat" name="alamat" rows="3" required></textarea>
            </div>

            <!-- Detail Pinjaman -->
            <div class="form-group">
                <label for="jumlahPinjaman">Jumlah Pinjaman (Rp):</label>
                <input type="number" id="jumlahPinjaman" name="jumlahPinjaman" required>
            </div>

            <div class="form-group">
                <label for="tenor">Tenor (Bulan):</label>
                <select id="tenor" name="tenor" required>
                    <option value="3">3 Bulan</option>
                    <option value="6">6 Bulan</option>
                    <option value="12">12 Bulan</option>
                    <option value="24">24 Bulan</option>
                </select>
            </div>

            <div class="form-group">
                <label for="jenisAgunan">Jenis Agunan:</label>
                <input type="text" id="jenisAgunan" name="jenisAgunan" placeholder="Contoh: BPKB Motor Honda Beat" required>
            </div>

            <!-- Upload Berkas -->
            <h3>Upload Berkas Persyaratan (JPG/PNG)</h3>
            
            <div class="form-group">
                <label for="fileKtp">Foto KTP Pemohon:</label>
                <input type="file" id="fileKtp" name="fileKtp" accept=".jpg, .jpeg, .png" required>
            </div>

            <div class="form-group">
                <label for="fileKtpPasangan">Foto KTP Pasangan (Jika Menikah):</label>
                <input type="file" id="fileKtpPasangan" name="fileKtpPasangan" accept=".jpg, .jpeg, .png">
            </div>

            <div class="form-group">
                <label for="fileKk">Foto Kartu Keluarga (KK):</label>
                <input type="file" id="fileKk" name="fileKk" accept=".jpg, .jpeg, .png" required>
            </div>

            <div class="form-group">
                <label for="fileStnkDepan">Foto STNK Bagian Depan:</label>
                <input type="file" id="fileStnkDepan" name="fileStnkDepan" accept=".jpg, .jpeg, .png" required>
            </div>

            <div class="form-group">
                <label for="fileStnkBelakang">Foto STNK Bagian Belakang:</label>
                <input type="file" id="fileStnkBelakang" name="fileStnkBelakang" accept=".jpg, .jpeg, .png" required>
            </div>

            <button type="submit" class="btn-submit">Kirim Pengajuan Pinjaman</button>
        </form>
    </div>

    <script src="js/script.js"></script>
</body>
</html>