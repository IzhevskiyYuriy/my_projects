<?php
if (!defined('ROOT')) define('ROOT', $_SERVER['DOCUMENT_ROOT']);

require_once(ROOT.'/save_data.php');
require_once(ROOT.'/getting_list_of_regions.php');
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<title>Анкета-1</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">
	<title>Анкета</title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name='yandex-verification' content='48b8db963c8a3dd5' />
	<meta name="google-site-verification" content="rSdXNmN0R5-ojp2wUdoM4hZFjNcbV9W1BuY8my5jLsM" />
	<link rel="stylesheet"  href="/custom/jquery-ui.css" type="text/css" media="all" />
    <link rel="stylesheet"  href="/custom/faac51727dd303172a66768203cc7b02_style.min.css" type="text/css" media="all" />
    <link rel="icon" type="image/png" href="/favicon16.png" sizes="16x16">
	<link rel="icon" type="image/png" href="/favicon32.png" sizes="32x32">
</head>
<body>

<header class="header">
	<div class="wrap">
		<div class="clearfix">
			<a class="logo" href="/"><img src="/img/dengomet.png" alt="" class="logo__link"></a>
			
			<div class="counter">
				<div class="counter__date">Сегодня подобрано</div>
				<div class="counter__value"><span class="counter__order"><?= $_SESSION['loans_today'] ?> </span> займов</div>
			</div>
		</div>
	</div>
</header>
