<?php
header('Content-Type: text/html; charset=utf-8');
require_once("php/PHPMailer/PHPMailerAutoload.php");
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;

$mail->Host = "mail.forsite.cz";

$mail->SMTPSecure = "ssl";
$mail->Port = 465;

$mail->Username = "objednavky@stankoviclukas.cz";
$mail->Password = "fotoex_dmp_109";

$mail->AddAddress($_POST["uz_email"]);
$mail->From = "objednavky@stankoviclukas.cz";

$mail->FromName = "FotoEx";
$mail->Subject = "Objednávka fotografií na FotoEx.cz";
$mail->AddReplyTo("info@fotoex.cz","FotEx");
$mail->IsHTML(true);

$prvni = "<html>
    <head>
    <meta charset='utf-8'>
    </head>
    <body style='font-family: Helvetica,sans-serif'>
    <div style='width:100%;height:80px;line-height:80px;background:#856559; text-align:center'>
        <h1 style='color:#fff;font-weight:100'>Děkujeme Vám za objednávku</h1>
    </div>
    
    <div style='margin: 20px 0px; padding: 5px 20px'>
        <div style='float: left; width: 49%'>
            <h2 style='color:#856559;font-weight:100;'>Fakturační údaje</h2>
            <ul style='list-style:none;padding-left:5px'>
                <li>".$data_obj["fak_jmeno"]." ".$data_obj["fak_prijmeni"]."</li>
                <li>".$data_obj["fak_ulice"].", ".$data_obj["fak_mesto"]."</li>
                <li>".$data_obj["fak_psc"]."</li>
                <li>".$data_obj["fak_zeme"]."</li>
            </ul>
            
            <h2 style='color:#856559;font-weight:100;'>Vaše osobní údaje</h2>
            <ul style='list-style:none;padding-left:5px'>
                <li><a style='color: #856559' href='".$_POST["uz_email"]."'>".$_POST["uz_email"]."</a></li>
                <li>".$_POST["uz_telefon"]."</li>
            </ul>
        </div>
        <div style='float: right; width: 50%'>
            <h2 style='color:#856559;font-weight:100;'>Doručovací údaje</h2>
            <ul style='list-style:none;padding-left:5px'>
                <li>".$data_obj["fak_jmeno"]." ".$data_obj["fak_prijmeni"]."</li>
                <li>".$data_obj["fak_ulice"].", ".$data_obj["fak_mesto"]."</li>
                <li>".$data_obj["fak_psc"]."</li>
                <li>".$data_obj["fak_zeme"]."</li>
            </ul>
            
            <h2 style='color:#856559;font-weight:100;'>Platba a doprava</h2>
            <ul style='list-style:none;padding-left:5px'>
                <li><strong>Platba:</strong> ".$data_obj["platba"]."</li>
                <li><strong>Doprava:</strong>".$data_obj["doruceni"]." (".$data_obj["doruceni_cena"]." Kč)</li>
            </ul>
            <p style='font-style:italic; color:#f00'>Při platbě převodem peníze pošlete na účet xxxxxxxxx/xxxx</p>
        </div>
    </div>

    <table style='width:95%; margin-top:10px;text-align:center;padding:0' cellspacing='0' cellpadding='0'>
        <thead>
            <tr style='color:#856559; line-height:40px;'>
                <th style='border-bottom:2px solid #856559'>Fotografie</th>
                <th style='border-bottom:2px solid #856559'>Formát</th>
                <th style='border-bottom:2px solid #856559'>Materiál</th>
                <th style='border-bottom:2px solid #856559'>Fotopapír</th>
                <th style='border-bottom:2px solid #856559'>Deska</th>
                <th style='border-bottom:2px solid #856559'>Typ</th>
                <th style='border-bottom:2px solid #856559'>Počet</th>
                <th style='border-bottom:2px solid #856559'>Cena</th>
            </tr>
        </thead>
        <tbody>
        ";

foreach($_SESSION["kosik"] as $i => $fotka){
    if($i%2 == 0){ 
    $trf[$i] = 
            "<tr style='background:#fff'>
                <td><img src='$url[$i]' height='80' style='padding:5px'></td>
                <td>".$fotka["format_nazev"]."</td>
                <td>".$fotka["material_nazev"]."</td>
                <td>".$fotka["fotopapir_nazev"]."</td>
                <td>".$fotka["deska_nazev"]."</td>
                <td>".$fotka["typ_nazev"]."</td>
                <td>".$fotka["pocet"]."</td>
                <td><strong><span>".$fotka["cena_fotka"]."</span> Kč</strong></td>
            </tr>
            ";
    }
    else{
        $trf[$i] = "<tr style='background:#e8deda'>
                <td><img src='$url[$i]' height='80' style='padding:5px'></td>
                <td>".$fotka["format_nazev"]."</td>
                <td>".$fotka["material_nazev"]."</td>
                <td>".$fotka["fotopapir_nazev"]."</td>
                <td>".$fotka["deska_nazev"]."</td>
                <td>".$fotka["typ_nazev"]."</td>
                <td>".$fotka["pocet"]."×</td>
                <td><strong><span>".$fotka["cena_fotka"]."</span> Kč</strong></td>
            </tr>
            ";        
    }
    }

$paticka ="
        </tbody>
        <tfoot>
            <tr>
                <td style='text-align: right; color:#856559;border-top: 3px solid #856559; line-height:30px;' colspan='8'>Cena za dopravu: ".$data_obj["doruceni_cena"]." Kč</td>
            </tr>
            <tr>
                <td style='border-top: 1px dotted #856559; text-align: right; color: #856559; font-size:140%;line-height:40px;' colspan='8'>Celková cena: <span>$celkem_cena</span> Kč</td>
            </tr>
        </tfoot>
    </table>
</body>

</html>
"; 
$mail->Body = $prvni.implode($trf).$paticka;
$mail->CharSet = "utf-8";

if($mail->Send()) {
   echo '';
} 
else
	echo '<div style="font-family: Arial; width=400px; text-align:center; margin-top:100px;">Chyba: ' . $mail->ErrorInfo . '</div>';

?> 