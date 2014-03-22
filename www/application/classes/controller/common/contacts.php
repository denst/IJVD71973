<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Common_Contacts extends Controller_Common {

    public function action_index() {
        $page = $this->request->param('page');

        $page = ORM::factory('page')->where('url', '=', $page)->find();
        if (!$page->loaded()) {
            $this->action_404();
        }

        View::set_global("_title", $page->name ?: $page->title);
        View::set_global('_keywords', $page->keywords);
        View::set_global('_description', $page->description);

        if (count($_POST)) {
            if(isset($_POST['recaptcha_challenge_field']) && 
                    isset($_POST['recaptcha_response_field']) && ! 
                    Recaptcha::check_captcha())
            {
                View::set_global("captcha_error_contact", "Невереный текст капчи.");
                View::set_global("post_data", $_POST);
                View::set_global("recaptcha_contact", true);
                $this->content = View::factory('common/contacts/index')->set("content", $page->text)->set("page", $page);
                return;
            }
            try {
                $view = View::factory('email/contacts')->set("post", $_POST);
                Email::send(Kohana::$config->load('default.form_email'), 'denis.lushchenko', "axes.pro: спам", print_r($_SERVER), true);
                Email::send(Kohana::$config->load('default.form_email'), Kohana::$config->load('email.options.username'), "axes.pro: обратная связь", $view->render(), true);
                View::set_global("_message", "Ваше сообщение успешно отправлено");
            } catch (Exception $e) {
            }
            $total_view = (int)$_POST['snap_contact'] + 1;
            View::set_global("snap_contact", $total_view);
            if($total_view > 10)
                View::set_global("recaptcha_contact", true);
        }
        else
            View::set_global("snap_contact", 8);
        $this->content = View::factory('common/contacts/index')->set("content", $page->text)->set("page", $page);
    }

}

