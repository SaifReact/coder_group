<?php
include_once '../config/config.php';

$action = $_POST['action'] ?? '';

if ($action === 'insert') {
    $company_name_en = $_POST['company_name_en'] ?? '';
    $company_name_bn = $_POST['company_name_bn'] ?? '';
    $company_image = $_FILES['company_image'] ?? null;

    if ($company_name_en && $company_name_bn && $company_image) {
        $image_name = time() . '_' . basename($company_image['name']);
        $target_dir = '../company/';
        $target_file = $target_dir . $image_name;

        if (move_uploaded_file($company_image['tmp_name'], $target_file)) {
            $stmt = $pdo->prepare("INSERT INTO company (company_name_en, company_name_bn, company_image) VALUES (:company_name_en, :company_name_bn, :company_image)");
            $stmt->execute([
                ':company_name_en' => $company_name_en,
                ':company_name_bn' => $company_name_bn,
                ':company_image' => $image_name,
            ]);
            header('Location: ../admin/company.php?success=Company added successfully');
        } else {
            header('Location: ../admin/company.php?error=Failed to upload image');
        }
    } else {
        header('Location: ../admin/company.php?error=Invalid input');
    }
} elseif ($action === 'update') {
    $id = $_POST['id'] ?? '';
    $company_name_en = $_POST['company_name_en'] ?? '';
    $company_name_bn = $_POST['company_name_bn'] ?? '';
    $company_image = $_FILES['company_image'] ?? null;

    if ($id && $company_name_en && $company_name_bn) {
        $stmt = $pdo->prepare("SELECT company_image FROM company WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $existing_company = $stmt->fetch();

        $image_name = $existing_company['company_image'];

        if ($company_image && $company_image['tmp_name']) {
            $image_name = time() . '_' . basename($company_image['name']);
            $target_dir = '../company/';
            $target_file = $target_dir . $image_name;

            if (move_uploaded_file($company_image['tmp_name'], $target_file)) {
                if (file_exists($target_dir . $existing_company['company_image'])) {
                    unlink($target_dir . $existing_company['company_image']);
                }
            } else {
                header('Location: ../admin/company.php?error=Failed to upload image');
                exit;
            }
        }

        $stmt = $pdo->prepare("UPDATE company SET company_name_en = :company_name_en, company_name_bn = :company_name_bn, company_image = :company_image WHERE id = :id");
        $stmt->execute([
            ':company_name_en' => $company_name_en,
            ':company_name_bn' => $company_name_bn,
            ':company_image' => $image_name,
            ':id' => $id,
        ]);
        header('Location: ../admin/company.php?success=Company updated successfully');
    } else {
        header('Location: ../admin/company.php?error=Invalid input');
    }
} elseif ($action === 'delete') {
    $id = $_POST['id'] ?? '';

    if ($id) {
        $stmt = $pdo->prepare("SELECT company_image FROM company WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $existing_company = $stmt->fetch();

        if ($existing_company) {
            $stmt = $pdo->prepare("DELETE FROM company WHERE id = :id");
            $stmt->execute([':id' => $id]);

            $target_dir = '../company/';
            if (file_exists($target_dir . $existing_company['company_image'])) {
                unlink($target_dir . $existing_company['company_image']);
            }

            header('Location: ../admin/company.php?success=Company deleted successfully');
        } else {
            header('Location: ../admin/company.php?error=Company not found');
        }
    } else {
        header('Location: ../admin/company.php?error=Invalid input');
    }
} else {
    header('Location: ../admin/company.php?error=Invalid action');
}
?>