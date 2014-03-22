<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Hruser extends ORM {

    public function rules()
    {
        return array(
            'firstname' => array(
                array('not_empty'),
                array('max_length', array(':value', 32)),
                array('min_length', array(':value', 3)),
            ),
            'lastname' => array(
                array('not_empty'),
                array('max_length', array(':value', 32)),
                array('min_length', array(':value', 3)),
            ),
            'company' => array(
                array('not_empty'),
            ),
            'post' => array(
                array('not_empty'),
                array('max_length', array(':value', 32)),
                array('min_length', array(':value', 3)),
            ),
            'email' => array(
                array('not_empty'),
                array('email'),
                array(array($this, 'unique'), array('email', ':value')),
            ),
            'telephone'=> array(
                array('not_empty'),
                array('phone',array(':value',array(7,10,11,12))),
            ),
        );
    }

}