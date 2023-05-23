<?php
define('BASE_PATH', '/PHPCOURSE/Darrebeni/htaccess_Task/');
$config = require 'config/config.php';
require_once __DIR__ . '/app/controllers/UserController.php';
require_once __DIR__ . '/app/controllers/CourseController.php';

use App\Controllers\UserController as UC;
use App\Controllers\CourseController as CC;

$connect = new PDO("mysql:host={$config['host']};dbname={$config['database']}", $config['user'], $config['password']);

if (!$connect) {
    die("not connected");
}

$route = $_SERVER['REQUEST_URI'];
$user = new UC($connect);
$course = new CC($connect);
switch ($route) {
    case BASE_PATH:
        $user->index();
        $course->index();
        break;
    case BASE_PATH . 'login':
        $user->login();
        break;
    case BASE_PATH . 'register':
        $user->register();
        break;
    case BASE_PATH . 'logout':
        $user->logout();
        break;
    case BASE_PATH . 'delete/' . substr($_SERVER['REQUEST_URI'], strlen(BASE_PATH . 'delete/')):
        $user->delete(substr($_SERVER['REQUEST_URI'], strlen(BASE_PATH . 'delete/')));
        break;
    case BASE_PATH . 'edit/' . substr($_SERVER['REQUEST_URI'], strlen(BASE_PATH . 'edit/')):
        $user->edit(substr($_SERVER['REQUEST_URI'], strlen(BASE_PATH . 'edit/')));
        break;
    case BASE_PATH . 'delete-course/' . substr($_SERVER['REQUEST_URI'], strlen(BASE_PATH . 'delete-course/')):
        $course->delete(substr($_SERVER['REQUEST_URI'], strlen(BASE_PATH . 'delete-course/')));
        break;
    case BASE_PATH . 'edit-course/' . substr($_SERVER['REQUEST_URI'], strlen(BASE_PATH . 'edit-course/')):
        $course->edit(substr($_SERVER['REQUEST_URI'], strlen(BASE_PATH . 'edit-course/')));
        break;
    default:
        $user->index();
        $course->index();
}