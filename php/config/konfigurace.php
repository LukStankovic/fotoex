<?php
require_once ("php/tridy/databaze.php");
require_once ("php/tridy/clanky.php");
require_once ("php/tridy/objednavky.php");
require_once ("php/tridy/fotky.php");
require_once ("php/tridy/uzivatele.php");
require_once ("php/tridy/kosik.php");

//PARAMETRY
require_once ("php/tridy/formaty.php");
require_once ("php/tridy/desky.php");
require_once ("php/tridy/fotopapiry.php");
require_once ("php/tridy/materialy.php");
require_once ("php/tridy/typy.php");


$Clanky = new Clanky();
$Objednavky = new Objednavky();
$Uzivatele = new Uzivatele();
$Fotky = new Fotky();

if(!isset($Kosik))
    $Kosik = new Kosik();

//PARAMETRY
$Formaty = new Formaty();
$Desky = new Desky();
$Fotopapiry = new Fotopapiry();
$Materialy = new Materialy();
$Typy = new Typy();

error_reporting(E_ERROR | E_PARSE); //Z DŮVODU UKAZOVÁNÍ WARNING NA NĚKTERÝCH SERVERECH PŘI NEVYPLNĚNÍ MATERIÁLU/FOTOPAPÍRU
?>