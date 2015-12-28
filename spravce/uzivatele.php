    <div id="main" class="uzivatele">
        <h1 class="page-header">Uživatelé</h1>

        <div class="btn novy">
            <a href="#" data-toggle="modal" data-target="#modalniOkno">Vytvořit nového uživatele</a>
        </div>	
	    <div class="tabulka">
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
                        <a href="?page=uzivatele&akce=vymazat&id-uzivatele=<?php echo $uzivatel->id_uzivatel;?>"><i class="fa fa-remove"></i></a>
                    </td>
                </tr>
                <?php } ?>
	    </table>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalniOkno" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
       <form method="post">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Vytvořit nového uživatele</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="login" class="control-label">Login: </label>
            <input type="text" class="form-control" name="login" required>
        </div>    
        <div class="form-group">
            <label for="heslo" class="control-label">Heslo: </label>
            <input type="text" class="form-control" name="heslo" required>
        </div>
        <div class="form-group">
            <label for="jmeno" class="control-label">Jméno: </label>
            <input type="text" class="form-control" name="jmeno" required>
        </div>
        <div class="form-group">
            <label for="prijmeni" class="control-label">Příjmení: </label>
            <input type="text" class="form-control" name="prijmeni" required>
        </div>
        <div class="form-group">
            <label for="email" class="control-label">E-mail: </label>
            <input type="text" class="form-control" name="email" required>
        </div>
        <div class="form-group">
            <label for="telefon" class="control-label">Telefon: </label>
            <input type="text" class="form-control" name="telefon" required>
        </div>
        <div class="form-group">
            <label for="prava" class="control-label">Práva: </label>
            <select name="prava">
                <option value="1">Běžný uživatel</option>
                <option value="2">Administrator</option>
            </select>
        </div>
        <div class="form-group">
            <label for="ulice" class="control-label">Ulice: </label>
            <input type="text" class="form-control" name="ulice" required>
        </div>
        <div class="form-group">
            <label for="mesto" class="control-label">Město: </label>
            <input type="text" class="form-control" name="mesto" required>
        </div>
        <div class="form-group">
            <label for="psc" class="control-label">PSČ: </label>
            <input type="text" class="form-control" name="psc" required>
        </div>  
        <div class="form-group">
            <label for="zeme" class="control-label">Země: </label>
            <select name="zeme">
                <option value="Česká republika">Česká republika</option>
                <option value="Slovenská republika">Slovenská republika</option>
            </select>
        </div>           
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default zrusit" data-dismiss="modal">Zrušit</button>
       <!-- <button type="button" name="ulozit" class="btn btn-primary">Uložit</button>-->
       <input type="submit" name="ulozit" class="btn btn-primary ulozit" value="Uložit">
      </div>
          </form>

    </div>
  </div>
</div>
<!-- KONEC MODALU -->   
<script>
    $('table').filterTable();
    $('table').stacktable();
</script>
