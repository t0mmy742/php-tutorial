<?php

declare(strict_types=1);

namespace T0mmy742\PHPTutorial\Model;

use PDO;

class Model
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getData(): int
    {
        return 2;
    }
}
