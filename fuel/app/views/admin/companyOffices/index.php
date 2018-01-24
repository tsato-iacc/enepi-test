<?php
use JpPrefecture\JpPrefecture;
?>

<?= \Form::open(); ?>
  <?= \Form::csrf(); ?>
  <div class="form-group row">
    <div class="col-2">
      <div class="form-group<?= $val->error('zip_code') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="zip_code"><h6><i class="fa fa-asterisk" aria-hidden="true"></i> 郵便番号</h6></label>
        <input type="text" required name="zip_code" value="<?= $val->input('zip_code', '') ?>" class="form-control" id="zip_code">
      </div>
    </div>
    <div class="col-2">
      <div class="form-group<?= $val->error('prefecture_code') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="prefecture_code"><h6><i class="fa fa-asterisk" aria-hidden="true"></i> 都道府県</h6></label>
        <?= Form::select('prefecture_code', $val->input('prefecture_code', ''), ['' => '選択して'] + JpPrefecture::allKanjiAndCode(), ['class' => 'form-control', 'id' => 'prefecture_code', 'required' => 'required']); ?>
      </div>
    </div>
    <div class="col-3">
      <div class="form-group<?= $val->error('address') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="address"><h6><i class="fa fa-asterisk" aria-hidden="true"></i> 住所</h6></label>
        <input type="text" required name="address" value="<?= $val->input('address', '') ?>" class="form-control" id="address">
      </div>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">登録する</button>
<?= Form::close(); ?>

<?php $head = $company->getHeadOffice(); ?>
<table class="table table-sm table-hover mt-4 small-row">
  <thead>
    <tr>
      <th>郵便番号</th>
      <th>都道府県</th>
      <th>住所</th>
      <th>位置情報</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><?= $company->zip_code; ?></td>
      <td><?= JpPrefecture::findByCode($company->prefecture_code)->nameKanji; ?></td>
      <td><?= $company->address; ?></td>
      <td>(<?= $head->lat; ?>, <?= $head->lng; ?>)</td>
      <td>
        <div><?php ?>
          <a href="<?= \Uri::create('admin/companies/:id/offices/:office_id/price', ['id' => $company->id, 'office_id' => $head->id]); ?>" class="btn btn-info btn-sm px-1" role="button">料金テーブル</a>
          <a href="<?= \Uri::create('admin/companies/:id/offices/:office_id/area', ['id' => $company->id, 'office_id' => $head->id]); ?>" class="btn btn-primary btn-sm px-1" role="button">対応可能市区町村</a>
        </div>
      </td>
    </tr>
    <?php foreach ($company->offices as $office): ?>
      <tr>
        <td><?= $office->zip_code; ?></td>
        <td><?= JpPrefecture::findByCode($office->prefecture_code)->nameKanji; ?></td>
        <td><?= $office->address; ?></td>
        <td>(<?= $office->geocode->lat; ?>, <?= $office->geocode->lng; ?>)</td>
        <td>
          <a href="<?= \Uri::create('admin/companies/:id/offices/:office_id/price', ['id' => $company->id, 'office_id' => $office->geocode->id]); ?>" class="btn btn-info btn-sm px-1" role="button">料金テーブル</a>
          <a href="<?= \Uri::create('admin/companies/:id/offices/:office_id/area', ['id' => $company->id, 'office_id' => $office->geocode->id]); ?>" class="btn btn-primary btn-sm px-1" role="button">対応可能市区町村</a>
          <a href="<?= \Uri::create('admin/companies/:id/offices/:office_id/delete', ['id' => $company->id, 'office_id' => $office->id]); ?>" class="btn btn-danger btn-sm px-1" role="button" onclick="return confirm('本当によろしいですか?')">削除</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
