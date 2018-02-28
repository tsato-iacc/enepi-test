<?php
use JpPrefecture\JpPrefecture;
?>
<!-- <div class="row">
  <?php foreach (JpPrefecture::allKanjiAndCode() as $key => $name):?>
    <div class="btn-group col-2 mb-4" role="group" aria-label="Basic example">
      <button type="button" class="btn btn-secondary w-100"><?= $name; ?></button>
      <button type="button" class="btn btn-secondary"><i class="fa fa-cogs" aria-hidden="true"></i></button>
    </div>
  <?php endforeach; ?>
</div> -->

<?= \Form::open(); ?>
  <?= \Form::csrf(); ?>
  <p>改行して複数の郵便番号を登録できます。</p>
  <div class="form-group row">
    <div class="col-3">
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
  </div>
  
  <div class="form-group">
    <textarea name="zip_code" class="form-control" id="zip_code" rows="10"></textarea>
  </div>

  <button type="submit" class="btn btn-primary">追加</button>
<?= Form::close(); ?>

<table class="table table-sm table-hover mt-4 small-row">
  <thead>
    <tr>
      <th>郵便番号</th>
      <th>備考</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($zip_codes as $item): ?>
      <tr>
        <td><?= $item->zip_code; ?></td>
        <td><?= $item->notes; ?></td>
        <td>          
          <div class="text-right pr-4"><a href="<?= \Uri::create('admin/companies/:id/offices/:office_id/area/:zip/delete', ['id' => $id, 'office_id' => $office_id, 'zip' => $item->id]); ?>" class="btn-estimate-delete btn btn-danger btn-sm px-1 py-0" role="button" onclick="return confirm('本当によろしいですか?')"><i class="fa fa-trash" aria-hidden="true"></i> 削除</a></div>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?= \Pagination::instance('zip_codes')->render(); ?>
