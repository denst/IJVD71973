<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Formbuilder extends Controller_Admin {
 
    public function action_index()
    {
        $this->content = View::factory('formbuilder/index')
            ->set('forms', Model::factory('conversion_form')->get_all_forms());
    }
    
    public function action_create()
    {
        $this->content = View::factory('formbuilder/create');
    }
    
    public function action_add()
    {
        if (Valid::not_empty($_POST)) 
        {
            if(($form = Model::factory('conversion_form')->create_form($_POST)))
            {
                $this->request->redirect('admin/formbuilder/info/'.$form->id);
            }
        }
    }
    
    public function action_save() 
    {
        if (Valid::not_empty($_POST)) 
        {
            if(Model::factory('conversion_form')->save_changes($_POST))
            {
                $this->request->redirect('admin/formbuilder');
            }
        }
        else
            $this->action_404();
    }

    public function action_delete()
    {
        if (Valid::not_empty($_POST)) 
        {
            if(Model::factory('conversion_form')->delete_form($_POST['form_id']))
            {
                $this->request->redirect('admin/formbuilder');
            }
        }
        else
            $this->action_404();
    }
    
    public function action_info()
    {
        $id = $this->request->param('id');
        if(($form = Model::factory('conversion_form')->get_form($id)))
        {
            $this->content = View::factory('formbuilder/info')
                ->set('form', $form);
        }
        else
            $this->action_404();
    }
    
    public function action_view()
    {
        $id = $this->request->param('id');
        if(($form = Model::factory('conversion_form')->get_form($id)))
        {
            $this->content = View::factory('formbuilder/view')
                ->set('form', $form);
        }
        else
            $this->action_404();
    }
    
    public function action_test() 
    {
        $dir = 'js';
        $file = "main-built";
        $ext = "js";
        $file = Kohana::find_file('assets', $dir . '/' . $file, $ext);
        $body = file_get_contents($file);
//        $file_content = file_get_contents($path.$finded_file);
        var_dump($body);
    }
}
