<?php
session_start();
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'Admin') {
    header('Location: ../login.php');
    exit;
}
include_once '../config/config.php';

// Handle status update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'], $_POST['status'])) {
    $user_id = (int)$_POST['user_id'];
    $status = in_array($_POST['status'], ['A', 'I', 'R']) ? $_POST['status'] : 'I';
    $stmt = $pdo->prepare("UPDATE user_login SET status = ? WHERE id = ?");
    $stmt->execute([$status, $user_id]);
}

// Fetch all users
$stmt = $pdo->query("SELECT a.id, a.member_id, a.status, b.member_code, b.name_en, b.name_bn, b.mobile FROM user_login a, members_info b WHERE b.id = a.member_id AND a.role != 'Admin' ORDER BY a.id DESC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?><!DOCTYPE html>
<html lang="en">
<?php include '../includes/head.php'; ?>
<body>
<?php include '../includes/header.php'; ?>
<div class="container-fluid py-5">
    <div class="row">
        <?php include '../includes/side_bar.php'; ?>
        <main class="col-12 col-md-10 col-lg-10 px-md-4">
            <div class="container py-5">
                <div class="card shadow-lg rounded-3 border-0">
                    <div class="card-body p-4">
                        <h3 class="mb-3 text-primary fw-bold">Member Register & Status</h3>
                        <hr class="mb-4" />
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Member ID</th>
                                        <th>Member Code</th>
                                        <th>Member Name</th>
                                        <th>Mobile</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($user['id']) ?></td>
                                        <td><?= htmlspecialchars($user['member_code']) ?></td>
                                        <td><?= htmlspecialchars($user['name_en']) ?></td>
                                        <td><?= htmlspecialchars($user['mobile']) ?></td>
                                        <td>
                                            <form method="post" class="d-flex align-items-center">
                                                <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                                <select name="status" class="form-select form-select-sm me-2">
                                                    <option value="A" <?= $user['status'] === 'A' ? 'selected' : '' ?>>Approved</option>
                                                    <option value="I" <?= $user['status'] === 'I' ? 'selected' : '' ?>>Inactive</option>
                                                    <option value="R" <?= $user['status'] === 'R' ? 'selected' : '' ?>>Rejected</option>
                                                </select>
                                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                            </form>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm view-member-btn" 
                                                data-user-id="<?= htmlspecialchars($user['id']) ?>" 
                                                title="View Details">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- View Member Modal and other includes remain unchanged -->
                <?php include 'view_member.php'; ?>
            </div>
        </main>
    </div>
</div>
<?php include '../includes/footer.php'; ?>
<?php include '../includes/js.php'; ?>
<script>
// Handle view icon click
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.view-member-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var userId = this.getAttribute('data-user-id');
            var modalBody = document.getElementById('viewMemberModalBody');
            modalBody.innerHTML = '<div class="text-center py-4"><div class="spinner-border text-primary" role="status"></div></div>';
            var modal = new bootstrap.Modal(document.getElementById('viewMemberModal'));
            modal.show();
            // Fetch details via AJAX
            fetch('member_details.php?id=' + encodeURIComponent(userId))
                .then(resp => resp.text())
                .then(html => { modalBody.innerHTML = html; })
                .catch(() => { modalBody.innerHTML = '<div class="alert alert-danger">Could not load details.</div>'; });
        });
    });
});
</script>
</body>
</html>