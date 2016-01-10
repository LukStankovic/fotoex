<?php  
    include_once ("autorizace.php");
    include_once ("konfigurace.php"); 
    include_once ("headers.php");
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Administrace webu</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, minimum-scale=1 user-scalable=yes">
    <script src="js/jquery-1.11.3.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="js/plugins/morris/morris.js"></script>
    <script src="js/plugins/filtertable/jquery.filtertable.js"></script>
    <script src="js/plugins/stacktable/stacktable.js"></script>
    

    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
    <link href="css/plugins/timeline/timeline.css" rel="stylesheet">
    <link href="css/plugins/stacktable/stacktable.css" rel="stylesheet">

    <link rel="stylesheet" href="css/admin.css" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,400,300,600,700,800&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link href="favicon.png" rel="icon" type="image/png">
    <style>
.filter-table .quick { margin-left: 0.5em; font-size: 0.8em; text-decoration: none; }
.fitler-table .quick:hover { text-decoration: underline; }
td.alt { background-color: #ffc; background-color: rgba(255, 255, 0, 0.2); }
</style> 
</head>