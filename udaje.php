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


?>  
<main id="udaje" class="container stranka">
    <div class="kroky">
        <ul>
            <li class="aktivni"><a href="nahrani.php"><span>1.</span> Nahrání fotografií</a></li>
            <li class="aktivni"><a href="parametry.php"><span>2.</span> Nastavení parametrů</a></li>
            <li class="aktivni"><a href="kosik.php"><span>3.</span> Košík</a></li>
            <li class="aktivni"><a href="#"><span>4.</span> Doručovací údaje</a></li>
            <li><span>5.</span> Dokončení objednávky</li>
        </ul>
    </div>
    <div class="udaje-blok">
        <div class="row">
            <div class="fakturacni col-md-6">
                <h2>Fakturační údaje</h2>
                
                <div class="form-group">
                    <label for="jmeno_fak" class="control-label">Křestní jméno: </label>
                    <input type="text" class="form-control" name="jmeno_fak" required>    
                </div>
                <div class="form-group">
                    <label for="jmeno_fak" class="control-label">Příjmení: </label>
                    <input type="text" class="form-control" name="jmeno_fak" required>    
                </div>
                <div class="form-group">
                    <label for="jmeno_fak" class="control-label">Ulice: </label>
                    <input type="text" class="form-control" name="jmeno_fak" required>    
                </div>
                <div class="form-group">
                    <label for="jmeno_fak" class="control-label">Město: </label>
                    <input type="text" class="form-control" name="jmeno_fak" required>    
                </div>
                <div class="form-group">
                    <label for="jmeno_fak" class="control-label">PSČ: </label>
                    <input type="text" class="form-control" name="jmeno_fak" required>    
                </div>

                <div class="form-group">
                    <select name="dor_zeme" class="upravit_pole">
                        <option value="Česká republika">Česká republika</option>
                        <option value="Slovenská republika">Slovenská republika</option>
                    </select>
                </div>
                <hr>
                <div class="form-group">
                    <label for="jmeno_fak" class="control-label">E-mail: </label>
                    <input type="text" class="form-control" name="jmeno_fak" required>    
                </div>
                <div class="form-group">
                    <label for="jmeno_fak" class="control-label">Telefon: </label>
                    <input type="text" class="form-control" name="jmeno_fak" required>    
                </div>
            </div>
            <div class="dorucovaci col-md-6">
                <h2>Doručovací údaje</h2>
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
    <a class="pokracovat btn pull-right" href="udaje.php">Pokračovat v objednávce</a>
    <img src="img/fotka-udaje.jpg" alt="upload" class="img-responsive" style="margin-top:100px">
</main>    
<script>
$(document).ready(function(){
    var celkem = 0.00;
    <?php foreach($_SESSION["kosik"] as $fotka){ ?>
    celkem = celkem + parseFloat($("tbody .fotka-<?php echo $fotka["id"]; ?> td.cena span").text());
    <?php }?>
    $("tfoot td.celkem span").html(celkem);
});
</script>
<?php 
//VLOZENI PATICKY
require_once("sablona/paticka.php");
?>