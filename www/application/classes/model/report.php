<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Report extends ORM
{
    protected $_has_many = array(
        'tags' => array('model' => 'tags4hrclub', 'through' => 'hrclub_tags', 'foreign_key' => 'item_id', 'far_key' => 'tag_id'),
        'topics' => array('model' => 'topic', 'through' => 'reports_topics', 'foreign_key' => 'report_id', 'far_key' => 'topic_id'),
        'speakers' => array('model' => 'speaker', 'through' => 'speakers_reports', 'foreign_key' => 'report_id', 'far_key' => 'speaker_id'),
        'materials' => array('model' => 'material', 'through' => 'materials_reports', 'foreign_key' => 'report_id', 'far_key' => 'materials_id'),
        'videos' => array('model' => 'video', 'through' => 'reports_video', 'foreign_key' => 'report_id', 'far_key' => 'video_id'),
    );
}
