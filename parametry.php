<?php 

//VLOZENI <HEAD>
include_once("sablona/head.php");
//VLOZENI headeru, loga a menu
include_once("sablona/hlavicka.php");
$formaty = $Formaty->vse();
$desky = $Desky->vse();
$typy = $Typy->vse();
$materialy = $Materialy->vse();
$fotopapiry = $Fotopapiry->vse();

$_SESSION["fotky"] = null;
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
    <div class="kroky">
        <ul>
            <li class="aktivni"><a href="nahrani.php"><span>1.</span> Nahrání fotografií</a></li>
            <li class="aktivni"><a href="#"><span>2.</span> Nastavení parametrů</a></li>
            <li><span>3.</span> Košík</li>
            <li><span>4.</span> Doručovací údaje</li>
            <li><span>5.</span> Dokončení objednávky</li>
        </ul>
    </div>
    <div class="fotky">
        <?php foreach($fotky as $fotka) {?>
        <div class="fotka fotka-<?php echo $fotka["id"]; ?>">
            <div class="row">
                <div class="col-md-2 miniatura">
                    <img src="<?php echo $fotka["mini_url"]; ?>">
                </div>
                <div class="col-md-8 parametry-inputy">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="parametr format">
                            <select name="format[<?php echo $id_foto;?>]">
                                <?php foreach($formaty as $format){ ?>
                                <option value="<?php echo $format->id; ?>"><?php echo $format->nazev; ?></option>
                                <?php } ?>
                            </select>
                            </div>
                            <div class="parametr material">
                            <select name="material[<?php echo $id_foto;?>]">
                                <?php foreach($materialy as $material){ ?>
                                <option value="<?php echo $material->id; ?>"><?php echo $material->nazev; ?></option>
                                <?php } ?>
                            </select>
                            </div>
                            <div class="parametr fotopapir">
                            <select name="fotopapir[<?php echo $id_foto;?>]">
                                <?php foreach($fotopapiry as $fotopapir){ ?>
                                <option value="<?php echo $fotopapir->id; ?>"><?php echo $fotopapir->nazev; ?></option>
                                <?php } ?>
                            </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="parametr deska">
                            <select name="deska[<?php echo $id_foto;?>]">
                                <?php foreach($desky as $deska){ ?>
                                <option value="<?php echo $deska->id; ?>"><?php echo $deska->nazev; ?></option>
                                <?php } ?>
                            </select>
                            </div>
                            <div class="parametr typ">
                            <select name="typ[<?php echo $id_foto;?>]">
                                <?php foreach($typy as $typ){ ?>
                                <option value="<?php echo $typ->id; ?>"><?php echo $typ->nazev; ?></option>
                                <?php } ?>
                            </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="parametr pocet">
                                počet
                            </div>
                            <div class="parametr kvalita">
                                kvalita
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 cena">
                    cena
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