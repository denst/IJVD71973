<?php defined('SYSPATH') or die('No direct access allowed.');

class Recaptcha
{
    static function check_captcha()
    {
        require Kohana::find_file('recaptcha', 'recaptchalib');
        $config = Kohana::$config->load('formbuilder.recaptcha');
        $resp = recaptcha_check_answer ($config['privatekey'],
                                      $_SERVER["REMOTE_ADDR"],
                                      $_POST["recaptcha_challenge_field"],
                                      $_POST["recaptcha_response_field"]);

        if (!$resp->is_valid) 
            return false;
        else 
            return true;
    }
}
