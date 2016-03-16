        <?php 
        if(isset($_POST["odhlasit"])){
            unset($_SESSION["id_uzivatel"]);
            unset($_SESSION["login"]);
            header("location: index.php");
        } 
        ?>
        <header>
        <div class="login-block">
           <div class="container">
            <ul class="pull-right">
               <?php if(!isset($_SESSION["id_uzivatel"])){?>
                <li><a href="login.php">Přihlásit se</a></li>
                <li><a href="registrace.php">Registrovat se</a></li>
                <?php } else { ?>
                <li><a href="nastaveni_profilu.php">Přihlášený: <?php echo $_SESSION["login"]; ?></a></li>
                <li><form method="POST"><button type="submit" name="odhlasit">Odhlásit se</button></form></li>
                <?php }?>
            </ul>
            </div>
        </div>
                <nav class="container">
                    <a class="logo pull-left" href="index.php"><img src="img/logo.png" alt="logo"></a>
                    <ul class="hlavni-navigace pull-right">
                        <li><a href="nahrani.php">Vyvolat fotografie</a></li>
                        <li><a href="onas.php">O nás</a></li>
                        <li><a href="kontakt.php">Kontakt</a></li>
                    </ul>
                </nav>
                <div class="mobilni-navigace container">
                    <a class="mobilni-nav-tlacitko" role="button" data-toggle="collapse" href="#mobilni-menu" aria-expanded="false" aria-controls="mobilni-menu"><i class="fa fa-bars"></i></a>
                    <div class="collapse" id="mobilni-menu">
                        <ul>
                            <li><a href="nahrani.php">Vyvolat fotografie</a></li>
                            <li><a href="onas.php">O nás</a></li>
                            <li><a href="kontakt.php">Kontakt</a></li>
                        </ul>
                    </div>
                </div>
            <div class="uvodni-text">
                <span class="intro">Tiskárna fotografií nové generace</span>
                <div class="vyvolat"><a href="nahrani.php" class="btn">Vyvolat fotografie</a></div>
            </div>
        </header>    