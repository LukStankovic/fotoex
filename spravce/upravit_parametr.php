<?php

//IDENTIFIKACE PARAMETRU
$parametr_get = $_GET["kategorie"];
if($parametr_get == "formaty"){
    $parametr_nazev = "Formáty";
    $parametr_jed = "formát";
    $parametry = $Formaty->vse();
    if(isset($_POST["ulozit"])){
        $Formaty->upravit($_POST);
        header("Location: home.php?page=detail-parametru&kategorie=$parametr_get");
    }
}
if($parametr_get == "desky"){
    $parametr_nazev = "Desky";
    $parametr_jed = "deska";
    $parametry = $Desky->vse();
    if(isset($_POST["ulozit"])){
        $Desky->upravit($_POST);
        header("Location: home.php?page=detail-parametru&kategorie=$parametr_get");
    }
}
if($parametr_get == "materialy"){
    $parametr_nazev = "Materiály";
    $parametr_jed = "materiál";
    $parametry = $Materialy->vse();
    if(isset($_POST["ulozit"])){
        $Desky->upravit($_POST);
        header("Location: home.php?page=detail-parametru&kategorie=$parametr_get");
    }
}
if($parametr_get == "fotopapiry"){
    $parametr_nazev = "Fotopapíry";
    $parametr_jed = "fotopapír";
    $parametry = $Fotopapiry->vse();
    if(isset($_POST["ulozit"])){
        $Fotopapiry->upravit($_POST);
        header("Location: home.php?page=detail-parametru&kategorie=$parametr_get");
    }
}
if($parametr_get == "typy"){
    $parametr_nazev = "Typy";
    $parametr_jed = "typ";
    $parametry = $Typy->vse();
    if(isset($_POST["ulozit"])){
        $Typy->upravit($_POST);
        header("Location: home.php?page=detail-parametru&kategorie=$parametr_get");
    }
}

?>
	<div id="main " class="<?php echo $parametr_get; ?> detail_parametru">
       <form method="post">
        <?php 
            foreach($parametry as $parametr) { 
                if($parametr->id == $_GET["id-parametru"]){
        ?>
        <h1 class="page-header">Upravit "<?php echo $parametr->nazev;?>"</h1>   
        

                <input type="hidden" class="form-control" name="id" value="<?php echo $parametr->id; ?>">
                
                <div class="form-group">
                    <label for="nazev" class="control-label">Název: </label>
                    <input type="text" class="form-control" name="nazev" value="<?php echo $parametr->nazev; ?>" required>
                </div>
                <div class="form-group">
                    <label for="alias" class="control-label">Alias: </label>
                    <input type="text" class="form-control" name="alias" value="<?php echo $parametr->alias; ?>" required>
                </div>
                <div class="form-group">
                    <label for="nazev" class="control-label">Cena: </label>
                    <input type="number" class="form-control" name="cena" min="0" value="<?php echo $parametr->cena; ?>" required>
                </div>
                <div class="form-group">
                    <label for="popis" class="control-label">Krátký popis:</label>
                    <textarea  class="form-control" name="popis"><?php echo $parametr->popis; ?></textarea>
                </div>
            <?php } } ?>
        
        <div class="btn"><a href="?page=detail-parametru&kategorie=<?php echo $parametr_get;?>">← Zpět bez uložení</a></div>
        <button type="submit" name="ulozit" class="btn pull-right">Uložit</div>
        </form>
    </div>
<script>
    $("table").filterTable();
</script>