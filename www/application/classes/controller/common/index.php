<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Common_Index extends Controller_Common {

    public function action_index() {       
        $page = "";
        
        $page = ORM::factory('page')->where('url', '=', $page)->find();
        if (!$page->loaded()) {
            exit;
        }
        
        View::set_global("_title", Kohana::$config->load('default.index_title'));
        View::set_global('_keywords', $page->keywords);
        View::set_global('_description', $page->description);
        
        $this->content = View::factory('common/index/index')->set("content", $page->text);
    }

}

