<?php
session_start();
include_once __DIR__ . '/../config/config.php';
include_once __DIR__ . '/user_access_helper.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === '' || $password === '') {
        $_SESSION['login_error'] = 'Username and password are required.';
        header('Location: ../login.php');
        exit;
    }

    // Hash password (assuming md5 as in your registration)
    $password_hash = md5($password);

    $stmt = $pdo->prepare("SELECT * FROM user_login WHERE user_name = ? AND password = ? AND status = 'A' LIMIT 1");
    $stmt->execute([$username, $password_hash]);
    $user = $stmt->fetch();

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['user_name'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['member_id'] = $user['member_id'];
        $_SESSION['member_code'] = $user['member_code'];
        $_SESSION['re_password'] = $user['re_password'];
        // Log user access
        log_user_access($pdo, $user['id'], $user['member_id']);
        // Redirect based on role
        if ($user['role'] === 'Admin') {
            header('Location: ../admin/index.php');
        } elseif ($user['role'] === 'user') {
            header('Location: ../users/index.php');
        } else {
            $_SESSION['login_error'] = 'Username not found.';
            header('Location: ../login.php');
        }
        exit;
    } else {
        $_SESSION['login_error'] = 'Username not found.';
        header('Location: ../login.php');
        exit;
    }
} else {
    header('Location: ../login.php');
    exit;
}