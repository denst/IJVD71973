<?php defined('SYSPATH') or die('No direct script access.');

// -- Environment setup --------------------------------------------------------

// Load the core Kohana class
require SYSPATH.'classes/kohana/core'.EXT;

if (is_file(APPPATH.'classes/kohana'.EXT))
{
	// Application extends the core
	require APPPATH.'classes/kohana'.EXT;
}
else
{
	// Load empty core extension
	require SYSPATH.'classes/kohana'.EXT;
}

/**
 * Set the default time zone.
 *
 * @see  http://kohanaframework.org/guide/using.configuration
 * @see  http://php.net/timezones
 */
date_default_timezone_set('Europe/Moscow');

/**
 * Set the default locale.
 *
 * @see  http://kohanaframework.org/guide/using.configuration
 * @see  http://php.net/setlocale
 */
setlocale(LC_ALL, 'ru_RU.utf-8');

/**
 * Enable the Kohana auto-loader.
 *
 * @see  http://kohanaframework.org/guide/using.autoloading
 * @see  http://php.net/spl_autoload_register
 */
spl_autoload_register(array('Kohana', 'auto_load'));

/**
 * Enable the Kohana auto-loader for unserialization.
 *
 * @see  http://php.net/spl_autoload_call
 * @see  http://php.net/manual/var.configuration.php#unserialize-callback-func
 */
ini_set('unserialize_callback_func', 'spl_autoload_call');

// -- Configuration and initialization -----------------------------------------

/**
 * Set the default language
 */
I18n::lang('ru-ru');

/**
 * Set Kohana::$environment if a 'KOHANA_ENV' environment variable has been supplied.
 *
 * Note: If you supply an invalid environment name, a PHP warning will be thrown
 * saying "Couldn't find constant Kohana::<INVALID_ENV_NAME>"
 */
if (isset($_SERVER['KOHANA_ENV']))
{
	Kohana::$environment = constant('Kohana::'.strtoupper($_SERVER['KOHANA_ENV']));
}

/**
 * Set the production status
 */
define("IN_PRODUCTION", false);

/**
 * Initialize Kohana, setting the default options.
 *
 * The following options are available:
 *
 * - string   base_url    path, and optionally domain, of your application   NULL
 * - string   index_file  name of your index file, usually "index.php"       index.php
 * - string   charset     internal character set used for input and output   utf-8
 * - string   cache_dir   set the internal cache directory                   APPPATH/cache
 * - boolean  errors      enable or disable error handling                   TRUE
 * - boolean  profile     enable or disable internal profiling               TRUE
 * - boolean  caching     enable or disable internal caching                 FALSE
 */
Kohana::init(array(
//        'base_url' => IN_PRODUCTION ? 'http://axes.pro/' : 'http://axes.tadzhibaev.com/',
        'base_url' => '/',
        'index_file' => FALSE,
        'errors' => !IN_PRODUCTION,
        'profile' => !IN_PRODUCTION,
        'caching' => IN_PRODUCTION
    ));

/**
 * Attach the file write to logging. Multiple writers are supported.
 */
Kohana::$log->attach(new Log_File(APPPATH.'logs'));

/**
 * Attach a file reader to config. Multiple readers are supported.
 */
Kohana::$config->attach(new Config_File);

/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 */
Kohana::modules(array(
	'auth'       => MODPATH.'auth',       // Basic authentication
        'profilertoolbar' => MODPATH.'profilertoolbar',
	// 'cache'      => MODPATH.'cache',      // Caching with multiple backends
	// 'codebench'  => MODPATH.'codebench',  // Benchmarking tool
	'database'   => MODPATH.'database',   // Database access
	'image'      => MODPATH.'image',      // Image manipulation
	'orm'        => MODPATH.'orm',        // Object Relationship Mapping
	// 'unittest'   => MODPATH.'unittest',   // Unit testing
	// 'userguide'  => MODPATH.'userguide',  // User guide and API documentation
	'message'    => MODPATH.'message',
	'email'      => MODPATH.'email',
	'pagination' => MODPATH.'pagination',
	'captcha'    => MODPATH.'captcha',
	'tkoauth'    => MODPATH.'tkoauth',
	'phpexcel'	 => MODPATH.'phpexcel',
	'mpdf'	 	 => MODPATH.'mpdf',
	'formbuilder'	 	 => MODPATH.'formbuilder',
	'recaptcha'  => MODPATH.'recaptcha',
	));
