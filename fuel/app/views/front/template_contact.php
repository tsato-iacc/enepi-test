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

  </head>

  <body>

    <?= $header; ?>

    <?= $content; ?>

    <? if(isset($footer)){ ?>
      <?= $footer; ?>
    <? } ?>
    
    <!-- Yahoo Code for your Target List -->
    <script type="text/javascript" language="javascript">
      /* <![CDATA[ */
      var yahoo_retargeting_id = 'OHJ9T2SB5Y';
      var yahoo_retargeting_label = '';
      var yahoo_retargeting_page_type = '';
      var yahoo_retargeting_items = [{item_id: '', category_id: '', price: '', quantity: ''}];
      /* ]]> */
    </script>
    <script type="text/javascript" language="javascript" src="https://b92.yahoo.co.jp/js/s_retargeting.js"></script>
    <!-- Yahoo Code for your Target List END-->


    <!-- YDN -->
    <script type="text/javascript">
      /* <![CDATA[ */
      var google_conversion_id = 835778474;
      var google_custom_params = window.google_tag_params;
      var google_remarketing_only = true;
      /* ]]> */
    </script>
    <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
    </script>
    <noscript>
      <div style="display:inline;">
        <img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/835778474/?guid=ON&amp;script=0"/>
      </div>
    </noscript>
    <!-- YDN END -->


    <!-- Facebook Pixel Code -->
    <script>
      !function(f,b,e,v,n,t,s){
        if(f.fbq)return;n=f.fbq=function(){
          n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)
        };
        if(!f._fbq)f._fbq=n;n.push=n;
        n.loaded=!0;n.version='2.0';
        n.queue=[];
        t=b.createElement(e);
        t.async=!0;
        t.src=v;
        s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)
      }
      (window, document,'script', 'https://connect.facebook.net/en_US/fbevents.js');
      fbq('init', '593069570863388');
      fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=593069570863388&ev=PageView&noscript=1"/></noscript>
    <!-- End Facebook Pixel Code -->


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
  
    <!-- Google Tag Manager (noscript) -->
    <noscript>
      <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NCCZDM6" height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->


    <?php if ($this->pr_tracking_name == "xmarke"): ?>
      <img width="1" height="1" border="0" alt="成果報告タグ" src="https://rsch.jp/common/prom/connectlpimg.php?eqid=8def6277d77504dbc3b8bbaf8e447c56546cb41c&po=0023">
    <?php endif; ?>

    <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
    <?= Asset::js('bootstrap.min.js'); ?>

    <? if($css_call == 'details' || $css_call == 'old'){ ?>
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
    
  </body>
</html>
