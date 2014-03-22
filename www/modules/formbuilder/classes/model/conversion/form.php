<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Conversion_Form extends ORM
{
    protected $_table_name = 'conversion_forms';
    
    public function create_form($post)
    {
        try         
        {
            $post['clean_body'] = $post['body'];
            $post['body'] = htmlspecialchars($post['body']);
            $form = ORM::factory('conversion_form')->values($post)->create();
            return $form;
        } 
        catch (ORM_Validation_Exception $ex)         
        {
            return false;
        }
    }
    
    public function save_changes($post)
    {
        try         
        {
            ORM::factory('conversion_form', $post['form_id'])
                ->set('body', htmlspecialchars($post['body']))
                ->update();
            return true;
        }
        catch (ORM_Validation_Exception $ex)         
        {
            return false;
        }
    }

    public function delete_form($id)
    {
        try         
        {
            ORM::factory('conversion_form', $id)->delete();
            return true;
        }
        catch (ORM_Validation_Exception $ex)         
        {
            return false;
        }
    }

    public function get_all_forms()
    {
        return ORM::factory('conversion_form')->order_by('id', 'DESC')->find_all();
    }
    
    public function get_form($id) 
    {
        if(Valid::numeric($id))
        {
            $form = ORM::factory('conversion_form', $id);
            if($form->loaded())
                return $form;
        }
        return false;
    }
}