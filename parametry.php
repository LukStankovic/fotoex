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

$fotky = $Fotky->parametry_fotky( $_POST , count($_POST["fotka"]) );
$_SESSION["fotky"] = $fotky;

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
                                <option data-price="0" value="">Formát</option>
                                <?php foreach($formaty as $format){ ?>
                                <option data-price="<?php echo $format->cena; ?>" value="<?php echo $format->id; ?>"><?php echo $format->nazev; ?></option>
                                <?php } ?>
                            </select>
                            </div>
                            <div class="parametr material">
                            <select name="material[]">
                                <option data-price="0" value="">Materiál</option>
                                <?php foreach($materialy as $material){?>
                                <?php if($material->nazev != "NULL"){ ?>
                                <option data-price="<?php echo $material->cena; ?>" value="<?php echo $material->id; ?>"><?php echo $material->nazev; ?></option>
                                <?php }?>
                                <?php }?>
                            </select>
                            </div>
                            <div class="parametr fotopapir">
                            <select name="fotopapir[]">
                                <option data-price="0" value="">Fotopapír</option>
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
                                <option data-price="0" value="">Deska</option>
                                <?php foreach($desky as $deska){ ?>
                                <option data-price="<?php echo $deska->cena; ?>" value="<?php echo $deska->id; ?>"><?php echo $deska->nazev; ?></option>
                                <?php } ?>
                            </select>
                            </div>
                            <div class="parametr typ">
                            <select name="typ[]">
                                <option data-price="0" value="">Typ</option>
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
                                <div class="vybrat"><i class="fa fa-info-circle"></i> Vyberte formát</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 cena">
                    <span>0,00 Kč</span>
                </div>
            </div>
        </div>
        <?php }?>
        <div class="celkem">Cena za všechny fotografie: <span>0,00</span> Kč</div>
        <button type="submit" class="btn pull-right pokracovat" >Pokračovat do košíku</button>
        </form>
    </div>
    <img src="img/fotka-parametry.jpg" alt="upload" class="img-responsive" style="margin-top:100px">
    <pre><?php print_r($Kosik); ?></pre>
    <pre><?php print_r($_SESSION);?></pre>
    <pre><?php print_r($_POST);?></pre>

</main>    
<script>
$(document).ready(function(){
//CENY
<?php foreach($fotky as $fotka){?>
    

   
    //PŘI ZMĚNĚ SELECTU
    
    $(".fotka-<?php echo $fotka["id"];?> select").change(function() {
        var cena_bez_mnozstvi = 0.00, celkem = 0.00;
        var pocet = 0;
        $(".fotka-<?php echo $fotka["id"];?> select option:selected").each(function() {
            var cena = $(this).data('price');
             cena_bez_mnozstvi += cena;
        });
        pocet = $(".fotka-<?php echo $fotka["id"];?> .pocet input").val();
        
        celkem = cena_bez_mnozstvi * pocet;
         
        $(".fotka-<?php echo $fotka["id"];?> .cena span").html(celkem.toFixed(2).replace('.', ',') + " Kč");
    });
    //PŘI ZMĚNĚ POČTU
    $(".fotka-<?php echo $fotka["id"];?> .pocet input").change(function() {
        var cena_bez_mnozstvi = 0.00, celkem = 0.00;
        var pocet = 0;
        $(".fotka-<?php echo $fotka["id"];?> select option:selected").each(function() {
            var cena = $(this).data('price');
             cena_bez_mnozstvi += cena;
        });
        pocet = $(".fotka-<?php echo $fotka["id"];?> .pocet input").val();

        celkem = cena_bez_mnozstvi * pocet;
         
        $(".fotka-<?php echo $fotka["id"];?> .cena span").html(celkem.toFixed(2).replace('.', ',') + " Kč");
    });
    

<?php }?>

//CELKOVÁ CENA


    $(".cena span").bind("DOMSubtreeModified",function(){    
        var celkem = 0.00;
        $(".cena span").each(function() {
            var cena = parseFloat($(this).text());
            celkem += cena;
        });
        $(".celkem span").html(celkem.toFixed(2).replace('.', ','));
    });
  
    
//ZOBRAZOVÁNÍ A SKRÝVÁNÍ INPUTŮ
<?php foreach($fotky as $fotka){?>
    $(".fotka-<?php echo $fotka["id"];?> .material").show();
    $(".fotka-<?php echo $fotka["id"];?> .fotopapir").hide();
    $(".fotka-<?php echo $fotka["id"];?> .format select").change(function(){
        var vybrane = $(".fotka-<?php echo $fotka["id"];?> .format select option:selected").text();
        var vybrane_pol = vybrane.split("x");
        var sirka = parseFloat(vybrane_pol[0]);
        var vyska = parseFloat(vybrane_pol[1]);
        
        if(vybrane == "A4")
            sirka = 21;
        else if(vybrane == "A3")
            sirka = 29.7;
        else if(vybrane == "A2")
            sirka = 42;
        
        if((sirka >= 20) || (sirka >= 20)){
            $(".fotka-<?php echo $fotka["id"];?> .material select").val("");
            $(".fotka-<?php echo $fotka["id"];?> .material select").trigger("chosen:updated");
            $(".fotka-<?php echo $fotka["id"];?> .material select").next().css("border","2px solid transparent");
            $(".fotka-<?php echo $fotka["id"];?> .material").hide();
            $(".fotka-<?php echo $fotka["id"];?> .fotopapir").show();
        }
        else{
            $(".fotka-<?php echo $fotka["id"];?> .fotopapir select").val("");
            $(".fotka-<?php echo $fotka["id"];?> .fotopapir select").trigger("chosen:updated");
            $(".fotka-<?php echo $fotka["id"];?> .fotopapir select").next().css("border","2px solid transparent");
            $(".fotka-<?php echo $fotka["id"];?> .fotopapir").hide();
            $(".fotka-<?php echo $fotka["id"];?> .material").show();
        }
        
    });
      
<?php } ?>
});
</script>

