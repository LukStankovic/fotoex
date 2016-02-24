<?php

class Objednavky{

    public static function vybraniDat($sql){
        $db = new Databaze();
        return $db->rozkouskovaniZaznamu($sql);
    }

     public static function vse(){
        $sql = "SELECT id_objednavka, datum, stav, platba, doprava, doprava_cena,
                       login, jmeno, prijmeni, email, telefon, ulice, mesto, psc, zeme,
                       login, jmeno, prijmeni, email, telefon,
                       d_jmeno, d_prijmeni, d_ulice, d_psc, d_mesto, d_zeme,
                       f_jmeno, f_prijmeni, f_ulice, f_psc, f_mesto, f_zeme,
                       u_telefon, u_email,
                       id_fotka, url, typ_souboru,
                       nazev_format, alias_format, round(cena_format,2),
                       nazev_deska, alias_deska, round(cena_deska,2),
                       nazev_fotopapir, alias_fotopapir, round(cena_fotopapir,2),
                       nazev_material, alias_material, round(cena_material,2),
                       nazev_typ, alias_typ, round(cena_typ,2),
                       pocet, cena_celkem as celkem

                FROM objednavky 
                    INNER JOIN fotky using(id_objednavka) 
                    INNER JOIN desky using(id_deska)
                    INNER JOIN formaty using(id_format)
                    INNER JOIN fotopapiry using(id_fotopapir)
                    INNER JOIN materialy using(id_material)
                    INNER JOIN typy using(id_typ)
                    INNER JOIN uzivatele using(id_uzivatel)
                GROUP BY id_objednavka                    
                ORDER BY id_objednavka DESC
                ";
    
        return self::vybraniDat($sql);
    }
    public static function detailObjednavky($id){
            $sql = "SELECT id_objednavka, datum, stav, platba, doprava, doprava_cena,
                       login, jmeno, prijmeni, email, telefon,
                       d_jmeno, d_prijmeni, d_ulice, d_psc, d_mesto, d_zeme,
                       f_jmeno, f_prijmeni, f_ulice, f_psc, f_mesto, f_zeme,
                       u_telefon, u_email,
                       pocet, cena_celkem as celkem

                FROM objednavky 
                    INNER JOIN fotky using(id_objednavka) 
                    INNER JOIN desky using(id_deska)
                    INNER JOIN formaty using(id_format)
                    INNER JOIN fotopapiry using(id_fotopapir)
                    INNER JOIN materialy using(id_material)
                    INNER JOIN typy using(id_typ)
                    INNER JOIN uzivatele using(id_uzivatel)
                WHERE id_objednavka = $id
                ";
        return self::vybraniDat($sql);
    }
    public static function objednavkaOdUzivatele($id){
        $sql = "SELECT id_objednavka, datum, stav, 
                       id_uzivatel ,login, jmeno, prijmeni, email, telefon, ulice, mesto, psc, zeme,
                       id_fotka, url, typ_souboru,
                       nazev_format, alias_format, round(cena_format,2),
                       nazev_deska, alias_deska, round(cena_deska,2),
                       nazev_fotopapir, alias_fotopapir, round(cena_fotopapir,2),
                       nazev_material, alias_material, round(cena_material,2),
                       nazev_typ, alias_typ, round(cena_typ,2),
                       pocet, cena_celkem as celkem

                FROM objednavky 
                    INNER JOIN fotky using(id_objednavka) 
                    INNER JOIN desky using(id_deska)
                    INNER JOIN formaty using(id_format)
                    INNER JOIN fotopapiry using(id_fotopapir)
                    INNER JOIN materialy using(id_material)
                    INNER JOIN typy using(id_typ)
                    INNER JOIN uzivatele using(id_uzivatel)
                WHERE id_uzivatel = $id
                GROUP BY id_objednavka
                ORDER BY id_objednavka DESC
                LIMIT 5
                ";
        return self::vybraniDat($sql);
    }
    
    public static function pocetZaDen(){
        $sql = "SELECT datum,count(id_objednavka) AS 'pocet_obj'
                FROM objednavky
                GROUP BY day(datum), month(datum), year(datum)
                ";
        return self::vybraniDat($sql);
    }
    public static function trzby(){
        $sql = "SELECT sum(cena_celkem) as 'celkem'
                FROM objednavky 
                ";
        $vysledek = self::vybraniDat($sql);
        return($vysledek[0]->celkem);
    }
    
    public static function pocetObjednavek(){
        $sql = "SELECT count(id_objednavka) AS 'celkem'
                FROM objednavky";
        $vysledek = self::vybraniDat($sql);
        return($vysledek[0]->celkem);
    }

