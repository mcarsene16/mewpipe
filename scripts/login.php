<?php
require_once '../poo/bootstrap.php';
//Initialisation de la session
session_start();
$userDAO = new UserDAO();
$attributs = array(
    'login' => '',
    'password' => ''
);
//on récupère les identifiants saisis par l'utilisateur
if (isset($_POST['login'])) {
    $attributs['login'] = ($_POST['login']);
}
if (isset($_POST['password'])) {
    $attributs['password'] = ($_POST['password']);
}
if (isSuperUser($attributs['login'], $attributs['password'])) {
    $_SESSION['fullName'] = "Admin";
    $_SESSION['profile'] = ACCREDITATION_LEVEL_ADMIN;
    //à revoir
    header("Location:../index");
} else {
//on vérifie si un utilisateur existe avec les identifiants saisis
    try {
        $user = $userDAO->getByUserName($attributs['login']);
        //vérification de la conformité des mots de passe
        if (checkUserPassword($attributs['password'], $user->getPassword())) {
            //regénération de l'identifiant de le session
            session_regenerate_id();
            //sauvegarde des infos dans la session        
            $_SESSION['login'] = $user->getLogin();
            $_SESSION['fullName'] = $user->getFullName();
            $_SESSION['profile'] = $user->getUserType();
            //à revoir
            header("Location:../index");
        } else {
            //à revoir
            // On redirige sur la page permettant de s'authentifier
            header('Location:../connexion?feedback=' . ERREUR_CONNEXION);
            // On arrête l'exécution
            exit();
        }
    } catch (Exception $ex) {
        //à revoir
        // On redirige sur la page permettant de s'authentifier
        header('Location:../connexion?feedback=' . ERREUR_CONNEXION);
        // On arrête l'exécution
        exit();
    }
}

