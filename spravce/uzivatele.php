<?php 
    $vsichni_uzivatele = $Uzivatele->vse();

?>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Uživatelé</h1>
        </div>
    </div>

	<div id="main">
	  <div class="row">
		<div class="col-md-12 clanky-nadpisy">			
	
			<table>
				<table>
                            <tr>
                                <th>ID</th>
                                <th>Login</hr>
                                <th>Jméno</th>
                                <th>Příjmení</th>
                                <th>E-mail</th>
                                <th>Telefon</th>
                                <th>Práva</th>
                                <th>Adresa</th>
                                <th>Stát</th>
                                <th>Akce</th>
                            </tr>
                            <?php foreach($vsichni_uzivatele as $uzivatel){ ?>
                            <tr>
                                <td><?php echo $uzivatel->id_uzivatel; ?></td>
                                <td><?php echo $uzivatel->login; ?></td>
                                <td><?php echo $uzivatel->jmeno; ?></td>
                                <td><?php echo $uzivatel->prijmeni; ?></td>
                                <td><a href="mailto:<?php echo $uzivatel->email; ?>"><?php echo $uzivatel->email; ?></a></td>
                                <td><a href="tel:<?php echo $uzivatel->telefon; ?>"><?php echo $uzivatel->telefon; ?></a></td>
                                <td><?php echo $uzivatel->prava; ?></td>
                                <td><?php echo $uzivatel->ulice.", ".$uzivatel->mesto.", ".$uzivatel->psc; ?></td>
                                <td><?php echo $uzivatel->zeme; ?></td>
                                <td>
                                    <a href="?page=detail-uzivatele&id-uzivatele=<?php echo $uzivatel->id_uzivatel;?>"><i class="fa fa-eye"></i></a>
                                    <a href="?page=uzivatele&action=vymazat&id-uzivatele=<?php echo $uzivatel->id_uzivatel;?>"><i class="fa fa-remove"></i></a>
                                </td>
                            </tr>
                            <?php } ?>
                        </table>
			</table>
		</div>
	
	  </div>
	</div>

