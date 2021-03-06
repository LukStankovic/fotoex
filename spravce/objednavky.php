    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">Objednávky</h1>
        </div>
    </div>

	<div id="main" class="objednavky">
		<div class="row">

				<div class="col-md-12">
					
                    <p>Počet objednávek: <?php echo $pocet_obj; ?></p>
					<div class="tabulka">
                        <table class="objednavky">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Jméno</th>
                                    <th>Příjmení</th>
                                    <th>Adresa</th>
                                    <th>Datum</th>
                                    <th>Stav</th>
                                    <th>Cena celkem</th>
                                    <th>Akce</th>
                                </tr>
                            </thead>
                            <tbody>
                   <?php 
                        $predchozi_id = null;
                        foreach($vsechny_objednavky as $i => $objednavka){
                            ?>
                            <tr class="<?php 
                                if($objednavka->stav == "Dokončeno") echo "dokonceno"; 
                                if($objednavka->stav == "Zrušeno") echo "zruseno";
                                ?>">
                                <td><?php echo $objednavka->id_objednavka;?></td>
                                <td><?php echo $objednavka->f_jmeno;?></td>   
                                <td><?php echo $objednavka->f_prijmeni;?></td>
                                <td>
                                    <?php echo $objednavka->f_ulice;?>,
                                    <?php echo $objednavka->f_mesto;?>,<br>
                                    <?php echo $objednavka->f_psc;?>,
                                    <?php echo $objednavka->f_zeme;?>
                                </td>   
                                <td><?php echo date("j. n. Y, H:i:s",strtotime($objednavka->datum));?></td>       
                                
                                
                                <td><?php echo $objednavka->stav;?></td>
                                <td><?php echo number_format($objednavka->celkem, 2, ',', ''); ?> Kč</td>  
                                <td>
                                    <a href="?page=detail-objednavky&id-objednavka=<?php echo $objednavka->id_objednavka;?>"><i class="fa fa-eye"></i></a>
                                    <a href="?page=objednavky&akce=dokonceno&id-objednavka=<?php echo $objednavka->id_objednavka;?>"><i class="fa fa-check"></i></a>
                                    <a href="?page=objednavky&akce=vymazat&id-objednavka=<?php echo $objednavka->id_objednavka;?>"><i class="fa fa-remove"></i></a>
                                    </td>  
                            </tr>
                            <?php    
                     
                            $predchozi_id = $objednavka->id_objednavka;
                        }    
                ?>
                           </tbody>
                           <tfoot>
                               <td colspan="8">Počet objednávek: <?php echo $pocet_obj; ?></td>
                           </tfoot>
                        </table>
                    </div>
						
			</div>
			</div>
        
		</div>

</div>
<script>
    $("table").filterTable();
    $('table').stacktable();
</script>