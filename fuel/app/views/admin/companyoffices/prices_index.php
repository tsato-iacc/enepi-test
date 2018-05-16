<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="<?= \Uri::create('admin/companies/'); ?>">会社一覧</a></li>
  <li class="breadcrumb-item"><a href="<?= \Uri::create('admin/partner_companies/:id/edit', ['id' => $company->partner_company->id]); ?>"><?= $company->getCompanyName(); ?></a></li>
  <li class="breadcrumb-item"><a href="<?= \Uri::create('admin/companies/:id/offices', ['id' => $company->id]); ?>">営業拠点一覧</a></li>
  <li class="breadcrumb-item active">料金テーブル</li>
</ol>

<p class="alert alert-warning">
  ひとつの料金テーブルごとに入力、保存してください
</p>

<?php if ($count): ?>
  <p class="alert alert-danger">
    24件中<?= $count; ?>件の料金テーブルが登録されていません
  </p>
<?php endif; ?>

<table class="table table-sm table-hover mt-4 small-row">
  <thead>
    <tr>
      <th>ガスコンロ</th>
      <th>ガス給湯付き風呂釜</th>
      <th>その他</th>
      <th>開設先の物件種別</th>
      <th>登録状況</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ([true, false] as $using_cooking_stove): ?>
      <?php foreach ([true, false] as $using_bath_heater_with_gas_hot_water_supply): ?>
        <?php foreach ([true, false] as $using_other_gas_machine): ?>
          <?php foreach (\Config::get('models.price_rule.house_kind') as $key => $house_kind): ?>
            <?php $where = [
              ['company_geocode_id', $geocode->id],
              ['using_cooking_stove', $using_cooking_stove],
              ['using_bath_heater_with_gas_hot_water_supply', $using_bath_heater_with_gas_hot_water_supply],
              ['using_other_gas_machine', $using_other_gas_machine],
              ['house_kind', $house_kind],
            ]; ?>
            <?php $price_rule = \Model_PriceRule::find('first', ['where' => $where]); ?>
            <tr>
              <td>
                <div>
                  <?php if ($using_cooking_stove): ?>
                    <span class="badge badge-success">TRUE</span>
                  <?php else: ?>
                    <span class="badge badge-default">FALSE</span>
                  <?php endif; ?>
                </div>
              </td>
              <td>
                <div>
                  <?php if ($using_bath_heater_with_gas_hot_water_supply): ?>
                    <span class="badge badge-success">TRUE</span>
                  <?php else: ?>
                    <span class="badge badge-default">FALSE</span>
                  <?php endif; ?>
                </div>
              </td>
              <td>
                <div>
                  <?php if ($using_other_gas_machine): ?>
                    <span class="badge badge-success">TRUE</span>
                  <?php else: ?>
                    <span class="badge badge-default">FALSE</span>
                  <?php endif; ?>
                </div>
              </td>
              <td><?= __('admin.price_rule.house_kind.'.$key); ?></td>
              <td><?= $price_rule ? '<span class="text-success">登録済み</span>' : "未登録"; ?></td>
              <td>
                <?php $query = [
                  'using_cooking_stove' => $using_cooking_stove,
                  'using_bath_heater_with_gas_hot_water_supply' => $using_bath_heater_with_gas_hot_water_supply,
                  'using_other_gas_machine' => $using_other_gas_machine,
                  'house_kind' => $house_kind,
                ]; ?>
                <a href="<?= \Uri::create('admin/companies/:id/offices/:office_id/prices/create?'.http_build_query($query), ['id' => $company->id, 'office_id' => $geocode->id]); ?>" class="btn btn-primary btn-sm px-1 py-0" role="button">登録/更新</a>
                <?php if ($price_rule): ?>
                  <a href="<?= \Uri::create('admin/companies/:id/offices/:office_id/prices/:price_id/delete', ['id' => $company->id, 'office_id' => $geocode->id, 'price_id' => $price_rule->id]); ?>" class="btn btn-danger btn-sm px-1 py-0" role="button">削除</a>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endforeach; ?>
      <?php endforeach; ?>
    <?php endforeach; ?>
  </tbody>
</table>
