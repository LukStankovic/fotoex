<?php
    require_once ("sablona/head.php");
    require_once "php/recaptcha.php";

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
            <h1>Registrace</h1>
            <?php 
                if(isset($chyba))
                    echo $chyba;
            ?>
            <ul>
                <li><input type="text" name="login" id="user" placeholder="Uživatelské jméno"></li>
                <li><input type="password" name="heslo" id="pass" placeholder="Heslo"></li>
            </ul>
            <div class="g-recaptcha" data-sitekey="6LfRXxYTAAAAAPXgCErqkzUUtxBS3y9lmcIQA6Ox"></div>
            <button name="registrovat" class="button" type="submit">Registrovat</button> 
        </form>
    </div>
</div>

<script class="cssdeck" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script src='https://www.google.com/recaptcha/api.js?hl=cs'></script>

</body>
</html>