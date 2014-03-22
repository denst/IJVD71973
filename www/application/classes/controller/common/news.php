<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Common_News extends Controller_Common {

    public function action_index() {
        $id = $this->request->param('id');

        if ($id) {
            $news = ORM::factory('new', $id);
            if (!$news->loaded()) {
                $this->action_404();
            } else {
                $this->redirect('news/' . $news->url, 301);
            }
        }
        else {
            $per_page = 8;
            $page = max(1, Request::current()->param('p'));
            $offset = $per_page * ($page-1);
            $count = ORM::factory('new')->count_all();
            $pag_data = array(
                'total_items' => $count,
                'items_per_page' => $per_page,
                'current_page' => array(
                    'source' => 'route',
                    'key' => 'p'
                ),
                'auto_hide' => TRUE,
                'view' => 'pagination/spec',
            );
            $news = ORM::factory('new')->order_by('id', 'desc')->limit($per_page)->offset($offset)->find_all();

            $page = ORM::factory('page')->where('module', "=", "news")->find();
            View::set_global("_keywords", $page->keywords);
            View::set_global("_description", $page->description);
            View::set_global("_title", $page->name ?: $page->title);

            $this->content = View::factory('common/news/index')->bind("news", $news)->set("pagination", Pagination::factory($pag_data));
        }
    }

    public function action_view() {
        $url = $this->request->param('url');
        $news = ORM::factory('new', array('url' => $url));
        if (!$news->loaded()) {
            $news_old = ORM::factory('new', array('url_old' => $url));
            if (!$news_old->loaded()) {
                $this->action_404();
            } else {
                $this->redirect('news/' . $news_old->url, 301);
            }
        }
        View::set_global("_keywords", $news->keywords);
        View::set_global("_description", $news->description);
        View::set_global("_title", $news->title);

        $captcha = Captcha::instance();
        $this->content = View::factory('common/news/view')->bind("news", $news)->set("captcha", $captcha);
    }

    public function action_rss() {
        $info = array(
            'title' => 'Новости',
            'language' => 'ru',
            'description' => 'Новости от Axes.pro',
            'link' => Kohana::$base_url . 'news.rss',
            'pubDate' => time()
        );

        $items = array();

        foreach (ORM::factory('new')->order_by('created', 'desc')->find_all() as $news) {
            $items[] = array(
                'title'       => str_replace('&', '&amp;', $news->title),
                'link'        => str_replace('&', '&amp;', URL::site("news/".$news->url)),
                'guid'        => str_replace('&', '&amp;', URL::site("news/".$news->url)),
                'description' => str_replace('&', '&amp;', $news->annotation),
                'pubDate'     => date(DATE_RSS, $news->created),
            );
        }

        //Перед выводом не забудем установить правильный хедер для xml
        header('Content-Type: text/xml');

        //выводим нашу RSS ленту
        echo feed::create($info, $items);
        exit;
    }

    public function action_tags() {
        $title = $this->request->param('id');

        $tag = ORM::factory('tag')->where('title', '=', $title)->find();
        if ($tag->loaded()) {
            $per_page = 8;
            $page = max(1, Request::current()->param('p'));
            $offset = $per_page * ($page-1);
            $count = $tag->news->order_by('id', 'desc')->count_all();
            $pag_data = array(
                'total_items' => $count,
                'items_per_page' => $per_page,
                'current_page' => array(
                    'source' => 'route',
                    'key' => 'p'
                ),
                'auto_hide' => TRUE,
                'view' => 'pagination/spec',
            );

            $news = $tag->news->order_by('id', 'desc')->limit($per_page)->offset($offset)->find_all();
            $this->content = View::factory('common/news/index')->bind("news", $news)->set("pagination", Pagination::factory($pag_data));
        }
        else {
            $this->redirect('news');
        }

    }

    public function action_categories() {
        $title = $this->request->param('id');

        $category = array_search($title, Kohana::$config->load('default.categories'));

        $per_page = 8;
        $page = max(1, Request::current()->param('p'));
        $offset = $per_page * ($page-1);
        $count = ORM::factory('new')->where('category', '=', $category)->count_all();
        $pag_data = array(
            'total_items' => $count,
            'items_per_page' => $per_page,
            'current_page' => array(
                'source' => 'route',
                'key' => 'p'
            ),
            'auto_hide' => TRUE,
            'view' => 'pagination/spec',
        );
        $news = ORM::factory('new')->where('category', '=', $category)->order_by('id', 'desc')->limit($per_page)->offset($offset)->find_all();

        $this->content = View::factory('common/news/index')->bind("news", $news)->set("pagination", Pagination::factory($pag_data));
    }

    public function _news() {
        $page = ORM::factory('page')->where('module', "=", "news")->find();
        View::set_global("_keywords", $page->keywords);
        View::set_global("_description", $page->description);
        View::set_global("_title", $page->name ?: $page->title);
    }

    public function action_comment() {
        $id = $this->request->param('id');
        $news = ORM::factory('new', $id);

        $comment = ORM::factory('comment');
        $comment->created = time();
        $comment->text = $_POST['text'];
        if (Auth::instance()->logged_in()) {
            $comment->user_id = Auth::instance()->get_user()->id;
        }
        else {
            if (Tkoauth::linkedin_logged_in()) {
                $t = Tkoauth::linkedin_getinfo();
                $comment->name = $t->{"first-name"} . " " . $t->{"last-name"};
                $comment->user_id = 0;
            }
            elseif (Tkoauth::facebook_logged_in()) {
                $t = Tkoauth::facebook_getinfo();
                $comment->name = $t['name'];
                $comment->user_id = 0;
            }
            elseif (Captcha::valid($_POST['ccheck'])) {
                $comment->user_id = 0;
            }
            else {
                $this->redirect('news/' . $news->url);
            }
        }
        $comment->new_id = $id;
        $comment->save();

        $this->redirect('news/' . $news->url);
    }

    public function action_commentdelete() {
        $id = $this->request->param('id');

        $comment = ORM::factory('comment', $id);
        if (!$comment->loaded() || !Auth::instance()->logged_in("admin")) {
            $this->redirect('news');
        }

        $news_id = $comment->new_id;
        $comment->delete();

        $this->redirect('news/' . $news_id);
    }

}
