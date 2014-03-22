<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Conversion_Info extends ORM
{
    protected $_table_name = 'conversion_info';
    
    protected $_belongs_to = array(
        'form' => array('model' => 'conversion_form', 'foreign_key' => 'form_id',)
    );
    
    private $main_values = array("fio", "phone", 'company', 'email', 
        'description', 'redirect', 'send', 'form_id', 'file_path');
    
    public function get_all_conversions()
    {
        return ORM::factory('conversion_info')->order_by('id', 'DESC')->find_all();
    }
    
    private $error_message = '';
    
    public function save_info($post)
    {
        try         
        {
            $data = array();
            $post = Arr::map('strip_tags', $post);
            
            foreach ($this->main_values as $value)
            {
                $this->check_main_fields($post, $data, $value);
            }
            
            $this->check_rest_fields($post, $data);
            $data['date'] = date('Y-m-d H:m:s');
            $info = ORM::factory('conversion_info')->values($data)->create();
            return $info;
        } 
        catch (ORM_Validation_Exception $ex)         
        {
            return false;
        }
    }
    
    public function get_info($id) 
    {
        if(Valid::numeric($id))
        {
            $conversion = ORM::factory('conversion_info', $id);
            if($conversion->loaded())
                return $conversion;
        }
        return false;
    }
    
    public function delete_conversion($id)
    {
        try         
        {
            ORM::factory('conversion_info', $id)->delete();
            return true;
        }
        catch (ORM_Validation_Exception $ex)         
        {
            return false;
        }
    }
    
    public function upload_file($send_file, $name_file_post)
    {
        $file = Validation::factory($send_file);

        $file->rule('file', 'Upload::valid')
                ->rule('file', 'Upload::type', array(':value', array(
                    'png', 'gif', 'jpg', 'rtf', 'odt', 'doc', 'docx',
                    'ppt', 'pptx', 'xls', 'xlsx', 'pdf')))
                ->rule('file', 'Upload::size', array(':value', '35M'));
        if ($file->check()) {
            $path = pathinfo($send_file[$name_file_post]['name']);
            $ext = strtolower($path['extension']);
            $filename = Upload::save($file[$name_file_post], microtime() . "." . $ext, 'temp');
            $name = $send_file[$name_file_post]['name'];
            $link = Kohana::$config->load('formbuilder.files_folder')."/" . basename($filename);
            return $link;
        }
        else
        {
            $this->check_errors($file->errors());
            return false;
        }
    }
    
    public function get_name_file_post($form_id)
    {
        $form = ORM::factory('conversion_form', $form_id);
        $fields = json_decode($form->info);
        foreach ($fields as $field)
        {
            list($tile, $element, $id) = $field;
            if($tile == 'File')
            {
                return $id;
            }
        }
        return false;
    }

    public function send_mails($conversion, $referrer)
    {
        if(Valid::not_empty($conversion->email))
        {
            $view = View::factory('conversion/email/user')
                    ->set("conversion", $conversion);
            FormBuilderEmail::send($conversion->email, Kohana::$config->load('formbuilder.admin_email'), 
                'axes.pro: '.$conversion->form->title, $view->render(), true);    
        }
        $view = View::factory('conversion/email/admin')
                ->set("conversion", $conversion)
                ->set("referrer", $referrer);
        $result = FormBuilderEmail::send(Kohana::$config->load('formbuilder.admin_email'), Kohana::$config->load('formbuilder.admin_email'), 
            'axes.pro: '.$conversion->form->title, $view->render(), true);    
    }
    
    public function get_csv_content()
    {
        $str = "Форма;Имя;ФамилияОтчество;Телефон;Компания;Email;Дата;Остальные поля\n";
        foreach ($this->get_all_conversions() as $info) {
            $str .= $info->form->title . ';' . $this->get_name_csv_format($info->fio) . ';' . 
                    $this->get_lastname_csv_format($info->fio) . ';' . 
                    $this->get_phone_csv_format($info->phone) . ';' .
                    $info->company . ';' .$info->email . ';' .$info->date . ';'. 
                    $this->get_csr_field_format($info->fields)."\n";
        }
        return $str;
    }

    public function get_error()
    {
        return $this->error_message;
    }

    private function check_errors($errors)
    {
        switch ($errors['file'][0]) 
        {
            case 'Upload::valid':
                $this->error_message = "Ошибка при загрузке файла";
                break;
            case 'Upload::type':
                $this->error_message = "Данный формат файлов не поддерживается";
                break;
            case 'Upload::size':
                $this->error_message = "Максимальный размер загружаемых файлов 15 мб";
                break;
        }
    }
    
    private function check_main_fields(&$post, &$data, $value)
    {
        if($value == "form_id" AND isset($post[$value]))
        {
            $data['form_title'] = ORM::factory('conversion_form', $post['form_id'])->title;
            $data[$value] = $post[$value];
            unset($post[$value]);
        }
        else if(isset($post[$value]))
        {
            $data[$value] = $post[$value];
            unset($post[$value]);
        }
        else
            $data[$value] = '';
    }
    
    private function check_rest_fields($post, &$data)
    {
        $result = array();
        $form = ORM::factory('conversion_form', $data['form_id']);
        $fields = json_decode($form->info);
        
        try 
        {
            foreach ($fields as $field)
            {
                list($tile, $element, $id) = $field;
                if(! in_array($id, $this->main_values) AND isset($post[$id]))
                {
                    $field[] = $post[$id];
                    $result[] = $field;
                }
            }
            $data['fields'] = json_encode($result);
            return true;
        } 
        catch (Exception $exc) 
        {
            return false;
        }
    }
    
    private function get_csr_field_format($fields)
    {
        $str = '';
        $fields = json_decode($fields);
        if(Valid::not_empty($fields))
        {
            foreach ($fields as $field)
            {
                list($title, $element, $id, $value) = $field;
                $str .= '('.$title . ': ';
                if(is_array($value))
                {
                    foreach ($value as $val)
                    {
                        $str .=  $val . ' ';
                    }
                    $str .=  ') ';
                }
                else
                      $str .=  $value . ') ';
            }
        }
        return $str;
    }
    
    private function get_phone_csv_format($phone)
    {
        $result = str_replace('+', "'+", $phone);
        $result = str_replace('(', '', $result);
        $result = str_replace(')', '', $result);
        $result = str_replace('-', '', $result);
        return $result;
    }
    
    private function get_name_csv_format($fio)
    {
        $reulst = explode(' ', $fio);
        return $reulst[1];
    }
    
    private function get_lastname_csv_format($fio)
    {
        $result = '';
        $fio = explode(' ', $fio);
        if(is_array($fio))
        {
            unset($fio[1]);
            foreach ($fio as $parts) {
                $result .= $parts. ' ';
            }
        }
        else
            $result = $fio;
        return $result;
    }
}