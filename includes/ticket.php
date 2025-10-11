<?php

include_once __DIR__ . '/../config/config.php';

// Fetch counts from members_info table
$stmt = $pdo->query("SELECT (SELECT registration_no FROM setup) AS registration, 
'২০২৩' AS establish, 
(SELECT COUNT(*) FROM members_info a, user_login b WHERE a.id = b.member_id AND b.status = 'A') AS members,
(SELECT SUM(no_share) FROM member_share a, user_login b WHERE a.member_id = b.member_id AND b.status = 'A') AS shares
");
$counts = $stmt->fetch(PDO::FETCH_ASSOC);

function convertToBangla($number) {
    $banglaDigits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
    $englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    return str_replace($englishDigits, $banglaDigits, $number);
}
?>

<div class="container">
    <div class="row">
        <!-- Total Members -->
        <div class="col-md-3">
            <div class="card text-center shadow-sm rounded" style="background-color: #cce5ff; color: black;">
                <div class="card-body">
                    <h4 class="card-title"><b>রেজিস্ট্রেশন নং</b></h4>
                    <p class="card-text display-6"><?= htmlspecialchars($counts['registration'] ?? 0); ?></p>
                </div>
            </div>
        </div>

        <!-- Male Members -->
        <div class="col-md-3">
            <div class="card text-center shadow-sm rounded" style="background-color: #d4edda; color: black;">
                <div class="card-body">
                    <h4 class="card-title"><b>স্থাপিত সন</b></h4>
                    <p class="card-text display-6"><?= htmlspecialchars($counts['establish'] ?? 0); ?></p>
                </div>
            </div>
        </div>

        <!-- Female Members -->
        <div class="col-md-3">
            <div class="card text-center shadow-sm rounded" style="background-color: #fff3cd; color: black;">
                <div class="card-body">
                    <h4 class="card-title"><b>সদস্য সংখ্যা</b></h4>
                    <p class="card-text display-6"><?= htmlspecialchars(convertToBangla($counts['members']) ?? 0); ?></p>
                </div>
            </div>
        </div>

        <!-- Married Members -->
        <div class="col-md-3">
            <div class="card text-center shadow-sm rounded" style="background-color: #f8d7da; color: black;">
                <div class="card-body">
                    <h4 class="card-title"><b>শেয়ার সংখ্যা</b></h4>
                    <p class="card-text display-6"><?= htmlspecialchars(convertToBangla($counts['shares']) ?? 0); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>