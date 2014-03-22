<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_New extends ORM {

    protected $_has_many = array(
        'tags' => array('model' => 'tag', 'through' => 'news_tags', 'foreign_key' => 'new_id', 'far_key' => 'tag_id'),
        'comments' => array('model' => 'comment', 'foreign_key' => 'new_id')
    );

    public function get_url() {
        return date('Y/m/d/', $this->created).str_replace(" ", "_", $this->to_translit(trim($this->title)));
    }
    
    public function save(Validation $validation = NULL) {
        $this->url = $this->get_url();
        
        parent::save($validation);
    }
    
    public function date_format() {
        if (!$this->created) {
            return "";
        }
        
        $ret = "";
        
        switch (date('m', $this->created)) {
            case "01":
                $ret = "января";
                break;
            case "02":
                $ret = "февраля";
                break;
            case "03":
                $ret = "марта";
                break;
            case "04":
                $ret = "апреля";
                break;
            case "05":
                $ret = "мая";
                break;
            case "06":
                $ret = "июня";
                break;
            case "07":
                $ret = "июля";
                break;
            case "08":
                $ret = "августа";
                break;
            case "09":
                $ret = "сентября";
                break;
            case "10":
                $ret = "октября";
                break;
            case "11":
                $ret = "ноября";
                break;
            case "12":
                $ret = "декабря";
                break;
        }
        
        return date("d {$ret} Y", $this->created);
    }

    function to_translit($st) {
        $table = array(
                    'А' => 'A',
                    'Б' => 'B',
                    'В' => 'V',
                    'Г' => 'G',
                    'Д' => 'D',
                    'Е' => 'E',
                    'Ё' => 'YO',
                    'Ж' => 'ZH',
                    'З' => 'Z',
                    'И' => 'I',
                    'Й' => 'J',
                    'К' => 'K',
                    'Л' => 'L',
                    'М' => 'M',
                    'Н' => 'N',
                    'О' => 'O',
                    'П' => 'P',
                    'Р' => 'R',
                    'С' => 'S',
                    'Т' => 'T',
                    'У' => 'U',
                    'Ф' => 'F',
                    'Х' => 'H',
                    'Ц' => 'C',
                    'Ч' => 'CH',
                    'Ш' => 'SH',
                    'Щ' => 'CSH',
                    'Ь' => '',
                    'Ы' => 'Y',
                    'Ъ' => '',
                    'Э' => 'E',
                    'Ю' => 'YU',
                    'Я' => 'YA',

                    'а' => 'a',
                    'б' => 'b',
                    'в' => 'v',
                    'г' => 'g',
                    'д' => 'd',
                    'е' => 'e',
                    'ё' => 'yo',
                    'ж' => 'zh',
                    'з' => 'z',
                    'и' => 'i',
                    'й' => 'j',
                    'к' => 'k',
                    'л' => 'l',
                    'м' => 'm',
                    'н' => 'n',
                    'о' => 'o',
                    'п' => 'p',
                    'р' => 'r',
                    'с' => 's',
                    'т' => 't',
                    'у' => 'u',
                    'ф' => 'f',
                    'х' => 'h',
                    'ц' => 'c',
                    'ч' => 'ch',
                    'ш' => 'sh',
                    'щ' => 'csh',
                    'ь' => '',
                    'ы' => 'y',
                    'ъ' => '',
                    'э' => 'e',
                    'ю' => 'yu',
                    'я' => 'ya',
        );

        $output = str_replace(
            array_keys($table),
            array_values($table),$st
        );

        return $output; 
  }
    
}
