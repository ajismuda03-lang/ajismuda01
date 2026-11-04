-- Skrip Pembuatan Database & Tabel Sistem Pengajuan Pinjaman MUF
CREATE DATABASE IF NOT EXISTS `db_muf_pinjaman`;
USE `db_muf_pinjaman`;

CREATE TABLE IF NOT EXISTS `tabel_pemohon` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` VARCHAR(100) NOT NULL,
  `nik` VARCHAR(16) NOT NULL,
  `no_hp` VARCHAR(20) NOT NULL,
  `pekerjaan` VARCHAR(50) NOT NULL,
  `penghasilan` VARCHAR(50) NOT NULL,
  `status_nikah` VARCHAR(20) NOT NULL,
  `alamat` TEXT NOT NULL,
  `jumlah_pinjaman` DECIMAL(15,2) NOT NULL,
  `tenor` VARCHAR(50) NOT NULL,
  `jenis_agunan` VARCHAR(100) NOT NULL,
  `foto_ktp` VARCHAR(255) DEFAULT NULL,
  `foto_ktp_pasangan` VARCHAR(255) DEFAULT NULL,
  `foto_kk` VARCHAR(255) DEFAULT NULL,
  `foto_stnk_depan` VARCHAR(255) DEFAULT NULL,
  `foto_stnk_belakang` VARCHAR(255) DEFAULT NULL,
  `tanggal_pengajuan` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;