<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="Cache-Control" content="max-age=0">
  <link rel="icon" href="<?= \Uri::create('favicon.ico?v=2'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?= $title; ?></title>
  <?= Asset::css('front.min.css'); ?>
</head>
<body>

  <div class="container">
    <?= $content; ?>
  </div>
  
  <?= Asset::js('front.min.js'); ?>
</body>
</html>
