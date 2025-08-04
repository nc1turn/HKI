<?php
session_start();
include 'koneksi.php';

$user_id = $_SESSION['user_id']; // Pastikan session user_id sudah ada
$user_role = $_SESSION['role'];
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$search = isset($_GET['search']) ? $_GET['search'] : '';
$limit = 25;
$offset = ($page - 1) * $limit;

// Admin can see all data, regular users can only see their own data
if ($user_role === 'admin') {
    if (!empty($search)) {
        $sql = "SELECT dp.*, u.file_sp, u.file_sph, u.file_contoh_karya, u.file_ktp, u.file_bukti_pembayaran 
                FROM detail_permohonan dp 
                LEFT JOIN uploads u ON dp.dataid = u.dataid 
                WHERE dp.judul LIKE ? 
                ORDER BY dp.id DESC LIMIT ? OFFSET ?";
        $stmt = $conn->prepare($sql);
        $searchTerm = "%$search%";
        $stmt->bind_param("sii", $searchTerm, $limit, $offset);
    } else {
        $sql = "SELECT dp.*, u.file_sp, u.file_sph, u.file_contoh_karya, u.file_ktp, u.file_bukti_pembayaran 
                FROM detail_permohonan dp 
                LEFT JOIN uploads u ON dp.dataid = u.dataid 
                ORDER BY dp.id DESC LIMIT ? OFFSET ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $limit, $offset);
    }
} else {
    if (!empty($search)) {
        $sql = "SELECT dp.*, u.file_sp, u.file_sph, u.file_contoh_karya, u.file_ktp, u.file_bukti_pembayaran 
                FROM detail_permohonan dp 
                LEFT JOIN uploads u ON dp.dataid = u.dataid 
                WHERE dp.user_id=? AND dp.judul LIKE ? 
                ORDER BY dp.id DESC LIMIT ? OFFSET ?";
        $stmt = $conn->prepare($sql);
        $searchTerm = "%$search%";
        $stmt->bind_param("isii", $user_id, $searchTerm, $limit, $offset);
    } else {
        $sql = "SELECT dp.*, u.file_sp, u.file_sph, u.file_contoh_karya, u.file_ktp, u.file_bukti_pembayaran 
                FROM detail_permohonan dp 
                LEFT JOIN uploads u ON dp.dataid = u.dataid 
                WHERE dp.user_id=? 
                ORDER BY dp.id DESC LIMIT ? OFFSET ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iii", $user_id, $limit, $offset);
    }
}

$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode($data);
?>
