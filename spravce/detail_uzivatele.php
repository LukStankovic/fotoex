    <div id="main" class="uzivatele">
       <form method="post">
        <h1 class="page-header"><?php echo "$uzivatel->jmeno $uzivatel->prijmeni"; ?></h1>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="jmeno" class="control-label">Uživatelské jméno: </label>
                    <input type="text" class="form-control" name="login" value="<?php echo $uzivatel->login; ?>" required>
                </div>
                <hr>
                <div class="form-group">
                    <label for="nove_h" class="control-label">Nové heslo: </label>
                    <input type="password" class="form-control" name="nove_h" placeholder="Zadejte nové heslo">
                    <button type="submit" name="zmenit_heslo" class="ulozit btn pull-right">Změnit heslo</button>
                </div>
                <hr style="margin-top: 65px">
                <div class="form-group">
                    <label for="jmeno" class="control-label">Jméno: </label>
                    <input type="text" class="form-control" name="jmeno" value="<?php echo $uzivatel->jmeno; ?>" required>
                </div>
                <div class="form-group">
                    <label for="prijmeni" class="control-label">Příjmení: </label>
                    <input type="text" class="form-control" name="prijmeni" value="<?php echo $uzivatel->prijmeni; ?>" required>
                </div>
                <div class="form-group">
                    <label for="email" class="control-label">E-mail: </label>
                    <input type="email" class="form-control" name="email" value="<?php echo $uzivatel->email; ?>" required>
                </div>
                <div class="form-group">
                    <label for="telefon" class="control-label">Telefon: </label>
                    <input type="tel" class="form-control" name="telefon" value="<?php echo $uzivatel->telefon; ?>" required>
                </div>
                <div class="form-group">
                    <label for="prava" class="control-label">Práva: </label>
                    <select name="prava">
                        <option value="1" <?php if($uzivatel->prava==1)echo "selected";?>>Běžný uživatel</option>
                        <option value="2" <?php if($uzivatel->prava==2)echo "selected";?>>Administrator</option>
                    </select>                
                </div>
                <div class="form-group">
                    <label for="ulice" class="control-label">Ulice: </label>
                    <input type="text" class="form-control" name="ulice" value="<?php echo $uzivatel->ulice; ?>" required>
                </div>
                <div class="form-group">
                    <label for="mesto" class="control-label">Město: </label>
                    <input type="text" class="form-control" name="mesto" value="<?php echo $uzivatel->mesto; ?>" required>
                </div>
                <div class="form-group">
                    <label for="psc" class="control-label">PSČ: </label>
                    <input type="text" class="form-control" name="psc" value="<?php echo $uzivatel->psc; ?>" required>
                </div>
                <div class="form-group">
                    <label for="zeme" class="control-label">Země: </label>
                    <select name="zeme">
                        <option value="Česká republika" <?php if($uzivatel->zeme=="Česká republika")echo "selected"; ?>>Česká republika</option>
                        <option value="Slovenská republika" <?php if($uzivatel->zeme=="Slovenská republika")echo "selected"; ?>>Slovenská republika</option>
                    </select>
                </div>
            </div>
            <div class="col-md-7">
                 
                <div class="tabulka">
                    <table class="objednavky">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Datum</th>
                                <th>Stav</th>
                                <th>Cena celkem</th>
                                <th>Akce</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $pocet = null;    
                        foreach($objednavky as $i => $objednavka){ $pocet++
                    ?>
                            <tr class="<?php 
                            if($objednavka->stav == "Dokončeno") echo "dokonceno"; 
                            if($objednavka->stav == "Zrušeno") echo "zruseno";?>">
                                
                                <td><?php echo $objednavka->id_objednavka;?></td>
                                <td><?php echo date("j. n. Y, H:i:s",strtotime($objednavka->datum));?></td>       
                                
                                <td><?php echo $objednavka->stav;?></td>
                                <td><?php echo number_format($objednavka->celkem, 2, ',', ''); ?> Kč</td>  
                                <td>
                                    <a href="?page=detail-objednavky&id-objednavka=<?php echo $objednavka->id_objednavka;?>"><i class="fa fa-eye"></i></a>
                                    <a href="?page=detail-uzivatele&detail-uzivatele&id-uzivatele=<?php echo $uzivatel->id_uzivatel; ?>&id-objednavka=<?php echo $objednavka->id_objednavka;?>&akce=dokonceno"><i class="fa fa-check"></i></a>
                                    <a href="?page=detail-uzivatele&detail-uzivatele&id-uzivatele=<?php echo $uzivatel->id_uzivatel; ?>&id-objednavka=<?php echo $objednavka->id_objednavka;?>&akce=vymazat"><i class="fa fa-remove"></i></a>
                                </td>  
                            </tr>
                        <?php } ?>
                        </tbody>
                        <tfoot>
                            <td colspan="8">Počet objednávek: <?php echo $pocet; ?></td>
                        </tfoot>
                    </table>
                </div>
            
            </div>
        </div>
        
        <div class="btn"><a href="?page=uzivatele">← Zpět bez uložení</a></div>
        <button type="submit" name="ulozit" class="ulozit btn pull-right">Uložit úpravy uživatele</div>
        </form>
    </div>
<script>
    $('table').stacktable();
</script>
