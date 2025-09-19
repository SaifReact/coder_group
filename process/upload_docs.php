<?php
include_once __DIR__ . '/../config/config.php';
// upload_docs.php
header('Content-Type: application/json; charset=utf-8');
error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('display_errors', 0);

// --- quick debug: log what arrived ---
error_log("POST: " . print_r($_POST, true));
error_log("FILES: " . print_r($_FILES, true));

try {
    // Validate identity context
    $member_id   = isset($_POST['member_id'])   ? (int)$_POST['member_id']   : 0;
    $member_code = isset($_POST['member_code']) ? $_POST['member_code'] : '';

    if ($member_id <= 0 || $member_code === '') {
        throw new Exception('Member context missing.');
    }

    if (!isset($_FILES['required_documents'])) {
        throw new Exception('No files received.');
    }

    $doc_types = isset($_POST['required_document_types']) ? $_POST['required_document_types'] : [];
    $names     = $_FILES['required_documents']['name'];
    $tmp_names = $_FILES['required_documents']['tmp_name'];
    $sizes     = $_FILES['required_documents']['size'];
    $errors    = $_FILES['required_documents']['error'];

    $count = is_array($names) ? count($names) : 0;
    if ($count === 0) {
        throw new Exception('Empty upload.');
    }
    if (!is_array($doc_types) || count($doc_types) !== $count) {
        throw new Exception('Mismatch between document types and files count.');
    }

    // Check if member_id, member_code, and doc_type already exist in member_documents
    $duplicateFound = false;
    for ($i = 0; $i < $count; $i++) {
        $doc_type = $doc_types[$i];
        $stmtCheck = $pdo->prepare("SELECT COUNT(*) FROM member_documents WHERE member_id = ? AND member_code = ? AND doc_type = ?");
        $stmtCheck->execute([$member_id, $member_code, $doc_type]);
        $exists = $stmtCheck->fetchColumn();
        if ($exists > 0) {
            echo json_encode(['success' => false, 'message' => 'Member Code: ' . $member_code . ', Doc Type: ' . $doc_type . ' ডাটাবেস এ ডাটা বিদ্যমান রয়েছে (Already exists in database)..!']);
            exit;
        }
    }

    // --- prepare storage directory ---
    $baseDir   = dirname(__DIR__) . '/user_images';
    $memberDir = $baseDir . '/member_' . $member_code;

    $allowedExt  = ['jpg', 'jpeg', 'png'];
    $allowedMime = ['image/jpeg', 'image/png'];
    $maxBytes    = 3 * 1024 * 1024; // 3MB

    // $pdo->beginTransaction();
    $saved = 0;

    for ($i = 0; $i < $count; $i++) {
        $doc_type = $doc_types[$i];
        $name     = $names[$i];
        $tmp_name = $tmp_names[$i];
        $size     = $sizes[$i];
        $err      = $errors[$i];

        if ((string)$doc_type === '' || (string)$name === '') continue;
        if ($err !== UPLOAD_ERR_OK) {
            error_log("Upload error for index $i: code=$err");
            continue;
        }
        if (!is_uploaded_file($tmp_name)) {
            error_log("Not an uploaded file for index $i");
            continue;
        }

        // Validate extension + MIME
        $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        if (!in_array($ext, $allowedExt, true)) {
            error_log("Bad extension for $name");
            continue;
        }
        if ($size > $maxBytes) {
            error_log("File too large ($size bytes): $name");
            continue;
        }
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime  = finfo_file($finfo, $tmp_name);
        finfo_close($finfo);
        if (!in_array($mime, $allowedMime, true)) {
            error_log("Bad MIME $mime for $name");
            continue;
        }

        // Save
        $imgFileName = 'doc_' . preg_replace('/\D+/', '', $doc_type) . '_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
        $destPath    = $memberDir . '/' . $imgFileName;

        if (!move_uploaded_file($tmp_name, $destPath)) {
            error_log("move_uploaded_file failed for $name");
            continue;
        }

        $doc_path = 'user_images/member_' . $member_code . '/' . $imgFileName;

        $stmt = $pdo->prepare("INSERT INTO member_documents (member_id, member_code, doc_type, doc_path, created_at) VALUES (?,?,?,?,NOW())");
        $stmt->execute([$member_id, $member_code, $doc_type, $doc_path]);

        $saved++;
    }

    // $pdo->commit();

    if ($saved === 0) {
        throw new Exception('No files were saved.');
    }

    echo json_encode(['success' => true, 'saved' => $saved]);
} catch (Exception $e) {
    // if (isset($pdo)) $pdo->rollBack();
    error_log('Upload failed: ' . $e->getMessage());
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
