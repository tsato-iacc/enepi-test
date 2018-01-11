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

  <?= render('front/footer'); ?>

  <?= Asset::js('front.min.js'); ?>
  <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
</body>
</html>
