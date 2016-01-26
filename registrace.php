<?php
    require_once ("sablona/head.php");
    require_once "php/recaptcha.php";

    $secret = "";
    $response = null;
 
    $reCaptcha = new ReCaptcha($secret);
    
    if(isset($_POST["registrovat"])){
        if ($_POST["g-recaptcha-response"]) {
            $response = $reCaptcha->verifyResponse($_SERVER["REMOTE_ADDR"],$_POST["g-recaptcha-response"]);    
        }

        if ($response != null && $response->success) {
            echo "Úspěšné";
        }
        else{
            $chyba = "Nemohli jste být registrovaní, protože jste nevyplnili všechny údaje.";
        }
    }
?>

<div class="container" id="registrace"> 
    <div class="registrace_blok">
        <form name="registrace_formular" method="post">    
            <div class="hlavicka">
                <h1>Registrace</h1>
            </div>
            
            <?php 
                if(isset($chyba))
                    echo $chyba;
            ?>
            <div class="inputy">
                <div class="form-group">
                    <input type="text" class="form-control cele" name="dor_jmeno" maxlength="50" placeholder="Přihlašovací jméno">    
                </div>
                <div class="form-group">                
                    <input type="password" class="form-control cele" name="dor_prijmeni" maxlength="60" placeholder="Heslo">    
                </div>
                <div class="form-group">
                    <input type="text" class="form-control vedle leva" name="dor_jmeno" maxlength="50" placeholder="E-mail">    
                    
                    <input type="text" class="form-control vedle" name="dor_prijmeni" maxlength="13" placeholder="Telefon">    
                </div>
                <hr>
                <div class="form-group">
                    <input type="text" class="form-control vedle leva" name="dor_jmeno" maxlength="50" placeholder="Jméno">    
                    
                    <input type="text" class="form-control vedle" name="dor_prijmeni" maxlength="50" placeholder="Příjmení">    
                </div>
                <div class="form-group">
                    <input type="text" class="form-control vedle leva" name="dor_ulice" maxlength="50" placeholder="Ulice"> 
                    <input type="text" class="form-control vedle" name="dor_mesto" maxlength="30" placeholder="Město">    
                </div>
                <div class="form-group">
                    <input type="text" class="form-control vedle leva" name="dor_psc" maxlength="5" placeholder="PSČ"> 
                    <select name="dor_zeme" class="upravit_pole">
                        <option value="Česká republika">Česká republika</option>
                        <option value="Slovenská republika">Slovenská republika</option>
                    </select>
                </div>
            </div>
            <div class="g-recaptcha captcha" data-sitekey="6LfRXxYTAAAAAPXgCErqkzUUtxBS3y9lmcIQA6Ox"></div>
            <button name="registrovat" class="button" type="submit">Registrovat</button> 
        </form>
    </div>
</div>

<script class="cssdeck" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script src='https://www.google.com/recaptcha/api.js?hl=cs'></script>

</body>
</html>