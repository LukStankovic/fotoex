<?php 

//VLOZENI <HEAD>
include_once("sablona/head.php");
//VLOZENI headeru, loga a menu
include_once("sablona/hlavicka.php");
$vsichni_uzivatele = $Uzivatele->dataVsechUzivatelu();
$vsechny_objednavky = $Objednavky->vse();
$vsechny_fotky = $Fotky->vse();
?>  
        <main class="nahrani">
            <div class="container stranka">

                <div class="obsah">
                <?php 
                    $pomo = 0;
                    foreach($vsechny_objednavky as $i => $objednavka){
                        if($objednavka->id_objednavka != $pomo)
                            echo "<div style='width:100%;height:10px;background:#CDDC39; margin: 30px 0;'></div>";
                        
                        foreach($objednavka as $k => $zaznam_obj){
                            if($k == "id_objednavka")
                                $pomo = $zaznam_obj;
                                
                            if($k == "url"){    
                                echo "<span style='width:300px; display:inline-block;font-weight:bold;'>$k:</span>";
                                echo "<img src='$zaznam_obj'><br>";
                            }
                            else
                                echo "<span style='width:300px; display:inline-block;font-weight:bold;'>$k:</span> $zaznam_obj<br>";
                        }
                    }
                ?>
                </div> 
            </div>

        </main>
        
<?php 
//VLOZENI PATICKY
include_once("sablona/paticka.php");
?>