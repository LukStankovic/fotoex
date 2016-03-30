# Aplikace FotoEx

##Pokyny k instalaci
Ke správnému fungování aplikace FotoEx je potřeba PHP 5.6, Apache 2.0 a vyšší a MySQL server verze alespoň 5.6. 
-	Nahrát data ze složky Web na váš webový server.
-	Vytvořit novou databázi s kódováním utf-8.
-	Importace databáze. Na výběr jsou tři verze:
o	fotoex_kompletni.sql – struktura databáze a databázové data
o	fotoex_struktura.sql – pouze struktura databáze
o	fotoex_obsah.sql – pouze databázové data
V každém databázovém importu se zároveň nachází DML dotaz pro vytvoření uživatele admin s heslem admin. 
-	Připojit aplikaci k databázi v souboru /php/tridy/databaze.php

```php
    public function __construct(){
        $this->server = "adresa serveru (nejčastěji localhost)";
        $this->login_jmeno = "přihlašovací jméno do databáze";
        $this->heslo = "heslo do databáze";
        $this->nazev_databaze = "název databáze";
    }
```
-	Pro správnou funkcionalitu Google reCAPTCHA změnit v souboru reg_ok.php secret na řádku 4. Je nutno předem vytvořit API klíč na oficiální stránce Google reCAPTCHA (https://www.google.com/recaptcha/admin)

```php 
    $secret = "ZDE VLOŽIT VÁŠ VYGENEROVANÝ API KLÍČ";
```

##Uživatelský manuál

##Administrace
Do administrace se lze přihlásit na adrese www.domena.cz/spravce. Pro vstup do administrace je nutno mít práva 2.
Na nástěnce se zobrazují informace o objednávkách.

V kartě Objednávky se nacházejí všechny objednávky. Detail objednávky lze zobrazit pomocí ikony oka. Objednávku za dokončenou lze označit pomocí fajfky a smazat pomocí křížku. Objednávku lze upravovat pouze v detailu objednávky po kliknutí na tlačítko Upravit objednávku. Parametry fotografií lze upravovat pomocí ikony tužky v detailu objednávky. Správce může všechny fotografie stáhnout komprimované do jednoho souboru pomocí tlačítka Stáhnout všechny fotografie v .zip. Po každé úpravě přijde uživatelovi email s upravenou objednávkou.

Přidávat, mazat a upravovat parametry jde v kartě Parametry. Zde se nacházejí kategorie parametrů a dále jednotlivé parametry.
Vytvořit článek, upravit a zobrazit všechny články a lze v kartě Články. Při úpravě článku lze nahraný ilustrační obrázek vymazat a nahrát nový.

Všichni registrovaní uživatelé jsou v kartě Uživatelé. Po kliknutí na ikonu oka lze uživatele upravit a zobrazit si jeho poslední objednávky.

##Objednávací proces
Nejprve je nutno fotografie vybrat pomocí tlačítka Vybrat fotografie. Poté je nutno tyto fotografie nahrát, buď pomocí vše, anebo postupně. Do systému lze nahrát pouze fotografie ve formátu jpg, png a gif.

V druhém kroku se jednotlivým fotografiím přidají parametry. Po nastavení daného rozměru se vypočítá výsledná kvalita vyvolené fotografie. Vyvolávat fotografie ve špatné kvalitě se nedoporučuje.

V košíku si lze všechny parametry k fotografiím zkontrolovat a popřípadě vymazat.

Ve čtvrtém kroku je nutné vyplnit údaje. Fakturační údaje jsou povinné. Při nevyplnění doručovací údajů se použijí pro doručení fakturační údaje. Pokud jste přihlášení, fakturační údaje se vyplní automaticky z vašeho profilu.

V dalším kroku se objednávka odešle do administrace a na email vám přijde potvrzení 
o objednávce.
