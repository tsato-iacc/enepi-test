<h2>ユーザー情報</h2>

<?= MyView::link_to("現地調査表(pdf)出力", url_for(format: :pdf), ["class" => "btn btn-default", target: "_blank" ?>

<h3>お客様の情報</h3>
<table class="table table-striped table-hover">
  <tr>
    <th>問い合わせID</th>
    <td><?= @estimate.contact_id ?></td>
  </tr>
  <tr>
    <th>見積もりID</th>
    <td><?= @estimate.uuid ?></td>
  </tr>
  <tr>
    <th>お名前</th>
    <td><?= @estimate.name ?></td>
  </tr>
  <tr>
    <th>ふりがな</th>
    <td><?= @estimate.furigana ?></td>
  </tr>
  <tr>
    <th>電話番号</th>
    <td><?= @estimate.tel ?></td>
  </tr>
  <tr>
    <th>Email</th>
    <td><?= @estimate.email ?></td>
  </tr>
</table>

<h3>見積もり情報</h3>
<table class="table table-condensed table-striped table-hover">
  <tr>
    <th>ガス検針月</th>
    <td><?= @estimate.gas_meter_checked_month ?>月</td>
  </tr>
  <tr>
    <th>ガス使用量</th>
    <td><?= @estimate.gas_used_amount ?>m3</td>
  </tr>
  <tr>
    <th>直近の請求額</th>
    <td><?= @estimate.gas_latest_billing_amount ?>円</td>
  </tr>
  <tr>
    <th>契約販売店</th>
    <td><?= @estimate.gas_contracted_shop_name ?></td>
  </tr>
  <tr>
    <th>ガス使用年数</th>
    <td><?= @estimate.gas_used_years ?>年</td>
  </tr>
  <tr>
    <th>ガス機器</th>
    <td><?= @estimate.using_gas_machines_name ?></td>
  </tr>
  <tr>
  </tr>
  <tr>
    <th>ご相談内容・ご要望</th>
    <td><?= newline_to_br @estimate.body ?></td>
  </tr>
  <tr>
    <th>契約選択</th>
    <td><?= @estimate.estimate_kind_name ?></td>
  </tr>
  <tr>
    <th>郵便番号</th>
    <td><?= @estimate.zip_code ?></td>
  </tr>
  <tr>
    <th>都道府県</th>
    <td><?= @estimate.prefecture_name ?></td>
  </tr>
  <tr>
    <th>住所</th>
    <td><?= @estimate.address ?></td>
  </tr>
  <tr>
    <th>住所(番地以降)</th>
    <td><?= @estimate.address2 ?></td>
  </tr>
  <? if @estimate.new_contract? || @estimate.apartment_owner? ?>
    <tr>
      <th>開設先の郵便番号</th>
      <td><?= @estimate.new_zip_code ?></td>
    </tr>
    <tr>
      <th>開設先の都道府県</th>
      <td><?= @estimate.new_prefecture_name ?></td>
    </tr>
    <tr>
      <th>開設先の住所</th>
      <td><?= @estimate.new_address ?></td>
    </tr>
    <tr>
      <th>開設先の住所(番地以降)</th>
      <td><?= @estimate.new_address2 ?></td>
    </tr>
  <? } ?>
  <? if @estimate.new_contract? ?>
    <tr>
      <th>引越し予定日</th>
      <td><?= @estimate.moving_scheduled_date ?></td>
    </tr>
  <? } ?>
  <tr>
    <th>物件種別</th>
    <td><?= @estimate.house_kind_name ?></td>
  </tr>
  <tr>
    <th>物件所有種別</th>
    <td><?= @estimate.ownership_kind_name ?></td>
  </tr>
  <tr>
    <th>築年数</th>
    <td><?= @estimate.house_age ?>年</td>
  </tr>
  <? if @estimate.apartment_owner? ?>
    <tr>
      <th>部屋数</th>
      <td><?= @estimate.number_of_rooms ?></td>
    </tr>
    <tr>
      <th>入居済み部屋数</th>
    <td><?= @estimate.number_of_active_rooms ?></td>
    </tr>
    <tr>
      <th>管理会社名</th>
      <td><?= @estimate.estate_management_company_name ?></td>
    </tr>
  <? } ?>
