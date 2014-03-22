<?php defined('SYSPATH') or die('No direct script access.');
Route::set('formbuilder_assets', 'formbuilder/<dir>(/<file>)', array('file' => '.+', 'dir' => 
    '(css|js|images)'))
   ->defaults(array(
            'directory' => 'form',
            'controller' => 'assets',
            'action'     => 'media',
            'file'       => NULL,
            'dir'       => NULL,
    ));

Route::set('form_conversion', 'form/conversion(/<id>)')
	->defaults(array(
                'directory' => 'form',
                'controller' => 'conversion',
                'action'     => 'index',
	));

Route::set('check_captcha', 'form/checkrecaptcha')
	->defaults(array(
                'directory' => 'form',
                'controller' => 'conversion',
                'action'     => 'checkrecaptcha',
	));

Route::set('formbuilder', 'admin/formbuilder(/<action>(/<id>))')
	->defaults(array(
		'controller' => 'formbuilder',
		'action'     => 'index',
	));
Route::set('conversion', 'admin/conversion(/<action>(/<id>))')
	->defaults(array(
		'controller' => 'conversion',
		'action'     => 'index',
	));
