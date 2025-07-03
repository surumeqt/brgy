<?php
require_once 'models/getModel.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $model = new getModel();
    $result = $model->getTemplateById($_GET['id']);

    if ($result) {
        header("Content-Type: application/pdf");
        header("Content-Disposition: inline; filename=\"lupon_{$result['Docket_Case_Number']}_{$result['Hearing']}.pdf\"");
        echo $result['pdf_file'];
        exit;
    } else {
        echo "PDF not found.";
    }
} else {
    echo "Invalid request.";
}
