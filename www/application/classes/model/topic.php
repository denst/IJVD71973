<?php

class Model_Topic extends ORM
{

    protected $_has_many = array(
        'video' => array(
            'model' => 'video',
            'through' => 'video_topics',
            'foreign_key' => 'topic_id',
            'far_key' => 'video_id'
        )
    );

}
