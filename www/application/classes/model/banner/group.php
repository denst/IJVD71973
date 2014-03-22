<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Banner_Group extends ORM {
    protected $_has_many = array(
        'banners' => array('model' => 'banner', 'foreign_key' => 'group_id'),
        'pages' => array('model' => 'page', 'through' => 'banner_groups_pages'),
    );


    public function rules()
    {
        return parent::rules() + array(
            'name' => array(
                array('not_empty'),
            ),
            'banners_count' => array(
                array('numeric'),
            ),
        );
    }
}