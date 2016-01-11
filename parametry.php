<?php 

//VLOZENI <HEAD>
include_once("sablona/head.php");
//VLOZENI headeru, loga a menu
include_once("sablona/hlavicka.php");
session_start();
global $id_foto;
for($id_foto = 0;$id_foto<count($_POST["fotka"]); $id_foto++){    
    //ID
    $_SESSION["fotky"][$id_foto]["id"] = $id_foto;
    //URL
    $_SESSION["fotky"][$id_foto]["url"] = $_POST["fotka"][$id_foto];
    $_SESSION["fotky"][$id_foto]["mini_url"] = $_POST["miniatura_fotka"][$id_foto];
    //ROZMĚRY
    list($sirka, $vyska) = getimagesize($_SESSION["fotky"][$id_foto]["url"]);
    $_SESSION["fotky"][$id_foto]["sirka"] = $sirka;
    $_SESSION["fotky"][$id_foto]["vyska"] = $vyska;
    //INFO
    $info_o_soboru = pathinfo($_SESSION["fotky"][$id_foto]["url"]);
    $nazev = strtr($info_o_soboru["filename"], $diakritika);
    $_SESSION["fotky"][$id_foto]["nazev"] = $nazev;
    $_SESSION["fotky"][$id_foto]["format"] = $info_o_soboru["extension"];
    //PŘEKOPÍROVÁNÍ DO PROMĚNNÉ FOTKY
    $fotky = $_SESSION["fotky"];
}

?>  
<main id="parametry" class="container stranka">
    <div class="fotky">
        <?php foreach($fotky as $fotka) {?>
        <div class="fotka fotka-<?php echo $fotka["id"]; ?>">
            <div class="row">
                <div class="col-md-3">
                    <img src="<?php echo $fotka["mini_url"]; ?>">
                </div>
            </div>
        </div>
        <?php }?>
    </div>
       
    <?php foreach($fotky as $fotka) {?>
        <pre><?php print_r($fotka);?></pre>
    <?php }?>
</main>    
<?php 
//VLOZENI PATICKY
include_once("sablona/paticka.php");
?>