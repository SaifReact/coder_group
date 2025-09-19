<?php
include_once '../includes/head.php';
include_once '../config/config.php';

// Fetch companies
$stmt = $pdo->query("SELECT * FROM company ORDER BY id DESC");
$companies = $stmt->fetchAll();
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
                        <h3 class="mb-3 text-primary fw-bold">Company Management</h3>
                        <hr class="mb-4" />
                        <form action="../process/company_process.php" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="company_name_en" class="form-label">Company Name (English)</label>
                                    <input type="text" class="form-control" id="company_name_en" name="company_name_en" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="company_name_bn" class="form-label">Company Name (Bangla)</label>
                                    <input type="text" class="form-control" id="company_name_bn" name="company_name_bn" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="company_image" class="form-label">Company Logo</label>
                                    <input type="file" class="form-control" id="company_image" name="company_image" accept="image/*" required onchange="previewCompanyImage(event)">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <img id="companyImagePreview" src="#" alt="Preview" style="display:none;max-height:80px;margin-top:8px;">
                                </div>
                                <div class="col-12 mt-4 text-end">
                                    <button type="submit" name="action" value="insert" class="btn btn-primary btn-lg px-4 shadow-sm">
                                        <i class="fa fa-plus me-2"></i> Add Company
                                    </button>
                                </div>
                            </div>
                        </form>
                        <hr class="my-4" />
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Company Name (English)</th>
                                        <th>Company Name (Bangla)</th>
                                        <th>Logo</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($companies as $company): ?>
                                    <tr>
                                        <td><?= $company['id']; ?></td>
                                        <td><?= htmlspecialchars($company['company_name_en']); ?></td>
                                        <td><?= htmlspecialchars($company['company_name_bn']); ?></td>
                                        <td>
                                            <img src="../company/<?= htmlspecialchars($company['company_image']); ?>" style="height:40px;cursor:pointer;" onclick="showCompanyModal('../company/<?= htmlspecialchars($company['company_image']); ?>')">
                                        </td>
                                        <td>
                                            <form action="../process/company_process.php" method="post" style="display:inline-block;">
                                                <input type="hidden" name="id" value="<?= $company['id']; ?>">
                                                <button type="submit" name="action" value="delete" class="btn btn-danger btn-sm" onclick="return confirm('Delete this company?');">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                            <button type="button" class="btn btn-info btn-sm" onclick="editCompany(<?= $company['id']; ?>, '<?= htmlspecialchars($company['company_name_en'], ENT_QUOTES); ?>', '<?= htmlspecialchars($company['company_name_bn'], ENT_QUOTES); ?>', '../company/<?= htmlspecialchars($company['company_image']); ?>')">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Company Image Modal -->
                <div class="modal fade" id="companyImageModal" tabindex="-1" aria-labelledby="companyImageModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-xl modal-dialog-centered" style="max-width:98vw;width:98vw;">
                    <div class="modal-content">
                      <div class="modal-header border-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body text-center">
                        <img id="companyModalImg" src="#" alt="Company Logo" style="max-width:100%;max-height:70vh;border-radius:8px;box-shadow:0 2px 16px #000a;">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Edit Modal -->
                <div class="modal fade" id="editCompanyModal" tabindex="-1" aria-labelledby="editCompanyModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <form action="../process/company_process.php" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                          <h5 class="modal-title" id="editCompanyModalLabel">Edit Company</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <input type="hidden" name="id" id="edit_id">
                          <div class="row">
                            <div class="mb-3 col-md-6">
                              <label for="edit_company_name_en" class="form-label">Company Name (English)</label>
                              <input type="text" class="form-control" id="edit_company_name_en" name="company_name_en" required>
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="edit_company_name_bn" class="form-label">Company Name (Bangla)</label>
                              <input type="text" class="form-control" id="edit_company_name_bn" name="company_name_bn" required>
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="edit_company_image" class="form-label">Company Logo (optional)</label>
                              <input type="file" class="form-control" id="edit_company_image" name="company_image" accept="image/*" onchange="previewEditCompanyImage(event)">
                              <img id="editCompanyImagePreview" src="#" alt="Preview" style="display:none;max-height:80px;margin-top:8px;">
                            </div>
                            <div class="mb-3 col-md-6">
                              <label>Current Logo</label>
                              <img id="editCompanyCurrentImage" src="#" alt="Current Logo" style="max-height:80px;">
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" name="action" value="update" class="btn btn-primary">Update Company</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
            </div>
        </main>
    </div>
</div>
<?php include '../includes/footer.php'; ?>
<?php include '../includes/js.php'; ?>
<script>
function previewCompanyImage(event) {
  var img = document.getElementById('companyImagePreview');
  if(event.target.files && event.target.files[0]) {
    img.src = URL.createObjectURL(event.target.files[0]);
    img.style.display = 'block';
  } else {
    img.style.display = 'none';
  }
}
function showCompanyModal(src) {
  document.getElementById('companyModalImg').src = src;
  var modal = new bootstrap.Modal(document.getElementById('companyImageModal'));
  modal.show();
}
function previewEditCompanyImage(event) {
  var img = document.getElementById('editCompanyImagePreview');
  if(event.target.files && event.target.files[0]) {
    img.src = URL.createObjectURL(event.target.files[0]);
    img.style.display = 'block';
  } else {
    img.style.display = 'none';
  }
}
function editCompany(id, nameEn, nameBn, imgSrc) {
  document.getElementById('edit_id').value = id;
  document.getElementById('edit_company_name_en').value = nameEn;
  document.getElementById('edit_company_name_bn').value = nameBn;
  document.getElementById('editCompanyCurrentImage').src = imgSrc;
  document.getElementById('editCompanyImagePreview').style.display = 'none';
  var modal = new bootstrap.Modal(document.getElementById('editCompanyModal'));
  modal.show();
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include '../includes/toast.php'; ?>
</body>
</html>