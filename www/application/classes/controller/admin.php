   <?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin extends Controller_Common {

    protected $view = "admin";

    public function before() {
        if (!Auth::instance()->logged_in('admin')) {
            $this->redirect('admin/login');
        }

        $count = ORM::factory('hruser')->count_all();

        $_controllers = array(
            "Страницы" => "pages",
            "Новости" => "news",
            'HR клуб' => 'hrusers',
            'Запросы' => 'requests',
            'Прочее' => array(
                "Клиенты" => "clients",
                "Настройки" => "options",
                'Ротатор баннеров' => 'bannersrotator',
                "Пользователи" => "users",
            ),
            'Конверсия' => array(
                "Формы конверсии" => "formbuilder",
                "Реестр конверсии" => "conversion",
            ),
			// "HR клуб" . ' <sup>'.$count.'</sup>' => "hrusers",
        );

        View::set_global("_controllers", $_controllers);
        View::set_global("_controller", $this->request->controller());
        View::set_global("_title", Kohana::$config->load("default.title"));
        View::set_global("_user", Auth::instance()->get_user());

        parent::before();
    }

}
