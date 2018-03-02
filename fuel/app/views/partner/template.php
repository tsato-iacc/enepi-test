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

  <?= render('shared/google_tag_manager_noscript.php'); ?>
  <?= render('partner/navbar'); ?>

  <div class="container-fluid area-<?= \Uri::segment(2); ?>">
    <div class="row">
      <div class="col-md-2">
        <?= render('partner/sidebar'); ?>
      </div>

      <div class="col-md-10">
        <!-- ALERTS START -->
        <?php if (Session::get_flash('success')): ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <?= Session::get_flash('success'); ?>
          </div>
        <?php endif; ?>
        <?php if (Session::get_flash('error')): ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <?= Session::get_flash('error'); ?>
          </div>
        <?php endif; ?>
        <!-- ALERTS END -->

        <?= $content; ?>
      </div>
    </div>
  </div>

  <?= render('admin/footer'); ?>
  <?= Asset::js('partner.min.js'); ?>
  <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
</body>
</html>
