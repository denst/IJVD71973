<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Common_Hrclub extends Controller_Common {   

    public function action_registration(){
        $errors = array();
        $msg = "";
        if (count($_POST)) {
            try
            {
                $invite_user = ORM::factory('hruser');
                $_POST['firstname']=($_POST['firstname']!='Имя')?$_POST['firstname']:'';
                $_POST['lastname']=($_POST['lastname']!='Фамилия')?$_POST['lastname']:'';
                $_POST['company']=($_POST['company']!='Компания')?$_POST['company']:'';
                $_POST['email']=($_POST['email']!='E-mail')?$_POST['email']:'';
                $_POST['telephone']=($_POST['telephone']!='Телефон')?$_POST['telephone']:'';
                $invite_user->values($_POST);
                $invite_user->save();

                $msg_client = "Спасибо Вам за регистрацию на HR Клуб. Мы обязательно свяжемся с Вами накануне мероприятия для подтверждения Вашего участия.
Команда AXES Pro";

                try {
                    $config = Kohana::$config->load('email');
                    Email::connect($config);
                    Email::send($invite_user->email, Kohana::$config->load('email.options.username'), "HR Клуб AXES Pro - Заявка на клуб", $msg_client, false);
                    $HRview = View::factory('email/HRcontacts')->set("post", $_POST);
                    Email::send(Kohana::$config->load('default.form_email'), Kohana::$config->load('email.options.username'), "hrclub-axes: форма заявки в HRклуб", $HRview->render(), true);
                    View::set_global("_message", "Спасибо Вам за регистрацию для посещения HR Клуба.  Мы обязательно свяжемся с Вами накануне мероприятия для подтверждения Вашего участия.");
                    
                    $msg = "Спасибо Вам за регистрацию для посещения HR Клуба. Мы обязательно свяжемся с Вами накануне мероприятия для подтверждения Вашего участия.
Команда AXES Pro";
					Message::set(Message::SUCCESS, $msg);
					$_POST = array();
                    //TO DO сказать, что ура мы рассмотрим вашу заявку (мы послали письмо вам на мыло)
                    //$this->redirect('hrclub');
                } catch (Exception $e) {                        
                        $errors['e_send'] = "Ошибка отправки письма";
                }
            }
            catch(ORM_Validation_Exception $e)
            {
                $errors = $e->errors('hrusers');
                unset($errors['_external']);
            }
        }
        $this->content = View::factory('common/hrclub/registration')->set("errors", $errors)->set("success_msg",$msg);
    }  
   
}
