	<div id="main " class="<?php echo $parametr_get; ?> detail_parametru">
        <h1 class="page-header"><?php echo $parametr_nazev; ?></h1>

        <div class="btn novy">
            <a href="#" data-toggle="modal" data-target="#modalniOkno">
                <?php if($parametr_jed == "deska"){ ?>
                    Vytvořit novou desku
                <?php } else { ?>
                    Vytvořit nový <?php echo $parametr_jed ?>
                <?php }?>
            </a>
        </div>
        <div class="tabulka">
            <table>
                <thead>
                    <th>ID</th>
                    <th>Název</th>
                    <th>Alias</th>
                    <th>Cena</th>
                    <th>Popis</th>
                    <th>Upravit</th>
                    <th>Vymazat</th>
                </thead>
                <tbody>
                <?php foreach($parametry as $parametr) { ?>
                   <?php if(($parametr_get != "fotopapiry" || $parametr_get != "materialy") && $parametr->id != 0) { ?>
                    <tr>
                    <?php foreach($parametr as $i => $parametr_radek){?>  
                        <?php if($i!="cena"){ ?>  
                        <td><?php echo $parametr_radek; ?></td>  
                        <?php } else { ?>
                        <td><?php echo number_format($parametr_radek, 2, ',', '')." Kč"; ?></td>  
                        <?php }?>
                    <?php } ?>
                        <td>
                            <a href="?page=upravit-parametr&kategorie=<?php echo $parametr_get; ?>&id-parametru=<?php echo $parametr->id; ?>"><i class="fa fa-pencil"></i></a>
                        </td>
                        <td>
                            <?php if($parametr_get == "formaty") { ?>
                                <?php if($Formaty->kontrola($parametr->id)){?>
                                    <a href="?page=detail-parametru&kategorie=<?php echo $parametr_get; ?>&akce=vymazat&id-parametru=<?php echo $parametr->id; ?>"><i class="fa fa-remove"></i></a>
                                <?php } ?>
                            <?php }?>
                            <?php if($parametr_get == "desky") { ?>
                                <?php if($Desky->kontrola($parametr->id)){?>
                                    <a href="?page=detail-parametru&kategorie=<?php echo $parametr_get; ?>&akce=vymazat&id-parametru=<?php echo $parametr->id; ?>"><i class="fa fa-remove"></i></a>
                                <?php } ?>
                            <?php }?>
                            <?php if($parametr_get == "fotopapiry") { ?>
                                <?php if($Fotopapiry->kontrola($parametr->id)){?>
                                    <a href="?page=detail-parametru&kategorie=<?php echo $parametr_get; ?>&akce=vymazat&id-parametru=<?php echo $parametr->id; ?>"><i class="fa fa-remove"></i></a>
                                <?php } ?>
                            <?php }?>
                            <?php if($parametr_get == "materialy") { ?>
                                <?php if($Materialy->kontrola($parametr->id)){?>
                                    <a href="?page=detail-parametru&kategorie=<?php echo $parametr_get; ?>&akce=vymazat&id-parametru=<?php echo $parametr->id; ?>"><i class="fa fa-remove"></i></a>
                                <?php } ?>
                            <?php }?>
                            <?php if($parametr_get == "typy") { ?>
                                <?php if($Typy->kontrola($parametr->id)){?>
                                    <a href="?page=detail-parametru&kategorie=<?php echo $parametr_get; ?>&akce=vymazat&id-parametru=<?php echo $parametr->id; ?>"><i class="fa fa-remove"></i></a>
                                <?php } ?>
                            <?php }?>
                            
                        </td>
                    </tr>
                <?php } } ?>
                </tbody>
                <tfoot>
                    <td></td>
                    <td>Bude zobrazen v roletce pro uživatele</td>
                    <td>Název pro systém</td>
                    <td>Cena v Kč</td>
                    <td>Popis položky - není povinný</td>
                    <td>Upravit</td>
                    <td>Vymazat</td>
                </tfoot>
            </table>
        </div>        
        <div class="btn"><a href="home.php?page=parametry">← Zpět na parametry</a></div> 

<!-- Modal -->
<div class="modal fade" id="modalniOkno" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
       <form method="post">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">                
                <?php if($parametr_jed == "deska"){ ?>
                    Vytvořit novou desku
                <?php } else { ?>
                    Vytvořit nový <?php echo $parametr_jed ?>
                <?php }?></h4>
      </div>
      <div class="modal-body">
            
                <div class="form-group">
                    <label for="nazev" class="control-label">Název: </label>
                    <input type="text" maxlength="50" class="form-control" name="nazev" required>
                </div>
                <div class="form-group">
                    <label for="alias" class="control-label">Alias: </label>
                    <input type="text" maxlength="50" class="form-control" name="alias" required>
                </div>
                <div class="form-group">
                    <label for="nazev" class="control-label">Cena: </label>
                    <input type="number" class="form-control" name="cena" min="0" value="0" required>
                </div>
                <div class="form-group">
                    <label for="popis" class="control-label">Krátký popis:</label>
                    <textarea class="form-control" name="popis"></textarea>
                </div>
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default zrusit" data-dismiss="modal">Zrušit</button>
        <input type="submit" name="ulozit" class="btn btn-primary ulozit" value="Uložit">
      </div>
          </form>

    </div>
  </div>
</div>
<!-- KONEC MODALU -->    
   
    
    </div>
<script>
    $("table").filterTable();
    $('table').stacktable();
</script>