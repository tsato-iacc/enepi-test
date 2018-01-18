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
