<?php

class Fotopapiry{

    public static function vybraniDat($sql){
        $db = new Databaze();
        return $db->rozkouskovaniZaznamu($sql);
    }
     public static function vse(){
        $sql = "SELECT id_fotopapir as id, nazev_fotopapir, alias_fotopapir, cena_fotopapir, popis_fotopapir
                FROM fotopapiry";
        
        return self::vybraniDat($sql);
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
    
    public function vymazat($id){
       $db = new Databaze();
        $sql = "DELETE FROM fotopapiry
                WHERE id_fotopapir = $id";
        return $db->zpracovani($sql); 
    }

}

?>