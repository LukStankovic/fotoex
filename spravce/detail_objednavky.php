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
                <?php echo number_format($objednavka->celkem, 2, ',', ''); ?> Kč
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
                <span class="obj"><?php echo $objednavka->stav; ?></span>
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
                        <span class="obj"><?php echo "$objednavka->d_jmeno $objednavka->d_prijmeni"; ?></span>
                        <input name="dor_jmeno" class="vedle upravit_pole" type="text" value="<?php echo $objednavka->d_jmeno; ?>">
                        <input name="dor_prijmeni" class="vedle upravit_pole" type="text" value="<?php echo $objednavka->d_prijmeni; ?>">
                    </li>
                    <li>
                        <span class="obj"><?php echo $objednavka->d_ulice; ?></span>
                        <input name="dor_ulice" class="upravit_pole" type="text" value="<?php echo $objednavka->d_ulice; ?>">
                    </li>
                    <li>
                        <span class="obj"><?php echo $objednavka->d_psc." ".$objednavka->d_mesto; ?></span>
                        <input name="dor_psc" class="vedle upravit_pole" type="text" value="<?php echo $objednavka->d_psc; ?>">
                        <input name="dor_mesto" class="vedle upravit_pole" type="text" value="<?php echo $objednavka->d_mesto; ?>">
                    </li>
                    <li>
                        <span class="obj"><?php echo $objednavka->d_zeme; ?></span>
                        <select name="dor_zeme" class="upravit_pole">
                            <option <?php if($objednavka->d_zeme == "Česká republika") echo "selected"; ?> value="Česká republika">Česká republika</option>
                            <option <?php if($objednavka->d_zeme == "Slovenská republika") echo "selected"; ?> value="Slovenská republika">Slovenská republika</option>
                        </select>
                    </li>
                </ul>
            </div>
           <div class="col-md-4">
            <h2>Fakturační údaje</h2>
                <ul>
                    <li>
                        <span class="obj"><?php echo "$objednavka->f_jmeno $objednavka->f_prijmeni"; ?></span>
                        <input name="fak_jmeno" class="vedle upravit_pole" type="text" value="<?php echo $objednavka->f_jmeno; ?>">
                        <input name="fak_prijmeni" class="vedle upravit_pole" type="text" value="<?php echo $objednavka->f_prijmeni; ?>">
                    </li>
                    <li>
                        <span class="obj"><?php echo $objednavka->f_ulice; ?></span>
                        <input name="fak_ulice" class="upravit_pole" type="text" value="<?php echo $objednavka->f_ulice; ?>">
                    </li>
                    <li>
                        <span class="obj"><?php echo $objednavka->f_psc." ".$objednavka->f_mesto; ?></span>
                        <input name="fak_psc" class="vedle upravit_pole" type="text" value="<?php echo $objednavka->f_psc; ?>">
                        <input name="fak_mesto" class="vedle upravit_pole" type="text" value="<?php echo $objednavka->f_mesto; ?>">
                    </li>
                    <li>
                        <span class="obj"><?php echo $objednavka->f_zeme; ?></span>
                        <select name="fak_zeme" class="upravit_pole">
                            <option <?php if($objednavka->f_zeme == "Česká republika") echo "selected"; ?> value="Česká republika">Česká republika</option>
                            <option <?php if($objednavka->f_zeme == "Slovenská republika") echo "selected"; ?> value="Slovenská republika">Slovenská republika</option>
                        </select>
                    </li>
                </ul>
            </div>
           <div class="col-md-4">
            <h2>O zákazníkovi</h2>
                <ul>
                    <li><?php 

                            echo "$objednavka->jmeno $objednavka->prijmeni"; 
                        ?>
                    </li>
                    <li>
                        <a href="tel:<?php echo $objednavka->u_telefon; ?>"><?php echo $objednavka->u_telefon; ?></a>
                    </li>
                    <li>
                        <a href="mailto:<?php echo $objednavka->u_email; ?>"><?php echo $objednavka->u_email; ?></a>
                    </li>
                </ul>
            </div>
        </div> 
        <div class="row">
            <div class="col-md-4">
                <h2>Platba</h2>
                <?php echo $objednavka->platba; ?>
            </div>
            <div class="col-md-4">
                <h2>Doprava</h2>
                <?php echo "$objednavka->doprava ($objednavka->doprava_cena Kč)"; ?>
            </div>
            <div class="col-md-4">
                <h2>Infromace o objednávce</h2>
                <?php echo $objednavka->id_objednavka; ?>
                <p><strong>Složka na ftp:</strong> /objednavky/<?php echo $objednavka->id_objednavka; ?>/</p>
                <a class="btn stahnout" href="<?php echo "$domena/objednavky/$objednavka->id_objednavka/fotografie_$objednavka->id_objednavka.zip"; ?>"><i class="fa fa-download"></i> Stáhnout všechny fotografie v .zip</a>
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
                            <th>Počet</th>
                            <th>Akce</th>
                        </tr>
                    </thead>
                    <tbody>
                    <form method="post">
                        <?php foreach($vsechny_fotky as $fotka){ ?>
                            <tr>
                                <td><?php echo $fotka->id_fotka; ?></td>
                                <td><img src="<?php echo $fotka->url; ?>" width="100"></td>
                                <td>
                                    <span class="fot"><?php echo $fotka->nazev_format; ?></span>
                                    <select name="format[<?php echo $fotka->id_fotka; ?>]" class="fot_upravit_pole">
                                        <?php foreach($Formaty->vse() as $format){ ?>
                                            <option value="<?php echo $format->id; ?>"
                                            <?php if($format->nazev == $fotka->nazev_format) echo "selected"; ?>
                                            ><?php echo $format->nazev; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td>
                                    <span class="fot"><?php echo ($fotka->nazev_fotopapir != "NULL" ? $fotka->nazev_fotopapir : $fotka->nazev_material); ?></span>
                                    <select name="fotopapir[<?php echo $fotka->id_fotka; ?>]" class="fot_upravit_pole">
                                        <?php foreach($Fotopapiry->vse() as $fotopapir){ ?>
                                            <option value="<?php echo $fotopapir->id; ?>"
                                            <?php if($fotopapir->nazev == $fotka->nazev_fotopapir) echo "selected"; ?>
                                            ><?php echo $fotopapir->nazev; ?></option>
                                        <?php } ?>
                                    </select>   
                                    <select name="material[<?php echo $fotka->id_fotka; ?>]" class="fot_upravit_pole">
                                        <?php foreach($Materialy->vse() as $material){ ?>
                                            <option value="<?php echo $material->id; ?>"
                                            <?php if($material->nazev == $fotka->nazev_material) echo "selected"; ?>
                                            ><?php echo $material->nazev; ?></option>
                                        <?php } ?>
                                    </select> 
                                </td>
                                <td>
                                    <span class="fot"><?php echo $fotka->nazev_deska; ?></span>
                                    <select name="deska[<?php echo $fotka->id_fotka; ?>]" class="fot_upravit_pole">
                                        <?php foreach($Desky->vse() as $deska){ ?>
                                            <option value="<?php echo $deska->id; ?>"
                                            <?php if($deska->nazev == $fotka->nazev_deska) echo "selected"; ?>>
                                                <?php echo $deska->nazev; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td>
                                    <span class="fot"><?php echo $fotka->nazev_typ; ?></span>
                                    <select name="typ[<?php echo $fotka->id_fotka; ?>]" class="fot_upravit_pole">
                                        <?php foreach($Typy->vse() as $typ){ ?>
                                            <option value="<?php echo $typ->id; ?>"
                                            <?php if($typ->nazev == $fotka->nazev_typ) echo "selected"; ?>>
                                                <?php echo $typ->nazev; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td><?php echo number_format($fotka->cena, 2, ',', ''); ?> Kč</td>
                                <td>
                                <span class="fot"><?php echo $fotka->pocet;?>×</span>
                                <input name="pocet[<?php echo $fotka->id_fotka; ?>]" class="fot_upravit_pole" value="<?php echo $fotka->pocet;?>">
                                </td>
                                <td>
                                    <span class="fot_upraveno"><button name="fot_ulozit" value="<?php echo $fotka->id_fotka; ?>" type="submit"><i class="fa fa-save"></i></button></span>
                                    <span class="fot_upraveno"><a href="#"><i class="fa fa-reply"></i></a></span>
                                    <span class="fot_upravit"><a href="#"><i class="fa fa-pencil"></i></a></span>
                                    <span class="fot_upravit"><a href="?page=detail-objednavky&id-objednavka=<?php echo $id_objednavka; ?>&action=vymazat&id-fotka=<?php echo $fotka->id_fotka;?>"><i class="fa fa-remove"></i></a></span>
                                </td>
                            </tr>
                        <?php } ?>
                        </form>
                    </tbody> 
                    <tfoot>
                       <tr>
                            <td style="text-align: right;" colspan="7"><strong>Cena za dopravu:</strong></td>
                            <td><strong><?php echo number_format($objednavka->doprava_cena, 2, ',', '');?> Kč</strong></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="text-align: right;" colspan="7"><strong>Cena celkem:</strong></td>
                            <td><strong><?php echo number_format($objednavka->celkem, 2, ',', '');?> Kč</strong></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>         
        <div class="btn"><a href="?page=objednavky">← Zpět na objednávky</a></div> 
        <div class="btn pull-right upravit"><i class="fa fa-pencil"></i> Upravit objednávku</div> 
        <button class="btn pull-right upraveno ulozit" type="submit" name="ulozit">Uložit upravenou objednávku</button>
        <div class="btn pull-right upraveno zrusit"><a href="#">Zrušit úpravy</a></div> 
    </form>
    </div>
<pre><?php print_r($objednavka); ?></pre>
<pre><?php print_r($vsechny_fotky); ?></pre>
<script>
//FILTRACE TABULKY
$("table").filterTable();
$('table').stacktable();
//ÚPRAVY OBJEDNÁVKY
$(function(){
    //VÝCHOZÍ STAV
    $(".btn.upravit").show();
    $(".btn.upraveno").hide();
    $("span.obj").show();
    $(".upravit_pole").hide();
    //ZOBRAZENÍ BTNŮ ULOŽIT A ZRUŠIT A SKRYTÍ UPRAVIT
    $(".btn.upravit").click(function(){
        $(".btn.upravit").hide();
        $(".btn.upraveno").show();
        $("span.obj").hide();
        $(".upravit_pole").show();
    });
    //ZPĚT NA VÝCHOZÍ STAV
    $(".btn.upraveno").click(function(){
        $(".btn.upravit").show();
        $(".btn.upraveno").hide();
        $("span.obj").show();
        $(".upravit_pole").hide();
    });

});
//ÚPRAVY FOTEK
$(function(){
    //VÝCHOZÍ STAV
    $(".fot_upravit").show();
    $(".fot_upraveno").hide();
    $("span.fot").show();
    $(".fot_upravit_pole").hide();
    //ZOBRAZENÍ BTNŮ ULOŽIT A ZRUŠIT A SKRYTÍ UPRAVIT
    $(".fot_upravit").click(function(){
        $(".fot_upravit").hide();
        $(".fot_upraveno").show();
        $("span.fot").hide();
        $(".fot_upravit_pole").show();
    });
    //ZPĚT NA VÝCHOZÍ STAV
    $(".fot_upraveno").click(function(){
        $(".fot_upravit").show();
        $(".fot_upraveno").hide();
        $("span.fot").show();
        $(".fot_upravit_pole").hide();
    });

});   
</script>