<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta htttp-equiv="Cache-control" content="no-cache">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="<?=ASSETS;?>css/style.css" media="screen">
		<link rel="stylesheet" href="<?=ASSETS;?>css/bootstrap.css">
		<link rel="stylesheet" href="<?=ASSETS;?>css/bootstrap.min.css">
		<link rel="stylesheet" href="<?=ASSETS;?>css/font-awesome.min.css">
		<script src="<?=ASSETS;?>js/time.js"></script>
		<script src="<?=ASSETS;?>js/dashboard.min.js"></script>
		<script src="<?=ASSETS;?>js/bootstrap.bundle.min.js"></script>
		<title><?=$_SESSION['page_title'];?></title>
	</head>
	<body>
		<?php if($_SESSION['page_title'] === "Staff Login" || $_SESSION['page_title'] === "Student Login"):?>
		<?php else:?>
			<header>
				<img src="<?=ASSETS;?>images/logo.png" alt="logo">
			</header>
		<?php endif;?>