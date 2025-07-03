<?php
require_once 'config/database.config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedDocket = $_POST['Docket_Case_Number'] ?? '';
    $newStatus = $_POST['Status'] ?? '';

    if (!$selectedDocket || !$newStatus) {
        die("Missing Docket Case Number or Status.");
    }

    try {
        $db = new Connection();
        $conn = $db->connect();

        $stmt = $conn->prepare("SELECT 1 FROM GeneratedPDFs WHERE Docket_Case_Number = ?");
        $stmt->execute([$selectedDocket]);
        if (!$stmt->fetch()) {
            die("Docket Case Number not found.");
        }

        $update = $conn->prepare("UPDATE GeneratedPDFs SET Status = ? WHERE Docket_Case_Number = ?");
        $update->execute([$newStatus, $selectedDocket]);

        header("Location: ../src/app.php?status=updated");
        exit();
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
} else {
    http_response_code(405);
    echo "Method Not Allowed.";
}
