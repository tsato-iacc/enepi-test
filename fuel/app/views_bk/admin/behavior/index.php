<table class="table table-condensed table-striped table-hover">
  <thead>
    <tr>
      <th>日時</th>
      <th>問い合わせID</th>
      <th>見積もりID</th>
      <th>端末</th>
      <th>Session id</th>
      <th>User agent</th>
      <th>IP address</th>
      <th>認証</th>
      <th>リファラ</th>
    </tr>
  </thead>
  <tbody>
    <% @estimate_user_page_views.each do |v| %>
      <tr>
        <td><%= format_datetime v.created_at %></td>
        <td><%= link_to v.contact_id, admin_lpgas_contact_path(v.contact_id) %></td>
        <td><%= v.estimate_id %></td>
        <td><%= v.enum_value_i18n(:terminal) %></td>
        <td><%= link_to v.session_id, url_for(session_id: v.session_id) %></td>
        <td><div data-toggle-text="<%= v.user_agent || 'なし' %>" style="width: 10em"><%= (v.user_agent || 'なし')[0, 20] + '...' %></div></td>
        <td><%= link_to v.ip_address, url_for(ip_address: v.ip_address) %></td>
        <td><%= v.authorized ? "成功" : raw("<strong>失敗</strong>") %></td>
        <td><%= v.referrer %></td>
      </tr>
    <% end %>
  </tbody>
</table>

<%= paginate @estimate_user_page_views %>
