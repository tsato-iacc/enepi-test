<?
use Fuel\Core\Asset;
use Fuel\Core\Html;
?>

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
  <?= Asset::css('application.css'); ?>
  <?= Asset::css('estimate_form.css'); ?>

</head>
<body>

  <?= $content; ?>

  <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
  <?= Asset::js('front.min.js'); ?>
</body>
</html>
