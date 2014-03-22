<?php

defined('SYSPATH') or die('No direct script access.');

class Helper_Editor {

    static function get($name, $value = "") {
        include '3rdparty/ckeditor/ckeditor.php';
        $ckeditor = new CKEditor();
        $ckeditor->basePath = URL::site("3rdparty/ckeditor") . "/";

        $ckeditor->config['filebrowserBrowseUrl'] = URL::site("3rdparty/kcfinder/browse.php?type=files");
        $ckeditor->config['filebrowserImageBrowseUrl'] = URL::site("3rdparty/kcfinder/browse.php?type=images");
        $ckeditor->config['filebrowserFlashBrowseUrl'] = URL::site("3rdparty/kcfinder/browse.php?type=flash");
        $ckeditor->config['filebrowserUploadUrl'] = URL::site("3rdparty/kcfinder/upload.php?type=files");
        $ckeditor->config['filebrowserImageUploadUrl'] = URL::site("3rdparty/kcfinder/upload.php?type=images");
        $ckeditor->config['filebrowserFlashUploadUrl'] = URL::site("3rdparty/kcfinder/upload.php?type=flash");
        
        //$ckeditor->config['skin'] = 'office2003';

        ob_start();
        $ckeditor->editor($name, $value);
        $str = ob_get_contents();
        ob_end_clean();
        return $str;
    }

}