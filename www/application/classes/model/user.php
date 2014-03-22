<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_User extends Model_Auth_User {
    
    public function rules()
    {
        return parent::rules() + array(
            'firstname' => array(
                array('not_empty')
            ),
            'lastname' => array(
                array('not_empty')
            )
        );
    }

} 