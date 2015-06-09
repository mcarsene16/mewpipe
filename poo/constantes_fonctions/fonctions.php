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
