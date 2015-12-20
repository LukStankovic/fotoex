<?php

class Typy{

    public static function vybraniDat($sql){
        $db = new Databaze();
        return $db->rozkouskovaniZaznamu($sql);
    }
     public static function vse(){
        $sql = "SELECT id_typ as id, nazev_typ, alias_typ, cena_typ, popis_typ
                FROM typy";
        
        return self::vybraniDat($sql);
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
    
    public function vymazat($id){
       $db = new Databaze();
        $sql = "DELETE FROM typy
                WHERE id_typ = $id";
        return $db->zpracovani($sql); 
    }

}

?>