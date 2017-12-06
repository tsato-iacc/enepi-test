<h2>見積もり依頼を送る</h2>

<% if @contact.contact_geocode.lat.zero? && @contact.contact_geocode.lng.zero? %>
  <p class="alert-paragraph">
    緯度・経度が正しく取得できていません。
  </p>
<% end %>

<h3>ユーザー情報</h3>
<table class="table table-condensed table-striped table-hover">
  <thead>
    <tr>
      <th>問い合わせID</th>
      <th>ユーザー名</th>
      <th>ユーザー住所</th>
      <th>物件種別</th>
      <th>ガス機器</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><%= link_to @contact.id, admin_lpgas_contact_path(@contact) %></td>
      <td><%= @contact.name %></td>
      <% if @contact.prefecture.present? %>
        <td><%= [@contact.prefecture.name, @contact.address].join(" ") %></td>
      <% else %>
        <td></td>
      <% end %>
      <td><%= @contact.enum_value_i18n(:house_kind) %></td>
      <td><%= @contact.using_gas_machines_name %></td>
    </tr>
  </tbody>
</table>

<h3>紹介済みの会社</h3>

<% if @sent_estimates.size == 0 %>
  紹介済みの会社はありません。
<% else %>
  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>見積もりID</th>
        <th>有効期限</th>
        <th>見積もりステータス</th>
        <th>会社名</th>
        <th>住所</th>
        <th>成約手数料</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <% @sent_estimates.each do |estimate| %>
        <%= fields_for 'estimates[]', estimate do |f| %>
          <label>
            <tr>
              <td><%= link_to estimate.uuid, admin_lpgas_estimate_path(estimate.uuid)  %></td>
              <td>
                <% if estimate.expired? %>
                  <span class="alert-text"><%= format_date estimate.available_until %></span>
                <% else %>
                  <%= format_date estimate.available_until %>
                <% end %>
              </td>
              <td>
                <%= f.object.enum_value_i18n(:status) %>
              </td>
              <td><%= link_to estimate.company.full_name, admin_lpgas_company_path(estimate.company_id) %></td>
              <td><%= [estimate.company.prefecture.name, estimate.company.address].join(" ") %></td>
              <td>
                <%= number_to_currency f.object.contracted_commission %>
              </td>
              <td>
                <%= lpgas_estimate_destroy_link(estimate) if estimate.deletable? %>
                <% unless Rails.env.production? %>
                  <% if estimate.expired_at %>
                    <% if estimate.expired? %>
                      <%= link_to "期限内にする(テスト用)", admin_lpgas_estimate_unexpire_path(estimate), method: 'post', class: 'btn btn-danger btn-xs' %>
                    <% else %>
                      <%= link_to "期限切れにする(テスト用)", admin_lpgas_estimate_expire_path(estimate), method: 'post', class: 'btn btn-danger btn-xs' %>
                    <% end %>
                  <% end %>
                <% end %>
              </td>
            </tr>
          </label>
        <% end %>
      <% end %>
    </tbody>
  </table>
<% end %>

<h3>紹介候補</h3>

<p class="success-paragraph">
  「まだ紹介していない会社」もしくは「提示された見積もりの有効期限が全て切れている会社」が出ます。
</p>

<% if @estimates.size == 0 %>
  紹介候補はありません。
<% else %>
  <% unless @contact.auto_sendable?(true) %>
    <p class="alert-paragraph">
      見積り自体が自動見積り不可です。<br>
      [理由] <%= @contact.reasons_not_auto_sendable.join(",") %>
    </p>
  <% end %>
  <%= form_tag admin_lpgas_contact_estimates_path(@contact) do |f| %>
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>会社名</th>
          <th>未対応で作成</th>
          <th>住所</th>
          <th>NG企業<br>チェック</th>
          <th>年間節約額</th>
          <th>成約手数料</th>
        </tr>
      </thead>
      <tbody>
        <% if @contact.gas_used_amount.blank? || @contact.gas_meter_checked_month.blank? ||  @contact.gas_latest_billing_amount.blank? %>
        <% else %>
          <% @estimates.each.with_index do |estimate, idx| %>
            <%= fields_for 'estimates', estimate, index: idx do |f| %>
              <label>
                <tr>
                  <td>
                    <label style="font-weight: normal">
                      <%= f.check_box :company_id, {checked: false}, estimate.company.id, nil %>
                      <%= f.label :company_id, estimate.company.full_name, style: 'font-weight: normal; width: 200px' %>
                    </label>
                  </td>
                  <td>
                    <%= f.check_box :_pending, {checked: false}, 1, nil %>
                  </td>
                  <td><%= [estimate.company.prefecture.name, estimate.company.address].join(" ") %></td>
                  <td>
                    <%= boolean_label @contact.not_in_ng_companies?(estimate.company), true_label: 'OK', false_label: 'NG' %>
                  </td>
                  <td>
                    <span style="<%= 'color: red' if (estimate.total_savings_in_year || 0) < 0 %>">
                      <%= number_to_currency estimate.total_savings_in_year || 0 %>
                    </span>
                  </td>
                  <td>
                    <%= f.currency_field :contracted_commission, {value: estimate.contracted_commission} %>
                  </td>
                </tr>
              </label>
            <% end %>
          <% end %>
        <% end %>
      </tbody>
    </table>
    <% if @contact.gas_used_amount.blank? || @contact.gas_meter_checked_month.blank? ||  @contact.gas_latest_billing_amount.blank? %>
    <% else %>
      <%= submit_tag "チェックを入れた会社に見積もりを依頼する", class: 'btn btn-default' %>
    <% end %>
  <% end %>
<% end %>
