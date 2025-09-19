<?php
session_start();
include_once __DIR__ . '/../process/user_access_helper.php';
if (isset($_SESSION['user_id']) && isset($_SESSION['member_id'])) {
	include_once __DIR__ . '/../config/config.php';
	update_user_logout($pdo, $_SESSION['user_id'], $_SESSION['member_id']);
}
session_unset();
session_destroy();
header('Location: ../index.php');
exit;
?>
