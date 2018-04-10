<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="Cache-Control" content="max-age=7200">
    <link rel="icon" href="<?= \Uri::create('favicon.ico?v=2'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?= Html::meta($meta); ?>
    <title><?= $title; ?></title>
    <script
    src="https://code.jquery.com/jquery-1.12.4.min.js"
    integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
    crossorigin="anonymous"></script>
    <?= render('front/ga'); ?>

    <? if($css_call == 'done'){ ?>
      <?= Asset::css('application.css'); ?>
      <?= Asset::css('font-awesome.min.css'); ?>

    <? }elseif($css_call == 'presentation' || $css_call == 'details'){ ?>
      <?= Asset::css('font-awesome.min.css'); ?>
      <?= Asset::css('estimate_presentation.css'); ?>

    <? }elseif($css_call == 'old'){ ?>
      <?= Asset::css('application.css'); ?>
      <?= Asset::css('front.min.css'); ?>
      <?= Asset::js('front.min.js'); ?>

    <? }elseif($css_call == 'index'){ ?>
      <?= Asset::css('application.css'); ?>
      <?= Asset::css('estimate_presentation.css'); ?>
      <?= Asset::css('front.min.css'); ?>
    <? } ?>

    <?= render('shared/google_tag_manager.php'); ?>

  </head>

  <body>

	<?= render('shared/google_tag_manager_noscript.php'); ?>

    <?= $header; ?>

    <?= $content; ?>

    <? if(isset($footer)){ ?>
      <?= $footer; ?>
    <? } ?>

    <?= render('shared/yahoo_retargeting_ohj9t2sb5y'); ?>
    <?= render('shared/google_remarketing_835778474'); ?>
    <?= render('shared/facebook_pixel_code'); ?>

    <script src="https://ca.iacc.tokyo/js/ca.js"></script>
    <script>
      capv();
    </script>



    <div class="hidden_sp">
      <nav class="navbar navbar-fixed-bottom fixed_button_area">
        <div class="container">
          <a href="tel:0120771664"  onclick="ga('send', 'event', 'tel', 'click', 'contact_btn_sp', {'nonInteraction': 1});" class="btn btn-tel"><i class="fa fa-phone ico_tel" aria-hidden="true"></i>電話でのお問い合わせはこちら</a>
        </div>
      </nav>
    </div>



    <?php if ($this->pr_tracking_name == "xmarke"): ?>
      <img width="1" height="1" border="0" alt="成果報告タグ" src="https://rsch.jp/common/prom/connectlpimg.php?eqid=8def6277d77504dbc3b8bbaf8e447c56546cb41c&po=0023">
    <?php endif; ?>

    <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
    <?= Asset::js('bootstrap.min.js'); ?>

    <? if($css_call == 'old'){ ?>
      <?= Asset::js('front.min.js'); ?>
    <? } ?>

    <script>
    　　$(function () {
    　　　　$('[data-toggle="popover"]').popover()
    　　　　$('[data-toggle="popover"]').popover()

    　　　　$('[data-ajax]').on('click', function(e) {
    　　　　　　var $target = $(e.target)
    　　　　　　var href = $target.data('href')
    　　　　　　var method = $target.data('method') || 'GET'
    　　　　　　if (href) {
    　　　　　　　　var xhr = new XMLHttpRequest();
    　　　　　　　　xhr.open(method, href);
    　　　　　　　　xhr.setRequestHeader("Content-Type", "application/json");

    　　　　　　　　xhr.onreadystatechange = function() {
    　　　　　　　　　　if (xhr.readyState == 4) {
    　　　　　　　　　　　　debugger;
    　　　　　　　　　　}
    　　　　　　　　};
    　　　　　　　　xhr.send(JSON.stringify(null));
    　　　　　　}
    　　　　})
    　　});
    </script>
    
    <!-- Google chart -->
    <script type="text/javascript">
      if ($('#simulation_chart').length) {
        google.charts.load('current', {'packages':['corechart']});
            
        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawChart);
          
        function drawChart() {
          var jsonData = $('input[name=google_chart_json_data]').val();
          console.log(jsonData);
              
          // Create our data table out of JSON data loaded from server.
          var data = new google.visualization.DataTable(jsonData);

          // Instantiate and draw our chart, passing in some options.
          var chart = new google.visualization.ColumnChart(document.getElementById('simulation_chart'));
          chart.draw(data, {width: "100%", height: 300, title: "地域平均とエネピ利用時の削減シミュレーション"});
        }
      }
    </script>
  </body>
</html>
