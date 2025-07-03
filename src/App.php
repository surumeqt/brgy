<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../index.php"); // Redirect to login
    exit();
}
$user_id = $_SESSION['id'] ?? 'N/A';
$user_email = $_SESSION['email'] ?? 'N/A';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LGU - Brgy. New Kalalake System</title>
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="./style/logoutModal.css">
</head>
<body>
    <div class="dashboard-layout">
        <aside class="sidebar">
            <div class="logo-area">
                <img class="brgy_logo" src="../src/images/logo.png" alt="Logo">
                <h1>Brgy. New Kalalake</h1>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="./dashboard.php" data-load-content="true">Dashboard</a></li>
                    <li><a href="./database-page.php" data-load-content="true">Database</a></li>
                    <li><a href="./upload.php" data-load-content="true">Upload</a></li>
                    <li><a href="./lupon.php" data-load-content="true">Lupon</a></li>
                    <li><a href="./pending-cases.php" data-load-content="true">Pending Cases</a></li>
                </ul>
            </nav>
            <div class="sidebar-footer">
                <p class="user-email-display"><?php echo htmlspecialchars($user_email); ?></p>
                <button id="logoutButton" class="logout-btn">Logout</button>
            </div>
        </aside>

        <div class="main-panel">
            <header class="top-bar">
                <button class="menu-toggle" aria-label="Toggle Menu">&#9776;</button>
                <h2 class="current-page-title">Dashboard</h2>
                <span class="user-greeting">Welcome, <?php echo htmlspecialchars($user_email); ?></span>
            </header>
            <div class="content-display">
                <p>Loading Dashboard...</p>
            </div>
        </div>
    </div>
    
    <div id="logoutModal" class="modal-overlay">
        <div class="modal-content">
            <h3>Confirm Logout</h3>
            <p>Are you sure you want to log out?</p>
            <div class="modal-actions">
                <button id="confirmLogout" class="btn btn-confirm">Yes, Logout</button>
                <button id="cancelLogout" class="btn btn-cancel">Cancel</button>
            </div>
        </div>
    </div>

    <script src="./scripts/navigation.js"></script>
    <script src="./scripts/logoutModal.js"></script>
    <script src="./scripts/changeStatus.js"></script>
</body>
</html>