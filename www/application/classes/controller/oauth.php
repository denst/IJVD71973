<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Oauth extends Controller {

    
    public function action_linkedin()
    {
        session_start();
        Tkoauth::linkedin_login(URL::site('oauth/linkedin'));
        header("Location: " . URL::site('news'));
        exit;
    }
    
    public function action_facebook()
    {
        if (!Tkoauth::facebook_logged_in()) {
            Tkoauth::facebook_login();
        }
        header("Location: " . URL::site('news'));
        exit;
    }

    public function action_logout() {
        if (Tkoauth::facebook_logged_in()) {
            Tkoauth::facebook_logout();
        }
        if (Tkoauth::linkedin_logged_in()) {
            Tkoauth::linkedin_logout();
        }
        header("Location: " . URL::base());
        exit;
    }
    
    public function action_status() {
        var_dump(Tkoauth::facebook_logged_in());
        var_dump(Tkoauth::linkedin_logged_in());
    }
} // End Welcome
