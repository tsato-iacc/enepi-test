<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Cache-Control" content="max-age=7200">
<link rel="icon" href="<?= \Uri::create('favicon.ico?v=2'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<?= Html::meta($meta); ?>
  <title><?= $title; ?></title>

  <?= render('front/ga'); ?>
  <!--
  <?= Asset::css('application.css'); ?>
  -->
  <?= Asset::css('application_v2.css'); ?>

  <?= Asset::css('estimate_form.css'); ?>
  <?= Asset::css('simulation_estimate_form.css'); ?>
  <!-- This file must be last -->
  <?= Asset::css('front.min.css'); ?>
</head>
<body>
  <?= render('front/header'); ?>

  <?= $content; ?>
  
  <?php if (\Uri::segment(2) == 'new_form'): ?>
    <footer class="footer-new-form">
      <ul>
        <li><a data-toggle="modal" data-target="#privacy_modal">利用規約</a></li>
        <li class="separator">|</li>
        <li><a href="http://www.iacc.co.jp/privacy/" target="_blank">プライバシーポリシー</a></li>
        <li class="separator">|</li>
        <li class="lp004-footer-last"><a href="http://www.iacc.co.jp/" target="_blank">運営会社</a></li>
      </ul>
    </footer>
    <?= render('shared/lp_footer_privacy'); ?>
  <?php else:?>
    <?= render('front/footer'); ?>
  <?php endif;?>

  <?= Asset::js('front.min.js'); ?>
  <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
</body>
</html>
