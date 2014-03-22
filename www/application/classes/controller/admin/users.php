<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Users extends Controller_Admin {

    public function action_index() {
        $users = ORM::factory('user')->find_all();
        $this->content = View::factory('admin/users/index')->bind("users", $users);
    }
    
    public function action_exportcsv() {
        $str = "Email;Фамилия;Имя;Компания\n";
        foreach (ORM::factory('user')->find_all() as $user) {
            $str .= $user->email . ';' . $user->lastname . ';' . $user->firstname . ';' . $user->company . "\n";
        }
        $this->response->headers(array('Content-Type' => 'text/csv', 'Cache-Control' => 'no-cache'));
        $this->response->body($str);
        $this->response->send_file(TRUE, "users.csv");
        exit;
    }
    
    public function action_exportvcard() {
        $str = "";
        foreach (ORM::factory('user')->find_all() as $user) {
            $str .= <<<EOD
BEGIN:VCARD
VERSION:3.0
FN:{$user->firstname} {$user->lastname}
N:{$user->lastname};{$user->firstname}
ORG:{$user->company}
EMAIL;TYPE=INTERNET:{$user->email}
END:VCARD
EOD;
            $str .= "\n\n";
        }
        $this->response->headers(array('Content-Type' => 'text/x-vcard', 'Cache-Control' => 'no-cache'));
        $this->response->body($str);
        $this->response->send_file(TRUE, "users.vcf");
        exit;
    }
    
    public function action_add() {
        if (count($_POST)) {
            $user = ORM::factory('user');
            $user->values($_POST);
            if (!$_POST['password']) {
                $user->password = "pass";
            }
            $user->save();
            
            $login_role = new Model_Role(array('name' =>'login'));
            $user->add('roles',$login_role);
            
            if ($_POST['admin']) {
                $admin_role = new Model_Role(array('name' =>'admin'));
                $user->add('roles',$admin_role);
            }
            if ($_POST['client']) {
                $client_role = new Model_Role(array('name' =>'client'));
                $user->add('roles',$client_role);
            }
            
            $this->redirect('admin/users');
        }

        $this->content = View::factory('admin/users/edit');
    }

    public function action_edit() {
        $id = $this->request->param('id');
        
        $user = ORM::factory('user', $id);
        if (!$user->loaded()) {
            $this->redirect('admin/users');
        }
        
        $admin_role = new Model_Role(array('name' =>'admin'));
        $client_role = new Model_Role(array('name' =>'client'));

        if (count($_POST)) {
            if (!$_POST['password']) {
                unset($_POST['password']);
            }
            $user->values($_POST);
            $user->save();

            $user->remove('roles',$admin_role);
            $user->remove('roles',$client_role);
            
            if (isset($_POST['admin'])) {
                $user->add('roles',$admin_role);
            }
            if (isset($_POST['client'])) {
                $user->add('roles',$client_role);
            }
            
            $this->redirect('admin/users');
        }

        $post = $user->as_array();
        $post['admin'] = $user->has('roles', $admin_role);
        $post['client'] = $user->has('roles', $client_role);

        $this->content = View::factory('admin/users/edit')->bind('user', $user)->bind('post', $post);
    }
    
}
