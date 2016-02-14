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
    $Kosik->vlozit();
    $_SESSION["kosik"] = $Kosik;
}
?>  
<main id="kosik" class="container stranka">
    <div class="kroky">
        <ul>
            <li class="aktivni"><a href="nahrani.php"><span>1.</span> Nahrání fotografií</a></li>
            <li class="aktivni"><a href="parametry.php"><span>2.</span> Nastavení parametrů</a></li>
            <li class="aktivni"><a href="#"><span>3.</span> Košík</a></li>
            <li><span>4.</span> Doručovací údaje</li>
            <li><span>5.</span> Dokončení objednávky</li>
        </ul>
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
                <th>Odstranit</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($Kosik->fotky as $fotka){ ?>
                <tr class="fotka fotka-<?php echo $fotka["id"]; ?>">
                    <td><img src="<?php echo $fotka["url"];?>" height="80"></td>
                    <td><?php echo $fotka["format_nazev"];?></td>
                    <td><?php echo $fotka["material_nazev"];?></td>
                    <td><?php echo $fotka["fotopapir_nazev"];?></td>
                    <td><?php echo $fotka["deska_nazev"];?></td>
                    <td><?php echo $fotka["typ_nazev"];?></td>
                    <td><?php echo $fotka["pocet"];?>×</td>
                    <td class="cena"><strong><span><?php echo number_format($fotka["cena"], 2, ',', ''); ?></span> Kč</strong></td>
                    <td><i class="fa fa-remove"></i></td>
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
                <td class="celkem">Celková cena:</td>
                <td class="celkem"><span><?php echo number_format($Kosik->cena_bez_dopravy, 2, ',', ''); ?></span> Kč</td>
                <td></td>
            </tr>
        </tfoot>
    </table>
    <a class="pokracovat btn pull-right" href="udaje.php">Pokračovat v objednávce</a>
    <img src="img/fotka-kosik.jpg" alt="upload" class="img-responsive" style="margin-top:100px">
    <pre><?php print_r($Kosik); ?></pre>
    <pre><?php print_r($_SESSION); ?></pre>
</main>    

<?php 
//VLOZENI PATICKY
require_once("sablona/paticka.php");
?>