<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}
include_once '../config/config.php';
$member_id = $_SESSION['member_id'];
$no_share = 1;
$admission_paid = false;
$stmt = $pdo->prepare("SELECT no_share, admission_fee FROM member_share WHERE member_id = ? LIMIT 1");
$stmt->execute([$member_id]);
if ($row = $stmt->fetch()) {
    $no_share = (float)$row['no_share'];
    $admission_paid = !is_null($row['admission_fee']);
}
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
            <h3 class="mb-3 text-primary fw-bold">Make a Payment <span class="text-secondary">(পেমেন্ট করুন)</span></h3>
            <hr class="mb-4" />
            <form method="post" action="../process/payment_process.php">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="payment_type" class="form-label">Payment Type</label>
                  <select class="form-select" id="payment_type" name="payment_type" required>
                    <option value="">Select (বাছাই করুন)</option>
                    <option value="admission">Admission-Share Fee (ভর্তি-শেয়ার ফি)</option>
                    <option value="january">January (জানুয়ারি)</option>
                    <option value="february">February (ফেব্রুয়ারি)</option>
                    <option value="march">March (মার্চ)</option>
                    <option value="april">April (এপ্রিল)</option>
                    <option value="may">May (মে)</option>
                    <option value="june">June (জুন)</option>
                    <option value="july">July (জুলাই)</option>
                    <option value="august">August (আগস্ট)</option>
                    <option value="september">September (সেপ্টেম্বর)</option>
                    <option value="october">October (অক্টোবর)</option>
                    <option value="november">November (নভেম্বর)</option>
                    <option value="december">December (ডিসেম্বর)</option>
                  </select>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="payment_year" class="form-label">Year</label>
                  <select class="form-select" id="payment_year" name="payment_year" required>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                    <option value="2027">2027</option>
                  </select>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="amount" class="form-label">Amount</label>
                  <input type="number" step="0.01" class="form-control" id="amount" name="amount" required>
                  <div id="admissionInfo" class="form-text text-info" style="display:none;">
                    প্রতি শেয়ার মূল্য ৫০০০ টাকা এবং আপনার মোট শেয়ার সংখ্যা: <span id="shareCount"></span>
                  </div>
                  <div id="admissionPaidMsg" class="form-text text-danger" style="display:none;">
                    ভর্তি ফি প্রদান করা হয়েছে
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="bank_trans" class="form-label">Bank Transaction</label>
                  <input type="text" class="form-control" id="bank_trans" name="bank_trans" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="payment_date" class="form-label">Date</label>
                  <input type="date" class="form-control" id="payment_date" name="payment_date" required>
                </div>
                <div class="col-12 mt-4 text-end">
                  <button type="submit" class="btn btn-primary btn-lg px-4 shadow-sm">Submit Payment</button>
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
<?php include '../includes/toast.php'; ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
  var paymentType = document.getElementById('payment_type');
  var amountInput = document.getElementById('amount');
  var admissionInfo = document.getElementById('admissionInfo');
  var admissionPaidMsg = document.getElementById('admissionPaidMsg');
  var shareCount = document.getElementById('shareCount');
  var noShare = <?php echo json_encode($no_share); ?>;
  var admissionPaid = <?php echo json_encode($admission_paid); ?>;
  paymentType.addEventListener('change', function() {
    if (this.value === 'admission') {
      if (admissionPaid) {
        amountInput.value = '';
        amountInput.disabled = true;
        admissionInfo.style.display = 'none';
        admissionPaidMsg.style.display = 'block';
      } else {
        amountInput.value = (noShare * 5000).toFixed(2);
        amountInput.disabled = false;
        shareCount.textContent = noShare;
        admissionInfo.style.display = 'block';
        admissionPaidMsg.style.display = 'none';
      }
    } else {
      amountInput.value = '';
      amountInput.disabled = false;
      admissionInfo.style.display = 'none';
      admissionPaidMsg.style.display = 'none';
    }
  });
  // Initial state if admission is already selected
  if (paymentType.value === 'admission') {
    if (admissionPaid) {
      amountInput.value = '';
      amountInput.disabled = true;
      admissionInfo.style.display = 'none';
      admissionPaidMsg.style.display = 'block';
    } else {
      amountInput.value = (noShare * 5000).toFixed(2);
      amountInput.disabled = false;
      shareCount.textContent = noShare;
      admissionInfo.style.display = 'block';
      admissionPaidMsg.style.display = 'none';
    }
  }
});
</script>
</body>
</html>
