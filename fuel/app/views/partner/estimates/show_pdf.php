<!DOCTYPE html>
<html lang="ja">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>プロパンガス切替希望 現場調査票 - enepi</title>
  <style>
    
    body { font-family: jgothic; }

    html { font-size: 100%; width: 1080px; }

    td.none { background-image: -webkit-linear-gradient(68deg, transparent 49%, #d9d9d9 49%, #d9d9d9 50%, transparent 50%, transparent); background-repeat: no-repeat; background-size: 100% 100%; }

    td.circle img { text-align: center; width: 20px; height: 20px; display: block; margin-left: auto; margin-right: auto; }

    img { vertical-align: middle; border: 0; }

    .table { width: 100%; border-spacing: 0; border-collapse: collapse; table-layout: fixed; text-align: center;}

    .table th, .table td { padding: 8px; border: 1px solid #d9d9d9; height: 20px; line-height: 1.2; }

    .table th { font-weight: bold; background-color: #f2f2f2; font-size: 14px; }

    .table td { background-color: white; }

    .table.table--child-gas { width: 100%; }

    .table.table--child-gas tr + tr { border-top: 1px solid #d9d9d9; }

    .table.table--child-gas th, .table.table--child-gas td { border: none; }

    .table.table--child-gas th { width: 88px; font-size: 12px; border-right: 1px solid #d9d9d9; }

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
        <th rowspan="2" colspan="3" class="table__title">プロパンガス切替希望 現場調査票</th>
        <th colspan="2" rowspan="2" class="table__logo">
          
        </th>
        <th colspan="3">問い合わせID</th>
      </tr>
      <tr>
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
          <?= $estimate->contact->prefecture_code ?><?= $estimate->contact->address ?><?= $estimate->contact->address2 ?>
        </td>
        <th>メールアドレス</th>
        <td colspan="3"><?= $estimate->contact->email ?></td>
      </tr>
      <tr>
        <th>開設先住所</th>
        <td colspan="3">
          <div class="table__td-item">〒 <?= $estimate->contact->new_zip_code ?></div>
          <?= $estimate->contact->new_prefecture_code ?><?= $estimate->contact->new_address ?><?= $estimate->contact->new_address2 ?>
        </td>
        <th>引越し予定日</th>
        <td colspan="3"><?= $estimate->contact->moving_scheduled_date ?></td>
      </tr>
      <!-- 物件情報 -->
      <tr>
        <th colspan="8">物件情報</th>
      </tr>
      <tr>
        <th>開設先状況</th>
        <td>
          <?= $estimate->contact->estimate_kind ?>
        </td>
        <th>物件種別</th>
        <td><?= $estimate->contact->house_kind ?></td>
        <th>所有区分</th>
        <td><?= $estimate->contact->ownership_kind ?></td>
        <th>築年数</th>
        <td><?= $estimate->contact->house_age ?>年</td>
      </tr>
      <tr>
        <th>集合住宅<br>オーナー</th>
        <?php if ($estimate->contact->apartment_owner): ?>
          <td class="circle"></td>
        <?php else: ?>
          <td class="none"></td>
        <?php endif; ?>
        <th>部屋数</th>
        <?php if ($estimate->contact->apartment_owner): ?>
          <td><?= $estimate->contact->number_of_rooms ?></td>
        <?php else: ?>
          <td class="none"></td>
        <?php endif; ?>
        <th>入居数</th>
        <?php if ($estimate->contact->apartment_owner): ?>
          <td><?= $estimate->contact->number_of_active_rooms ?></td>
        <?php else: ?>
          <td class="none"></td>
        <?php endif; ?>
        <th>管理会社名</th>
        <?php if ($estimate->contact->apartment_owner): ?>
          <td><?= $estimate->contact->estate_management_company_name ?></td>
        <?php else: ?>
          <td class="none"></td>
        <?php endif; ?>
      </tr>
      <!-- ガス情報 -->
      <tr>
        <th colspan="8">ガス情報</th>
      </tr>
      <tr>
        <th>既存ガス会社名</th>
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
        <td><?= $estimate->contact->gas_latest_billing_amount ?>円</td>
        <th>ガス機器</th>
        <td class="no-padding">
          <table class="table table--child-gas">
            <tr>
              <th>ガスコンロ</th>
              <td class="circle"></td>
            </tr>
            <tr>
              <th>ガス給湯器</th>
              <td class="circle"></td>
            </tr>
            <tr>
              <th>その他</th>
              <td class="circle"></td>
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
        <td></td>
        <th>急ぎ</th>
        <td></td>
        <th>電力セット希望</th>
        <td></td>
        <th colspan="2"></th>
      </tr>
      <!-- ご相談・ご要望 -->
      <tr>
        <th colspan="8">ご相談・ご要望</th>
      </tr>
      <tr>
        <td colspan="8"><?= $estimate->contact->body ?></td>
      </tr>
      <!-- 進捗状況 -->
      <tr>
        <th colspan="8">進捗状況</th>
      </tr>
      <tr>
        <th>訪問予定日</th>
        <td colspan="3"><?= $estimate->visit_scheduled_date ?></td>
        <th>ご担当者</th>
        <td colspan="3"></td>
      </tr>
    </tbody>
  </table>
</body>
</html>