<script>
$(function(){
<?php foreach($fotky as $id_f => $fotka){ ?>
    
    var sirka_fotky_<?php echo $id_f; ?> = <?php echo $fotka["sirka"]; ?>;
    var vysledek_<?php echo $id_f; ?> = "";
    
    $(".fotka-<?php echo $id_f;?> .format select").change(function(){
        var vybrane = $(".fotka-<?php echo $id_f;?> .format select :selected").text();
        
        if(vybrane != "Formát"){
            
            var sirka_format_<?php echo $id_f; ?> = "";
            
            if(vybrane == "A4")
                sirka_format_<?php echo $id_f; ?> = 21;
            else if(vybrane == "A3")
                sirka_format_<?php echo $id_f; ?> = 29.7;
            else if(vybrane == "A2")
                sirka_format_<?php echo $id_f; ?> = 42;
            else{
                var vybrane = vybrane.split("x");    
                sirka_format_<?php echo $id_f; ?> = parseFloat(vybrane[0]);
            }
            
            var dpi = 2.54*sirka_fotky_<?php echo $id_f;?>/sirka_format_<?php echo $id_f; ?>; 
                        
            if(dpi <= 100)
                $(".fotka-<?php echo $id_f;?> .kvalita").html("<div class='spatna'><i class='fa fa-times-circle'> Špatná kvalita</div>");
            if(dpi > 100 && dpi < 250)
                $(".fotka-<?php echo $id_f;?> .kvalita").html("<div class='prumerna'><i class='fa fa-exclamation-circle'> Průměrná kvalita</div>");
            if(dpi >= 250)
                $(".fotka-<?php echo $id_f;?> .kvalita").html("<div class='vyborna'><i class='fa fa-check-circle'> Výborná kvalita</div>");
        }
        else
            $(".fotka-<?php echo $id_f;?> .kvalita").html("<div class='vybrat'><i class='fa fa-info-circle'></i> Vyberte formát</div>");
        
        
    });
    
    
    
    //ZJIŠTĚNÍ FORMÁTU
    
<?php } ?>
});
</script>

<script>
$(function(){
    $("select").each(function(){
        $(this).change(function(){
            var element = $(this,".chosen-container");
            console.log($(this).val());
            if($(this).val() == ""){
                $(this).next().css("border","2px solid #ea6153");
            }
            else{ //vybere se něco
                $(this).next().css("border","2px solid #2ecc71");
            }

        });
    });
    $("select").change(function(){
        if ($('select:checked').length == $('select').length) {
            console.log("ok");
        }
        else{
            console.log("nič");
        }
    });
    
});
</script>
<script src="js/chosen.jquery.min.js"></script>
<script>
$(".fotka select").chosen({disable_search_threshold: 10});
</script>
<?php 
//VLOZENI PATICKY
require_once("sablona/paticka.php");
?>