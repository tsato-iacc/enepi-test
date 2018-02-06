<?php
use JpPrefecture\JpPrefecture;
?>

<table class="table table-sm table-hover mt-4 th-left small-row">
  <tr>
    <th>ID</th>
    <td><?= $estimate->uuid; ?></td>
  </tr>
  <tr>
    <th>問い合わせID</th>
    <td><a href="<?= \Uri::create('admin/contact/'.$estimate->contact->id); ?>"></a></td>
  </tr>
  <tr>
    <th>有効期限</th>
    <td>
      <span class="<?= $estimate->isExpired() ? 'alert-text' : '' ?>"><?= $estimate->expired_at ? \Helper\TimezoneConverter::convertFromString($estimate->expired_at, 'admin_table') : ''; ?></span>
    </td>
  </tr>
  <tr>
    <th>お名前</th>
    <td><?= $estimate->contact->name; ?></td>
  </tr>
  <tr>
    <th>紹介日時</th>
    <td><?= \Helper\TimezoneConverter::convertFromString($estimate->created_at, 'admin_table'); ?></td>
  </tr>
  <tr>
    <th>電話番号</th>
    <td><?= $estimate->contact->tel; ?></td>
  </tr>
  <tr>
    <th>都道府県</th>
    <td><?= JpPrefecture::findByCode($estimate->contact->getPrefectureCode())->nameKanji; ?></td>
  </tr>
  <tr>
    <th>住所</th>
    <td><?= $estimate->contact->getAddress(); ?></td>
  </tr>
  <tr>
    <th>住所(番地以降)</th>
    <td><?= $estimate->contact->getAddress2(); ?></td>
  </tr>
  <?php if ($estimate->contact->estimate_kind == \Config::get('models.contact.house_kind.new_contract') || $estimate->contact->apartment_owner): ?>
    <tr>
      <th>開設先の郵便番号</th>
      <td><?= $estimate->contact->new_zip_code ?></td>
    </tr>
    <tr>
      <th>開設先の都道府県</th>
      <td><?= JpPrefecture::findByCode($estimate->contact->new_prefecture_code)->nameKanji; ?></td>
    </tr>
    <tr>
      <th>開設先の住所</th>
      <td><?= $estimate->contact->new_address; ?></td>
    </tr>
    <tr>
      <th>開設先の住所(番地以降)</th>
      <td><?= $estimate->contact->new_address2; ?></td>
    </tr>
  <?php endif; ?>
  <?php if ($estimate->contact->estimate_kind == \Config::get('models.contact.house_kind.new_contract')): ?>
    <tr>
      <th>引越し予定日</th>
      <td><?= $estimate->contact->moving_scheduled_date; ?></td>
    </tr>
  <?php endif; ?>
  <tr>
    <th>紹介した会社</th>
    <td><a href="<?= \Uri::create('admin/companies/'.$estimate->company->id); ?>"><?= $estimate->company->getCompanyName(); ?></a></td>
  </tr>
  <tr>
    <th>ステータス</th>
    <td>
      <div class="card card-outline-<?= \Config::get('views.estimate.status.'.$estimate->status); ?> text-center max-width">
        <div class="card-block p-0">
          <blockquote class="card-blockquote"><?= __('admin.estimate.status.'.\Config::get('views.estimate.status.'.$estimate->status)) ?></blockquote>
        </div>
      </div>
    </td>
  </tr>
  <tr>
    <th>ステータス更新日時</th>
    <td><?= \Helper\TimezoneConverter::convertFromString($estimate->status_updated_at, 'admin_table'); ?></td>
  </tr>
  <tr>
    <th>ステータス更新理由</th>
    <td><?= \Helper\CancelReasons::getNameByValue($estimate->status_reason) ?></td>
  </tr>
  <tr>
    <th>成約手数料</th>
    <td><?= $estimate->contracted_commission? number_format($estimate->contracted_commission).'円' : ''; ?></td>
  </tr>
  <tr>
    <th>従量単価 (現在の推定)</th>
    <td><?= $estimate->contact->unitPrice() ? number_format($estimate->contact->unitPrice()).'円' : ''; ?></td>
  </tr>
  <tr>
    <th>基本料金</th>
    <td><?= $estimate->basic_price? number_format($estimate->basic_price).'円' : ''; ?></td>
  </tr>
  <tr>
    <th>燃料調整費</th>
    <td><?= $estimate->fuel_adjustment_cost? number_format($estimate->fuel_adjustment_cost).'円' : ''; ?>/m3</td>
  </tr>
  <tr>
    <th>従量単価</th>
    <td>
      <?php if (count($estimate->prices) == 1): ?>
        <?= number_format(reset($estimate->prices)->unit_price); ?>円
      <?php else: ?>
        <?php foreach ($estimate->prices as $price): ?>
          <div><b><?= $price->getRangeLabel() ?>:</b> <?= number_format($price->unit_price); ?>円</div>
        <?php endforeach; ?>
      <?php endif; ?>
    </td>
  </tr>
  <tr>
    <th>備考</th>
    <td><?= $estimate->notes; ?></td>
  </tr>
  <tr>
    <th>機器・配管セットプラン</th>
    <td><?= $estimate->set_plan; ?></td>
  </tr>
  <tr>
    <th>その他セットプラン</th>
    <td><?= $estimate->other_set_plan; ?></td>
  </tr>
