<?php 
class Kosik{
    public $fotky = array();
    public $doprava = array();
    public $platba;
    public $pocet_fotek;
    public $cena_bez_dopravy;
    public $cena_celkem;
    
    public $udaje = array();
    
    public function vlozit(){
        $Formaty = new Formaty();
        $Desky = new Desky();
        $Fotopapiry = new Fotopapiry();
        $Materialy = new Materialy();
        $Typy = new Typy();
        $Fotky = new Fotky();
        
        $formaty = $Formaty->vse();
        $desky = $Desky->vse();
        $typy = $Typy->vse();
        $materialy = $Materialy->vse();
        $fotopapiry = $Fotopapiry->vse();
        
        foreach($_SESSION["fotky"] as $fotka){
            $id_foto = $fotka["id"];
            $this->fotky[$id_foto]["id"] = $id_foto;
            
            $this->fotky[$id_foto]["url"] = $_SESSION["kosik_post"]["foto_url"][$id_foto];
            
            //FORMÁT
            $this->fotky[$id_foto]["format"] = $_SESSION["kosik_post"]["format"][$id_foto];
            foreach($formaty as $format)
                if($format->id == $_SESSION["kosik_post"]["format"][$id_foto])
                    $this->fotky[$id_foto]["format_nazev"] = $format->nazev;
            
            
            //MATERIÁL
            
            if(($_SESSION["kosik_post"]["material"][$id_foto] == null) || ($this->fotky[$id_foto]["material"] == "NULL")){
                $this->fotky[$id_foto]["material"] = 0;
                $this->fotky[$id_foto]["material_nazev"] = "―";
            }
            else{
                //ID MATERIÁLU
                $this->fotky[$id_foto]["material"] = $_SESSION["kosik_post"]["material"][$id_foto];
                //NÁZEV MATERIÁLU
                foreach($materialy as $material)
                    if($material->id == $_SESSION["kosik_post"]["material"][$id_foto])
                        $this->fotky[$id_foto]["material_nazev"] = $material->nazev;
            }
            
            //FOTOPAPÍR
        
            if(($_SESSION["kosik_post"]["fotopapir"][$id_foto] == null) || ($this->fotky[$id_foto]["fotopapir"] == "NULL")){
                $this->fotky[$id_foto]["fotopapir"] = 0;
                $this->fotky[$id_foto]["fotopapir_nazev"] = "―";
            }
            else{
                //ID FOTOPAPÍRU
                $this->fotky[$id_foto]["fotopapir"] = $_SESSION["kosik_post"]["fotopapir"][$id_foto];
                //NÁZEV FOTOPAPÍRU
                foreach($fotopapiry as $fotopapir)
                    if($fotopapir->id == $_SESSION["kosik_post"]["fotopapir"][$id_foto])
                        $this->fotky[$id_foto]["fotopapir_nazev"] = $fotopapir->nazev;
            }
            
            //DESKA
            
            //ID DESKA
            $this->fotky[$id_foto]["deska"] = $_SESSION["kosik_post"]["deska"][$id_foto];
            //NÁZEV DESKA
            foreach($desky as $deska)
                if($deska->id == $_SESSION["kosik_post"]["deska"][$id_foto])
                    $this->fotky[$id_foto]["deska_nazev"] = $deska->nazev;
            
            //TYP
            
            //ID TYP
            $this->fotky[$id_foto]["typ"] = $_SESSION["kosik_post"]["typ"][$id_foto];
            //NÁZEV TYP
            foreach($typy as $typ)
                if($typ->id == $_SESSION["kosik_post"]["typ"][$id_foto])
                    $this->fotky[$id_foto]["typ_nazev"] = $typ->nazev;
            
            //POČET
            $this->fotky[$id_foto]["pocet"] = $_SESSION["kosik_post"]["pocet"][$id_foto];
            //CENA
            $this->fotky[$id_foto]["cena"] = $Fotky->cena(
                $this->fotky[$id_foto]["format"],
                $this->fotky[$id_foto]["material"],
                $this->fotky[$id_foto]["fotopapir"],
                $this->fotky[$id_foto]["deska"],
                $this->fotky[$id_foto]["typ"],
                $this->fotky[$id_foto]["pocet"]
            );
            
            
            //INFORMACE O FOTCE
            
            //URL
            $this->fotky[$id_foto]["informace"]["url"] = $_SESSION["fotky"][$id_foto]["url"];
            $this->fotky[$id_foto]["informace"]["mini_url"] = $_SESSION["fotky"][$id_foto]["mini_url"];
            //ROZMĚRY
            list($sirka, $vyska) = getimagesize($this->fotky[$id_foto]["informace"]["url"]);
            $this->fotky[$id_foto]["informace"]["sirka"] = $sirka;
            $this->fotky[$id_foto]["informace"]["vyska"] = $vyska;
            //INFO
            //velikosti souborů
            $info_o_soboru = pathinfo($this->fotky[$id_foto]["informace"]["url"]);
            $this->fotky[$id_foto]["informace"]["nazev"] = $info_o_soboru["filename"];
            $this->fotky[$id_foto]["informace"]["typ_s"] = $info_o_soboru["extension"];
            chmod("php/nahrani/tmp-nahrane", 0777);
            $this->fotky[$id_foto]["informace"]["velikost"] = filesize("php/nahrani/tmp-nahrane/".$info_o_soboru["filename"].".".$info_o_soboru["extension"]);
            
            
            $this->pocet_fotek++;
        }
        $this->cena_bez_dopravy = self::cenaZaFotky();
        
    }
    
