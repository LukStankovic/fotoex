<?php
require_once ("php/tridy/databaze.php");
require_once ("php/tridy/clanky.php");
require_once ("php/tridy/objednavky.php");
require_once ("php/tridy/fotky.php");
require_once ("php/tridy/uzivatele.php");

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

//PARAMETRY
$Formaty = new Formaty();
$Desky = new Desky();
$Fotopapiry = new Fotopapiry();
$Materialy = new Materialy();
$Typy = new Typy();


?>