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
                   
                   <?php  echo "<pre>",print_r($clanky),"</pre>";?>
                   <?php foreach($clanky as $clanek){ ?>

                       
                       </article>
                    <?php } ?>
                </div> 
            </div>

        </main>
        
<?php 
//VLOZENI PATICKY
include_once("sablona/paticka.php");
?>