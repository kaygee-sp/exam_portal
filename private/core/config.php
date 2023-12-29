<?php 

/*set your website title*/

define('WEBSITE_TITLE', "My Website");

/*set database variables*/

define('DB_TYPE','mysql');
define('DB_NAME','ict3715_online_exam_submission');
define('DB_USER','root');
define('DB_PASSWORD','');
define('DB_HOST','localhost');

/*protocal type http or https*/
define('PROTOCOL','http');

/*root and asset paths*/

$path = str_replace("\\", "/",PROTOCOL ."://" . $_SERVER['SERVER_NAME'] . __DIR__  . "/");
$path = str_replace($_SERVER['DOCUMENT_ROOT'], "", $path);

define('REDIRECT', str_replace("private/core", "public/views", $path));
define('ROOT', str_replace("private/core", "public", $path));
define('ASSETS', str_replace("private/core", "public/assets", $path));

/*set to true to allow error reporting
set to false when you upload online to stop error reporting*/

define('DEBUG',true);

if(DEBUG)
{
	ini_set("display_errors",1);
}else{
	ini_set("display_errors",0);
}