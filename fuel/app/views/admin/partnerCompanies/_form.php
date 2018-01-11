<?php
use JpPrefecture\JpPrefecture;
?>

<h4>提携会社情報</h4>
<div class="form-group row">
  <div class="col-3">
    <div class="form-group<?= $val->error('partner_company.company_name') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="partner_company_company_name"><h6><i class="fa fa-asterisk" aria-hidden="true"></i> Company name</h6></label>
      <input type="text" name="partner_company[company_name]" value="<?= $val->input('partner_company.company_name', $partner_company->company_name) ?>" class="form-control" id="partner_company_company_name">
    </div>
  </div>
  <div class="col-3">
    <div class="form-group<?= $val->error('partner_company.email') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="partner_company_email"><h6><i class="fa fa-asterisk" aria-hidden="true"></i> Email</h6></label>
      <input type="text" name="partner_company[email]" value="<?= $val->input('partner_company.email', $partner_company->email) ?>" class="form-control" id="partner_company_email">
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
      <input type="text" name="company[zip_code]" value="<?= $val->input('company.zip_code', $partner_company->company ? $partner_company->company->zip_code : '') ?>" class="form-control" id="company_zip_code">
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
      <input type="text" name="company[address]" value="<?= $val->input('company.address', $partner_company->company ? $partner_company->company->address : '') ?>" class="form-control" id="company_address">
    </div>
  </div>
</div>

<h4>ピックアップ ※ 3つまで登録可能</h4>
<!-- FIM ME (Add js) -->

<div class="form-group<?= $val->error('company.lpgas_company_image') ? ' has-danger' : ''?>">
  <label class="form-control-label" for="company_lpgas_company_image"><h6>画像</h6></label>
  <input type="file" class="form-control-file" id="company_lpgas_company_image" aria-describedby="fileHelp">
  <?php if ($val->error('company.lpgas_company_image')): ?>
    <div class="form-control-feedback"><?= e($val->error('company.lpgas_company_image')) ?></div>
  <?php endif; ?>
</div>
<div class="form-group<?= $val->error('company.lpgas_company_logo') ? ' has-danger' : ''?>">
  <label class="form-control-label" for="company_lpgas_company_logo"><h6>ロゴ</h6></label>
  <input type="file" class="form-control-file" id="company_lpgas_company_logo" aria-describedby="fileHelp">
  <?php if ($val->error('company.lpgas_company_logo')): ?>
    <div class="form-control-feedback"><?= e($val->error('company.lpgas_company_logo')) ?></div>
  <?php endif; ?>
</div>

<div class="form-group row">
  <div class="col-2">
    <div class="form-group<?= $val->error('company.tel') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="company_tel"><h6><i class="fa fa-asterisk" aria-hidden="true"></i> 電話番号</h6></label>
      <input type="text" name="company[tel]" value="<?= $val->input('company.tel', $partner_company->company ? $partner_company->company->tel : '') ?>" class="form-control" id="company_tel">
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
  <label class="form-control-label" for="email"><h6>Email</h6></label>
  <div class="form-group">
    <div class="form-check form-check-inline">
      <?php $checked = $partner_company->company && $partner_company->company->features ? \Arr::pluck($partner_company->company->features, 'id') : []; ?>
      <?php foreach (\Model_Company_Feature::find('all') as $f): ?>
        <label class="custom-control custom-checkbox">
          <input class="custom-control-input" type="checkbox" name="company_features[]" value="<?= $f->id; ?>"<?= $val->input('company_features.'.$f->id) ? ' checked="checked"' : '' ?>>
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
        <input data-currency="1" pattern="^[0-9,-]+$" type="text" name="company[default_contracted_commission_s]" value="<?= $val->input('company.default_contracted_commission_s', $partner_company->company ? $partner_company->company->default_contracted_commission_s : '') ?>" class="form-control" id="company_default_contracted_commission_s">
        <div class="input-group-addon">円</div>
      </div>
    </div>
  </div>
  <div class="col-3">
    <div class="form-group mb-0<?= $val->error('company.default_contracted_commission_w') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="company_default_contracted_commission_w"><h6><i class="fa fa-asterisk" aria-hidden="true"></i> 成約手数料（ガス給湯器のみ）</h6></label>
      <div class="input-group">
        <input data-currency="1" pattern="^[0-9,-]+$" type="text" name="company[default_contracted_commission_w]" value="<?= $val->input('company.default_contracted_commission_w', $partner_company->company ? $partner_company->company->default_contracted_commission_w : '') ?>" class="form-control" id="company_default_contracted_commission_w">
        <div class="input-group-addon">円</div>
      </div>
    </div>
  </div>
  <div class="col-4">
    <div class="form-group mb-0<?= $val->error('company.default_contracted_commission_sw') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="company_default_contracted_commission_sw"><h6><i class="fa fa-asterisk" aria-hidden="true"></i> 成約手数料（ガスコンロ+ガス給湯器）</h6></label>
      <div class="input-group">
        <input data-currency="1" pattern="^[0-9,-]+$" type="text" name="company[default_contracted_commission_sw]" value="<?= $val->input('company.default_contracted_commission_sw', $partner_company->company ? $partner_company->company->default_contracted_commission_sw : '') ?>" class="form-control" id="company_default_contracted_commission_sw">
        <div class="input-group-addon">円</div>
      </div>
    </div>
  </div>
</div>

<div class="form-group row">
  <div class="col-3">
    <div class="form-group mb-0<?= $val->error('company.default_contracted_commission_s') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="company_default_contracted_commission_s"><h6><i class="fa fa-asterisk" aria-hidden="true"></i> 設立年月</h6></label>
      <input type="text" name="company[default_contracted_commission_s]" value="<?= $val->input('company.default_contracted_commission_s', $partner_company->company ? $partner_company->company->default_contracted_commission_s : '') ?>" class="form-control" id="company_default_contracted_commission_s">
    </div>
  </div>
  <div class="col-3">
    <div class="form-group mb-0<?= $val->error('company.default_contracted_commission_w') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="company_default_contracted_commission_w"><h6>成約手数料（ガス給湯器のみ）</h6></label>
      <div class="input-group">
        <input data-currency="1" pattern="^[0-9,-]+$" type="text" name="company[default_contracted_commission_w]" value="<?= $val->input('company.default_contracted_commission_w', $partner_company->company ? $partner_company->company->default_contracted_commission_w : '') ?>" class="form-control" id="company_default_contracted_commission_w">
        <div class="input-group-addon">円</div>
      </div>
    </div>
  </div>
  <div class="col-4">
    <div class="form-group mb-0<?= $val->error('company.default_contracted_commission_sw') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="company_default_contracted_commission_sw"><h6>成約手数料（ガスコンロ+ガス給湯器）</h6></label>
      <div class="input-group">
        <input data-currency="1" pattern="^[0-9,-]+$" type="text" name="company[default_contracted_commission_sw]" value="<?= $val->input('company.default_contracted_commission_sw', $partner_company->company ? $partner_company->company->default_contracted_commission_sw : '') ?>" class="form-control" id="company_default_contracted_commission_sw">
        <div class="input-group-addon">円</div>
      </div>
    </div>
  </div>
</div>

