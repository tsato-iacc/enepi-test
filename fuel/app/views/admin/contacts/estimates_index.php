<!-- FIX ME -->
<div class="btn-group mb-4" role="group" aria-label="CSV">
  <button type="button" class="btn btn-secondary">全て: <?= count($estimates); ?>件</button>
  <a class="btn btn-secondary" href="<?= \Uri::create('admin/csv/contacts/:id/estimates', ['id' => $id]).'.csv'; ?>" role="button">この問い合わせのCSVをダウンロード</a>
  <button type="button" class="btn btn-secondary">変更履歴をCSVでダウンロード</button>
</div>

<!-- FORM ESTIMATES START -->
<?= render('admin/_table_estimates', ['estimates' => $estimates]); ?>
<!-- FORM ESTIMATES END -->

<!-- MODAL CANCEL START -->
<?= render('admin/_modal_cancel'); ?>
<!-- MODAL CANCEL END -->

<!-- MODAL INTRODUCE START -->
<?= render('admin/_modal_introduce'); ?>
<!-- MODAL INTRODUCE END -->
