<?php
    require_once ("sablona-spravce/head.php"); 
?>

<body>
    
    <div class="header">
        <div class="row navigace-hlavni">
            <div class="col-md-7">
                <ul class="navigace">
                    <li><a href="?page=nastenka"><i class="fa fa-newspaper-o"></i>Nástěnka</a></li>
                    <li><a href="?page=objednavky"><i class="fa fa-shopping-cart"></i>Objednávky</a></li>
                    <li><a href="?page=parametry"><i class="fa fa-tags"></i>Parametry</a></li>
                    <li><a href="?page=clanky"><i class="fa fa-pencil"></i>Články</a></li>
                    <li><a href="?page=uzivatele"><i class="fa fa-users"></i>Uživatelé</a></li>
                </ul>  
            </div>
            <div class="col-md-5">
                <ul class="navigace pull-right">
                    <!--<li><a href="#"><i class="fa fa-gears"></i>Nastavení</a></li>-->
                    <li><a href="../index.php" target="_blank"><i class="fa fa-home"></i>Web</a></li>
                    <li><a href="index.php"><i class="fa fa-sign-out"></i>Odhlásit se</a></li>
                </ul>
            </div>
        </div>
        <div class="navigace-mobil">
            <a class="mobilni-menu-tlacitko" role="button" data-toggle="collapse" href="#mobilni-menu" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-bars"></i></a>
            <div class="collapse" id="mobilni-menu">
                <ul class="navigace">
                    <li><a href="?page=nastenka"><i class="fa fa-newspaper-o"></i>Nástěnka</a></li>
                    <li><a href="?page=objednavky"><i class="fa fa-shopping-cart"></i>Objednávky</a></li>
                    <li><a href="?page=parametry"><i class="fa fa-tags"></i>Parametry</a></li>
                    <li><a href="?page=clanky"><i class="fa fa-pencil"></i>Články</a></li>
                    <li><a href="?page=uzivatele"><i class="fa fa-users"></i>Uživatelé</a></li>
                </ul>  
                <ul class="navigace ostatni">
                    <!--<li><a href="#"><i class="fa fa-gears"></i>Nastavení</a></li>-->
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
                require_once ('nastenka.php');             
            if((isset($_GET["page"])) and ($_GET["page"] == "objednavky"))
                require_once ('objednavky.php'); 
            if((isset($_GET["page"])) and ($_GET["page"] == "parametry"))
                require_once ('parametry.php');
            if((isset($_GET["page"])) and ($_GET["page"] == "clanky"))
                require_once('clanky.php');
            if((isset($_GET["page"])) and ($_GET["page"] == "upravit-clanek"))
                require_once('upravit_clanek.php');
            if((isset($_GET["page"])) and ($_GET["page"] == "uzivatele"))
                require_once('uzivatele.php');
            if((isset($_GET["page"])) and ($_GET["page"] == "detail-objednavky"))
                require_once('detail_objednavky.php');
            if((isset($_GET["page"])) and ($_GET["page"] == "detail-parametru"))
                require_once('detail_parametru.php');
            if((isset($_GET["page"])) and ($_GET["page"] == "upravit-parametr"))
                require_once('upravit_parametr.php');
            if((isset($_GET["page"])) and ($_GET["page"] == "detail-uzivatele"))
                require_once('detail_uzivatele.php');  
            ?>
        </div>
    </div>   
   
</body>
</html>
