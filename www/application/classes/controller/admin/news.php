<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_News extends Controller_Admin {

    public function action_index() {
        $news = ORM::factory('new')->order_by('id', 'desc')->find_all();
        $this->content = View::factory('admin/news/index')->set("news", $news);
    }

    public function action_add() {
        if (count($_POST)) {
            $new = ORM::factory('new');
            $new->values($_POST);
            $new->created = time();
            $new->save();
            $this->_tags($new->id, $_POST['tags']);
            $this->request->redirect('admin/news');
        }

        $this->content = View::factory('admin/news/edit');
    }

    public function action_edit() {
        $id = $this->request->param('id');
        $new = ORM::factory('new', $id);
        if (!$new->loaded()) {
            $this->request->redirect('admin/news');
        }

        if (count($_POST)) {
            $new->values($_POST);
            $new->save();
            $this->_tags($new->id, $_POST['tags']);
            $this->request->redirect('admin/news');
        }

        $post = $new->as_array();
        $post['tags'] = implode(", ", $new->tags->find_all()->as_array("id", "title"));

        $this->content = View::factory('admin/news/edit')->set('new', $new)->set('post', $post);
    }

    public function action_delete() {
        $id = $this->request->param('id');
        $new = ORM::factory('new', $id);
        if ($new->loaded()) {
            $new->delete();
        }
        $this->request->redirect('admin/news');
    }

    public function _tags($id, $tags) {
        $news = ORM::factory('new', $id);
        $tags = explode(",", $tags);
        
        foreach($news->tags->find_all() as $tag) {
            $news->remove('tags', $tag);
        }
        
        if (is_array($tags)) {
            foreach($tags as $tag) {
                $tag = trim($tag);
                $t = ORM::factory('tag')->where('title', '=', $tag)->find();
                if (!$t->loaded()) {
                    $t = ORM::factory('tag');
                    $t->title = $tag;
                    $t->save();
                }
                $news->add('tags', $t);
            }
        }
    }
    
}

