<?php
use JpPrefecture\JpPrefecture;
?>
<h3>ユーザー情報</h3>
<div class="card-group mb-4">
  <div class="card text-center">
    <div class="card-block">
      <p class="card-text">問い合わせID</p>
    </div>
    <div class="card-footer"><?= $contact->id; ?></div>
  </div>
  <div class="card text-center">
    <div class="card-block">
      <p class="card-text">ユーザー名</p>
    </div>
    <div class="card-footer"><?= $contact->name; ?></div>
  </div>
  <div class="card text-center">
    <div class="card-block">
      <p class="card-text">ユーザー住所</p>
    </div>
    <div class="card-footer"><?= JpPrefecture::findByCode($contact->getPrefectureCode())->nameKanji . " " . $contact->getAddress(); ?></div>
  </div>
  <div class="card text-center">
    <div class="card-block">
      <p class="card-text">物件種別</p>
    </div>
    <div class="card-footer"><?= __('admin.contact.house_kind.'.\Config::get('views.contact.house_kind.'.$contact->house_kind)); ?></div>
  </div>
  <div class="card text-center">
    <div class="card-block">
      <p class="card-text">ガス機器</p>
    </div>
    <div class="card-footer">
      <?php if ($machines = $contact->getGasMachines()): ?>
        <?= implode('<br>', $machines); ?>
      <?php else: ?>
        <div><i class="fa fa-times" aria-hidden="true"></i> 無し</div>
      <?php endif; ?>
    </div>
  </div>
</div>

<h3>紹介済みの会社</h3>

<?php if (!$contact->estimates): ?>
  <div class="card card-outline-warning mb-3 text-center">
    <div class="card-block">
      <blockquote class="card-blockquote">
        <i class="fa fa-info-circle" aria-hidden="true"></i> 紹介済みの会社はありません。
      </blockquote>
    </div>
  </div>
<?php else: ?>
  <table class="table table-sm table-hover small-row">
    <thead>
      <tr>
        <th>見積もりID</th>
        <th>有効期限</th>
        <th>見積もりステータス</th>
        <th>会社名</th>
        <th>住所</th>
        <th>成約手数料</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($contact->estimates as $estimate): ?>
        <!-- FIX ME Do not display expired estimates -->
        <tr>
          <td><?= $estimate->uuid; ?></td>
          <td><?= ''; ?></td>
          <td>
            <div class="card card-outline-<?= \Config::get('views.estimate.status.'.$estimate->status); ?> text-center max-width">
              <div class="card-block p-0">
                <blockquote class="card-blockquote"><?= __('admin.estimate.status.'.\Config::get('views.estimate.status.'.$estimate->status)) ?></blockquote>
              </div>
            </div>
          </td>
          <td><a href="<?= \Uri::create('admin/partner_companies/:id/edit', ['id' => $estimate->company->id]); ?>"><?= $estimate->company->partner_company->company_name; ?></a></td>
          <td><?= JpPrefecture::findByCode($estimate->contact->getPrefectureCode())->nameKanji." ".$estimate->contact->getAddress(); ?></td>
          <td><?= $estimate->contracted_commission? number_format($estimate->contracted_commission).'円' : ''; ?></td>
          <td><div><a href="#" class="btn-estimate-delete btn btn-danger btn-sm px-1 py-0 w-100" role="button" data-estimate-id="<?= $estimate->id; ?>" onclick="return alert('Coming soon')"><i class="fa fa-trash" aria-hidden="true"></i> 削除</a></div></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>

<h3>紹介候補</h3>
<div class="card card-outline-success mb-3 text-center">
  <div class="card-block">
    <blockquote class="card-blockquote">
      <i class="fa fa-info-circle" aria-hidden="true"></i> 「まだ紹介していない会社」もしくは「提示された見積もりの有効期限が全て切れている会社」が出ます。
    </blockquote>
  </div>
</div>

<?php if (!$new_estimates): ?>
  <div class="card card-outline-warning mb-3 text-center">
    <div class="card-block">
      <blockquote class="card-blockquote">
        <i class="fa fa-info-circle" aria-hidden="true"></i> 紹介候補はありません。
      </blockquote>
    </div>
  </div>
<?php elseif (!$contact->gas_used_amount || !$contact->gas_meter_checked_month || !$contact->gas_latest_billing_amount): ?>
  <div class="card card-outline-warning mb-3 text-center">
    <div class="card-block">
      <blockquote class="card-blockquote">
        <i class="fa fa-info-circle" aria-hidden="true"></i> ガス検針月 or ガス使用量 or 直近の請求額 was not setted
      </blockquote>
    </div>
  </div>
<?php else: ?>
  <?php if (!$contact->sent_auto_estimate_req): ?>
    <div class="card card-outline-info mb-3 text-center">
      <div class="card-block">
        <blockquote class="card-blockquote">
          <p><i class="fa fa-info-circle" aria-hidden="true"></i> 見積り自体が自動見積り不可です。</p>
          <footer>[理由] <?= $contact->reason_not_auto_sendable; ?></footer>
        </blockquote>
      </div>
    </div>
  <?php endif; ?>
  <?= \Form::open(['action' => \Uri::create('admin/contacts/:id/estimates', ['id' => $contact->id])]); ?>
    <?= \Form::csrf(); ?>
    <table class="table table-sm table-hover small-row">
      <thead>
        <tr>
          <th>会社名</th>
          <th>IACC見積もり確認中で作成</th>
          <th>住所</th>
          <th>NG企業チェック</th>
          <th>年間節約額</th>
          <th>成約手数料</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($new_estimates as $key => $estimate): ?>
          <tr>
            <td>
              <div class="form-check form-check-inline mb-0">
                <label class="custom-control custom-checkbox mb-0">
                  <?= Form::checkbox("estimates[$key][company_id]", $estimate->company->id, $val->input("estimates.{$key}.company_id", false), ['class' => 'custom-control-input']); ?>
                  <span class="custom-control-indicator"></span>
                  <span class="custom-control-description"><?= $estimate->company->partner_company->company_name; ?></span>
                </label>
              </div>
            </td>
            <td>
              <div class="form-check form-check-inline mb-0">
                <label class="custom-control custom-checkbox mb-0">
                  <?= Form::checkbox("estimates[$key][status]", 1, $val->input("estimates.{$key}.status", false), ['class' => 'custom-control-input']); ?>
                  <span class="custom-control-indicator"></span>
                </label>
              </div>
            </td>
            <td><?= JpPrefecture::findByCode($estimate->company->prefecture_code)->nameKanji." ".$estimate->company->address; ?></td>
            <td>
              <?php if ($estimate->company->isNgCompany($estimate->contact->gas_contracted_shop_name)): ?>
                <span class="badge badge-default">NG</span>
              <?php else: ?>
                <span class="badge badge-success">OK</span>
              <?php endif; ?>
            </td>
            <?php $saving = $estimate->total_savings_in_year($contact); ?>
            <td><?= number_format($saving); ?>円</td>
            <td>
              <div class="input-group w-50<?= $val->error("estimates.{$key}.contracted_commission") ? ' has-danger' : ''; ?>">
                <input class="form-control form-control-sm" type="number" name="<?= "estimates[$key][contracted_commission]"; ?>" value="<?= $val->input("estimates.{$key}.contracted_commission", $estimate->contracted_commission); ?>">
                <div class="input-group-addon form-control-sm">円</div>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <button type="submit" class="btn btn-success"><i class="fa fa-recycle" aria-hidden="true"></i> チェックを入れた会社に見積もりを依頼する</button>
  <?= Form::close(); ?>
<?php endif; ?>
