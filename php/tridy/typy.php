<?php

class Typy{

    public static function vybraniDat($sql){
        $db = new Databaze();
        return $db->rozkouskovaniZaznamu($sql);
    }
     public static function vse(){
        $sql = "SELECT id_typ as id, nazev_typ as nazev, alias_typ as alias, cena_typ as cena, popis_typ as popis
                FROM typy";
        
        return self::vybraniDat($sql);
    }
    public static function cena($parametr){
        $sql = "SELECT cena_typ as cena
                FROM typy
                WHERE id_typ = $parametr";
        
        $vysledek = self::vybraniDat($sql);
        return $vysledek[0]->cena;
    }
    public function vlozeni($nazev_t,$alias_t,$cena_t,$popis_t){
        $db = new Databaze();
        
        //přípava dat
        
        $nazev = $db->pripravaProInput($nazev_t);
        $alias = $db->pripravaProInput($alias_t);
        $cena = $db->pripravaProInput($cena_t);
        $popis = $db->pripravaProInput($popis_t);
    
        $sql = "INSERT INTO typy (nazev_typ, alias_typ, cena_typ, popis_typ)
                VALUES ('$nazev','$alias','$cena','$popis')";
        
        return $db->zpracovani($sql);
    }
    public function upravit($k_uprave) {
        $db = new Databaze();    
        
        $nazev = $k_uprave["nazev"];
        $alias = $k_uprave["alias"];
        $cena = $k_uprave["cena"];
        $popis = $k_uprave["popis"];
        $id = $k_uprave["id"];
        
        $sql = "UPDATE typy SET nazev_typ = '$nazev', alias_typ = '$alias', cena_typ = '$cena', popis_typ = '$popis'
                WHERE  id_typ = $id";
    
        return $db->zpracovani($sql);
    }
    public function vymazat($id){
       $db = new Databaze();
        $sql = "DELETE FROM typy
                WHERE id_typ = $id";
        return $db->zpracovani($sql); 
    }

}

?>