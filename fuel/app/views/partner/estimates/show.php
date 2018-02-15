<?php
use JpPrefecture\JpPrefecture;
?>

<h2>お客様の情報</h2>
<table class="table table-sm table-hover mt-4 th-left small-row">
  <tr>
    <th>見積もりID</th>
    <td><?= $estimate->uuid; ?></td>
  </tr>
  <tr>
    <th>問い合わせID</th>
    <td><i class="fa fa-user"></i> <?= $estimate->contact->id; ?></td>
  </tr>
  <tr>
    <th>お名前</th>
    <td><?= $estimate->contact->name; ?><?= $estimate->contact->furigana ? "({$estimate->contact->furigana})" : ''; ?></td>
  </tr>
  <tr>
    <th>電話番号</th>
    <td><?= $estimate->contact->tel; ?></td>
  </tr>
  <tr>
    <th>Email</th>
    <td><?= $estimate->contact->email; ?></td>
  </tr>
</table>

<h2>見積もり情報</h2>
<table class="table table-sm table-hover mt-4 th-left small-row">
  <tr>
    <th>ガス検針月</th>
    <td><?= $estimate->contact->gas_meter_checked_month ? $estimate->contact->gas_meter_checked_month.'月' : '-'; ?></td>
  </tr>
  <tr>
    <th>ガス使用量</th>
    <td><?= $estimate->contact->gas_used_amount ? $estimate->contact->gas_used_amount.'m3' : '-'; ?></td>
  </tr>
  <tr>
    <th>直近の請求額</th>
    <td><?= $estimate->contact->gas_latest_billing_amount ? number_format($estimate->contact->gas_latest_billing_amount).'円' : '-'; ?></td>
  </tr>
  <tr>
    <th>契約販売店</th>
    <td><?= $estimate->contact->gas_contracted_shop_name ? $estimate->contact->gas_contracted_shop_name : '-'; ?></td>
  </tr>
  <tr>
    <th>ガス使用年数</th>
    <td><?= $estimate->contact->gas_used_years ? $estimate->contact->gas_used_years.'年' : '-'; ?></td>
  </tr>
  <tr>
    <th>ガス機器</th>
    <td>
      <?php if ($machines = $estimate->contact->getGasMachines()): ?>
        <?php foreach ($machines as $m): ?>
          <div><i class="fa fa-circle-o" aria-hidden="true"></i> <?= $m; ?></div>
        <?php endforeach; ?>
      <?php else: ?>
        <div><i class="fa fa-times" aria-hidden="true"></i> 無し</div>
      <?php endif; ?>
    </td>
  </tr>
  <tr>
    <th>ご相談内容・ご要望</th>
    <td><?= str_replace("\n", "<br>", $estimate->contact->body); ?></td>
  </tr>
  <tr>
    <th>契約選択</th>
    <td><?= $estimate->contact->estimate_kind == \Config::get('models.contact.estimate_kind.new_contract') ? '新規開設' : '現在住居'; ?></td>
  </tr>
  <tr>
    <th>郵便番号</th>
    <td><?= $estimate->contact->getZipCode(); ?></td>
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
    <th>物件種別</th>
    <td><?= __('admin.contact.house_kind.'.\Config::get('views.contact.house_kind.'.$estimate->contact->house_kind)); ?></td>
  </tr>
  <tr>
    <th>物件所有種別</th>
    <td><?= __('admin.contact.ownership_kind.'.\Config::get('views.contact.ownership_kind.'.$estimate->contact->ownership_kind)); ?></td>
  </tr>
  <tr>
    <th>築年数</th>
    <td><?= $estimate->contact->house_age ? $estimate->contact->house_age.'年' : '-'; ?></td>
  </tr>
  <?php if ($estimate->contact->apartment_owner): ?>
    <tr>
      <th>部屋数</th>
      <td><?= $estimate->contact->number_of_rooms; ?></td>
    </tr>
    <tr>
      <th>入居済み部屋数</th>
    <td><?= $estimate->contact->number_of_active_rooms ? $estimate->contact->number_of_active_rooms : '-'; ?></td>
    </tr>
    <tr>
      <th>管理会社名</th>
      <td><?= $estimate->contact->estate_management_company_name ? $estimate->contact->estate_management_company_name : '-'; ?></td>
    </tr>
  <?php endif; ?>
</table>

<h2>ご希望条件</h2>
<table class="table table-sm table-hover mt-4 th-left small-row">
  <tr>
    <th>連絡希望時間</th>
    <td><i class="fa fa-clock-o" aria-hidden="true"></i> <?= __('admin.contact.preferred_contact_time_between.'.$estimate->contact->preferred_contact_time_between); ?></td>
  </tr>
  <tr>
    <th>緊急度</th>
    <td>
      <?php if ($estimate->contact->priority_degree == \Config::get('models.contact.priority_degree.regular')): ?>
        <span class="badge badge-default fs-12px fw-100">通常</span>
      <?php else: ?>
        <span class="badge badge-danger fs-12px fw-100">至急</span>
      <?php endif; ?>
    </td>
  </tr>
  <tr>
    <th>電気料金セット希望</th>
    <td><?= __('admin.contact.desired_option.'.$estimate->contact->desired_option); ?></td>
  </tr>
</table>

