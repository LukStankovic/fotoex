<?php 
class Kosik{
    public $fotky = array();
    public $doprava = array();
    public $platba;
    public $pocet_fotek;
    public $cena_bez_dopravy;
    public $cena_celkem;
    
    public $dorucovaci_udaje = array();
    public $fakturacni_udaje = array();
    public $uzivatelske_udaje = array();
    
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
            
            $this->fotky[$id_foto]["url"] = $_POST["foto_url"][$id_foto];
            
            //FORMÁT
            $this->fotky[$id_foto]["format"] = $_POST["format"][$id_foto];
            foreach($formaty as $format)
                if($format->id == $_POST["format"][$id_foto])
                    $this->fotky[$id_foto]["format_nazev"] = $format->nazev;
            
            
            //MATERIÁL
            
            if(($_POST["material"][$id_foto] == null) || ($_SESSION["kosik"][$id_foto]["material"] == "NULL")){
                $this->fotky[$id_foto]["material"] = 0;
                $this->fotky[$id_foto]["material_nazev"] = "―";
            }
            else{
                //ID MATERIÁLU
                $this->fotky[$id_foto]["material"] = $_POST["material"][$id_foto];
                //NÁZEV MATERIÁLU
                foreach($materialy as $material)
                    if($material->id == $_POST["material"][$id_foto])
                        $this->fotky[$id_foto]["material_nazev"] = $material->nazev;
            }
            
            //FOTOPAPÍR
        
            if(($_POST["fotopapir"][$id_foto] == null) || ($_SESSION["kosik"][$id_foto]["fotopapir"] == "NULL")){
                $this->fotky[$id_foto]["fotopapir"] = 0;
                $this->fotky[$id_foto]["fotopapir_nazev"] = "―";
            }
            else{
                //ID FOTOPAPÍRU
                $this->fotky[$id_foto]["fotopapir"] = $_POST["fotopapir"][$id_foto];
                //NÁZEV FOTOPAPÍRU
                foreach($fotopapiry as $fotopapir)
                    if($fotopapir->id == $_POST["fotopapir"][$id_foto])
                        $this->fotky[$id_foto]["fotopapir_nazev"] = $fotopapir->nazev;
            }
            
            //DESKA
            
            //ID DESKA
            $this->fotky[$id_foto]["deska"] = $_POST["deska"][$id_foto];
            //NÁZEV DESKA
            foreach($desky as $deska)
                if($deska->id == $_POST["deska"][$id_foto])
                    $this->fotky[$id_foto]["deska_nazev"] = $deska->nazev;
            
            //TYP
            
            //ID TYP
            $this->fotky[$id_foto]["typ"] = $_POST["typ"][$id_foto];
            //NÁZEV TYP
            foreach($typy as $typ)
                if($typ->id == $_POST["typ"][$id_foto])
                    $this->fotky[$id_foto]["typ_nazev"] = $typ->nazev;
            
            //POČET
            $this->fotky[$id_foto]["pocet"] = $_POST["pocet"][$id_foto];
            //CENA
            $this->fotky[$id_foto]["cena"] = $Fotky->cena(
                $this->fotky[$id_foto]["format"],
                $this->fotky[$id_foto]["material"],
                $this->fotky[$id_foto]["fotopapir"],
                $this->fotky[$id_foto]["deska"],
                $this->fotky[$id_foto]["typ"],
                $this->fotky[$id_foto]["pocet"]
            );
            $this->pocet_fotek++;
        }
        $this->cena_bez_dopravy = self::cenaZaFotky();
        
    }
    
    public function vlozitUdaje(){
        if($_POST["dor_jmeno"])
            $this->dorucovaci_udaje["jmeno"] = $_POST["dor_jmeno"];
        else
            $this->dorucovaci_udaje["jmeno"] = $_POST["fak_jmeno"];
        
        if($_POST["dor_prijmeni"])
            $this->dorucovaci_udaje["prijmeni"] = $_POST["dor_prijmeni"];
        else
            $this->dorucovaci_udaje["prijmeni"] = $_POST["fak_prijmeni"];
        
        if($_POST["dor_ulice"])
            $this->dorucovaci_udaje["ulice"] = $_POST["dor_ulice"];
        else
            $this->dorucovaci_udaje["ulice"] = $_POST["fak_ulice"];
        
        if($_POST["dor_mesto"])
            $this->dorucovaci_udaje["mesto"] = $_POST["dor_mesto"];
        else
            $this->dorucovaci_udaje["mesto"] = $_POST["fak_mesto"];
        
        if($_POST["dor_psc"])
            $this->dorucovaci_udaje["psc"] = $_POST["dor_psc"];
        else
            $this->dorucovaci_udaje["psc"] = $_POST["fak_psc"];
        
        if($_POST["dor_zeme"])
            $this->dorucovaci_udaje["zeme"] = $_POST["dor_zeme"];
        else
            $this->dorucovaci_udaje["zeme"] = $_POST["fak_zeme"];
            
        $this->fakturacni_udaje["jmeno"] = $_POST["fak_jmeno"];
        $this->fakturacni_udaje["prijmeni"] = $_POST["fak_prijmeni"];
        $this->fakturacni_udaje["ulice"] = $_POST["fak_ulice"];
        $this->fakturacni_udaje["mesto"] = $_POST["fak_mesto"];
        $this->fakturacni_udaje["psc"] = $_POST["fak_psc"];
        $this->fakturacni_udaje["zeme"] = $_POST["fak_zeme"];
        
        $this->uzivatelske_udaje["email"] = $_POST["uz_email"];
        $this->uzivatelske_udaje["telefon"] = $_POST["uz_telefon"];
        
        $this->platba = $_POST["platba"];
        $this->doprava["typ"] = $_POST["doruceni"];
        
        if($_POST["doruceni"] == "Kurýr")
            $this->doprava["cena"] = 70.00;
        if($_POST["doruceni"] == "Česká pošta")
            $this->doprava["cena"] = 30.00;
    }
    
    public function cenaZaFotky(){
        foreach($this->fotky as $id => $fotka){
            $celkem += $this->fotky[$id]["cena"];
        }
        return $celkem;
    }
    

    
}
?>