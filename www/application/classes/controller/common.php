<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Common extends Controller {

    protected $content = "";

    protected $view = "common";

    public function before() {
        /* page */
        $_page = Request::current()->param('page');
        View::set_global('_page', $_page);

        View::set_global("_options", ORM::factory('option')->find_all()->as_array("name"));

        try {
            $t1 = Tkoauth::linkedin_logged_in();
            $t2 = Tkoauth::facebook_logged_in();
            View::set_global("linkedin_logged_in", $t1);
            View::set_global("facebook_logged_in", $t2);

            $t = Tkoauth::linkedin_getinfo();
            View::set_global("linkedin",  $t1 ? $t->{"first-name"} . " " . $t->{"last-name"} : "");
            $t = Tkoauth::facebook_getinfo();
            View::set_global("facebook", $t2 ? $t['name'] : "");
        }
        catch (Exception $e) {
            View::set_global("linkedin_logged_in", false);
            View::set_global("facebook_logged_in", false);
            View::set_global("linkedin",  "");
            View::set_global("facebook", "");
        }

        $lastnews = ORM::factory('new')->order_by('id', 'DESC')->find();
        View::set_global("last_news", $lastnews->as_array());

        $page = ORM::factory('page')
                    ->and_where('url', '=', $_page)
                    ->find();

        if ($page) {
            $banners = ORM::factory( 'banner' )
                            ->with( 'group' )
                            ->join( 'banner_groups_pages', 'inner' )
                            ->on( 'banner_groups_pages.banner_group_id', '=', 'group.id' )
                            ->and_where( 'banner_groups_pages.page_id', '=', $page->id )
                            ->find_all();

            View::set_global("banners", $banners);
        }

        $this->con();
        $this->res();
    }

    public function after() {
        $this->response->body(View::factory($this->view)->bind('content', $this->content));
    }

    public function redirect($url = "", $code = 302) {
        $this->request->redirect($url, $code);
    }

    public function action_404() {
        $this->response->status(404);
        $this->view = "404";
    }

    public function con() {
        if (isset($_POST['con']) && is_array($_POST['con'])) {
            if(isset($_POST['recaptcha_challenge_field']) && 
                    isset($_POST['recaptcha_response_field']) && ! 
                    Recaptcha::check_captcha())
            {
                View::set_global("captcha_error", "Невереный текст капчи.");
                View::set_global("next_load", true);
                View::set_global("post_data", $_POST);
                View::set_global("recaptcha", true);
                return;
            }
            try {
                $titles = $products = array();
                foreach ($_POST as $key=>$value) {
                    if (strpos($key, "el_") === 0) {
                        $products[] = substr($key, 3);
                    }
                }
                foreach (ORM::factory('page')->where('id', 'IN', $products)->find_all() as $value) {
                    $titles[] = $value->title;
                }

                $view = View::factory('email/cons')->set("post", $_POST['con'])->set("titles", $titles)->set("conversion_types", Kohana::$config->load('default.conversion_types'));
                Email::send(Kohana::$config->load('default.form_email'), Kohana::$config->load('email.options.username'), "axes.pro: запрос", $view->render(), true);
                View::set_global("_message", "Ваш запрос успешно отправлен. В ближайшее время мы с Вами свяжемся");
            } catch (Exception $e) {
                View::set_global("_message", "Ваш запрос не был отправлен." . $e->getMessage());
            }
            $total_view = (int)$_POST['snap'] + 1;
            View::set_global("snap", $total_view);
            if($total_view > 10)
                View::set_global("recaptcha", true);
            Model_Cart::clear_cart();
        }
        else
            View::set_global("snap", 8);
            
    }

    public function res() {
        if (isset($_POST['res']) && is_array($_POST['res'])) {
            $filename = "";
            try {
                $file = Validation::factory($_FILES);
                $file->rule('file', 'Upload::not_empty')
                        ->rule('file', 'Upload::valid')
                        ->rule('file', 'Upload::type', array(':value', array('doc', 'docx', 'pdf', 'rtf', 'odt', 'txt')))
                        ->rule('file', 'Upload::size', array(':value', '3M'));
                if ($file->check()) {
                    $path = pathinfo($_FILES['file']['name']);
                    $ext = strtolower($path['extension']);
                    $filename = Upload::save($file['file'], microtime() . "." . $ext, 'temp');
                    $name = $_FILES['file']['name'];
                    $link = URL::base() . "temp/" . basename($filename);
                    $view = View::factory('email/res')->set("post", $_POST['res'])->set("link", $link)->set("name", $name);
                    Email::send(Kohana::$config->load('default.form_email'), Kohana::$config->load('email.options.username'), "axes.pro: резюме", $view->render(), true);
                    View::set_global("_message", "Ваше резюме успешно отправлено. В ближайшее время мы с Вами свяжемся");
                }
                else {
                    View::set_global("_message", "Ваше резюме не было отправлено");
                }

            } catch (Exception $e) {
            }
            //unlink("temp/" . $filename);
        }
    }

}
