<?php
// Ensure the correct path to config.php
include_once __DIR__ . '/../config/config.php';

// Fetch banners from the database
try {
    $stmt = $pdo->query("SELECT * FROM SERVICES ORDER BY id ASC");
    $services = $stmt->fetchAll();
} catch (Exception $e) {
    die('Error fetching banners: ' . $e->getMessage());
}
?>

<!-- Feature Start -->
    <div class="container-fluid py-3">
        <div class="container">
            <div class="text-center wow fadeIn" data-wow-delay="0.1s">
                <h1 class="mb-5">Our <span class="text-uppercase text-primary bg-light px-2">Services</span>
                </h1>
            </div>
            <div class="row g-5">
                <?php foreach ($services as $service): ?>
                <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.1s">
                    <div class="text-center">
                        <i class="fa <?= htmlspecialchars($service['icon']); ?> fa-3x text-primary mb-4"></i>
                        <h5 style="line-height: 35px;">
                            <?= htmlspecialchars($service['service_name_en']); ?> <br>
                            <?= htmlspecialchars($service['service_name_bn']); ?>
                        </h5>
                    </div>
                    <p class="mb-0" style="font-size: 12px;"><?= strip_tags($service['about_service'], '<p><ul><li><b><i><br>'); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- Feature End -->