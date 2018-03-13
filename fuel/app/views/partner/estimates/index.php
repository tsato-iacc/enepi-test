<?php
use JpPrefecture\JpPrefecture;
?>

<?= \Form::open(['method' => 'GET', 'class' => 'mb-4']); ?>
  <div class="form-group row mb-0">
    <div class="col-3">
      <div class="form-group<?= $val->error('status') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="status"><h6>ステータス</h6></label>
        <?= Form::select('status', $val->input('status', ''), ['' => 'none'] + __('admin.estimate.status'), ['class' => 'form-control', 'id' => 'status']); ?>
      </div>
    </div>
    <div class="col-2">
      <div class="form-group<?= $val->error('contact_name_equal') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="contact_name_equal"><h6>名前が等しい</h6></label>
        <input type="text" name="contact_name_equal" value="<?= $val->input('contact_name_equal', '') ?>" class="form-control" id="contact_name_equal">
      </div>
    </div>
    <div class="col-2">
      <div class="form-group<?= $val->error('contact_name_like') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="contact_name_like"><h6>名前を含む</h6></label>
        <input type="text" name="contact_name_like" value="<?= $val->input('contact_name_like', '') ?>" class="form-control" id="contact_name_like">
      </div>
    </div>
    <div class="col-2">
      <div class="form-group<?= $val->error('company_contact_name_like') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="company_contact_name_like"><h6>担当者名(含む)</h6></label>
        <input type="text" name="company_contact_name_like" value="<?= $val->input('company_contact_name_like', '') ?>" class="form-control" id="company_contact_name_like">
      </div>
    </div>
  </div>

  <div class="form-group row mb-0">
    <div class="col-2">
      <div class="form-group<?= $val->error('pref_code') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="pref_code"><h6>都道府県</h6></label>
        <?= Form::select('pref_code', $val->input('pref_code', ''), ['' => 'none'] + JpPrefecture::allKanjiAndCode(), ['class' => 'form-control', 'id' => 'pref_code']); ?>
      </div>
    </div>
    <div class="col-2">
      <div class="form-group<?= $val->error('new_pref_code') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="new_pref_code"><h6>都道府県(開設先)</h6></label>
        <?= Form::select('new_pref_code', $val->input('new_pref_code', ''), ['' => 'none'] + JpPrefecture::allKanjiAndCode(), ['class' => 'form-control', 'id' => 'new_pref_code']); ?>
      </div>
    </div>
    <div class="col-2 pr-0">
      <div class="form-group<?= $val->error('created_from') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="created_from"><h6>紹介日</h6></label>
        <input type="text" name="created_from" value="<?= $val->input('created_from', '') ?>" class="form-control datepicker" id="created_from">
      </div>
    </div>
    <div class="px-1 text-center">
      <div class="form-group">
        <label class="form-control-label"><h6>　</h6></label>
        <p class="form-control-static">~</p>
      </div>
    </div>
    <div class="col-2 pl-0">
      <div class="form-group<?= $val->error('created_to') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="created_to"><h6>　</h6></label>
        <input type="text" name="created_to" value="<?= $val->input('created_to', '') ?>" class="form-control datepicker" id="created_to">
      </div>
    </div>
    <div class="col-2">
      <div class="form-group<?= $val->error('preferred_time') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="preferred_time"><h6>希望連絡時間</h6></label>
        <?= Form::select('preferred_time', $val->input('preferred_time', ''), ['' => 'none'] + __('admin.contact.preferred_contact_time_between'), ['class' => 'form-control', 'id' => 'preferred_time']); ?>
      </div>
    </div>
  </div>

  <button type="submit" class="btn btn-secondary">検索</button>
<?= Form::close(); ?>

<!-- FIX ME -->
<div class="btn-group mb-4" role="group" aria-label="CSV">
  <button type="button" class="btn btn-secondary">検索結果: <?= $total_items; ?>件</button>
  <a class="btn btn-secondary<?= $total_items > 1000 ? ' disabled' : ''; ?>"<?= $total_items > 1000 ? ' aria-disabled="true"' : ''; ?> href="<?= \Uri::create('partner/csv/estimates.csv').'?'.$_SERVER["QUERY_STRING"]; ?>" role="button">現在の検索条件でCSVをダウンロード</a>
</div>

<!-- FORM ESTIMATES START -->
<?= render('admin/_table_estimates', ['estimates' => $estimates]); ?>
<!-- FORM ESTIMATES END -->

<!-- MODAL CANCEL START -->
<?= render('admin/_modal_cancel'); ?>
<!-- MODAL CANCEL END -->

<?= \Pagination::instance('estimates')->render(); ?>
