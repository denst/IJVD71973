<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Video extends ORM
{
    protected $_table_name = 'video';
    protected $_has_many = array(
        'tags' => array('model' => 'tags4hrclub', 'through' => 'hrclub_tags', 'foreign_key' => 'item_id', 'far_key' => 'tag_id'),
        'topics' => array('model' => 'topic', 'through' => 'video_topics', 'foreign_key' => 'video_id', 'far_key' => 'topic_id'),
        'speakers' => array('model' => 'speaker', 'through' => 'speakers_video', 'foreign_key' => 'video_id', 'far_key' => 'speaker_id'),
        'materials' => array('model' => 'material', 'through' => 'materials_video', 'foreign_key' => 'video_id', 'far_key' => 'materials_id'),
    );
}
