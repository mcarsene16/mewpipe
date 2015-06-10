<?php

require_once '../poo/bootstrap.php';
$userDAO = new UserDAO();
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
    'birthDate' => '',
    'login' => '',
    'password' => '',
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
$address = new Address($attributsAddress);

//user
if (isset($_GET['id'])) {
    $attributs['id'] = (integer) $_GET['id'];
}
if (isset($_POST['lastName'])) {
    $attributs['lastName'] = ($_POST['lastName']);
}
if (isset($_POST['firstName'])) {
    $attributs['firstName'] = ($_POST['firstName']);
}
if (isset($_POST['birthDate'])) {
    $attributs['birthDate'] = ($_POST['birthDate']);
}
if (isset($_POST['login'])) {
    $attributs['login'] = ($_POST['login']);
}
if (isset($_POST['password'])) {
    $attributs['password'] = ($_POST['password']);
}
$user = new User($attributs);
$user->setAddress($address);
try {
    if (isset($_GET['id'])) {
        $addressDAO = new AddressDAO();
        $addressDAO->modifier($user->getAddress(), $user->getAddress()->getId(), $attributsAddress);
        $address = $addressDAO->recuperer($user->getAddress(), $user->getAddress()->getId());
        $userDAO->modifier($user,$_GET['id'],$attributs);
    } else {
        $userDAO->ajouter($user);
        $usr = $userDAO->getByUserName($user->getLogin());
        createUserPersonnalFolder($usr);
    }
} catch (Exception $ex) {
    $feedback = OPERATION_ECHEC;
}
//à revoir
header("Location:../" . $user->getHomePage() . "?feedback=$feedback");

