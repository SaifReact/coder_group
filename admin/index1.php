<?php
session_start();
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'Admin') {
    header('Location: ../login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include '../includes/head.php'; ?>
<body>
<?php include '../includes/header.php'; ?>
<div class="container-fluid py-5">
    <div class="row">
        <!-- Sidebar (col-2) -->
        <?php include '../includes/side_bar.php'; ?>
        <!-- Main Content (col-10) -->
        <main class="col-12 col-md-10 col-lg-10 px-md-4">
            <div class="pt-5">
                <h2 class="mb-4">Admin Dashboard</h2>  
                <hr>
                <?php
                // Fetch member counts
                include_once '../config/config.php';
                $approved = $pdo->query("SELECT COUNT(*) FROM user_login WHERE status='A' and role = 'user'")->fetchColumn();
                $pending = $pdo->query("SELECT COUNT(*) FROM user_login WHERE status='I' and role = 'user'")->fetchColumn();
                $rejected = $pdo->query("SELECT COUNT(*) FROM user_login WHERE status='R' and role = 'user'")->fetchColumn();
                ?>
                <div class="row g-4 mb-4">
                  <div class="col-md-3">
                    <div class="card shadow-sm border-0 text-center" style="cursor:pointer" data-bs-toggle="modal" data-bs-target="#approvedModal">
                      <div class="card-body">
                        <h5 class="text-success fw-bold">Approved Members</h5>
                        <div class="display-6 fw-bold text-success"><?php echo $approved; ?></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="card shadow-sm border-0 text-center" style="cursor:pointer" data-bs-toggle="modal" data-bs-target="#pendingModal">
                      <div class="card-body">
                        <h5 class="text-warning fw-bold">Pending Members</h5>
                        <div class="display-6 fw-bold text-warning"><?php echo $pending; ?></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="card shadow-sm border-0 text-center" style="cursor:pointer" data-bs-toggle="modal" data-bs-target="#rejectedModal">
                      <div class="card-body">
                        <h5 class="text-danger fw-bold">Rejected Members</h5>
                        <div class="display-6 fw-bold text-danger"><?php echo $rejected; ?></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="card shadow-sm border-0 text-center">
                      <div class="card-body">
                        <h5 class="text-primary fw-bold">Total Deposit</h5>
                        <div class="display-6 fw-bold text-primary">৳ <?php echo number_format($deposit ?? 0, 2); ?></div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Approved Members Modal -->
                <div class="modal fade" id="approvedModal" tabindex="-1" aria-labelledby="approvedModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="approvedModalLabel">Approved Members List</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="table-responsive">
                          <table class="table table-bordered align-middle">
                            <thead class="table-light">
                              <tr>
                                <th>Member Code</th>
                                <th>Name (Bangla)</th>
                                <th>Name (English)</th>
                                <th>Mobile</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              $stmt = $pdo->query("SELECT a.member_code, a.name_bn, a.name_en, a.mobile FROM members_info a, user_login b WHERE a.id = b.member_id and b.status='A' and b.role = 'user' ORDER BY b.id DESC");
                              while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo '<tr>';
                                echo '<td>'.htmlspecialchars($row['member_code']).'</td>';
                                echo '<td>'.htmlspecialchars($row['name_bn']).'</td>';
                                echo '<td>'.htmlspecialchars($row['name_en']).'</td>';
                                echo '<td>'.htmlspecialchars($row['mobile']).'</td>';
                                echo '</tr>';
                              }
                              ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Pending Members Modal -->
                <div class="modal fade" id="pendingModal" tabindex="-1" aria-labelledby="pendingModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="pendingModalLabel">Pending Members List</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="table-responsive">
                          <table class="table table-bordered align-middle">
                            <thead class="table-light">
                              <tr>
                                <th>Member Code</th>
                                <th>Name (Bangla)</th>
                                <th>Name (English)</th>
                                <th>Mobile</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              $stmt = $pdo->query("SELECT a.member_code, a.name_bn, a.name_en, a.mobile FROM members_info a, user_login b WHERE a.id = b.member_id and b.status='I' and b.role = 'user' ORDER BY b.id DESC");
                              while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo '<tr>';
                                echo '<td>'.htmlspecialchars($row['member_code']).'</td>';
                                echo '<td>'.htmlspecialchars($row['name_bn']).'</td>';
                                echo '<td>'.htmlspecialchars($row['name_en']).'</td>';
                                echo '<td>'.htmlspecialchars($row['mobile']).'</td>';
                                echo '</tr>';
                              }
                              ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Rejected Members Modal -->
                <div class="modal fade" id="rejectedModal" tabindex="-1" aria-labelledby="rejectedModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="rejectedModalLabel">Rejected Members List</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="table-responsive">
                          <table class="table table-bordered align-middle">
                            <thead class="table-light">
                              <tr>
                                <th>Member Code</th>
                                <th>Name (Bangla)</th>
                                <th>Name (English)</th>
                                <th>Mobile</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              $stmt = $pdo->query("SELECT a.member_code, a.name_bn, a.name_en, a.mobile FROM members_info a, user_login b WHERE a.id = b.member_id and b.status='R' and b.role = 'user' ORDER BY b.id DESC");
                              while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo '<tr>';
                                echo '<td>'.htmlspecialchars($row['member_code']).'</td>';
                                echo '<td>'.htmlspecialchars($row['name_bn']).'</td>';
                                echo '<td>'.htmlspecialchars($row['name_en']).'</td>';
                                echo '<td>'.htmlspecialchars($row['mobile']).'</td>';
                                echo '</tr>';
                              }
                              ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Add your main dashboard content here -->
            </div>
        </main>
    </div>
</div>
<?php include '../includes/footer.php'; ?>
<?php include '../includes/js.php'; ?>
</body>
</html>