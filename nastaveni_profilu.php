<?php
    ob_start();
    require_once ("sablona/head.php");
    require_once("sablona/hlavicka.php");
    if(isset($_SESSION["id_uzivatel"])){
        $prihlaseny = $Uzivatele->detailUzivatele($_SESSION["id_uzivatel"]);
        $objednavky = $Objednavky->objednavkaOdUzivatele($_SESSION["id_uzivatel"]);
    }
    if(isset($_POST["ulozit_udaje"])){
        $Uzivatele->upravit($_SESSION["id_uzivatel"],$_POST);
        header("Location: nastaveni_profilu.php");
    }
    if(isset($_POST["zmenit_heslo"])){
        $Uzivatele->zmenitHeslo($_SESSION["id_uzivatel"],$_POST["nove_heslo"]);
        header("Location: nastaveni_profilu.php");
    }
?>

<div class="container" id="nastaveni_profilu"> 
    <?php if(isset($_SESSION["id_uzivatel"])){ ?>
        <div class="prihlasen">
           <form method="post">
            <h1>Dobrý den, <?php echo $_SESSION["login"];?>!</h1>
            <hr>
            <h2>Poslední objednávky</h2>
                <div class="tabulka">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Datum</th>
                                <th>Stav</th>
                                <th>Cena celkem</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        foreach($objednavky as $i => $objednavka){ ?>
                            <tr class="<?php 
                            if($objednavka->stav == "Dokončeno") echo "dokonceno"; 
                            if($objednavka->stav == "Zrušeno") echo "zruseno";?>">
                                
                                <td><?php echo $objednavka->id_objednavka;?></td>
                                <td><?php echo date("j. n. Y, H:i:s",strtotime($objednavka->datum));?></td>       
                                
                                <td><?php echo $objednavka->stav;?></td>
                                <td><?php echo number_format($objednavka->celkem, 2, ',', ''); ?> Kč</td>  
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            <hr>
            <h2>Osobní údaje</h2>
                <div class="form-group">
                    <input type="text" class="jmeno form-control vedle leva" name="jmeno" maxlength="50" value="<?php echo $prihlaseny->jmeno; ?>" placeholder="Jméno *">    
                    <input type="text" class="prijmeni form-control vedle" name="prijmeni" maxlength="50" value="<?php echo $prihlaseny->prijmeni; ?>" placeholder="Příjmení *">    
                </div>
                <div class="form-group">
                    <input type="email" class="email form-control vedle leva" name="email" maxlength="50" value="<?php echo $prihlaseny->email; ?>" placeholder="E-mail *">    
                    
                    <input type="tel" class="telefon form-control vedle" name="telefon" maxlength="13" value="<?php echo $prihlaseny->telefon; ?>" placeholder="Telefon *">    
                </div>
            <hr>
            <h2>Adresa</h2>
                <div class="form-group">
                    <input type="text" class="form-control vedle leva" name="ulice" value="<?php echo $prihlaseny->ulice; ?>" placeholder="Ulice *" required>    

                    <input type="text" class="form-control vedle" name="mesto" value="<?php echo $prihlaseny->mesto; ?>" placeholder="Město *" required>    
                </div>
                <div class="form-group">
                    <input type="text" class="form-control vedle leva" name="psc" maxlength="5" value="<?php echo $prihlaseny->psc; ?>" placeholder="PSČ *" required>    

                    <select name="zeme" class="upravit_pole">
                        <option <?php if($prihlaseny->zeme == "Česká republika") echo "selected"; ?> value="Česká republika">Česká republika</option>
                        <option <?php if($prihlaseny->zeme == "Slovenská republika") echo "selected"; ?> value="Slovenská republika">Slovenská republika</option>
                    </select>
                </div>
                <button type="submit" name="ulozit_udaje" class="ulozit btn">Uložit údaje</button>
            <hr>
            <h2>Změna hesla</h2>
            <div class="form-group">
                <input type="password" class="form-control" name="nove_heslo" placeholder="Zadejte nové heslo">
                <button type="submit" name="zmenit_heslo" class="ulozit btn">Změnit heslo</button>
            </div>
            <hr>
            <a href="index.php" class="btn"><i class="fa fa-home"></i> Zpět domů</a>
            </form>

            
        </div>
        
        
        
    <?php }else{ ?>
        <div class="neni_prihlasen">
            <p>Nejste přihlášeni!</p>
            <a href="index.php" class="btn"><i class="fa fa-home"></i> Zpět domů</a>
            <a href="login.php" class="btn"><i class="fa fa-sign-in"></i> Přihlásit</a>
        </div>
    <?php } ?>
</div>

<script class="cssdeck" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<?php 
//VLOZENI PATICKY
require_once("sablona/paticka.php");
ob_flush();
?>