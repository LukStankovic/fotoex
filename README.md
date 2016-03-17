# fotoex

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
