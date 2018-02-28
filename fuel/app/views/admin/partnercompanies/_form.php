<?php
use JpPrefecture\JpPrefecture;
?>

<h4>提携会社情報</h4>
<div class="form-group row">
  <div class="col-3">
    <div class="form-group<?= $val->error('partner_company.company_name') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="partner_company_company_name"><h6><i class="fa fa-asterisk" aria-hidden="true"></i> Company name</h6></label>
      <input type="text" required name="partner_company[company_name]" value="<?= $val->input('partner_company.company_name', $partner_company->company_name) ?>" class="form-control" id="partner_company_company_name">
    </div>
  </div>
  <div class="col-3">
    <div class="form-group<?= $val->error('partner_company.email') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="partner_company_email"><h6><i class="fa fa-asterisk" aria-hidden="true"></i> Email</h6></label>
      <input type="text" required name="partner_company[email]" value="<?= $val->input('partner_company.email', $partner_company->email) ?>" class="form-control" id="partner_company_email">
    </div>
  </div>
</div>

<h4>ガス会社情報</h4>
<div class="form-group row">
  <div class="col-2">
    <div class="form-group<?= $val->error('company.display_name') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="company_display_name"><h6>ユーザー側表示名</h6></label>
      <input type="text" name="company[display_name]" value="<?= $val->input('company.display_name', $partner_company->company ? $partner_company->company->display_name : '') ?>" class="form-control" id="company_display_name">
    </div>
  </div>
  <div class="col-2">
    <div class="form-group<?= $val->error('company.zip_code') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="company_zip_code"><h6><i class="fa fa-asterisk" aria-hidden="true"></i> 郵便番号</h6></label>
      <input type="text" required name="company[zip_code]" value="<?= $val->input('company.zip_code', $partner_company->company ? $partner_company->company->zip_code : '') ?>" class="form-control" id="company_zip_code">
    </div>
  </div>
  <div class="col-2">
    <div class="form-group<?= $val->error('company.prefecture_code') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="company_prefecture_code"><h6><i class="fa fa-asterisk" aria-hidden="true"></i> 都道府県</h6></label>
      <?= Form::select('company[prefecture_code]', $val->input('company.prefecture_code', $partner_company->company ? $partner_company->company->prefecture_code : ''), ['' => '選択して'] + JpPrefecture::allKanjiAndCode(), ['class' => 'form-control', 'id' => 'company_prefecture_code']); ?>
    </div>
  </div>
  <div class="col-3">
    <div class="form-group<?= $val->error('company.address') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="company_address"><h6><i class="fa fa-asterisk" aria-hidden="true"></i> 住所</h6></label>
      <input type="text" required name="company[address]" value="<?= $val->input('company.address', $partner_company->company ? $partner_company->company->address : '') ?>" class="form-control" id="company_address">
    </div>
  </div>
</div>

<h4>ピックアップ ※ 3つまで登録可能</h4>
<!-- FIX ME (Add js) -->

<div class="form-group<?= $company_image_err ? ' has-danger' : ''?>">
  <label class="form-control-label" for="company_image"><h6>画像</h6></label>
  <input type="file" class="form-control-file" name="company_image" id="company_image" aria-describedby="fileHelp">
  <?php if ($company_image_err): ?>
    <div class="form-control-feedback"><?= e($company_image_err) ?></div>
  <?php endif; ?>
</div>
<?php if (!$partner_company->is_new()): ?>
  <?php if ($partner_company->company->lpgas_company_image): ?>
    <div class="form-group row">
      <div class="col-3">
        <?= S3::image_tag_s3(S3::makeImageUrl($partner_company->company, false), ["class" => "w-100"]); ?>
      </div>
    </div>
  <?php endif; ?>
<?php endif; ?>

<div class="form-group<?= $company_logo_err ? ' has-danger' : ''?>">
  <label class="form-control-label" for="company_logo"><h6>ロゴ</h6></label>
  <input type="file" class="form-control-file" name="company_logo" id="company_logo" aria-describedby="fileHelp">
  <?php if ($company_logo_err): ?>
    <div class="form-control-feedback"><?= e($company_logo_err) ?></div>
  <?php endif; ?>
</div>
<?php if (!$partner_company->is_new()): ?>
  <?php if ($partner_company->company->lpgas_company_logo): ?>
    <div class="form-group row">
      <div class="col-3">
        <?= S3::image_tag_s3(S3::makeImageUrl($partner_company->company, true), ["class" => "w-100"]); ?>
      </div>
    </div>
  <?php endif; ?>
<?php endif; ?>

