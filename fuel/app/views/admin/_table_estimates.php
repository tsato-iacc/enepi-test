<?php
use JpPrefecture\JpPrefecture;
?>

<table class="table table-sm table-hover small-row">
  <thead>
    <tr>
      <th>
        <div>緊急度</div>
        <div><i class="fa fa-hashtag" aria-hidden="true"></i> 問い合わせID</div>
        <div><i class="fa fa-calendar" aria-hidden="true"></i> 紹介日時</div>
        <div><i class="fa fa-calendar" aria-hidden="true"></i> 工事予定日</div>
        <div><i class="fa fa-user-circle-o" aria-hidden="true"></i> 担当者名</div>
      </th>
      <th>
        <div>未読/既読</div>
        <?php if (\Uri::segment(1) == 'admin'): ?>
          <div><i class="fa fa-building-o" aria-hidden="true"></i> 会社名</div>
        <?php endif; ?>
        <div><i class="fa fa-user" aria-hidden="true"></i> お名前</div>
        <div><i class="fa fa-phone" aria-hidden="true"></i> 電話番号</div>
        <div><i class="fa fa-clock-o" aria-hidden="true"></i> 希望連絡時間</div>
      </th>
      <th>
        <div><i class="fa fa-map" aria-hidden="true"></i> 開設先都道府県</div>
        <div><i class="fa fa-map" aria-hidden="true"></i> 開設先市区町村</div>
        <div><i class="fa fa-map-o" aria-hidden="true"></i> 都道府県(現住所)</div>
        <div><i class="fa fa-map-o" aria-hidden="true"></i> 市区町村(現住所)</div>
        <div><i class="fa fa-university" aria-hidden="true"></i> 物件種別</div>
      </th>
      <th>ガス機器</th>
      <th>ステータス</th>
      <th>見積もり進行状況</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($estimates as $estimate): ?>
      <tr>
        <td>
          <div>
            <?php if ($estimate->contact->priority_degree == \Config::get('models.contact.priority_degree.regular')): ?>
              <span class="badge badge-default fs-12px fw-100">通常</span>
            <?php else: ?>
              <span class="badge badge-danger fs-12px fw-100">至急</span>
            <?php endif; ?>
          </div>
          <div><i class="fa fa-hashtag" aria-hidden="true"></i> <?= $estimate->contact->id; ?></div>
          <div><i class="fa fa-calendar" aria-hidden="true"></i> <?= \Helper\TimezoneConverter::convertFromString($estimate->created_at, 'admin_table'); ?></div>
          <div><i class="fa fa-calendar" aria-hidden="true"></i> <?= $estimate->construction_scheduled_date ? $estimate->construction_scheduled_date : '-'; ?></div>
          <div><i class="fa fa-user-circle-o" aria-hidden="true"></i> <?= $estimate->company_contact_name ? $estimate->company_contact_name : '-'; ?></div>
        </td>
        <td>
          <div>
            <?php if ($estimate->is_read): ?>
              <span class="badge badge-success fs-12px fw-100">既読</span>
            <?php else: ?>
              <span class="badge badge-default fs-12px fw-100">未読</span>
            <?php endif; ?>
          </div>
          <?php if (\Uri::segment(1) == 'admin'): ?>
            <div><i class="fa fa-building-o" aria-hidden="true"></i> <?= $estimate->company->getCompanyName(); ?></div>
          <?php endif; ?>
          <div><i class="fa fa-user" aria-hidden="true"></i> <?= $estimate->contact->name; ?></div>
          <div><i class="fa fa-phone" aria-hidden="true"></i> <?= $estimate->contact->tel; ?></div>
          <div><i class="fa fa-clock-o" aria-hidden="true"></i> <?= __('admin.contact.preferred_contact_time_between.'.$estimate->contact->preferred_contact_time_between); ?></div>
        </td>
        <td>
          <div>
            <div><i class="fa fa-map" aria-hidden="true"></i> <?= $estimate->contact->new_prefecture_code ? JpPrefecture::findByCode($estimate->contact->new_prefecture_code)->nameKanji : '-'; ?></div>
            <div><i class="fa fa-map" aria-hidden="true"></i> <?= $estimate->contact->new_address ? $estimate->contact->new_address : '-'; ?></div>
            <div><i class="fa fa-map-o" aria-hidden="true"></i> <?= $estimate->contact->prefecture_code ? JpPrefecture::findByCode($estimate->contact->prefecture_code)->nameKanji : '-'; ?></div>
            <div><i class="fa fa-map-o" aria-hidden="true"></i> <?= $estimate->contact->address ? $estimate->contact->address : '-'; ?></div>
            <div><i class="fa fa-university" aria-hidden="true"></i> <?= __('admin.contact.house_kind.'.\Config::get('views.contact.house_kind.'.$estimate->contact->house_kind)); ?></div>
          </div>
        </td>
        <td>
          <?php if ($machines = $estimate->contact->getGasMachines()): ?>
            <?php foreach ($machines as $m): ?>
              <div><i class="fa fa-circle-o" aria-hidden="true"></i> <?= $m; ?></div>
            <?php endforeach; ?>
          <?php else: ?>
            <div><i class="fa fa-times" aria-hidden="true"></i> 無し</div>
          <?php endif; ?>
        </td>
        <td class="align-middle">
          <?php $status_reason = $estimate->status_reason ? \Helper\CancelReasons::getNameByValue($estimate->status_reason) : ''; ?>
          <div class="card card-outline-<?= \Config::get('views.estimate.status.'.$estimate->status); ?> text-center"<?= $status_reason ? ' data-toggle="tooltip" data-placement="top" title="'. $status_reason .'"' : ''?>>
            <div class="card-block p-0">
              <blockquote class="card-blockquote"><?= __('admin.estimate.status.'.\Config::get('views.estimate.status.'.$estimate->status)) ?><?= $status_reason ? ' <i class="fa fa-commenting" aria-hidden="true"></i>': ''; ?></blockquote>
            </div>
          </div>
        </td>
        <td class="align-middle">
          <div class="card card-small card-outline-<?= $estimate->contacted? 'success' : 'danger'; ?> text-center mb-1">
            <div class="card-block p-0">
              <blockquote class="card-blockquote"><?= $estimate->contacted? '連絡済み' : '未連絡'; ?></blockquote>
            </div>
          </div>
          <div class="card card-small card-outline-<?= $estimate->visited? 'success' : 'danger'; ?> text-center mb-1">
            <div class="card-block p-0">
              <blockquote class="card-blockquote"><?= $estimate->visited? '訪問済み' : '未訪問'; ?></blockquote>
            </div>
          </div>
          <div class="card card-small card-outline-<?= $estimate->power_of_attorney_acquired? 'success' : 'danger'; ?> text-center mb-1">
            <div class="card-block p-0">
              <blockquote class="card-blockquote"><?= $estimate->power_of_attorney_acquired? '委任状獲得済み' : '委任状未獲得'; ?></blockquote>
            </div>
          </div>
          <div class="card card-small card-outline-<?= $estimate->construction_scheduled_date? 'success' : 'danger'; ?> text-center mb-1">
            <div class="card-block p-0">
              <blockquote class="card-blockquote"><?= $estimate->construction_scheduled_date? '工事予定' : '工事未定'; ?></blockquote>
            </div>
          </div>
          <div class="card card-small card-outline-<?= $estimate->construction_finished_date? 'success' : 'danger'; ?> text-center">
            <div class="card-block p-0">
              <blockquote class="card-blockquote"><?= $estimate->construction_finished_date? '工事完了' : '工事未完了'; ?></blockquote>
            </div>
          </div>
        </td>
        <td class="align-middle">
          <div>
            <?php if (\Uri::segment(1) == 'partner'): ?>
              <a href="<?= \Uri::create('partner/estimates/:id'.'?'.http_build_query(['u' => $auth_user->id]), ['id' => $estimate->id]); ?>" class="btn btn-secondary btn-sm px-1 mb-1 w-100" role="button"><i class="fa fa-address-card-o" aria-hidden="true"></i> 詳細</a>
            <?php else: ?>
              <a href="<?= \Uri::create('admin/estimates/:id', ['id' => $estimate->id]); ?>" class="btn btn-secondary btn-sm px-1 mb-1 w-100" role="button"><i class="fa fa-address-card-o" aria-hidden="true"></i> 詳細</a>
            <?php endif; ?>
          </div>
          <?php if (\Uri::segment(1) == 'admin' && $estimate->status == \Config::get('models.estimate.status.sent_estimate_to_user')): ?>
            <div><a href="#" class="btn-introduce btn btn-success btn-sm px-1 mb-1 w-100" role="button" data-estimate-id="<?= $estimate->id; ?>" data-company-name="<?= $estimate->company->getCompanyName(); ?>" data-contact-pref="<?= JpPrefecture::findByCode($estimate->contact->getPrefectureCode())->nameKanji; ?>" data-contact-tel="<?= $estimate->contact->tel; ?>"><i class="fa fa-recycle" aria-hidden="true"></i> 送客</a></div>
          <?php endif; ?>
          <?php if ($estimate->status != \Config::get('models.estimate.status.contracted') && $estimate->status != \Config::get('models.estimate.status.cancelled')): ?>
            <div><a href="#" class="btn-cancel btn btn-danger btn-sm px-1 w-100" role="button" data-estimate-id="<?= $estimate->id; ?>" data-contact-name="<?= $estimate->contact->name; ?>" data-contact-pref="<?= JpPrefecture::findByCode($estimate->contact->getPrefectureCode())->nameKanji; ?>" data-contact-tel="<?= $estimate->contact->tel; ?>"><i class="fa fa-fire" aria-hidden="true"></i> キャンセル</a></div>
          <?php endif; ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
