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

unset($_SESSION["fotky"]);

for($id_foto = 0;$id_foto<count($_POST["fotka"]); $id_foto++){    
    $id_pred = $id_foto;
    //POKUD JE V KOŠÍKU
    /*
    if(isset($_SESSION["kosik"])){
        $id_foto = $id_foto + (array_pop(array_keys($_SESSION["kosik"])))+1;
    }
    */
    //ID 
    $_SESSION["fotky"][$id_foto]["id"] = $id_pred;
    //URL
    $_SESSION["fotky"][$id_foto]["url"] = $_POST["fotka"][$id_pred];
    $_SESSION["fotky"][$id_foto]["mini_url"] = $_POST["miniatura_fotka"][$id_pred];
    //ROZMĚRY
    list($sirka, $vyska) = getimagesize($_SESSION["fotky"][$id_pred]["url"]);
    $_SESSION["fotky"][$id_foto]["sirka"] = $sirka;
    $_SESSION["fotky"][$id_foto]["vyska"] = $vyska;
    //INFO
    //velikosti souborů
    $info_o_soboru = pathinfo($_SESSION["fotky"][$id_pred]["url"]);
    $_SESSION["fotky"][$id_foto]["nazev"] = $info_o_soboru["filename"];
    $_SESSION["fotky"][$id_foto]["typ_s"] = $info_o_soboru["extension"];
    chmod("php/nahrani/tmp-nahrane", 0777);
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
                    <input type="hidden" value="<?php echo $fotka["url"]; ?>" name="foto_url[]">
                </div>
                <div class="col-md-8 parametry-inputy">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="parametr format">
                            <select name="format[]">
                                <option value="">Formát</option>
                                <?php foreach($formaty as $format){ ?>
                                <option data-price="<?php echo $format->cena; ?>" value="<?php echo $format->id; ?>"><?php echo $format->nazev; ?></option>
                                <?php } ?>
                            </select>
                            </div>
                            <div class="parametr material">
                            <select name="material[]">
                                <option value="">Materiál</option>
                                <?php foreach($materialy as $material){?>
                                <?php if($material->nazev != "NULL"){ ?>
                                <option data-price="<?php echo $material->cena; ?>" value="<?php echo $material->id; ?>"><?php echo $material->nazev; ?></option>
                                <?php }?>
                                <?php }?>
                            </select>
                            </div>
                            <div class="parametr fotopapir">
                            <select name="fotopapir[]">
                                <option value="">Fotopapír</option>
                                <?php foreach($fotopapiry as $fotopapir){ ?>
                                <?php if($fotopapir->nazev != "NULL"){ ?>
                                <option data-price="<?php echo $fotopapir->cena; ?>" value="<?php echo $fotopapir->id; ?>"><?php echo $fotopapir->nazev; ?></option>
                                <?php } ?>
                                <?php } ?>
                            </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="parametr deska">
                            <select name="deska[]">
                                <option value="">Deska</option>
                                <?php foreach($desky as $deska){ ?>
                                <option data-price="<?php echo $deska->cena; ?>" value="<?php echo $deska->id; ?>"><?php echo $deska->nazev; ?></option>
                                <?php } ?>
                            </select>
                            </div>
                            <div class="parametr typ">
                            <select name="typ[]">
                                <option value="">Typ</option>
                                <?php foreach($typy as $typ){ ?>
                                <option data-price="<?php echo $typ->cena; ?>" value="<?php echo $typ->id; ?>"><?php echo $typ->nazev; ?></option>
                                <?php } ?>
                            </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="parametr pocet">
                                <input placeholder="Počet" value="1" type="number" min="1" name="pocet[]">
                            </div>
                            <div class="parametr kvalita">
                                kvalita
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 cena">
                    <span>0.00 Kč</span>
                    <input type="hidden" name="cena_fotka[]" value="0.00">
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
$(document).ready(function(){
//CENY
<?php foreach($fotky as $fotka){?>
    
    
    var nova_cena = 0.00, zakladni_cena = 0.00, cena_bez_mnozstvi;
    //PŘI ZMĚNĚ SELECTU
    jQuery(".fotka-<?php echo $fotka["id"];?> select").change(function() {

        nova_cena = zakladni_cena;    
        
        jQuery(".fotka-<?php echo $fotka["id"];?> select option:selected").each(function() {
            if( jQuery(this).data('price') == null ){
                nova_cena = nova_cena;
            }
            else if (!(jQuery(this).data('price'))){
                nova_cena = nova_cena;
            }
            else{
                nova_cena += jQuery(this).data('price');
                cena_bez_mnozstvi = nova_cena;
                nova_cena = cena_bez_mnozstvi * jQuery(".fotka-<?php echo $fotka["id"];?> .pocet input").val();
            }
        });
        jQuery(".fotka-<?php echo $fotka["id"];?> .cena span").html(nova_cena.toFixed(2) + " Kč");
        jQuery(".fotka-<?php echo $fotka["id"];?> .cena input").val(nova_cena.toFixed(2));
    });
    
    jQuery(".fotka-<?php echo $fotka["id"];?> .pocet input").change(function() {
        nova_cena = cena_bez_mnozstvi * jQuery(this).val();
        jQuery(".fotka-<?php echo $fotka["id"];?> .cena span").html(nova_cena.toFixed(2) + " Kč");
        jQuery(".fotka-<?php echo $fotka["id"];?> .cena input").val(nova_cena.toFixed(2));
    });
    
    
<?php }?>
//ZOBRAZOVÁNÍ A SKRÝVÁNÍ INPUTŮ
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
require_once("sablona/paticka.php");
?>