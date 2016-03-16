<?php 
//VLOZENI <HEAD> VČETNĚ KONFIGURACE
require_once("sablona/head.php");
//VLOZENI headeru, loga a menu
require_once("sablona/hlavicka.php");

?>
<main class="container stranka">
    <div class="uvod-clanku">
        <h1>O nás</h1>
    </div>
    <div class="obsah">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque dapibus vulputate efficitur. Vivamus leo dui, posuere sit amet libero vitae, consequat egestas dui. Nulla ullamcorper lacinia magna, nec fermentum nibh iaculis non. Duis imperdiet enim et elementum ullamcorper. Phasellus fringilla ex at nisi tempor fermentum. Integer ligula quam, luctus at ultrices sed, porttitor sit amet enim. Fusce nec mattis ante. Phasellus dictum, enim nec pharetra aliquam, dolor enim egestas est, eleifend viverra orci risus ac augue. Quisque sit amet tincidunt mauris. Praesent ornare, quam ac fermentum varius, felis dui scelerisque ligula, et blandit odio mi at ligula. Proin molestie sodales augue, porttitor ultricies risus condimentum vehicula. Fusce dignissim varius libero. Nullam in ligula lacus.</p>
        
        <p>Aenean felis enim, pretium eu fringilla at, auctor quis lectus. Integer lectus sem, posuere non bibendum a, fringilla semper erat. Aenean eu risus feugiat, molestie mi sed, bibendum est. Donec ante ipsum, vehicula vitae arcu at, dictum vestibulum neque. Nam sit amet eros id ligula dapibus vulputate sed a neque. Suspendisse id fringilla dui. Curabitur condimentum felis id nunc vestibulum, at semper arcu fringilla. Nulla bibendum volutpat nisl vitae condimentum. Suspendisse laoreet felis sit amet volutpat rutrum. Proin sollicitudin vulputate efficitur.</p>
        
        <p>Vestibulum dignissim urna a purus laoreet placerat. Nulla id augue quis ipsum venenatis finibus. Suspendisse quis dolor id elit posuere placerat non feugiat justo. Pellentesque vehicula posuere ligula, ac aliquam augue congue eu. Duis sodales scelerisque hendrerit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis ut tempus urna. Vestibulum venenatis, turpis at ornare scelerisque, nisl neque luctus elit, nec congue augue dui sit amet diam. Suspendisse tempus egestas quam non fermentum. Suspendisse euismod nulla sed nisl tristique fermentum. Curabitur felis tellus, consequat nec libero non, viverra interdum leo. Quisque ex velit, convallis eu nunc at, tincidunt fringilla ipsum. Nam pellentesque quam ac hendrerit blandit. Donec porttitor risus ante, nec sagittis risus lacinia nec. Donec eu iaculis massa.</p>
        
        <p>Nam lacus ligula, maximus vitae augue nec, interdum volutpat nisl. Fusce ultrices nec leo quis semper. Donec eget faucibus mauris. Nunc pharetra massa vel justo pulvinar interdum. Mauris eu sapien ligula. Donec viverra mauris augue, eu blandit turpis efficitur vitae. Nulla placerat nunc id nunc porta, a sodales ipsum finibus. Cras mauris sapien, egestas quis eros vitae, dapibus elementum mi. Phasellus non neque consequat, sollicitudin nibh sagittis, dapibus tellus. Ut varius nisl a est finibus, eget hendrerit velit consectetur.</p>
    </div>
</main>
<script>
    $("body").attr("id","home");
</script>
<?php 
//VLOZENI PATICKY
require_once("sablona/paticka.php");
?>