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
  <?= Asset::css('front.min.css'); ?>
  <?= render('shared/google_tag_manager.php'); ?>
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
      <div class="logo-wrap pos-right">
        <div class="enepi-tel">
          <?php if ($is_mobile): ?>
            <div>
              <a href="tel:<?= \Config::get('enepi.service.tel'); ?>">
                <?= Asset::img('layout/enepi_tel.png', ['alt' => 'enepi']); ?>
              </a>
            </div>
          <?php else: ?>
            <div><?= Asset::img('layout/enepi_tel.png', ['alt' => 'enepi']); ?></div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </header>

  <?= $content; ?>

  <footer>
    <div class="footer">
      <div class="container">
        <div class="clearfix">
          <div class="footer-logo text-center"></div>
        </div>
        <div class="footer-copyright text-center">© 2016 enepi</div>
      </div>
    </div>
  </footer>

  <?= Asset::js('front.min.js'); ?>
  <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>

  <script src="https://ca.iacc.tokyo/js/ca.js"></script>
  <script>capv();</script>
</body>
</html>
