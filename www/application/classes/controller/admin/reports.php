<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Reports extends Controller_Admin
{

    protected $urlBase = 'admin/reports';

    /**
     * @param null|int $id
     * @return ORM
     */
    protected function getModel($id = null)
    {
        return ORM::factory('report', $id);
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
            $this->_topic($item->id, $_POST['topic']);
            $item->sync('speakers', $_POST['speakers']);
            $item->sync('materials', $_POST['materials']);
            $item->sync('videos', $_POST['videos']);
            $this->request->redirect($this->urlBase);
        }
        $videos_array = $item->get_relation_options_for_select2('videos', 'title');
        $this->content = View::factory($this->urlBase . '/edit')
            ->set('speakers_array', $item->get_relation_options_for_select2('speakers', 'firstname'))
            ->set('materials_array', $item->get_relation_options_for_select2('materials', 'title'))
            ->set('videos_array', $videos_array);
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
            $item->sync('speakers', $_POST['speakers']);
            $item->sync('materials', $_POST['materials']);
            $item->sync('videos', $_POST['videos']);
            $this->request->redirect($this->urlBase);
        }
        $post = $item->as_array();
        $post['tags'] = implode(", ", $item->tags->find_all()->as_array("id", "title"));
        $post['topic'] = implode(", ", $item->topics->find_all()->as_array("id", "title"));
        $post['speakers'] = $item->get_relation_value('speakers', 'firstname');
        $post['materials'] = $item->get_relation_value('materials', 'title');
        $post['videos'] = $item->get_relation_value('videos', 'title');

        $this->content = View::factory($this->urlBase . '/edit')
            ->set('new', $item)
            ->set('post', $post)
            ->set('speakers_array', $item->get_relation_options_for_select2('speakers', 'firstname'))
            ->set('materials_array', $item->get_relation_options_for_select2('materials', 'title'))
            ->set('videos_array', $item->get_relation_options_for_select2('videos', 'title'));
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

        foreach ($items->tags->find_all() as $tag) {
            $items->remove('tags', $tag);
        }

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

        foreach ($items->topics->find_all() as $topic) {
            $items->remove('topics', $topic);
        }

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
}
