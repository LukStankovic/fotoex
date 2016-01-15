<?php
    require_once ("sablona-spravce/head.php"); 
    $vsechny_clanky = $Clanky->dataZeVsechClanku();
    $vsechny_kategorie = $Kategorie->dataVsechKategorii();

    if(isset($_POST["odeslat"])){
        $Clanky->editace($_POST["id_c"],$_POST["nazev"],$_POST["kategorie"],$_POST["text_clanku"]);
    }
    
?>

<body>
    <div id="wrapper">

        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Navigace</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>        
                </button>
                <a class="navbar-brand" href="../index.php" target="_blank">Blog Lukáše Stankoviče</a>               
            </div>
            <ul class="navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i><i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="?page=profil"><i class="fa fa-user fa-fw"></i> Profil</a></li>
                        <li><a href="?page=nastaveni-profilu"><i class="fa fa-gear fa-fw"></i> Nastavení profilu</a></li>
                        <li class="divider"></li>
                        <li><a href="index.php"><i class="fa fa-sign-out fa-fw"></i> Odhlásit se</a></li>
                    </ul>
                </li>
            </ul>
            <div class="navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul id="side-menu">
                        <li class="<?php if((isset($_GET["page"])) and ($_GET["page"] == "nastenka")) echo "active";?>"><a href="home.php?page=nastenka"><div class="ikona-menu"><i class="fa fa-tachometer"></i></div><div class="popisy">Nástěnka</div></a></li>
                        <li class="<?php if((isset($_GET["page"])) and ($_GET["page"] == "obsah")) echo "active";?>"><a href="home.php?page=obsah"><div class="ikona-menu"><i class="fa fa-pencil"></i></div><div class="popisy">Obsah</div></a></li>
                        <li class="<?php if((isset($_GET["page"])) and ($_GET["page"] == "uzivatele")) echo "active";?>"><a href="home.php?page=uzivatele"><div class="ikona-menu"><i class="fa fa-users"></i></div><div class="popisy">Uživatelé</div></a></li>    
                        
                    </ul>
                </div>
            </div>
        </nav>
        <div id="page-wrapper">
        	    <div class="row">
        			<div class="col-lg-12">
        			    <h1 class="page-header">Úpravy článku</h1>
        			</div>
   				</div>

		<div id="main">
            <?php foreach($vsechny_clanky as $clanek) {
                if ($clanek->id_clanku == $_GET["id-clanku"]){
            ?>
			<form method="post" action="">
				<p><label>Název článku: </label><input type="text" name="nazev" value="<?= $clanek->nazev ?>" placeholder="Název článku"></p>
                <p><label>Kategorie článku:</label>
                	<select name="kategorie">
                        <?php foreach($vsechny_kategorie as $kategorie){
                                if($kategorie->id_kategorie == $clanek->id_kategorie)    
                                    echo "<option value='".$kategorie->id_kategorie."' selected>$kategorie->nazev_kategorie</option>";
                                else 
                                    echo "<option value='".$kategorie->id_kategorie."'>$kategorie->nazev_kategorie</option>";

                            }
                        ?>

				    </select>
				
				</p>
				<label>ID článku: </label><input type="text" name="id_c" disabled="disabled" value="<?= $clanek->id_clanku ?>"></input>
				<div style="float:left!iportant; margin-left:0px;">
                <textarea name="text_clanku" id="uvod" rows="20" cols="55">
					   <?= $clanek->text_clanku ?>
				</textarea>
				</div>
				<p class="paticka_form"><input type="submit" class="button" value="Upravit" name="odeslat"></p>
			</form>
            <?php 
                } 
            } ?>

		   </div>
        </div>
    </div>
	<script type="text/javascript" src="tinymce/tinymce.min.js"></script> 			
	<script type="text/javascript">
	         tinymce.init({
	                selector: "textarea[name=text_clanku]",
	                plugins: [
	                        "advlist autolink lists link image charmap print preview anchor",
	                        "searchreplace visualblocks code fullscreen",
	                        "insertdatetime media table contextmenu paste",
	                    	"autoresize"
	                ],
	                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
	                entities: "160,nbsp",
	                entity_encoding: "named",
	                entity_encoding: "raw",
	                theme: "modern",
	                width: '80%',
					height: 400,
					autoresize_min_height: 400,
					autoresize_max_height: 800,
					language : "cs"
	         });
	</script>
</body>
</html>