<div class="form-group row">
  <div class="col-2">
    <div class="form-group<?= $val->error('company.tel') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="company_tel"><h6><i class="fa fa-asterisk" aria-hidden="true"></i> 電話番号</h6></label>
      <input type="text" required name="company[tel]" value="<?= $val->input('company.tel', $partner_company->company ? $partner_company->company->tel : '') ?>" class="form-control" id="company_tel">
    </div>
  </div>
  <div class="col-2">
    <div class="form-group<?= $val->error('company.fax') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="company_fax"><h6>FAX</h6></label>
      <input type="text" name="company[fax]" value="<?= $val->input('company.fax', $partner_company->company ? $partner_company->company->fax : '') ?>" class="form-control" id="company_fax">
    </div>
  </div>
  <div class="col-3">
    <div class="form-group<?= $val->error('company.homepage') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="company_homepage"><h6>ホームページ</h6></label>
      <input type="text" name="company[homepage]" value="<?= $val->input('company.homepage', $partner_company->company ? $partner_company->company->homepage : '') ?>" class="form-control" id="company_homepage">
    </div>
  </div>
</div>

<div class="form-group">
  <label class="form-control-label"><h6>特徴</h6></label>
  <div class="form-group">
    <div class="form-check form-check-inline">
      <?php $checked = $partner_company->company && $partner_company->company->features ? \Arr::pluck($partner_company->company->features, 'id') : []; ?>
      <?php foreach (\Model_Company_Feature::find('all') as $f): ?>
        <label class="custom-control custom-checkbox">
          <input class="custom-control-input" type="checkbox" name="company_features[]" value="<?= $f->id; ?>"<?= in_array($f->id, $val->input('company_features') ? $val->input('company_features') : $checked) ? ' checked="checked"' : '' ?>>
          <span class="custom-control-indicator"></span>
          <span class="custom-control-description"><?= $f->name; ?></span>
        </label>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<div class="form-group row">
  <div class="col-3">
    <div class="form-group mb-0<?= $val->error('company.default_contracted_commission_s') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="company_default_contracted_commission_s"><h6><i class="fa fa-asterisk" aria-hidden="true"></i> 成約手数料（ガスコンロのみ）</h6></label>
      <div class="input-group">
        <input data-currency="1" required pattern="^[0-9,-]+$" type="text" name="company[default_contracted_commission_s]" value="<?= $val->input('company.default_contracted_commission_s', $partner_company->company ? $partner_company->company->default_contracted_commission_s : '') ?>" class="form-control" id="company_default_contracted_commission_s">
        <div class="input-group-addon">円</div>
      </div>
    </div>
  </div>
  <div class="col-3">
    <div class="form-group mb-0<?= $val->error('company.default_contracted_commission_w') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="company_default_contracted_commission_w"><h6><i class="fa fa-asterisk" aria-hidden="true"></i> 成約手数料（ガス給湯器のみ）</h6></label>
      <div class="input-group">
        <input data-currency="1" required pattern="^[0-9,-]+$" type="text" name="company[default_contracted_commission_w]" value="<?= $val->input('company.default_contracted_commission_w', $partner_company->company ? $partner_company->company->default_contracted_commission_w : '') ?>" class="form-control" id="company_default_contracted_commission_w">
        <div class="input-group-addon">円</div>
      </div>
    </div>
  </div>
  <div class="col-4">
    <div class="form-group mb-0<?= $val->error('company.default_contracted_commission_sw') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="company_default_contracted_commission_sw"><h6><i class="fa fa-asterisk" aria-hidden="true"></i> 成約手数料（ガスコンロ+ガス給湯器）</h6></label>
      <div class="input-group">
        <input data-currency="1" required pattern="^[0-9,-]+$" type="text" name="company[default_contracted_commission_sw]" value="<?= $val->input('company.default_contracted_commission_sw', $partner_company->company ? $partner_company->company->default_contracted_commission_sw : '') ?>" class="form-control" id="company_default_contracted_commission_sw">
        <div class="input-group-addon">円</div>
      </div>
    </div>
  </div>
</div>

