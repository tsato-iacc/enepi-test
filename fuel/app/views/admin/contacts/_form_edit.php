<?php
use JpPrefecture\JpPrefecture;
?>

<h3>お客様情報</h3>
<div class="form-group row mb-0">
  <div class="col-2">
    <div class="form-group<?= $val->error('name') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="name"><h6><i class="fa fa-asterisk" aria-hidden="true"></i> お名前</h6></label>
      <input type="text" required name="name" value="<?= $val->input('name', $contact->name); ?>" class="form-control" id="name">
    </div>
  </div>
  <div class="col-2">
    <div class="form-group<?= $val->error('furigana') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="furigana"><h6>ふりがな</h6></label>
      <input type="text" name="furigana" value="<?= $val->input('furigana', $contact->furigana); ?>" class="form-control" id="furigana">
    </div>
  </div>
  <div class="col-2">
    <div class="form-group<?= $val->error('tel') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="tel"><h6><i class="fa fa-asterisk" aria-hidden="true"></i> 電話番号</h6></label>
      <input type="text" required name="tel" value="<?= $val->input('tel', str_replace('-', '', $contact->tel)); ?>" class="form-control" id="tel">
    </div>
  </div>
  <div class="col-3">
    <div class="form-group<?= $val->error('email') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="email"><h6><i class="fa fa-asterisk" aria-hidden="true"></i> メールアドレス</h6></label>
      <input type="text" required name="email" value="<?= $val->input('email', $contact->email); ?>" class="form-control" id="email">
    </div>
  </div>
</div>
<div class="form-group row">
  <div class="col-2">
    <div class="form-group<?= $val->error('zip_code') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="zip_code"><h6>郵便番号</h6></label>
      <input type="text" name="zip_code" value="<?= $val->input('zip_code', str_replace('-', '', $contact->zip_code)); ?>" class="form-control" id="zip_code">
    </div>
  </div>
  <div class="col-2">
    <div class="form-group<?= $val->error('prefecture_code') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="prefecture_code"><h6>都道府県</h6></label>
      <?= Form::select('prefecture_code', $val->input('prefecture_code', $contact->prefecture_code), ['' => 'none'] + JpPrefecture::allKanjiAndCode(), ['class' => 'form-control', 'id' => 'prefecture_code']); ?>
    </div>
  </div>
  <div class="col-3">
    <div class="form-group<?= $val->error('address') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="address"><h6>住所</h6></label>
      <input type="text" name="address" value="<?= $val->input('address', $contact->address); ?>" class="form-control" id="address">
    </div>
  </div>
  <div class="col-3">
    <div class="form-group<?= $val->error('address2') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="address2"><h6>住所(番地以降)</h6></label>
      <input type="text" name="address2" value="<?= $val->input('address2', $contact->address2); ?>" class="form-control" id="address2">
    </div>
  </div>
</div>

<hr>
<h3>開設先の情報</h3>
<div class="form-group row mb-0">
  <div class="col-3">
    <div class="form-group<?= $val->error('house_kind') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="house_kind"><h6>物件種別</h6></label>
      <?= Form::select('house_kind', $val->input('house_kind', \Config::get('views.contact.house_kind.'.$contact->house_kind)), __('admin.contact.house_kind'), ['class' => 'form-control', 'id' => 'house_kind']); ?>
    </div>
  </div>
  <div class="col-2">
    <div class="form-group<?= $val->error('ownership_kind') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="ownership_kind"><h6>所有種別</h6></label>
      <?= Form::select('ownership_kind', $val->input('ownership_kind', \Config::get('views.contact.ownership_kind.'.$contact->ownership_kind)), __('admin.contact.ownership_kind'), ['class' => 'form-control', 'id' => 'ownership_kind']); ?>
    </div>
  </div>
  <div class="col-2">
    <div class="form-group<?= $val->error('house_age') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="house_age"><h6>築年数</h6></label>
      <div class="input-group mb-2 mr-sm-2 mb-sm-0">
        <input type="number" name="house_age" class="form-control" id="house_age" value="<?= $val->input('house_age', $contact->house_age); ?>">
        <div class="input-group-addon">年</div>
      </div>
    </div>
  </div>
