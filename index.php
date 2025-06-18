<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$page = $_GET['page'] ?? 'login';

switch ($page) {
    case 'profil':
        require_once __DIR__ . '/app/controller/profilController.php';
        profilController::handle();
        break;

    case 'login':
    default:
        require_once __DIR__ . '/app/login.php';
        break;
}