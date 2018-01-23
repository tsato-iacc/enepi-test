<?php
use JpPrefecture\JpPrefecture;
?>

<table class="table table-sm table-hover mt-4 th-left small-row">
  <tr>
    <th>ID</th>
    <td><?= $estimate->uuid; ?></td>
  </tr>
  <tr>
    <th>問い合わせID</th>
    <td><a href="<?= \Uri::create('admin/contact/'.$estimate->contact->id); ?>"></a></td>
  </tr>
  <tr>
    <th>有効期限</th>
    <td>
      <span class="<?= $estimate->isExpired() ? 'alert-text' : '' ?>"><?= $estimate->expired_at ? \Helper\TimezoneConverter::convertFromString($estimate->expired_at, 'admin_table') : ''; ?></span>
    </td>
  </tr>
  <tr>
    <th>お名前</th>
    <td><?= $estimate->contact->name; ?></td>
  </tr>
  <tr>
    <th>紹介日時</th>
    <td><?= \Helper\TimezoneConverter::convertFromString($estimate->created_at, 'admin_table'); ?></td>
  </tr>
  <tr>
    <th>電話番号</th>
    <td><?= $estimate->contact->tel; ?></td>
  </tr>
  <tr>
    <th>都道府県</th>
    <td><?= JpPrefecture::findByCode($estimate->contact->getPrefectureCode())->nameKanji; ?></td>
  </tr>
  <tr>
    <th>住所</th>
    <td><?= $estimate->contact->getAddress(); ?></td>
  </tr>
  <tr>
    <th>住所(番地以降)</th>
    <td><?= $estimate->contact->getAddress2(); ?></td>
  </tr>
  <?php if ($estimate->contact->estimate_kind == \Config::get('models.contact.house_kind.new_contract') || $estimate->contact->apartment_owner): ?>
    <tr>
      <th>開設先の郵便番号</th>
      <td><?= $estimate->contact->new_zip_code ?></td>
    </tr>
    <tr>
      <th>開設先の都道府県</th>
      <td><?= JpPrefecture::findByCode($estimate->contact->new_prefecture_code)->nameKanji; ?></td>
    </tr>
    <tr>
      <th>開設先の住所</th>
      <td><?= $estimate->contact->new_address; ?></td>
    </tr>
    <tr>
      <th>開設先の住所(番地以降)</th>
      <td><?= $estimate->contact->new_address2; ?></td>
    </tr>
  <?php endif; ?>
  <?php if ($estimate->contact->estimate_kind == \Config::get('models.contact.house_kind.new_contract')): ?>
    <tr>
      <th>引越し予定日</th>
      <td><?= $estimate->contact->moving_scheduled_date; ?></td>
    </tr>
  <?php endif; ?>
  <tr>
    <th>紹介した会社</th>
    <td><a href="<?= \Uri::create('admin/companies/'.$estimate->company->id); ?>"><?= $estimate->company->getCompanyName(); ?></a></td>
  </tr>
  <tr>
    <th>ステータス</th>
    <td>
      <div class="card card-outline-<?= $estimate->getStatusColor(); ?> text-center max-width">
        <div class="card-block p-0">
          <blockquote class="card-blockquote"><?= __('admin.estimate.status.'.\Config::get('views.estimate.status.'.$estimate->status)) ?></blockquote>
        </div>
      </div>
    </td>
  </tr>
  <tr>
    <th>ステータス更新日時</th>
    <td><?= \Helper\TimezoneConverter::convertFromString($estimate->status_updated_at, 'admin_table'); ?></td>
  </tr>
  <tr>
    <th>ステータス更新理由</th>
    <td><?= \Helper\CancelReasons::getNameByValue($estimate->status_reason) ?></td>
  </tr>
  <tr>
    <th>成約手数料</th>
    <td><?= $estimate->contracted_commission? number_format($estimate->contracted_commission).'円' : ''; ?></td>
  </tr>
  <tr>
    <th>従量単価 (現在の推定)</th>
    <td><?= $estimate->contact->unitPrice() ? number_format($estimate->contact->unitPrice()).'円' : ''; ?></td>
  </tr>
  <tr>
    <th>基本料金</th>
    <td><?= $estimate->basic_price? number_format($estimate->basic_price).'円' : ''; ?></td>
  </tr>
  <tr>
    <th>燃料調整費</th>
    <td><?= $estimate->basic_price? number_format($estimate->fuel_adjustment_cost).'円' : ''; ?>/m3</td>
  </tr>
  <tr>
    <th>従量単価</th>
    <td>
      <?php if (count($estimate->prices) == 1): ?>
        <?= number_format(array_shift($estimate->prices)->unit_price); ?>円
      <?php else: ?>
        <?php foreach ($estimate->prices as $price): ?>
          <div><b><?= $price->getRangeLabel() ?>:</b> <?= number_format($price->unit_price); ?>円</div>
        <?php endforeach; ?>
      <?php endif; ?>
    </td>
  </tr>
  <tr>
    <th>備考</th>
    <td><?= $estimate->notes; ?></td>
  </tr>
  <tr>
    <th>機器・配管セットプラン</th>
    <td><?= $estimate->set_plan; ?></td>
  </tr>
  <tr>
    <th>その他セットプラン</th>
    <td><?= $estimate->other_set_plan; ?></td>
  </tr>
