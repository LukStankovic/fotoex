<?php

class Desky{

    public static function vybraniDat($sql){
        $db = new Databaze();
        return $db->rozkouskovaniZaznamu($sql);
    }
     public static function vse(){
        $sql = "SELECT id_deska as id, nazev_deska as nazev, alias_deska as alias, cena_deska as cena, popis_deska as popis
                FROM desky";
        
        return self::vybraniDat($sql);
    }
    public static function cena($parametr){
        $sql = "SELECT cena_deska as cena
                FROM desky
                WHERE id_deska = $parametr";
        
        $vysledek = self::vybraniDat($sql);
        return $vysledek[0]->cena;
    }

    public function vlozeni($nazev_d,$alias_d,$cena_d,$popis_d){
        $db = new Databaze();
        
        //přípava dat
        
        $nazev = $db->pripravaProInput($nazev_d);
        $alias = $db->pripravaProInput($alias_d);
        $cena = $db->pripravaProInput($cena_d);
        $popis = $db->pripravaProInput($popis_d);
    
        $sql = "INSERT INTO desky (nazev_deska, alias_deska, cena_deska, popis_deska)
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
        
        $sql = "UPDATE desky SET nazev_deska = '$nazev', alias_deska = '$alias', cena_deska = '$cena', popis_deska = '$popis'
                WHERE  id_deska = $id";
    
        return $db->zpracovani($sql);
    }
    
    public function vymazat($id){
       $db = new Databaze();
        $sql = "DELETE FROM desky
                WHERE id_deska = $id";
        return $db->zpracovani($sql); 
    }

}

?>