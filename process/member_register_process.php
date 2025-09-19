<?php
// Full CRUD for members_info using PDO (Refactored & Fixed)

// DB config
include_once __DIR__ . '/../config/config.php';

// Helper: Generate next member_code (CPSS-00001...)
function generateMemberCode($pdo) {
    $stmt = $pdo->query("SELECT MAX(id) as max_id FROM members_info");
    $row = $stmt->fetch();
    $next = ($row && $row['max_id']) ? $row['max_id'] + 1 : 1;
    return 'CPSS-' . str_pad($next, 5, '0', STR_PAD_LEFT);
}

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST') {
    try {
        $pdo->beginTransaction();

        // Insert new member
        $member_code = generateMemberCode($pdo);
        $fields = [
            'name_bn', 'name_en', 'father_name', 'mother_name', 'nid', 'dob', 'religion', 'marital_status', 'spouse_name',
            'mobile', 'gender', 'education', 'agreed_rules'
        ];
        $data = [];
        foreach ($fields as $f) {
            $data[$f] = isset($_POST[$f]) ? trim($_POST[$f]) : null;
        }
        $profile_image_path = null;
        if (isset($_FILES['profile_image']) && is_uploaded_file($_FILES['profile_image']['tmp_name'])) {   
            $allowed_extensions = ['jpg', 'jpeg', 'png'];
            $ext = strtolower(pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION));
            if (in_array($ext, $allowed_extensions)) {
                $userImgDir = dirname(__DIR__) . '/user_images';
                $memberDir = $userImgDir . '/member_' . $member_code;
                if (!is_dir($memberDir)) {
                    mkdir($memberDir, 0777, true);
                }
                $imgFileName = 'profile_image_' . time() . '_' . uniqid() . '.' . $ext;
                $imgPath = $memberDir . '/' . $imgFileName;
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mimeType = finfo_file($finfo, $_FILES['profile_image']['tmp_name']);
                finfo_close($finfo);
                $allowed_mime_types = ['image/jpeg', 'image/png', 'image/jpg'];
                if (in_array($mimeType, $allowed_mime_types)) {
                    if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $imgPath)) {
                        $profile_image_path = 'user_images/member_' . $member_code . '/' . $imgFileName;
                    } else {
                        throw new Exception('Error uploading the profile image.');
                    }
                } else {
                    throw new Exception('Invalid image file type.');
                }
            } else {
                throw new Exception('Invalid file extension.');
            }
        }

        // Insert into members_info
        $sql = "INSERT INTO members_info (member_code, name_bn, name_en, father_name, mother_name, nid, dob, religion, marital_status, spouse_name, mobile, gender, education, agreed_rules, profile_image, created_at) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW())";
        $stmt = $pdo->prepare($sql);
        $ok = $stmt->execute([
            $member_code,
            $data['name_bn'],
            $data['name_en'],
            $data['father_name'],
            $data['mother_name'],
            $data['nid'],
            $data['dob'],
            $data['religion'],
            $data['marital_status'],
            $data['spouse_name'],
            $data['mobile'],
            $data['gender'],
            $data['education'],
            $data['agreed_rules'],
            $profile_image_path
        ]);
        if (!$ok) throw new Exception('Insert failed (members_info)');

        $member_id = $pdo->lastInsertId();

        // Insert into member_office
        $office_fields = ['office_name', 'office_address', 'position'];
        $office_data = [];
        foreach ($office_fields as $f) {
            $office_data[$f] = isset($_POST[$f]) ? trim($_POST[$f]) : null;
        }
        $sql_office = "INSERT INTO member_office (member_id, member_code, office_name, office_address, position, created_at) VALUES (?,?,?,?,?,NOW())";
        $stmt_office = $pdo->prepare($sql_office);
        $ok_office = $stmt_office->execute([
            $member_id, $member_code,
            $office_data['office_name'], $office_data['office_address'], $office_data['position']
        ]);
        if (!$ok_office) throw new Exception('Insert failed (member_office)');

        // Insert into member_nominee
        $nominee_names = $_POST['nominee_name'] ?? [];
        $nominee_relations = $_POST['nominee_relation'] ?? [];
        $nominee_nids = $_POST['nominee_nid'] ?? [];
        $nominee_dobs = $_POST['nominee_dob'] ?? [];
        $nominee_percents = $_POST['nominee_percent'] ?? [];
        $nominee_images = $_FILES['nominee_image'] ?? null;
        for ($i = 0; $i < count($nominee_names); $i++) {
            $nominee_image_path = null;
            if ($nominee_images && isset($nominee_images['tmp_name'][$i]) && is_uploaded_file($nominee_images['tmp_name'][$i])) {
                $allowed_extensions = ['jpg', 'jpeg', 'png'];
                $ext = strtolower(pathinfo($nominee_images['name'][$i], PATHINFO_EXTENSION));
                if (in_array($ext, $allowed_extensions)) {
                    $userImgDir = dirname(__DIR__) . '/user_images';
                    $memberDir = $userImgDir . '/member_' . $member_code;
                    $imgFileName = 'nominee_' . ($i+1) . '_' . time() . '_' . uniqid() . '.' . $ext;
                    $imgPath = $memberDir . '/' . $imgFileName;
                    $finfo = finfo_open(FILEINFO_MIME_TYPE);
                    $mimeType = finfo_file($finfo, $nominee_images['tmp_name'][$i]);
                    finfo_close($finfo);
                    $allowed_mime_types = ['image/jpeg', 'image/png', 'image/jpg'];
                    if (in_array($mimeType, $allowed_mime_types)) {
                        if (move_uploaded_file($nominee_images['tmp_name'][$i], $imgPath)) {
                            $nominee_image_path = 'user_images/member_' . $member_code . '/' . $imgFileName;
                        } else {
                            throw new Exception('Error uploading the nominee image.');
                        }
                    } else {
                        throw new Exception('Invalid nominee image file type.');
                    }
                } else {
                    throw new Exception('Invalid nominee file extension.');
                }
            }
            $sql_nominee = "INSERT INTO member_nominee (member_id, member_code, name, relation, nid, dob, percentage, nominee_image) VALUES (?,?,?,?,?,?,?,?)";
            $stmt_nominee = $pdo->prepare($sql_nominee);
            $ok_nominee = $stmt_nominee->execute([
                $member_id,
                $member_code,
                $nominee_names[$i] ?? '',
                $nominee_relations[$i] ?? '',
                $nominee_nids[$i] ?? '',
                $nominee_dobs[$i] ?? '',
                $nominee_percents[$i] ?? '',
                $nominee_image_path
            ]);
            if (!$ok_nominee) throw new Exception('Nominee insert failed');
        }

        // Insert into member_share
        $sql_share = "INSERT INTO member_share (member_id, member_code, no_share, admission_fee, idcard_fee, passbook_fee, softuses_fee, created_at) VALUES (?,?,?,?,?,?,?,NOW())";
        $stmt_share = $pdo->prepare($sql_share);
        $ok_share = $stmt_share->execute([
            $member_id, $member_code,
            $_POST['share'] ?? null,
            $_POST['admission_fee'] ?? null,
            $_POST['idcard_fee'] ?? null,
            $_POST['passbook_fee'] ?? null,
            $_POST['softuses_fee'] ?? null
        ]);
        if (!$ok_share) throw new Exception('Share insert failed');

        // Insert into user_login
        $username = trim($_POST['username'] ?? '');
        $password = md5(trim($_POST['password'] ?? ''));
        $re_password = trim($_POST['retype_password'] ?? '');
        $sql_user = "INSERT INTO user_login (member_id, member_code, user_name, password, re_password, role, status, created_at) VALUES (?,?,?,?,?,?,?,NOW())";
        $stmt_user = $pdo->prepare($sql_user);
        $ok_user = $stmt_user->execute([
            $member_id, $member_code, $username, $password, $re_password, 'user', 'I'
        ]);
        if (!$ok_user) throw new Exception('User insert failed');

        $pdo->commit();

        session_start();
        $_SESSION['success_msg'] = 'আপনার আবেদনটি সফলভাবে প্রেরণ করা হয়েছে, অনুমোদনের জন্য অপেক্ষা করুন (Your application has been sent successfully, wait for approval)! Member Code: ' . $member_code . ', Name: ' . $data['name_en'];
        header('Location: ../member_register.php');
        exit;
    } catch (Exception $e) {
        $pdo->rollBack();
        // Clean up uploaded images if any
        if (isset($member_code)) {
            $userImgDir = dirname(__DIR__) . '/user_images';
            $memberDir = $userImgDir . '/member_' . $member_code;
            if (is_dir($memberDir)) {
                // Remove all files in the member directory
                $files = glob($memberDir . '/*');
                foreach ($files as $file) {
                    if (is_file($file)) {
                        unlink($file);
                    }
                }
                // Remove the member directory itself
                rmdir($memberDir);
            }
        }
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
        exit;
    }
}

