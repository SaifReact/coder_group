<?php
include_once __DIR__ . '/../config/config.php';
header('Content-Type: application/json; charset=utf-8');
error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('display_errors', 0);

session_start();
try {
    if (!isset($_SESSION['user_id'])) {
        throw new Exception('User not logged in.');
    }

    $user_id = $_SESSION['user_id'];
    $stmt = $pdo->prepare("SELECT user_name, password, member_id, member_code, re_password FROM user_login WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        throw new Exception('User not found.');
    }

    // Validate POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }
    
    $previouspassword = $_POST['previous_password'] ?? '';
    $newpassword    = $_POST['password'] ?? '';
    $retypepassword = $_POST['retype_password'] ?? '';

    if ($newpassword === '' || $retypepassword === '') {
        throw new Exception('Please fill all fields.');
    }
    if ($newpassword !== $retypepassword) {
        throw new Exception('New passwords do not match.');
    }
    if (strlen($newpassword) < 6) {
        throw new Exception('Password must be at least 6 characters long.');
    }
    // Verify previous password

    if ($previouspassword === $newpassword ) {
        throw new Exception('Previous Password same to New Password.');
    }

    $md5pass = md5($newpassword);

    // Update password
    $stmtUpdate = $pdo->prepare("UPDATE user_login SET password = ?, re_password = ? WHERE id = ? AND member_id = ? AND member_code = ?");
    $stmtUpdate->execute([$md5pass, $retypepassword, $user_id, $user['member_id'], $user['member_code']]);

    echo json_encode(['success' => true, 'message' => 'Password updated successfully.']);
} catch (Exception $e) {
    error_log('Password reset failed: ' . $e->getMessage());
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}