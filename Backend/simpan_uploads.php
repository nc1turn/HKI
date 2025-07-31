<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../Frontend/login.php?m=nfound');
    exit();
}
include 'koneksi.php';

if (isset($_FILES['file'])) {
    // Pastikan koneksi database valid
    if (!$conn) {
        die("Koneksi ke database gagal.");
    }

    // Ambil data dari session dan file upload
    $idp = $_SESSION['id_permohonan'];
    $fileName = $_FILES['file']['name'];
    $fileTmp = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileType = mime_content_type($fileTmp);

    // Validasi file (hanya izinkan PDF dengan ukuran maksimal 2MB)
    if ($fileType !== 'application/pdf' || $fileSize > 2 * 1024 * 1024) {
        header('Location: ../frontend/upload.php?m=invalid_file');
        exit();
    }

    // Baca isi file
    $fileContent = addslashes(file_get_contents($fileTmp));

    // Gunakan prepared statement untuk menyimpan data
    $stmt = $conn->prepare("INSERT INTO uploads (id_permohonan, nama_file, data_file) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $idp, $fileName, $fileContent);

    if ($stmt->execute()) {
        // Reset id untuk permohonan baru
        unset($_SESSION['id_permohonan']);
        header('Location: ../frontend/daftar_user.php');
        exit();
    } else {
        die("Error: " . $stmt->error);
    }
} else {
    header('Location: ../frontend/daftar_user.php');
    exit();
}
?>