<?php defined('SYSPATH') or die('No direct access allowed.');

class Formbuilder
{
    static function message_render()
    {
        $result = '';
        if(Session::instance()->get('error')){
            $error = Session::instance()->get_once('error');
            $result = $result. 
            "<div id='msgbox' class='box-error'>$error</div>".
            "<script>".
            "   $('#msgbox').show().delay(5000).fadeOut();".
            "</script>";
        }
        elseif(Session::instance()->get('success')){
            $success = Session::instance()->get_once('success');
            $result = $result. 
            "<div id='msgbox' class='box-information'>$success</div>".
            "<script>".
            "   $('#msgbox').show().delay(5000).fadeOut();".
            "</script>";
        }
        return $result;
    }
}
