<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Clients extends Controller_Admin {

    public function action_index() {
        $clients = ORM::factory('client')->order_by('id', 'desc')->find_all();
        $this->content = View::factory('admin/clients/index')->set("clients", $clients);
    }

    public function action_add() {
        if (count($_POST)) {
            $client = ORM::factory('client');
            $client->values($_POST);
            $client->save();
            
            $image = $this->_upload_image($client->id);
            if ($image) {
                $client->filename = $image;
                $client->save();
            }
            
            $this->request->redirect('admin/clients');
        }

        $this->content = View::factory('admin/clients/edit');
    }

    public function action_edit() {
        $id = $this->request->param('id');
        $client = ORM::factory('client', $id);
        if (!$client->loaded()) {
            $this->request->redirect('admin/clients');
        }

        if (count($_POST)) {
            $client->values($_POST);
            $client->save();
            
            $image = $this->_upload_image($client->id);
            if ($image) {
                $client->filename = $image;
                $client->save();
            }
            
            $this->request->redirect('admin/clients');
        }

        $post = $client->as_array();

        $this->content = View::factory('admin/clients/edit')->set('client', $client)->set('post', $post);
    }

    public function action_delete() {
        $id = $this->request->param('id');
        $client = ORM::factory('client', $id);
        if ($client->loaded()) {
            $client->delete();
        }
        $this->request->redirect('admin/clients');
    }
    
    private function _upload_image($id) {
        try {
            if ($_FILES['image']) {
                $tmp = Upload::save($_FILES['image'], microtime(true), 'temp');
                $path = pathinfo($_FILES['image']['name']);
                $ext = strtolower($path['extension']);
                $f = "{$id}_" . substr(md5($id), 0, 6) . "." . $ext;
                $f1 = "files/clients/th_{$f}";
                $f2 = "files/clients/{$f}";
                Image::factory($tmp)
                        ->resize(180, 180, Image::AUTO)
                        ->save($f1);
                Image::factory($tmp)
                        ->save($f2);
                unlink($tmp);
                return $f;
            }
        } catch (Exception $e) {

        }
        return "";
    }
    
}

