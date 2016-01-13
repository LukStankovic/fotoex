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
    //velikosti souborů
    $info_o_soboru = pathinfo($_SESSION["fotky"][$id_foto]["url"]);
    $_SESSION["fotky"][$id_foto]["nazev"] = $info_o_soboru["filename"];
    $_SESSION["fotky"][$id_foto]["format"] = $info_o_soboru["extension"];
    $_SESSION["fotky"][$id_foto]["velikost"] = 
        filesize("php/nahrani/tmp-nahrane/".$info_o_soboru["filename"].".".$info_o_soboru["extension"]);
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
       <form method="POST" action="kosik.php">
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
                                <option value="">Formát</option>
                                <?php foreach($formaty as $format){ ?>
                                <option value="<?php echo $format->id; ?>"><?php echo $format->nazev; ?></option>
                                <?php } ?>
                            </select>
                            </div>
                            <div class="parametr material">
                            <select name="material[<?php echo $id_foto;?>]">
                                <option value="">Materiál</option>
                                <?php foreach($materialy as $material){?>
                                <?php if($material->nazev != "NULL"){ ?>
                                <option value="<?php echo $material->id; ?>"><?php echo $material->nazev; ?></option>
                                <?php }?>
                                <?php }?>
                            </select>
                            </div>
                            <div class="parametr fotopapir">
                            <select name="fotopapir[<?php echo $id_foto;?>]">
                                <option value="">Fotopapír</option>
                                <?php foreach($fotopapiry as $fotopapir){ ?>
                                <?php if($fotopapir->nazev != "NULL"){ ?>
                                <option value="<?php echo $fotopapir->id; ?>"><?php echo $fotopapir->nazev; ?></option>
                                <?php } ?>
                                <?php } ?>
                            </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="parametr deska">
                            <select name="deska[<?php echo $id_foto;?>]">
                                <option value="">Deska</option>
                                <?php foreach($desky as $deska){ ?>
                                <option value="<?php echo $deska->id; ?>"><?php echo $deska->nazev; ?></option>
                                <?php } ?>
                            </select>
                            </div>
                            <div class="parametr typ">
                            <select name="typ[<?php echo $id_foto;?>]">
                                <option value="">Typ</option>
                                <?php foreach($typy as $typ){ ?>
                                <option value="<?php echo $typ->id; ?>"><?php echo $typ->nazev; ?></option>
                                <?php } ?>
                            </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="parametr pocet">
                                <input placeholder="Počet" value="1" type="number" min="1">
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
        <button type="submit" class="btn pull-right pokracovat">Pokračovat do košíku</button>
        </form>
    </div>
    <pre><?php print_r($_SESSION);?></pre>
</main>    
<script>
//ZOBRAZOVÁNÍ A SKRÝVÁNÍ INPUTŮ
$(document).ready(function(){
<?php foreach($fotky as $fotka){?>
    $(".fotka-<?php echo $fotka["id"];?> .material").show();
    $(".fotka-<?php echo $fotka["id"];?> .fotopapir").hide();
    
    
    $(".fotka-<?php echo $fotka["id"];?> .format select").change(function(){
        var vybrane = $(".fotka-<?php echo $fotka["id"];?> .format select option:selected").text();
        var vybrane_pol = vybrane.split("x");
        var sirka = parseFloat(vybrane_pol[0]);
        var vyska = parseFloat(vybrane_pol[1]);
        
        if((sirka >= 20) || (sirka >= 20)){
            $(".fotka-<?php echo $fotka["id"];?> .material").hide();
            $(".fotka-<?php echo $fotka["id"];?> .fotopapir").show();
        }
        else{
            $(".fotka-<?php echo $fotka["id"];?> .fotopapir").hide();
            $(".fotka-<?php echo $fotka["id"];?> .material").show();
        }
    });
      
<?php } ?>
});
</script>
<?php 
//VLOZENI PATICKY
include_once("sablona/paticka.php");
?>