<?php

class Model_Tag extends ORM {

    protected $_has_many = array('news' => array('model' => 'new', 'through' => 'news_tags', 'foreign_key' => 'tag_id', 'far_key' => 'new_id'));

    public static function getRandom() {
        $rand = rand(0, 500);
        return DB::query(Database::SELECT, '    SELECT tags.*, COUNT(news_tags.tag_id) as news_count
                                                FROM tags
                                                LEFT JOIN news_tags ON (news_tags.tag_id = tags.id)
                                                WHERE tags.`enabled` = 1
                                                GROUP BY news_tags.tag_id
                                                HAVING COUNT(news_tags.tag_id) > 0
                                                ORDER BY MD5(CONCAT(tags.id, :rand))    ')
                ->param(':rand', $rand)
                ->execute();
    }

}