</table>
<div class="d-flex justify-content-around mb-4">
  <a class="btn btn-secondary" href="<?= \Uri::create("lpgas/contacts/{$estimate->contact->id}?".http_build_query(['pin' => $estimate->contact->pin, 'token' => $estimate->contact->token])); ?>" role="button">提示画面</a>
  <?php if ($estimate->status == \Config::get('models.estimate.status.sent_estimate_to_user')): ?>
    <div><a href="#" class="btn-introduce btn btn-success" role="button" data-estimate-id="<?= $estimate->id; ?>" data-company-name="<?= $estimate->company->getCompanyName(); ?>" data-contact-pref="<?= JpPrefecture::findByCode($estimate->contact->getPrefectureCode())->nameKanji; ?>" data-contact-tel="<?= $estimate->contact->tel; ?>">送客</a></div>
  <?php endif; ?>
  <?php if ($estimate->status != \Config::get('models.estimate.status.contracted') && $estimate->status != \Config::get('models.estimate.status.cancelled')): ?>
    <div><a href="#" class="btn-cancel btn btn-danger" role="button" data-estimate-id="<?= $estimate->id; ?>" data-contact-name="<?= $estimate->contact->name; ?>" data-contact-pref="<?= JpPrefecture::findByCode($estimate->contact->getPrefectureCode())->nameKanji; ?>" data-contact-tel="<?= $estimate->contact->tel; ?>">キャンセル</a></div>
  <?php endif; ?>
</div>

<div>
  <%= link_to '提示画面', lpgas_contact_path(@estimate.contact_id, token: @estimate.contact_token, pin: @estimate.contact_pin), target: '_blank' %>
      <%= lpgas_estimate_send_to_user_link(@estimate) if @estimate.sent_estimate_to_iacc? %>
      <%= lpgas_estimate_ok_tentatively_link(@estimate) if @estimate.sent_estimate_to_user? %>
      <% if !@estimate.contracted? && !@estimate.cancelled? %>
        <%= lpgas_estimate_cancel_link(:admin, @estimate) %>
      <% end %>
</div>

<h2>見積り送信</h2>
<% unless @estimate.contact_from_kakaku? %>
  <% if @estimate.pending? %>
    <p>
      料金を入力せずに送信する
    </p>
    <%= lpgas_estimate_send_to_user_link(@estimate) %>
  <% end %>
  <hr>
<% end %>
<%= render "shared/estimate_price_form", ns: :admin %>

<h2>ステータス更新履歴</h2>
<table class="table table-condensed table-striped table-hover">
  <thead>
    <tr>
      <th>日時</th>
      <th>変更した人</th>
      <th>ステータス</th>
    </tr>
  </thead>
  <tbody>
    <% @estimate.change_logs.select { |l| l.diff['status'] }.each.with_index do |l, idx| %>
      <tr>
        <td><%= format_datetime l.created_at %></td>
        <td>
          <% if l.admin_user %>
            <%= l.admin_user.email %>
          <% elsif l.partner_company %>
            <%= link_to l.partner_company.company_name, admin_partner_company_path(l.partner_company) %>
          <% end %>
        </td>
        <td>
          <span class="status <%= l.diff['status']['new'] %>">
            <%= I18n.t("enums.#{Lpgas::Estimate.to_s.underscore}.status.#{l.diff['status']['new']}") %>
          </span>
        </td>
        <td>
          <% if @estimate.status != l.diff['status']['new'] %>
            <%= link_to "「#{I18n.t("enums.#{Lpgas::Estimate.to_s.underscore}.status.#{l.diff['status']['new']}")}」に戻す", admin_lpgas_estimate_undo_status_path(@estimate, l.id), data: {confirm: 1, method: 'post'} %>
          <% end %>
        </td>
      </tr>
    <% end %>
  </tbody>
</table>

<h2 id="timeline">進行状況</h2>

