<?php
session_start();
include '../koneksi.php';

header('Content-Type: application/json');

$id = $_POST['delete_id'] ?? '';
$role = $_POST['role'] ?? '';

if ($id && $role) {
    if ($role == 'Dosen') {
        $query = "DELETE FROM data_pribadi_dosen WHERE id = '$id'";
    } elseif ($role == 'Mahasiswa') {
        $query = "DELETE FROM data_pribadi_mahasiswa WHERE id = '$id'";
    } else {
        echo json_encode(['success' => false, 'message' => 'Role tidak valid']);
        exit;
    }

    if ($conn->query($query)) {
        echo json_encode(['success' => true, 'message' => 'Data berhasil dihapus']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal menghapus data']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID atau Role tidak ditemukan']);
}
exit;
