<?php

class Formaty{

    public static function vybraniDat($sql){
        $db = new Databaze();
        return $db->rozkouskovaniZaznamu($sql);
    }
     public static function vse(){
        $sql = "SELECT id_format as id, nazev_format, alias_format, cena_format, popis_format
                FROM formaty";
        
        return self::vybraniDat($sql);
    }

    public function vlozeni($nazev_f,$alias_f,$cena_f,$popis_f){
        $db = new Databaze();
        
        //přípava dat
        
        $nazev = $db->pripravaProInput($nazev_f);
        $alias = $db->pripravaProInput($alias_f);
        $cena = $db->pripravaProInput($cena_f);
        $popis = $db->pripravaProInput($popis_f);
    
        $sql = "INSERT INTO formaty (nazev_format, alias_format, cena_format, popis_format)
                VALUES ('$nazev','$alias','$cena','$popis')";
        
        return $db->zpracovani($sql);
    }
    public function vymazat($id){
       $db = new Databaze();
        $sql = "DELETE FROM formaty
                WHERE id_format = $id";
        return $db->zpracovani($sql); 
    }

}

?>