<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Material extends ORM
{
    protected $_has_many = array(
        'tags' => array('model' => 'tags4hrclub', 'through' => 'hrclub_tags', 'foreign_key' => 'item_id', 'far_key' => 'tag_id'),
        'topics' => array('model' => 'topic', 'through' => 'material_topics', 'foreign_key' => 'material_id', 'far_key' => 'topic_id'),
        'speakers' => array('model' => 'speaker', 'through' => 'speakers_material', 'foreign_key' => 'material_id', 'far_key' => 'speaker_id'),
    );
    public function delete()
    {
        if ($this->path) {
            unlink('files/materials/' . $this->path);
        }
        return parent::delete();
    }
}
