<?php 
ob_start();
//VLOZENI <HEAD>
require_once("sablona/head.php");
//VLOZENI headeru, loga a menu
require_once("sablona/hlavicka.php");

$formaty = $Formaty->vse();
$desky = $Desky->vse();
$typy = $Typy->vse();
$materialy = $Materialy->vse();
$fotopapiry = $Fotopapiry->vse();

$id_obj = "";
list($usec, $sec) = explode(" ", microtime());
$id_obj = (((float)$usec + (float)$sec)*10000);

if(isset($_POST["odeslat"])){
    
    $Kosik = $_SESSION["kosik"];
    $Kosik->vlozitUdaje();
    
    if(isset($_SESSION["id_uzivatel"])){
        if($Kosik->platba == "Převodem na účet")
            $Objednavky->vlozeni($id_obj,"Čeká se na platbu",$_SESSION["id_uzivatel"],$Kosik->udaje,$Kosik->cena_celkem,$Kosik->platba,$Kosik->doprava);
        else
            $Objednavky->vlozeni($id_obj,"Zpracovávání",$_SESSION["id_uzivatel"],$Kosik->udaje,$Kosik->cena_celkem,$Kosik->platba,$Kosik->doprava);
    }
    else{
        if($Kosik->platba == "Převodem na účet")
            $Objednavky->vlozeni($id_obj,"Čeká se na platbu",-1,$Kosik->udaje,$Kosik->cena_celkem,$Kosik->platba,$Kosik->doprava);
        else
            $Objednavky->vlozeni($id_obj,"Zpracovávání",-1,$Kosik->udaje,$Kosik->cena_celkem,$Kosik->platba,$Kosik->doprava);
    }
    
    foreach($Kosik->fotky as $i => $fotka){        
        if (!file_exists("objednavky"))
            mkdir("objednavky", 0777);
        if (!file_exists("objednavky/".$id_obj))
            mkdir("objednavky/".$id_obj, 0777);
            
        $co = "php/nahrani/tmp-nahrane/".$fotka["informace"]["nazev"].".".$fotka["informace"]["typ_s"];
        $kam = "objednavky/".$id_obj."/".$fotka["informace"]["nazev"].".".$fotka["informace"]["typ_s"];

        copy($co,$kam);
        
        $bez_diakritky = $Fotky->vymazatDiakritiku($fotka["informace"]["nazev"]);
        
        rename("objednavky/".$id_obj."/".$fotka["informace"]["nazev"].".".$fotka["informace"]["typ_s"],
               "objednavky/".$id_obj."/".$bez_diakritky.".".$fotka["informace"]["typ_s"]);
        
        $nove_url = $domena."/objednavky/".$id_obj."/".$bez_diakritky.".".$fotka["informace"]["typ_s"];

        
        $Kosik->zmenaURL($i,$nove_url);
        
        $Fotky->vlozeni($id_obj,$fotka);
        
    }
    
    
    $zazipovani = new PharData(dirname(__FILE__)."/objednavky/$id_obj/fotografie_$id_obj.zip");
    $zazipovani->buildFromDirectory(dirname(__FILE__)."/objednavky/$id_obj");
 
    //require_once("emaily/nova_objednavka-uzivatel.php");
}
?>  
<main id="odeslat" class="container stranka">
    <div class="kroky">
        <ul>
            <li class="aktivni"><a href="#"><span>1.</span> Nahrání fotografií</a></li>
            <li class="aktivni"><a href="#"><span>2.</span> Nastavení parametrů</a></li>
            <li class="aktivni"><a href="#"><span>3.</span> Košík</a></li>
            <li class="aktivni"><a href="#"><span>4.</span> Doručovací údaje</a></li>
            <li class="aktivni"><a href="#"><span>5.</span> Dokončení objednávky</a></li>
        </ul>
    </div>
    <form method="POST" action="odeslat.php">
    <div class="udaje-blok">
        <p class="dekujeme">Děkujeme za vaši objednávku. Během chvíle vám bude odeslán e-mail.</p>
        <div class="row">
            <div class="fakturacni col-md-6">
                <h2>Fakturační údaje</h2>
                <ul>
                    <li><?php echo $Kosik->udaje["fakturacni"]["jmeno"]." ".$Kosik->udaje["fakturacni"]["prijmeni"];?></li>
                    <li><?php echo $Kosik->udaje["fakturacni"]["ulice"].", ".$Kosik->udaje["fakturacni"]["mesto"];?></li>
                    <li><?php echo $Kosik->udaje["fakturacni"]["psc"]; ?></li>
                    <li><?php echo $Kosik->udaje["fakturacni"]["zeme"]; ?></li>
                </ul>
                <hr>
                <h2>Údaje o zákazníkovi</h2>
                <ul>
                    <li><a href="mailto:<?php echo $Kosik->udaje["uzivatelske"]["email"]; ?>"><?php echo $Kosik->udaje["uzivatelske"]["email"]; ?></a></li>
                    <li><?php echo $Kosik->udaje["uzivatelske"]["telefon"]; ?></li>
                </ul>
            </div>
            <div class="dorucovaci col-md-6">
                <h2>Doručovací údaje</h2>
                <ul>
                    <li><?php echo $Kosik->udaje["dorucovaci"]["jmeno"]." ".$Kosik->udaje["dorucovaci"]["prijmeni"];?></li>
                    <li><?php echo $Kosik->udaje["dorucovaci"]["ulice"].", ".$Kosik->udaje["dorucovaci"]["mesto"];?></li>
                    <li><?php echo $Kosik->udaje["dorucovaci"]["psc"]; ?></li>
                    <li><?php echo $Kosik->udaje["dorucovaci"]["zeme"]; ?></li>
                </ul>
                <hr>
                <h2>Platba a doprava</h2>
                <ul>
                    <li><strong>Platba:</strong> <?php echo $Kosik->platba; ?>
                    <?php if($Kosik->platba == "Převodem na účet") echo "- peníze pošlete na účet: xxxxxxxx/xxxx"; ?>
                    </li>
                    <li><strong>Doprava:</strong> <?php echo $Kosik->doprava["typ"]." (".$Kosik->doprava["cena"]." Kč)"; ?></li>
                </ul>
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
            <?php foreach($Kosik->fotky as $i => $fotka){ ?>
                <tr class="fotka fotka-<?php echo $fotka["id"]; ?>">
                    <td><img src="<?php echo $fotka["url"]; ?>" height="80"></td>
                    <td><?php echo $fotka["format_nazev"];?></td>
                    <td><?php echo $fotka["material_nazev"];?></td>
                    <td><?php echo $fotka["fotopapir_nazev"];?></td>
                    <td><?php echo $fotka["deska_nazev"];?></td>
                    <td><?php echo $fotka["typ_nazev"];?></td>
                    <td><?php echo $fotka["pocet"];?>×</td>
                    <td class="cena"><strong><span><?php echo number_format($fotka["cena"], 2, ',', '');?></span> Kč</strong></td>
                </tr>
            <?php }?>
        </tbody>
        <tfoot>
        <tfoot>
            <tr>
                <td style="text-align: right;" colspan="8" class="doprava">Cena za dopravu: <?php echo number_format((float)$Kosik->doprava["cena"], 2, ',', '');?> Kč</td>
            </tr>
            <tr>
                <td style="text-align: right;" colspan="8" class="celkem">Celková cena: <span><?php echo number_format($Kosik->cena_celkem,2); ?></span> Kč</td>
            </tr>
        </tfoot>
        </tfoot>
    </table>
    </form>
    <img src="img/fotka-udaje.jpg" alt="upload" class="img-responsive" style="margin-top:100px">
</main>    
<pre><?php print_r($Kosik); ?></pre>

<pre><?php print_r($_POST); ?></pre>
<pre><?php print_r($_SESSION); ?></pre>

<?php 
//VLOZENI PATICKY


foreach($Kosik->fotky as $jedna_fotka){
    unlink("php/nahrani/tmp-nahrane/".$jedna_fotka["informace"]["nazev"].".".$jedna_fotka["informace"]["typ_s"]);
    unlink("php/nahrani/tmp-nahrane/thumbnail/".$jedna_fotka["informace"]["nazev"].".".$jedna_fotka["informace"]["typ_s"]);
}
unset($_SESSION["kosik"]);
unset($_SESSION["fotky"]);
unset($Fotky->fotky);

require_once("sablona/paticka.php");
ob_end_flush();
?>