<?php
session_start();
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'Admin') {
    header('Location: ../login.php');
    exit;
}

include_once __DIR__ . '/../config/config.php';

// Fetch members
$memberStmt = $pdo->query("SELECT id, name_bn, name_en, member_code FROM members_info ORDER BY name_bn ASC");
$members = $memberStmt->fetchAll(PDO::FETCH_ASSOC);

// Designation list
$designations = [
    'president' => 'President (সভাপতি)',
    'vice_president' => 'Vice President (উপ-সভাপতি)',
    'secretary' => 'Secretary (সচিব)',
    'treasurer' => 'Treasurer (কোষাধ্যক্ষ)',
    'member' => 'Member (সদস্য)'
];

// Fetch committee members
$stmt = $pdo->query("SELECT * FROM committee_member ORDER BY id ASC");
$committees = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include_once __DIR__ . '/../includes/open.php'; ?>

<div class="container-fluid pb-5 hero-header bg-light">
  <div class="row">
    <?php include_once __DIR__ . '/../includes/side_bar.php'; ?>
    <main class="col-12 col-md-9 col-lg-9 px-md-4">
      <div class="container">
        <div class="card shadow-lg rounded-3 border-0">
          <div class="card-body p-4">
            <h3 class="mb-3 text-primary fw-bold">Committee <span class="text-secondary">( কমিটি )</span></h3> 
            <hr class="mb-4" />

            <!-- Add Committee Form -->
            <form method="post" action="../process/committee_process.php">
              <input type="hidden" name="action" value="insert">
              <div class="row">
                <div class="col-12 col-md-6 mb-3">
                  <label for="member_id" class="form-label">Member Name (সদস্যের নাম)</label>
                  <select class="form-select" id="member_id" name="member_id" required>
                    <option value="">Select Member (সদস্য বাছাই করুন)</option>
                    <?php foreach($members as $member): ?>
                      <option value="<?= $member['id'] ?>">
                        <?= htmlspecialchars($member['name_bn']) ?> (<?= htmlspecialchars($member['name_en']) ?>) (<?= htmlspecialchars($member['member_code']) ?>)
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="col-12 col-md-6 mb-3">
                  <label for="designation" class="form-label">Designation (পদবি)</label>
                  <select class="form-select" id="designation" name="designation" required>
                    <option value="">Select Designation (পদবি বাছাই করুন)</option>
                    <?php foreach($designations as $key => $val): ?>
                      <option value="<?= $key ?>"><?= $val ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="col-12 col-md-6 mb-3">
                  <label for="facebook" class="form-label">Facebook</label>
                  <input type="text" class="form-control" id="facebook" name="facebook" required>
                </div>

                <div class="col-12 col-md-6 mb-3">
                  <label for="linkedin" class="form-label">LinkedIn</label>
                  <input type="text" class="form-control" id="linkedin" name="linkedin" required>
                </div>

                <div class="col-12 mt-4 text-end">
                  <button type="submit" class="btn btn-primary btn-lg px-4 shadow-sm">
                    Save Committee (কমিটি সংরক্ষণ করুন)
                  </button>
                </div>
              </div>
            </form>

            <hr class="my-4" />

            <!-- Committee Table -->
            <div class="table-responsive">
              <table class="table table-bordered align-middle">
                <thead class="table-light">
                  <tr>
                    <th>ID</th>
                    <th>Designation</th>
                    <th>Member Info</th>
                    <th>Social</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($committees as $committee): ?>
                  <tr>
                    <td><?= $committee['id']; ?></td>
                    <td><?= htmlspecialchars($committee['position']); ?></td>
                    <td>
                      <?= htmlspecialchars($committee['member_code']); ?><br>
                      <?= htmlspecialchars($committee['name_en']); ?><br>
                      <?= htmlspecialchars($committee['name_bn']); ?>
                    </td>
                    <td>
                      <?= htmlspecialchars($committee['fb']); ?><br>
                      <?= htmlspecialchars($committee['li']); ?>
                    </td>
                    <td>
                      <!-- Delete Button -->
                      <form action="../process/committee_process.php" method="post" style="display:inline-block;">
                        <input type="hidden" name="id" value="<?= $committee['id']; ?>">
                        <button type="submit" name="action" value="delete" class="btn btn-danger btn-sm" onclick="return confirm('Delete This committee?');">
                          <i class="fa fa-trash"></i>
                        </button>
                      </form>

                      <!-- Edit Button -->
                      <button type="button" class="btn btn-info btn-sm"
                        onclick='editCommittee(
                          <?= (int)$committee["id"] ?>,
                          <?= json_encode($committee["member_id"]) ?>,
                          <?= json_encode($committee["position"]) ?>,
                          <?= json_encode($committee["fb"]) ?>,
                          <?= json_encode($committee["li"]) ?>
                        )'>
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

        <!-- Edit Committee Modal -->
        <div class="modal fade" id="editCommitteeModal" tabindex="-1" aria-labelledby="editCommitteeModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <form action="../process/committee_process.php" method="post">
                <div class="modal-header">
                  <h5 class="modal-title" id="editCommitteeModalLabel">Edit Committee Member</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                  <input type="hidden" name="action" value="update">
                  <input type="hidden" name="id" id="edit_id">

                  <div class="row">
                    <div class="col-12 col-md-6 mb-3">
                      <label for="edit_member_id" class="form-label">Member Name (সদস্যের নাম)</label>
                      <select class="form-select" id="edit_member_id" name="edit_member_id" required>
                        <option value="">Select Member</option>
                        <?php foreach($members as $member): ?>
                          <option value="<?= $member['id'] ?>">
                            <?= htmlspecialchars($member['name_bn']) ?> (<?= htmlspecialchars($member['name_en']) ?>) (<?= htmlspecialchars($member['member_code']) ?>)
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                      <label for="edit_designation" class="form-label">Designation (পদবি)</label>
                      <select class="form-select" id="edit_designation" name="edit_designation" required>
                        <option value="">Select Designation</option>
                        <?php foreach($designations as $key => $val): ?>
                          <option value="<?= $key ?>"><?= $val ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                      <label for="edit_facebook" class="form-label">Facebook</label>
                      <input type="text" class="form-control" id="edit_facebook" name="edit_facebook">
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                      <label for="edit_linkedin" class="form-label">LinkedIn</label>
                      <input type="text" class="form-control" id="edit_linkedin" name="edit_linkedin">
                    </div>
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Update Committee (কমিটি হালনাগাদ করুন)</button>
                </div>
              </form>
            </div>
          </div>
        </div>

      </div>
    </main>
  </div>
</div>

<?php include_once __DIR__ . '/../includes/end.php'; ?>

<!-- Edit JS -->
<script>
function editCommittee(id, member_id, designation, fb, li) {
    document.getElementById('edit_id').value = id;
    document.getElementById('edit_member_id').value = member_id;
    document.getElementById('edit_designation').value = designation;
    document.getElementById('edit_facebook').value = fb || '';
    document.getElementById('edit_linkedin').value = li || '';

    // Show Bootstrap modal
    const modal = new bootstrap.Modal(document.getElementById('editCommitteeModal'));
    modal.show();
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include '../includes/toast.php'; ?>
