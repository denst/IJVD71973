<?php defined('SYSPATH') or die('No direct script access.');

return array (
	'default' => array (
        'type'       => 'mysql',
        'connection' => array (
            'hostname'   => IN_PRODUCTION ? 'pdb9.awardspace.net' : 'pdb9.awardspace.net',
            'username'   => IN_PRODUCTION ? '1021014_axes' : '1021014_axes',
            'password'   => IN_PRODUCTION ? 'coph2eantin' : 'coph2eantin',
            'persistent' => FALSE,
            'database'   => IN_PRODUCTION ? '1021014_axes' : '1021014_axes',
        ),
        'table_prefix' => '',
        'charset'      => 'utf8',
        'caching'      => FALSE,
        'profiling'    => TRUE,
    )
);
