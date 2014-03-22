<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Options extends Controller_Admin {

    public function action_index() {
        $options = ORM::factory('option')->order_by('id', 'ASC')->find_all();
        $this->content = View::factory('admin/options/index')->bind("options", $options);
    }

    public function action_edit() {
        $id = $this->request->param('id');
        
        $option = ORM::factory('option', $id);
        if (!$option->loaded()) {
            $this->redirect('admin/options');
        }

        if (count($_POST)) {
            $option->values($_POST);
            $option->save();
            $this->redirect('admin/options');
        }

        $post = $option->as_array();

        $this->content = View::factory('admin/options/edit')->bind('option', $option)->bind('post', $post);
    }

}
