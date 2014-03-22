<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Tree {
    
    protected $data;
    protected $all;
    
    protected static $instances = array();

    public static function instance($type) {
        if (!isset(Model_Tree::$instances[$type])) {
            Model_Tree::$instances[$type] = new Model_Tree($type);
        }
        return Model_Tree::$instances[$type];
    }
	
    public function __construct($type) {
        $data = array();
        $all = array();
        $elements = ORM::factory($type)->order_by('parent_id', 'asc')->order_by('title', 'asc')->find_all();
        foreach ($elements as $element) {
            $data[$element->parent_id][] = $element;
            $all[$element->id] = $element;
        }
        $this->data = $data;
        $this->all = $all;
    }

    public function get_all($root = 0) {
        return $this->get_tree($root);
    }

    public function get_tree($root = 0, $level = 0) {
        $arr = array();
        if (isset($this->data[$root])) {
            if ($root && !$level) {
                $element = $this->all[$root];
                $element->_level = $level++;
                $arr[] = $element;
            }
            foreach ($this->data[$root] as $element) {
                $element->_level = $level;
                $arr[] = $element;
                $arr = array_merge($arr, $this->get_tree($element->id, $level+1));
            }
        }
        return $arr;
    }
    
    public function html_select_all($root = 0, $selected = 0) {
        $arr = $protected = array();

        if ($selected) {
            foreach($this->get_all($selected) as $child) {
                $protected[] = $child->id;
            }
            $protected[] = $selected;
        }

        if ($root) {
            $arr[] = $this->all[$root];
        }
        
        foreach ($this->get_all($root) as $element) {
            if (!in_array($element->id, $protected)) {
                $arr[] = $element;
            }
        }
        return $arr;
    }
    
    public function html_select_all_2($roots = array(), $selected = 0) {
        $arr = array();
        foreach ($roots as $root) {
            $arr = array_merge($arr, $this->html_select_all($root, $selected));
        }
        return $arr;
    }


}