</div>

<?php if ($contact->estimate_kind == \Config::get('models.contact.estimate_kind.new_contract') || $contact->apartment_owner): ?>
  <div class="form-group row mb-0">
    <div class="col-2">
      <div class="form-group<?= $val->error('new_zip_code') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="new_zip_code"><h6>郵便番号</h6></label>
        <input type="text" name="new_zip_code" value="<?= $val->input('new_zip_code', str_replace('-', '', $contact->new_zip_code)); ?>" class="form-control" id="new_zip_code">
      </div>
    </div>
    <div class="col-2">
      <div class="form-group<?= $val->error('new_prefecture_code') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="new_prefecture_code"><h6>都道府県</h6></label>
        <?= Form::select('new_prefecture_code', $val->input('new_prefecture_code', $contact->new_prefecture_code), ['' => 'none'] + JpPrefecture::allKanjiAndCode(), ['class' => 'form-control', 'id' => 'new_prefecture_code']); ?>
      </div>
    </div>
    <div class="col-3">
      <div class="form-group<?= $val->error('new_address') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="new_address"><h6>住所</h6></label>
        <input type="text" name="new_address" value="<?= $val->input('new_address', $contact->new_address); ?>" class="form-control" id="new_address">
      </div>
    </div>
    <div class="col-3">
      <div class="form-group<?= $val->error('new_address2') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="new_address2"><h6>住所(番地以降)</h6></label>
        <input type="text" name="new_address2" value="<?= $val->input('new_address2', $contact->new_address2); ?>" class="form-control" id="new_address2">
      </div>
    </div>
  </div>
<?php else: ?>
  <div class="card card-outline-success mb-3 text-center">
    <div class="card-block">
      <blockquote class="card-blockquote">
        <i class="fa fa-address-book-o" aria-hidden="true"></i> 開設先と現住所は同じ</a>
      </blockquote>
    </div>
  </div>
<?php endif; ?>

<?php if ($contact->apartment_owner): ?>
  <div class="form-group row">
    <div class="col-2">
      <div class="form-group<?= $val->error('number_of_rooms') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="number_of_rooms"><h6><i class="fa fa-asterisk" aria-hidden="true"></i> 部屋数</h6></label>
        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
          <input type="number" required="required" name="number_of_rooms" class="form-control" id="number_of_rooms" value="<?= $val->input('number_of_rooms', $contact->number_of_rooms); ?>">
          <div class="input-group-addon">部屋</div>
        </div>
      </div>
    </div>
    <div class="col-2">
      <div class="form-group<?= $val->error('number_of_active_rooms') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="number_of_active_rooms"><h6>入居済み部屋数</h6></label>
        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
          <input type="number" name="number_of_active_rooms" class="form-control" id="number_of_active_rooms" value="<?= $val->input('number_of_active_rooms', $contact->number_of_active_rooms); ?>">
          <div class="input-group-addon">部屋</div>
        </div>
      </div>
    </div>
    <div class="col-3">
      <div class="form-group<?= $val->error('estate_management_company_name') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="estate_management_company_name"><h6>管理会社名</h6></label>
        <input type="text" name="estate_management_company_name" class="form-control" id="estate_management_company_name" value="<?= $val->input('estate_management_company_name', $contact->estate_management_company_name); ?>">
      </div>
    </div>
  </div>
<?php endif; ?>

