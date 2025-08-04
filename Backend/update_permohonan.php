<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../Frontend/login.php?m=nfound');
    exit();
}

include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $judul = $_POST['judul'] ?? '';
    $jenis_permohonan = $_POST['jenis_permohonan'] ?? '';
    $jenis_ciptaan = $_POST['jenis_ciptaan'] ?? '';
    $kota_pertama_kali_diumumkan = $_POST['kota_pertama_kali_diumumkan'] ?? '';
    $uraian_singkat = $_POST['uraian_singkat'] ?? '';

    // Validate input
    if (empty($id) || empty($judul) || empty($jenis_ciptaan) || empty($kota_pertama_kali_diumumkan)) {
        header('Location: ../Frontend/daftar_user.php?error=Data tidak lengkap');
        exit();
    }

    // Update permohonan data
    $sql = "UPDATE detail_permohonan SET 
            judul = ?, 
            jenis_permohonan = ?, 
            jenis_ciptaan = ?, 
            kota_pertama_kali_diumumkan = ?, 
            uraian_singkat = ? 
            WHERE id = ? AND user_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssii", 
        $judul, 
        $jenis_permohonan, 
        $jenis_ciptaan, 
        $kota_pertama_kali_diumumkan, 
        $uraian_singkat, 
        $id, 
        $_SESSION['user_id']
    );

    if ($stmt->execute()) {
        header('Location: ../Frontend/daftar_user.php?success=Data berhasil diperbarui');
    } else {
        header('Location: ../Frontend/daftar_user.php?error=Gagal memperbarui data');
    }
} else {
    header('Location: ../Frontend/daftar_user.php?error=Request tidak valid');
}
?> 