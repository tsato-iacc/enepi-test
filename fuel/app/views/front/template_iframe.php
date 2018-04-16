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
  <?= Asset::css('iframe.min.css'); ?>
</head>
<body>
  <?= $content; ?>

  <?= Asset::js('iframe.min.js'); ?>

  <script src="https://ca.iacc.tokyo/js/ca.js"></script>
  <script>capv();</script>

</body>
</html>
