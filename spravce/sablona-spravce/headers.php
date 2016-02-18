<?php

/********************
  OBJEDNÁVKY
*********************/
if((isset($_GET["page"])) and ($_GET["page"] == "objednavky")){
    $vsichni_uzivatele = $Uzivatele->vse();
    $vsechny_objednavky = $Objednavky->vse();
    $vsechny_fotky = $Fotky->vse();
    $pocet_obj = null;
    $predchozi_id = null;
    foreach($vsechny_objednavky as $i => $objednavka){
        if($predchozi_id != $objednavka->id_objednavka)
            $pocet_obj++;
        $predchozi_id = $objednavka->id_objednavka;
    }
    if((isset($_GET["akce"]))&&($_GET["akce"]=="dokonceno")){
        $Objednavky->dokonceno($_GET["id-objednavka"]);
        header("Location: home.php?page=objednavky");
    }
    if((isset($_GET["akce"]))&&($_GET["akce"]=="vymazat")){
        $Objednavky->vymazat($_GET["id-objednavka"]);
        header("Location: home.php?page=objednavky");
    }
}
/********************
  OBJEDNÁVKA - DETAIL
*********************/

if((isset($_GET["page"])) and ($_GET["page"] == "detail-objednavky")){

    $vsichni_uzivatele = $Uzivatele->vse();
    $objednavka_pole = $Objednavky->detailObjednavky($_GET["id-objednavka"]);
    $objednavka = $objednavka_pole[0];
    $vsechny_fotky = $Fotky->detailFotek($_GET["id-objednavka"]);
    $pocet = 0;
    $id_objednavka = $_GET["id-objednavka"];
    foreach($vsechny_fotky as $fotka)
        $pocet++;
    if(isset($_GET["action"]) and $_GET["action"]=="vymazat"){
        $Fotky->vymazat($_GET["id-fotka"]);
        header("Location: home.php?page=detail-objednavky&id-objednavka=".$_GET["id-objednavka"]);
    }

    if(isset($_POST["ulozit"])){
        $Objednavky->upravit($_GET["id-objednavka"],$_POST);
        header("Location: home.php?page=detail-objednavky&id-objednavka=".$_GET["id-objednavka"]);

    }
    if(isset($_POST["fot_ulozit"])){
        foreach($vsechny_fotky as $fotka){
            if($_POST["fot_ulozit"] == $fotka->id_fotka){
                $Fotky->upravit($fotka->id_fotka,$_POST);
                $Objednavky->aktualizaceCeny($_GET["id-objednavka"]);
                header("Location: home.php?page=detail-objednavky&id-objednavka=".$_GET["id-objednavka"]);
            }
        }
    }

}

/********************
  PARAMETR - DETAIL
*********************/

if((isset($_GET["page"])) and ($_GET["page"] == "detail-parametru")){

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
}

/********************
  PARAMETR - UPRAVIT
*********************/

if((isset($_GET["page"])) and ($_GET["page"] == "upravit-parametr")){

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
}

/********************
  ČLÁNKY
*********************/

if((isset($_GET["page"])) and ($_GET["page"] == "clanky")){
    $clanky = $Clanky->vse();
    if(isset($_POST["ulozit"])){
        if(!file_exists("../clanky/".date("d_m_Y")))
            mkdir("../clanky/".date("d_m_Y"),0777);

        $diakritika = array('á' => 'a','é' => 'e','ě' => 'e','í' => 'i','ý' => 'y','ó' => 'o','ú' => 'u','ů' => 'u','ž' => 'z','š' => 's','č' => 'c','ř' => 'r','ď' => 'd','ť' => 't','ň' => 'n','Á' => 'A','É' => 'E','Ě' => 'E','Í' => 'I','Ý' => 'Y','Ó' => 'O','Ú' => 'U','Ů' => 'U','Ž' => 'Z','Š' => 'S','Č' => 'C','Ř' => 'R','Ď' => 'D','Ť' => 'T','Ň' => 'N',' ' => '_');
        //ZBAVENÍ DIAKRITIKY
        $nazev = strtr( $_FILES["cover"]["name"], $diakritika );    
        $slozka = "../clanky/".date("d_m_Y")."/";
        $url_fotka = date("d_m_Y")."/$nazev";
        //PŘEKOPÍROVÁNÍ Z TMP
        if(file_exists("$slozka/$nazev")){
            $rand = rand(1,99);
            move_uploaded_file($_FILES["cover"]["tmp_name"],$slozka.$rand."--".$nazev);
            //PŘEJMENOVÁNÍ 
            rename($slozka.$_FILES["cover"]["name"],$slozka.$rand."--".$nazev);
            $url_fotka = date("d_m_Y")."/".$rand."--".$nazev;
        }
        else{
            move_uploaded_file($_FILES["cover"]["tmp_name"],"../clanky/$url_fotka");
            //PŘEJMENOVÁNÍ
            rename($slozka.$_FILES["cover"]["name"],"../clanky/$url_fotka");
        }
        //ODSTRANĚNÍ STARÉHO 
        unlink("../clanky/".$_POST["cover_existujici"]);
        //ODESLÁNÍ DO DB
        $Clanky->vlozeni($_POST["nadpis"],$url_fotka,date("Y-m-d H:i:s"),$_POST["obsah"],$_SESSION["id_uzivatel"]); 
        header("Location: home.php?page=clanky");
    }
    if((isset($_GET["akce"]))&&($_GET["akce"]=="vymazat")){
        $jeden_clanek = $Clanky->detail($_GET["id-clanek"]);
        $cover = $jeden_clanek->cover;
        unlink("../clanky/$cover");
        $Clanky->vymazat($_GET["id-clanek"]);
        header("Location: home.php?page=clanky");
    }
}

