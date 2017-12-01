<% if @estimate %>
  <table class="table table-condensed table-striped table-hover">
    <tr>
      <th>ID</th>
      <td><%= @estimate.uuid %></td>
    </tr>
    <tr>
      <th>お名前</th>
      <td><%= @estimate.name %></td>
    </tr>
  </table>
<% end %>

<h2>更新履歴</h2>

<table class="table table-condensed table-striped table-hover">
  <thead>
    <tr>
      <th>日時</th>
      <th>変更した人</th>
      <th>変更内容</th>
    </tr>
  </thead>
  <tbody>
    <% @change_logs.each do |l| %>
      <tr>
        <td style="width: 10em"><%= format_datetime l.created_at %></td>
        <td style="width: 10em">
          <% if l.admin_user %>
            <%= l.admin_user.email %><br>(サイト管理者)
          <% elsif l.partner_company %>
            <%= l.partner_company.company_name %><br>(提携会社)
          <% end %>
        </td>
        <td>
          <%= l.diff.keys.include?('id') ? "新規" : "更新" %>:
          <% l.diff.each do |(k, v)| %>
            <% if k != 'last_update_admin_user_id' && k != 'id' %>
              <%= Lpgas::Estimate.human_attribute_name k %>(<%= v['old'] %> <i class="fa fa-arrow-right alert-text"></i> <%= v['new'] %>)
            <% end %>
          <% end %>
        </td>
      </tr>
    <% end %>
  </tbody>
</table>

<% unless @estimate %>
  <%= paginate @change_logs %>
<% end %>
