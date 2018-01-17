<!-- FIX ME -->
<div class="btn-group mb-4" role="group" aria-label="CSV">
  <button type="button" class="btn btn-secondary" disabled="disabled">検索結果: 219件</button>
  <button type="button" class="btn btn-secondary" disabled="disabled">現在の検索条件でCSVをダウンロード</button>
  <button type="button" class="btn btn-secondary" disabled="disabled">変更履歴をCSVでダウンロード</button>
</div>

<!-- FORM ESTIMATES START -->
<?= render('admin/_form_estimates', ['estimates' => $estimates]); ?>
<!-- FORM ESTIMATES END -->

<!-- MODAL CANCEL START -->
<?= render('admin/_modal_cancel'); ?>
<!-- MODAL CANCEL END -->

<!-- MODAL INTRODUCE START -->
<?= render('admin/_modal_introduce'); ?>
<!-- MODAL INTRODUCE END -->

<?= \Pagination::instance('estimates')->render(); ?>
