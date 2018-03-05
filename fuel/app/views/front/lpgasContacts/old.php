<?php
use JpPrefecture\JpPrefecture;
?>

<div class="page">
  <div class="skinny">
    <?php if (\Uri::segment(1) != 'enechange'): ?>
      <div class="step-container">
        <div>
          <?= Asset::img('estimate_presentation/new_step_img_01.png', ['class' => 'lpgas-form-step-image']); ?>
          <p class="step-supply-txt">入力頂いた内容によっては、STEP2で完了する場合がございます。</p>
        </div>
      </div>

      <h2 class="page-title center">
        エネピなら、お客様にピッタリの<br>プロパンガス会社を簡単ネット見積もり。
      </h2>
    <?php endif; ?>

    <?php if (\Uri::segment(1) == 'kakaku'): ?>
      <div class="step">
        <h3 class="step-heading">プロパンガス料金 お見積もりまでの流れ</h3>
        <?= Asset::img('enechange/step.png'); ?>
      </div>
    <?php elseif (\Uri::segment(1) == 'enechange'): ?>
      <div class="ene-quo-banner-pc">
        <?= Asset::img('enechange/eneQUOheader-5000-pc.png'); ?>
      </div>
      <div class="ene-quo-banner-sp">
        <?= Asset::img('enechange/eneQUOheader-5000-sp.png'); ?>
      </div>
      <div class="step">
        <h3 class="step-heading">プロパンガス料金 お見積もりまでの流れ</h3>
        <?= Asset::img('enechange/step.png'); ?>
      </div>
    <?php endif; ?>

    <?php if ($apartment_form): ?>
      <p class="center">このお見積もりフォームは、集合住宅のオーナー様（大家様）専用のものです。ご入居者様からのお問い合わせには対応致しかねますので、ご了承ください。</p>
    <?php endif; ?>
    
    <?= \Form::open(['action' => $this->estimate_post_url, 'class' => 'table-form', 'id' => 'register_form_old']); ?>
    <?= \Form::csrf(); ?>
      <input type="hidden" name="token" value="<?= isset($token) ? $token : '' ?>">
      <input type="hidden" name="contact_id" value="<?=  isset($contact_id) ? $contact_id : '' ?>">
      <?php if ($apartment_form): ?>
      <input type="hidden" name="apartment_form" value="1">
      <input type="hidden" name="lpgas_contact[house_kind]" value="apartment">
      <input type="hidden" name="lpgas_contact[apartment_owner]" value="1">
      <?php endif; ?>

      <h3 class="table-form-header"><i class="fa fa-building" aria-hidden="true"></i>ガスを見直したい物件</h3>

      <div class="form-bg">
      <table>
        <?php if (!$apartment_form): ?>
          <tr>
            <th>
              <i class="fa fa-pencil" aria-hidden="true"></i>
              <label class="required" for="lpgas_contact_estimate_kind">ガスを見直したい物件は</label>
            </th>
            <td>
              <input type="radio" value="change_contract" name="lpgas_contact[estimate_kind]" id="lpgas_contact_estimate_kind_change_contract"<?= $val->input('lpgas_contact.estimate_kind', \Config::get('views.contact.estimate_kind.'.$contact->estimate_kind)) != 'new_contract' ? ' checked="checked"' : '' ?>>
              <label class="checkbox_label_margin" for="lpgas_contact_estimate_kind_change_contract">現在住居の見積もり</label>
              <input type="radio" value="new_contract" name="lpgas_contact[estimate_kind]" id="lpgas_contact_estimate_kind_new_contract"<?= $val->input('lpgas_contact.estimate_kind', \Config::get('views.contact.estimate_kind.'.$contact->estimate_kind)) == 'new_contract' ? ' checked="checked"' : '' ?>>
              <label class="checkbox_label_margin" for="lpgas_contact_estimate_kind_new_contract">新規開設の見積もり</label>
              <?php if ($val->error('lpgas_contact.estimate_kind')): ?>
              <div>
                <span class="attention validation_message"><?= e($val->error('lpgas_contact.estimate_kind')) ?></span>
              </div>
              <?php endif; ?>
            </td>
          </tr>
          <tr>
            <th>
              <i class="fa fa-pencil" aria-hidden="true"></i>
              <label class="required" for="lpgas_contact_zip_code">現在お住まいの郵便番号は？</label>
            </th>
            <td>
              〒 <input data-hyphen-digits="1" type="text" name="lpgas_contact[zip_code]" id="lpgas_contact_zip_code" value="<?= $val->input('lpgas_contact.zip_code', $contact->zip_code) ?>" onKeyUp="AjaxZip3.zip2addr(this,'','lpgas_contact[prefecture_code]','lpgas_contact[address]');"> <span class="example">(例: 1500022)</span>
              <?php if ($val->error('lpgas_contact.zip_code')): ?>
              <div>
                <span class="attention validation_message"><?= e($val->error('lpgas_contact.zip_code')) ?></span>
              </div>
              <?php endif; ?>
              <p class="notice_txt"><i class="fa fa-info-circle" aria-hidden="true"></i>郵便番号を入力すると、下の住所が自動で途中まで入力されます。</p>
            </td>
          </tr>
          <tr>
            <th>
              <i class="fa fa-pencil" aria-hidden="true"></i>
              <label class="required" for="lpgas_contact_prefecture_code">現在お住まいの住所は？</label>
            </th>
            <td>
              <div class="select-wrap styled-select">
                <div><?= Form::select('lpgas_contact[prefecture_code]', $val->input('lpgas_contact.prefecture_code', $contact->prefecture_code), ['' => '選択してください'] + JpPrefecture::allKanjiAndCode(), ['id' => 'lpgas_contact_prefecture_code']); ?></div>
              </div>
              <?php if ($val->error('lpgas_contact.prefecture_code')): ?>
              <div>
                <span class="attention validation_message"><?= e($val->error('lpgas_contact.prefecture_code')) ?></span>
              </div>
              <?php endif; ?>
              <input placeholder="例）港区新橋" type="text" name="lpgas_contact[address]" id="lpgas_contact_address" value="<?= $val->input('lpgas_contact.address', '') ?>">
              <?php if ($val->error('lpgas_contact.address')): ?>
              <div>
                <span class="attention validation_message"><?= e($val->error('lpgas_contact.address')) ?></span>
              </div>
              <?php endif; ?>
              <input placeholder="例）1-18-16" type="text" name="lpgas_contact[address2]" id="lpgas_contact_address2" value="<?= $val->input('lpgas_contact.address2', '') ?>">
              <?php if ($val->error('lpgas_contact.address2')): ?>
              <div>
                <span class="attention validation_message"><?= e($val->error('lpgas_contact.address2')) ?></span>
              </div>
              <?php endif; ?>
            </td>
          </tr>
        <?php endif; ?>
        <tr class="<?= $apartment_form ? '' : 'js-show-on-estimate-type-new-contract' ?>">
          <?php if ($apartment_form): ?>
            <th>
              <i class="fa fa-pencil" aria-hidden="true"></i>
              <label class="required" for="lpgas_contact_new_zip_code">物件の郵便番号は？</label>
            </th>
          <?php else: ?>
            <th>
              <i class="fa fa-pencil" aria-hidden="true"></i>
              <label class="required" for="lpgas_contact_new_zip_code">開設先の郵便番号は？</label>
            </th>
          <?php endif; ?>
          <td>
            〒 <input data-hyphen-digits="1" type="text" name="lpgas_contact[new_zip_code]" id="lpgas_contact_new_zip_code" value="<?= $val->input('lpgas_contact.new_zip_code', $contact->new_zip_code) ?>" onKeyUp="AjaxZip3.zip2addr(this,'','lpgas_contact[new_prefecture_code]','lpgas_contact[new_address]');">
            <span class="example">(例: 1500022)</span>
            <?php if ($val->error('lpgas_contact.new_zip_code')): ?>
            <div>
              <span class="attention validation_message"><?= e($val->error('lpgas_contact.new_zip_code')) ?></span>
            </div>
            <?php endif; ?>
            <p class="notice_txt"><i class="fa fa-info-circle" aria-hidden="true"></i>郵便番号を入力すると、下の住所が自動で途中まで入力されます。</p>
          </td>
        </tr>
        <tr class="<?= $apartment_form ? '' : 'js-show-on-estimate-type-new-contract' ?>">
          <?php if ($apartment_form): ?>
            <th>
              <i class="fa fa-pencil" aria-hidden="true"></i>
              <label class="required" for="lpgas_contact_new_prefecture_code">物件の住所は？</label>
            </th>
          <?php else: ?>
            <th>
              <i class="fa fa-pencil" aria-hidden="true"></i>
              <label class="required" for="lpgas_contact_new_prefecture_code">開設先の住所は？</label>
            </th>
          <?php endif; ?>
          <td>
            <div class="select-wrap styled-select">
            <div><?= Form::select('lpgas_contact[new_prefecture_code]', $val->input('lpgas_contact.new_prefecture_code', $contact->new_prefecture_code), ['' => '選択してください'] + JpPrefecture::allKanjiAndCode(), ['id' => 'lpgas_contact_new_prefecture_code']); ?></div>
          </div>
            <?php if ($val->error('lpgas_contact.new_prefecture_code')): ?>
            <div>
              <span class="attention validation_message"><?= e($val->error('lpgas_contact.new_prefecture_code')) ?></span>
            </div>
            <?php endif; ?>
            <input placeholder="例）港区新橋" type="text" name="lpgas_contact[new_address]" id="lpgas_contact_new_address" value="<?= $val->input('lpgas_contact.new_address', '') ?>">
            <?php if ($val->error('lpgas_contact.new_address')): ?>
            <div>
              <span class="attention validation_message"><?= e($val->error('lpgas_contact.new_address')) ?></span>
            </div>
            <?php endif; ?>
          </td>
        </tr>

        <?php if (!$apartment_form): ?>
          <tr>
            <th>
              <i class="fa fa-pencil" aria-hidden="true"></i>
              <label class="required" for="lpgas_contact_ownership_kind">住居の種類は?</label>
            </th>
            <td>
              <div class="house-kind-area">
                <div class="select-area">
                  <p style="margin: 0; font-weight: bold;">一戸建ての場合</p>
                  <input type="radio" value="owner" name="lpgas_contact[ownership_kind]" id="lpgas_contact_ownership_kind_owner"<?= $val->input('lpgas_contact.ownership_kind') != 'borrower' || $val->input('lpgas_contact.ownership_kind') != 'unit_owner' ? ' checked="checked"' : '' ?>>
                  <label class="checkbox_label_margin" for="lpgas_contact_ownership_kind_owner">所有(持ち家)</label>
                  <p style="margin: 0; font-weight: bold;">店舗(業務用)の場合</p>
                  <input type="radio" value="borrower" name="lpgas_contact[ownership_kind]" id="lpgas_contact_ownership_kind_borrower"<?= $val->input('lpgas_contact.ownership_kind') == 'borrower' ? ' checked="checked"' : '' ?>>
                  <label class="checkbox_label_margin" for="lpgas_contact_ownership_kind_borrower">賃貸(借り主)</label>
                  <input type="radio" value="unit_owner" name="lpgas_contact[ownership_kind]" id="lpgas_contact_ownership_kind_unit_owner"<?= $val->input('lpgas_contact.ownership_kind') == 'unit_owner' ? ' checked="checked"' : '' ?>>
                  <label class="checkbox_label_margin" for="lpgas_contact_ownership_kind_unit_owner">所有</label>
                </div>
                <div class="btn-link" style="margin-left: 50px; padding-top: 35px;">
                  <?php if ($this->from_enechange): ?>
                    <a class="owner-form-link-btn" href="/enechange/lpgas/contacts/new?apartment_form=1">マンションオーナーの方はこちら</a>
                  <?php else: ?>
                    <a class="owner-form-link-btn" href="/lpgas_contacts/new?apartment_form=1">マンションオーナーの方はこちら</a>
                  <?php endif; ?>
                </div>
                <p class="notice_txt"><i class="fa fa-info-circle" aria-hidden="true"></i>マンション・アパートにお住まいの方はご登録頂けません。</p>
              </div>
              <?php if ($val->error('lpgas_contact.ownership_kind')): ?>
              <div>
                <span class="attention validation_message"><?= e($val->error('lpgas_contact.ownership_kind')) ?></span>
              </div>
              <?php endif; ?>
            </td>
          </tr>
        <?php endif; ?>

        <tr>
          <th>
            <i class="fa fa-pencil" aria-hidden="true"></i>
            <label for="lpgas_contact_house_age">築年数は？</label>
          </th>
          <td>
            <input data-hyphen-digits="1" type="text" name="lpgas_contact[house_age]" id="lpgas_contact_house_age" value="<?= $val->input('lpgas_contact.house_age', '') ?>">
            <span class="unit">年</span>
            <?php if ($val->error('lpgas_contact.house_age')): ?>
            <div>
              <span class="attention validation_message"><?= e($val->error('lpgas_contact.house_age')) ?></span>
            </div>
            <?php endif; ?>
            <p class="notice_txt"><i class="fa fa-info-circle" aria-hidden="true"></i>だいたいでOKです。</p>
          </td>
        </tr>

        <?php if ($apartment_form): ?>
          <tr>
            <th>
              <i class="fa fa-pencil" aria-hidden="true"></i>
              <label class="required" for="lpgas_contact_number_of_rooms">部屋数</label>
            </th>
            <td>
              <input data-hyphen-digits="1" type="text" name="lpgas_contact[number_of_rooms]" id="lpgas_contact_number_of_rooms" value="<?= $val->input('lpgas_contact.number_of_rooms', '') ?>">
              <?php if ($val->error('lpgas_contact.number_of_rooms')): ?>
              <div>
                <span class="attention validation_message"><?= e($val->error('lpgas_contact.number_of_rooms')) ?></span>
              </div>
              <?php endif; ?>
            </td>
          </tr>
          <tr>
            <th>
              <i class="fa fa-pencil" aria-hidden="true"></i>
              <label for="lpgas_contact_number_of_active_rooms">入居済み部屋数</label>
            </th>
            <td>
              <input data-hyphen-digits="1" type="text" name="lpgas_contact[number_of_active_rooms]" id="lpgas_contact_number_of_active_rooms" value="<?= $val->input('lpgas_contact.number_of_active_rooms', '') ?>">
              <?php if ($val->error('lpgas_contact.number_of_active_rooms')): ?>
              <div>
                <span class="attention validation_message"><?= e($val->error('lpgas_contact.number_of_active_rooms')) ?></span>
              </div>
              <?php endif; ?>
            </td>
          </tr>
          <tr>
            <th>
              <i class="fa fa-pencil" aria-hidden="true"></i>
              <label for="lpgas_contact_estate_management_company_name">管理会社名</label>
            </th>
            <td>
              <input type="text" name="lpgas_contact[estate_management_company_name]" id="lpgas_contact_estate_management_company_name" value="<?= $val->input('lpgas_contact.estate_management_company_name', '') ?>">
              <?php if ($val->error('lpgas_contact.estate_management_company_name')): ?>
              <div>
                <span class="attention validation_message"><?= e($val->error('lpgas_contact.estate_management_company_name')) ?></span>
              </div>
              <?php endif; ?>
            </td>
          </tr>
        <?php endif; ?>

        <?php if (!$apartment_form): ?>
          <tr class="js-show-on-estimate-type-new-contract">
            <th>
              <i class="fa fa-pencil" aria-hidden="true"></i>
              <label for="lpgas_contact_moving_scheduled_date">引越し予定日は？</label>
            </th>
            <td>
              <input class="datepicker" type="text" name="lpgas_contact[moving_scheduled_date]" id="lpgas_contact_moving_scheduled_date" aria-label="Use the arrow keys to pick a date" value="<?= $val->input('lpgas_contact.moving_scheduled_date', '') ?>">
              <?php if ($val->error('lpgas_contact.moving_scheduled_date')): ?>
              <div>
                <span class="attention validation_message"><?= e($val->error('lpgas_contact.moving_scheduled_date')) ?></span>
              </div>
              <?php endif; ?>
              <p class="notice_txt"><i class="fa fa-info-circle" aria-hidden="true"></i>だいたいでOKです。</p>
            </td>
          </tr>
        <?php endif; ?>
      </table>
      </div>

      <h3 class="table-form-header"><i class="fa fa-home" aria-hidden="true"></i>ガスの使用状況</h3>

      <div class="form-bg">
      <table>
        <tr>
          <th>
            <i class="fa fa-pencil" aria-hidden="true"></i>
            <label for="lpgas_contact_gas_contracted_shop_name" class="required">契約中のガス会社は？</label>
            <a href="#" class="md-btn" data-toggle="modal" data-target="#gas_bill"><i class="fa fa-question" aria-hidden="true"></i></a>
          </th>
          <td>
            <input type="text" name="lpgas_contact[gas_contracted_shop_name]" id="lpgas_contact_gas_contracted_shop_name" value="<?= $val->input('lpgas_contact.gas_contracted_shop_name', '') ?>">
            <?php if ($val->error('lpgas_contact.gas_contracted_shop_name')): ?>
            <div>
              <span class="attention validation_message"><?= e($val->error('lpgas_contact.gas_contracted_shop_name')) ?></span>
            </div>
            <?php endif; ?>
          </td>
        </tr>
        <tr>
          <th>
            <?php if ($apartment_form): ?>
              <i class="fa fa-pencil" aria-hidden="true"></i>
              <label for="lpgas_contact_gas_meter_checked_month">最近のガス使用量・料金は？</label>
            <?php else: ?>
              <i class="fa fa-pencil" aria-hidden="true"></i>
              <label class="required" for="lpgas_contact_gas_meter_checked_month">最近のガス使用量・料金は？</label>
            <?php endif; ?>
            <a href="#" class="md-btn adjustment-box" data-toggle="modal" data-target="#gas_bill"><i class="fa fa-question" aria-hidden="true"></i></a>
          </th>
          <td>
            <input data-hyphen-digits="1" type="text" name="lpgas_contact[gas_meter_checked_month]" id="lpgas_contact_gas_meter_checked_month" value="<?= $val->input('lpgas_contact.gas_meter_checked_month', '') ?>">  <span class="unit">月のガス使用量が</span>
            <input data-hyphen-digits="1" type="text" name="lpgas_contact[gas_used_amount]" id="lpgas_contact_gas_used_amount" value="<?= $val->input('lpgas_contact.gas_used_amount', '') ?>">  <span class="unit">m³で</span>
            <input data-hyphen-digits="1" type="text" name="lpgas_contact[gas_latest_billing_amount]" id="lpgas_contact_gas_latest_billing_amount" value="<?= $val->input('lpgas_contact.gas_latest_billing_amount', '') ?>"> <span class="unit">円(税込)</span>
            <?php if ($val->error('lpgas_contact.gas_meter_checked_month')): ?>
            <div>
              <span class="attention validation_message"><?= e($val->error('lpgas_contact.gas_meter_checked_month')) ?></span>
            </div>
            <?php endif; ?>
            <?php if ($val->error('lpgas_contact.gas_used_amount')): ?>
            <div>
              <span class="attention validation_message"><?= e($val->error('lpgas_contact.gas_used_amount')) ?></span>
            </div>
            <?php endif; ?>
            <?php if ($val->error('lpgas_contact.gas_latest_billing_amount')): ?>
            <div>
              <span class="attention validation_message"><?= e($val->error('lpgas_contact.gas_latest_billing_amount')) ?></span>
            </div>
            <?php endif; ?>
            <p class="notice_txt"><i class="fa fa-info-circle" aria-hidden="true"></i>わからない方はだいたいでOKです。</p>
          </td>
        </tr>
        <tr>
          <th><i class="fa fa-pencil" aria-hidden="true"></i><label for="lpgas_contact_gas_used_years">今のガス会社の使用年数は？</label></th>
          <td>
            <input data-hyphen-digits="1" type="text" name="lpgas_contact[gas_used_years]" id="lpgas_contact_gas_used_years" value="<?= $val->input('lpgas_contact.gas_used_years', '') ?>">  <span class="unit">年</span>
            <?php if ($val->error('lpgas_contact.gas_used_years')): ?>
            <div>
              <span class="attention validation_message"><?= e($val->error('lpgas_contact.gas_used_years')) ?></span>
            </div>
            <?php endif; ?>
          </td>
        </tr>
        <tr>
          <th><i class="fa fa-pencil" aria-hidden="true"></i><label for="lpgas_contact_gas_machines">ガスを利用するものは？</label></th>
          <td>
            <!-- <input name="lpgas_contact[using_cooking_stove]" type="hidden" value=""> -->
            <input type="checkbox" value="1" name="lpgas_contact[using_cooking_stove]" id="lpgas_contact_using_cooking_stove"<?= $val->input('lpgas_contact.using_cooking_stove') ? ' checked="checked"' : '' ?>>
            <label class="checkbox_label_margin" for="lpgas_contact_using_cooking_stove">ガスコンロ</label>

            <!-- <input name="lpgas_contact[using_bath_heater_with_gas_hot_water_supply]" type="hidden" value=""> -->
            <input type="checkbox" value="1" name="lpgas_contact[using_bath_heater_with_gas_hot_water_supply]" id="lpgas_contact_using_bath_heater_with_gas_hot_water_supply"<?= $val->input('lpgas_contact.using_bath_heater_with_gas_hot_water_supply') ? ' checked="checked"' : '' ?>>
            <label class="checkbox_label_margin" for="lpgas_contact_using_bath_heater_with_gas_hot_water_supply">給湯器</label>

            <!-- <input name="lpgas_contact[using_other_gas_machine]" type="hidden" value=""> -->
            <input type="checkbox" value="1" name="lpgas_contact[using_other_gas_machine]" id="lpgas_contact_using_other_gas_machine"<?= $val->input('lpgas_contact.using_other_gas_machine') ? ' checked="checked"' : '' ?>>
            <label for="lpgas_contact_using_other_gas_machine">ストーブその他</label>
            <p class="notice_txt"><i class="fa fa-info-circle" aria-hidden="true"></i>当てはまる全ての選択肢にチェックしてください。</p>
          </td>
        </tr>
        <tr>
          <th><i class="fa fa-pencil" aria-hidden="true"></i><label for="lpgas_contact_body">ご相談・ご要望は？</label></th>
          <td>
            <textarea placeholder="例）ガス会社の変更希望、適正料金の相談など" name="lpgas_contact[body]" id="lpgas_contact_body"><?= $val->input('lpgas_contact.body', '') ?></textarea>
            <?php if ($val->error('lpgas_contact.body')): ?>
            <div>
              <span class="attention validation_message"><?= e($val->error('lpgas_contact.body')) ?></span>
            </div>
            <?php endif; ?>
          </td>
        </tr>
      </table>
      </div>

      <p class="notice_info_txt"><i class="fa fa-info-circle" aria-hidden="true"></i>お客様の情報が一般に公開されることはありませんのでご安心ください。</p>

      <h3 class="table-form-header"><i class="fa fa-user" aria-hidden="true"></i>お客様の情報</h3>

      <div class="form-bg">
      <table>
        <tr>
          <th><i class="fa fa-pencil" aria-hidden="true"></i><label class="required" for="lpgas_contact_name">お名前は？</label></th>
          <td>
            <input type="text" name="lpgas_contact[name]" id="lpgas_contact_name" value="<?= $val->input('lpgas_contact.name', '') ?>"> <span class="example">(例: 山田 太郎)</span>
            <?php if ($val->error('lpgas_contact.name')): ?>
            <div>
              <span class="attention validation_message"><?= e($val->error('lpgas_contact.name')) ?></span>
            </div>
            <?php endif; ?>
          </td>
        </tr>
        <tr>
          <th><i class="fa fa-pencil" aria-hidden="true"></i><label class="required" for="lpgas_contact_tel">電話番号は？</label></th>
          <td>
            <input data-hyphen-digits="1" type="text" name="lpgas_contact[tel]" id="lpgas_contact_tel" value="<?= $val->input('lpgas_contact.tel', '') ?>"> <span class="example">(例: 09011112222)</span>
            <p class="notice_txt"><i class="fa fa-info-circle" aria-hidden="true"></i>繋がりやすい電話番号をご記入ください。</p>
            <?php if ($val->error('lpgas_contact.tel')): ?>
            <div>
              <span class="attention validation_message"><?= e($val->error('lpgas_contact.tel')) ?></span>
            </div>
            <?php endif; ?>
          </td>
        </tr>
        <tr>
          <th><i class="fa fa-pencil" aria-hidden="true"></i><label class="required" for="lpgas_contact_email">メールアドレスは？</label></th>
          <td>
            <input type="text" name="lpgas_contact[email]" id="lpgas_contact_email" value="<?= $val->input('lpgas_contact.email', '') ?>"> <span class="example">(例: info@enepi.jp)</span>
            <?php if ($val->error('lpgas_contact.email')): ?>
            <div>
              <span class="attention validation_message"><?= e($val->error('lpgas_contact.email')) ?></span>
            </div>
            <?php endif; ?>
          </td>
        </tr>
        <?php if ($apartment_form): ?>
          <tr>
            <th><i class="fa fa-pencil" aria-hidden="true"></i><label class="required" for="lpgas_contact_zip_code">郵便番号は？</label></th>
            <td>
              〒 <input type="text" name="lpgas_contact[zip_code]" id="lpgas_contact_zip_code" value="<?= $val->input('lpgas_contact.zip_code', '') ?>">
              <span class="example">(例: 1500022)</span>
              <?php if ($val->error('lpgas_contact.zip_code')): ?>
              <div>
                <span class="attention validation_message"><?= e($val->error('lpgas_contact.zip_code')) ?></span>
              </div>
              <?php endif; ?>
              <p class="notice_txt"><i class="fa fa-info-circle" aria-hidden="true"></i>郵便番号を入力すると、下の住所が自動で途中まで入力されます。</p>
            </td>
          </tr>
          <tr>
            <th><i class="fa fa-pencil" aria-hidden="true"></i><label class="required" for="lpgas_contact_prefecture_code">都道府県は？</label></th>
            <td>
              <div class="select-wrap styled-select">
                <?= Form::select('lpgas_contact[prefecture_code]', $val->input('lpgas_contact.prefecture_code', ''), ['' => '選択してください'] + JpPrefecture::allKanjiAndCode(), ['id' => 'lpgas_contact_new_prefecture_code']); ?>
              </div>
              <?php if ($val->error('lpgas_contact.prefecture_code')): ?>
              <div>
                <span class="attention validation_message"><?= e($val->error('lpgas_contact.prefecture_code')) ?></span>
              </div>
              <?php endif; ?>
              <input placeholder="例）港区新橋" type="text" name="lpgas_contact[address]" id="lpgas_contact_address" value="<?= $val->input('lpgas_contact.address', '') ?>">
              <?php if ($val->error('lpgas_contact.address')): ?>
              <div>
                <span class="attention validation_message"><?= e($val->error('lpgas_contact.address')) ?></span>
              </div>
              <?php endif; ?>
              <input placeholder="例）1-18-16" type="text" name="lpgas_contact[address2]" id="lpgas_contact_address2" value="<?= $val->input('lpgas_contact.address2', '') ?>">
              <?php if ($val->error('lpgas_contact.address2')): ?>
              <div>
                <span class="attention validation_message"><?= e($val->error('lpgas_contact.address2')) ?></span>
              </div>
              <?php endif; ?>
            </td>
          </tr>
        <?php endif; ?>
      </table>
      </div>

      <input type="submit" name="commit" value="登録する" data-disable-with="送信中...">

      <p class="before_preview">
        当サービスをご利用頂くにあたり、<a target="_blank" href="<?= \Uri::create('agreement') ?>">「enepi」利用規約</a>に同意したものとみなします。同意いただけない場合、相談を利用することはできません。
      </p>
    <?= Form::close(); ?>
  </div>
</div>

<!-- MODAL GAS BILL START -->
<div class="modal fade" id="gas_bill" tabindex="-1" role="dialog" aria-labelledby="GassBill" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="GassBill">ガスの使用状況</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body modal-gas-bill">
        <?= Asset::img('img_receipt.png'); ?>
      </div>
    </div>
  </div>
</div>
<!-- MODAL GAS BILL END -->

<!-- <?php if (\Uri::segment(1) != 'enechange'): ?>
  <?php if (\Fuel::$env == \Fuel::PRODUCTION): ?>
    <script src="//app.gorilla-efo.com/js/efo.158.js" type="text/javascript"></script>
  <?php elseif (\Fuel::$env == \Fuel::STAGING): ?>
    <script src="//app.gorilla-efo.com/js/efo.158_test.js" type="text/javascript"></script>
  <?php endif; ?>
<?php endif; ?> -->

<?= render('shared/yahoo_retargeting'); ?>
<?= render('shared/google_remarketing'); ?>
