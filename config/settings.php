<?php

declare(strict_types=1);

use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;

return function (): array {
    // $keyContents = file_get_contents(__DIR__ . '/../../MY_SECRET_KEY');
    // $keyContents should not be hardcoded, only for demonstration
    $keyContents = 'def000002a9aadeb245e48c74b79b261e5ea9c3307459f7b5a0cb274aad8c98eceffd898f90efb93db39469ce26f3c18f41'
        . 'c3fa59c5b93f0b89a00287770779998ae39e6';
    $key = Key::loadFromAsciiSafeString($keyContents);
    $dbEncryptedPassword = 'def502007a55e0a764cdc1c0b9d91b4ed16472da65a977a4f868302ae6d8a3144fd39d0b75d429b08e1527fc68f'
        . '83ecb0fe21f5674ae305e5f92ff5cd2e7bf0d4edbaf9d7fda64a297a82e78df6292a7e6046cd3fed310ae050515ed';
    $dbPassword = Crypto::decrypt($dbEncryptedPassword, $key);

    return ['settings' => [
        'db' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'DATABASE',
            'username' => 'USERNAME',
            'password' => $dbPassword,
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => ''
        ]
    ]];
};
