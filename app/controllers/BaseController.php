<?php

declare(strict_types=1);

namespace App\Controllers;


abstract class BaseController
{
    protected $connect;

    public function __construct($connect)
    {
        $this->connect = $connect;
    }

    public function render(string $view)
    {
        require __DIR__ . '/../../layout.php';
    }

    public static function test_data($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}