/********************
  ČLÁNKY - UPRAVIT
*********************/

if((isset($_GET["page"])) and ($_GET["page"] == "upravit-clanek")){
    $clanek = $Clanky->detail($_GET["id-clanek"]);
    if(isset($_POST["ulozit"])){
        if(empty($_FILES["cover"]["name"]))
            $Clanky->upravit($_POST["nadpis"],$_POST["cover_existujici"],$_POST["obsah"],$_POST["id"]);
        else{
            if(!file_exists("../clanky/".date("d_m_Y")))
                mkdir("../clanky/".date("d_m_Y"),0777);
            $diakritika = array('á' => 'a','é' => 'e','ě' => 'e','í' => 'i','ý' => 'y','ó' => 'o','ú' => 'u','ů' => 'u','ž' => 'z','š' => 's','č' => 'c','ř' => 'r','ď' => 'd','ť' => 't','ň' => 'n','Á' => 'A','É' => 'E','Ě' => 'E','Í' => 'I','Ý' => 'Y','Ó' => 'O','Ú' => 'U','Ů' => 'U','Ž' => 'Z','Š' => 'S','Č' => 'C','Ř' => 'R','Ď' => 'D','Ť' => 'T','Ň' => 'N',' ' => '_');
            //ZBAVENÍ DIAKRITIKY
            $nazev = strtr( $_FILES["cover"]["name"], $diakritika );    
            $slozka = "../clanky/".date("d_m_Y")."/";
            $url_fotka = date("d_m_Y")."/$nazev";
            //PŘEKOPÍROVÁNÍ Z TMP
            if(file_exists("$slozka/$nazev")){
                $rand = rand(1,99);
                move_uploaded_file($_FILES["cover"]["tmp_name"],$slozka.$rand."--".$nazev);
                //PŘEJMENOVÁNÍ 
                rename($slozka.$_FILES["cover"]["name"],$slozka.$rand."--".$nazev);
                $url_fotka = date("d_m_Y")."/".$rand."--".$nazev;
            }
            else{
                move_uploaded_file($_FILES["cover"]["tmp_name"],"../clanky/$url_fotka");
                //PŘEJMENOVÁNÍ
                rename($slozka.$_FILES["cover"]["name"],"../clanky/$url_fotka");
            }
            //ODSTRANĚNÍ STARÉHO 
            unlink("../clanky/".$_POST["cover_existujici"]);
            unlink("../clanky/".$_POST["cover_existujici"]);
            //ODESLÁNÍ DO DB
                $Clanky->upravit($_POST["nadpis"],$url_fotka,$_POST["obsah"],$_POST["id"]);
            }
        header("Location: home.php?page=clanky");
    }
}

/********************
  UŽIVATELÉ 
*********************/

if((isset($_GET["page"])) and ($_GET["page"] == "uzivatele")){
    $vsichni_uzivatele = $Uzivatele->vse();
    if(isset($_POST["ulozit"])){
        $Uzivatele->vlozeni($_POST);
        header("Location: home.php?page=uzivatele");
    }
    if(isset($_GET["akce"]) && ($_GET["akce"] == "vymazat")){
        $Uzivatele->vymazat($_GET["id-uzivatele"]);
        header("Location: home.php?page=uzivatele");
    }
}

/********************
  UŽIVATELÉ - DETAIL
*********************/

if((isset($_GET["page"])) and ($_GET["page"] == "detail-uzivatele")){
    $uzivatel = $Uzivatele->detailUzivatele($_GET["id-uzivatele"]);
    $objednavky = $Objednavky->objednavkaOdUzivatele($_GET["id-uzivatele"]);
    if((isset($_GET["akce"]))&&($_GET["akce"]=="dokonceno")){
        $Objednavky->dokonceno($_GET["id-objednavka"]);
        header("Location: home.php?page=detail-uzivatele&id-uzivatele=".$_GET["id-uzivatele"]);
    }
    if((isset($_GET["akce"]))&&($_GET["akce"]=="vymazat")){
        $Objednavky->vymazat($_GET["id-objednavka"]);
        header("Location: home.php?page=detail-uzivatele&id-uzivatele=".$_GET["id-uzivatele"]);
    }
    if(isset($_POST["ulozit"])){
        $Uzivatele->upravit($_GET["id-uzivatele"],$_POST);
        header("Location: home.php?page=uzivatele");
    }
    //ZMĚNA HESLA
    if(isset($_POST["zmenit_heslo"])){
        $Uzivatele->zmenitHeslo($_GET["id-uzivatele"],$_POST["nove_h"]);
        header("Location: home.php?page=detail-uzivatele&id-uzivatele=".$_GET["id-uzivatele"]);
    }
}

?>