<?php
session_start(); // Pastikan session dimulai

// Ambil data dari form
$judul = $_POST['judul'] ?? '';
$jenis_permohonan = $_POST['jenis_permohonan'] ?? '';
$jenis_ciptaan = $_POST['jenis_ciptaan'] ?? '';
$uraian_singkat = $_POST['uraian_singkat'] ?? '';
$tanggal_pertama_kali_diumumkan = $_POST['tanggal_pertama_kali_diumumkan'] ?? '';
$kota_pertama_kali_diumumkan = $_POST['kota_pertama_kali_diumumkan'] ?? '';
$jenis_pendanaan = $_POST['jenis_hibah'] ?? '';

// Validasi input
if (empty($judul) || empty($jenis_permohonan) || empty($jenis_ciptaan)) {
    // Simpan data ke session untuk ditampilkan kembali
    $_SESSION['input_awal'] = [
        'judul' => $judul,
        'jenis_permohonan' => $jenis_permohonan,
        'jenis_ciptaan' => $jenis_ciptaan,
        'uraian_singkat' => $uraian_singkat,
        'tanggal_pertama_kali_diumumkan' => $tanggal_pertama_kali_diumumkan,
        'kota_pertama_kali_diumumkan' => $kota_pertama_kali_diumumkan,
        'jenis_pendanaan' => $jenis_pendanaan,
    ];
    
    // Redirect kembali ke input_awal.php dengan pesan error
    header('Location: ../Frontend/input_awal.php?error=Data tidak lengkap. Harap isi semua kolom yang wajib.');
    exit();
}

// Simpan data ke session
$_SESSION['input_awal'] = [
    'judul' => $judul,
    'jenis_permohonan' => $jenis_permohonan,
    'jenis_ciptaan' => $jenis_ciptaan,
    'uraian_singkat' => $uraian_singkat,
    'tanggal_pertama_kali_diumumkan' => $tanggal_pertama_kali_diumumkan,
    'kota_pertama_kali_diumumkan' => $kota_pertama_kali_diumumkan,
    'jenis_pendanaan' => $jenis_pendanaan,
];

// Redirect ke halaman input.php
unset($_SESSION['data_pengusul']);
header('Location: ../Frontend/input.php');
exit();
?>
