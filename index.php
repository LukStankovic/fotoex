<?php 
//VLOZENI <HEAD> VČETNĚ KONFIGURACE
include_once("sablona/head.php");
//VLOZENI headeru, loga a menu
include_once("sablona/hlavicka.php");
$clanky = $Clanky->vse();
?>

        <main class="uvod">
            <div class="container stranka">
                <div class="uvod-banner">
                    <div class="row">
                        <div class="col-md-9">
                            Využijte náš moderní způsob pro vyvolání Vašich fotografií z domova. Vše Vám zabere jen pár minut.
                        </div>
                        <div class="col-md-3 tlacitko"><a href="nahrani.php" class="btn">Vyvolat fotografie</a></div> 
                    </div>       
                </div>
                <div class="obsah">
                    <h1>Novinky ze světa fotografií</h1>
                    <?php foreach($clanky as $clanek){ ?>
                    <article>
                         
                        <div class="cover">
                            <a href="#"><img src="clanky/<?php echo $clanek->cover; ?>"></a>
                        </div>
                        <div class="clanek">
                            <h2><a href="#"><?php echo $clanek->nazev; ?></a></h2>
                            <div class="info"><i class="fa fa-user"></i><?php echo $clanek->jmeno." ".$clanek->prijmeni; ?></div>
                            <div class="info"><i class="fa fa-calendar"></i> <?php echo date( 'd. m. Y', strtotime($clanek->datum));?></div>
                            <div class="text">
                                <?php echo substr($clanek->obsah,0,400)."..."; ?>    
                            </div>
                            
                        </div>
                    </article>
                    <?php } ?>                   
                   
                   
                   

                </div> 
            </div>

        </main>
        
<?php 
//VLOZENI PATICKY
include_once("sablona/paticka.php");
?>