</table>

<div class="d-flex justify-content-around mb-4">
  <a class="btn btn-secondary" href="<?= \Uri::create("lpgas/contacts/{$estimate->contact->id}?".http_build_query(['pin' => $estimate->contact->pin, 'token' => $estimate->contact->token])); ?>" role="button">提示画面</a>
  <!-- CHECK ME -->
  <?php if ($estimate->status == \Config::get('models.estimate.status.sent_estimate_to_iacc') || $estimate->status == \Config::get('models.estimate.status.pending')): ?>
    <div><a href="#" class="btn-present btn btn-info" role="button" data-estimate-id="<?= $estimate->id; ?>" data-company-name="<?= $estimate->company->getCompanyName(); ?>" data-contact-pref="<?= JpPrefecture::findByCode($estimate->contact->getPrefectureCode())->nameKanji; ?>" data-contact-tel="<?= $estimate->contact->tel; ?>">ユーザーに送信</a></div>
  <?php endif; ?>
  <?php if ($estimate->status == \Config::get('models.estimate.status.sent_estimate_to_user')): ?>
    <div><a href="#" class="btn-introduce btn btn-success" role="button" data-estimate-id="<?= $estimate->id; ?>" data-company-name="<?= $estimate->company->getCompanyName(); ?>" data-contact-pref="<?= JpPrefecture::findByCode($estimate->contact->getPrefectureCode())->nameKanji; ?>" data-contact-tel="<?= $estimate->contact->tel; ?>">送客</a></div>
  <?php endif; ?>
  <?php if ($estimate->status != \Config::get('models.estimate.status.contracted') && $estimate->status != \Config::get('models.estimate.status.cancelled')): ?>
    <div><a href="#" class="btn-cancel btn btn-danger" role="button" data-estimate-id="<?= $estimate->id; ?>" data-contact-name="<?= $estimate->contact->name; ?>" data-contact-pref="<?= JpPrefecture::findByCode($estimate->contact->getPrefectureCode())->nameKanji; ?>" data-contact-tel="<?= $estimate->contact->tel; ?>">キャンセル</a></div>
  <?php endif; ?>
</div>

<?php if ($estimate->status == \Config::get('models.estimate.status.sent_estimate_to_iacc') || $estimate->status == \Config::get('models.estimate.status.pending')): ?>
<hr>
<h2>見積り送信</h2>

<?= \Form::open(); ?>
  <?= \Form::csrf(); ?>
  <?= render('admin/_form_prices', ['price_rule' => $estimate]); ?>
<?= Form::close(); ?>
<hr>
<?php endif; ?>

<h2>ステータス更新履歴</h2>
<table class="table table-sm table-hover mt-4 small-row">
  <thead>
    <tr>
      <th>日時</th>
      <th>変更した人</th>
      <th>ステータス</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach (array_reverse($estimate->estimate_history) as $history): ?>
      <?php if (isset($history->diff_json->status)): ?>
      <tr>
        <td><?= \Helper\TimezoneConverter::convertFromString($history->created_at, 'admin_table'); ?></td>
        <td>
          <?php if ($history->admin_user): ?>
            <?= $history->admin_user->email; ?>
          <?php elseif ($history->partner_company): ?>
            <a href="<?= \Uri::create('admin/partner_company/:id', ['id' => $history->partner_company->id]); ?>"><?= $history->partner_company->company_name; ?></a>
          <?php endif; ?>
        </td>
        <td>
          <div class="card card-outline-<?= $history->diff_json->status->new; ?> text-center max-width">
            <div class="card-block p-0">
              <blockquote class="card-blockquote"><?= __('admin.estimate.status.'.$history->diff_json->status->new); ?></blockquote>
            </div>
          </div>
        </td>
        <td>
          <?php if (\Config::get('views.estimate.status.'.$estimate->status) != $history->diff_json->status->new): ?>
            <a href="<?= \Uri::create('admin/estimates/:id/revert/:status', ['id' => $estimate->id, 'status' => $history->diff_json->status->new]); ?>">「<?= __('admin.estimate.status.'.$history->diff_json->status->new); ?>」に戻す</a>
          <?php endif; ?>
        </td>
      </tr>
      <?php endif; ?>
    <?php endforeach; ?>
  </tbody>
