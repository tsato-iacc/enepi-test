<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="robots" content="noindex">
  <meta http-equiv="Cache-Control" content="max-age=0">
  <link rel="icon" href="<?= \Uri::create('favicon.ico?v=2'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?= $title; ?></title>
  <?= Asset::css('admin.min.css'); ?>
  <?= render('shared/google_tag_manager'); ?>
</head>
<body>
  <?= render('admin/navbar'); ?>

  <div class="container-fluid">
    <div class="row">      
      <div class="col-md-2">
        <?= render('admin/sidebar'); ?>
      </div>

      <div class="col-md-10">
        <ol class="breadcrumb">
          <%= render_breadcrumbs tag: 'li', separator: "" %>
        </ol>        
        <?= $content; ?>
      </div>
    </div>
  </div>
  
  <?= Asset::js('admin.min.js'); ?>
  <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
</body>
</html>
