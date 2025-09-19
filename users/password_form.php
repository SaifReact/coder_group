<?php
session_start();
if (!isset($_SESSION['user_id'])) {
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
         <!-- Sidebar (col-3) -->
         <?php include '../includes/side_bar.php'; ?>
         <!-- Main Content (col-9) -->
         <main class="col-12 col-md-10 col-lg-10 px-md-4">
            <div class="container py-5">
               <div class="card shadow-lg rounded-3 border-0">
                  <div class="card-body p-4">
                     <h3 class="mb-3 text-primary fw-bold">
                        Password Change (পাসওয়ার্ড পরিবর্তন)
                     </h3>
                     <hr class="mb-4" />
                     <form id="resetForm" action="../process/password_reset.php" method="post" autocomplete="off">
                        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>">
                        <input type="hidden" name="member_id" value="<?php echo htmlspecialchars($_SESSION['member_id']); ?>">
                        <input type="hidden" name="member_code" value="<?php echo htmlspecialchars($_SESSION['member_code']); ?>">
                        <div class="row">
                           <div class="col-md-6 mb-3">
                              <label class="form-label">User Name <span class="text-secondary small">(ব্যবহারকারীর নাম)</span>
                              </label>
                               <input type="text" class="form-control" value="<?= htmlspecialchars($_SESSION['user_name']) ?>" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                              <label class="form-label">Previous Password <span class="text-secondary small">(আগের পাসওয়ার্ড)</span>
                              </label>
                               <input type="text" class="form-control" value="<?= htmlspecialchars($_SESSION['re_password']) ?>" readonly>
                            </div>
                           <div class="col-md-6 mb-3">
                              <label for="password" class="form-label">New Password <span class="text-secondary small">(নতুন পাসওয়ার্ড)</span>
                              </label>
                              <!-- Password Field (with eye icon) -->
                              <div class="input-group">
                                 <input type="password" class="form-control" id="password" name="password" required minlength="6">
                                 <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('password', this)" tabindex="-1">
                                 <i class="fa fa-eye"></i>
                                 </button>
                              </div>
                           </div>
                           <div class="col-md-6 mb-3">
                              <label for="retype_password" class="form-label">Retype Password <span class="text-secondary small">(পুনরায় পাসওয়ার্ড)</span>
                              </label>
                              <!-- Retype Password Field (rounded, with checkmark only) -->
                              <div class="position-relative">
                                 <input type="password" class="form-control" id="retype_password" name="retype_password" required minlength="6" oninput="checkPasswordMatch()" onfocus="clearPasswordMatchError()">
                                 <span id="retypePasswordSuccess" style="display:none; color:green; position:absolute; right:15px; top:50%; transform:translateY(-50%); font-size:1.3em;">
                                 &#10004;
                                 </span>
                              </div>
                              <span id="retypePasswordError" class="text-danger small"></span>
                           </div>
                           <div class="mt-4 text-end">
                              <button type="submit" class="btn btn-primary btn-lg px-4 shadow-sm">
                              <i class="bi bi-upload"></i> Update Password
                              </button>
                           </div>
                     </form>
                     </div>
                  </div>
               </div>
         </main>
         </div>
      </div>
      <!-- Toast container -->
<div aria-live="polite" aria-atomic="true" class="position-fixed top-0 end-0 p-3" style="z-index: 1080; min-width: 300px;">
  <div id="toastMsg" class="toast align-items-center text-white bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body" id="toastBody">Toast message</div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
</div>

<script>
function showToast(message, type = 'success') {
    const toastEl = document.getElementById('toastMsg');
    const toastBody = document.getElementById('toastBody');
    toastBody.textContent = message;
    toastEl.classList.remove('bg-success', 'bg-danger', 'bg-primary');
    toastEl.classList.add(type === 'success' ? 'bg-success' : (type === 'error' ? 'bg-danger' : 'bg-primary'));
    const toast = new bootstrap.Toast(toastEl, { delay: 3500 });
    toast.show();
}
</script>

      
      <script> 

document.getElementById('resetForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const form = this;
    const formData = new FormData(form);

    try {
        const response = await fetch(form.action, {
            method: 'POST',
            body: formData
        });
        const result = await response.json();
        if (result.success) {
            showToast(result.message, 'success');
            form.reset();
            document.getElementById('retypePasswordSuccess').style.display = 'none';
        } else {
            showToast(result.message, 'error');
        }
    } catch (err) {
        showToast('Network error. Please try again.', 'error');
    }
});
</script>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <?php include '../includes/footer.php'; ?>
        <?php include '../includes/password.php'; ?>
   </body>
</html>