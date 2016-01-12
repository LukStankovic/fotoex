<?php 

//VLOZENI <HEAD>
include_once("sablona/head.php");
//VLOZENI headeru, loga a menu
include_once("sablona/hlavicka.php");
?>

<main id="nahrani" class="container stranka">
    <div class="kroky">
        <ul>
            <li class="aktivni"><a href="nahrani.php"><span>1.</span> Nahrání fotografií</a></li>
            <li><span>2.</span> Nastavení parametrů</li>
            <li><span>3.</span> Košík</li>
            <li><span>4.</span> Doručovací údaje</li>
            <li><span>5.</span> Dokončení objednávky</li>
        </ul>
    </div>
    <?php if(!isset($_SESSION["id_uzivatel"])) { ?>
    <div class="prihlasit">
        <i class="fa fa-user"></i> Pokud máte účet, přihlaste se prosím. Můžete se také registrovat.
        <a class="btn pull-right" href="registrace.php">Registrovat se</a>
        <a class="btn pull-right" href="login.php">Přihlášení</a>
    </div>
    <?php } ?>
    <div class="napoveda row">
        <div class="formaty col-md-6">
            <h2>Podpora formátů</h2>
            <p>V našem systému jsou podporovány pouze fotografické formáty. Nelze nahrát komprimované soubory jako jsou .zip, .rar.</p>
            <h3>Seznam podporovaných formátů:</h3>
            
            <div class="row">
                <div class="col-md-3"><img src="img/jpg.png" alt="tiff-format" class="img-responsive ikona"></div>
                <div class="col-md-3"><img src="img/png.png" alt="tiff-format" class="img-responsive ikona"></div>
                <div class="col-md-3"><img src="img/gif.png" alt="tiff-format" class="img-responsive ikona"></div>
                <div class="col-md-3"><img src="img/tiff.png" alt="tiff-format" class="img-responsive ikona"></div>
            </div>
            
            <p><em>Velikost souboru není nijak omezena.</em></p>
        </div>
        <div class="postup col-md-6">
            <h2>Nápověda</h2>
            <p>Vytvořit objednávku je velmi jednoduché. Nepotřebujete k tomu žádný program do vašeho počítače jako u konkurence. 
            Stačí pouze níže nahrát fotografie do vašeho prohlížeče.</p>
            <p>Na dalším kroku nastavíte požadované rozměry a parametry fotografie</p>
            <h3>Nevíte jak dále?</h3>
            <p>Nevíte si rady jak si objednat fotografie, napište nám na náš e-mail <a href="mailto:info@fotoex.cz">inf@fotoex.cz</a> a my vám s radostí poradíme.</p>
        </div>
    </div>
    <form id="fileupload" action="parametry.php" method="POST" enctype="multipart/form-data">
        <div class="row fileupload-buttonbar">
            <div class="col-lg-12">
                <span class="btn fileinput-button">
                    <i class="fa fa-plus-circle"></i>
                    <span>Vybrat fotografie</span>
                    <input type="file" name="files[]" multiple>
                </span>
                <button type="submit" class="btn start">
                    <i class="fa fa-arrow-circle-up"></i>
                    <span>Nahrát vše</span>
                </button>
                <button type="reset" class="btn cancel">
                    <i class="fa fa-ban"></i>
                    <span>Zrušit nahrávání</span>
                </button>
                <button type="button" class="btn delete">
                    <i class="fa fa-trash"></i>
                    <span>Vymazat vybrané</span>
                </button>
                <input type="checkbox" class="toggle">
                <span class="fileupload-process"></span>
            </div>
        </div>
        <table role="presentation" class="table table-striped">
            <tbody class="files">
            
            <?php
            //POKUD EXISTUJÍ FOTOGRAFIE V SESSION    
                
             //VELIKOSTI SOUBORŮ
                function jednotky($byty) {
                    $sz = 'BKMGTP';
                    $factor = floor((strlen($byty) - 1) / 3);
                    return sprintf("%.2f", $byty / pow(1024, $factor)) ." ". @$sz[$factor];
                }   
               
            if(isset($_SESSION["fotky"])){
            //ZRUŠENÍ DISABLED U TLAČÍTKA - protože existují fotografie
            ?>
                <script>
                    $(document).ready(function() {
                        jQuery(".pokracovat").removeClass("disabled");
                    });
                </script>
            <?php 
                foreach($_SESSION["fotky"] as $fotka){
            ?>
                    <tr class="template-download">
                          <td>
                            <span class="preview">
                               
                                <img src="<?php echo $fotka["url"]; ?>" style="max-width:100px; max-heihgt:100px">

                            </span>
                        </td>
                        <td>
                            <p class="name">
                                <?php echo $fotka["nazev"].".".$fotka["format"];?>
                            </p>
                            <input type="hidden" name="fotka[]" value="<?php echo $fotka["url"]; ?>">
                            <input type="hidden" name="miniatura_fotka[]" value="<?php echo $fotka["mini_url"]; ?>">
                        </td>
                        <td>
                            <?php echo jednotky($fotka["velikost"])."B"; ?>
                        </td>
                        <td>
                            <button class="btn delete" data-type="DELETE" data-url="<?php echo $domena;?>/php/nahrani/index.php?file=<?php echo $fotka["nazev"].".".$fotka["format"];?>"
                                <i class="fa fa-trash"></i>
                                <span>Vymazat</span>
                            </button>
                            <input type="checkbox" name="delete" value="1" class="toggle">
            
                        </td>
                    </tr>
                       

            <?php
            }
        }
         ?>   
            
            </tbody>
        </table>
        <button type="submit" class="btn pull-right pokracovat">Pokračovat k nastavení parametrů</button>
    </form>
    <img src="img/fotky-upload.jpg" alt="upload" class="img-responsive" style="margin-top:100px">
</main>

<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>

</script>
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Zpracovávání...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-hneda" style="width:0%;"></div></div>
        </td>
        <td style="text-align:right">
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn start" disabled>
                    <i class="fa fa-arrow-circle-up"></i>
                    <span>Nahrát</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn cancel">
                    <i class="fa fa-ban"></i>
                    <span>Zrušit</span>
                </button>
            {% } %}
        </td>
    </tr>

{% } %}
</script>
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                    <input type="hidden" name="fotka[]" value="{%=file.url%}">
                    <input type="hidden" name="miniatura_fotka[]" value="{%=file.thumbnailUrl%}">
                
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Chyba</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td style="text-align:right">
            {% if (file.deleteUrl) { %}
                <button class="btn delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="fa fa-trash"></i>
                    <span>Vymazat</span>
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">
            {% } else { %}
                <button class="btn cancel">
                    <i class="fa fa-ban"></i>
                    <span>Zrušit</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>

<!-- MULTIUPLOADER -->



<script src="js/multiuploader/vendor/jquery.ui.widget.js"></script>
<script src="http://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
<script src="http://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<script src="http://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
<script src="js/multiuploader/jquery.iframe-transport.js"></script>
<script src="js/multiuploader/jquery.fileupload.js"></script>
<script src="js/multiuploader/jquery.fileupload-process.js"></script>
<script src="js/multiuploader/jquery.fileupload-image.js"></script>
<script src="js/multiuploader/jquery.fileupload-validate.js"></script>
<script src="js/multiuploader/jquery.fileupload-ui.js"></script>
<script src="js/multiuploader/main.js"></script>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
<!--[if (gte IE 8)&(lt IE 10)]>
<script src="js/cors/jquery.xdr-transport.js"></script>
<![endif]-->       
<?php 
//VLOZENI PATICKY
include_once("sablona/paticka.php");
?>