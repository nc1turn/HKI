<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hki";

// Koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dataid = $_POST['dataid'];
    $uploads = [
        'file_sp' => null,
        'file_sph' => null,
        'file_contoh_karya' => null,
        'file_ktp' => null,
        'file_bukti_pembayaran' => null
    ];

    foreach ($uploads as $key => &$filePath) {
        if (isset($_FILES[$key]) && $_FILES[$key]['error'] === 0) {
            $ext = pathinfo($_FILES[$key]['name'], PATHINFO_EXTENSION);
            $filePath = "uploads/{$key}_{$dataid}." . $ext;
            move_uploaded_file($_FILES[$key]['tmp_name'], $filePath);
        }
    }

    $sql = "INSERT INTO uploads (dataid, file_sp, file_sph, file_contoh_karya, file_ktp, file_bukti_pembayaran) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "ssssss",
        $dataid,
        $uploads['file_sp'],
        $uploads['file_sph'],
        $uploads['file_contoh_karya'],
        $uploads['file_ktp'],
        $uploads['file_bukti_pembayaran']
    );

    if ($stmt->execute()) {
        header("Location: ../Frontend/daftar_user.php?status=success");
    } else {
        header("Location: ../Frontend/upload.php?status=error&msg=" . urlencode("Gagal menyimpan data ke database."));
    }

    $stmt->close();
}
$conn->close();
?>