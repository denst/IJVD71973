<?php

defined('SYSPATH') or die('No direct script access.');

class Tkoauth {
    static $API_CONFIG = array(
        'appKey' => 'me4dzhozcs0m',
        'appSecret' => 'lqBfFekGyW3t0por',
        'callbackUrl' => NULL
    );
    
    static $fb_config = array(
        'appId'  => '270772266339016',
        'secret' => '494919517485241cfcc34a13824d383f',
    );
    
    public static function linkedin_logged_in() {
        session_start();
        return @$_SESSION['oauth']['linkedin']['authorized'] === TRUE;
    }

    public static function linkedin_login($url = "") {
        $API_CONFIG = Tkoauth::$API_CONFIG;

        // set the callback url
        $API_CONFIG['callbackUrl'] = $url . '?' . LINKEDIN::_GET_TYPE . '=initiate&' . LINKEDIN::_GET_RESPONSE . '=1';
        $OBJ_linkedin = new LinkedIn($API_CONFIG);

        // check for response from LinkedIn
        $_GET[LINKEDIN::_GET_RESPONSE] = (isset($_GET[LINKEDIN::_GET_RESPONSE])) ? $_GET[LINKEDIN::_GET_RESPONSE] : '';
        if (!$_GET[LINKEDIN::_GET_RESPONSE]) {
            $response = $OBJ_linkedin->retrieveTokenRequest();
            if ($response['success'] === TRUE) {
                $_SESSION['oauth']['linkedin']['request'] = $response['linkedin'];
                header('Location: ' . LINKEDIN::_URL_AUTH . $response['linkedin']['oauth_token']);
                exit();
            } else {
                return false;
            }
        } else {
            $response = $OBJ_linkedin->retrieveTokenAccess(@$_SESSION['oauth']['linkedin']['request']['oauth_token'], @$_SESSION['oauth']['linkedin']['request']['oauth_token_secret'], @$_GET['oauth_verifier']);
            if ($response['success'] === TRUE) {
                $_SESSION['oauth']['linkedin']['access'] = $response['linkedin'];
                $_SESSION['oauth']['linkedin']['authorized'] = TRUE;
                return true;
            } else {
                return false;
            }
        }
    }

    public static function linkedin_logout() {        
        $API_CONFIG = Tkoauth::$API_CONFIG;
        
        $OBJ_linkedin = new LinkedIn($API_CONFIG);
        $OBJ_linkedin->setTokenAccess($_SESSION['oauth']['linkedin']['access']);
        $response = $OBJ_linkedin->revoke();
        if ($response['success'] === TRUE) {
            session_unset();
            $_SESSION = array();
            if (session_destroy()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    public static function linkedin_getinfo() {
        if (!self::linkedin_logged_in()) {
            return false;
        }
        
        $API_CONFIG = Tkoauth::$API_CONFIG;
        $OBJ_linkedin = new LinkedIn($API_CONFIG);
        $OBJ_linkedin->setTokenAccess($_SESSION['oauth']['linkedin']['access']);
        $OBJ_linkedin->setResponseFormat(LINKEDIN::_RESPONSE_XML);
        
        $response = $OBJ_linkedin->profile('~:(id,first-name,last-name,picture-url)');
        if($response['success'] === TRUE) {
            $response['linkedin'] = new SimpleXMLElement($response['linkedin']);
            return $response['linkedin'];
        } else {
            return false;
        } 
    }

    public static function facebook_logged_in() {
        $facebook = new Facebook(Tkoauth::$fb_config);
        $user = $facebook->getUser();
        return $user ? true : false;
    }
    
    public static function facebook_login() {
        $facebook = new Facebook(Tkoauth::$fb_config);
        header("Location: " . $facebook->getLoginUrl());
        exit;
    }
    
    public static function facebook_logout() {
        $facebook = new Facebook(Tkoauth::$fb_config);
        
        header("Location: " . $facebook->getLogoutUrl(array( 'next' => URL::base().'logout.php?c=fbs_'.$facebook->getAppId() )));
        exit;
    }
    public static function facebook_logout_url() {
        $facebook = new Facebook(Tkoauth::$fb_config);
        return $facebook->getLogoutUrl();
    }
    
    public static function facebook_getinfo() {
        $facebook = new Facebook(Tkoauth::$fb_config);
        $user = $facebook->getUser();
            if ($user) {
            try {
                // Proceed knowing you have a logged in user who's authenticated.
                return $facebook->api('/me');
            } catch (FacebookApiException $e) {
                return false;
            }
        }
        return false;
    }
    
}
