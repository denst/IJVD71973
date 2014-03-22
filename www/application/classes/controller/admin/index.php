<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Index extends Controller_Admin {

    public function action_index() {       
        $this->redirect("admin/pages");
        $this->content = View::factory('admin/index/index');
    }

}