    public function vlozitUdaje(){
        if($_POST["dor_jmeno"])
            $this->udaje["dorucovaci"]["jmeno"] = $_POST["dor_jmeno"];
        else
            $this->udaje["dorucovaci"]["jmeno"] = $_POST["fak_jmeno"];
        
        if($_POST["dor_prijmeni"])
            $this->udaje["dorucovaci"]["prijmeni"] = $_POST["dor_prijmeni"];
        else
            $this->udaje["dorucovaci"]["prijmeni"] = $_POST["fak_prijmeni"];
        
        if($_POST["dor_ulice"])
            $this->udaje["dorucovaci"]["ulice"] = $_POST["dor_ulice"];
        else
            $this->udaje["dorucovaci"]["ulice"] = $_POST["fak_ulice"];
        
        if($_POST["dor_mesto"])
            $this->udaje["dorucovaci"]["mesto"] = $_POST["dor_mesto"];
        else
            $this->udaje["dorucovaci"]["mesto"] = $_POST["fak_mesto"];
        
        if($_POST["dor_psc"])
            $this->udaje["dorucovaci"]["psc"] = $_POST["dor_psc"];
        else
            $this->udaje["dorucovaci"]["psc"] = $_POST["fak_psc"];
        
        if($_POST["dor_zeme"])
            $this->udaje["dorucovaci"]["zeme"] = $_POST["dor_zeme"];
        else
            $this->udaje["dorucovaci"]["zeme"] = $_POST["fak_zeme"];
            
        $this->udaje["fakturacni"]["jmeno"] = $_POST["fak_jmeno"];
        $this->udaje["fakturacni"]["prijmeni"] = $_POST["fak_prijmeni"];
        $this->udaje["fakturacni"]["ulice"] = $_POST["fak_ulice"];
        $this->udaje["fakturacni"]["mesto"] = $_POST["fak_mesto"];
        $this->udaje["fakturacni"]["psc"] = $_POST["fak_psc"];
        $this->udaje["fakturacni"]["zeme"] = $_POST["fak_zeme"];
        
        $this->udaje["uzivatelske"]["email"] = $_POST["uz_email"];
        $this->udaje["uzivatelske"]["telefon"] = $_POST["uz_telefon"];
        
        $this->platba = $_POST["platba"];
        $this->doprava["typ"] = $_POST["doruceni"];
        
        if($_POST["doruceni"] == "Kurýr")
            $this->doprava["cena"] = 70.00;
        if($_POST["doruceni"] == "Česká pošta")
            $this->doprava["cena"] = 30.00;
        
        $this->cena_celkem = $this->cena_bez_dopravy + $this->doprava["cena"];
    }
    
    public function cenaZaFotky(){
        foreach($this->fotky as $id => $fotka){
            $celkem += $this->fotky[$id]["cena"];
        }
        return $celkem;
    }
    
    public function zmenaURL($id,$zmena){
        $this->fotky[$id]["url"] = $zmena;
        $this->fotky[$id]["informace"]["url"] = $zmena;
        $this->fotky[$id]["informace"]["mini_url"] = "";
    }

    public function vymazatFotku($id){
        unset($this->fotky[$id]);
        foreach($_SESSION["kosik_post"] as $i => $foto){
            unset($foto[$id]);
        }
        unset($_SESSION["fotky"][$id]);

    }
    
}
?>