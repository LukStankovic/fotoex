<?php 

//VLOZENI <HEAD>
include_once("sablona/head.php");
//VLOZENI headeru, loga a menu
include_once("sablona/hlavicka.php");

?>  
<main id="nahrani" class="container stranka">
    <pre><?php print_r($_POST); ?></pre>
    <pre><?php print_r($_FILES); ?></pre>
</main>    
<?php 
//VLOZENI PATICKY
include_once("sablona/paticka.php");
?>