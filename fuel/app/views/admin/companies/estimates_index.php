<? unless @hide_search_form ?>
  <?= search_form_for [:admin, @q] { |f| ?>
    <div class="form-group">
      <div class="form-inline">
        <?= f.input :contact_name_eq, required: false, label: "名前が等しい" ?>
        <?= f.input :contact_name_cont, required: false, label: "名前を含む" ?>
        <?= f.input :company_id_eq, collection: ::Lpgas::Company.all, required: false, label: "LPガス会社" ?>
        <?= f.input :company_contact_name_cont, required: false, label: "担当者名(含む)" ?>
      </div>
    </div>
    <div class="form-group">
      <div class="form-inline">
        <?= f.input :contact_tel_eq, required: false, label: "電話番号が等しい" ?>
        <?= f.input :contact_email_eq, required: false, label: "メールアドレスが等しい" ?>
        <?= f.input :status_eq, collection: ::Lpgas::Estimate.as_enum_collection_i18n_for_ransack(:status), required: false, label: "ステータスが等しい" ?>
        <div class="form-group">
          <label class="control-label">進行状況</label>
          <?= select_tag :estimate_progress, options_for_select(['', '連絡済み', '訪問済み', '委任状獲得済み', '工事予定', '工事完了'], params[:estimate_progress]), ["class" => 'form-control' ?>
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="form-inline">
        <div class="form-group">
          <label>紹介日</label>
          <?= text_field_tag :created_at_gte, params[:created_at_gte], ["class" => 'datepicker form-control left-side' ?> ~
          <?= text_field_tag :created_at_lte, params[:created_at_lte], ["class" => 'datepicker form-control' ?>
        </div>
      </div>
    </div>
    <label>希望連絡時間</label>
    <div class="form-group">
      <div class="form-inline">
        <? options = [
          ["5", ""],
          ["0", "いつでも"],
          ["1", "9:00~12:00"],
          ["2", "12:00~15:00"],
          ["3", "15:00~18:00"],
          ["4", "18:00~21:00"],
        ] ?>
        <select class="form-control form-control-lg" name="preferred_contact_time_between">
          <? options.each { |o| ?>
            <? selected = params[:preferred_contact_time_between] == o[0] ?>
            <option value="<?= o[0] ?>" <?= "selected" if selected ?>><?= o[1] ?></option>
          <? } ?>
        </select>
      </div>
    </div>
    <?= f.button :submit ?>
  <? } ?>
<? } ?>

<div class="form-group">
  <div class="btn-group" role="group" aria-label="...">
    <span class="btn btn-default">検索結果: <?= @estimates.total_count ?>件</span>
    <? if @estimates.total_count < 1000 ?>
      <?= MyView::link_to("現在の検索条件でCSVをダウンロード", url_for(params.merge(format: :csv)), ["class" => 'btn btn-default' ?>
    <? else ?>
      <?= MyView::link_to("現在の検索条件でCSVをダウンロード", 'javascript:void(0)', ["class" => 'btn btn-default', disabled: true ?>
    <? } ?>
    <?= MyView::link_to("変更履歴をCSVでダウンロード", url_for(params.merge(controller: "admin/lpgas/estimates/change_logs", format: :csv)), ["class" => 'btn btn-default' ?>
  </div>
</div>

<table class="table table-condensed table-striped table-hover">
  <thead>
    <tr>
      <th></th>
      <? if !smart_phone? ?>
        <th> 緊急度 </th>
      <? } ?>
      <th>
        問い合わせID
        <?= MyView::link_to("▼", sort: "id" ?>
      </th>
      <th>会社名</th>
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
        <td><?= e.company.name ?></td>
        <td><?= e.name ?></td>
        <? if e.change_logs.blank? || e.change_logs.detect_latest_verbal_ok.nil? ?>
          <td>-</td>
        <? else ?>
          <td><?= format_datetime! e.change_logs.detect_latest_verbal_ok.try(:created_at) ?></td>
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
          <br>
          <? unless e.status_reason_unknown? ?>
            理由: <?= e.enum_value_i18n(:status_reason) ?>
          <? } ?>
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
            <li>
              <? unless e.construction_scheduled_date.nil? ?>
                <span class="status contracted">工事予定</span>
              <? else ?>
                <span class="status pending">工事未定</span>
              <? } ?>
            </li>
            <li>
              <? unless e.construction_finished_date.nil? ?>
                <span class="status contracted">工事完了</span>
              <? else ?>
                <span class="status pending">工事未完了</span>
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
            <li><?= MyView::link_to('詳細', admin_lpgas_estimate_path(e) ?></li>
            <li><?= lpgas_estimate_ok_tentatively_link(e) if e.sent_estimate_to_user? ?></li>
            <? if !e.contracted? && !e.cancelled? ?>
              <li><?= lpgas_estimate_cancel_link(:admin, e) ?></li>
            <? } ?>
          </ul>
        </td>
      </tr>
    <? } ?>
  </tbody>
</table>

<?= paginate @estimates ?>