</table>

<h2 id="timeline">進行状況</h2>

<?= \Form::open(['action' => \Uri::create('admin/estimates/:id/progress', ['id' => $estimate->id])]); ?>
  <?= \Form::csrf(); ?>
  <table class="table table-sm table-hover mt-4 small-row th-left">
    <tr>
      <th>STEP1. 連絡する</th>
      <td>
        <?php if (!$estimate->contacted): ?>
          <div class="form-check d-flex align-items-center mt-1">
            <span class="mr-2"><b>状況</b></span>
            <label class="custom-control custom-radio mb-0">
              <input name="contacted" value="false" type="radio" class="custom-control-input" checked="checked">
              <span class="custom-control-indicator"></span>
              <span class="custom-control-description">変更しない</span>
            </label>
            <label class="custom-control custom-radio mb-0">
              <input name="contacted" value="true" type="radio" class="custom-control-input">
              <span class="custom-control-indicator"></span>
              <span class="custom-control-description">完了にする</span>
            </label>
          </div>
          <div class="form-group">
            <input class="form-control" placeholder="担当者" value="" type="text" name="company_contact_name">
          </div>
          <div class="form-group">
            <textarea name="comment" class="form-control" rows="4" placeholder="メモ"></textarea>
          </div>
          <button type="submit" class="btn btn-primary btn-sm mb-2">更新する</button>
        <?php elseif (\Config::get('models.estimate.status.contacted') == $estimate->status): ?>
          <span class="true-label">完了済み</span>
        <?php endif; ?>
      </td>
    </tr>
    <tr>
      <th>STEP2. 訪問予定日を決める</th>
      <td>
        <?php if ($estimate->contacted && !$estimate->visit_scheduled_date): ?>
          <div class="form-group">
            <input class="form-control datepicker" placeholder="訪問予定日" value="" type="text" name="visit_scheduled_date">
          </div>
          <div class="form-group">
            <input class="form-control" placeholder="担当者" value="" type="text" name="company_contact_name">
          </div>
          <div class="form-group">
            <textarea name="comment" class="form-control" rows="4" placeholder="メモ"></textarea>
          </div>
          <button type="submit" class="btn btn-primary btn-sm mb-2">更新する</button>
        <?php elseif ($estimate->visit_scheduled_date): ?>
          <?= $estimate->visit_scheduled_date; ?>
        <?php endif; ?>
      </td>
    </tr>
    <tr>
      <th>STEP3. 訪問する</th>
      <td>
        <?php if ($estimate->contacted && $estimate->visit_scheduled_date && !$estimate->visited): ?>
          <div class="form-check d-flex align-items-center mt-1">
            <span class="mr-2"><b>状況</b></span>
            <label class="custom-control custom-radio mb-0">
              <input name="visited" value="false" type="radio" class="custom-control-input" checked="checked">
              <span class="custom-control-indicator"></span>
              <span class="custom-control-description">変更しない</span>
            </label>
            <label class="custom-control custom-radio mb-0">
              <input name="visited" value="true" type="radio" class="custom-control-input">
              <span class="custom-control-indicator"></span>
              <span class="custom-control-description">完了にする</span>
            </label>
          </div>
          <div class="form-group">
            <input class="form-control" placeholder="担当者" value="" type="text" name="company_contact_name">
          </div>
          <div class="form-group">
            <textarea name="comment" class="form-control" rows="4" placeholder="メモ"></textarea>
          </div>
          <button type="submit" class="btn btn-primary btn-sm mb-2">更新する</button>
        <?php elseif ($estimate->visited): ?>
          <span class="true-label">完了済み</span>
        <?php endif; ?>
      </td>
    </tr>
    <tr>
      <th>STEP4. 委任状を獲得する</th>
      <td>
        <?php if ($estimate->visited && !$estimate->power_of_attorney_acquired): ?>
          <div class="form-check d-flex align-items-center mt-1">
            <span class="mr-2"><b>状況</b></span>
            <label class="custom-control custom-radio mb-0">
              <input name="power_of_attorney_acquired" value="false" type="radio" class="custom-control-input" checked="checked">
              <span class="custom-control-indicator"></span>
              <span class="custom-control-description">変更しない</span>
            </label>
            <label class="custom-control custom-radio mb-0">
              <input name="power_of_attorney_acquired" value="true" type="radio" class="custom-control-input">
              <span class="custom-control-indicator"></span>
              <span class="custom-control-description">完了にする</span>
            </label>
          </div>
          <div class="form-group">
            <input class="form-control" placeholder="担当者" value="" type="text" name="company_contact_name">
          </div>
          <div class="form-group">
            <textarea name="comment" class="form-control" rows="4" placeholder="メモ"></textarea>
          </div>
          <button type="submit" class="btn btn-primary btn-sm mb-2">更新する</button>
        <?php elseif ($estimate->power_of_attorney_acquired): ?>
          <span class="true-label">完了済み</span>
        <?php endif; ?>
      </td>
    </tr>
    <tr>
      <th>STEP5. 工事予定日を決める</th>
      <td>
        <?php if ($estimate->power_of_attorney_acquired && !$estimate->construction_scheduled_date): ?>
          <div class="form-group">
            <input class="form-control datepicker" placeholder="訪問予定日" value="" type="text" name="construction_scheduled_date">
          </div>
          <div class="form-group">
            <input class="form-control" placeholder="担当者" value="" type="text" name="company_contact_name">
          </div>
          <div class="form-group">
            <textarea name="comment" class="form-control" rows="4" placeholder="メモ"></textarea>
          </div>
          <button type="submit" class="btn btn-primary btn-sm mb-2">更新する</button>
        <?php elseif ($estimate->construction_scheduled_date): ?>
          <?= $estimate->construction_scheduled_date; ?>
        <?php endif; ?>
      </td>
    </tr>
    <tr>
      <th>STEP6. 工事完了</th>
      <td>
        <?php if ($estimate->construction_finished_date): ?>
          <?= $estimate->construction_finished_date; ?>
        <?php endif; ?>
      </td>
    </tr>
  </table>
