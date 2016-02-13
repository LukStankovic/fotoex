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
    
    public function parametry_fotky($post,$pocet){
        for($id_foto = 0;$id_foto<$pocet; $id_foto++){    
            //ID
            $s[$id_foto]["id"] = $id_foto;
            //URL
            $s[$id_foto]["url"] = $post["fotka"][$id_foto];
            $s[$id_foto]["mini_url"] = $post["miniatura_fotka"][$id_foto];
            //ROZMĚRY
            list($sirka, $vyska) = getimagesize($s[$id_foto]["url"]);
            $s[$id_foto]["sirka"] = $sirka;
            $s[$id_foto]["vyska"] = $vyska;
            //INFO
            //velikosti souborů
            $info_o_soboru = pathinfo($s[$id_foto]["url"]);
            $s[$id_foto]["nazev"] = $info_o_soboru["filename"];
            $s[$id_foto]["typ_s"] = $info_o_soboru["extension"];
            chmod("php/nahrani/tmp-nahrane", 0777);
            $s[$id_foto]["velikost"] = 
                filesize("php/nahrani/tmp-nahrane/".$info_o_soboru["filename"].".".$info_o_soboru["extension"]);
        }
        return $s;
    }
    
    
    public static function pocet_formatu(){
        $sql = "SELECT id_format,nazev_format, count(id_format) as pocet                  
                FROM fotky INNER JOIN formaty using(id_format)
                GROUP BY id_format
                ";
        return self::vybraniDat($sql);
    }
    
    
    public function cena($format,$material,$fotopapir,$deska,$typ,$pocet){
        $Formaty = new Formaty();
        $Desky = new Desky();
        $Fotopapiry = new Fotopapiry();
        $Materialy = new Materialy();
        $Typy = new Typy();
        
        $format_cena = $Formaty->cena($format);
        $deska_cena = $Desky->cena($deska);
        $fotopapir_cena = $Fotopapiry->cena($fotopapir);
        $material_cena = $Materialy->cena($material);
        $typ_cena = $Typy->cena($typ);
    
        return ( ($format_cena+$material_cena+$fotopapir_cena+$deska_cena+$typ_cena)*$pocet );
    }
    
    public function vlozeni($id_o,$fot){
        $db = new Databaze();
        
        $url = $db->pripravaProInput($fot["url"]);
        $typ_s = $db->pripravaProInput($fot["informace"]["typ_s"]);
        $id_o = $db->pripravaProInput($id_o);
        $format = $db->pripravaProInput( $fot["format"]);
        $deska = $db->pripravaProInput($fot["deska"]);
        $typ = $db->pripravaProInput($fot["typ"]);
        $material = $db->pripravaProInput($fot["material"]);
        $fotopapir = $db->pripravaProInput($fot["fotopapir"]);
        $pocet = $db->pripravaProInput($fot["pocet"]);
        $cena = $db->pripravaProInput($fot["cena"]);
    
        
        $sql = "INSERT INTO fotky
                VALUES ('','$url','$typ_s','$id_o','$format','$deska','$typ','$material','$fotopapir','$pocet','$cena')";
        
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
    
    public function vymazatDiakritiku($ret){
        $diakritika = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ', 'Ά', 'ά', 'Έ', 'έ', 'Ό', 'ό', 'Ώ', 'ώ', 'Ί', 'ί', 'ϊ', 'ΐ', 'Ύ', 'ύ', 'ϋ', 'ΰ', 'Ή', 'ή', ' ');
        $bez_diakritiky = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o', 'Α', 'α', 'Ε', 'ε', 'Ο', 'ο', 'Ω', 'ω', 'Ι', 'ι', 'ι', 'ι', 'Υ', 'υ', 'υ', 'υ', 'Η', 'η', '_');
        return str_replace($diakritika, $bez_diakritiky, $ret);
    }
}

?>