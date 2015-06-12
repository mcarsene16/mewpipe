<?php
require_once '../poo/bootstrap.php';
session_start();
$userDAO = new UserDAO();
if (isset($_SESSION['openId'])) {
    $user = $userDAO->getByOpenId($_SESSION['openId']);
    $userDAO->supprimer($user);
}
