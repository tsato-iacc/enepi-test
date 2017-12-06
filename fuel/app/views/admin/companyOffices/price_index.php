<p class="alert alert-warning">
  ひとつの料金テーブルごとに入力、保存してください
</p>

<p class="alert alert-danger">
  24件中<?= 24 - @geocode.price_rules.count ?>件の料金テーブルが登録されていません
</p>
<table class="table table-striped table-hover" style="margin-bottom: 0">
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
    <? [true, false].each { |using_cooking_stove| ?>
      <? [true, false].each { |using_bath_heater_with_gas_hot_water_supply| ?>
        <? [true, false].each { |using_other_gas_machine| ?>
          <? Lpgas::PriceRule.house_kinds.keys.each { |house_kind| ?>
            <? price_rule = @geocode.price_rules.where(
              using_cooking_stove: using_cooking_stove,
              using_bath_heater_with_gas_hot_water_supply: using_bath_heater_with_gas_hot_water_supply,
              using_other_gas_machine: using_other_gas_machine,
              house_kind: Lpgas::PriceRule.house_kinds[house_kind]
            ).first_or_initialize ?>
            <tr>
              <td><?= boolean_label price_rule.using_cooking_stove ?></td>
              <td><?= boolean_label price_rule.using_bath_heater_with_gas_hot_water_supply ?></td>
              <td><?= boolean_label price_rule.using_other_gas_machine ?></td>
              <td><?= price_rule.enum_value_i18n(:house_kind) ?></td>
              <td><?= boolean_label price_rule.persisted?, true_label: "登録済み", false_label: "未登録" ?>
              <td>
                <?= link_to(
                  "登録/更新",
                  new_admin_lpgas_company_company_geocode_price_rule_path(
                    @company,
                    @geocode,
                    using_cooking_stove: price_rule.using_cooking_stove,
                    using_bath_heater_with_gas_hot_water_supply: price_rule.using_bath_heater_with_gas_hot_water_supply,
                    using_other_gas_machine: price_rule.using_other_gas_machine,
                    house_kind: house_kind
                  ),
                  ["class" => 'btn btn-xs btn-primary'
                )?>
              <?= MyView::link_to('削除', admin_lpgas_company_company_geocode_price_rule_path(
                price_rule.company_geocode.company,
                price_rule.company_geocode,
                price_rule
              ), data: {["method" => 'delete', confirm: 1}, ["class" => 'btn btn-danger btn-xs' if price_rule.persisted? ?>
              </td>
            </tr>
          <? } ?>
        <? } ?>
      <? } ?>
    <? } ?>
  </tbody>
</table>
