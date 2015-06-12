<?php
require_once '../poo/bootstrap.php';
session_start();
use Facebook\FacebookSession;
FacebookSession::setDefaultApplication(FACEBOOK_APP_ID, FACEBOOK_APP_SECRET);
$uid;
$accessToken;
if (isset($_POST['uid'])) {
    $uid = ($_POST['uid']);
    $_SESSION['fcbk_uid'] = $uid;
}
if (isset($_POST['accessToken'])) {
    $accessToken = ($_POST['accessToken']);
    $_SESSION['accessToken'] = $accessToken;
}
$facebookUtils = new FacebookUtils();
$session = new FacebookSession($accessToken);
$userProfile = $facebookUtils->getFacebookUser($session);
$userDAO = new UserDAO();
$adresseDAO = new AddressDAO();
if ($userProfile != null) {
    $currentUserOpenId = FACEBOOK_OPENID_PREFIX . OPENID_SEPERATOR . $userProfile->getId();
    if (isUserFirstVisit($currentUserOpenId, $userDAO)) {
        $attributs['lastName'] = $userProfile->getLastName();
        $attributs['firstName'] = $userProfile->getFirstName();
        $_SESSION['tmp_openId'] = $currentUserOpenId;
        echo "register|" . $attributs['lastName'] . OPENID_SEPERATOR . $attributs['firstName'];        
    } else {
        $usr = $userDAO->getByOpenId($currentUserOpenId);
        logUserIn($usr);
        echo "user|";        
    }
}
?>