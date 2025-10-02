<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once __DIR__ . '/../config/config.php';

$site_name_en = $_SESSION['setup']['site_name_en'] ?? '';
$site_name_bn = $_SESSION['setup']['site_name_bn'] ?? '';

?>

<nav class="navbar navbar-expand-lg navbar-light border-bottom border-2 border-white">
    <a href="/coder_group/index.php" class="navbar-brand">
        <span style="
            display: inline-block;
            font-family: 'Poppins', Arial, sans-serif;
            font-size: .9rem;
            font-weight: 700;
            color: #b85c38;
            letter-spacing: 1.5px;
            text-shadow: 1px 2px 8px #fff8, 0 2px 8px #b85c3822;
            padding: 0.2em 1.2em 0.2em 1.2em;
            margin: 0.2em 0;
        ">
            <span style="vertical-align:middle; font-size: 1rem"><?= htmlspecialchars($site_name_bn); ?>
            </span><br />
            <?= htmlspecialchars($site_name_en); ?>
        </span>
    </a>
    <button type="button" class="navbar-toggler ms-auto me-0" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto">
            <?php if (isset($_SESSION['user_id'])): ?>
                <?php if ($_SESSION['role'] === 'Admin'): ?>
                    <a class="nav-item nav-link active" href="#">Welcome, <b><?php echo htmlspecialchars($_SESSION['user_name']); ?></b>!</a>
                <?php elseif ($_SESSION['role'] === 'user'): ?>
                    <a class="nav-item nav-link active" href="#">Welcome, <b><?php echo htmlspecialchars($_SESSION['user_name']); ?></b>!</a>
                <?php endif; ?>
                <a class="nav-item nav-link active" href="../includes/logout.php">Logout (লগআউট)</a>
            <?php else: ?>
                <a href="/coder_group/index.php" class="nav-item nav-link active">Home (প্রচ্ছদ)</a>
                <a href="/coder_group/form.php" class="nav-item nav-link">Registration (নিবন্ধন)</a>
                <a href="/coder_group/login.php" class="nav-item nav-link">Login (লগইন)</a>
                <a href="/coder_group/contact.php" class="nav-item nav-link">Contact (যোগাযোগ)</a>
            <?php endif; ?>
        </div>
    </div>
</nav>