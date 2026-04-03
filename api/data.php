<?php

declare(strict_types=1);

/**
 * Mock passport application records.
 * Replace with database calls in production.
 */
function getPassportRecords(): array
{
    return [
        [
            'application_number' => 'APP-2026-1001',
            'national_id' => '12345678',
            'full_name' => 'Amina Yusuf',
            'status' => 'Under Review',
            'last_update' => '2026-03-22',
        ],
        [
            'application_number' => 'APP-2026-1002',
            'national_id' => '87654321',
            'full_name' => 'John Mwangi',
            'status' => 'Ready for Collection',
            'last_update' => '2026-03-25',
        ],
        [
            'application_number' => 'APP-2026-1003',
            'national_id' => '33445566',
            'full_name' => 'Grace Njoroge',
            'status' => 'Rejected - Missing Documents',
            'last_update' => '2026-03-20',
        ],
    ];
}

function findPassportRecord(string $identifierType, string $identifierValue): ?array
{
    $records = getPassportRecords();

    foreach ($records as $record) {
        if (isset($record[$identifierType]) && strcasecmp($record[$identifierType], $identifierValue) === 0) {
            return $record;
        }
    }

    return null;
}
