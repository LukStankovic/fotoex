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
            if((isset($_GET["page"])) and ($_GET["page"] == "clanky"))
                include_once('clanky.php');
            if((isset($_GET["page"])) and ($_GET["page"] == "upravit-clanek"))
                include_once('upravit_clanek.php');
            if((isset($_GET["page"])) and ($_GET["page"] == "uzivatele"))
                include_once('uzivatele.php');
            if((isset($_GET["page"])) and ($_GET["page"] == "detail-objednavky"))
                include_once('detail_objednavky.php');
            if((isset($_GET["page"])) and ($_GET["page"] == "detail-parametru"))
                include_once('detail_parametru.php');
            if((isset($_GET["page"])) and ($_GET["page"] == "upravit-parametr"))
                include_once('upravit_parametr.php');
            if((isset($_GET["page"])) and ($_GET["page"] == "detail-uzivatele"))
                include_once('detail_uzivatele.php');
                           
            ?>
        </div>
    </div>   
   
</body>
</html>
