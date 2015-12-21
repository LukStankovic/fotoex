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
    public static function pocetUzivatelu(){
        $sql = "SELECT count(id_uzivatel) AS 'pocet_uzivatelu'
                FROM uzivatele";
        return self::vybraniDat($sql);
    }
    public static function dataPrihlaseni($jmeno,$heslo){
        $db = new Databaze();
        $sql = "SELECT id_uzivatel, login, heslo, salt
                FROM uzivatele
                WHERE login = '$jmeno' AND heslo = '$heslo'";
        
        return self::vybraniDat($sql);
    }
    public static function pocet(){
        $sql = "SELECT count(id_uzivatel) AS 'pocet'
                FROM uzivatele";
        $vysledek = self::vybraniDat($sql);
        return($vysledek[0]->pocet);
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