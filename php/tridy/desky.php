<?php

class Desky{

    public static function vybraniDat($sql){
        $db = new Databaze();
        return $db->rozkouskovaniZaznamu($sql);
    }
     public static function vse(){
        $sql = "SELECT id_deska as id, nazev_deska, alias_deska, cena_deska, popis_deska
                FROM desky";
        
        return self::vybraniDat($sql);
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
    public function vymazat($id){
       $db = new Databaze();
        $sql = "DELETE FROM desky
                WHERE id_deska = $id";
        return $db->zpracovani($sql); 
    }

}

?>