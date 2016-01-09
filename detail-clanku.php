<?php 
//VLOZENI <HEAD> VČETNĚ KONFIGURACE
include_once("sablona/head.php");
//VLOZENI headeru, loga a menu
include_once("sablona/hlavicka.php");
$clanek = $Clanky->detail($_GET["id"]);
?>

<main id="clanek" class="container stranka">             
    <div class="uvod-clanku">
        <h1><?php echo $clanek->nazev?></h1>
        <div class="info">
            <span class="datum"><i class="fa fa-calendar"></i><?php echo date("j. n. Y H:i",strtotime($clanek->datum)); ?></span>
            <span class="autor"><i class="fa fa-user"></i><?php echo "$clanek->jmeno $clanek->prijmeni"; ?></span>
        </div>
    </div>
    <div class="obsah">
        <img src="clanky/<?php echo $clanek->cover;?>" alt="Úvodník článku">
        <?php echo $clanek->obsah; ?>
    </div>
    <a href="index.php" class="btn pull-right"> Zpět na hlavní stránku</a>
</main>
        
<?php 
//VLOZENI PATICKY
include_once("sablona/paticka.php");?>