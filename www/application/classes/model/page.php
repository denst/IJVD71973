<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Page extends ORM {
    public $_level;
    
    public function is_protected() {
        return !$this->url || $this->module != "";
    }
    
    public function save(Validation $validation = NULL) {
        if (isset($this->url)) {
            $this->url = trim($this->url, "/ ");
        }
        parent::save($validation);
    }
    
}
