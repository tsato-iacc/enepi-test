<style>
  textarea:invalid {
    border: 1px solid #db524b;
  }
</style>

<? if @contact.original_contact ?>
  <p class="alert-paragraph">
    <?= MyView::link_to("問い合わせID=#{@contact.original_contact.id} (#{@contact.enum_value_i18n(:status)})", admin_lpgas_contact_path(@contact.original_contact) ?> の再入力CVです。
  </p>
<? } ?>

<? if @contact.deleted_at ?>
  <p class="alert-paragraph">
    <?= format_date @contact.deleted_at ?> に個人情報削除済み
  </p>
<? } ?>

<? if @contact.lat.zero? && @contact.lng.zero? ?>
  <p class="alert-paragraph">
    位置情報が正しく取得できていません。
  </p>
<? } ?>
<? if smart_phone? ?>
  <table class="table table-condensed table-striped table-hover">
    <tr>
      <th>ID</th>
      <td><?= @contact.id ?></td>
    </tr>
    <tr>
      <th>価格</th>
      <td><?= boolean_label @contact.from_kakaku? ?></td>
    </tr>
    <tr>
      <th>集合住宅オーナー</th>
      <td><?= boolean_label @contact.apartment_owner? ?></td>
    </tr>
    <tr>
      <th>自動見積もり</th>
      <td><? if @contact.sent_auto_estimate_req ?>◯<? else ?>×<? } ?></td>
    </tr>
    <tr>
      <th>提示画面閲覧済み</th>
      <td><?= @contact.enum_value_i18n(:is_seen) ?></td>
    </tr>
    <tr>
      <th>契約選択</th>
      <td><?= @contact.estimate_kind ? @contact.enum_value_i18n(:estimate_kind).gsub(/の見積もり$/, "") : "" ?></td>
    </tr>
    <tr>
      <th>端末</th>
      <td><?= @contact.enum_value_i18n(:terminal) ?></td>
    </tr>
    <tr>
      <th>経由元</th>
      <td><?= @contact.pr_tracking_parameter.try!(:display_name) || "無し" ?></td>
    </tr>
    <tr>
      <th>推定基本料金</th>
      <td><?= number_to_currency @contact.basic_price ?></td>
    </tr>
    <tr>
      <th>推定単価</th>
      <td><?= number_to_currency @contact.unit_price ?></td>
    </tr>
    <tr>
      <th>CV時に紹介前になった理由</th>
      <td><?= @contact.reason_not_auto_sendable ?></td>
    </tr>
  </table>
<? else ?>
  <table class="table" style="margin-bottom: 0;">
    <tr>
      <td style="padding: 0;">
        <table class="table table-condensed table-striped table-hover">
          <tr>
            <th>ID</th>
            <td><?= @contact.id ?></td>
          </tr>
          <tr>
            <th>価格</th>
            <td><?= boolean_label @contact.from_kakaku? ?></td>
          </tr>
          <tr>
            <th>集合住宅オーナー</th>
            <td><?= boolean_label @contact.apartment_owner? ?></td>
          </tr>
          <tr>
            <th>自動見積もり</th>
            <td><? if @contact.sent_auto_estimate_req ?>◯<? else ?>×<? } ?></td>
          </tr>
          <tr>
            <th>提示画面閲覧済み</th>
            <td><?= @contact.enum_value_i18n(:is_seen) ?></td>
          </tr>
          <tr>
            <th>ステータス</th>
            <td><?= @contact.enum_value_i18n(:status) ?></td>
          </tr>
          <tr>
            <th>小ステータス</th>
            <td><?= @contact.enum_value_i18n(:user_status) ?></td>
          </tr>
        </table>
      </td>
      <td style="padding: 0;">
        <table class="table table-condensed table-striped table-hover">
          <tr>
            <th>端末</th>
            <td><?= @contact.enum_value_i18n(:terminal) ?></td>
          </tr>
          <tr>
            <th>経由元</th>
            <td><?= @contact.pr_tracking_parameter.try!(:display_name) || "無し" ?></td>
          </tr>
          <tr>
            <th>推定基本料金</th>
            <td><?= number_to_currency @contact.basic_price ?></td>
          </tr>
          <tr>
            <th>推定単価</th>
            <td><?= number_to_currency @contact.unit_price ?></td>
          </tr>
          <tr>
            <th>契約選択</th>
            <td><?= @contact.estimate_kind ? @contact.enum_value_i18n(:estimate_kind).gsub(/の見積もり$/, "") : "" ?></td>
          </tr>
          <tr>
            <th>キャンセル理由</th>
            <td><?= @contact.enum_value_i18n(:status_reason) ?></td>
          </tr>
          <tr>
            <th>見積り進行状況</th>
            <td><?= @contact.estimate_progress ?></td>
          </tr>
        </table>
      </td>
    </tr>
    <table style="margin-bottom: 20px;">
      <tr>
        <th>CV時に紹介前になった理由</th>
        <td><?= @contact.reason_not_auto_sendable ?></td>
      </tr>
    </table>
  </table>
