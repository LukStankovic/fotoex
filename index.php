<?php 
//VLOZENI <HEAD> VČETNĚ KONFIGURACE
include_once("sablona/head.php");
//VLOZENI headeru, loga a menu
include_once("sablona/hlavicka.php");
$clanky = $Clanky->vse();
?>

<main class="uvod">              
    <div class="container stranka">
        <h1>Lorem ipsum</h1>
    </div>
</main>
        
<?php 
//VLOZENI PATICKY
include_once("sablona/paticka.php");
?>