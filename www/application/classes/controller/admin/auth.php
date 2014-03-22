<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Auth extends Controller_Common {

    public function action_login() {
        if (Auth::instance()->logged_in("admin")) {
            $this->redirect('admin');
        }

        if (count($_POST)) {
            if (Auth::instance()->login($_POST['username'], $_POST['password'])) {
                $this->redirect('admin');
            }
            else {
                Message::error(__('Неправильный логин или пароль'));
            }
        }

        View::set_global("_title", Kohana::$config->load("default.title"));
        
        $this->view = "login";
        $this->content = View::factory('admin/auth/login')->set("post", $_POST);
    }

    public function action_logout() {
        Auth::instance()->logout();
        $this->redirect('admin');
    }

}