<h2 id="timeline">進行状況</h2>

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
    <?php $company_contact_name = ''; ?>
    <?php $status = ''; ?>
    <?php foreach ($timeline as $line): ?>
      <?php if ($line instanceof \Model_Estimate_History): ?>
        <?php if (isset($line->diff_json->is_read) && $line->diff_json->is_read->new) continue; ?>
        <tr>
          <td>
            <?php if (isset($line->diff_json->company_contact_name)): ?>
              <?php $company_contact_name = $line->diff_json->company_contact_name->new; ?>
            <?php endif; ?>
            <?= $company_contact_name; ?>
          </td>
          <td>
            <?php if (isset($line->diff_json->status)): ?>
              <?php $status = $line->diff_json->status->new; ?>
            <?php endif; ?>
            <?php if ($status): ?>
              <div class="card card-outline-<?= $status; ?> text-center max-width">
                <div class="card-block p-0">
                  <blockquote class="card-blockquote"><?= __('admin.estimate.status.'.$status); ?></blockquote>
                </div>
              </div>
            <?php else: ?>
              <b>Just created</b>
            <?php endif; ?>
          </td>
          <td><?= \Helper\TimezoneConverter::convertFromString($line->created_at, 'admin_table'); ?></td>
          <td>
            <?php if ($line->comment): ?>
              <?= $line->comment->comment; ?>
            <?php endif; ?>
          </td>
          <td>
            <?php if (isset($line->diff_json->visited)): ?>
              <b>訪問済み</b>
            <?php elseif (isset($line->diff_json->power_of_attorney_acquired)): ?>
              <b>委任状獲得済み</b>
            <?php elseif (isset($line->diff_json->contacted)): ?>
              <b>連絡済み</b>
            <?php elseif (isset($line->diff_json->visit_scheduled_date)): ?>
              <b>訪問予定日</b>
            <?php elseif (isset($line->diff_json->construction_scheduled_date)): ?>
              <b>工事予定日</b>
            <?php elseif (isset($line->diff_json->construction_finished_date)): ?>
              <b>工事完了日</b>
            <?php endif; ?>
          </td>
        </tr>
      <?php elseif ($line instanceof \Model_Estimate_Comment): ?>
        <tr>
          <td><?= $company_contact_name; ?></td>
          <td>
            <div class="card card-outline-<?= $status; ?> text-center max-width">
              <div class="card-block p-0">
                <blockquote class="card-blockquote"><?= __('admin.estimate.status.'.$status); ?></blockquote>
              </div>
            </div>
          </td>
          <td><?= \Helper\TimezoneConverter::convertFromString($line->created_at, 'admin_table'); ?></td>
          <td><?= $line->comment; ?></td>
          <td></td>
        </tr>
      <?php endif; ?>
    <?php endforeach; ?>
  </tbody>
</table>

<?php if ($estimate->status != \Config::get('models.estimate.status.contracted') && $estimate->status != \Config::get('models.estimate.status.cancelled')): ?>
  <div class="d-flex justify-content-start mb-4">
    <div><a href="#" class="btn-cancel btn btn-danger" role="button" data-estimate-id="<?= $estimate->id; ?>" data-contact-name="<?= $estimate->contact->name; ?>" data-contact-pref="<?= JpPrefecture::findByCode($estimate->contact->getPrefectureCode())->nameKanji; ?>" data-contact-tel="<?= $estimate->contact->tel; ?>">キャンセル</a></div>
  </div>
<?php endif; ?>

<?php if ($estimate->status == \Config::get('models.estimate.status.verbal_ok') || $estimate->status == \Config::get('models.estimate.status.contracted')): ?>
  <?= \Form::open(['action' => \Uri::create('partner/estimates/:id/progress', ['id' => $estimate->id])]); ?>
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
              <input class="form-control" placeholder="担当者" value="<?= $estimate->company_contact_name; ?>" type="text" name="company_contact_name">
            </div>
            <div class="form-group">
              <textarea name="comment" class="form-control" rows="4" placeholder="メモ"></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-sm mb-2">更新する</button>
          <?php elseif ($estimate->contacted): ?>
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
              <input class="form-control" placeholder="担当者" value="<?= $estimate->company_contact_name; ?>" type="text" name="company_contact_name">
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
              <input class="form-control" placeholder="担当者" value="<?= $estimate->company_contact_name; ?>" type="text" name="company_contact_name">
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
              <input class="form-control" placeholder="担当者" value="<?= $estimate->company_contact_name; ?>" type="text" name="company_contact_name">
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
              <input class="form-control" placeholder="担当者" value="<?= $estimate->company_contact_name; ?>" type="text" name="company_contact_name">
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
          <?php if ($estimate->construction_scheduled_date && !$estimate->construction_finished_date): ?>
            <div class="form-group">
              <input class="form-control datepicker" placeholder="訪問予定日" value="" type="text" name="construction_finished_date">
            </div>
            <div class="form-group">
              <input class="form-control" placeholder="担当者" value="<?= $estimate->company_contact_name; ?>" type="text" name="company_contact_name">
            </div>
            <div class="form-group">
              <textarea name="comment" class="form-control" rows="4" placeholder="メモ"></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-sm mb-2">更新する</button>
          <?php elseif ($estimate->construction_finished_date): ?>
            <?= $estimate->construction_finished_date; ?>
          <?php endif; ?>
        </td>
      </tr>
    </table>
  <?= Form::close(); ?>
<?php endif; ?>


<!-- <div class="mb-4">
  <a class="btn btn-secondary" href="<?= \Uri::create('admin/estimates/:id/history', ['id' => $estimate->id]); ?>" role="button">全ての項目の更新履歴を見る</a>
</div> -->

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
<?= render('admin/_table_prices_template'); ?>
<!-- TEMPLATE PRICES END -->