if ($method === 'GET') {
    // Fetch member(s)
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $stmt = $pdo->prepare("SELECT * FROM members_info WHERE id = ?");
        $stmt->execute([$id]);
        $member = $stmt->fetch();

        $stmt_office = $pdo->prepare("SELECT * FROM member_office WHERE member_id = ?");
        $stmt_office->execute([$id]);
        $office = $stmt_office->fetch();

        $stmt_nominee = $pdo->prepare("SELECT * FROM member_nominee WHERE member_id = ?");
        $stmt_nominee->execute([$id]);
        $nominees = $stmt_nominee->fetchAll();

        echo json_encode(['member' => $member, 'office' => $office, 'nominees' => $nominees]);
    } else {
        $stmt = $pdo->query("SELECT * FROM members_info ORDER BY id DESC");
        $members = $stmt->fetchAll();
        foreach ($members as &$member) {
            $id = $member['id'];
            $stmt_office = $pdo->prepare("SELECT * FROM member_office WHERE member_id = ?");
            $stmt_office->execute([$id]);
            $member['office'] = $stmt_office->fetch();

            $stmt_nominee = $pdo->prepare("SELECT * FROM member_nominee WHERE member_id = ?");
            $stmt_nominee->execute([$id]);
            $member['nominees'] = $stmt_nominee->fetchAll();
        }
        echo json_encode($members);
    }
    exit;
}