$session = Session::instance();
/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */
if (strpos($_SERVER['REQUEST_URI'], "/index.php/") !== false) {

    // 404 error page
    Route::set('404', '(<url>)', array('url' => '.*'))
            ->defaults(array(
                'controller' => 'common',
                'action' => '404',
            ));

} else {

    // index
    Route::set('index', '')
            ->defaults(array(
                'directory' => 'common',
                'controller' => 'index',
                'action' => 'index',
                'page' => ''
            ));

    // private
    Route::set('private', 'private(/<action>)', array('action' => '[A-Za-z]+'))
            ->defaults(array(
                'directory' => 'common',
                'controller' => 'private',
                'action' => 'index',
                'page' => 'private'
            ));

    // private
    Route::set('oauth', 'oauth(/<action>)', array('action' => '[A-Za-z]+'))
            ->defaults(array(
                'controller' => 'oauth',
                'action' => 'index',
                'page' => 'oauth'
            ));

    // news
    Route::set('news-tags', 'news/tags(/page-<p>)/<id>', array('id' => '.*', "p"=>"[0-9]+"))
            ->defaults(array(
                'directory' => 'common',
                'controller' => 'news',
                'action' => 'tags',
                'page' => 'news'
            ));

    // news
    Route::set('news-categories', 'news/categories(/page-<p>)/<id>', array('id' => '.*', "p"=>"[0-9]+"))
            ->defaults(array(
                'directory' => 'common',
                'controller' => 'news',
                'action' => 'categories',
                'page' => 'news'
            ));

    // news
    Route::set('news', 'news(/page-<p>)', array("p"=>"[0-9]+"))
            ->defaults(array(
                'directory' => 'common',
                'controller' => 'news',
                'action' => 'index',
                'page' => 'news'
            ));

	Route::set('hrclubregistration', 'hrclub/summer/reg')
        ->defaults(array(
        'directory' => 'common',
        'controller' => 'hrclub',
        'action' => 'registration',
        'id' => 0,
        'page' => 'hrclub'
    ));

    // news
    Route::set('news-id', 'news(/<action>)(/<id>)', array('id' => '[0-9]+', "action"=>"index|comment|commentdelete"))
            ->defaults(array(
                'directory' => 'common',
                'controller' => 'news',
                'action' => 'index',
                'id' => 0,
                'page' => 'news'
            ));

    // news-cpu
    Route::set('news-cpu', 'news/<url>', array('url' => '.*'))
            ->defaults(array(
                'directory' => 'common',
                'controller' => 'news',
                'action' => 'view',
                'url' => '',
                'page' => 'news'
            ));

    // news-rss
    Route::set('news-rss', 'news.rss')
            ->defaults(array(
                'directory' => 'common',
                'controller' => 'news',
                'action' => 'rss',
                'page' => 'news'
            ));

    // clients
    Route::set('clients', 'clients(/<id>)', array('id' => '[0-9]+'))
            ->defaults(array(
                'directory' => 'common',
                'controller' => 'clients',
                'action' => 'index',
                'page' => 'clients',
                'id' => 0
            ));

    // contacts
    Route::set('contacts', 'contacts')
            ->defaults(array(
                'directory' => 'common',
                'controller' => 'contacts',
                'action' => 'index',
                'page' => 'contacts'
            ));

    // feedback
    Route::set('feedback', 'feedback')
            ->defaults(array(
                'directory' => 'common',
                'controller' => 'feedback',
                'action' => 'index',
                'page' => 'feedback'
            ));

    // request
    Route::set('request', 'request')
            ->defaults(array(
                'directory' => 'common',
                'controller' => 'request',
                'action' => 'index',
                'page' => 'request'
            ));

    // calc
    Route::set('calc', 'etweb-calc')
            ->defaults(array(
                'directory' => 'common',
                'controller' => 'calc',
                'action' => 'index',
                'page' => 'etweb-calc'
            ));

    Route::set('ajax', 'ajax(/<action>(/<id>))', array('action' => '[A-Za-z]+'))
            ->defaults(array(
                'controller' => 'ajax',
                'action' => 'index'
            ));

    // admin-auth 1
    Route::set('admin-auth', 'admin/<action>', array("action" => "logout|login"))
            ->defaults(array(
                'directory' => 'admin',
                'controller' => 'auth',
                'action' => 'login',
                'page' => 'admin'
            ));

    // admin
    Route::set('admin', 'admin(/<controller>(/<action>(/<id>)))', array('action' => '[A-Za-z]+', 'id' => '[0-9]+', 'controller' => '[A-Za-z]+'))
            ->defaults(array(
                'directory' => 'admin',
                'controller' => 'index',
                'action' => 'index',
                'id' => 0,
                'page' => 'admin'
            ));

    // static
    Route::set('static', '(<page>)', array('page' => '.*'))
            ->defaults(array(
                'directory' => 'common',
                'controller' => 'static',
                'action' => 'index',
            ));

}
