<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Common_Clients extends Controller_Common {

    public function action_index() {
        $id = $this->request->param('id');

        if ($id) {
            $client = ORM::factory('client', $id);
            if (!$client->loaded()) {
                $this->action_404();
            }
            //View::set_global("_keywords", $client->keywords);
            //View::set_global("_description", $client->description);
            //View::set_global("_title", $client->title);

            $this->content = View::factory('common/clients/view')->bind("client", $client);
        }
        else {
            $page = ORM::factory('page')->where('module', "=", "clients")->find();
            View::set_global("_keywords", $page->keywords);
            View::set_global("_description", $page->description);
            View::set_global("_title", $page->name ?: $page->title);

            $clients = ORM::factory('client')->order_by('id', 'asc')->find_all();
            $this->content = View::factory('common/clients/index')->set("content", $page->text)->set("clients", $clients)->set("page", $page);
        }
    }

}
