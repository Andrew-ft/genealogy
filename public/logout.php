<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Http\Controllers\Auth\AuthController;

session_start();

$controller = new AuthController();
$controller->logout();