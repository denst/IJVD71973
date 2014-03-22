<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Conversion extends Controller_Admin {
    
    public function action_index()
    {
        $this->content = View::factory('conversion/index')
            ->set('conversions', Model::factory('conversion_info')->get_all_conversions());
    }
    
    public function action_info()
    {
        $id = $this->request->param('id');
        if(($сonversion = Model::factory('conversion_info')->get_info($id)))
        {
            $this->content = View::factory('conversion/info')
                ->set('conversion', $сonversion);
        }
        else
            $this->action_404();
    }
    
    public function action_delete()
    {
        if (Valid::not_empty($_POST)) 
        {
            if(Model::factory('conversion_info')->delete_conversion($_POST['conversion_id']))
            {
                $this->request->redirect('admin/conversion');
            }
        }
        else
            $this->action_404();
    }
    
    public function action_exportcsv() 
    {
        $this->response->headers(array('Content-Type' => 'text/csv', 'Cache-Control' => 'no-cache', 'charset'=>'windows-1251'));
        $this->response->body(iconv("UTF-8","WINDOWS-1251",
                html_entity_decode( Model::factory('conversion_info')
                        ->get_csv_content() ,ENT_COMPAT,'utf-8')));
        $this->response->send_file(TRUE, "conversion.csv");
        exit;
    }
}