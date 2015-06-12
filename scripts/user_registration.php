<?php

session_start();
require_once '../poo/bootstrap.php';
$userDAO = new UserDAO();
$adresseDAO = new AddressDAO();
$attributsAddress = array(
    'foneNumber' => '',
    'email' => '',
    'addressText' => '',
    'postalCode' => '',
    'city' => '',
    'country' => '',
);

$attributs = array(
    'lastName' => '',
    'firstName' => '',
    'birthDate',
    'openId',
    'userType' => ACCREDITATION_LEVEL_USER
);
//récupération de l'adresse
if (isset($_POST['foneNumber'])) {
    $attributsAddress['foneNumber'] = ($_POST['foneNumber']);
}
if (isset($_POST['email'])) {
    $attributsAddress['email'] = ($_POST['email']);
}
if (isset($_POST['addressText'])) {
    $attributsAddress['addressText'] = ($_POST['addressText']);
}
if (isset($_POST['postalCode'])) {
    $attributsAddress['postalCode'] = ($_POST['postalCode']);
}
if (isset($_POST['city'])) {
    $attributsAddress['city'] = ($_POST['city']);
}
if (isset($_POST['country'])) {
    $attributsAddress['country'] = ($_POST['country']);
}

////user
//if (isset($_GET['id'])) {
//    $attributs['id'] = (integer) $_GET['id'];
//}
if (isset($_POST['lastName'])) {
    $attributs['lastName'] = ($_POST['lastName']);
}
if (isset($_POST['firstName'])) {
    $attributs['firstName'] = ($_POST['firstName']);
}
if (isset($_POST['birthDate'])) {
    $attributs['birthDate'] = new DateTime($_POST['birthDate']);
}

//à revoir
$user = new User($attributs);
$address = new Address($attributsAddress);
//modification
if (isset($_SESSION['openId'])) {
    $user->setOpenId($_SESSION['openId']);
    $oldUser = $userDAO->getByOpenId($_SESSION['openId']);
    $userDAO->modifier($user, $oldUser->getId(), $attributs);
    $oldAddress = $adresseDAO->getByUser($oldUser->getId());
    $adresseDAO->modifier($address, $oldAddress->getid(), $attributsAddress);
    logUserIn($user);
    header("Location:../user");
}
//mode ajout nouvel utilisateur
if (isset($_SESSION['tmp_openId'])) {
    $user->setOpenId($_SESSION['tmp_openId']);
    createUserProfile($user, $userDAO);
    $currUser = $userDAO->getByOpenId($user->getOpenId());
    $address->setProprietaire($currUser->getId());
    $adresseDAO->ajouter($address);
    logUserIn($user);
    header("Location:../user");
}



