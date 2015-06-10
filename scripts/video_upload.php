<?php

if (isset($_SESSION['fullName'])) {
    require_once '../poo/bootstrap.php';
    $userDAO = new UserDAO();
    if ($_FILES['fileupload']['error'] > 0) {
        //à revoir
        header("Location:../images_acs_page?feedback=" . ECHEC_UPLOAD_FICHIER);
    }
    if ($_FILES['fileupload']['size'] > MAXIMUM_VIDEO_SIZE) {
        //à revoir
        header("Location:../images_acs_page?feedback=" . ECHEC_UPLOAD_HEAVY_IMAGE);
    }
    $attributs = array(
        'title' => '',
        'confidentialityProfile' => '',
        '$descriptif' => '',
    );
    if (isset($_POST['title'])) {
        $attributs['title'] = ($_POST['title']);
    }
    if (isset($_POST['confidentialityProfile'])) {
        $attributs['confidentialityProfile'] = ($_POST['confidentialityProfile']);
    }
    if (isset($_POST['$descriptif'])) {
        $attributs['$descriptif'] = ($_POST['$descriptif']);
    }
    $attributs['size'] = $_FILES['fileupload']['size'];
    $attributs['owner'] = $userDAO->getByUserName($_SESSION['login']);
    $extension = strtolower(strrchr($_FILES['fileupload']['name'], '.'));
    $uploadURL = getUserPersonnalFolderPath($userDAO->getByUserName($_SESSION['login'])) . "/" . $attributs['title'] . $extension;
    if (uploadFile($_FILES['fileupload']['tmp_name'], $uploadURL)) {
        $attributs['accessURL'] = $uploadURL;
        $videoDAO = new VideoDAO();
        $video = new Video($attributs);
        try {
            $feedback = proceed($video, $attributs, $videoDAO);
        } catch (Exception $ex) {
            $feedback = OPERATION_ECHEC;
        }
        //à revoir        
        header("Location:../" . $image->getHomePage() . "?feedback=$feedback");
    }
} else {
    //redirection d'authentification
}
