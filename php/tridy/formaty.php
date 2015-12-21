<?php

class Formaty{

    public static function vybraniDat($sql){
        $db = new Databaze();
        return $db->rozkouskovaniZaznamu($sql);
    }
     public static function vse(){
        $sql = "SELECT id_format as id, nazev_format as nazev, alias_format as alias, cena_format as cena, popis_format as popis
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
    public function upravit($k_uprave) {
        $db = new Databaze();    
        
        $nazev = $k_uprave["nazev"];
        $alias = $k_uprave["alias"];
        $cena = $k_uprave["cena"];
        $popis = $k_uprave["popis"];
        $id = $k_uprave["id"];
        
        $sql = "UPDATE formaty SET nazev_format = '$nazev', alias_format = '$alias', cena_format = '$cena', popis_format = '$popis'
                WHERE  id_format = $id";
    
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