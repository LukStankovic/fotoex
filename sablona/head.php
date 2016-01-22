<?php 
//VLOŽENÍ KONFIGURACE
require_once("php/config/konfigurace.php");
session_start();
$domena = ( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
?>
<!doctype html>
<html lang="cs">
	<head>
		<meta charset="utf-8">
		<title>FotoEx - Online fotolab pro Vaše fotografie</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700,600,400italic,300italic&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="//blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
        <link rel="stylesheet" href="css/multiuploader/jquery.fileupload.css">
        <link rel="stylesheet" href="css/multiuploader/jquery.fileupload-ui.css">
        <noscript><link rel="stylesheet" href="css/multiuploader/jquery.fileupload-noscript.css"></noscript>
        <noscript><link rel="stylesheet" href="css/multiuploader/jquery.fileupload-ui-noscript.css"></noscript>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/bootstrap.min.css"> 
        <link rel="stylesheet" href="css/chosen.min.css">
 		<link rel="stylesheet" href="css/style.css">
 		
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
		<!--[if IE]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		
		
		<link rel="apple-touch-icon" sizes="57x57" href="/ikony/apple-touch-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/ikony/apple-touch-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/ikony/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/ikony/apple-touch-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/ikony/apple-touch-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/ikony/apple-touch-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/ikony/apple-touch-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/ikony/apple-touch-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/ikony/apple-touch-icon-180x180.png">
        <link rel="icon" type="image/png" href="/ikony/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="/ikony/android-chrome-192x192.png" sizes="192x192">
        <link rel="icon" type="image/png" href="/ikony/favicon-96x96.png" sizes="96x96">
        <link rel="icon" type="image/png" href="/ikony/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="/ikony/manifest.json">
        <link rel="mask-icon" href="/ikony/safari-pinned-tab.svg" color="#856559">
        <link rel="shortcut icon" href="/ikony/favicon.ico">
        <meta name="apple-mobile-web-app-title" content="FotoEx">
        <meta name="application-name" content="FotoEx">
        <meta name="msapplication-TileColor" content="#856559">
        <meta name="msapplication-TileImage" content="/ikony/mstile-144x144.png">
        <meta name="msapplication-config" content="/ikony/browserconfig.xml">
        <meta name="theme-color" content="#856559">

	</head>
    <body>