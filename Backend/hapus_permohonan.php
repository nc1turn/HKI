<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    
    if (empty($id)) {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'ID tidak valid']);
        exit();
    }

    // Check if user owns this permohonan
    $checkSql = "SELECT id FROM detail_permohonan WHERE id = ? AND user_id = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("ii", $id, $_SESSION['user_id']);
    $checkStmt->execute();
    $result = $checkStmt->get_result();
    
    if ($result->num_rows === 0) {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Data tidak ditemukan atau tidak memiliki akses']);
        exit();
    }

    // Delete related uploads first
    $deleteUploadsSql = "DELETE FROM uploads WHERE dataid = (SELECT dataid FROM detail_permohonan WHERE id = ?)";
    $deleteUploadsStmt = $conn->prepare($deleteUploadsSql);
    $deleteUploadsStmt->bind_param("i", $id);
    $deleteUploadsStmt->execute();

    // Delete permohonan
    $deleteSql = "DELETE FROM detail_permohonan WHERE id = ? AND user_id = ?";
    $deleteStmt = $conn->prepare($deleteSql);
    $deleteStmt->bind_param("ii", $id, $_SESSION['user_id']);
    
    if ($deleteStmt->execute()) {
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Data berhasil dihapus']);
    } else {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Gagal menghapus data']);
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Request tidak valid']);
}
?>
