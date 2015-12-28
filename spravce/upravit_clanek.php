	<div id="main " class="upravit_clanek">
       <form method="post" enctype="multipart/form-data">
        <h1 class="page-header">Upravit článek: <?php echo $clanek->nazev;?></h1>   
        
                <input type="hidden" class="form-control" name="id" value="<?php echo $clanek->id_clanek; ?>">
                
                <div class="form-group">
                    <label for="nadpis" class="control-label">Nadpis: </label>
                    <input type="text" class="form-control" name="nadpis" value="<?php echo $clanek->nazev; ?>" required>
                </div>
                <?php if($clanek->cover != NULL){ ?>
                <div class="cover" style="background:url(../clanky/<?php echo $clanek->cover;?>) center; background-size: cover">
                    <a href="#" class="vymazat"><i class="fa fa-remove"></i></a>
                </div>
                <div class="form-group cover-input">
                    <label for="cover" class="control-label">Úvodní fotogragie: </label>
                    <input type="file" name="cover">                
                </div>
                <input type="hidden" class="form-control" name="cover_existujici" value="<?php echo $clanek->cover; ?>">
                <?php }else{?>
                <div class="form-group">
                    <label for="cover" class="control-label">Úvodní fotogragie: </label>
                    <input type="file" name="cover">                
                </div>
                <?php } ?>
                <div class="form-group">
                    <label for="obsah" class="control-label">Text článku:</label>
                    <textarea  class="form-control" name="obsah"><?php echo $clanek->obsah; ?></textarea>
                </div>

        <div class="btn"><a href="?page=clanky">← Zpět bez uložení</a></div>
        <button type="submit" name="ulozit" class="ulozit btn pull-right">Uložit</div>
        </form>
    </div>
<script>
$("table").filterTable();
$(document).ready(function(){
    $(".cover-input").hide();
    $('a.vymazat').on('click',function(e){
        $(".cover").fadeOut("fast");
        $(".cover-input").fadeIn("slow");
    });
    
});
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