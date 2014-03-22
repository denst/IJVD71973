<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Common_Private extends Controller_Common {

    public function action_index() {
        if (!Auth::instance()->logged_in()) {
            $this->redirect('');
        }
        else {
            View::set_global("_page", "private");
            $user = Auth::instance()->get_user();
            $client_role = new Model_Role(array('name' =>'client'));
            $client = $user->has('roles', $client_role);
            $this->content = View::factory('common/private/index')->set("user", $user)->set("client", $client);
        }
    }

    public function action_login() {
        if (Auth::instance()->logged_in()) {
            $this->request->redirect('private');
        }

        $error = "";
        if (count($_POST)) {
            if (Auth::instance()->login(@$_POST['clogin'], @$_POST['cpassword'])) {
                $this->request->redirect('private');
            }
            else {
                $error = __('Неправильное имя пользователя или пароль');
            }
        }
        $this->content = View::factory('common/private/login');
    }

    public function action_logout() {
        $_SESSION = array();
        Auth::instance()->logout(true);
        $this->redirect();
    }

    public function action_register() {
        if (Auth::instance()->logged_in()) {
            $this->request->redirect('private');
        }
        $errors = array();
        if (count($_POST)) {
            try
            {              
                $post = $_POST;
                $user = ORM::factory('user')->create_user(
                       $post, array(
                           'username','password','email','firstname','lastname'
                       ));
 
                $user->add('roles',ORM::factory('role')
                       ->where('name','=','login')->find());
 
                $_POST = array();
 
                Auth::instance()->force_login($post['username']);
                $this->redirect('private');
            }
            catch(ORM_Validation_Exception $e)
            {
                $errors = $e->errors('users');
                $errors['password'] = isset($errors['_external']['password']) ? "Пароль должен быть не менее 8 символов" : null;
                $errors['password_confirm'] = isset($errors['_external']['password_confirm']) ? "Введенные пароли не совпадают" : null;
                unset($errors['_external']);
            }
        }
        
        $this->content = View::factory('common/private/register')->set("errors", $errors);
    }
    
    /*public function action_recovery() {
        if (Auth::instance()->logged_in()) {
            $this->request->redirect('');
        }
        
        $msg = "";
        $errors = array();
        
        $key = Request::instance()->param('key');
        if ($key) {
            $tmp = explode("_", $key);
            $id = intval($tmp[0]);
            $user = ORM::factory('user')->find($id);
            if ($user->loaded() && count($tmp)==2 && substr(md5(md5($user->password)), 0, 6) == $tmp[1]) {
                $msg = "На Ваш электронный адрес выслано письмо с <b>новым паролем</b>";
                $password = Text::random('distinct', 6);
                
                // mail new pass
                $msg_client = "Ваш новый пароль: {$password}\n\nМы все еще любим Вас!";
                $user->password = $password;
                $user->save();
                try {
                    Email::send($user->email, "drunk.moscow@gmail.com", "drunk-moscow.com - Новый пароль", $msg_client, false);
                } catch (Exception $e) {
                }
            }
            else {
                $this->request->redirect('');
            }
            
            $this->content = View::factory('index/recovery')->bind("errors", $errors)->bind('msg', $msg)->bind('post', $_POST);
        }
        else {
            if (count($_POST)) {
                $user = ORM::factory('user')->where('email', '=', $_POST['login'])->find();
                if (!$user->loaded()) {
                    $errors[] = "Неправильный логин";
                }
                else {
                    $key = $user->id . "_" . substr(md5(md5($user->password)), 0, 6);
                    $msg = "На Ваш электронный адрес выслано письмо";
                    
                    // mail request
                    $msg_client = "Вы оставили запрос на восстановление пароля. Если это были Вы, то пройдите по ссылке http://www.drunk-moscow.com/recovery/{$key}\n\nВ противном случае проигнорируйте это письмо";
                    try {
                        Email::send($user->email, "drunk.moscow@gmail.com", "drunk-moscow.com - Восстановление пароля", $msg_client, false);
                    } catch (Exception $e) {
                    }
                }
            }
            
            $this->content = View::factory('index/recovery')->bind("errors", $errors)->bind('msg', $msg)->bind('post', $_POST);
        }
        
        $this->view = "login";
    }*/

}
