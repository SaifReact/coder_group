<?php
session_start();
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'Admin') {
    header('Location: ../login.php');
    exit;
}

include_once __DIR__ . '/../config/config.php';

$action = $_POST['action'] ?? '';

if ($action === 'insert') {
    $member_id = $_POST['member_id'] ?? '';
    $designation = $_POST['designation'] ?? '';
    $facebook = $_POST['facebook'] ?? '';
    $linkedin = $_POST['linkedin'] ?? '';

    if ($member_id && $designation) {
        // fetch member info
        $stmt = $pdo->prepare("SELECT member_code, name_bn, name_en FROM members_info WHERE id = ?");
        $stmt->execute([$member_id]);
        $member = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($member) {
            $stmt = $pdo->prepare("
                INSERT INTO committee_member 
                    (member_id, member_code, name_bn, name_en, position, fb, li, created_at) 
                VALUES 
                    (?, ?, ?, ?, ?, ?, ?, NOW())
            ");
            $stmt->execute([
                $member_id,
                $member['member_code'],
                $member['name_bn'],
                $member['name_en'],
                $designation,
                $facebook,
                $linkedin
            ]);
            $_SESSION['success_msg'] = "Committee member added successfully!";
        } else {
            $_SESSION['error_msg'] = "Member not found!";
        }
    } else {
        $_SESSION['error_msg'] = "Required fields missing!";
    }

    header("Location: ../admin/committee.php");
    exit;

} elseif ($action === 'update') {
    $id = $_POST['id'] ?? '';
    $member_id = $_POST['member_id'] ?? '';
    $designation = $_POST['designation'] ?? '';
    $facebook = $_POST['facebook'] ?? '';
    $linkedin = $_POST['linkedin'] ?? '';

    if ($id && $member_id && $designation) {
        // fetch member info
        $stmt = $pdo->prepare("SELECT member_code, name_bn, name_en FROM members_info WHERE id = ?");
        $stmt->execute([$member_id]);
        $member = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($member) {
            $stmt = $pdo->prepare("
                UPDATE committee_member SET 
                    member_id = ?, 
                    member_code = ?, 
                    name_bn = ?, 
                    name_en = ?, 
                    position = ?, 
                    fb = ?, 
                    li = ? 
                WHERE id = ?
            ");
            $stmt->execute([
                $member_id,
                $member['member_code'],
                $member['name_bn'],
                $member['name_en'],
                $designation,
                $facebook,
                $linkedin,
                $id
            ]);
            $_SESSION['success_msg'] = "Committee member updated successfully!";
        } else {
            $_SESSION['error_msg'] = "Member not found!";
        }
    } else {
        $_SESSION['error_msg'] = "Required fields missing!";
    }

    header("Location: ../admin/committee.php");
    exit;

} elseif ($action === 'delete') {
    $id = $_POST['id'] ?? '';

    if ($id) {
        $stmt = $pdo->prepare("DELETE FROM committee_member WHERE id = ?");
        $stmt->execute([$id]);
        $_SESSION['success_msg'] = "Committee member deleted successfully!";
    } else {
        $_SESSION['error_msg'] = "Invalid request!";
    }

    header("Location: ../admin/committee.php");
    exit;

} else {
    $_SESSION['error_msg'] = "Invalid action!";
    header("Location: ../admin/committee.php");
    exit;
}
