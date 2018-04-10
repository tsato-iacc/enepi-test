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
  <?= render('shared/ptengine'); ?>
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
              <?php if (\Uri::segment(1) == 'kakaku'): ?>
                <a href="tel:<?= \Config::get('enepi.service.tel_kakaku'); ?>">
                  <?= Asset::img('done/tel_kakaku.png', ['alt' => \Config::get('enepi.service.name')]); ?>
                </a>
              <?php else: ?>
                <a href="tel:<?= \Config::get('enepi.service.tel'); ?>">
                  <?= Asset::img('done/tel.png', ['alt' => \Config::get('enepi.service.name')]); ?>
                </a>
              <?php endif; ?>
            </div>
          <?php else: ?>
            <div>
              <?php if (\Uri::segment(1) == 'kakaku'): ?>
                <?= Asset::img('done/tel_kakaku.png', ['alt' => \Config::get('enepi.service.name')]); ?>
              <?php else: ?>
                <?= Asset::img('done/tel.png', ['alt' => \Config::get('enepi.service.name')]); ?>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </header>

  <?= $content; ?>

  <footer class="contact-footer">
    <div><a href="<?= \Uri::base(); ?>"><?= Asset::img('layout/logo.png'); ?></a></div>
    <p>&copy; 2016 enepi</p>
  </footer>

  <?= Asset::js('front.min.js'); ?>

  <script src="https://ca.iacc.tokyo/js/ca.js"></script>
  <script>capv();</script>

  <?php if (\Request::active()->action == 'sms_confirm'): ?>
    <!-- kakaku & cacv estimate_presentation_tail tags START -->
    <?= render('front/contacts/estimate_presentation_tail', ['contact' => $contact]); ?>
    <!-- kakaku & cacv tags END -->
  <?php elseif (\Request::active()->action == 'done'): ?>
    <!-- kakaku & cacv done_tail tags START -->
    <?= render('front/contacts/done_tail', ['contact' => $contact]); ?>
    <!-- kakaku & cacv tags END -->
  <?php endif; ?>

  <!-- KAKAKU TAG START -->
  <?php if ($contact->tracking && $contact->tracking->name == 'kakaku_sp'): ?>
    <script src="//assets.adobedtm.com/3687940b53f7a560587a33c8bb748b9253ff5ea9/satelliteLib-2baf9a6b9fae7a21c0cfb818c33122e38669f89d.js"></script>
  <?php elseif ($contact->tracking && $contact->tracking->name == 'kakaku'): ?>
    <script src="//assets.adobedtm.com/3687940b53f7a560587a33c8bb748b9253ff5ea9/satelliteLib-29577dfd7f420978cd93f3d1b2d6ee3a7d40cf53.js"></script>
  <?php endif; ?>
  <!-- KAKAKU TAG END -->

  <?= render('shared/yahoo_retargeting_ohj9t2sb5y'); ?>
  <?= render('shared/google_remarketing_835778474'); ?>
  <?= render('shared/facebook_pixel_code'); ?>

</body>
</html>
