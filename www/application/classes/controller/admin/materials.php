<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Materials extends Controller_Admin
{

    protected $urlBase = 'admin/materials';

    /**
     * @param null|int $id
     * @return ORM
     */
    protected function getModel($id = null)
    {
        return ORM::factory('material', $id);
    }

    public function action_index()
    {
        $list = $this->getModel()->order_by('id', 'desc')->find_all();
        $this->content = View::factory($this->urlBase . '/index')->set("list", $list);
    }

    public function action_add()
    {
        $item = $this->getModel();
        if (!empty($_POST)) {
            $item->values($_POST);
            $item->save();
            $this->_tags($item->id, $_POST['tags']);
            $file = $this->_upload($item->id);
            if ($file) {
                $item->path = $file;
                $item->save();
            }
            $item->sync('speakers', $_POST['speakers']);
            $this->request->redirect($this->urlBase);
        }
        $this->content = View::factory($this->urlBase . '/edit')
            ->set('speakers_array', $item->get_relation_options_for_select2('speakers', 'firstname'));
    }

    public function action_edit()
    {
        $id = $this->request->param('id');
        $item = $this->getModel($id);
        if (!$item->loaded()) {
            $this->request->redirect($this->urlBase);
        }

        if (!empty($_POST)) {
            $item->values($_POST);
            $item->save();
            $this->_tags($item->id, $_POST['tags']);
            $this->_topic($item->id, $_POST['topic']);
            $file = $this->_upload($item->id);
            if ($file) {
                $item->path = $file;
                $item->save();
            }
            $item->sync('speakers', $_POST['speakers']);
            $this->request->redirect($this->urlBase);
        }
        $post = $item->as_array();
        $post['tags'] = implode(", ", $item->tags->find_all()->as_array("id", "title"));
        $post['topic'] = implode(", ", $item->topics->find_all()->as_array("id", "title"));
        $post['speakers'] = $item->get_relation_value('speakers', 'firstname');
        $this->content = View::factory($this->urlBase . '/edit')
            ->set('new', $item)
            ->set('post', $post)
            ->set('speakers_array', $item->get_relation_options_for_select2('speakers', 'firstname'));
    }

    public function action_delete()
    {
        $id = $this->request->param('id');
        $item = $this->getModel($id);
        if ($item->loaded()) {
            $item->delete();
        }
        $this->request->redirect($this->urlBase);
    }

    protected function _tags($id, $tags)
    {
        $items = $this->getModel($id);
        $tags = explode(",", $tags);
        $items->remove('tags');
        if (is_array($tags)) {
            foreach ($tags as $tag) {
                $tag = trim($tag);
                if (!$tag) {
                    continue;
                }
                $t = ORM::factory('tags4hrclub')->where('title', '=', $tag)->find();
                if (!$t->loaded()) {
                    $t = ORM::factory('tags4hrclub');
                    $t->title = $tag;
                    $t->save();
                }
                $items->add('tags', $t);
            }
        }
    }

    public function _topic($id, $topics)
    {
        $items = $this->getModel($id);
        $topics = explode(",", $topics);
        $items->remove('topics');
        if (is_array($topics)) {
            foreach ($topics as $topic) {
                $topic = trim($topic);
                if (!$topic) {
                    continue;
                }
                $t = ORM::factory('topic')->where('title', '=', $topic)->find();
                if (!$t->loaded()) {
                    $t = ORM::factory('topic');
                    $t->title = $topic;
                    $t->save();
                }
                $items->add('topics', $t);
            }
        }
    }

    private function _upload($id)
    {
        try {
            if (!empty($_FILES['path']['name'])) {
                $path = pathinfo($_FILES['path']['name']);
                $ext = strtolower($path['extension']);
                $filename = $id . '.' . $ext;
                $tmp = Upload::save($_FILES['path'], $filename, 'files/materials');
                return $filename;
            }
        } catch (Exception $e) {
            if (!IN_PRODUCTION) {
                die($e->getMessage());
            }
        }
        return;
    }
}