<div class="form-group row">
  <div class="col-2">
    <div class="form-group mb-0<?= $val->error('company.established_date') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="company_established_date"><h6><i class="fa fa-asterisk" aria-hidden="true"></i> 設立年月</h6></label>
      <input type="text" required name="company[established_date]" value="<?= $val->input('company.established_date', $partner_company->company ? \Helper\TimezoneConverter::convertFromString($partner_company->company->established_date, 'admin_datepicker') : '') ?>" class="form-control datepicker" id="company_established_date">
    </div>
  </div>
  <div class="col-2">
    <div class="form-group mb-0<?= $val->error('company.capital') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="company_capital"><h6>資本金</h6></label>
      <div class="input-group">
        <input data-currency="1" pattern="^[0-9,-]+$" type="text" name="company[capital]" value="<?= $val->input('company.capital', $partner_company->company ? $partner_company->company->capital : '') ?>" class="form-control" id="company_capital">
        <div class="input-group-addon">円</div>
      </div>
    </div>
  </div>
  <div class="col-2">
    <div class="form-group mb-0<?= $val->error('company.group_company_text') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="company_group_company_text"><h6>グループ会社</h6></label>
      <input type="text" name="company[group_company_text]" value="<?= $val->input('company.group_company_text', $partner_company->company ? $partner_company->company->group_company_text : '') ?>" class="form-control" id="company_group_company_text">
    </div>
  </div>
  <div class="col-2">
    <div class="form-group mb-0<?= $val->error('company.amount_of_sales') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="company_amount_of_sales"><h6>売上高</h6></label>
      <div class="input-group">
        <input data-currency="1" pattern="^[0-9,-]+$" type="text" name="company[amount_of_sales]" value="<?= $val->input('company.amount_of_sales', $partner_company->company ? $partner_company->company->amount_of_sales : '') ?>" class="form-control" id="company_amount_of_sales">
        <div class="input-group-addon">円</div>
      </div>
    </div>
  </div>
  <div class="col-2">
    <div class="form-group mb-0<?= $val->error('company.number_of_employee') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="company_number_of_employee"><h6>従業員数</h6></label>
      <input type="text" name="company[number_of_employee]" value="<?= $val->input('company.number_of_employee', $partner_company->company ? $partner_company->company->number_of_employee : '') ?>" class="form-control" id="company_number_of_employee">
    </div>
  </div>
</div>

<div class="form-group<?= $val->error('company.supply_area_text') ? ' has-danger' : ''?>">
  <label class="form-control-label" for="company_supply_area_text"><h6>供給エリア</h6></label>
  <textarea name="company[supply_area_text]" class="form-control" id="company_supply_area_text" rows="2"><?= $val->input('company.supply_area_text', $partner_company->company ? $partner_company->company->supply_area_text : '') ?></textarea>
  <?php if ($val->error('company.supply_area_text')): ?>
    <div class="form-control-feedback"><?= e($val->error('company.supply_area_text')) ?></div>
  <?php endif; ?>
</div>

<div class="form-group<?= $val->error('company.company_overview') ? ' has-danger' : ''?>">
  <label class="form-control-label" for="company_company_overview"><h6>会社概要</h6></label>
  <textarea name="company[company_overview]" class="form-control" id="company_company_overview" rows="2"><?= $val->input('company.company_overview', $partner_company->company ? $partner_company->company->company_overview : '') ?></textarea>
  <?php if ($val->error('company.company_overview')): ?>
    <div class="form-control-feedback"><?= e($val->error('company.company_overview')) ?></div>
  <?php endif; ?>
</div>

<div class="form-group<?= $val->error('company.business_overview') ? ' has-danger' : ''?>">
  <label class="form-control-label" for="company_business_overview"><h6>事業概要</h6></label>
  <textarea name="company[business_overview]" class="form-control" id="company_business_overview" rows="2"><?= $val->input('company.business_overview', $partner_company->company ? $partner_company->company->business_overview : '') ?></textarea>
  <?php if ($val->error('company.business_overview')): ?>
    <div class="form-control-feedback"><?= e($val->error('company.business_overview')) ?></div>
  <?php endif; ?>
</div>

<div class="form-group<?= $val->error('company.service_features') ? ' has-danger' : ''?>">
  <label class="form-control-label" for="company_service_features"><h6>サービス特徴</h6></label>
  <textarea name="company[service_features]" class="form-control" id="company_service_features" rows="2"><?= $val->input('company.service_features', $partner_company->company ? $partner_company->company->service_features : '') ?></textarea>
  <?php if ($val->error('company.service_features')): ?>
    <div class="form-control-feedback"><?= e($val->error('company.service_features')) ?></div>
  <?php endif; ?>
</div>

<div class="form-group">
  <?php $estimate_req_sendable = $partner_company->company ? $partner_company->company->estimate_req_sendable : 0; ?>
  <label class="form-control-label"><h6>送客可</h6></label>
  <div class="form-group">
    <label class="custom-control custom-radio">
      <input name="company[estimate_req_sendable]" value="1" type="radio" class="custom-control-input"<?= $val->input('company.estimate_req_sendable', $estimate_req_sendable) == 1 ? 'checked="checked"' : ''; ?>>
      <span class="custom-control-indicator"></span>
      <span class="custom-control-description">OK</span>
    </label>
    <label class="custom-control custom-radio">
      <input name="company[estimate_req_sendable]" value="0" type="radio" class="custom-control-input"<?= $val->input('company.estimate_req_sendable', $estimate_req_sendable) == 0 ? 'checked="checked"' : ''; ?>>
      <span class="custom-control-indicator"></span>
      <span class="custom-control-description">NG</span>
    </label>
  </div>
</div>