</table>
<h3>ご希望条件</h3>
<table class="table table-condensed table-striped table-hover">
  <tr>
    <th>連絡希望時間</th>
    <td><?= @estimate.preferred_contact_time_between_i18n ?></td>
  </tr>
  <tr>
    <th>緊急度</th>
    <td><?= @estimate.priority_degree_i18n ?></td>
  </tr>
  <tr>
    <th>電気料金セット希望</th>
    <td><?= @estimate.desired_option_i18n ?></td>
  </tr>
</table>

<h2 id="timeline">進行状況</h2>

<table class="table table-condensed table-striped table-hover">
  <thead>
    <tr>
      <th>担当者</th>
      <th>状況</th>
      <th>対応日時</th>
      <th>メモ</th>
      <th>その他変更</th>
    </tr>
  </thead>
  <tbody>
    <? current_status_en = "" ?>
    <? current_status = "" ?>
    <? current_company_contact_name = "" ?>
    <? @timeline.each.with_index { |feed, i| ?>
      <tr>
        <td>
          <? current_company_contact_name = feed.company_contact_name if feed.company_contact_name ?>
          <?= current_company_contact_name ?>
        </td>
        <td>
          <? if feed.status ?>
            <? current_status_en = feed.status ?>
            <? current_status = feed.status_ja ?>
          <? } ?>
          <span class="status <?= current_status_en ?>"><?= current_status ?></span>
        </td>
        <td><?= format_datetime feed.created_at ?></td>
        <td><?= feed.comment ?></td>
        <td><?= feed.other_changes ?></td>
      </tr>
    <? } ?>
  </tbody>
</table>

<h3>更新する</h3>

<? if @estimate.verbal_ok? ?>
  <p>
    <?= lpgas_estimate_cancel_link(:partner, @estimate) ?>
  </p>
<? } ?>