<%= form_for [:admin, @estimate], url: admin_lpgas_estimate_update_misc_path(@estimate) do |f| %>
  <table class="table table-striped table-hover">
    <tr>
      <th>STEP1. 連絡する</th>
      <td>
        <% if !f.object.contacted %>
          <div class="form-group">
            <span>状況</span>
            <label>
              <%= f.radio_button :contacted, false %>
              変更しない
            </label>
            <label>
              <%= f.radio_button :contacted, true %>
              完了にする
            </label>
          </div>
          <div class="form-group">
            <%= f.text_field :company_contact_name, class: 'form-control', placeholder: '担当者', value: f.object.previous_company_contact_name_by_admin %>
          </div>
          <div class="form-group">
            <textarea name="comment" class="form-control" rows="4" placeholder="メモ"></textarea>
          </div>
          <%= f.submit class: 'btn btn-primary btn-xs' %>
        <% elsif f.object.contacted %>
          <span class="true-label">完了済み</span>
        <% end %>
      </td>
    </tr>
    <tr>
      <th>STEP2. 訪問予定日を決める</th>
      <td>
        <% if f.object.contacted && f.object.visit_scheduled_date.blank? %>
          <div class="form-group">
            <%= f.text_field :visit_scheduled_date, class: 'datepicker form-control', placeholder: '訪問予定日' %>
          </div>
          <div class="form-group">
            <%= f.text_field :company_contact_name, class: 'form-control', placeholder: '担当者', value: f.object.previous_company_contact_name_by_admin %>
          </div>
          <div class="form-group">
            <textarea name="comment" class="form-control" rows="4" placeholder="メモ"></textarea>
          </div>
          <%= f.submit class: 'btn btn-primary btn-xs' %>
        <% elsif f.object.visit_scheduled_date.present? %>
          <%= f.object.visit_scheduled_date %>
        <% end %>
      </td>
    </tr>
    <tr>
      <th>STEP3. 訪問する</th>
      <td>
        <% if f.object.contacted && !f.object.visit_scheduled_date.blank? && !f.object.visited %>
          <div class="form-group">
            <span>状況</span>
            <label>
              <%= f.radio_button :visited, false %>
              変更しない
            </label>
            <label>
              <%= f.radio_button :visited, true %>
              完了にする
            </label>
          </div>
          <div class="form-group">
            <%= f.text_field :company_contact_name, class: 'form-control', placeholder: '担当者', value: f.object.previous_company_contact_name_by_admin %>
          </div>
          <div class="form-group">
            <textarea name="comment" class="form-control" rows="4" placeholder="メモ"></textarea>
          </div>
          <%= f.submit class: 'btn btn-primary btn-xs' %>
        <% elsif f.object.visited %>
          <span class="true-label">完了済み</span>
        <% end %>
      </td>
    </tr>
    <tr>
      <th>STEP4. 委任状を獲得する</th>
      <td>
        <% if f.object.visited && !f.object.power_of_attorney_acquired %>
          <div class="form-group">
            <span>状況</span>
            <label>
              <%= f.radio_button :power_of_attorney_acquired, false %>
              変更しない
            </label>
            <label>
              <%= f.radio_button :power_of_attorney_acquired, true %>
              完了にする
            </label>
          </div>
          <div class="form-group">
            <%= f.text_field :company_contact_name, class: 'form-control', placeholder: '担当者', value: f.object.previous_company_contact_name_by_admin %>
          </div>
          <div class="form-group">
            <textarea name="comment" class="form-control" rows="4" placeholder="メモ"></textarea>
          </div>
          <%= f.submit class: 'btn btn-primary btn-xs' %>
        <% elsif f.object.power_of_attorney_acquired %>
          <span class="true-label">完了済み</span>
        <% end %>
      </td>
    </tr>

    <tr>
      <th>STEP5. 工事予定日を決める</th>
      <td>
        <% if f.object.power_of_attorney_acquired && f.object.construction_scheduled_date.blank? %>
          <div class="form-group">
            <%= f.text_field :construction_scheduled_date, class: 'datepicker form-control', placeholder: "工事予定日" %>
          </div>
          <div class="form-group">
            <%= f.text_field :company_contact_name, class: 'form-control', placeholder: '担当者', value: f.object.previous_company_contact_name_by_admin %>
          </div>
          <div class="form-group">
            <textarea name="comment" class="form-control" rows="4" placeholder="メモ"></textarea>
          </div>
          <%= f.submit class: 'btn btn-primary btn-xs' %>
        <% elsif f.object.construction_scheduled_date.present? %>
          <%= format_date f.object.construction_scheduled_date %>
        <% end %>
      </td>
    </tr>

    <tr>
      <th>STEP6. 工事完了</th>
      <td>
        <% if f.object.construction_finished_date.present? %>
          <%= format_date f.object.construction_finished_date %>
        <% end %>
      </td>
    </tr>
  </table>
<% end %>

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
    <% current_status_en = "" %>
    <% current_status = "" %>
    <% current_contact_name = "" %>
    <% @timeline.each.with_index do |feed, i| %>
      <tr>
        <td>
          <% current_contact_name = feed.company_contact_name if feed.company_contact_name %>
          <%= current_contact_name %>
        </td>
        <td>
          <% if feed.status %>
            <% current_status_en = feed.status %>
            <% current_status = feed.status_ja %>
          <% end %>
          <span class="status <%= current_status_en %>"><%= current_status %></span>
        </td>
        <td><%= format_datetime feed.created_at %></td>
        <td><%= feed.comment %></td>
        <td><%= feed.other_changes %></td>
      </tr>
    <% end %>
  </tbody>
</table>

<%= link_to '全ての項目の更新履歴を見る', admin_lpgas_estimate_change_logs_path(@estimate) %>

<!-- MODAL CANCEL START -->
<?= render('admin/_modal_cancel'); ?>
<!-- MODAL CANCEL END -->

<!-- MODAL INTRODUCE START -->
<?= render('admin/_modal_introduce'); ?>
<!-- MODAL INTRODUCE END -->
