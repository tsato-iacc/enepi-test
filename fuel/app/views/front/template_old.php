<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="Cache-Control" content="max-age=7200">
  <link rel="icon" href="<?= \Uri::create('favicon.ico?v=2'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?= Html::meta($meta); ?>
  <title><?= $title; ?></title>
  <?= Asset::css('front_old.min.css'); ?>
  <?= render('front/ga'); ?>
  <?php if (\Uri::segment(1) == 'enechange'): ?>
    <?= render('shared/enechange_tag_manager'); ?>
  <?php endif; ?>
</head>
<body>

  <header class="pr-media">
    <?php if (\Uri::segment(1) == 'enechange'): ?>
      <?= render('shared/enechange_tag_manager_noscript'); ?>
      <div class="logo-center">
        <?= Asset::img('enechange/logo.enechange.png'); ?>
      </div>
    <?php else: ?>
      <div class="container-wrap">
        <div class="logo-wrap pos-left">
          <div class="logo">
            <div><a href="<?= \Uri::base(); ?>"><?= Asset::img('layout/logo.png'); ?></a></div>
          </div>
        </div>
        <div class="navi-wrap">
          <h1>プロパンガスの料金一括比較サービス</h1>
        </div>
        <div class="logo-wrap pos-right">
          <div class="enepi-tel">
            <?php if ($is_mobile): ?>
              <div>
                <a href="tel:<?= \Config::get('enepi.service.tel'); ?>">
                  <?= Asset::img('layout/enepi_tel.png', ['alt' => 'Enepi']); ?>
                </a>
              </div>
            <?php else: ?>
              <div><?= Asset::img('lpgas_contacts/header-catch.png', ['alt' => \Config::get('enepi.service.name')]); ?></div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </header>

  <div class="no-breadcrumb"></div>
  <div class="container">
    <?= $content; ?>
  </div>

  <?php if ($this->pr_tracking_name == "xmarke"): ?>
    <img width="1" height="1" border="0" alt="成果報告タグ" src="https://rsch.jp/common/prom/connectlpimg.php?eqid=8def6277d77504dbc3b8bbaf8e447c56546cb41c&po=0023">
  <?php endif; ?>

  <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
  <?= Asset::js('front.min.js'); ?>

  <script src="https://ca.iacc.tokyo/js/ca.js"></script>
  <script>capv();</script>
</body>
</html>
