<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hki";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dataid = $_POST['dataid'] ?? '';
    $role = $_POST['role'] ?? '';
    $nama = $_POST['nama'] ?? '';
    $alamat = $_POST['alamat'] ?? '';
    $kode_pos = $_POST['kode_pos'] ?? '';
    $nomor_telepon = $_POST['nomor_telepon'] ?? '';
    $email = $_POST['email'] ?? '';
    $fakultas = $_POST['fakultas'] ?? '';

    if (empty($dataid) || empty($role) || empty($nama) || empty($alamat) || empty($kode_pos) || empty($nomor_telepon) || empty($email) || empty($fakultas)) {
        header('Location: ../Frontend/input.php?error=Data tidak lengkap');
        exit();
    }

    if ($role === 'Dosen') {
        $sql = "INSERT INTO data_pribadi_dosen (dataid, Nama, Alamat, Kode_Pos, Nomor_Telepon, Email, Fakultas) VALUES (?, ?, ?, ?, ?, ?, ?)";
    } else {
        $sql = "INSERT INTO data_pribadi_mahasiswa (dataid, Nama, Alamat, Kode_Pos, Nomor_Telepon, Email, Fakultas) VALUES (?, ?, ?, ?, ?, ?, ?)";
    }

    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("sssssss", $dataid, $nama, $alamat, $kode_pos, $nomor_telepon, $email, $fakultas);

        if ($stmt->execute()) {
            header('Location: ../Frontend/input.php?success=Data berhasil ditambahkan');
        } else {
            header('Location: ../Frontend/input.php?error=Gagal menyimpan data');
        }

        $stmt->close();
    } else {
        header('Location: ../Frontend/input.php?error=Gagal menyiapkan statement');
    }
}

$conn->close();
?>
