<?php defined('SYSPATH') or die('No direct script access.'); ?>

2014-01-28 13:10:02 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected 'public' (T_PUBLIC) ~ APPPATH/classes/controller/common.php [ 109 ]
2014-01-28 13:10:02 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected 'public' (T_PUBLIC) ~ APPPATH/classes/controller/common.php [ 109 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2014-01-28 13:10:13 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected 'public' (T_PUBLIC) ~ APPPATH/classes/controller/common.php [ 109 ]
2014-01-28 13:10:13 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected 'public' (T_PUBLIC) ~ APPPATH/classes/controller/common.php [ 109 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2014-01-28 18:55:28 --- ERROR: ErrorException [ 1 ]: Call to a member function getMessage() on a non-object ~ APPPATH/classes/controller/common.php [ 73 ]
2014-01-28 18:55:28 --- STRACE: ErrorException [ 1 ]: Call to a member function getMessage() on a non-object ~ APPPATH/classes/controller/common.php [ 73 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2014-01-28 20:43:48 --- ERROR: Kohana_Exception [ 0 ]: No encryption key is defined in the encryption configuration group: default ~ SYSPATH/classes/kohana/encrypt.php [ 68 ]
2014-01-28 20:43:48 --- STRACE: Kohana_Exception [ 0 ]: No encryption key is defined in the encryption configuration group: default ~ SYSPATH/classes/kohana/encrypt.php [ 68 ]
--
#0 /home/denst/www/tadzhibaev/www/application/classes/controller/common.php(16): Kohana_Encrypt::instance()
#1 [internal function]: Controller_Common->before()
#2 /home/denst/www/tadzhibaev/www/system/classes/kohana/request/client/internal.php(103): ReflectionMethod->invoke(Object(Controller_Common_Static))
#3 /home/denst/www/tadzhibaev/www/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 /home/denst/www/tadzhibaev/www/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#5 /home/denst/www/tadzhibaev/www/index.php(109): Kohana_Request->execute()
#6 {main}