    public function vlozeni($id_o,$stav,$id_u,$k_uprave,$celkova_cena,$pl,$doprava){
        $db = new Databaze();
        
        //přípava dat
        $id_ob = $db->pripravaProInput($id_o);
        $id_uz = $db->pripravaProInput($id_u);
        $stav_ob = $db->pripravaProInput($stav);
        //DORUČOVACÍ ADRESA
        $d_jmeno = $db->pripravaProInput($k_uprave["dorucovaci"]["jmeno"]);
        $d_prijmeni = $db->pripravaProInput($k_uprave["dorucovaci"]["prijmeni"]);
        $d_ulice = $db->pripravaProInput( $k_uprave["dorucovaci"]["ulice"]);
        $d_psc = $db->pripravaProInput($k_uprave["dorucovaci"]["psc"]);
        $d_mesto = $db->pripravaProInput($k_uprave["dorucovaci"]["mesto"]);
        $d_zeme = $db->pripravaProInput($k_uprave["dorucovaci"]["zeme"]);
        //FAKTURAČNÍ ADRESA
        $f_jmeno = $db->pripravaProInput($k_uprave["fakturacni"]["jmeno"]);
        $f_prijmeni = $db->pripravaProInput($k_uprave["fakturacni"]["prijmeni"]);
        $f_ulice = $db->pripravaProInput( $k_uprave["fakturacni"]["ulice"]);
        $f_psc = $db->pripravaProInput($k_uprave["fakturacni"]["psc"]);
        $f_mesto = $db->pripravaProInput($k_uprave["fakturacni"]["mesto"]);
        $f_zeme = $db->pripravaProInput($k_uprave["fakturacni"]["zeme"]);

        $uz_email = $db->pripravaProInput($k_uprave["uzivatelske"]["email"]);
        $uz_telefon = $db->pripravaProInput($k_uprave["uzivatelske"]["telefon"]);
        
        $datum = date("Y-m-d H:i:s");
        
        if($id_uz == -1)
            $id_uz = 0;
        
        $platba = $db->pripravaProInput($pl);
        $doruceni = $db->pripravaProInput($doprava["typ"]);
        $doruceni_cena = $db->pripravaProInput($doprava["cena"]);
        
        $celkem = $db->pripravaProInput($celkova_cena);
        
        $sql = "INSERT INTO objednavky
                VALUES ('$id_ob','$datum','$stav_ob','$platba','$doruceni','$doruceni_cena','$id_uz','$d_jmeno','$d_prijmeni','$d_ulice','$d_psc','$d_mesto','$d_zeme','$f_jmeno','$f_prijmeni','$f_ulice','$f_psc','$f_mesto','$f_zeme','$uz_telefon','$uz_email','$celkem')";
        
        return $db->zpracovani($sql);
    }
    

    
    
    public function dokonceno($id) {
        $db = new Databaze();    
        
        $sql = "UPDATE objednavky SET stav = 'Dokončeno'
                WHERE id_objednavka = $id";
    
        return $db->zpracovani($sql);
    }    
    public function upravit($id,$k_uprave) {
        $db = new Databaze();    
        
        $stav = $k_uprave["stav"];
        
        //DORUČOVACÍ ADRESA
        $d_jmeno = $k_uprave["dor_jmeno"];
        $d_prijmeni = $k_uprave["dor_prijmeni"];
        $d_ulice =  $k_uprave["dor_ulice"];
        $d_psc = $k_uprave["dor_psc"];
        $d_mesto = $k_uprave["dor_mesto"];
        $d_zeme = $k_uprave["dor_zeme"];
        //FAKTURAČNÍ ADRESA
        $f_jmeno = $k_uprave["fak_jmeno"];
        $f_prijmeni = $k_uprave["fak_prijmeni"];
        $f_ulice =  $k_uprave["fak_ulice"];
        $f_psc = $k_uprave["fak_psc"];
        $f_mesto = $k_uprave["fak_mesto"];
        $f_zeme = $k_uprave["fak_zeme"];
        
        $platba = $k_uprave["platba"];
        
        $doprava = $k_uprave["doprava"];
        
        if($doprava == "Česká pošta")
            $doprava_cena = 30.0;
        if($doprava == "Kurýr")
            $doprava_cena = 70.0;
        
        $sql = "UPDATE objednavky SET stav = '$stav', platba = '$platba', doprava = '$doprava', doprava_cena = '$doprava_cena', d_jmeno = '$d_jmeno', d_prijmeni = '$d_prijmeni', d_ulice = '$d_ulice', d_psc = '$d_psc', d_mesto = '$d_mesto', d_zeme = '$d_zeme', f_jmeno = '$f_jmeno', f_prijmeni = '$f_prijmeni', f_ulice = '$f_ulice', f_psc = '$f_psc', f_mesto = '$f_mesto', f_zeme = '$f_zeme'
        
        
                WHERE  id_objednavka = $id";
    
        return $db->zpracovani($sql);
    }
    
    public function aktualizaceCeny($id){
        $db = new Databaze();
        $sql = "SELECT sum(cena) as celkem, doprava_cena
                FROM fotky inner join objednavky using(id_objednavka)
                where id_objednavka = $id
                group by id_objednavka
                ";
        
        $celkem_obj = self::vybraniDat($sql);
        
        $celkem = $celkem_obj[0]->celkem;
        
        $celkem += $celkem_obj[0]->doprava_cena;
        
        $sql = "UPDATE objednavky SET cena_celkem = '$celkem'
                WHERE id_objednavka = $id";
        
        return $db->zpracovani($sql);
    }
    public function vymazat($id){
       $db = new Databaze();
        $sql = "DELETE FROM objednavky
                WHERE id_objednavka = $id";
        return $db->zpracovani($sql); 
    }

}

?>