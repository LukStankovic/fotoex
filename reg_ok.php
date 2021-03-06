<?php
    require_once ("sablona/head.php");
    require_once "php/recaptcha.php";
    $secret = "6LfRXxYTAAAAAOergRPPIZl0dkr1gcXiOMg55KXm";
    $response = null;
 
    $reCaptcha = new ReCaptcha($secret);

    if(isset($_POST["registrovat"])){
        if ($_POST["g-recaptcha-response"]) {
            $response = $reCaptcha->verifyResponse($_SERVER["REMOTE_ADDR"],$_POST["g-recaptcha-response"]);    
        }

        if ($response != null && $response->success) {
            if($_POST["heslo"] == $_POST["heslo_znova"]){
                if( ($Uzivatele->kontrolaRegistrace($_POST["login"])) == 1)
                    $Uzivatele->vlozeni($_POST);
                else
                   $chyba = "Účet s loginem ".$_POST["login"]." již existuje!";
            }
            else{
                $chyba = "Hesla musí být stejná";
            }
        }
        else{
            $chyba = "Nemohli jste být registrovaní.";
        }
    }
?>

<div class="container" id="registrace"> 
    <div class="registrace_blok">
            <div class="hlavicka">
                <?php if( isset($chyba) ){?>
                    <h1>Nebyli jste registrováni</h1>
                <?php } 
                    else{?>
                    <h1>Děkujeme!</h1>
                <?php }?>
            </div>
            
            <div class="inputy">
                 
                <?php 
                if(isset($chyba)){
                    echo "<p>$chyba</p>";
                }
                else{
                ?>
                <p>Děkujeme Vám za registraci. Váš profil <?php echo $_POST["login"]; ?> je ihned aktivní.</p>
                <?php }?>
                
                <?php if(isset($chyba)){ ?>
                    <a href="registrace.php" class="btn"><i class="fa fa-sign-in"></i> Zpět na registraci</a>
                <?php } 
                    else{ ?>
                    <a href="login.php" class="btn"><i class="fa fa-sign-in"></i> Přihlásit se</a>
                <?php } ?>
                <a href="index.php" class="btn"><i class="fa fa-home"></i> Zpět domů</a>
            </div> 
    </div>
</div>

<script class="cssdeck" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
</body>
</html>