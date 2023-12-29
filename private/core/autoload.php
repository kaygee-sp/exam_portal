<?php

#use PHPMailer\PHPMailer\PHPMailer;
#use PHPMailer\PHPMailer\Exception;

require "../private/core/config.php";
require "../private/core/functions.php";
require "../private/core/db.php";
require "../private/core/controller.php";
require "../private/core/model.php";
require "../private/core/app.php";
require '../private/core/PHPMailer/src/Exception.php';
require '../private/core/PHPMailer/src/PHPMailer.php';
require '../private/core/PHPMailer/src/SMTP.php';

spl_autoload_register(function($class_name){
	require "../private/models/".ucfirst($class_name).".php";
});