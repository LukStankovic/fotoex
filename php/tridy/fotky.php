<?php

class Fotky{

    public static function vybraniDat($sql){
        $db = new Databaze();
        return $db->rozkouskovaniZaznamu($sql);
    }
     public static function vse(){
        $sql = "SELECT id_fotka, url, typ_souboru, id_objednavka, id_format, id_deska, id_typ, id_material, id_fotopapir, pocet
                FROM fotky";
        
        return self::vybraniDat($sql);
    }
     public static function detailFotek($id){
        $sql = "SELECT *
                
                FROM fotky
                    INNER JOIN desky using(id_deska)
                    INNER JOIN formaty using(id_format)
                    INNER JOIN fotopapiry using(id_fotopapir)
                    INNER JOIN materialy using(id_material)
                    INNER JOIN typy using(id_typ)
                WHERE id_objednavka = $id
                ORDER BY id_fotka
                ";
        
        return self::vybraniDat($sql);
    }
    public static function pocet_formatu(){
        $sql = "SELECT id_format,nazev_format, count(id_format) as pocet                  
                FROM fotky INNER JOIN formaty using(id_format)
                GROUP BY id_format
                ";
        return self::vybraniDat($sql);
    }
    public function vlozeni($id_o,$k_uprave){
        $db = new Databaze();
        
        $url = $db->pripravaProInput($k_uprave["url"]);
        $typ_s = $db->pripravaProInput($k_uprave["typ_souboru"]);
        $id_o = $db->pripravaProInput($id_o);
        $format = $db->pripravaProInput( $k_uprave["format"]);
        $deska = $db->pripravaProInput($k_uprave["deska"]);
        $typ = $db->pripravaProInput($k_uprave["typ"]);
        $material = $db->pripravaProInput($k_uprave["material"]);
        //FAKTURAČNÍ ADRESA
        $fotopapir = $db->pripravaProInput($k_uprave["fotopapir"]);
        $pocet = $db->pripravaProInput($k_uprave["pocet"]);

    
        
        $sql = "INSERT INTO fotky
                VALUES ('','$url','$typ','$id_o','$format','$deska','$typ_s','$material','$fotopapir','$pocet')";
        
        return $db->zpracovani($sql);
    }
    public function upravit($id,$k_uprave) {
        $db = new Databaze();    
        
        $format = $k_uprave["format"][$id];
        $deska = $k_uprave["deska"][$id];
        $typ = $k_uprave["typ"][$id];
        $material = $k_uprave["material"][$id];
        $fotopapir = $k_uprave["fotopapir"][$id];
        $pocet = $k_uprave["pocet"][$id];

        $sql = "UPDATE fotky SET id_format = '$format', id_deska = '$deska', id_typ = '$typ', id_material = '$material', id_fotopapir = '$fotopapir', pocet = '$pocet'
                WHERE  id_fotka = $id";
    
        return $db->zpracovani($sql);
    }
    public function vymazat($id){
       $db = new Databaze();
        $sql = "DELETE FROM fotky
                WHERE id_fotka = $id";
        return $db->zpracovani($sql); 
    }

}

?>