	<div id="main " class="clanky">
        <h1 class="page-header">Články</h1>
        <div class="btn novy">
            <a href="#" data-toggle="modal" data-target="#modalniOkno">Vytvořit nový článek</a>
        </div>
        <div class="tabulka">
            <table>
                <thead>
                    <th>ID</th>
                    <th>Úvodní fotografie</th>
                    <th>Nadpis</th>
                    <th>Datum vytvoření</th>
                    <th>Uživatel</th>
                    <th>Akce</th>
                </thead>
                <tbody>
                    <?php foreach($clanky as $clanek){ ?>
                    <tr>
                        <td><?php echo $clanek->id_clanek;?></td> 
                        <td><img src="../clanky/<?php echo $clanek->cover;?>"></td> 
                        <td><?php echo $clanek->nazev;?></td> 
                        <td><?php echo date("j. n. Y, H:i:s",strtotime($clanek->datum));?></td> 
                        <td><?php echo "$clanek->jmeno $clanek->prijmeni ($clanek->login)";?></td> 
                        <td>
                            <a href="?page=upravit-clanek&id-clanek=<?php echo $clanek->id_clanek;?>"><i class="fa fa-pencil"></i></a>
                            <a href="?page=clanky&akce=vymazat&id-clanek=<?php echo $clanek->id_clanek;?>"><i class="fa fa-remove"></i></a>
                        </td>        
                    </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Upravit | Vymazat</td>
                </tfoot>
            </table>
        </div>        

<!-- Modal -->
<div class="modal fade" id="modalniOkno" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
       <form method="post" enctype="multipart/form-data">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           <h4 class="modal-title" id="myModalLabel">Vytvořit nový článek</h4>
      </div>
      <div class="modal-body">
            
                <div class="form-group">
                    <label for="nadpis" class="control-label">Nadpis: </label>
                    <input type="text" class="form-control" name="nadpis" required>
                </div>
                <div class="form-group">
                    <label for="cover" class="control-label">Úvodní fotogragie: </label>
                    <input type="file" name="cover">                
                </div>
                <div class="form-group">
                    <label for="obsah" class="control-label">Text článku:</label>
                    <textarea  class="form-control" name="obsah"></textarea>
                </div>
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default zrusit" data-dismiss="modal">Zrušit</button>
       <input type="submit" name="ulozit" class="btn btn-primary ulozit" value="Uložit">
      </div>
          </form>

    </div>
  </div>
</div>
<!-- KONEC MODALU -->    
   
    
    </div>
<script>
    $("table").filterTable();
    $('table').stacktable();
</script>
<script type="text/javascript" src="tinymce/tinymce.min.js"></script> 			
<script type="text/javascript">
    tinymce.init({
        selector: "textarea[name=obsah]",
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste",
            "autoresize"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        entities: "160,nbsp",
        menubar: false,
        entity_encoding: "named",
        entity_encoding: "raw",
        theme: "modern",
        width: '99.8%',
        height: 400,
        autoresize_min_height: 400,
        autoresize_max_height: 800,
        language : "cs"
    });
</script>