<?php
ob_start();
session_start();
// Bersihkan data pengusul setiap login
unset($_SESSION['data_pengusul']);
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        header('Location: ../frontend/login.php?m=empty');
        exit();
    }

    $stmt = $conn->prepare("SELECT id, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($row = $res->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['role'];
            if ($row['role'] === 'admin') {
                header('Location: ../frontend/review_ad.php');
            } else {
                header('Location: ../frontend/menu_input.php');
            }
            exit();
        }
    }

    header('Location: ../frontend/login.php?m=wrong');
    exit();
} else {
    header('Location: ../frontend/login.php');
    exit();
}
?>