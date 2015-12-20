<?php

class Uzivatele{
    private $id_uzivatel;
    private $login;
    private $heslo;
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
    public static function pocetUzivatelu(){
        $sql = "SELECT count(id_uzivatel) AS 'pocet_uzivatelu'
                FROM uzivatele";
        return self::vybraniDat($sql);
    }
    public static function dataPrihlaseni($jmeno,$heslo){
        $db = new Databaze();
        $sql = "SELECT id_uzivatel, login, heslo
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
    public function vytvoreniUzivatele($login_u,$heslo_u,$jmeno_u,$prijmeni_u,$email_u,$fotka_u,$popis_u,$url_u,$pohlavi_u){
        $db = new Databaze();
        
        //přípava dat
        
        $login = $db->pripravaProInput($login_u);
        $heslo = $db->pripravaProInput(sha1($heslo_u));
        $jmeno = $db->pripravaProInput($jmeno_u);
        $prijmeni = $db->pripravaProInput($prijmeni_u);
        $email = $db->pripravaProInput($email_u);
        $url = $db->pripravaProInput($url_u);
        $pohlavi = $db->pripravaProInput($pohlavi_u);
        $fotka = $db->pripravaProInput($fotka_u);
        $popis = $db->pripravaProInput($popis_u);
            
        $sql = "INSERT INTO uzivatele (login, heslo, jmeno, prijmeni, email, url_adresa, fotka, popis, pohlavi)
                VALUES ('$login','$heslo','$jmeno','$prijmeni','$email','$url','$fotka','$popis','$pohlavi')";
        
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
        $vysledek = self::dataPrihlaseni($jmeno,sha1($heslo));
        
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