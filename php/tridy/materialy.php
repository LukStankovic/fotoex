<?php

class Materialy{

    public static function vybraniDat($sql){
        $db = new Databaze();
        return $db->rozkouskovaniZaznamu($sql);
    }
     public static function vse(){
        $sql = "SELECT id_material as id, nazev_material as nazev, alias_material as alias, cena_material as cena, popis_material as popis
                FROM materialy";
        
        return self::vybraniDat($sql);
    }
    public static function cena($parametr){
        $sql = "SELECT cena_material as cena
                FROM materialy
                WHERE id_material = $parametr";
        
        $vysledek = self::vybraniDat($sql);
        return $vysledek[0]->cena;
    }
    public static function kontrola($id){
        $sql = "SELECT id_material
                FROM fotky
                WHERE id_material = '$id'";
        $vysledek = self::vybraniDat($sql);
        if(empty($vysledek))
            return 1;
        else
            return 0;
    }
    public function vlozeni($nazev_m,$alias_m,$cena_m,$popis_m){
        $db = new Databaze();
        
        //přípava dat
        
        $nazev = $db->pripravaProInput($nazev_m);
        $alias = $db->pripravaProInput($alias_m);
        $cena = $db->pripravaProInput($cena_m);
        $popis = $db->pripravaProInput($popis_m);
    
        $sql = "INSERT INTO materialy (nazev_material, alias_material, cena_material, popis_material)
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
        
        $sql = "UPDATE materialy SET nazev_material = '$nazev', alias_material = '$alias', cena_material = '$cena', popis_material = '$popis'
                WHERE  id_material = $id";
    
        return $db->zpracovani($sql);
    }
    public function vymazat($id){
       $db = new Databaze();
        $sql = "DELETE FROM materialy
                WHERE id_material = $id";
        return $db->zpracovani($sql); 
    }

}

?>