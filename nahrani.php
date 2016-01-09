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
    <form id="fileupload" action="//jquery-file-upload.appspot.com/" method="POST" enctype="multipart/form-data">
        <div class="row fileupload-buttonbar">
            <div class="col-lg-12">
                <span class="btn fileinput-button">
                    <i class="fa fa-plus-circle"></i>
                    <span>Vybrat soubory</span>
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
        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
    </form>
    <br>

</div>


<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>
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
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn start" disabled>
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Nahrát</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
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
        <td>
            {% if (file.deleteUrl) { %}
                <button class="btn delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Vymazat</span>
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">
            {% } else { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Zrušit</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>

        </main>
         <!-- MULTIUPLOADER -->
        <script src="js/multiuploader/vendor/jquery.ui.widget.js"></script>
        <!-- The Templates plugin is included to render the upload/download listings -->
        <script src="http://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
        <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
        <script src="http://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
        <!-- The Canvas to Blob plugin is included for image resizing functionality -->
        <script src="http://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
        <!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
        <script src="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <!-- blueimp Gallery script -->
        <script src="http://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
        <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
        <script src="js/multiuploader/jquery.iframe-transport.js"></script>
        <!-- The basic File Upload plugin -->
        <script src="js/multiuploader/jquery.fileupload.js"></script>
        <!-- The File Upload processing plugin -->
        <script src="js/multiuploader/jquery.fileupload-process.js"></script>
        <!-- The File Upload image preview & resize plugin -->
        <script src="js/multiuploader/jquery.fileupload-image.js"></script>
        <!-- The File Upload audio preview plugin -->
        <script src="js/multiuploader/jquery.fileupload-audio.js"></script>
        <!-- The File Upload video preview plugin -->
        <script src="js/multiuploader/jquery.fileupload-video.js"></script>
        <!-- The File Upload validation plugin -->
        <script src="js/multiuploader/jquery.fileupload-validate.js"></script>
        <!-- The File Upload user interface plugin -->
        <script src="js/multiuploader/jquery.fileupload-ui.js"></script>
        <!-- The main application script -->
        <script src="js/multiuploader/main.js"></script>
        <!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
        <!--[if (gte IE 8)&(lt IE 10)]>
        <script src="js/cors/jquery.xdr-transport.js"></script>
        <![endif]-->       
<?php 
//VLOZENI PATICKY
include_once("sablona/paticka.php");
?>