<?php defined('SYSPATH') or die('No direct access allowed.');

class Recaptcha
{
    static function check_captcha()
    {
        require Kohana::find_file('vendor', 'recaptchalib');
        $config = Kohana::$config->load('recaptcha');
        $resp = recaptcha_check_answer ($config['privatekey'],
                                      $_SERVER["REMOTE_ADDR"],
                                      $_POST["recaptcha_challenge_field"],
                                      $_POST["recaptcha_response_field"]);

        if (!$resp->is_valid) 
            return false;
          // What happens when the CAPTCHA was entered incorrectly
//          die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
//               "(reCAPTCHA said: " . $resp->error . ")");
        else 
            return true;
          // Your code here to handle a successful verification
    }
}
