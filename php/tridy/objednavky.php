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
                       pocet,
                       round(((sum(cena_format) + sum(cena_deska) + sum(cena_fotopapir) + sum(cena_material) + sum(cena_typ))*pocet)+doprava_cena,2) AS 'celkem'

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
                       pocet,
                       round(((sum(cena_format) + sum(cena_deska) + sum(cena_fotopapir) + sum(cena_material) + sum(cena_typ))*pocet)+doprava_cena,2) AS 'celkem'

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
                       pocet,
                       round((sum(cena_format) + sum(cena_deska) + sum(cena_fotopapir) + sum(cena_material) + sum(cena_typ))*pocet,2) AS 'celkem'

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
        $sql = "SELECT round(sum(cena_format) + sum(cena_deska) + sum(cena_fotopapir) + sum(cena_material) + sum(cena_typ),2) AS 'celkem'
                FROM objednavky 
                    INNER JOIN fotky using(id_objednavka) 
                    INNER JOIN desky using(id_deska)
                    INNER JOIN formaty using(id_format)
                    INNER JOIN fotopapiry using(id_fotopapir)
                    INNER JOIN materialy using(id_material)
                    INNER JOIN typy using(id_typ)
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
    
    public function celkova_cena($fotky){
        
    }
    
    public function vlozeni($id_o,$stav,$id_u,$k_uprave){
        $db = new Databaze();
        
        //přípava dat
        $id_ob = $db->pripravaProInput($id_o);
        $id_uz = $db->pripravaProInput($id_u);
        $stav_ob = $db->pripravaProInput($stav);
        //DORUČOVACÍ ADRESA
        $d_jmeno = $db->pripravaProInput($k_uprave["dor_jmeno"]);
        $d_prijmeni = $db->pripravaProInput($k_uprave["dor_prijmeni"]);
        $d_ulice = $db->pripravaProInput( $k_uprave["dor_ulice"]);
        $d_psc = $db->pripravaProInput($k_uprave["dor_psc"]);
        $d_mesto = $db->pripravaProInput($k_uprave["dor_mesto"]);
        $d_zeme = $db->pripravaProInput($k_uprave["dor_zeme"]);
        //FAKTURAČNÍ ADRESA
        $f_jmeno = $db->pripravaProInput($k_uprave["fak_jmeno"]);
        $f_prijmeni = $db->pripravaProInput($k_uprave["fak_prijmeni"]);
        $f_ulice = $db->pripravaProInput( $k_uprave["fak_ulice"]);
        $f_psc = $db->pripravaProInput($k_uprave["fak_psc"]);
        $f_mesto = $db->pripravaProInput($k_uprave["fak_mesto"]);
        $f_zeme = $db->pripravaProInput($k_uprave["fak_zeme"]);

        $uz_email = $db->pripravaProInput($k_uprave["uz_email"]);
        $uz_telefon = $db->pripravaProInput($k_uprave["uz_telefon"]);
        
        $datum = date("Y-m-d H:i:s");
        
        if($id_uz == -1)
            $id_uz = 0;
        
        $platba = $db->pripravaProInput($k_uprave["platba"]);
        $doruceni = $db->pripravaProInput($k_uprave["doruceni"]);
        $doruceni_cena = $db->pripravaProInput($k_uprave["doruceni_cena"]);
        
        
        $sql = "INSERT INTO objednavky
                VALUES ('$id_ob','$datum','$stav_ob','$platba','$doruceni','$doruceni_cena','$id_uz','$d_jmeno','$d_prijmeni','$d_ulice','$d_psc','$d_mesto','$d_zeme','$f_jmeno','$f_prijmeni','$f_ulice','$f_psc','$f_mesto','$f_zeme','$uz_telefon','$uz_email')";
        
        return $db->zpracovani($sql);
    }
    public function dokonceno($id) {
        $db = new Databaze();    
        
        $sql = "UPDATE objednavky SET stav = 'Dokončeno'
                WHERE  id_objednavka = $id";
    
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
        
        
        
        $sql = "UPDATE objednavky SET stav = '$stav', d_jmeno = '$d_jmeno', d_prijmeni = '$d_prijmeni', d_ulice = '$d_ulice', d_psc = '$d_psc', d_mesto = '$d_mesto', d_zeme = '$d_zeme', f_jmeno = '$f_jmeno', f_prijmeni = '$f_prijmeni', f_ulice = '$f_ulice', f_psc = '$f_psc', f_mesto = '$f_mesto', f_zeme = '$f_zeme'
        
        
                WHERE  id_objednavka = $id";
    
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