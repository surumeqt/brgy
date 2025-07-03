<?php
require_once 'config/database.config.php';
require_once 'models/luponPDF.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formData = [
        'docket_case_number'   => $_POST['docket_case_number'] ?? '',
        'case_title'           => $_POST['case_title'] ?? '',
        'complainant_name'     => $_POST['complainant_name'] ?? '',
        'complainant_address'  => $_POST['complainant_address'] ?? '',
        'respondent_name'      => $_POST['respondent_name'] ?? '',
        'respondent_address'   => $_POST['respondent_address'] ?? '',
    ];

    $hearingType = $_POST['hearing_type'] ?? '';
    $hearingDate = $_POST['hearing_date'] ?? '';

    try {
        $pdf = new luponPDF($formData);
        $pdfBlob = $pdf->generateCombinedNoticeAndSummonBlob($hearingType, $hearingDate);

        $db = new Connection();
        $conn = $db->connect();

        $stmt = $conn->prepare("
            INSERT INTO GeneratedPDFs (Docket_Case_Number, Hearing, pdf_file, Case_Title) 
            VALUES (?, ?, ?, ?)
        ");
        $stmt->bindValue(1, $formData['docket_case_number']);
        $stmt->bindValue(2, $hearingType);
        $stmt->bindValue(3, $pdfBlob, PDO::PARAM_LOB);
        $stmt->bindValue(4, $formData['case_title']);
        $stmt->execute();

        $stmt2 = $conn->prepare("
            INSERT INTO lupon 
            (Docket_Case, Case_Title, CN, CNADD, RP, RPADD, Hearing, created_At)
            VALUES (?, ?, ?, ?, ?, ?, ?, NOW())
        ");

        $stmt2->execute([
            $hearingDate,
            $formData['case_title'],
            $formData['complainant_name'],
            $formData['complainant_address'],
            $formData['respondent_name'],
            $formData['respondent_address'],
            $hearingType
        ]);

        header("Location: ../src/app.php?upload=success");
        exit();
    } catch (PDOException $e) {
        die("DB Error: " . $e->getMessage());
    } catch (Exception $e) {
        die("General Error: " . $e->getMessage());
    }
} else {
    http_response_code(405);
    echo "Method Not Allowed.";
}
