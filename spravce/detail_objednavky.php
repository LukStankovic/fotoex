<?php
$vsichni_uzivatele = $Uzivatele->vse();
$objednavka_pole = $Objednavky->detailObjednavky($_GET["id-objednavka"]);
$objednavka = $objednavka_pole[0];
$vsechny_fotky = $Fotky->detailFotek($_GET["id-objednavka"]);
$pocet = 0;
$id_objednavka = $_GET["id-objednavka"];
foreach($vsechny_fotky as $fotka)
    $pocet++;
if(isset($_GET["action"]) and $_GET["action"]=="smazat"){
    $Fotky->vymazat($_GET["id-fotka"]);
    header("Location: home.php?page=detail-objednavky&id-objednavka=".$_GET["id-objednavka"]);
}

if(isset($_POST["ulozit"])){
    $Objednavky->upravit($_GET["id-objednavka"],$_POST);
    header("Location: home.php?page=detail-objednavky&id-objednavka=".$_GET["id-objednavka"]);
}
?>       



	<div id="main" class="detail_objednavky">
	<form method="post">
		<div class="row">
            <div class="col-md-3 detail_panel datum">
                <?php 
                $datum = new DateTime($objednavka->datum);
                echo $datum->format("j. n. Y"); 
                ?>
            </div>
            <div class="col-md-3 detail_panel pocet">
                <?php echo $pocet; ?> fotografie
            </div>
            <div class="col-md-3 detail_panel cena">
                <?php echo $objednavka->celkem; ?> Kč
            </div>

            <div class="col-md-3 detail_panel stav 
               <?php 
                if($objednavka->stav == "Zpracovávání")        
                    echo "zpracovavani";
                if($objednavka->stav == "Čeká se na platbu")        
                    echo "platba";
                if($objednavka->stav == "Zrušeno")        
                    echo "zruseno";
                if($objednavka->stav == "Tiskne se")        
                    echo "tisk";
                if($objednavka->stav == "Expeduje se")        
                    echo "expedovano";
                if($objednavka->stav == "Připraveno k odběru")        
                    echo "odber";
                if($objednavka->stav == "Dokončeno")        
                    echo "dokonceno";
                ?>">
                <span><?php echo $objednavka->stav; ?></span>
                <select name="stav" class="upravit_pole">
                    <option <?php if($objednavka->stav == "Zpracovávání") echo "selected"; ?> value="Zpracovávání">Zpracovávání</option>
                    <option <?php if($objednavka->stav == "Čeká se na platbu") echo "selected"; ?> value="Čeká se na platbu">Čeká se na platbu</option>
                    <option <?php if($objednavka->stav == "Tiskne se") echo "selected"; ?> value="Tiskne se">Tiskne se</option>
                    <option <?php if($objednavka->stav == "Expeduje se") echo "selected"; ?> value="Expeduje se">Expeduje se</option>
                    <option <?php if($objednavka->stav == "Připraveno k odběru") echo "selected"; ?> value="Připraveno k odběru">Připraveno k odběru</option>
                    <option <?php if($objednavka->stav == "Zrušeno") echo "selected"; ?> value="Zrušeno">Zrušeno</option>
                    <option <?php if($objednavka->stav == "Dokončeno") echo "selected"; ?> value="Dokončeno">Dokončeno</option>
                </select>
            </div>

		</div>
        <div class="row">
           <div class="col-md-4">
            <h2>Doručovací adresa</h2>
                <ul>
                    <li>
                        <span><?php echo "$objednavka->jmeno $objednavka->prijmeni"; ?></span>
                        <input name="dor_jmeno" class="vedle upravit_pole" type="text" value="<?php echo $objednavka->jmeno; ?>">
                        <input name="dor_prijmeni" class="vedle upravit_pole" type="text" value="<?php echo $objednavka->prijmeni; ?>">
                    </li>
                    <li>
                        <span><?php echo $objednavka->ulice; ?></span>
                        <input name="dor_ulice" class="upravit_pole" type="text" value="<?php echo $objednavka->ulice; ?>">
                    </li>
                    <li>
                        <span><?php echo $objednavka->psc." ".$objednavka->mesto; ?></span>
                        <input name="dor_psc" class="vedle upravit_pole" type="text" value="<?php echo $objednavka->psc; ?>">
                        <input name="dor_mesto" class="vedle upravit_pole" type="text" value="<?php echo $objednavka->mesto; ?>">
                    </li>
                    <li>
                        <span><?php echo $objednavka->zeme; ?></span>
                        <select name="dor_zeme" class="upravit_pole">
                            <option value="Česká republika">Česká republika</option>
                            <option value="Slovenská republika">Slovenská republika</option>
                        </select>
                    </li>
                </ul>
            </div>
           <div class="col-md-4">
            <h2>Fakturační údaje</h2>
                <ul>
                    <li>
                        <span><?php echo "$objednavka->jmeno $objednavka->prijmeni"; ?></span>
                        <input name="fak_jmeno" class="vedle upravit_pole" type="text" value="<?php echo $objednavka->jmeno; ?>">
                        <input name="fak_prijmeni" class="vedle upravit_pole" type="text" value="<?php echo $objednavka->prijmeni; ?>">
                    </li>
                    <li>
                        <span><?php echo $objednavka->ulice; ?></span>
                        <input name="fak_ulice" class="upravit_pole" type="text" value="<?php echo $objednavka->ulice; ?>">
                    </li>
                    <li>
                        <span><?php echo $objednavka->psc." ".$objednavka->mesto; ?></span>
                        <input name="fak_psc" class="vedle upravit_pole" type="text" value="<?php echo $objednavka->psc; ?>">
                        <input name="fak_mesto" class="vedle upravit_pole" type="text" value="<?php echo $objednavka->mesto; ?>">
                    </li>
                    <li>
                        <span><?php echo $objednavka->zeme; ?></span>
                        <select name="fak_zeme" class="upravit_pole">
                            <option value="Česká republika">Česká republika</option>
                            <option value="Slovenská republika">Slovenská republika</option>
                        </select>
                    </li>
                </ul>
            </div>
           <div class="col-md-4">
            <h2>O zákazníkovi</h2>
                <ul>
                    <li><?php echo "$objednavka->jmeno $objednavka->prijmeni"; ?></li>
                    <li>
                        <span><a href="mailto:<?php echo $objednavka->email; ?>"><?php echo $objednavka->email; ?></a></span>
                        <input name="email" class="upravit_pole" type="text" value="<?php echo $objednavka->email; ?>">            
                    </li>
                </ul>
            </div>
        </div>   
        
        <div class="row">
            <div class="col-md-12">   
                <h2>Fotografie</h2>
                <table>
                    <thead>
                        <tr>
                           <th>ID</th>
                            <th>Fotografie</th>
                            <th>Formát</th>
                            <th>Materiál/Fotopapír</th>
                            <th>Deska</th>
                            <th>Typ</th>
                            <th>Cena</th>
                            <th>Smazat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($vsechny_fotky as $fotka){ ?>
                            <tr>
                                <td><?php echo $fotka->id_fotka; ?></td>
                                <td><img src="<?php echo $fotka->url; ?>" width="100"></td>
                                <td><?php echo $fotka->nazev_format; ?></td>
                                <td><?php echo ($fotka->nazev_fotopapir != "NULL" ? $fotka->nazev_fotopapir : $fotka->nazev_material); ?></td>
                                <td><?php echo $fotka->nazev_deska; ?></td>
                                <td><?php echo $fotka->nazev_typ; ?></td>
                                <td><?php echo $fotka->cena_format + $fotka->cena_fotopapir + $fotka->cena_material + $fotka->cena_deska + $fotka->cena_typ; ?> Kč</td>
                                <td>
                                    <a href="?page=detail-objednavky&id-objednavka=<?php echo $id_objednavka; ?>&action=smazat&id-fotka=<?php echo $fotka->id_fotka;?>"><i class="fa fa-remove"></i></a>  
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody> 
                    <tfoot>
                        <tr>
                            <td style="text-align: right;" colspan="6"><strong>Cena celkem:</strong></td>
                            <td><strong><?php echo $objednavka->celkem;?> Kč</strong></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>         
        <div class="btn"><a href="?page=objednavky">← Zpět na objednávky</a></div> 
        <div class="btn pull-right upravit"><a href="#">Upravit objednávku</a></div> 
        <button class="btn pull-right upraveno"type="submit" name="ulozit">Uložit upravenou objednávku</button>
        <div class="btn pull-right upraveno"><a href="#">Zrušit úpravy</a></div> 
    </form>
    </div>
<script>
//FILTRACE TABULKY
$("table").filterTable();
//ÚPRAVY OBJEDNÁVKY
$(function(){
    //VÝCHOZÍ STAV
    $(".btn.upravit").show();
    $(".btn.upraveno").hide();
    $("span").show();
    $(".upravit_pole").hide();
    //ZOBRAZENÍ BTNŮ ULOŽIT A ZRUŠIT A SKRYTÍ UPRAVIT
    $(".btn.upravit").click(function(){
        $(".btn.upravit").hide();
        $(".btn.upraveno").show();
        $("span").hide();
        $(".upravit_pole").show();
    });
    //ZPĚT NA VÝCHOZÍ STAV
    $(".btn.upraveno").click(function(){
        $(".btn.upravit").show();
        $(".btn.upraveno").hide();
        $("span").show();
        $(".upravit_pole").hide();
    });


});
    
</script>