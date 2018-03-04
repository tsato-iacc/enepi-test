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
<?= render('shared/google_tag_manager'); ?>
<?= Asset::css('front.min.css'); ?>
</head>
<body>

<?= render('shared/google_tag_manager_noscript.php'); ?>

  <header>
    <div class="container-wrap">
      <div class="logo-wrap pos-left">
        <div class="logo">
          <div><a href="<?= \Uri::base(); ?>"><?= Asset::img('layout/logo.png'); ?></a></div>
        </div>
      </div>
      <div class="logo-wrap pos-right"></div>
    </div>
  </header>

  <?php if ($lp_005): ?>
    <?= render('shared/estimate_form', ['contact' => new \Model_Contact(), 'month_selected' => 'january', 'lp_005' => true]); ?>
  <?php else: ?>
    <?= render('shared/estimate_form', ['contact' => new \Model_Contact(), 'month_selected' => 'january']); ?>
  <?php endif; ?>

  <?= Asset::css('bootstrap_v4.min.css'); ?>
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

  <?= Asset::js('front.min.js'); ?>
  <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
</body>
</html>
