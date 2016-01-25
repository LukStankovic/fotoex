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

$id_obj = "";
list($usec, $sec) = explode(" ", microtime());
$id_obj = (((float)$usec + (float)$sec)*10000);

if(isset($_POST["odeslat"])){
    
    
    if($_POST["dor_jmeno"])
        $data_obj["dor_jmeno"] = $_POST["dor_jmeno"];
    else
        $data_obj["dor_jmeno"] = $_POST["fak_jmeno"];
    
    if($_POST["dor_prijmeni"])
        $data_obj["dor_prijmeni"] = $_POST["dor_prijmeni"];
    else
        $data_obj["dor_prijmeni"] = $_POST["fak_prijmeni"];
    if($_POST["dor_ulice"])
        $data_obj["dor_ulice"] = $_POST["dor_ulice"];
    else
        $data_obj["dor_ulice"] = $_POST["fak_ulice"];
    if($_POST["dor_mesto"])
        $data_obj["dor_mesto"] = $_POST["dor_mesto"];
    else
        $data_obj["dor_mesto"] = $_POST["fak_mesto"];
    if($_POST["dor_psc"])
        $data_obj["dor_psc"] = $_POST["dor_psc"];
    else
        $data_obj["dor_psc"] = $_POST["fak_psc"];
    if($_POST["dor_zeme"])
        $data_obj["dor_zeme"] = $_POST["dor_zeme"];
    else
        $data_obj["dor_zeme"] = $_POST["fak_zeme"];
        
    $data_obj["fak_jmeno"] = $_POST["fak_jmeno"];
    $data_obj["fak_prijmeni"] = $_POST["fak_prijmeni"];
    $data_obj["fak_ulice"] = $_POST["fak_ulice"];
    $data_obj["fak_mesto"] = $_POST["fak_mesto"];
    $data_obj["fak_psc"] = $_POST["fak_psc"];
    $data_obj["fak_zeme"] = $_POST["fak_zeme"];
    
    $data_obj["uz_email"] = $_POST["uz_email"];
    $data_obj["uz_telefon"] = $_POST["uz_telefon"];
    
    $data_obj["platba"] = $_POST["platba"];
    $data_obj["doruceni"] = $_POST["doruceni"];
    
    if($_POST["doruceni"] == "Kurýr")
        $data_obj["doruceni_cena"] = 70;
    if($_POST["doruceni"] == "Česká pošta")
        $data_obj["doruceni_cena"] = 30;
    
    if(isset($_SESSION["id_uzivatel"])){
        if($data_obj["platba"] == "Převodem na účet")
            $Objednavky->vlozeni($id_obj,"Čeká se na platbu",$_SESSION["id_uzivatel"],$data_obj);
        else
            $Objednavky->vlozeni($id_obj,"Zpracovávání",$_SESSION["id_uzivatel"],$data_obj);
    }
    else{
        if($data_obj["platba"] == "Převodem na účet")
            $Objednavky->vlozeni($id_obj,"Čeká se na platbu",-1,$data_obj);
        else
            $Objednavky->vlozeni($id_obj,"Zpracovávání",-1,$data_obj);
    }
    
    
    foreach($_SESSION["kosik"] as $i => $jedna_fotka){
        
        //KOPÍROVÁNÍ DO SLOŽKY FOTKY
        if (!file_exists("objednavky"))
            mkdir("objednavky", 0777);
        
        if (!file_exists("objednavky/".$id_obj))
            mkdir("objednavky/".$id_obj, 0777);
        
        $co = "php/nahrani/tmp-nahrane/".$jedna_fotka["nazev_s"].".".$jedna_fotka["typ_s"];
        $kam = "objednavky/".$id_obj."/".$jedna_fotka["nazev_s"].".".$jedna_fotka["typ_s"];
        copy($co,$kam);

        $data_fot["url"] = $domena."/objednavky/".$id_obj."/".$jedna_fotka["nazev_s"].".".$jedna_fotka["typ_s"];
        $url[$i] = $data_fot["url"];
        $data_fot["typ_souboru"] = $jedna_fotka["typ_s"];
        $data_fot["format"] = $jedna_fotka["format"];
        $data_fot["material"] = $jedna_fotka["material"];
        $data_fot["fotopapir"] = $jedna_fotka["fotopapir"];
        $data_fot["deska"] = $jedna_fotka["deska"];
        $data_fot["typ"] = $jedna_fotka["typ"];
        $data_fot["pocet"] = $jedna_fotka["pocet"];
        $data_fot["cena"] = $jedna_fotka["cena"];
        
        $Fotky->vlozeni($id_obj,$data_fot);
    }
    
    $zazipovani = new PharData(dirname(__FILE__)."/objednavky/$id_obj/fotografie_$id_obj.zip");
    $zazipovani->buildFromDirectory(dirname(__FILE__)."/objednavky/$id_obj");
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
                    <li><?php echo $data_obj["fak_jmeno"]." ".$data_obj["fak_prijmeni"];?></li>
                    <li><?php echo $data_obj["fak_ulice"].", ".$data_obj["fak_mesto"];?></li>
                    <li><?php echo $data_obj["fak_psc"]; ?></li>
                    <li><?php echo $data_obj["fak_zeme"]; ?></li>
                </ul>
                <hr>
                <h2>Údaje o zákazníkovi</h2>
                <ul>
                    <li><a href="mailto:<?php echo $data_obj["uz_email"]; ?>"><?php echo $data_obj["uz_email"]; ?></a></li>
                    <li><?php echo $data_obj["uz_telefon"]; ?></li>
                </ul>
            </div>
            <div class="dorucovaci col-md-6">
                <h2>Doručovací údaje</h2>
                <ul>
                    <li><?php echo $data_obj["dor_jmeno"]." ".$data_obj["dor_prijmeni"];?></li>
                    <li><?php echo $data_obj["dor_ulice"].", ".$data_obj["dor_mesto"];?></li>
                    <li><?php echo $data_obj["dor_psc"]; ?></li>
                    <li><?php echo $data_obj["dor_zeme"]; ?></li>
                </ul>
                <hr>
                <h2>Platba a doprava</h2>
                <ul>
                    <li><strong>Platba:</strong> <?php echo $data_obj["platba"]; ?>
                    <?php if($data_obj["platba"] == "Převodem na účet") echo "- peníze pošlete na účet: xxxxxxxx/xxxx"; ?>
                    </li>
                    <li><strong>Doprava:</strong> <?php echo $data_obj["doruceni"]." (".$data_obj["doruceni_cena"]." Kč)"; ?></li>
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
            <?php foreach($_SESSION["kosik"] as $i => $fotka){ ?>
                <tr class="fotka fotka-<?php echo $fotka["id"]; ?>">
                    <td><img src="<?php echo $url[$i]; ?>" height="80"></td>
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
        <tfoot>
            <tr>
                <td style="text-align: right;" colspan="8" class="doprava">Cena za dopravu: <?php echo number_format((float)$data_obj["doruceni_cena"], 2, '.', '');?> Kč</td>
            </tr>
            <tr>
                <td style="text-align: right;" colspan="8" class="celkem">Celková cena: <span></span> Kč</td>
            </tr>
        </tfoot>
        </tfoot>
    </table>
    </form>
    <img src="img/fotka-udaje.jpg" alt="upload" class="img-responsive" style="margin-top:100px">
</main>    
<pre><?php print_r($_POST); ?></pre>
<pre><?php print_r($_SESSION); ?></pre>
<script>
$(document).ready(function(){
    var celkem = 0.00;
    <?php foreach($_SESSION["kosik"] as $fotka){ ?>
    celkem = celkem + parseFloat($("tbody .fotka-<?php echo $fotka["id"]; ?> td.cena span").text());
    <?php }?>
    celkem = celkem + <?php echo (float)$data_obj["doruceni_cena"];?>;
    $("tfoot td.celkem span").html(celkem.toFixed(2));
});
</script>
<?php 
//VLOZENI PATICKY

foreach($_SESSION["kosik"] as $jedna_fotka){
    unlink("php/nahrani/tmp-nahrane/".$jedna_fotka["nazev_s"].".".$jedna_fotka["typ_s"]);
    unlink("php/nahrani/tmp-nahrane/thumbnail/".$jedna_fotka["nazev_s"].".".$jedna_fotka["typ_s"]);
}
unset($_SESSION["kosik"]);
unset($_SESSION["fotky"]);
require_once("sablona/paticka.php");
?>