<hr>
<h3>現在の契約</h3>
<div class="form-group row mb-0">
  <div class="col-3">
    <div class="form-group<?= $val->error('gas_contracted_shop_name') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="gas_contracted_shop_name"><h6>契約販売店名</h6></label>
      <input type="text" name="gas_contracted_shop_name" class="form-control" id="gas_contracted_shop_name" value="<?= $val->input('gas_contracted_shop_name', $contact->gas_contracted_shop_name); ?>">
    </div>
  </div>
  <div class="col-2">
    <div class="form-group<?= $val->error('gas_used_years') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="gas_used_years"><h6>契約年数</h6></label>
      <div class="input-group mb-2 mr-sm-2 mb-sm-0">
        <input type="number" name="gas_used_years" class="form-control" id="gas_used_years" value="<?= $val->input('gas_used_years', $contact->gas_used_years); ?>">
        <div class="input-group-addon">年</div>
      </div>
    </div>
  </div>
</div>
<div class="form-group row mb-0">
  <div class="col-2">
    <div class="form-group<?= $val->error('gas_meter_checked_month') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="gas_meter_checked_month"><h6><i class="fa fa-asterisk" aria-hidden="true"></i> ガス検針月</h6></label>
      <?= Form::select('gas_meter_checked_month', $val->input('gas_meter_checked_month', $contact->gas_meter_checked_month), ['' => '選択'] + __('admin.contact.gas_meter_checked_month'), ['class' => 'form-control', 'id' => 'gas_meter_checked_month', 'required' => 'required']); ?>
    </div>
  </div>
  <div class="col-2">
    <div class="form-group<?= $val->error('gas_used_amount') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="gas_used_amount"><h6><i class="fa fa-asterisk" aria-hidden="true"></i> ガス使用量</h6></label>
      <div class="input-group mb-2 mr-sm-2 mb-sm-0">
        <input type="text" required="required" name="gas_used_amount" class="form-control" id="gas_used_amount" value="<?= $val->input('gas_used_amount', $contact->gas_used_amount); ?>">
        <div class="input-group-addon">m3</div>
      </div>
    </div>
  </div>
  <div class="col-2">
    <div class="form-group<?= $val->error('gas_latest_billing_amount') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="gas_latest_billing_amount"><h6><i class="fa fa-asterisk" aria-hidden="true"></i> 直近の請求額</h6></label>
      <div class="input-group mb-2 mr-sm-2 mb-sm-0">
        <input type="number" required="required" name="gas_latest_billing_amount" class="form-control" id="gas_latest_billing_amount" value="<?= $val->input('gas_latest_billing_amount', $contact->gas_latest_billing_amount); ?>">
        <div class="input-group-addon">円</div>
      </div>
    </div>
  </div>
</div>

<div class="form-group">
  <label class="form-control-label"><h6>使用中のガス機器</h6></label>
  <div class="form-group">
    <div class="form-check form-check-inline">
      <label class="custom-control custom-checkbox">
        <?= Form::checkbox('using_cooking_stove', 1, $val->validated('using_cooking_stove', $contact->using_cooking_stove), ['class' => 'custom-control-input']); ?>
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">ガスコンロ</span>
      </label>
    </div>
    <div class="form-check form-check-inline">
      <label class="custom-control custom-checkbox">
        <?= Form::checkbox('using_bath_heater_with_gas_hot_water_supply', 1, $val->validated('using_bath_heater_with_gas_hot_water_supply', $contact->using_bath_heater_with_gas_hot_water_supply), ['class' => 'custom-control-input']); ?>
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">給湯器</span>
      </label>
    </div>
    <div class="form-check form-check-inline">
      <label class="custom-control custom-checkbox">
        <?= Form::checkbox('using_other_gas_machine', 1, $val->validated('using_other_gas_machine', $contact->using_other_gas_machine), ['class' => 'custom-control-input']); ?>
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">ストーブその他</span>
      </label>
    </div>
  </div>
</div>

