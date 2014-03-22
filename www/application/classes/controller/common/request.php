<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Common_Request extends Controller_Common {

    public function action_index() {
        $page = $this->request->param('page');

        $page = ORM::factory('page')->where('url', '=', $page)->find();
        if (!$page->loaded()) {
            $this->action_404();
        }

        View::set_global("_title", $page->name ?: $page->title);
        View::set_global('_keywords', $page->keywords);
        View::set_global('_description', $page->description);

        $this->content = View::factory('common/request/index')->set("content", $page->text)->set("page", $page);
    }

}

