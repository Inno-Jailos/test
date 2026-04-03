<?php

declare(strict_types=1);

require_once __DIR__ . '/data.php';

header('Content-Type: text/plain');

$text = trim($_POST['text'] ?? '');
$parts = $text === '' ? [] : explode('*', $text);

if (count($parts) === 0) {
    echo "CON Welcome to Passport Status Service\n";
    echo "1. Check by Application Number\n";
    echo "2. Check by National ID";
    exit;
}

if (count($parts) === 1) {
    if ($parts[0] === '1') {
        echo "CON Enter your application number:";
        exit;
    }

    if ($parts[0] === '2') {
        echo "CON Enter your national ID number:";
        exit;
    }

    echo 'END Invalid choice. Please dial again and choose 1 or 2.';
    exit;
}

$choice = $parts[0];
$identifierValue = trim($parts[1]);

if ($choice === '1') {
    $record = findPassportRecord('application_number', $identifierValue);
} elseif ($choice === '2') {
    $record = findPassportRecord('national_id', $identifierValue);
} else {
    $record = null;
}

if ($record === null) {
    echo 'END No record found for provided details.';
    exit;
}

echo sprintf(
    "END %s\nApplication: %s\nStatus: %s\nLast Update: %s",
    $record['full_name'],
    $record['application_number'],
    $record['status'],
    $record['last_update']
);