<? } ?>

<? disabled = @contact.deleted_at ?>

<?= simple_form_for [:admin, @contact] { |f| ?>
  <h3>お客様情報</h3>

  <div class="form-group">
    <div class="form-inline">
      <?= f.input :name, input_html: {disabled: disabled} ?>
      <?= f.input :furigana, input_html: {disabled: disabled} ?>
      <?= f.input :tel, input_html: {disabled: disabled} ?>
      <?= f.input :email, input_html: {disabled: disabled} ?>
    </div>
  </div>

  <div class="form-group">
    <div class="form-inline">
      <?= f.input :zip_code, input_html: {disabled: disabled} ?>
      <?= f.input :prefecture_code, collection: JpPrefecture::Prefecture.all, value_["method" => :code ?>
      <?= f.input :address, input_html: {disabled: disabled} ?>
      <?= f.input :address2, input_html: {disabled: disabled} ?>
    </div>
  </div>

  <h3>開設先の情報</h3>

  <div class="form-group">
    <div class="form-inline">
      <?= f.input :house_kind ?>
      <?= f.input :ownership_kind ?>
      <?= f.input :house_age, as: :unit, input_html: {unit: "年"} ?>
    </div>
  </div>

  <div class="form-group">
    <div class="form-inline">
      <? if @contact.new_contract? || @contact.apartment_owner? ?>
        <?= f.input :new_zip_code, input_html: {disabled: disabled} ?>
        <?= f.input :new_prefecture_code, collection: JpPrefecture::Prefecture.all, value_["method" => :code ?>
        <?= f.input :new_address, input_html: {disabled: disabled} ?>
        <?= f.input :new_address2, input_html: {disabled: disabled} ?>
        <?= f.input :moving_scheduled_date, as: :string, input_html: {["class" => 'datepicker'} ?>
      <? else ?>
        <p class="success-paragraph">開設先と現住所は同じ</p>
      <? } ?>
    </div>
  </div>

  <? if @contact.apartment_owner ?>
    <?= f.input :number_of_rooms, as: :unit, input_html: {unit: "部屋"} ?>
    <?= f.input :number_of_active_rooms, as: :unit, input_html: {unit: "部屋"} ?>
    <?= f.input :estate_management_company_name ?>
  <? } ?>

  <h3>現在の契約</h3>

  <div class="form-group">
    <div class="form-inline">
      <?= f.input :gas_contracted_shop_name ?>
      <?= f.input :gas_used_years, label: '契約年数', as: :unit, input_html: {unit: "年"} ?>
    </div>
  </div>
  <div class="form-group">
    <div class="form-inline">
      <?= f.input :gas_meter_checked_month, as: :unit, input_html: {unit: "月"} ?>
      <?= f.input :gas_used_amount, as: :unit, input_html: {unit: :m3, field_type: 'text'} ?>
      <?= f.input :gas_latest_billing_amount, as: :currency ?>
    </div>
  </div>

  <h3>ご希望条件</h3>

  <div class="form-group">
    <div class="form-inline">
      <?= f.input :preferred_contact_time_between ?>
      <?= f.input :priority_degree ?>
      <?= f.input :desired_option ?>
    </div>
  </div>

  <h3>使用中のガス機器</h3>
  <div class="form-group">
    <div class="form-inline">
      <?= f.input :using_cooking_stove ?>
      <?= f.input :using_bath_heater_with_gas_hot_water_supply ?>
      <?= f.input :using_other_gas_machine ?>
    </div>
  </div>

  <?= f.input :body ?>
  <?= f.input :admin_memo, as: :text ?>

  <div class="form-group">
    <div class="form-inline">
      <div class="form-group">
        <label class="enum control-label">ステータス</label>
        <div class="form-control"><?= @contact.enum_value_i18n(:status) ?></div>
      </div>
      <?= f.input :user_status, required: true, prompt: false, label: "小ステータス" ?>
    </div>
  </div>

  <? if !@contact.pending? && !@contact.cancelled_before_estimate_req? && !@contact.cancelled? ?>
    <p class="alert-paragraph">
      ステータスが「<?= @contact.enum_value_i18n(:status) ?>」の見積もりです。情報の編集はガス会社から見える情報にも影響するので注意してください。<br>
      また、住所を変更した際には見積もり依頼候補のガス会社が変化します。
    </p>
    <?= f.button :submit, ["class" => 'btn-danger', data: {confirm: 1} ?>
  <? else ?>
    <?= f.button :submit ?>
  <? } ?>
<? } ?>

<h2>対応履歴</h2>

<?= simple_form_for :calling_history, url: admin_lpgas_contact_calling_histories_path(@contact), ["method" => 'post', html: {["class" => 'js-calling-history-add'} { |f| ?>
  <div class="form-group">
    <div class="form-inline">
      <div class="form-group">
        <label class="control-label">日時</label>
        <div class="form-control"><?= format_datetime Time.zone.now ?></div>
      </div>
      <div class="form-group">
        <label class="control-label">架電した人</label>
        <div class="form-control"><?= login_session.current.email ?></div>
      </div>
      <?= f.input :calling_method, collection: ::Lpgas::CallingHistory.as_enum_collection_i18n_for_ransack(:calling_method), required: true, label: "連絡手段", selected: :tel ?>
      <?= f.input :note, as: :text, required: true, label: '備考(理由など)', input_html: {rows: 1, cols: 30} ?>
      <div class="form-group">
        <label class="control-label">-</label>
        <?= f.button :submit, '架電履歴に追加する', {["class" => 'btn btn-primary'} ?>
      </div>
    </div>
  </div>
<? } ?>

<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th>日時</th>
      <th>架電した人</th>
      <th>連絡方法</th>
      <th>備考</th>
    </tr>
  </thead>
  <tbody class="js-calling-history-list" data-contact-id="<?= @contact.id.to_i ?>">
    <tr><td>読み込み中</td></tr>
  </tbody>
</table>

<div class="form-group">
  <button class="js-calling-history-show-full-list btn btn-primary btn-xs">架電履歴を全て表示する</button>
</div>

<div class="btn-group" role="group">
  <?= MyView::link_to(new_admin_lpgas_contact_estimate_path(@contact), id:"check-value", ["class" => 'btn btn-default' { ?>
    <i class="fa fa-paper-plane"></i>
    ガス会社に見積もり依頼を送る
  <? } ?>
  <?= MyView::link_to(admin_lpgas_contact_estimates_path(@contact), ["class" => 'btn btn-default' { ?>
    <i class="fa fa-list"></i>
    見積もり依頼一覧
  <? } ?>
  <?= MyView::link_to('提示画面を見る', lpgas_contact_path(@contact, token: @contact.token, pin: @contact.pin), target: "_blank", ["class" => 'btn btn-default' ?>
  <a class="btn btn-default" href="https://www.google.co.jp/maps/search/<?= @contact.lat ?>,<?= @contact.lng ?>" target="_blank"><i class="fa fa-map-marker"></i>地図</a>
</div>

<? unless @contact.deleted_at ?>
  <div style="margin-top: 2em">
    <?= MyView::link_to(admin_lpgas_contact_path(@contact), data: {confirm: {text: 'この操作は取り消しができません。<br>また、見積り依頼は全てキャンセルされます。', title: '削除対象のユーザーの名前を正しく入力してください', confirmField: "削除対象者氏名", confirmValue: @contact.name}, ["method" => 'delete'}, ["class" => 'btn btn-danger' { ?>
      <i class="fa fa-trash"></i>
      個人情報削除
    <? } ?>
    <?= lpgas_contact_cancel_link(@contact) ?>
  </div>
<? } ?>
<script type="text/javascript">
  $("#check-value").click(function(e){
    if ($('#lpgas_contact_gas_meter_checked_month').val() == "" || $('#lpgas_contact_gas_used_amount').val() == "" || $('#lpgas_contact_gas_latest_billing_amount').val() == ""){
      e.preventDefault();

      alert("ガス検針月、ガス使用量、直近の請求額を入力してください。")
    }
  });
</script>
