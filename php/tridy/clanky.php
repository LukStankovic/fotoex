<?php

class Clanky{
    private $id_clanku;
    public $nazev;
    public $cover_img;
    public $text_clanku;
    private $datum;
    public $autor;
    public $id_kategorie;
    private $jmeno_autora;
    private $prijmeni_autora;
    private $nazev_kategorie;
    private $ikona_kategorie;

    
    public static function vybraniDat($sql){
        $db = new Databaze();
        return $db->rozkouskovaniZaznamu($sql);
    }
    
    public static function dataZeVsechClanku(){
        $sql = "SELECT *
                FROM clanky C INNER JOIN kategorie K ON K.id_kategorie = C.id_kategorie INNER JOIN uzivatele U on C.autor = U.id_uzivatele 
                WHERE K.id_kategorie = C.id_kategorie AND C.autor = U.id_uzivatele
                ORDER BY datum DESC";
        
        return self::vybraniDat($sql);
    }

    public static function pocetClanku(){
        $sql = "SELECT count(id_clanku) as 'pocet_clanku'
                FROM clanky";
        return self::vybraniDat($sql);
    }
    
    
    public function vlozeni($nazev_cl,$cover_cl,$text_cl,$id_kat,$autor_cl){
        $db = new Databaze();
        
        //přípava dat
        
        $nazev = $db->pripravaProInput($nazev_cl);
        $cover_img = $db->pripravaProInput($cover_cl);
        $text_clanku = $db->pripravaProInput($text_cl);
        $id_kategorie = $db->pripravaProInput($id_kat);
        $autor = $db->pripravaProInput($autor_cl);
    
        $sql = "INSERT INTO clanky (nazev, cover_img, text_clanku, id_kategorie, autor)
                VALUES ('$nazev','$cover_img','$text_clanku','$id_kategorie','$autor')";
        
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
                WHERE id_clanku = $id";
        return $db->zpracovani($sql);
    }
}


?>




