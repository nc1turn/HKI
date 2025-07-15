<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idp = $_POST['id_permohonan'];
    $status = $conn->real_escape_string($_POST['status']);

    // Gunakan prepared statement untuk update status
    $stmt = $conn->prepare("UPDATE review_ad SET status = ? WHERE id_permohonan = ?");
    $stmt->bind_param("ss", $status, $idp);
    $stmt->execute();

    // Jika status adalah "Terdaftar" dan file sertifikat diunggah
    if ($status === 'Terdaftar' && !empty($_FILES['sertifikat']['tmp_name'])) {
        $file = addslashes(file_get_contents($_FILES['sertifikat']['tmp_name']));

        // Gunakan prepared statement untuk update sertifikat
        $stmt = $conn->prepare("UPDATE review_ad SET sertifikat = ? WHERE id_permohonan = ?");
        $stmt->bind_param("ss", $file, $idp);
        $stmt->execute();
    }

    // Redirect ke halaman review_ad
    header('Location: ../frontend/review_ad.php');
    exit();
}
?>