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

// Generate dataid untuk sesi ini
$dataid = uniqid(prefix:'data_', more_entropy:true);

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

// Update user's dataid in database
$user_id = $_SESSION['user_id'];
include 'koneksi.php';
$update_sql = "UPDATE users SET dataid = ? WHERE id = ?";
$update_stmt = $conn->prepare($update_sql);
$update_stmt->bind_param("si", $dataid, $user_id);
$update_stmt->execute();
$update_stmt->close();

// Redirect ke halaman input.php dengan dataid
unset($_SESSION['data_pengusul']);
header('Location: ../Frontend/input.php?dataid=' . urlencode($dataid));
exit();
?>
