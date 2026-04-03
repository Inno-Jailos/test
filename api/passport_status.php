<?php

declare(strict_types=1);

header('Content-Type: application/json');

require_once __DIR__ . '/data.php';

$identifierType = $_POST['identifier_type'] ?? '';
$identifierValue = trim($_POST['identifier_value'] ?? '');

$allowedTypes = ['application_number', 'national_id'];

if (!in_array($identifierType, $allowedTypes, true) || $identifierValue === '') {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request. Provide a valid identifier type and value.',
    ]);
    exit;
}

$record = findPassportRecord($identifierType, $identifierValue);

if ($record === null) {
    http_response_code(404);
    echo json_encode([
        'success' => false,
        'message' => 'No passport application found for the provided details.',
    ]);
    exit;
}

echo json_encode([
    'success' => true,
    'data' => $record,
]);
