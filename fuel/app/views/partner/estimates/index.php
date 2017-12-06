<?= search_form_for [:partner, @q] { |f| ?>
  <div class="form-group">
    <div class="form-inline">
      <?= f.input :status_eq, collection: ::Lpgas::Estimate.as_enum_collection_i18n_for_ransack(:status), required: false, label: "ステータス" ?>
      <?= f.input :contact_prefecture_code_eq, collection: JpPrefecture::Prefecture.all, required: false, label: "都道府県", value_["method" => :code ?>
      <?= f.input :contact_name_eq, required: false, label: "名前が等しい" ?>
      <?= f.input :contact_name_cont, required: false, label: "名前を含む" ?>
      <?= f.input :company_contact_name_cont, required: false, label: "担当者名(含む)" ?>
    </div>
  </div>
  <label>紹介日</label>
  <div class="form-group">
    <div class="form-inline">
      <?= text_field_tag :created_at_gte, params[:created_at_gte], ["class" => 'datepicker form-control left-side' ?> ~
      <?= text_field_tag :created_at_lte, params[:created_at_lte], ["class" => 'datepicker form-control' ?>
    </div>
  </div>
  <? if !smart_phone? ?>
    <label>希望連絡時間</label>
    <div class="form-group">
      <div class="form-inline">
        <select class="form-control form-control-lg" params[:preferred_contact_time_between_cont] name="preferred_contact_time_between">
          <option value="0">いつでも</option>
          <option value="1">9:00~12:00</option>
          <option value="2">12:00~15:00</option>
          <option value="3">15:00~18:00</option>
          <option value="4">18:00~21:00</option>
          <option value="5" selected></option>
        </select>
      </div>
    </div>
  <? } ?>
  <?= f.button :submit ?>
<? } ?>

<div class="form-group">
  <div class="btn-group" role="group" aria-label="...">
    <span class="btn btn-default">検索結果: <?= @estimates.total_count ?>件</span>
    <? if @estimates.total_count < 1000 ?>
      <?= MyView::link_to("現在の検索条件でCSVをダウンロード", url_for(params.merge(format: :csv)), ["class" => 'btn btn-default' ?>
    <? else ?>
      <?= MyView::link_to("現在の検索条件でCSVをダウンロード", 'javascript:void(0)', ["class" => 'btn btn-default', disabled: true ?>
    <? } ?>
  </div>
</div>

<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th> </th>
      <? if !smart_phone? ?>
        <th> 緊急度 </th>
      <? } ?>
      <th>
        問い合わせID
        <?= MyView::link_to("▼", sort: "id" ?>
      </th>
      <th>お名前</th>
      <th>紹介日時</th>
      <? if !smart_phone? ?>
        <th>電話番号</th>
        <th>開設先都道府県</th>
        <th>開設先市区町村</th>
        <th>都道府県(現住所)</th>
        <th>市区町村(現住所)</th>
        <th>物件種別</th>
        <th>ガス機器</th>
      <? } ?>
      <th>ステータス</th>
      <? if !smart_phone? ?>
        <th>希望連絡時間</th>
      <? } ?>
      <th></th>
      <? if !smart_phone? ?>
        <th>工事予定日</th>
      <? } ?>
      <th>
        担当者名
        <?= MyView::link_to("▼", sort: "company_contact_name" ?>
      </th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <? @estimates.each { |e| ?>
      <tr>
        <td>
          <? if e.is_read == 0 ?>
            <span class="label label-danger">未読</span>
          <? else ?>
            <span class="label label-primary">既読</span>
          <? } ?>
        </td>
        <? if !smart_phone? ?>
          <? if e.priority_degree_i18n == "至急" ?>
            <td><span style="color: red;">至急</span></td>
          <? elsif e.priority_degree_i18n == "通常" ?>
            <td>通常</td>
          <? } ?>
        <? } ?>
        <td><?= e.contact_id ?></td>
        <td><?= e.name ?></td>
        <? if e.change_logs.blank? || e.change_logs.detect_latest_verbal_ok.nil? ?>
          <td>-</td>
        <? else ?>
          <td><?= format_datetime! e.change_logs.detect_latest_verbal_ok.created_at ?></td>
        <? } ?>
        <? if !smart_phone? ?>
          <td><?= e.tel ?></td>
          <? if e.new_prefecture_name.present? ?>
            <td><?= e.new_prefecture_name ?></td>
            <td><?= e.new_address ?></td>
            <td> </td>
            <td> </td>
          <? else ?>
            <td> </td>
            <td> </td>
            <td><?= e.prefecture_name ?></td>
            <td><?= e.address ?></td>
          <? } ?>
          <td><?= e.house_kind_name ?></td>
          <td><?= e.using_gas_machines_name ?></td>
        <? } ?>
        <td>
          <span class="status <?= e.status ?>"><?= e.enum_value_i18n(:status) ?></span>
        </td>
        <? if !smart_phone? ?>
         <td><?= e.preferred_contact_time_between_i18n ?></td>
        <? } ?>
        <td>
          <ul>
            <li>
              <? if e.contacted ?>
                <span class="status contracted">連絡済み</span>
              <? else ?>
                <span class="status pending">未連絡</span>
              <? } ?>
            </li>
            <li>
              <? if e.visited ?>
                <span class="status contracted">訪問済み</span>
              <? else ?>
                <span class="status pending">未訪問</span>
              <? } ?>
            </li>
            <li>
              <? if e.power_of_attorney_acquired ?>
                <span class="status contracted">委任状獲得済み</span>
              <? else ?>
                <span class="status pending">委任状未獲得</span>
              <? } ?>
            </li>
          </ul>
        </td>
        <? if !smart_phone? ?>
          <td><?= e.construction_scheduled_date ?></td>
        <? } ?>
        <td><?= e.company_contact_name ?></td>
        <td>
          <ul>
            <li><?= MyView::link_to('詳細', partner_lpgas_estimate_path(e), target: "_blank" ?></li>
            <? if !e.contracted? && !e.cancelled? ?>
              <li><?= lpgas_estimate_cancel_link(:partner, e) ?></li>
            <? } ?>
          </ul>
        </td>
      </tr>
    <? } ?>
  </tbody>
</table>
<?= paginate @estimates ?>
