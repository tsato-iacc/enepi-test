<?php use JpPrefecture\JpPrefecture; ?>

<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="<?= \Uri::create('admin/companies/'); ?>">会社一覧</a></li>
  <li class="breadcrumb-item"><a href="<?= \Uri::create('admin/partner_companies/:id/edit', ['id' => $company->partner_company->id]); ?>"><?= $company->getCompanyName(); ?></a></li>
  <li class="breadcrumb-item"><a href="<?= \Uri::create('admin/companies/:id/offices', ['id' => $company->id]); ?>">営業拠点一覧</a></li>
  <li class="breadcrumb-item active">対応可能市区町村</li>
</ol>

<h3>市区町村登録</h3>
<div class="collapse" id="select_collaps">
  <div class="row">
    <?php foreach(JpPrefecture::allKanjiAndCode() as $code => $name): ?>
      <div class="col-2">
        <button type="button" class="area-modal-btn btn btn-sm btn-secondary preview-btn ladda-button w-100 mb-2" data-style="zoom-in" data-code="<?= $code; ?>"><?= $name; ?></button>
      </div>
    <?php endforeach; ?>
  </div>
  <hr>
</div>

<?= \Form::open(); ?>
  <?= \Form::csrf(); ?>
  <div class="form-group row">
    <div class="col-6">
      <div class="form-inline">
        <div class="form-group">
          <label class="mr-sm-2" for="cv_point">市区町村からも選べます。</label>
          <div class="">
            <?= Form::select('prefecture_code', '', ['' => '選択してください'] + JpPrefecture::allKanjiAndCode(), ['class' => 'form-control', 'id' => 'prefecture_code']); ?>
          </div>
          <div class="ml-3">
            <select name="city_code" id="city_list" class="form-control" disabled=""><option value="">選択してください</option></select>
          </div>
        </div>
      </div>
    </div>
    <div class="col-2 offset-4">
      <button class="btn btn-primary w-100" type="button" data-toggle="collapse" data-target="#select_collaps" aria-expanded="false" aria-controls="selectCollaps">まとめて追加</button>
    </div>
  </div>
  
  <div class="form-group mb-0">
    <textarea name="zip_code" class="form-control" id="zip_code" rows="10"></textarea>
    <p class="form-control-static">改行して複数の郵便番号を登録できます。</p>
  </div>

  <button type="submit" class="btn btn-primary">追加</button>
<?= Form::close(); ?>

<h3 class="mt-3">検索条件</h3>
<?= \Form::open(['method' => 'GET']); ?>
  <div class="form-inline mt-3">
    <label class="form-control-label mr-sm-2" for="name"><h6>都道府県名、市区町村名、郵便番号：</h6></label>
    <input type="text" name="search" value="<?= \Input::get('search'); ?>" class="form-control mb-2 mb-2 mr-sm-2 mb-sm-0">
    <button type="submit" class="btn btn-secondary">検索</button>
  </div>
<?= Form::close(); ?>

<?= \Form::open(['method' => 'POST', 'action' => \Uri::create('admin/companies/:id/offices/:office_id/area/delete', ['id' => $id, 'office_id' => $office_id])]); ?>
<table class="table table-sm table-hover mt-4 small-row">
  <thead>
    <tr>
      <th>
        <div class="form-check form-check-inline mb-0">
          <label class="custom-control custom-checkbox mb-0" id="select_all_zip">
            <input class="custom-control-input" name="select_all_zip" type="checkbox">
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">郵便番号</span>
          </label>
        </div>
      </th>
      <th>備考</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($zip_codes as $item): ?>
      <tr>
        <td>
          <div class="form-check form-check-inline mb-0">
            <label class="custom-control custom-checkbox mb-0">
              <input class="custom-control-input" name="zip_codes[]" value="<?= $item->id; ?>" type="checkbox">
              <span class="custom-control-indicator"></span>
              <span class="custom-control-description"><?= $item->zip_code; ?></span>
            </label>
          </div>
        </td>
        <td><?= $item->notes; ?></td>
        <td>          
          <div class="text-right pr-4"><a href="<?= \Uri::create('admin/companies/:id/offices/:office_id/area/:zip/delete', ['id' => $id, 'office_id' => $office_id, 'zip' => $item->id]); ?>" class="btn-estimate-delete btn btn-danger btn-sm px-1 py-0" role="button" onclick="return confirm('本当によろしいですか?')"><i class="fa fa-trash" aria-hidden="true"></i> 削除</a></div>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php if ($zip_codes): ?>
  <button type="submit" class="btn btn-danger mb-4" onclick="return confirm('本当によろしいですか?')">チェックしたものを削除する</button>
<?php endif; ?>
<?= Form::close(); ?>

<?= \Pagination::instance('zip_codes')->render(); ?>

<!-- MODAL AREA START -->
<?= render('admin/companyoffices/_modal_area', ['office_id' => $office_id]); ?>
<!-- MODAL AREA END -->

