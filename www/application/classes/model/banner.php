<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Banner extends ORM {
    protected  $_belongs_to = array(
        'group' => array( 'model' => 'banner_group', 'foreign_key' => 'group_id' ),
    );

    public function rules()
    {
        return parent::rules() + array(
            'name' => array(
                array('not_empty')
            ),
            'material' => array(
                array('not_empty')
            )
        );
    }
}