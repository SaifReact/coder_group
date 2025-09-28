<?php
session_start();
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'Admin') {
    header('Location: ../login.php');
    exit;
}

include_once __DIR__ . '/../config/config.php';

$stmt = $pdo->query("SELECT * FROM services ORDER BY id ASC");
$services = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include_once __DIR__ . '/../includes/open.php'; ?>

<!-- Hero Start -->
<div class="container-fluid pb-5 hero-header bg-light">
  <div class="row">
      <?php include_once __DIR__ . '/../includes/side_bar.php'; ?>
    <main class="col-12 col-md-9 col-lg-9 px-md-4">
            <div class="container">
                <div class="card shadow-lg rounded-3 border-0">
                    <div class="card-body p-4">
                        <h3 class="mb-3 text-primary fw-bold">Services</h3>
                        <hr class="mb-4" />
                        <form method="post" enctype="multipart/form-data" action="../process/service_process.php">
                            <input type="hidden" name="action" value="insert">
                                <div class="row">
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="service_name_bn" class="form-label">Service Name (Bangla)</label>
                                    <input type="text" class="form-control" id="service_name_bn" name="service_name_bn" required>
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="service_name_en" class="form-label">Service Name (English)</label>
                                    <input type="text" class="form-control" id="service_name_en" name="service_name_en" required>
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="about_service" class="form-label">About Service</label>
                                    <textarea class="form-control" id="about_service" name="about_service" rows="5"></textarea>
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="icon" class="form-label">Icon</label>
                                    <input type="text" class="form-control" id="icon" name="icon" required>
                                </div>
                                <div class="col-12 mt-4 text-end">
                                    <button type="submit" class="btn btn-primary btn-lg px-4 shadow-sm">
                                        <i class="fa fa-save me-2"></i> Save Service
                                    </button>
                                </div>
                            </div>
                        </div>
                        </form>
                        <hr class="my-4" />
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Service Name</th>
                                        <th>About Service</th>
                                        <th>Icon</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($services as $service): ?>
                                    <tr>
                                        <td><?= $service['id']; ?></td>
                                        <td><?= htmlspecialchars($service['service_name_en']); ?> <br>
                                            <?= htmlspecialchars($service['service_name_bn']); ?></td>
                                        <td><?= strip_tags($service['about_service'], '<p><ul><li><b><i><br>'); ?></td>
                                        <td><i class="fa <?= htmlspecialchars($service['icon']); ?>"></i></td>
                                        <td>
                                            <a href="edit_service.php?id=<?= $service['id']; ?>" class="btn btn-sm btn-warning">
                                                <i class="fa fa-edit me-1"></i> Edit
                                            </a>    
                                            <a href="../process/service_process.php?action=delete&id=<?= $service['id']; ?>" 
                                            class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Are you sure you want to delete this service?');">
                                                <i class="fa fa-trash me-1"></i> Delete         
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
  </div>
  
</div>
<!-- Hero End -->

<?php include_once __DIR__ . '/../includes/end.php'; ?>

<script src="https://cdn.ckeditor.com/ckeditor5/41.2.0/classic/ckeditor.js"></script>
<script>
ClassicEditor.create(document.querySelector('#about_service'), {
    toolbar: ['bold', 'italic', 'underline', 'link', 'bulletedList', 'numberedList', 'undo', 'redo']
}).catch(error => {});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include '../includes/toast.php'; ?>
