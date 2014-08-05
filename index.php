<?php
define('DOMAIN','bismai.com');
ini_set('session.cookie_path', '/');
ini_set('session.cookie_domain', DOMAIN);
define('APP_DEBUG',False);
define('APP_NAME', 'iMicms');
define('CONF_PATH','./Data/conf/');
define('RUNTIME_PATH','./Data/logs/');
define('TMPL_PATH','./tpl/');
define('HTML_PATH','./Data/html/');
define('APP_PATH','./iMicms/');
define('CORE','./iMicms/_Core');
 
require(CORE.'/iMicms.php');
