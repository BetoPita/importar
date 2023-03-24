<?php
defined('BASEPATH') OR exit('No direct script access allowed');
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

////////////////////////////////////////////////////////////////////////////////////////////////////
//Constantes para encriptados
define('CONST_ENCRYPT',778325.77);
//Correos
define('CONST_CORREO_SALIDA','fordplasencia@planificadorempresarial.mx');
define('CONST_PASS_CORREO','mCtTW79DFofWg6ap1');
define('CONST_AGENCIA','Ford Plasencia');

//Redes sociales 
define("CONST_FACEBOOK",'https://www.facebook.com/Xehos-Autolavado-112141223862934');
define("CONST_INSTAGRAM",'https://www.instagram.com/xehosautolavado/');
define("CONST_TWITTER",'https://twitter.com/xehosautolavado');

define("CONST_FACEBOOK_SOHEX",'https://www.facebook.com/SohexDms-104197548089939/');
define("CONST_TWITTER_SOHEX",'https://twitter.com/SohexDms?s=09');
define("CONST_INSTAGRAM_SOHEX",'https://www.instagram.com/sohex_dms/');
define("CONST_LINKEDIN_SOHEX",'https://www.linkedin.com/company/sohexdms');
define("CONST_WHATSAPP_SOHEX",'https://api.whatsapp.com/send?phone=+525535527547&text=¡Hola!%20Quiero%20chatear%20con%20SohexDms');
define("TITULO_APP",'Farmacias JBC');