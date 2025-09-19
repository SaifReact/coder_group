<?php
session_start();
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'Admin') {
    header('Location: ../login.php');
    exit;
}
include_once '../config/config.php';

// Fetch current settings (assuming a table 'setup' with one row)
$stmt = $pdo->query("SELECT * FROM setup LIMIT 1");
$settings = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
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
                        <h3 class="mb-3 text-primary fw-bold">Site Settings</h3>
                        <hr class="mb-4" />
                        <form method="post" action="../process/update_settings.php">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="site_name_bn" class="form-label">Site Name (Bangla)</label>
                                    <input type="text" class="form-control" id="site_name_bn" name="site_name_bn" value="<?= htmlspecialchars($settings['site_name_bn'] ?? '') ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="site_name_en" class="form-label">Site Name (English)</label>
                                    <input type="text" class="form-control" id="site_name_en" name="site_name_en" value="<?= htmlspecialchars($settings['site_name_en'] ?? '') ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="registration_no" class="form-label">Registration No</label>
                                    <input type="text" class="form-control" id="registration_no" name="registration_no" value="<?= htmlspecialchars($settings['registration_no'] ?? '') ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($settings['email'] ?? '') ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone1" class="form-label">Phone 1</label>
                                    <input type="text" class="form-control" id="phone1" name="phone1" value="<?= htmlspecialchars($settings['phone1'] ?? '') ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone2" class="form-label">Phone 2</label>
                                    <input type="text" class="form-control" id="phone2" name="phone2" value="<?= htmlspecialchars($settings['phone2'] ?? '') ?>">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control" id="address" name="address" rows="2"><?= htmlspecialchars($settings['address'] ?? '') ?></textarea>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="about_text" class="form-label">About/Description</label>
                                    <textarea class="form-control" id="about_text" name="about_text" rows="5"><?= htmlspecialchars($settings['about_text'] ?? '') ?></textarea>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="rules_regulation" class="form-label">Rules & Regulations</label>
                                    <textarea class="form-control" id="rules_regulation" name="rules_regulation" rows="6"><?= htmlspecialchars($settings['rules_regulation'] ?? '') ?></textarea>
                                </div>
                                <div class="col-12 mt-4 text-end">
                                    <button type="submit" class="btn btn-primary btn-lg px-4 shadow-sm">
                                        <i class="fa fa-save me-2"></i> Update Settings
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<?php include '../includes/footer.php'; ?>
<?php include '../includes/js.php'; ?>
<!-- CKEditor 5 CDN -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.2.0/classic/ckeditor.js"></script>
<script>
ClassicEditor.create(document.querySelector('#about_text'), {
    toolbar: ['bold', 'italic', 'underline', 'link', 'bulletedList', 'numberedList', 'undo', 'redo']
}).catch(error => {});

ClassicEditor.create(document.querySelector('#rules_regulation'), {
    toolbar: ['bold', 'italic', 'underline', 'link', 'bulletedList', 'numberedList', 'undo', 'redo']
}).catch(error => {});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include '../includes/toast.php'; ?>
</body>
</html>