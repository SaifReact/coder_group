<?php
// Ensure the correct path to config.php
include_once __DIR__ . '/../config/config.php';

// Check if $pdo is defined
if (!isset($pdo)) {
    die('Database connection not established.');
}

// Fetch banners from the database
try {
    $stmt = $pdo->query("SELECT company_name_en, company_name_bn, company_image FROM company ORDER BY id DESC");
    $companies = $stmt->fetchAll();
} catch (Exception $e) {
    die('Error fetching banners: ' . $e->getMessage());
}
?>
<div class="row g-0">
                <div class="col-lg-5 wow fadeIn" data-wow-delay="0.1s">
                    <div class="d-flex flex-column justify-content-center bg-primary h-100 p-5">
                        <h1 class="text-white mb-5">Our Latest <span
                                class="text-uppercase text-primary bg-light px-2">Projects</span></h1>
                        <h4 class="text-white mb-0"><span class="display-1">6</span> of our latest projects</h4>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="row g-0">
                        <?php foreach ($companies as $company): ?>
                        <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.2s">
                            <div class="project-item position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="company/<?= htmlspecialchars($company['company_image']); ?>" alt="<?= htmlspecialchars($company['company_name_en']); ?>">
                                <a class="project-overlay text-decoration-none" href="#!">
                                    <h4 class="text-white"><?= htmlspecialchars($company['company_name_en']); ?></h4>
                                    <small class="text-white"><?= htmlspecialchars($company['company_name_bn']); ?></small>
                                </a>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>