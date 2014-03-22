<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Speakers extends Controller_Admin
{

    protected $urlBase = 'admin/speakers';

    /**
     * @param null|int $id
     * @return ORM
     */
    protected function getModel($id = null)
    {
        return ORM::factory('speaker', $id);
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
            $image = $this->_upload_image($item->id);
            if ($image) {
                $item->photo = $image;
                $item->save();
            }
            $item->sync('videos', $_POST['videos']);
            $this->request->redirect($this->urlBase);
        }
        $videos_array = $item->get_relation_options_for_select2('videos', 'title');
        $this->content = View::factory($this->urlBase . '/edit')
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

            $image = $this->_upload_image($item->id);
            if ($image) {
                $item->photo = $image;
                $item->save();
            }
            $item->sync('videos', $_POST['videos']);
            $this->request->redirect($this->urlBase);
        }
        $post = $item->as_array();
        $post['videos'] = $item->get_relation_value('videos', 'title');
        $videos_array = $item->get_relation_options_for_select2('videos', 'title');
        $this->content = View::factory($this->urlBase . '/edit')->set('new', $item)
            ->set('post', $post)
            ->set('videos_array', $videos_array);
    }

    private function _upload_image($id)
    {
        try {
            if (!empty($_FILES['photo']['name'])) {
                $tmp = Upload::save($_FILES['photo'], microtime(true), 'temp');
                $path = pathinfo($_FILES['photo']['name']);
                $ext = strtolower($path['extension']);
                $f = "{$id}_" . substr(md5($id), 0, 6) . "." . $ext;
                $f1 = "files/speakers/th_{$f}";
                $f2 = "files/speakers/{$f}";
                Image::factory($tmp)
                    ->resize(180, 180, Image::AUTO)
                    ->save($f1);
                Image::factory($tmp)
                    ->save($f2);
                unlink($tmp);
                return $f;
            }
        } catch (Exception $e) {
            if (!IN_PRODUCTION) {
                die($e->getMessage());
            }
        }
        return;
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
}
