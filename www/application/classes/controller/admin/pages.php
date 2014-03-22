<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Pages extends Controller_Admin {

    public function action_index() {
        $pages = ORM::factory('page')->order_by('id', 'ASC')->find_all();
        $this->content = View::factory('admin/pages/index')->bind("pages", $pages);
    }

    public function action_add() {
        if (count($_POST)) {
            $page = ORM::factory('page');
            $page->values($_POST);
            $page->menu = isset($_POST['menu']) ? 1 : 0;
            $page->save();
            $this->redirect('admin/pages');
        }

        $post['menu'] = 1;
            
        $this->content = View::factory('admin/pages/edit')->bind('post', $post);
    }

    public function action_edit() {
        $id = $this->request->param('id');
        
        $page = ORM::factory('page', $id);
        if (!$page->loaded()) {
            $this->redirect('admin/pages');
        }

        if (count($_POST)) {
            $page->values($_POST);
            $page->menu = isset($_POST['menu']) ? 1 : 0;
            $page->save();
            $this->redirect('admin/pages');
        }

        $post = $page->as_array();

        $this->content = View::factory('admin/pages/edit')->bind('page', $page)->bind('post', $post);
    }

    public function action_delete() {
        $id = $this->request->param('id');
        
        $page = ORM::factory('page', $id);
        if ($page->loaded()) {
            $page->delete();
        }
        
        $this->redirect('admin/pages');
    }

}
