<?php defined('SYSPATH') or die('No direct script access.');

class ORM extends Kohana_ORM
{
    public function get_relation_options_for_select2($relation, $key)
    {
        $list = ORM::factory($this->_has_many[$relation]['model'])->find_all()->as_array("id", $key);
        $data = array();
        foreach ($list as $k => $v) {
            $e = new stdClass();
            $e->id = $k;
            $e->text = $v;
            $data[] = $e;
        }
        return json_encode($data);
    }

    /**
     * For typeahead plugin
     * @param $relation
     * @param string $key
     * @return string
     */
    public function get_relation_value($relation, $key = 'title')
    {
        return implode(',', array_keys($this->{$relation}->find_all()->as_array("id", $key)));
//        return implode(", ", $this->{$relation}->find_all()->as_array("id", $key));
    }

    /**
     * For typeahead plugin
     * @param $relation
     * @param string $key
     * @return string
     */
    public function get_relation_options($relation, $key = 'title')
    {
        $items = ORM::factory($this->_has_many[$relation]['model'])->find_all();
        $items_array = '[';
        for ($i = 0; $i < $items->count(); $i++) {
            if ($i == $items->count() - 1) {
                $items_array .= '"' . $items[$i]->{$key} . '"';
            } else {
                $items_array .= '"' . $items[$i]->{$key} . '",';
            }
        }
        $items_array .= ']';
        return $items_array;
    }

    /**
     * $model->sync('tags', [1, 3, 2])
     * @param string $relation
     * @param array $values
     */
    public function sync($relation, $values)
    {
        if (!is_array($values)) {
            $values = explode(',', $values);
        }
        $values = array_filter($values);
        $this->remove($relation);
        foreach ($values as $id) {
            $this->add($relation, ORM::factory($this->_has_many[$relation]['model'], $id));
        }
    }

    /**
     * $model->syncFromString('tags', ['tag1', 'tag2'], 'title')
     * @param $relation
     * @param $items
     * @param string $key
     */
    public function sync_string($relation, $items, $key = 'title')
    {
        $items = explode(",", $items);

        $this->remove($relation);
        if (is_array($items)) {
            foreach ($items as $tag) {
                $tag = trim($tag);
                if (!$tag) {
                    continue;
                }
                $t = ORM::factory($this->_has_many[$relation]['model'])->where($key, '=', $tag)->find();
                if (!$t->loaded()) {
                    $t = ORM::factory($this->_has_many[$relation]['model']);
                    $t->{$key} = $tag;
                    $t->save();
                }
                $this->add($relation, $t);
            }
        }
    }
}
