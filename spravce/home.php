<?php
    include_once ("sablona-spravce/head.php"); 

?>

<body>
    
    <div class="header">
        <div class="row">
            <div class="col-md-7">
                <ul class="navigace">
                    <li><a href="?page=nastenka"><i class="fa fa-newspaper-o"></i>Nástěnka</a></li>
                    <li><a href="?page=objednavky"><i class="fa fa-shopping-cart"></i>Objednávky</a></li>
                    <li><a href="?page=parametry"><i class="fa fa-tags"></i>Parametry</a></li>
                    <li><a href="#"><i class="fa fa-pencil"></i>Články</a></li>
                    <li><a href="?page=uzivatele"><i class="fa fa-users"></i>Uživatelé</a></li>
                </ul>  
            </div>
            <div class="col-md-5">
                <ul class="navigace pull-right">
                    <li><a href="#"><i class="fa fa-gears"></i>Nastavení</a></li>
                    <li><a href="../index.php" target="_blank"><i class="fa fa-home"></i>Web</a></li>
                    <li><a href="index.php"><i class="fa fa-sign-out"></i>Odhlásit se</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="main">
        <div class="container">
            <?php 
            if((isset($_GET["page"])) and ($_GET["page"] == "nastenka"))
                include_once ('nastenka.php'); 
            
            if((isset($_GET["page"])) and ($_GET["page"] == "objednavky"))
                include_once ('objednavky.php'); 
            if((isset($_GET["page"])) and ($_GET["page"] == "parametry"))
                include_once ('parametry.php');
            if((isset($_GET["page"])) and ($_GET["page"] == "uzivatele"))
                include_once('uzivatele.php');
            if((isset($_GET["page"])) and ($_GET["page"] == "detail-objednavky"))
                include_once('detail_objednavky.php');
            if((isset($_GET["page"])) and ($_GET["page"] == "detail-parametru"))
                include_once('detail_parametru.php');
            if((isset($_GET["page"])) and ($_GET["page"] == "upravit-parametr"))
                include_once('upravit_parametr.php');
                           
            ?>
        </div>
    </div>   
   
   
   
    <!--
    <div id="wrapper">
    
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Navigace</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>        
                </button>
                <a class="navbar-brand" href="../index.php" target="_blank">Blog Lukáše Stankoviče</a>               
            </div>
            <ul class="navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i><i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a><i class="fa fa-user fa-fw"></i> Profil</a></li>
                        <li><a><i class="fa fa-gear fa-fw"></i> Nastavení profilu</a></li>
                        <li class="divider"></li>
                        <li><a href="index.php"><i class="fa fa-sign-out fa-fw"></i> Odhlásit se</a></li>
                    </ul>
                </li>
            </ul>
            <div class="navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul id="side-menu">
                        <li class="<?php if((isset($_GET["page"])) and ($_GET["page"] == "nastenka")) echo "active";?>"><a href="?page=nastenka"><div class="ikona-menu"><i class="fa fa-tachometer"></i></div><div class="popisy">Nástěnka</div></a></li>
                        <li class="<?php if((isset($_GET["page"])) and ($_GET["page"] == "obsah")) echo "active";?>"><a href="?page=obsah"><div class="ikona-menu"><i class="fa fa-pencil"></i></div><div class="popisy">Objednávky</div></a></li>
                        <li class="<?php if((isset($_GET["page"])) and ($_GET["page"] == "uzivatele")) echo "active";?>"><a href="?page=uzivatele"><div class="ikona-menu"><i class="fa fa-users"></i></div><div class="popisy">Uživatelé</div></a></li>    
                        
                    </ul>
                </div>
            </div>
        </nav>
        <div id="page-wrapper">
            <?php 
                if((isset($_GET["page"])) and ($_GET["page"] == "nastenka"))
                    include_once ('nastenka.php');
                if((isset($_GET["page"])) and ($_GET["page"] == "obsah"))
                    include_once ('obsah.php');
                if((isset($_GET["page"])) and ($_GET["page"] == "uzivatele"))
                    include_once ('uzivatele.php');
                      
            ?>
        </div>
    </div>
->
</body>
</html>
