<?php 
//VLOZENI <HEAD> VČETNĚ KONFIGURACE
require_once("sablona/head.php");
//VLOZENI headeru, loga a menu
require_once("sablona/hlavicka.php");
$clanky = $Clanky->vse();
$poc = 0;
?>

<main class="container stranka">
    <?php foreach($clanky as $clanek){ ?>
    <div class="clanek clanek-<?php echo $clanek->id_clanek; ?> row">
       
        <div class="col-md-6 fotografie">
            <div class="uvodni-img" style="background: url(clanky/<?php echo $clanek->cover; ?>)"><a href="detail-clanku.php?id=<?php echo $clanek->id_clanek; ?>"></a></div>
        </div>
        <div class="col-md-6 obsah-clanku">
            <h1><a href="detail-clanku.php?id=<?php echo $clanek->id_clanek; ?>"><?php echo $clanek->nazev; ?></a></h1>
            <div class="info">
                <span class="datum"><i class="fa fa-calendar"></i><?php echo date("j. n. Y H:i",strtotime($clanek->datum)); ?></span>
                <span class="autor"><i class="fa fa-user"></i><?php echo "$clanek->jmeno $clanek->prijmeni"; ?></span>
            </div>
            <?php echo substr($clanek->obsah,0,400)."..."; ?>
            <div class="cist-dale"><a href="detail-clanku.php?id=<?php echo $clanek->id_clanek; ?>" class="btn">Číst dále</a></div>
        </div>
    </div>
    <?php 
$poc++;
} 
?>
</main>
<pre>
    <?php print_r($_SESSION); ?>
</pre>
<script>
    $("body").attr("id","home");
</script>

<?php 
//VLOZENI PATICKY
require_once("sablona/paticka.php");
?>

