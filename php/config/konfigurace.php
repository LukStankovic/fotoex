<?php
include_once ("php/tridy/databaze.php");
include_once ("php/tridy/clanky.php");
include_once ("php/tridy/objednavky.php");
include_once ("php/tridy/fotky.php");
include_once ("php/tridy/uzivatele.php");

//PARAMETRY
include_once ("php/tridy/formaty.php");
include_once ("php/tridy/desky.php");
include_once ("php/tridy/fotopapiry.php");
include_once ("php/tridy/materialy.php");
include_once ("php/tridy/typy.php");


$Clanky = new Clanky();
$Objednavky = new Objednavky();
$Uzivatele = new Uzivatele();
$Fotky = new Fotky();

//PARAMETRY
$Formaty = new Formaty();
$Desky = new Desky();
$Fotopapiry = new Fotopapiry();
$Materialy = new Materialy();
$Typy = new Typy();


?>