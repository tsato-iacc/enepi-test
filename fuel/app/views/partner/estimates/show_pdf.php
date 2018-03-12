<?php
use JpPrefecture\JpPrefecture;
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>プロパンガス切替希望 現場調査票 - enepi</title>
  <style>
    
    body { font-family: jgothic; }

    html { font-size: 14px; width: 1080px; }

    td.none { margin: 0 !important; padding: 0 !important; }

    td.none .none-wrap { display: flex; justify-content: center; align-items: center; }
    
    td.none .none-wrap > div { height: 1px; width: 100%; margin: 0 -5px; background-color: #d9d9d9; transform: rotate(24deg); }

    td.circle { padding: 0; }

    td.circle img { text-align: center; width: 15px; height: 15px; display: block; margin: 0; padding: 0;}

    img { vertical-align: middle; border: 0; }

    .table { width: 100%; border-spacing: 0; border-collapse: collapse; table-layout: fixed; }

    .table th, .table td { padding: 4px 6px; border: 1px solid #d9d9d9; height: 20px; line-height: 1.2; word-break:break-all; word-wrap:break-word; }

    .table th { font-weight: bold; background-color: #f2f2f2; font-size: 12px; text-align: center; }

    .table td { background-color: white; }

    .table.table--child-gas { width: 100%; border: 0;}

    .table.table--child-gas th, .table.table--child-gas td { border: 0; }

    .table.table--child-gas th { width: 70%; font-size: 10px; }

    .table.table--child-gas .bb { border-bottom: 1px solid #d9d9d9; }

    .table.table--child-gas .br { border-right: 1px solid #d9d9d9; }

    .table__td-item::after { content: "\000A"; display: block; white-space: pre-wrap; }

    .table .no-padding { padding: 0; }

    /* Table Header */
    thead .table__title { background-color: white; font-size: 20px; }

    thead .table__logo { background-color: white; padding: 1em; }

    thead .table__logo__img { height: 50px; }

  </style>
</head>
<body>
  <table class="table">
    <thead>
      <tr>
        <th rowspan="2" colspan="3" class="table__title">プロパンガス切替希望<br>現場調査票</th>
        <th colspan="2" rowspan="2" class="table__logo">
          <img src="assets/images/logo-v2.png" class="table__logo__img">
        </th>
        <th colspan="3">問い合わせID</th>
      </tr>
      <tr style="text-align: center;">
        <td colspan="3"><?= $estimate->contact->id ?></td>
      </tr>
    </thead>
    <tbody>
      <!-- ユーザー情報 -->
      <tr>
        <th colspan="8">ユーザー情報</th>
      </tr>
      <tr>
        <th>氏名</th>
        <td colspan="3">
          <div class="table__td-item">フリガナ）<?= $estimate->contact->furigana ?></div>
          <?= $estimate->contact->name ?>
        </td>
        <th>TEL</th>
        <td colspan="3"><?= $estimate->contact->tel ?></td>
      </tr>
      <tr>
        <th>住所</th>
        <td colspan="3">
          <div class="table__td-item">〒 <?= $estimate->contact->zip_code ?></div>
          <?= $estimate->contact->prefecture_code ? JpPrefecture::findByCode($estimate->contact->prefecture_code)->nameKanji : ''; ?><?= $estimate->contact->address ?><?= $estimate->contact->address2 ?>
        </td>
        <th style="font-size: 10px;">メールアドレス</th>
        <td colspan="3"><?= $estimate->contact->email ?></td>
      </tr>
      <tr>
        <th>開設先住所</th>
        <td colspan="3">
          <div class="table__td-item">〒 <?= $estimate->contact->new_zip_code ?></div>
          <?= $estimate->contact->new_prefecture_code ? JpPrefecture::findByCode($estimate->contact->new_prefecture_code)->nameKanji : ''; ?><?= $estimate->contact->new_address ?><?= $estimate->contact->new_address2 ?>
        </td>
        <th>引越し予定日</th>
        <td colspan="3"><?= $estimate->contact->moving_scheduled_date ? Date::create_from_string($estimate->contact->moving_scheduled_date, 'admin_datepicker')->format('partner_pdf') : ''; ?></td>
      </tr>
      <!-- 物件情報 -->
      <tr>
        <th colspan="8">物件情報</th>
      </tr>
      <tr>
        <th>開設先状況</th>
        <td>
          <?= $estimate->contact->estimate_kind == \Config::get('models.contact.estimate_kind.new_contract') ? '新規開設' : '現在住居'; ?>
        </td>
        <th>物件種別</th>
        <td><?= __('admin.contact.house_kind.'.\Config::get('views.contact.house_kind.'.$estimate->contact->house_kind)); ?></td>
        <th>所有区分</th>
        <td><?= __('admin.contact.ownership_kind.'.\Config::get('views.contact.ownership_kind.'.$estimate->contact->ownership_kind)); ?></td>
        <th>築年数</th>
        <td><?= $estimate->contact->house_age ?>年</td>
      </tr>
      <tr>
        <th>集合住宅<br>オーナー</th>
        <?php if ($estimate->contact->apartment_owner): ?>
          <td class="circle">
            <div class="circle-wrap">
              <img src="assets/images/circle.png" class="table__logo__img">
            </div>
          </td>
        <?php else: ?>
          <td class="none">
            <div class="none-wrap">
              <div></div>
            </div>
          </td>
        <?php endif; ?>
        <th>部屋数</th>
        <?php if ($estimate->contact->apartment_owner): ?>
          <td><?= $estimate->contact->number_of_rooms ?></td>
        <?php else: ?>
          <td class="none">
            <div class="none-wrap">
              <div></div>
            </div>
          </td>
        <?php endif; ?>
        <th>入居数</th>
        <?php if ($estimate->contact->apartment_owner): ?>
          <td><?= $estimate->contact->number_of_active_rooms ?></td>
        <?php else: ?>
          <td class="none">
            <div class="none-wrap">
              <div></div>
            </div>
          </td>
        <?php endif; ?>
        <th>管理会社名</th>
        <?php if ($estimate->contact->apartment_owner): ?>
          <td><?= $estimate->contact->estate_management_company_name ?></td>
        <?php else: ?>
          <td class="none">
            <div class="none-wrap">
              <div></div>
            </div>
          </td>
        <?php endif; ?>
      </tr>
      <!-- ガス情報 -->
      <tr>
        <th colspan="8">ガス情報</th>
      </tr>
      <tr>
        <th style="font-size: 10px;">既存ガス会社名</th>
        <td colspan="3"><?= $estimate->contact->gas_contracted_shop_name ?></td>
        <th>契約年数</th>
        <td colspan="3"><?= $estimate->contact->gas_used_years ?>年</td>
      </tr>
      <tr>
        <th>検針月</th>
        <td><?= $estimate->contact->gas_meter_checked_month ?>月</td>
        <th>使用量</th>
        <td><?= $estimate->contact->gas_used_amount ?>m3</td>
        <th>請求金額</th>
        <td><?= number_format($estimate->contact->gas_latest_billing_amount); ?>円</td>
        <th>ガス機器</th>
        <td class="no-padding">
          <table class="table table--child-gas">
            <tr>
              <th class="bb br">ガスコンロ</th>
              <td class="circle bb">
                <?php if ($estimate->contact->using_cooking_stove): ?>
                  <img src="assets/images/circle.png" class="table__logo__img">
                <?php endif; ?>
              </td>
            </tr>
            <tr>
              <th class="bb br">ガス給湯器</th>
              <td class="circle bb">
                <?php if ($estimate->contact->using_bath_heater_with_gas_hot_water_supply): ?>
                  <img src="assets/images/circle.png" class="table__logo__img">
                <?php endif; ?>
              </td>
            </tr>
            <tr>
              <th class="br">その他</th>
              <td class="circle">
                <?php if ($estimate->contact->using_other_gas_machine): ?>
                  <img src="assets/images/circle.png" class="table__logo__img">
                <?php endif; ?>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <!-- 希望情報 -->
      <tr>
        <th colspan="8">希望情報</th>
      </tr>
      <tr>
        <th>初回連絡<br>希望時間</th>
        <td><?= __('admin.contact.preferred_contact_time_between.'.$estimate->contact->preferred_contact_time_between); ?></td>
        <th>急ぎ</th>
        <td><?= $estimate->contact->priority_degree == \Config::get('models.contact.priority_degree.regular') ? '通常' : '至急'; ?></td>
        <th style="font-size: 10px;">電力セット希望</th>
        <td><?= __('admin.contact.desired_option.'.$estimate->contact->desired_option); ?></td>
        <th colspan="2"></th>
      </tr>
      <!-- ご相談・ご要望 -->
      <tr>
        <th colspan="8">ご相談・ご要望</th>
      </tr>
      <tr>
        <td colspan="8"><?= str_replace("\n", "<br>", $estimate->contact->body); ?></td>
      </tr>
      <!-- 進捗状況 -->
      <tr>
        <th colspan="8">進捗状況</th>
      </tr>
      <tr>
        <th>訪問予定日</th>
        <td colspan="3"><?= $estimate->visit_scheduled_date ? Date::create_from_string($estimate->visit_scheduled_date, 'admin_datepicker')->format('partner_pdf') : ''; ?></td>
        <th>ご担当者</th>
        <td colspan="3"></td>
      </tr>
    </tbody>
  </table>
</body>
</html>
