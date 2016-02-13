<?php

class Fotopapiry{

    public static function vybraniDat($sql){
        $db = new Databaze();
        return $db->rozkouskovaniZaznamu($sql);
    }
     public static function vse(){
        $sql = "SELECT id_fotopapir as id, nazev_fotopapir as nazev, alias_fotopapir as alias, cena_fotopapir as cena, popis_fotopapir as popis
                FROM fotopapiry";
        
        return self::vybraniDat($sql);
    }
    public static function cena($parametr){
        $sql = "SELECT cena_fotopapir as cena
                FROM fotopapiry
                WHERE id_fotopapir = $parametr";
        
        $vysledek = self::vybraniDat($sql);
        return $vysledek[0]->cena;
    }
    public function vlozeni($nazev_f,$alias_f,$cena_f,$popis_f){
        $db = new Databaze();
        
        //přípava dat
        
        $nazev = $db->pripravaProInput($nazev_f);
        $alias = $db->pripravaProInput($alias_f);
        $cena = $db->pripravaProInput($cena_f);
        $popis = $db->pripravaProInput($popis_f);
    
        $sql = "INSERT INTO fotopapiry (nazev_fotopapir, alias_fotopapir, cena_fotopapir, popis_fotopapir)
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
        
        $sql = "UPDATE fotopapiry SET nazev_fotopapir = '$nazev', alias_fotopapir = '$alias', cena_fotopapir = '$cena', popis_fotopapir = '$popis'
                WHERE  id_fotopapir = $id";
    
        return $db->zpracovani($sql);
    }
    public function vymazat($id){
       $db = new Databaze();
        $sql = "DELETE FROM fotopapiry
                WHERE id_fotopapir = $id";
        return $db->zpracovani($sql); 
    }

}

?>