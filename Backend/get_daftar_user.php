<?php
session_start();
include 'koneksi.php';

$user_id = $_SESSION['user_id']; // Pastikan session user_id sudah ada
$user_role = $_SESSION['role'];
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 25;
$offset = ($page - 1) * $limit;

// Admin can see all data, regular users can only see their own data
if ($user_role === 'admin') {
    $sql = "SELECT * FROM detail_permohonan ORDER BY id DESC LIMIT ? OFFSET ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $limit, $offset);
} else {
    $sql = "SELECT * FROM detail_permohonan WHERE user_id=? ORDER BY id DESC LIMIT ? OFFSET ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $user_id, $limit, $offset);
}
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
?>
