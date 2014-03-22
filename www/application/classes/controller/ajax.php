<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ajax extends Controller {

    public function action_index() {

    }

    public function action_getcartcount() {
        $this->response->body(count(Model_Cart::get_cart()));
    }

    public function action_getcart() {
        $ret = array_keys(Model_Cart::get_cart());
        $this->response->body(json_encode($ret));
    }

    public function action_addtocart() {
        $id = $_POST['id'];
        Model_Cart::add_to_cart($id, 1);
        $this->response->body(count(Model_Cart::get_cart()));
    }

    public function action_deletefromcart() {
        $id = $_POST['id'];
        Model_Cart::delete_from_cart($id);
        $this->response->body(count(Model_Cart::get_cart()));
    }

    public function action_getlastnews()
    {
        $lastnews = ORM::factory('new')->order_by('id', 'DESC')->find();
        $this->response->body(json_encode($lastnews->as_array()));
    }
    
    public function action_checkcaptcha()
    {
        $result = false;
        if(Recaptcha::check_captcha())
            $result = true;
        $this->response->body(json_encode(array('result' => $result)));
    }

}

