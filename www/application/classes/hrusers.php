
<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Hrusers extends Controller_Admin {

    public function action_index() {
        $hrusers = ORM::factory('hruser')->find_all();
        $this->content = View::factory('admin/hrusers/index')->bind("hrusers", $hrusers);
    }

    public function action_exportcsv() {
        $str = "Фамилия;Имя;Компания;Должность;Email;Телефон\n";
        foreach (ORM::factory('hruser')->find_all() as $hruser) {
            $str .= $hruser->lastname . ';' . $hruser->firstname . ';' . $hruser->company . ';' . $hruser->post . ';' . $hruser->email . ';' . $hruser->telephone . "\n";
        }
        $str= iconv("UTF-8","WINDOWS-1251",html_entity_decode( $str ,ENT_COMPAT,'utf-8'));
        $this->response->headers(array('Content-Type' => 'text/csv', 'Cache-Control' => 'no-cache', 'charset'=>'windows-1251'));
        $this->response->body($str);
        $this->response->send_file(TRUE, "hrusers.csv");
        exit;
    }

    public function action_exportvcard() {
        $str = "";
        foreach (ORM::factory('hruser')->find_all() as $hruser) {
            $str .= <<<EOD
BEGIN:VCARD
VERSION:3.0
FN;CHARSET=utf-8:{$hruser->firstname} {$hruser->lastname}
N;CHARSET=utf-8:{$hruser->lastname};{$hruser->firstname}
ORG;CHARSET=utf-8:{$hruser->company}
TITLE;CHARSET=utf-8:{$hruser->post}
EMAIL;TYPE=INTERNET;CHARSET=utf-8:{$hruser->email}
TEL;TYPE=WORK;CHARSET=utf-8:{$hruser->telephone}
END:VCARD
EOD;
            $str .= "\n\n";
        }
        $this->response->headers(array('Content-Type' => 'text/x-vcard', 'charset' => 'utf-8', 'Cache-Control' => 'no-cache'));
        $this->response->body($str);
        $this->response->send_file(TRUE, "hrusers.vcf");
        exit;
    }

    public function  action_exportexcel(){
        $ws = new Spreadsheet(array(
            'author'    => 'Kohana-PHPExcel',
            'title'    => 'hrusers',
            'subject'    => 'Subject',
            'description' => 'Description',
        ));

        $ws->set_active_sheet(0);
        $as = $ws->get_active_sheet();
        $as->setTitle('hrusers');

        $as->getDefaultStyle()->getFont()->setSize(12);

        $as->getColumnDimension('A')->setWidth(16);
        $as->getColumnDimension('B')->setWidth(20);
        $as->getColumnDimension('C')->setWidth(16);
        $as->getColumnDimension('D')->setWidth(20);
        $as->getColumnDimension('E')->setWidth(30);
        $as->getColumnDimension('F')->setWidth(30);

        $sh = array(
            0 => array(),
            1 => array('Фамилия','Имя','Компания','Должность','Email','Телефон'),
        );

        foreach (ORM::factory('hruser')->find_all() as $hruser) {
           $sh_dop = array(array($hruser->lastname, $hruser->firstname, $hruser->company, $hruser->post, $hruser->email, $hruser->telephone));
           $sh = array_merge((array)$sh,(array)$sh_dop);
        }
        $i = count($sh)-1;
        $generalStyleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                )
            ),
        );

        $headstyle = array(
                'font'    => array(
                    'bold'      => true
                ),
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_DOUBLE,
                ),
            );

        $as->getStyle('A1:F'.$i)->applyFromArray($generalStyleArray);
        $as->getStyle('A1:F1')->applyFromArray($headstyle);
        $ws->set_data($sh, false);
        $ws->send(array('name'=>'hrusers', 'format'=>'Excel5'));
    }

	public function action_exporttoword(){
        $str='<page><div style="width:760px;">';
        $count=0;
        foreach (ORM::factory('hruser')->find_all() as $hruser) {
            $count++;
            $align='left';
            if ($count%2==0)
                $align='left';
			if (($count%4==1) && ($count!=1))
                $str .='</div>';
			if ($count%4==1)
                $str .='<div style="height:1130">';
            if (($count%8==1)&&($count!=1))
                $str .='<div style="border:0px solid #ccc;height: 0px;margin-top: 0px;"></div>';
            $str .= '<div style="width:355px; border: 1px solid #000000;float:'.$align.';margin-top: 20px; border:1px solid #ccc;">
			<div style="color: #000000; font-size: 34px; font-weight: bold; text-align: center; margin-top: 21px;font-family:Calibri;">'.$hruser->firstname.'</div>
			<div style="color: #CB9B2B; font-size: 21px; font-weight: bold; text-align: center;font-family:Calibri;margin-top: -8px;">'.$hruser->lastname.'</div>
			<div style="color: #000000; font-size: 24px; font-weight: bold; text-align: center;font-family:Calibri;">'.$hruser->company.'</div><br>
			<center><img style="margin-bottom: 5px; margin-left: 10px; width: 360px;" src="http://axes.pro/assets/images/hrclub/ba1bottom.png"></center>
		</div>';

        }
        $str.='</div></div></page>';
        $config_pdf = array(
            'author'    => 'Kohana-PHPExcel',
            'title'    => 'hrusers',
            'subject'    => 'Subject',
            'name'     => 'HRClubUsers.pdf',
        );
        // загрузка представления с использованием PDF расширения
        $pdf = View_MPDF::factory(null,$config_pdf)->render($str);
    }

    public function action_edit() {
        $id = $this->request->param('id');
        $invite_user = ORM::factory('hruser',$id);
        if ($invite_user->loaded()){
            $errors = array();
            if (count($_POST)) {
                try
                {
                    $_POST['firstname']=($_POST['firstname']!='Имя')?$_POST['firstname']:'';
                    $_POST['lastname']=($_POST['lastname']!='Фамилия')?$_POST['lastname']:'';
                    $_POST['company']=($_POST['company']!='Компания')?$_POST['company']:'';
                    $_POST['email']=($_POST['email']!='E-mail')?$_POST['email']:'';
                    $_POST['telephone']=($_POST['telephone']!='Телефон')?$_POST['telephone']:'';
                    $invite_user->values($_POST);
                    $invite_user->save();
                    $this->redirect('admin/hrusers');
                }
                catch(ORM_Validation_Exception $e)
                {
                    $errors = $e->errors('hrusers');
                    unset($errors['_external']);
                }
            }
            $this->content = View::factory('admin/hrusers/edituser')->set("errors", $errors)->set("post",$invite_user->as_array())->set("page",'ред');
        }
    }

    public function action_delete() {
        $id = $this->request->param('id');
        $hruser = ORM::factory('hruser', $id);
        if ($hruser->loaded()) {
            $hruser->delete();
        }
        $this->request->redirect('admin/hrusers');
    }

    public function action_add() {
        $errors = array();
        if (count($_POST)) {
            // try
            // {
                $invite_user = ORM::factory('hruser');
                $this->saveModel($invite_user, 'admin/hrusers', 'hrusers');
                // $_POST['firstname']=($_POST['firstname']!='Имя')?$_POST['firstname']:'';
                // $_POST['lastname']=($_POST['lastname']!='Фамилия')?$_POST['lastname']:'';
                // $_POST['company']=($_POST['company']!='Компания')?$_POST['company']:'';
                // $_POST['email']=($_POST['email']!='E-mail')?$_POST['email']:'';
                // $_POST['telephone']=($_POST['telephone']!='Телефон')?$_POST['telephone']:'';
                // $invite_user->values($_POST);
                // $invite_user->save();
                // $this->redirect('admin/hrusers');
            // }
            // catch(ORM_Validation_Exception $e)
            // {
            //     $errors = $e->errors('hrusers');
            //     unset($errors['_external']);
            // }
        }
        $this->content = View::factory('admin/hrusers/edituser')->set("errors", $errors);
    }

}