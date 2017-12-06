<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <? set_meta_tags title: 'プロパンガス(LPガス)料金を今より安く！無料比較サービス【enepi -エネピ- 】', site: nil ?>
  <? MyView::description('エネピならプロパンガス料金を複数社から「比較」して、1番おトクなガス会社へ乗り換えられます！年間で最大8万円も安くなることも。ガス代やガス会社にお悩みの方はまずはこちらのフォームから完全無料でご利用頂けます。' ?>
  <? keywords %W(電気料金 ガス料金 比較 ガス自由化 ガス代 enepi エネピ) ?>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:700' rel='stylesheet' type='text/css'>

  <?= display_meta_tags({
    site: Dh::Application.config.site_name,
    separator: "|",
    charset: 'utf-8',
    reverse: true,
  })?>

  <?= stylesheet_link_tag 'lp/lp', media: 'all' ?>
  <?= stylesheet_link_tag 'estimate_form', media: 'all' ?>
  <?= csrf_meta_tags ?>

  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-66015925-1', 'auto');
    ga('send', 'pageview');
  </script>

</head>
  <body id="top" class="lp-004">
  <div class="lp004-header-wrap">
    <div class="guide-header">
      <div class="lp004-logobox">
        <a class="lp004-logo-img"><?= MyView::image_tag(asset_url("logo-v2.png"), :class=>"lp004-logo" ?></a>
      </div>
      <div class="lp004-telbox">
        <? if smart_phone? ?>
          <a href="tel:0120771664" class="lp004-tel-img"><?= MyView::image_tag("estimate_presentation/img_tel.png", :class => 'tel' ?></a>
        <? else ?>
          <a class="lp004-tel-img"><?= MyView::image_tag("estimate_presentation/img_tel.png", :class => 'tel' ?></a>
        <? } ?>
      </div>
    </div>
  </div>

  <?= render "shared/estimate_form" ?>
  <?= render "shared/estimate_slot" ?>

  <footer class="lp004-footer-area">
    <ul class="lp004-footer-ul">
      <li><a data-toggle="modal" data-target="#privacy_modal">利用規約</a></li>
      <li><a href="http://www.iacc.co.jp/privacy/" target="_blank">プライバシーポリシー</a></li>
      <li class="lp004-footer-last"><a href="http://www.iacc.co.jp/" target="_blank">運営会社</a></li>
    </ul>
  </footer>
  <script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>
  <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
  <?= javascript_include_tag 'estimate_form' ?>
  <script src="https://ca.iacc.tokyo/js/ca.js"></script>
  <script>capv();</script>
  
  <?= render "shared/lp_footer_privacy" ?>

  <? if @show_pr_script ?>
    <script type="text/javascript" src="//tm.r-ad.ne.jp/54/rardm_prd_c525785c-be65-46a8-b866-08946f60b96d.js" charset="utf-8"></script>
  <? } ?>
  </body>
</html>
