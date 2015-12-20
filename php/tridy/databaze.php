<?php
class Databaze{

    private $nazev_databaze;
    private $server;
    private $login_jmeno;
    private $heslo;
    public $pripojeni;
    
    public function __construct(){
        $this->server = "localhost";
        $this->login_jmeno = "root";
        $this->heslo = "";
        $this->nazev_databaze = "fotoex";
    }
  
    public function pripojeniKDatabazi(){
        $this->pripojeni = mysqli_connect($this->server, $this->login_jmeno, $this->heslo, $this->nazev_databaze)
                           or die(mysqli_error($this->pripojeni));
        $this->pripojeni->query ("SET NAMES 'utf8'");
    }
    
    public function odpojeniOdDatabaze(){
        if(isset($this->pripojeni)){
            $this->pripojeni->close();
        }
    }
    
    public function vykonaniDotazu($dotaz){
        $this->pripojeniKDatabazi();
        $vysledek = $this->pripojeni->query($dotaz) or die($this->pripojeni->error);
        $this->odpojeniOdDatabaze();
        return $vysledek;
    }
    
    public function rozkouskovaniZaznamu($sql_dotaz){
       
        $vysledek = $this->vykonaniDotazu($sql_dotaz);
        
        if(is_bool($vysledek) == true){
            //$data = $vysledek->fetch_object();
            return $vysledek;
        }
        else{
            $data = array();
            while ($radek = $vysledek->fetch_object()) 
                $data[] = $radek;  
                   
            $vysledek->free_result();
        
        return ($data);
        }
        

    }
    
    public function zpracovani($sql_dotaz){
        $this->rozkouskovaniZaznamu($sql_dotaz);
        return $this->pripojeni->affected_rows;
    }

    public function pripravaProInput($hodnota){
		if (function_exists('mysql_real_escape_string')) {
			if (get_magic_quotes_gpc())	
				$hodnota = stripslashes($hodnota); //lomítka
			$this->pripojeniKDatabazi();
			$hodnota = $this->pripojeni->real_escape_string($hodnota);
		} 
		else {
			if (!$this->get_magic_quotes_gpc())	
				$hodnota = addslashes($hodnota); //přidání lomítek
		}
		return $hodnota;
	}
    
}
    
    
?>