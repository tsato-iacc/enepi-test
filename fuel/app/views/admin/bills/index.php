<p>
  今月の請求額: <?= number_format($commission); ?>円
</p>

<table class="table table-sm table-hover mt-4 small-row">
  <thead>
    <tr>
      <th>LPガス会社</th>
      <th>見積もり数</th>
      <th>成約手数料</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($companies as $company): ?>
      <?php $result = \DB::select(\DB::expr('SUM(contracted_commission) as contracted_commission'))->from('lpgas_estimates')->where('status', 4)->and_where('company_id', $company->id)->and_where('status_updated_at', '>=', $from)->and_where('status_updated_at', '<=', $to)->execute()->as_array(); ?>
      <?php $result = reset($result); ?>
      <tr>
        <td><a href="<?= \Uri::create('admin/partner_companies/:id/edit', ['id' => $company->partner_company->id]); ?>"><i class="fa fa-building-o" aria-hidden="true"></i> <?= $company->partner_company->company_name; ?></a></td>
        <td><a href="<?= \Uri::create('admin/companies/:id/estimates', ['id' => $company->partner_company->id]); ?>"><i class="fa fa-handshake-o" aria-hidden="true"></i> <?= \Model_Estimate::count(['where' => [['company_id', $company->id]]]); ?></a></td>
        <td><?= $result['contracted_commission'] ? number_format($result['contracted_commission']) : 0; ?>円</td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