<? if @estimate.verbal_ok? || @estimate.contracted? ?>
  <?= form_for [:partner, @estimate], url: partner_lpgas_estimate_update_misc_path(@estimate) { |f| ?>
    <table class="table table-striped table-hover">
      <tr>
        <th>STEP1. 連絡する</th>
        <td>
          <? if !f.object.contacted ?>
            <div class="form-group">
              <span>状況</span>
              <label>
                <?= f.radio_button :contacted, false ?>
                変更しない
              </label>
              <label>
                <?= f.radio_button :contacted, true ?>
                完了にする
              </label>
            </div>
            <div class="form-group">
              <?= f.text_field :company_contact_name, ["class" => 'form-control', placeholder: '担当者', value: f.object.previous_company_contact_name_by_partner ?>
            </div>
            <div class="form-group">
              <textarea name="comment" class="form-control" rows="4" placeholder="メモ"></textarea>
            </div>
            <?= f.submit ["class" => 'btn btn-primary btn-xs' ?>
          <? elsif f.object.contacted ?>
            <span class="true-label">完了済み</span>
          <? } ?>
        </td>
      </tr>
      <tr>
        <th>STEP2. 訪問予定日を決める</th>
        <td>
          <? if f.object.contacted && f.object.visit_scheduled_date.blank? ?>
            <div class="form-group">
              <?= f.text_field :visit_scheduled_date, ["class" => 'datepicker form-control', placeholder: '訪問予定日' ?>
            </div>
            <div class="form-group">
              <?= f.text_field :company_contact_name, ["class" => 'form-control', placeholder: '担当者', value: f.object.previous_company_contact_name_by_partner ?>
            </div>
            <div class="form-group">
              <textarea name="comment" class="form-control" rows="4" placeholder="メモ"></textarea>
            </div>
            <?= f.submit ["class" => 'btn btn-primary btn-xs' ?>
          <? elsif f.object.visit_scheduled_date.present? ?>
            <?= f.object.visit_scheduled_date ?>
          <? } ?>
        </td>
      </tr>
      <tr>
        <th>STEP3. 訪問する</th>
        <td>
          <? if f.object.contacted && !f.object.visit_scheduled_date.blank? && !f.object.visited ?>
            <div class="form-group">
              <span>状況</span>
              <label>
                <?= f.radio_button :visited, false ?>
                変更しない
              </label>
              <label>
                <?= f.radio_button :visited, true ?>
                完了にする
              </label>
            </div>
            <div class="form-group">
              <?= f.text_field :company_contact_name, ["class" => 'form-control', placeholder: '担当者', value: f.object.previous_company_contact_name_by_partner ?>
            </div>
            <div class="form-group">
              <textarea name="comment" class="form-control" rows="4" placeholder="メモ"></textarea>
            </div>
            <?= f.submit ["class" => 'btn btn-primary btn-xs' ?>
          <? elsif f.object.visited ?>
            <span class="true-label">完了済み</span>
          <? } ?>
        </td>
      </tr>
      <tr>
        <th>STEP4. 委任状を獲得する</th>
        <td>
          <? if f.object.visited && !f.object.power_of_attorney_acquired ?>
            <div class="form-group">
              <span>状況</span>
              <label>
                <?= f.radio_button :power_of_attorney_acquired, false ?>
                変更しない
              </label>
              <label>
                <?= f.radio_button :power_of_attorney_acquired, true ?>
                完了にする
              </label>
            </div>
            <div class="form-group">
              <?= f.text_field :company_contact_name, ["class" => 'form-control', placeholder: '担当者', value: f.object.previous_company_contact_name_by_partner ?>
            </div>
            <div class="form-group">
              <textarea name="comment" class="form-control" rows="4" placeholder="メモ"></textarea>
            </div>
            <?= f.submit ["class" => 'btn btn-primary btn-xs' ?>
          <? elsif f.object.power_of_attorney_acquired ?>
            <span class="true-label">完了済み</span>
          <? } ?>
        </td>
      </tr>

      <tr>
        <th>STEP5. 工事予定日を決める</th>
        <td>
          <? if f.object.power_of_attorney_acquired && f.object.construction_scheduled_date.blank? ?>
            <div class="form-group">
              <?= f.text_field :construction_scheduled_date, ["class" => 'datepicker form-control', placeholder: "工事予定日" ?>
            </div>
            <div class="form-group">
              <?= f.text_field :company_contact_name, ["class" => 'form-control', placeholder: '担当者', value: f.object.previous_company_contact_name_by_partner ?>
            </div>
            <div class="form-group">
              <textarea name="comment" class="form-control" rows="4" placeholder="メモ"></textarea>
            </div>
            <?= f.submit ["class" => 'btn btn-primary btn-xs' ?>
          <? elsif f.object.construction_scheduled_date.present? ?>
            <?= format_date f.object.construction_scheduled_date ?>
          <? } ?>
        </td>
      </tr>

      <tr>
        <th>STEP6. 工事完了</th>
        <td>
          <? if f.object.construction_scheduled_date.present? && f.object.construction_finished_date.blank? ?>
            <div class="form-group">
              <?= f.text_field :construction_finished_date, ["class" => 'datepicker form-control', placeholder: "工事完了日" ?>
            </div>
            <div class="form-group">
              <?= f.text_field :company_contact_name, ["class" => 'form-control', placeholder: '担当者', value: f.object.previous_company_contact_name_by_partner ?>
            </div>
            <div class="form-group">
              <textarea name="comment" class="form-control" rows="4" placeholder="メモ"></textarea>
            </div>
            <?= f.submit ["class" => 'btn btn-primary btn-xs' ?>
          <? elsif f.object.construction_finished_date.present? ?>
            <?= format_date f.object.construction_finished_date ?>
          <? } ?>
        </td>
      </tr>
    </table>
  <? } ?>
<? } ?>
