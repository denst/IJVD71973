<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Comment extends ORM {
    protected $_belongs_to = array('user' => array('model' => 'user', 'foreign_key' => 'user_id'));
}
