<?php

class Clanky{
    
    public static function vybraniDat($sql){
        $db = new Databaze();
        return $db->rozkouskovaniZaznamu($sql);
    }
    
    public static function vse(){
        $sql = "SELECT *
                FROM clanky C INNER JOIN uzivatele U on C.id_uzivatel = U.id_uzivatel
                ORDER BY datum DESC";
        
        return self::vybraniDat($sql);
    }

    public static function pocet(){
        $sql = "SELECT count(id_clanek) as 'pocet_clanku'
                FROM clanky";
        $vysledek = self::vybraniDat($sql);
        return $vysledek[0]->pocet_clanku;
    }
    
    
    public function vlozeni($nadpis_c,$fotka_c,$datum_c,$obsah_c,$autor_c){
        $db = new Databaze();
        
        //přípava dat
        
        $nadpis = $db->pripravaProInput($nadpis_c);
        $fotka = $db->pripravaProInput($fotka_c);
        $datum = $db->pripravaProInput($datum_c);
        $obsah = $db->pripravaProInput($obsah_c);
        $autor = $db->pripravaProInput($autor_c);
    
        $sql = "INSERT INTO clanky (nazev, cover, datum, obsah, id_uzivatel)
                VALUES ('$nadpis','$fotka','$datum','$obsah','$autor')";
        
        return $db->zpracovani($sql);
    }
    
    public function editace($id,$nazev,$text,$kategorie){
        $db = new Databaze();
        
        //přípava dat
        
        $nazev = $db->pripravaProInput($nazev);
        $text_clanku = $db->pripravaProInput($text);
        $id_kategorie = $db->pripravaProInput($kategorie);
    
        $sql = "UPDATE clanky
                SET nazev='$nazev',text_clanku='$text_clanku',id_kategorie='$id_kategorie'
                WHERE id_clanku = 14";
        return $db->zpracovani($sql);
    }

    
    
    public function vymazat($id){
        $db = new Databaze();
        $sql = "DELETE FROM clanky
                WHERE id_clanek = $id";
        return $db->zpracovani($sql);
    }
}


?>




