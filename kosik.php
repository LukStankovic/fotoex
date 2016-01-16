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
    foreach($_SESSION["fotky"] as $fotka){
        $id_foto = $fotka["id"];
        $_SESSION["kosik"][$id_foto]["id"] = $id_foto;
        $_SESSION["kosik"][$id_foto]["url"] = $_POST["foto_url"][$id_foto];
        
        //ID FORMÁTU DO KOŠÍKU
        $_SESSION["kosik"][$id_foto]["format"] = $_POST["format"][$id_foto];
        //PODLE ID ZJISTIT NÁZEV PRO UŽIVATELE
        foreach($formaty as $format)
            if($format->id == $_POST["format"][$id_foto])
                $_SESSION["kosik"][$id_foto]["format_nazev"] = $format->nazev;
        
        
        if($_SESSION["kosik"][$id_foto]["material"] != null){
            //ID MATERIÁLU
            $_SESSION["kosik"][$id_foto]["material"] = $_POST["material"][$id_foto];
            //NÁZEV MATERIÁLU
            foreach($materialy as $material)
                if($material->id == $_POST["material"][$id_foto])
                    $_SESSION["kosik"][$id_foto]["material_nazev"] = $material->nazev;
        }
        else{
            $_SESSION["kosik"][$id_foto]["material"] = "NULL";
            $_SESSION["kosik"][$id_foto]["material_nazev"] = "---";
        }
        
        
        if($_SESSION["kosik"][$id_foto]["fotopapir"] != null){
            //ID FOTOPAPÍRU
            $_SESSION["kosik"][$id_foto]["fotopapir"] = $_POST["fotopapir"][$id_foto];
            //NÁZEV FOTOPAPÍRU
            foreach($fotopapiry as $fotopapir)
                if($fotopapir->id == $_POST["fotopapir"][$id_foto])
                    $_SESSION["kosik"][$id_foto]["fotopapir_nazev"] = $fotopapir->nazev;
        }
        else{
            $_SESSION["kosik"][$id_foto]["fotopapir"] = "NULL";
            $_SESSION["kosik"][$id_foto]["fotopapir_nazev"] = "---";
        }
        //ID DESKA
        $_SESSION["kosik"][$id_foto]["deska"] = $_POST["deska"][$id_foto];
        //NÁZEV DESKA
        foreach($desky as $deska)
            if($deska->id == $_POST["deska"][$id_foto])
                $_SESSION["kosik"][$id_foto]["deska_nazev"] = $deska->nazev;
        //ID TYP
        $_SESSION["kosik"][$id_foto]["typ"] = $_POST["typ"][$id_foto];
        //NÁZEV TYP
        foreach($typy as $typ)
            if($typ->id == $_POST["typ"][$id_foto])
                $_SESSION["kosik"][$id_foto]["typ_nazev"] = $typ->nazev;
        
        $_SESSION["kosik"][$id_foto]["pocet"] = $_POST["pocet"][$id_foto];
        $_SESSION["kosik"][$id_foto]["cena_fotka"] = $_POST["cena_fotka"][$id_foto];
    }
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
                <td colspan="3" class="celkem">Celková cena: <span></span> Kč</td>
            </tr>
        </tfoot>
    </table>
    <pre><?php print_r($_SESSION);?></pre>
    <pre><?php print_r($_POST);?></pre>
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