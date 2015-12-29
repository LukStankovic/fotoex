<?php

class Uzivatele{
    private $id_uzivatel;
    private $login;
    private $heslo;
    private $salt;
    private $jmeno;
    private $prijmeni;
    private $email;
    private $prava;
    private $ulice;
    private $mesto;
    private $psc;
    private $stat;

    public static function vybraniDat($sql){
        $db = new Databaze();
        return $db->rozkouskovaniZaznamu($sql);
    }
     public static function vse(){
        $sql = "SELECT *
                FROM uzivatele";
        
        return self::vybraniDat($sql);
    }
    public static function vzitSalt($jmeno){
        $sql = "SELECT salt 
                FROM uzivatele 
                WHERE login = '$jmeno'";
        $objekt_sul = self::vybraniDat($sql);
        return $objekt_sul[0]->salt;
    }
    public static function detailUzivatele($id){
        $sql = "SELECT * 
                FROM uzivatele 
                WHERE id_uzivatel = '$id'";
        $objekt = self::vybraniDat($sql);
        return $objekt[0];
    }
    
    public static function pocetUzivatelu(){
        $sql = "SELECT count(id_uzivatel) AS 'pocet_uzivatelu'
                FROM uzivatele";
        return self::vybraniDat($sql);
    }
    public static function dataPrihlaseni($jmeno,$heslo){
        $db = new Databaze();
        $sql = "SELECT id_uzivatel, login, heslo, salt
                FROM uzivatele
                WHERE login = '$jmeno' AND heslo = '$heslo' AND prava = 2";
        
        return self::vybraniDat($sql);
    }
    public static function pocet(){
        $sql = "SELECT count(id_uzivatel) AS 'pocet'
                FROM uzivatele";
        $vysledek = self::vybraniDat($sql);
        return($vysledek[0]->pocet);
    }
    public function vlozeni($data){
        $db = new Databaze();

        $options = [
            'cost' => 10,
            'salt' => uniqid(mt_rand(),true),
        ];
        //přípava dat
        
        $login = $db->pripravaProInput($data["login"]);
        $heslo = $db->pripravaProInput(password_hash($data["heslo"], PASSWORD_BCRYPT, $options));
        $salt = $options["salt"];
        $jmeno = $db->pripravaProInput($data["jmeno"]);
        $prijmeni = $db->pripravaProInput($data["prijmeni"]);
        $email = $db->pripravaProInput($data["email"]);
        $telefon = $db->pripravaProInput($data["telefon"]);
        $prava = $db->pripravaProInput($data["prava"]);
        $ulice = $db->pripravaProInput($data["ulice"]);
        $mesto = $db->pripravaProInput($data["mesto"]);
        $psc = $db->pripravaProInput($data["psc"]);
        $zeme = $db->pripravaProInput($data["zeme"]);

        $sql = "INSERT INTO uzivatele (login, heslo, salt, jmeno, prijmeni, email, telefon, prava, ulice, mesto, psc, zeme)
                VALUES ('$login','$heslo','$salt','$jmeno','$prijmeni','$email','$telefon','$prava','$ulice','$mesto','$psc','$zeme')";
        
        return $db->zpracovani($sql);
    }  
    public function upravit($id,$data) {
        $db = new Databaze();    
        
        $jmeno = $db->pripravaProInput($data["jmeno"]);
        $prijmeni = $db->pripravaProInput($data["prijmeni"]);
        $email = $db->pripravaProInput($data["email"]);
        $telefon = $db->pripravaProInput($data["telefon"]);
        $prava = $db->pripravaProInput($data["prava"]);
        $ulice = $db->pripravaProInput($data["ulice"]);
        $mesto = $db->pripravaProInput($data["mesto"]);
        $psc = $db->pripravaProInput($data["psc"]);
        $zeme = $db->pripravaProInput($data["zeme"]);
        
        $sql = "UPDATE uzivatele SET jmeno  = '$jmeno', prijmeni = '$prijmeni', email = '$email', telefon = '$telefon', prava = '$prava', ulice = '$ulice', mesto = '$mesto', psc = '$psc', zeme = '$zeme'
                WHERE id_uzivatel = $id";
    
        return $db->zpracovani($sql);
    }
    public function vymazat($id){
       $db = new Databaze();
        $sql = "DELETE FROM uzivatele
                WHERE id_uzivatel = $id";
        return $db->zpracovani($sql); 
    }
   
    public function prihlaseniUzivatele($jmeno,$heslo){
        $db = new Databaze();
    
        
        $errmsg_arr = array(); //pole pro errory
        $errflag = false;
        
        if( ($jmeno == '') && ($heslo == '') ){
            $errmsg_arr[] = 'Musíte zadat jméno a heslo';
            $errflag = true;
	   }
	   else if($jmeno == '') {
	       $errmsg_arr[] = 'Musíte zadat jméno';
	       $errflag = true;
	   }
	   else if($heslo == '') {
           $errmsg_arr[] = 'Musíte zadat heslo';
           $errflag = true;
	   }
        
        //Při špatném zadání vrácení zpět na login
	   if($errflag) {
		  $_SESSION['pole_chyb'] = $errmsg_arr; 
		  session_write_close();
		  header("location: index.php");
		  exit();
	   }
	   //SQL
        $salt = self::vzitSalt($jmeno);
        $options = [
            'cost' => 10,
            'salt' => $salt,
        ];    

        $vysledek = self::dataPrihlaseni($jmeno,password_hash($heslo, PASSWORD_BCRYPT, $options));
        
        if($vysledek) {
		  if($vysledek > 0) {
			//Úspěšné
            
            session_regenerate_id();
			$_SESSION['id_uzivatel'] = $vysledek[0]->id_uzivatel;
			$_SESSION['login_uziv'] = $vysledek[0]->login;
			$_SESSION['heslo_uziv'] = $vysledek[0]->heslo;

			session_write_close();
			header("location: home.php?page=nastenka");
			exit();
		  }
			//Neúspěšné	
	   }
        else {
		  $errmsg_arr[] = 'Jméno nebo heslo nesouhlasí';
			$errflag = true;
			if($errflag) {
				$_SESSION['pole_chyb'] = $errmsg_arr;
				session_write_close();
				header("location: index.php");
				exit();
			}
	   }
    }

}

?>