<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Form_Conversion extends Controller_Common {
    
    public function action_index()
    {
        if (Valid::not_empty($_POST)) 
        {
            $model_conversion_info = Model::factory('conversion_info');
            $name_file_post = $model_conversion_info->get_name_file_post($_POST['form_id']);
            if($name_file_post AND empty($_FILES[$name_file_post]['error']))
            {
                if(! ($_POST['file_path'] = $model_conversion_info->upload_file($_FILES, $name_file_post)))
                {
                    Session::instance()->set('error', $model_conversion_info->get_error());
                    $this->request->redirect($this->request->referrer());
                }
            }
            
            if(
                    isset($_POST['enable_recaptcha']) && 
                    isset($_POST['recaptcha_challenge_field']) && 
                    isset($_POST['recaptcha_response_field']) && 
                    ! Recaptcha::check_captcha())
            {
                Session::instance()->set('error', "Невереный текст капчи.");
                $this->request->redirect($this->request->referrer());
            }
            
            if(($conversion = $model_conversion_info->save_info($_POST)))
            {
                if(Valid::not_empty(Session::instance()->get('total_show')))
                {
                    $total_show = Session::instance()->get('total_show');
                    $total_show = $total_show + 1;
                    Session::instance()->set('total_show', $total_show);
                }
                else
                    Session::instance()->set('total_show', 0);
                
//                $model_conversion_info->send_mails($conversion, $this->request->referrer());
                if(isset($_POST['redirect']) AND Valid::not_empty($_POST['redirect']))
                    $this->request->redirect($_POST['redirect']);
                else
                {
                    Session::instance()->set('success', 'Ваше сообщение успешно отправлено');
                    $this->request->redirect($this->request->referrer());
                }
            }
        }
        else
            $this->action_404();
    }
    
    public function action_checkrecaptcha()
    {
        if($this->request->is_ajax())
        {
            $result = array('success' => true, 'show_recaptcha' => false);
            if(Valid::not_empty(Session::instance()->get('total_show')))
            {
                if(Session::instance()->get('total_show') >= 2)
                    $result['show_recaptcha'] = true;
            }
            
            echo json_encode($result);
        }
        else
            echo false;
        exit();
    }
}