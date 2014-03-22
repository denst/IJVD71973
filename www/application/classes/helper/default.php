<?php

defined('SYSPATH') or die('No direct script access.');

class Helper_Default {

    static function get_by_type($type = 0) {
        $ret = array();
        foreach(ORM::factory('page')->where('type', '=', $type)->order_by('id')->find_all() as $page) {
            $ret[$page->id] = $page->title;
        }
        return $ret;
    }

}