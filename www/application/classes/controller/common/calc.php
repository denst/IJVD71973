<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Common_Calc extends Controller_Common {

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
                $titles = $products = array();
                foreach ($_POST as $key=>$value) {
                    if (strpos($key, "calc_") === 0) {
                        $products[] = substr($key, 5);
                    }
                }
                foreach (ORM::factory('page')->where('id', 'IN', $products)->find_all() as $value) {
                    $titles[] = $value->title;
                }

                $content = View::factory('email/calc')->set("post", $_POST)->set("titles", $titles);
                Email::send(Kohana::$config->load('default.form_email'), Kohana::$config->load('email.options.username'), "axes.pro: калькулятор", $content->render(), true);
                View::set_global("_message", "Ваше сообщение успешно отправлено");
            } catch (Exception $e) {
            }
        }

        $this->content = View::factory('common/calc/index')->set("content", $page->text)->set("page", $page);
    }

}

