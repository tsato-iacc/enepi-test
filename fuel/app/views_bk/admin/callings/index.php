<%= search_form_for [:admin, @q] do |f| %>
  <div class="form-group">
    <div class="form-inline">
      <%= f.input :contact_name_eq, required: false, label: "名前が等しい" %>
      <%= f.input :contact_name_cont, required: false, label: "名前を含む" %>
    </div>
  </div>
  <div class="form-group">
    <div class="form-inline">
      <%= f.input :contact_tel_eq, required: false, label: "電話番号が等しい" %>
      <%= f.input :contact_email_eq, required: false, label: "メールアドレスが等しい" %>
      <%= f.input :contact_status_eq, collection: ::Lpgas::Contact.as_enum_collection_i18n_for_ransack(:status), required: false, label: "ステータスが等しい" %>
      <%= f.input :contact_user_status_eq, collection: ::Lpgas::Contact.as_enum_collection_i18n_for_ransack(:user_status), required: false, label: "小ステータス" %>
      <div class="form-group">
        <label class="control-label">見積り進行状況</label>
        <%= select_tag :estimate_progress, options_for_select(['', '連絡済み', '訪問済み', '委任状獲得済み', '工事予定', '工事完了'], params[:estimate_progress]), class: 'form-control' %>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label>
      <%= check_box_tag :include_archive, 1, params[:include_archive].present? %>
      アーカイブされているものも含む
    </label>
  </div>

  <%= f.button :submit %>
<% end %>

<p class="success-paragraph">
  追加日時、問い合わせ日時でソート可能です。
</p>

<table class="table table-condensed table-striped table-hover">
  <thead>
    <tr>
      <th>
        <%= sort_link @q, :created_at, "追加日時" %>
      </th>
      <th>問い合わせID</th>
      <th>自動見積もり</th>
      <th>提示画面閲覧済み</th>
      <th>お名前</th>
      <th>
        <%= sort_link @q, :contact_created_at, "問い合わせ日時" %>
      </th>
      <th>電話番号</th>
      <th>都道府県</th>
      <th>見積もり数</th>
      <th>問い合わせステータス</th>
      <th>見積もり進行状況</th>
      <th>管理者メモ</th>
      <th>対応履歴</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <% @callings.each do |c| %>
      <tr class="<%= 'archived' if c.archived? %>">
        <td><%= format_datetime!(c.created_at) %></td>
        <td><%= c.contact.id %></td>
        <td><% if c.contact.sent_auto_estimate_req %>◯<% else %>×<% end %></td>
        <td><%= c.contact.is_seen_i18n %></td>
        <td><%= c.contact.name %></td>
        <td><%= format_datetime! c.contact.created_at %></td>
        <td><%= c.contact.tel %></td>
        <% if c.contact.prefecture.present? %>
          <td><%= c.contact.prefecture.name %></td>
        <% else %>
          <td></td>
        <% end %>
        <td><%= c.contact.estimates.size %>件</td>
        <td>
          <span class="status <%= c.contact.status %>">
            <%= c.contact.enum_value_i18n(:status) %>
            <% unless c.contact.no_action? %>
              <br>(<%= c.contact.enum_value_i18n(:user_status) %>)
            <% end %>
          </span>
        </td>
        <td>
          <% if c.contact.estimate_progress.present? %>
            <% if c.contact.estimate_progress == '未連絡' %>
              <span class="status pending"><%= c.contact.estimate_progress %></span>
            <% else %>
              <span class="status contracted"><%= c.contact.estimate_progress %></span>
            <% end %>
            <br>
          <% end %>
        </td>
        <td>
          <div data-scroll-y-container="1">
            <%= c.contact.admin_memo %>
          </div>
        </td>
        <td>
          <div data-scroll-y-container="1">
            <%= newline_to_br c.contact.calling_histories.sorted.map(&:one_line_string).take(20).join("\n") %>
          </div>
        </td>
        <td>
          <ul>
            <li><%= link_to '編集', edit_admin_lpgas_contact_path(c.contact) %></li>
            <li><%= lpgas_contact_cancel_link(c.contact) %></li>
          </ul>
        </td>
        <td>
          <% unless c.archived? %>
            <%= link_to admin_lpgas_calling_archive_path(c), method: 'post', class: 'btn btn-xs btn-warning' do %>
              <i class="fa fa-archive" aria-hidden="true"></i>
              アーカイブ
            <% end %>
          <% end %>
        </td>
      </tr>
    <% end %>
  </tbody>
</table>

<%= paginate @callings %>
