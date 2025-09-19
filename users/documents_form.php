<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en"> <?php include '../includes/head.php'; ?> <body> <?php include '../includes/header.php'; ?> <div class="container-fluid py-5">
      <div class="row">
        <!-- Sidebar (col-3) --> <?php include '../includes/side_bar.php'; ?>
        <!-- Main Content (col-9) -->
        <main class="col-12 col-md-10 col-lg-10 px-md-4">
  <div class="container py-5">
    <div class="card shadow-lg rounded-3 border-0">
      <div class="card-body p-4">
        <h3 class="mb-3 text-primary fw-bold">
          Documents Upload (ডকুমেন্টস আপলোড)
        </h3>
        <hr class="mb-4" />
        
        <form id="docForm" action="../process/upload_docs.php" method="POST" enctype="multipart/form-data">
          <div class="row g-3">
            <!-- Document Type -->
            <div class="col-md-6">
              <label for="required_document_select" class="form-label fw-semibold">
                প্রয়োজনীয় ডকুমেন্ট (Required Document)
              </label>
              <select class="form-select shadow-sm" id="required_document_select" required>
                <option value="">নির্বাচন করুন (Select)</option>
                <option value="101">জাতীয় পরিচয়পত্র / জন্ম সনদ (Copy of National ID / Birth Certificate)</option>
                <option value="102">স্বাক্ষর (Signature)</option>
                <option value="103">শিক্ষাগত যোগ্যতার সনদ (Educational Qualification Certificate)</option>
                <option value="104">অস্থায়ী নাগরিক সনদ (Temporary Citizenship Certificate)</option>
              </select>
            </div>

            <!-- Upload File -->
            <div class="col-md-6">
              <label for="required_document_file" class="form-label fw-semibold">
                ডকুমেন্ট আপলোড করুন (Upload Document)
              </label>
              <input class="form-control shadow-sm" type="file" id="required_document_file" accept=".jpg,.jpeg,.png">
              <div class="form-text text-muted mt-1">
                প্রতি টাইপ নির্বাচন করে একটি ফাইল অ্যাড করুন। একাধিক টাইপ আলাদা আলাদা করে যোগ করুন।
              </div>
            </div>
          </div>

          <!-- Preview Section -->
          <div id="requiredDocumentPreview" class="row mt-3 g-2"></div>

          <!-- Hidden Fields -->
          <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>">
          <input type="hidden" name="member_id" value="<?php echo htmlspecialchars($_SESSION['member_id']); ?>">
          <input type="hidden" name="member_code" value="<?php echo htmlspecialchars($_SESSION['member_code']); ?>">

          <!-- Submit -->
          <div class="mt-4 text-end">
            <button type="submit" class="btn btn-primary btn-lg px-4 shadow-sm">
              <i class="bi bi-upload"></i> Save Documents
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
// Show toast message (Bootstrap 5)
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
    <?php include '../includes/footer.php'; ?>
    <script>
      const docLabels = {
        101: 'জাতীয় পরিচয়পত্র / জন্ম সনদ (National ID / Birth Certificate)',
        102: 'স্বাক্ষর (Signature)',
        103: 'শিক্ষাগত যোগ্যতার সনদ (Educational Qualification Certificate)',
        104: 'অস্থায়ী নাগরিক সনদ (Temporary Citizenship Certificate)',
      };
      // Keep selected file per doc type
      const retainedDocs = {}; // { [docType]: File }
      let currentDocType = '';
      const selectEl = document.getElementById('required_document_select');
      const fileEl = document.getElementById('required_document_file');
      const preview = document.getElementById('requiredDocumentPreview');
      const form = document.getElementById('docForm');
      selectEl.addEventListener('change', function() {
        currentDocType = this.value;
        fileEl.value = '';
      });
      fileEl.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!currentDocType) {
          showToast('ডকুমেন্ট টাইপ নির্বাচন করুন।', 'error');
          fileEl.value = '';
          return;
        }
        if (!file) return;
        const okExt = ['jpg', 'jpeg', 'png'];
        const ext = (file.name.split('.').pop() || '').toLowerCase();
        if (!okExt.includes(ext)) {
          showToast('শুধুমাত্র JPG/PNG ফাইল দিন।', 'error');
          fileEl.value = '';
          return;
        }
        // Add/replace for this type
        retainedDocs[currentDocType] = file;
        render();
        // Clear the chooser so the same file can be re-picked if needed
        fileEl.value = '';
      });

      function render() {
        preview.innerHTML = '';
        Object.keys(retainedDocs).forEach(function(docType) {
          const file = retainedDocs[docType];
          if (!file) return;
          const col = document.createElement('div');
          col.className = 'col-md-3 mb-3 text-center';
          const img = document.createElement('img');
          img.style.maxWidth = '100px';
          img.style.maxHeight = '100px';
          img.style.borderRadius = '4px';
          img.style.boxShadow = '0 2px 8px #0002';
          img.style.marginTop = '4px';
          img.src = URL.createObjectURL(file);
          col.appendChild(img);
          const label = document.createElement('div');
          label.className = 'small mt-2 fw-bold';
          label.innerText = docLabels[docType] || docType;
          col.appendChild(label);
          const rm = document.createElement('button');
          rm.type = 'button';
          rm.className = 'btn btn-sm btn-outline-danger mt-1';
          rm.innerText = 'Remove';
          rm.onclick = () => {
            delete retainedDocs[docType];
            render();
          };
          col.appendChild(rm);
          preview.appendChild(col);
        });
      }
      // Submit everything with FormData so PHP receives arrays:
      // required_documents[] and required_document_types[]
      form.addEventListener('submit', async function(e) {
        e.preventDefault();
        const fd = new FormData();
        // Include any other normal form fields:
        Array.from(form.elements).forEach(el => {
          if (el.name && el.type !== 'file' && el.type !== 'submit' && el.type !== 'button') {
            fd.append(el.name, el.value);
          }
        });
        const types = Object.keys(retainedDocs);
        if (types.length === 0) {
          showToast('কমপক্ষে একটি ডকুমেন্ট যুক্ত করুন।', 'error');
          return;
        }
        types.forEach(type => {
          const file = retainedDocs[type];
          fd.append('required_document_types[]', type);
          fd.append('required_documents[]', file, file.name);
        });
        try {
          const resp = await fetch(form.action, {
            method: 'POST',
            body: fd
          });
          const data = await resp.json(); // expects JSON from PHP
          if (data.success) {
            showToast('ডকুমেন্টগুলো সফলভাবে আপলোড হয়েছে।', 'success');
            // Optionally reset:
            Object.keys(retainedDocs).forEach(k => delete retainedDocs[k]);
            render();
          } else {
            showToast(data.message || 'সেভ করতে সমস্যা হয়েছে।', 'error');
          }
        } catch (err) {
          console.error(err);
          showToast('নেটওয়ার্ক/সার্ভার ত্রুটি।', 'error');
        }
      });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>