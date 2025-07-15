<?php
session_start();
include 'koneksi.php';
include 'generate_id.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pastikan koneksi database valid
    if (!$conn) {
        die("Koneksi ke database gagal.");
    }

    // Generate ID otomatis
    $idp = generate_id($conn);
    $_SESSION['id_permohonan'] = $idp;

    // Ambil input form
    $judul = $conn->real_escape_string($_POST['judul']);
    $jenis = $conn->real_escape_string($_POST['jenis_ciptaan']);
    $email = trim($_POST['email']);

    // Validasi input
    if (empty($judul) || empty($jenis) || empty($email)) {
        header('Location: ../frontend/inputawal.php?m=empty');
        exit();
    }

    // Insert data ke database
    $sql = "INSERT INTO detail_permohonan (id_permohonan, username, email, judul, jenis_ciptaan)
            VALUES ('$idp', '{$_SESSION['username']}', '$email', '$judul', '$jenis')";
    if ($conn->query($sql) === TRUE) {
        header('Location: ../frontend/input.php');
        exit();
    } else {
        die("Error: " . $conn->error);
    }
} else {
    header('Location: ../frontend/inputawal.php');
    exit();
}
?>