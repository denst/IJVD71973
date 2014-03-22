<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Requests extends Controller_Admin {

    public $baseUrl = "admin/requests";
    public $viewPath = "admin/requests";

    public function action_conversion() {
        $banners = ORM::factory('banner')->find_all();
        $this->content = View::factory($this->viewPath . '/index')->bind("banners", $banners);
    }

    public function action_groups() {
        $groups = ORM::factory('banner_group')->find_all();
        $this->content = View::factory($this->viewPath . '/groups')->bind("groups", $groups);
    }

    public function action_add() {
        if (count($_POST)) {
            $banner = ORM::factory('banner');
            $banner->values($_POST);
            $banner->save();
            $this->redirect($this->baseUrl);
        }

        $groups = ORM::factory('banner_group')->find_all();

        $groupsSelect = array();
        foreach ($groups as $group) {
            $groupsSelect[$group->id] = $group->name;
        }

        $this->content = View::factory($this->viewPath . '/edit')->bind('groups', $groupsSelect);
    }

    public function action_edit() {
        $id = $this->request->param('id');

        $banner = ORM::factory('banner', $id);
        if (!$banner->loaded()) {
            $this->redirect($this->baseUrl);
        }

        if (count($_POST)) {
            $banner->values($_POST);
            $banner->save();

            $this->redirect($this->baseUrl);
        }

        $post = $banner->as_array();

        $groups = ORM::factory('banner_group')->find_all();

        $groupsSelect = array();
        foreach ($groups as $group) {
            $groupsSelect[$group->id] = $group->name;
        }


        $this->content = View::factory($this->viewPath . '/edit')->bind('banner', $banner)->bind('post', $post)->bind('groups', $groupsSelect);
    }

    public function action_addgroup() {
        if (count($_POST)) {
            $group = ORM::factory('banner_group');
            $group->values($_POST);

            // проблема с нечисловым количеством баннеров
            $group->save();

            $group->add('pages', $_POST['pages']);

            $this->redirect($this->baseUrl . '/groups');
        }

        $pages = ORM::factory('page')
                    // ->and_where('parent_id', '=', 0)
                    // ->and_where('id', 'in', $this->pages)
                    ->and_where('title', 'in', $this->pageNames)
                ->find_all();

        $pagesSelect = array();
        foreach ($pages as $page) {
            $pagesSelect[$page->id] = $page->title;
        }

        $this->content = View::factory($this->viewPath . '/edit_group')->bind('pages', $pagesSelect);
    }

    public function action_editgroup() {
        $id = $this->request->param('id');

        $group = ORM::factory('banner_group', $id);
        if (!$group->loaded()) {
            $this->redirect($this->baseUrl . '/groups');
        }

        if (count($_POST)) {
            $group->values($_POST);
            $group->save();

            $group->remove('pages');
            $group->add('pages', $_POST['pages']);

            $this->redirect($this->baseUrl . '/groups');
        }

        $post = $group->as_array();

        $pages = ORM::factory('page')
                    // ->and_where('parent_id', '=', 0)
                    // ->and_where('id', 'in', $this->pages)
                    ->and_where('title', 'in', $this->pageNames)
                ->find_all();

        $pagesSelect = array();
        foreach ($pages as $page) {
            $pagesSelect[$page->id] = $page->title;
        }


        $this->content = View::factory($this->viewPath . '/edit_group')->bind('group', $group)->bind('post', $post)->bind('pages', $pagesSelect);
    }

}
