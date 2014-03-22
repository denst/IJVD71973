<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Install extends Controller {

    public function action_index() {
        try {
            $user = ORM::factory('user');	
            $user->values(array("username" => "admin", "password" =>"pass", "email" => "some@email.com"));
            $user->save();
            
            $login_role = new Model_Role(array('name' =>'login'));
            $user->add('roles',$login_role);
            
            $admin_role = new Model_Role(array('name' =>'admin'));
            $user->add('roles',$admin_role);
        }
        catch (Exception $e) {
            $error = $e->getMessage();
        }
        $this->response->body(isset($error) ? "ERROR" : "OK");
    }

    public function action_convertnews() {
        $news = ORM::factory('new')->find_all();
        foreach ($news as $new) {
            if (!$new->url_old) {
                $new->url_old = $new->url;
                $new->save();
            }
        }
        $this->response->body("OK");
    }

}

