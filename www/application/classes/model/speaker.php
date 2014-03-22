<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Speaker extends ORM
{
    protected $_has_many = array(
        'videos' => array('model' => 'video', 'through' => 'speakers_video', 'foreign_key' => 'speaker_id', 'far_key' => 'video_id'),
    );
}
