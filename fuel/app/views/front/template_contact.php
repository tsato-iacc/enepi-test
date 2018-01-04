<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="Cache-Control" content="max-age=7200">
  <link rel="icon" href="<?= \Uri::create('favicon.ico?v=2'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?= Html::meta($meta); ?>
  <title><?= $title; ?></title>
  <?= Asset::css('application.css'); ?>
  <?= Asset::css('front.min.css'); ?>
  <?= render('front/ga'); ?>
</head>
<body>

  <div class="container">
    <?= $content; ?>
  </div>
  
  <?php if ($this->pr_tracking_name == "xmarke"): ?>
    <img width="1" height="1" border="0" alt="成果報告タグ" src="https://rsch.jp/common/prom/connectlpimg.php?eqid=8def6277d77504dbc3b8bbaf8e447c56546cb41c&po=0023">
  <?php endif; ?>

  <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
  <?= Asset::js('front.min.js'); ?>
</body>
</html>