if ($method === 'PUT' || $method === 'PATCH') {
    parse_str(file_get_contents('php://input'), $_PUT);
    if (!isset($_GET['id'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Missing id']);
        exit;
    }
    $id = $_GET['id'];

    // Update members_info
    $fields = ['name_bn', 'name_en', 'father_name', 'mother_name', 'nid', 'dob', 'religion', 'marital_status', 'spouse_name', 'mobile', 'gender', 'education'];
    $set = [];
    $params = [];
    foreach ($fields as $f) {
        if (isset($_PUT[$f])) {
            $set[] = "$f = ?";
            $params[] = $_PUT[$f];
        }
    }
    if ($set) {
        $params[] = $id;
        $sql = "UPDATE members_info SET " . implode(',', $set) . " WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
    }

    // Update member_office
    $office_fields = ['office_name', 'office_address', 'position'];
    $office_set = [];
    $office_params = [];
    foreach ($office_fields as $f) {
        if (isset($_PUT[$f])) {
            $office_set[] = "$f = ?";
            $office_params[] = $_PUT[$f];
        }
    }
    if ($office_set) {
        $office_params[] = $id;
        $sql_office = "UPDATE member_office SET " . implode(',', $office_set) . " WHERE member_id = ?";
        $stmt_office = $pdo->prepare($sql_office);
        $stmt_office->execute($office_params);
    }

    // Update nominees (delete all and re-insert)
    if (isset($_PUT['nominee_name'])) {
        $pdo->prepare("DELETE FROM member_nominee WHERE member_id = ?")->execute([$id]);
        $nominee_names = $_PUT['nominee_name'] ?? [];
        $nominee_relations = $_PUT['nominee_relation'] ?? [];
        $nominee_nids = $_PUT['nominee_nid'] ?? [];
        $nominee_dobs = $_PUT['nominee_dob'] ?? [];
        $nominee_percents = $_PUT['nominee_percent'] ?? [];
        for ($i = 0; $i < count($nominee_names); $i++) {
            $sql_nominee = "INSERT INTO member_nominee (member_id, member_code, name, relation, nid, dob, percentage) VALUES (?,?,?,?,?,?,?)";
            $stmt_nominee = $pdo->prepare($sql_nominee);
            $stmt_nominee->execute([
                $id,
                $_PUT['member_code'] ?? '',
                $nominee_names[$i] ?? '',
                $nominee_relations[$i] ?? '',
                $nominee_nids[$i] ?? '',
                $nominee_dobs[$i] ?? '',
                $nominee_percents[$i] ?? ''
            ]);
        }
    }
    echo json_encode(['success' => true]);
    exit;
}

if ($method === 'DELETE') {
    if (!isset($_GET['id'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Missing id']);
        exit;
    }
    $id = $_GET['id'];
    $pdo->prepare("DELETE FROM member_nominee WHERE member_id = ?")->execute([$id]);
    $pdo->prepare("DELETE FROM member_office WHERE member_id = ?")->execute([$id]);
    $stmt = $pdo->prepare("DELETE FROM members_info WHERE id = ?");
    $ok = $stmt->execute([$id]);
    echo json_encode(['success' => $ok]);
    exit;
}

http_response_code(405);
echo json_encode(['error' => 'Method not allowed']);
?>
