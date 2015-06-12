<?php
use Facebook\FacebookSession;
use Facebook\FacebookJavaScriptLoginHelper;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;

FacebookSession::setDefaultApplication(FACEBOOK_APP_ID, FACEBOOK_APP_SECRET);

class FacebookUtils {

    public function getFacebookSession() {
        $helper = new FacebookJavaScriptLoginHelper();
        try {
            $session = $helper->getSession();
            return $session;
        } catch (FacebookRequestException $ex) {
            // When Facebook returns an error
            return null;
        } catch (\Exception $ex) {
            // When validation fails or other local issues
            return null;
        }
    }

    public function getFacebookUser($session) {
        if ($session != null) {
            try {
                $user_profile = (new FacebookRequest(
                        $session, 'GET', '/me'
                        ))->execute()->getGraphObject(GraphUser::className());
                return $user_profile;
            } catch (FacebookRequestException $e) {
                echo "Exception occured, code: " . $e->getCode();
                echo " with message: " . $e->getMessage();
                return null;
            }
        }
    }
    public function getFacebookUserLocation($session) {
        if ($session != null) {
            try {
                $user_location = (new FacebookRequest(
                        $session, 'GET', '/me'
                        ))->execute()->getGraphObject(GraphLocation::className());
                return $user_location;
            } catch (FacebookRequestException $e) {
                echo "Exception occured, code: " . $e->getCode();
                echo " with message: " . $e->getMessage();
                return null;
            }
        }
    }

    public function isFacebookSessionActive() {
        $session = $this->getFacebookSession();
        if ($session != null) {
            return true;
        } else {
            return false;
        }
    }

}
