<?php 

//VLOZENI <HEAD>
require_once("sablona/head.php");
//VLOZENI headeru, loga a menu
require_once("sablona/hlavicka.php");
$formaty = $Formaty->vse();
$desky = $Desky->vse();
$typy = $Typy->vse();
$materialy = $Materialy->vse();
$fotopapiry = $Fotopapiry->vse();

if(isset($_POST)){
    foreach($_SESSION["fotky"] as $fotka){
        $id_foto = $fotka["id"];
        $_SESSION["kosik"][$id_foto]["id"] = $id_foto;
        $_SESSION["kosik"][$id_foto]["url"] = $_POST["foto_url"][$id_foto];
        $_SESSION["kosik"][$id_foto]["format"] = $_POST["format"][$id_foto];
        
        if($_SESSION["kosik"][$id_foto]["material"] != null)
            $_SESSION["kosik"][$id_foto]["material"] = $_POST["material"][$id_foto];
        else
            $_SESSION["kosik"][$id_foto]["material"] = "NULL";
        
        if($_SESSION["kosik"][$id_foto]["fotopapir"] != null)
            $_SESSION["kosik"][$id_foto]["fotopapir"] = $_POST["fotopapir"][$id_foto];
        else
            $_SESSION["kosik"][$id_foto]["fotopapir"] = "NULL";
        
        $_SESSION["kosik"][$id_foto]["deska"] = $_POST["deska"][$id_foto];
        $_SESSION["kosik"][$id_foto]["typ"] = $_POST["typ"][$id_foto];
        $_SESSION["kosik"][$id_foto]["pocet"] = $_POST["pocet"][$id_foto];
        $_SESSION["kosik"][$id_foto]["cena_fotka"] = $_POST["cena_fotka"][$id_foto];
    }
}

?>  
<main id="parametry" class="container stranka">
    <div class="kroky">
        <ul>
            <li class="aktivni"><a href="nahrani.php"><span>1.</span> Nahrání fotografií</a></li>
            <li class="aktivni"><a href="parametry.php"><span>2.</span> Nastavení parametrů</a></li>
            <li class="aktivni"><a href="#"><span>3.</span> Košík</a></li>
            <li><span>4.</span> Doručovací údaje</li>
            <li><span>5.</span> Dokončení objednávky</li>
        </ul>
    </div>
    
    <pre><?php print_r($_SESSION);?></pre>
    <pre><?php print_r($_POST);?></pre>
</main>    

<?php 
//VLOZENI PATICKY
require_once("sablona/paticka.php");
?>