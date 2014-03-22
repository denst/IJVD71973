<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Common_Feedback extends Controller_Common {

    public function action_index() {
        $page = $this->request->param('page');

        $page = ORM::factory('page')->where('url', '=', $page)->find();
        if (!$page->loaded()) {
            $this->action_404();
        }

        View::set_global("_title", $page->name ?: $page->title);
        View::set_global('_keywords', $page->keywords);
        View::set_global('_description', $page->description);

        if (count($_POST)) {
            try {
                $link = $name = '';

                $file = Validation::factory($_FILES);
                $file->rule('cfile', 'Upload::not_empty')
                        ->rule('cfile', 'Upload::valid')
                        ->rule('cfile', 'Upload::type', array(':value', array('doc', 'docx', 'pdf', 'rtf', 'odt', 'txt')))
                        ->rule('cfile', 'Upload::size', array(':value', '3M'));
                if ($file->check()) {
                    $path = pathinfo($_FILES['file']['name']);
                    $ext = strtolower($path['extension']);
                    $filename = Upload::save($file['file'], microtime() . "." . $ext, 'temp');
                    $name = $_FILES['file']['name'];
                    $link = URL::base() . "temp/" . basename($filename);
                }

                $view = View::factory('email/feedback')->set("post", $_POST)->set('link', $link)->set('name', $name);
                Email::send(Kohana::$config->load('default.form_email'), Kohana::$config->load('email.options.username'), "axes.pro: отзывы клиентов", $view->render(), true);
                View::set_global("_message", "Ваше сообщение успешно отправлено");
            } catch (Exception $e) {
            }
        }

        $this->content = View::factory('common/feedback/index')->set("content", $page->text)->set("page", $page);
    }

}