<hr>
<h3>ご希望条件</h3>
<div class="form-group row">
  <div class="col-2">
    <div class="form-group<?= $val->error('preferred_contact_time_between') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="preferred_contact_time_between"><h6>希望連絡時間</h6></label>
      <?= Form::select('preferred_contact_time_between', $val->input('preferred_contact_time_between', $contact->preferred_contact_time_between), __('admin.contact.preferred_contact_time_between'), ['class' => 'form-control', 'id' => 'preferred_contact_time_between']); ?>
    </div>
  </div>
  <div class="col-2">
    <div class="form-group<?= $val->error('priority_degree') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="priority_degree"><h6>緊急度</h6></label>
      <?= Form::select('priority_degree', $val->input('priority_degree', $contact->priority_degree), __('admin.contact.priority_degree'), ['class' => 'form-control', 'id' => 'priority_degree']); ?>
    </div>
  </div>
  <div class="col-2">
    <div class="form-group<?= $val->error('desired_option') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="desired_option"><h6>電気料金セット希望</h6></label>
      <?= Form::select('desired_option', $val->input('desired_option', $contact->desired_option), __('admin.contact.desired_option'), ['class' => 'form-control', 'id' => 'desired_option']); ?>
    </div>
  </div>
</div>

<div class="form-group<?= $val->error('body') ? ' has-danger' : ''?>">
  <label class="form-control-label" for="body"><h6>ご相談内容・ご要望</h6></label>
  <textarea name="body" class="form-control" id="body" rows="2"><?= $val->input('body', $contact->body) ?></textarea>
  <?php if ($val->error('body')): ?>
    <div class="form-control-feedback"><?= e($val->error('body')) ?></div>
  <?php endif; ?>
</div>

<div class="form-group<?= $val->error('admin_memo') ? ' has-danger' : ''?>">
  <label class="form-control-label" for="admin_memo"><h6>管理者メモ</h6></label>
  <textarea name="admin_memo" class="form-control" id="admin_memo" rows="2"><?= $val->input('admin_memo', $contact->admin_memo) ?></textarea>
  <?php if ($val->error('admin_memo')): ?>
    <div class="form-control-feedback"><?= e($val->error('admin_memo')) ?></div>
  <?php endif; ?>
</div>

<div class="form-group row mb-0">
  <div class="col-2">
    <div class="form-group">
      <label class="form-control-label" for="status"><h6>ステータス</h6></label>
      <div class="card card-outline-<?= \Config::get('views.contact.status.'.$contact->status); ?> text-center">
        <div class="card-block p-1">
          <blockquote class="card-blockquote"><?= __('admin.contact.status.'.\Config::get('views.contact.status.'.$contact->status)) ?></blockquote>
        </div>
      </div>
    </div>
  </div>
  <div class="col-2">
    <div class="form-group<?= $val->error('user_status') ? ' has-danger' : ''?>">
      <label class="form-control-label" for="user_status"><h6>小ステータス</h6></label>
      <?= Form::select('user_status', $val->input('user_status', \Config::get('views.contact.user_status.'.$contact->user_status)), __('admin.contact.user_status'), ['class' => 'form-control', 'id' => 'user_status']); ?>
    </div>
  </div>
</div>

<?php if ($contact->status == \Config::get('models.contact.status.sent_estimate_req') || $contact->status == \Config::get('models.contact.status.verbal_ok') || $contact->status == \Config::get('models.contact.status.contracted')): ?>
  <div class="card card-outline-danger text-center">
    <div class="card-block">
      <blockquote class="card-blockquote">
        <p>ステータスが「<?= __('admin.contact.status.'.\Config::get('views.contact.status.'.$contact->status)) ?>」の見積もりです。情報の編集はガス会社から見える情報にも影響するので注意してください。</p>
        <footer>また、住所を変更した際には見積もり依頼候補のガス会社が変化します。</footer>
      </blockquote>
    </div>
  </div>

  <button type="submit" class="btn btn-danger mt-4" onclick="return confirm('本当によろしいですか?')">更新する</button>
<?php else: ?>
  <button type="submit" class="btn btn-primary mt-4">更新する</button>
<?php endif; ?>
