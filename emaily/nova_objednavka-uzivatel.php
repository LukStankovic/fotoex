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
                <li>".$Kosik->udaje["fakturacni"]["jmeno"]." ".$Kosik->udaje["fakturacni"]["prijmeni"]."</li>
                <li>".$Kosik->udaje["fakturacni"]["ulice"].", ".$Kosik->udaje["fakturacni"]["mesto"]."</li>
                <li>".$Kosik->udaje["fakturacni"]["psc"]."</li>
                <li>".$Kosik->udaje["fakturacni"]["zeme"]."</li>
            </ul>
            
            <h2 style='color:#856559;font-weight:100;'>Vaše osobní údaje</h2>
            <ul style='list-style:none;padding-left:5px'>
                <li><a style='color: #856559' href='".$Kosik->udaje["uzivatelske"]["email"]."'>".$Kosik->udaje["uzivatelske"]["email"]."</a></li>
                <li>".$Kosik->udaje["uzivatelske"]["telefon"]."</li>
            </ul>
        </div>
        <div style='float: right; width: 50%'>
            <h2 style='color:#856559;font-weight:100;'>Doručovací údaje</h2>
            <ul style='list-style:none;padding-left:5px'>
                <li>".$Kosik->udaje["dorucovaci"]["jmeno"]." ".$Kosik->udaje["dorucovaci"]["prijmeni"]."</li>
                <li>".$Kosik->udaje["dorucovaci"]["ulice"].", ".$Kosik->udaje["dorucovaci"]["mesto"]."</li>
                <li>".$Kosik->udaje["dorucovaci"]["psc"]."</li>
                <li>".$Kosik->udaje["dorucovaci"]["zeme"]."</li>
            </ul>
            
            <h2 style='color:#856559;font-weight:100;'>Platba a doprava</h2>
            <ul style='list-style:none;padding-left:5px'>
                <li><strong>Platba:</strong> ".$Kosik->platba."</li>
                <li><strong>Doprava:</strong>".$Kosik->doprava["typ"]." (".$Kosik->doprava["cena"]." Kč)</li>
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

foreach($Kosik->fotky as $i => $fotka){
    if($i%2 == 0){ 
    $trf[$i] = 
            "<tr style='background:#fff'>
                <td><img src='".$fotka["url"]."' height='80' style='padding:5px'></td>
                <td>".$fotka["format_nazev"]."</td>
                <td>".$fotka["material_nazev"]."</td>
                <td>".$fotka["fotopapir_nazev"]."</td>
                <td>".$fotka["deska_nazev"]."</td>
                <td>".$fotka["typ_nazev"]."</td>
                <td>".$fotka["pocet"]."</td>
                <td><strong><span>".number_format($fotka["cena"], 2, ',', '')."</span> Kč</strong></td>
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
                <td><strong><span>".number_format($fotka["cena"], 2, ',', '')."</span> Kč</strong></td>
            </tr>
            ";        
    }
    }

$paticka ="
        </tbody>
        <tfoot>
            <tr>
                <td style='text-align: right; color:#856559;border-top: 3px solid #856559; line-height:30px;' colspan='8'>Cena za dopravu: ".number_format((float)$Kosik->doprava["cena"], 2, ',', '')." Kč</td>
            </tr>
            <tr>
                <td style='border-top: 1px dotted #856559; text-align: right; color: #856559; font-size:140%;line-height:40px;' colspan='8'>Celková cena: <span>".number_format($Kosik->cena_celkem,2, ',', '')."</span> Kč</td>
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