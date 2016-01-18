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
if(isset($_SESSION["id_uzivatel"]))
    $prihlaseny = $Uzivatele->detailUzivatele($_SESSION["id_uzivatel"]);

?>  
<main id="udaje" class="container stranka">
    <div class="kroky">
        <ul>
            <li class="aktivni"><a href="#"><span>1.</span> Nahrání fotografií</a></li>
            <li class="aktivni"><a href="#"><span>2.</span> Nastavení parametrů</a></li>
            <li class="aktivni"><a href="#"><span>3.</span> Košík</a></li>
            <li class="aktivni"><a href="#"><span>4.</span> Doručovací údaje</a></li>
            <li><span>5.</span> Dokončení objednávky</li>
        </ul>
    </div>
    <form method="POST" action="odeslat.php">
    <div class="udaje-blok">
        
        <div class="row">
            <div class="fakturacni col-md-6">
                <h2>Fakturační údaje</h2>
                    
                
                <div class="form-group">
                    <input type="text" class="form-control vedle leva" name="fak_jmeno" value="<?php if(isset($prihlaseny)) echo $prihlaseny->jmeno; ?>" placeholder="Jméno" required>    
                    
                    <input type="text" class="form-control vedle" name="fak_prijmeni" value="<?php if(isset($prihlaseny)) echo $prihlaseny->prijmeni; ?>" placeholder="Příjmení" required>    
                </div>
                <div class="form-group">
                    <input type="text" class="form-control vedle leva" name="fak_ulice" value="<?php if(isset($prihlaseny)) echo $prihlaseny->ulice; ?>" placeholder="Ulice" required>    

                    <input type="text" class="form-control vedle" name="fak_mesto" value="<?php if(isset($prihlaseny)) echo $prihlaseny->mesto; ?>" placeholder="Město" required>    
                </div>
                <div class="form-group">
                    <input type="text" class="form-control vedle leva" name="fak_psc" value="<?php if(isset($prihlaseny)) echo $prihlaseny->psc; ?>" placeholder="PSČ" required>    

                    <select name="fak_zeme" class="upravit_pole">
                        <option <?php if(isset($prihlaseny)) if($prihlaseny->zeme == "Česká republika") echo "selected"; ?> value="Česká republika">Česká republika</option>
                        <option <?php if(isset($prihlaseny)) if($prihlaseny->zeme == "Slovenská republika") echo "selected"; ?> value="Slovenská republika">Slovenská republika</option>
                    </select>
                </div>
                <hr>
                <h2>Údaje o zákazníkovi</h2>
                
                <div class="form-group">
                    <input type="text" class="form-control vedle leva" name="uz_email" value="<?php if(isset($prihlaseny)) echo $prihlaseny->email; ?>" placeholder="E-mail" required>    
                    <input type="text" class="form-control vedle" name="uz_telefon" value="<?php if(isset($prihlaseny)) echo $prihlaseny->telefon; ?>" placeholder="Telefon" required>    
                </div>
            </div>
            <div class="dorucovaci col-md-6">
                <h2>Doručovací údaje</h2>
                
                <div class="form-group">
                    <input type="text" class="form-control vedle leva" name="dor_jmeno" placeholder="Jméno">    
                    
                    <input type="text" class="form-control vedle" name="dor_prijmeni" placeholder="Příjmení">    
                </div>
                <div class="form-group">
                    <input type="text" class="form-control vedle leva" name="dor_ulice" placeholder="Ulice">    

                    <input type="text" class="form-control vedle" name="dor_mesto" placeholder="Město">    
                </div>
                <div class="form-group">
                    <input type="text" class="form-control vedle leva" name="dor_psc" placeholder="PSČ">    

                    <select name="dor_zeme" class="upravit_pole">
                        <option value="Česká republika">Česká republika</option>
                        <option value="Slovenská republika">Slovenská republika</option>
                    </select>
                </div>
                <p><em>Nevyplněné údaje budou stejné jako fakturační údaje.</em></p>
            </div>
        </div>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>Fotografie</th>
                <th>Formát</th>
                <th>Materiál</th>
                <th>Fotopapír</th>
                <th>Deska</th>
                <th>Typ</th>
                <th>Počet</th>
                <th>Cena</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($_SESSION["kosik"] as $fotka){ ?>
                <tr class="fotka fotka-<?php echo $fotka["id"]; ?>">
                    <td><img src="<?php echo $fotka["url"];?>" height="80"></td>
                    <td><?php echo $fotka["format_nazev"];?></td>
                    <td><?php echo $fotka["material_nazev"];?></td>
                    <td><?php echo $fotka["fotopapir_nazev"];?></td>
                    <td><?php echo $fotka["deska_nazev"];?></td>
                    <td><?php echo $fotka["typ_nazev"];?></td>
                    <td><?php echo $fotka["pocet"];?>×</td>
                    <td class="cena"><strong><span><?php echo $fotka["cena_fotka"];?></span> Kč</strong></td>
                </tr>
            <?php }?>
        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="2" class="celkem">Celková cena: <span></span> Kč</td>
            </tr>
        </tfoot>
    </table>
    <button type="submit" name="odeslat" class="pokracovat btn pull-right">Odeslat objednávku</button>
    </form>
    <img src="img/fotka-udaje.jpg" alt="upload" class="img-responsive" style="margin-top:100px">
</main>    
<script>
$(document).ready(function(){
    var celkem = 0.00;
    <?php foreach($_SESSION["kosik"] as $fotka){ ?>
    celkem = celkem + parseFloat($("tbody .fotka-<?php echo $fotka["id"]; ?> td.cena span").text());
    <?php }?>
    $("tfoot td.celkem span").html(celkem.toFixed(2));
});
</script>
<?php 
//VLOZENI PATICKY
require_once("sablona/paticka.php");
?>