<?= Form::close(); ?>

<table class="table table-sm table-hover mt-4 small-row">
  <thead>
    <tr>
      <th>担当者</th>
      <th>状況</th>
      <th>対応日時</th>
      <th>メモ</th>
      <th>その他変更</th>
    </tr>
  </thead>
  <tbody>
    <!-- <% current_status_en = "" %> -->
    <!-- <% current_status = "" %> -->
    <!-- <% current_contact_name = "" %> -->
    <!-- <% @timeline.each.with_index do |feed, i| %> -->
      <tr>
        <td>
          <!-- <% current_contact_name = feed.company_contact_name if feed.company_contact_name %> -->
          <!-- <%= current_contact_name %> -->
        </td>
        <td>
          <!-- <% if feed.status %> -->
            <!-- <% current_status_en = feed.status %> -->
            <!-- <% current_status = feed.status_ja %> -->
          <!-- <% end %> -->
          <!-- <span class="status <%= current_status_en %>"><%= current_status %></span> -->
        </td>
        <td><!-- <%= format_datetime feed.created_at %> --></td>
        <td><!-- <%= feed.comment %> --></td>
        <td><!-- <%= feed.other_changes %> --></td>
      </tr>
    <!-- <% end %> -->
  </tbody>
</table>

<div class="mb-4">
  <a class="btn btn-secondary" href="<?= \Uri::create('admin/estimates/:id/history', ['id' => $estimate->id]); ?>" role="button">全ての項目の更新履歴を見る</a>
</div>

<!-- MODAL CANCEL START -->
<?= render('admin/_modal_cancel'); ?>
<!-- MODAL CANCEL END -->

<!-- MODAL INTRODUCE START -->
<?= render('admin/_modal_introduce'); ?>
<!-- MODAL INTRODUCE END -->

<!-- MODAL PRESENT START -->
<?= render('admin/_modal_present'); ?>
<!-- MODAL PRESENT END -->

<!-- TEMPLATE PRICES START -->
<?= render('admin/_form_prices_template'); ?>
<!-- TEMPLATE PRICES END -->
