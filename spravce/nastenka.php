       <?php
$vsichni_uzivatele = $Uzivatele->vse();
$vsechny_objednavky = $Objednavky->vse();
$objednavky_s_pocty = $Objednavky->pocetZaDen();
$vsechny_fotky = $Fotky->vse();
$pocet_formatu = $Fotky->pocet_formatu();
$celkem_objednavek = $Objednavky->pocetObjednavek();
$celkem_uzivatelu = $Uzivatele->pocet();
$celkem_trzby = $Objednavky->trzby();
$celkem_clanku = $Clanky->pocet();
        ?>
    <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">Nástěnka</h1>
            </div>
    </div>               
    <div class="row">       
        <div class="col-md-8">
            <h3>Historie objednávek</h3>
            <div id="pocet_objednavek" style="height: 300px;"></div>
        </div>
        <div class="col-md-4">
            <h3>Nejprodávanější formáty</h3>
            <div id="pocet_zeme"  style="height: 300px;"></div>
        </div>    
    </div>
    <div class="row">
        <div class="col-md-3">
            <section class="panel panel-box trzby">
                <div class="panel-left panel-item bg-trzby">
                    <i class="fa fa-eur stat-icon"></i>
                </div>
                <div class="panel-right panel-item">
                    <p class="nadpis"><span class="cislo"></span> Kč</p>
                    <p class="text-muted no-margin"><span>Tržby</span></p>
                </div>
            </section>
        </div>
        <div class="col-md-3">
            <section class="panel panel-box objednavky">
                <div class="panel-left panel-item bg-objednavky">
                    <i class="fa fa-shopping-cart stat-icon"></i>
                </div>
                <div class="panel-right panel-item">
                    <p class="nadpis"></p>
                    <p class="text-muted no-margin"><span>Počet objednávek</span></p>
                </div>
            </section>        
        </div>
        <div class="col-md-3">
            <section class="panel panel-box uzivatele">
                <div class="panel-left panel-item bg-uzivatele">
                    <i class="fa fa-users stat-icon"></i>
                </div>
                <div class="panel-right panel-item">
                    <p class="nadpis"></p>
                    <p class="text-muted"><span>Počet uživatelů</span></p>
                </div>
            </section>        
        </div>
        <div class="col-md-3">
            <section class="panel panel-box clanky">
                <div class="panel-left panel-item bg-clanky">
                    <i class="fa fa-pencil stat-icon"></i>
                </div>
                <div class="panel-right panel-item">
                    <p class="nadpis">0</p>
                    <p class="text-muted"><span>Počet článků</span></p>
                </div>
            </section>        
        </div>
    </div>
<script>

Morris.Line({
  element: 'pocet_objednavek',
  data: [
    <?php foreach($objednavky_s_pocty as $i => $objednavka){ ?>
        { dny: '<?php echo date("Y-m-d",strtotime($objednavka->datum)); ?>', pocet: <?php echo $objednavka->pocet_obj; ?>},
    <?php } ?>
  ],
  xkey: 'dny',
  ykeys: ['pocet'],
  labels: ['Počet objednávek']
});
Morris.Donut({
  element: 'pocet_zeme',
  data: [
    <?php foreach($pocet_formatu as $i => $format){ ?>
        {label: "<?php echo $format->nazev_format; ?>", value: <?php echo $format->pocet; ?>},
    <?php } ?>
  ]
});
//ANIMACE PRO ZVYŠOVÁNÍ ČÍSLA
$('.trzby .cislo').prop('number', 0).animateNumber({
    number: <?php echo $celkem_trzby; ?>
},1000);
$('.objednavky .nadpis').prop('number', 0).animateNumber({
    number: <?php echo $celkem_objednavek; ?>
},1000);
$('.uzivatele .nadpis').prop('number', 0).animateNumber({
    number: <?php echo $celkem_uzivatelu; ?>
},1000);
$('.clanky .nadpis').prop('number', 0).animateNumber({
    number: <?php echo $celkem_clanku; ?>
},1000);
                        
</script>
