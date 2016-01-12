<?php
    include_once ("sablona/head.php"); 
	unset($_SESSION['id_uzivatel']);
	unset($_SESSION['login']);
?>

  <div class="container" id="login">
        <div class="login_blok">
           <form name="login_formular" method="post">
                <div class="blok_text">
                <h1>Přihlášení</h1>
                    <ul class="err">
                <?php
                    if( isset($_SESSION['pole_chyb']) && is_array($_SESSION['pole_chyb']) && count($_SESSION['pole_chyb']) >0 ) {
                    foreach($_SESSION['pole_chyb'] as $msg) {
                        echo '<li>',$msg,'</li>'; 
                        }
                    unset($_SESSION['pole_chyb']);
                    } 
			     ?>
                    </ul>
                    <ul>
                        <li><input type="text" name="login" id="user" placeholder="Uživatelské jméno"></li>
                        <li><input type="password" name="heslo" id="pass" placeholder="Heslo"></li>
                    </ul>
                
                </div>
                <button name="prihlasit" class="button" type="submit">Přihlásit</button>
            </form>
        </div>
    </div>

 <script class="cssdeck" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
    <?php 

    if(isset($_POST["prihlasit"]))
            $Uzivatele->prihlaseniBeznehoUzivatele($_POST["login"],$_POST["heslo"]);

    ?>
</body>
</html>