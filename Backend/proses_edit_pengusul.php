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
    $id = $_POST['id'] ?? null;
    $role = $_POST['role'] ?? '';
    $nama = $_POST['nama'] ?? '';
    $alamat = $_POST['alamat'] ?? '';
    $kode_pos = $_POST['kode_pos'] ?? '';
    $nomor_telepon = $_POST['nomor_telepon'] ?? '';
    $email = $_POST['email'] ?? '';
    $fakultas = $_POST['fakultas'] ?? '';

    if (!$id || !$role || empty($nama) || empty($alamat) || empty($kode_pos) || empty($nomor_telepon) || empty($email) || empty($fakultas)) {
        header('Location: ../Frontend/input.php?error=Data tidak lengkap');
        exit();
    }

    if ($role === 'Dosen') {
        $sql = "UPDATE data_pribadi_dosen SET Nama = ?, Alamat = ?, Kode_Pos = ?, Nomor_Telepon = ?, Email = ?, Fakultas = ? WHERE id = ?";
    } else {
        $sql = "UPDATE data_pribadi_mahasiswa SET Nama = ?, Alamat = ?, Kode_Pos = ?, Nomor_Telepon = ?, Email = ?, Fakultas = ? WHERE id = ?";
    }

    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ssssssi", $nama, $alamat, $kode_pos, $nomor_telepon, $email, $fakultas, $id);

        if ($stmt->execute()) {
            header('Location: ../Frontend/input.php?success=Data berhasil diperbarui');
        } else {
            header('Location: ../Frontend/input.php?error=Gagal memperbarui data');
        }

        $stmt->close();
    } else {
        header('Location: ../Frontend/input.php?error=Gagal menyiapkan statement');
    }
}

$conn->close();
?>
