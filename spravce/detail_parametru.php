<?php

//IDENTIFIKACE PARAMETRU
$parametr_get = $_GET["kategorie"];
if($parametr_get == "formaty"){
    $parametr_nazev = "Formáty";
    $parametr_jed = "formát";
    $parametry = $Formaty->vse();
}
if($parametr_get == "desky"){
    $parametr_nazev = "Desky";
    $parametr_jed = "deska";
    $parametry = $Desky->vse();
}
if($parametr_get == "materialy"){
    $parametr_nazev = "Materiály";
    $parametr_jed = "materiál";
    $parametry = $Materialy->vse();
}
if($parametr_get == "fotopapiry"){
    $parametr_nazev = "Fotopapíry";
    $parametr_jed = "fotopapír";
    $parametry = $Fotopapiry->vse();
}
if($parametr_get == "typy"){
    $parametr_nazev = "Typy";
    $parametr_jed = "typ";
    $parametry = $Typy->vse();
}

//VYTVOŘENÍ/ULOŽENÍ NOVÉHO PARAMETRU

    if($parametr_get == "formaty"){
        //SMAZÁNÍ PARAMETRU
        if((isset($_GET["akce"]))&&($_GET["akce"]=="vymazat")){
            $Formaty->vymazat($_GET["id-parametru"]);
            header("Location: home.php?page=detail-parametru&kategorie=$parametr_get");
        }
        //ULOŽENÍ/VYTVOŘENÍ NOVÉHO PARAMETRU
        if(isset($_POST["ulozit"])){
            $Formaty->vlozeni($_POST["nazev"],$_POST["alias"],$_POST["cena"],$_POST["popis"]); 
            header("Location: home.php?page=detail-parametru&kategorie=$parametr_get");
        }
    }
    if($parametr_get == "desky"){
        //SMAZÁNÍ PARAMETRU
        if((isset($_GET["akce"]))&&($_GET["akce"]=="vymazat")){
            $Desky->vymazat($_GET["id-parametru"]);
            header("Location: home.php?page=detail-parametru&kategorie=$parametr_get");
        }
        //ULOŽENÍ/VYTVOŘENÍ NOVÉHO PARAMETRU
        if(isset($_POST["ulozit"])){
            $Desky->vlozeni($_POST["nazev"],$_POST["alias"],$_POST["cena"],$_POST["popis"]); 
            header("Location: home.php?page=detail-parametru&kategorie=$parametr_get");
        }
    }
    if($parametr_get == "materialy"){
        //SMAZÁNÍ PARAMETRU
        if((isset($_GET["akce"]))&&($_GET["akce"]=="vymazat")){
            $Materialy->vymazat($_GET["id-parametru"]);
            header("Location: home.php?page=detail-parametru&kategorie=$parametr_get");
        }
        //ULOŽENÍ/VYTVOŘENÍ NOVÉHO PARAMETRU
        if(isset($_POST["ulozit"])){
            $Materialy->vlozeni($_POST["nazev"],$_POST["alias"],$_POST["cena"],$_POST["popis"]); 
            header("Location: home.php?page=detail-parametru&kategorie=$parametr_get");
        }
    }
    if($parametr_get == "fotopapiry"){
        //SMAZÁNÍ PARAMETRU
        if((isset($_GET["akce"]))&&($_GET["akce"]=="vymazat")){
            $Fotopapiry->vymazat($_GET["id-parametru"]);
            header("Location: home.php?page=detail-parametru&kategorie=$parametr_get");
        }
        //ULOŽENÍ/VYTVOŘENÍ NOVÉHO PARAMETRU
        if(isset($_POST["ulozit"])){
            $Fotopapiry->vlozeni($_POST["nazev"],$_POST["alias"],$_POST["cena"],$_POST["popis"]); 
            header("Location: home.php?page=detail-parametru&kategorie=$parametr_get");
        }
    }
    if($parametr_get == "typy"){
        //SMAZÁNÍ PARAMETRU
        if((isset($_GET["akce"]))&&($_GET["akce"]=="vymazat")){
            $Typy->vymazat($_GET["id-parametru"]);
            header("Location: home.php?page=detail-parametru&kategorie=$parametr_get");
        }
        //ULOŽENÍ/VYTVOŘENÍ NOVÉHO PARAMETRU
        if(isset($_POST["ulozit"])){
            $Typy->vlozeni($_POST["nazev"],$_POST["alias"],$_POST["cena"],$_POST["popis"]); 
            header("Location: home.php?page=detail-parametru&kategorie=$parametr_get");
        }
    }


    
?>
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
                    <th>Akce</th>
                </thead>
                <tbody>
                <?php foreach($parametry as $parametr) { ?>
                   <?php if(($parametr_get != "fotopapiry" || $parametr_get != "materialy") && $parametr->id != 0) { ?>
                    <tr>
                    <?php foreach($parametr as $parametr_radek){?>    
                        <td><?php echo $parametr_radek; ?></td>  
                    <?php } ?>
                        <td>
                            <a href="?page=upravit-parametr&kategorie=<?php echo $parametr_get; ?>&id-parametru=<?php echo $parametr->id; ?>"><i class="fa fa-pencil"></i></a>
                            <a href="?page=detail-parametru&kategorie=<?php echo $parametr_get; ?>&akce=vymazat&id-parametru=<?php echo $parametr->id; ?>"><i class="fa fa-remove"></i></a>
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
                    <td>Upravit | vymazat</td>
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
                    <input type="text" class="form-control" name="nazev" required>
                </div>
                <div class="form-group">
                    <label for="alias" class="control-label">Alias: </label>
                    <input type="text" class="form-control" name="alias" required>
                </div>
                <div class="form-group">
                    <label for="nazev" class="control-label">Cena: </label>
                    <input type="number" class="form-control" name="cena" min="0" value="0" required>
                </div>
                <div class="form-group">
                    <label for="popis" class="control-label">Krátký popis:</label>
                    <textarea  class="form-control" name="popis"></textarea>
                </div>
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Zrušit</button>
       <!-- <button type="button" name="ulozit" class="btn btn-primary">Uložit</button>-->
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
</script>