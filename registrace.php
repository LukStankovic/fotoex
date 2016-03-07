<?php
    require_once ("sablona/head.php");
    require_once "php/recaptcha.php";

?>

<div class="container" id="registrace"> 
    <div class="registrace_blok">
        <form name="registrace_formular" id="formular" method="post" action="reg_ok.php">    
            <div class="hlavicka">
                <h1>Registrace</h1>
            </div>
            
            <?php 
                if(isset($chyba))
                    echo $chyba;
            ?>
            <div class="inputy">
                <div class="form-group">
                    <input type="text" class="login form-control cele" name="login" maxlength="50" placeholder="Přihlašovací jméno *">    
                </div>
                <div class="form-group">                
                    <input type="password" class="heslo form-control vedle leva" name="heslo" maxlength="60" placeholder="Heslo *">
                    <input type="password" class="heslo_znova form-control vedle" name="heslo_znova" maxlength="60" placeholder="Heslo znova *">    
                </div>
                <div class="form-group">
                    <input type="email" class="email form-control vedle leva" name="email" maxlength="50" placeholder="E-mail *">    
                    
                    <input type="tel" class="telefon form-control vedle" name="telefon" maxlength="16" placeholder="Telefon *">    
                </div>
                <hr>
                <div class="form-group">
                    <input type="text" class="jmeno form-control vedle leva" name="jmeno" maxlength="50" placeholder="Jméno *">    
                    <input type="text" class="prijmeni form-control vedle" name="prijmeni" maxlength="50" placeholder="Příjmení *">    
                </div>
                <div class="form-group">
                    <input type="text" class="ulice form-control vedle leva" name="ulice" maxlength="50" placeholder="Ulice *"> 
                    <input type="text" class="mesto form-control vedle" name="mesto" maxlength="30" placeholder="Město *">    
                </div>
                <div class="form-group">
                    <input type="text" class="psc form-control vedle leva" name="psc" maxlength="5" placeholder="PSČ *"> 
                    <select name="zeme" class="upravit_pole">
                        <option value="Česká republika">Česká republika</option>
                        <option value="Slovenská republika">Slovenská republika</option>
                    </select>
                </div>
                <div class="g-recaptcha captcha" data-sitekey="6LfRXxYTAAAAAPXgCErqkzUUtxBS3y9lmcIQA6Ox"></div>
                <a href="javascript: window.history.back()" class="btn"><i class="fa fa-arrow-left"></i> Zpět</a>
                <button name="registrovat" class="registrovat btn" type="submit" disabled="disabled">Registrovat</button>
            </div> 
        </form>
    </div>
</div>

<script class="cssdeck" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script src='https://www.google.com/recaptcha/api.js?hl=cs'></script>
<script>
$(function(){
    $("input").each(function(){
        $(this).change(function(){
            if($(this).val() == ""){
                $(this).css("border","2px solid #ea6153");
            }
            else{
                                
                if($(this).hasClass("heslo")){
                    $(".heslo_znova").css("border","2px solid #ea6153");
                    $(".heslo").css("border","2px solid #2ecc71");
                }

                else{
                    if($(this).hasClass("heslo_znova")){
                        if($(this).val() == $(".heslo").val()){
                            $(this).css("border","2px solid #2ecc71");
                        }
                        else{
                            $(this).css("border","2px solid #ea6153");
                        }
                    }
                    else{
                        $(this).css("border","2px solid #2ecc71");
                    }
                }
            }
        });
    });
    
    $('input').change(function(e) {
        if ($('input').map(function(idx, elem) {
                if ($(elem).val() === "") return $(elem);
            }).size() > 0){
            
            console.log("nič");
            $('.registrovat').prop("disabled", true);
        }
        else{ //KDYŽ JE VŠE VYPLNĚNO
            if($(this).hasClass("heslo_znova")){
                if($(this).val() == $(".heslo").val()){
                    $('.registrovat').prop("disabled", false);
                   console.log("ok");
                }
                else{
                    console.log("niet");
                    $('.registrovat').prop("disabled", true);
                }
            }
            else if($(this).hasClass("heslo")){
                if($(this).val() == $(".heslo_znova").val()){
                    $('.registrovat').prop("disabled", false);
                   console.log("ok");
                }
                else{
                    console.log("niet");
                    $('.registrovat').prop("disabled", true);
                }
            }
            else{
                $('.registrovat').prop("disabled", false);
                console.log("ok");
            }
            
        }
    });
    
    
});
</script>
</body>
</html>