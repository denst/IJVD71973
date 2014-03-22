<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Cart extends Model {

    public static function add_to_cart($id, $count = 1) {
        $count = intval($count);
        $cart = self::get_cart();
        if ($count > 0) {
            $cart[$id] = $count;
        }
        else {
            unset($cart[$id]);
        }
        self::set_cart($cart);
        return true;
    }
    
    public static function delete_from_cart($id) {
        $cart = self::get_cart();
        unset($cart[$id]);
        self::set_cart($cart);
        return true;
    }
    
    public static  function get_cart() {
        $cart = Session::instance()->get('cart');
        if (!is_array($cart)) {
            $cart = array();
            self::set_cart($cart);
        }
        return $cart;
    }
    
    public static  function set_cart($cart) {
        $cart = Session::instance()->set('cart', $cart);
        return true;
    }
    
    public static  function get_cart_ids() {
        $cart = self::get_cart();
        return !count($cart) ? array(0) : array_keys($cart);
    }
    
    public static function clear_cart() {
        return self::set_cart(array());
    }

    public static function get_taken() {
        $taken = Session::instance()->get('taken');
        $taken = $taken ? true : false;
        return $taken;
    }

    public static function set_taken($taken) {
        $cart = Session::instance()->set('taken', $taken);
    }

}
