<?php
session_start();
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'Admin') {
    header('Location: ../login.php');
    exit;
}
include_once '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $site_name_bn     = $_POST['site_name_bn'] ?? '';
    $site_name_en     = $_POST['site_name_en'] ?? '';
    $registration_no  = $_POST['registration_no'] ?? '';
    $address          = $_POST['address'] ?? '';
    $email            = $_POST['email'] ?? '';
    $phone1           = $_POST['phone1'] ?? '';
    $phone2           = $_POST['phone2'] ?? '';
    $about_text       = $_POST['about_text'] ?? '';
    $rules_regulation = $_POST['rules_regulation'] ?? '';

    // Update settings (assuming only one row, id=1)
    $stmt = $pdo->prepare("UPDATE setup SET site_name_bn=?, site_name_en=?, registration_no=?, address=?, email=?, phone1=?, phone2=?, about_text=?, rules_regulation=? WHERE id=1");
    $stmt->execute([
        $site_name_bn,
        $site_name_en,
        $registration_no,
        $address,
        $email,
        $phone1,
        $phone2,
        $about_text,
        $rules_regulation
    ]);

    $_SESSION['success_msg'] = "Settings updated successfully..! (সফলভাবে হালনাগাদ করা হলো..!)";
    header('Location: ../admin/settings.php');
    exit;
} else {
    header('Location: ../admin/settings.php');
    exit;
}