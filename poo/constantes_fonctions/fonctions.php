<?php

function remplir_ddl(BaseEntite $entite) {
    $ddl = "";
    $dao = new DAO();
    $entites = $dao->lister($entite);
    foreach ($entites as $entite) {
        $id = $entite->getPrimaryKey();
        $label = $entite->getDisplayName();
        $ddl .= "<option = $label  value= $id> $label</option>";
    }
    return $ddl;
}

function proceed(BaseEntite $entite, array $attributs, DAO $dao) {
    if ($entite->getPrimaryKey() <> null) {
        $dao->modifier($entite, $entite->getPrimaryKey(), $attributs);
        $feedback = OPERATION_MODIFICATION_SUCCES;
    } else {
        $dao->ajouter($entite);
        $feedback = OPERATION_AJOUT_SUCCES;
    }
    return $feedback;
}

function proceedDeletion(BaseEntite $entite, DAO $dao) {
    try {
        $dao->supprimer($entite);
        return OPERATION_SUPPRESSION_SUCCES;
    } catch (Exception $ex) {
        return OPERATION_ECHEC;
    }
}

function isSuperUser($login, $password) {
    if (($login == SUPER_USER_LOGIN) && ($password == SUPER_USER_PASSWORD)) {
        return true;
    } else {
        return false;
    }
}

//à revoir
function deleteVideo(Video $video) {
    $repertoire = '../../' . DEFAULT_PATH_FROM_ROOT . DEFAULT_IMAGES_PATH . 'banner';
    $ouverture = opendir($repertoire);
    if (unlink($repertoire . '/' . $video->getTitle() . strtolower(strrchr($video->getAccessURL(), '.')))) {
        closedir($ouverture);
        return true;
    }
    return false;
}

function envoiMail($mailDest, $subject, $message, $replyTo) {
//création du boundary
    $boundary = "-----=" . md5(rand());
//creation des passages à la ligne
    $passage_ligne = getRetourLigne($mailDest);
//header
    $headers = 'From: "Site Web ITEE Services" <' . ADRESSE_MAIL_ENVOI . '>' . $passage_ligne;
    $headers.= "Reply-to: \"RETOUR\" <" . $replyTo . ">" . $passage_ligne;
    $headers.= "MIME-Version: 1.0" . $passage_ligne;
    $headers.= "Content-Type: multipart/alternative;" . $passage_ligne . " boundary=\"$boundary\"" . $passage_ligne;
//message
    $mess = $passage_ligne . "--" . $boundary . $passage_ligne;
    $mess .= "Content-Type: text/html; charset=\"UTF-8\"" . $passage_ligne;
    $mess .= "Content-Transfer-Encoding: 8bit" . $passage_ligne;
    $finalMessage = $mess . $message;
    $finalMessage .= $passage_ligne . "--" . $boundary . "--" . $passage_ligne;
//envoi du mail
    if (mail($mailDest, $subject, $finalMessage, $headers)) {
        return true;
    } else {
        return false;
    }
}

function getRetourLigne($mailDest) {
    if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mailDest)) {
        $passage_ligne = "\r\n";
    } else {
        $passage_ligne = "\n";
    }
    return $passage_ligne;
}

function hashUserPassword($password) {
    $hasher = new PasswordHash(8, false);
    return $hasher->HashPassword($password);
}

function checkUserPassword($submittedPass, $storedPass) {
    $hasher = new PasswordHash(8, false);
    return $hasher->CheckPassword($submittedPass, $storedPass);
}

function createUserPersonnalFolder(User $user) {
    $folderPath = getUserPersonnalFolderPath($user);
    if (!is_dir($folderPath)) {
        mkdir($folderPath);
    }
}

function getUserPersonnalFolderPath(User $user) {
    return $_SERVER['DOCUMENT_ROOT'] . UPLOADED_VIDEO_FOLDER . "/" . ACCREDITATION_LEVEL_USER . "-" . $user->getId();
}

function deleteUserPersonnalFolder(User $user) {
    $folderPath = getUserPersonnalFolderPath($user);
    rmRecursive($folderPath);
}

function rmRecursive($path) {
    if (!file_exists($path)) {
        throw new RuntimeException('Fichier ou dossier non-trouvé');
    }
    if (is_dir($path)) {
        $dir = dir($path);
        while (($file_in_dir = $dir->read()) !== false) {
            if ($file_in_dir == '.' or $file_in_dir == '..') {
                continue; // passage au tour de boucle suivant
            }
            rmRecursive("$path/$file_in_dir");
        }
        $dir->close();
    }
    unlink($path);
}

function uploadFile($sourceFile, $destinationFile) {
    if (move_uploaded_file($sourceFile, $destinationFile)) {
        return true;
    } else {
        return false;
    }
}

function deleteFile($filePath) {
    if (file_exists($filePath)) {
        unlink($filePath);
    }
}

function renameFile($oldFilePath, $newFilePath) {
    if (file_exists($oldFilePath)) {
        return rename($oldFilePath, $newFilePath);
    }
}

function isMewPipeSessionActive() {
    if (isset($_SESSION['openId'])) {
        return true;
    } else {
        return false;
    }
}

function isUserFirstVisit($openId, UserDAO $userDAO) {
    try {
        $user = $userDAO->getByOpenId($openId);
        if ($user != null) {
            return false;
        } else {
            return true;
        }
    } catch (Exception $ex) {
        return true;
    }
}

function createUserProfile(User $user, UserDAO $userDAO) {
    $userDAO->ajouter($user);
    $usr = $userDAO->getByOpenId($user->getOpenId());
    createUserPersonnalFolder($usr);
}

function logUserIn(User $user) {
    if (isset($_SESSION['tmp_openId'])) {
        unset($_SESSION['tmp_openId']);
    }
    $_SESSION['fullName'] = $user->getFullName();
    $_SESSION['openId'] = $user->getOpenId();
}
