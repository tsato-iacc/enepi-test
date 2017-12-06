<%= simple_form_for [:admin, @pr_tracking_parameter] do |f| %>
  <%= f.error_notification %>
  <div class="form-group">
    <div class="form-inline">
      <%= f.input :name %>
      <%= f.input :display_name %>
      <%= f.input :cv_point %>
    </div>
  </div>
  <%= f.input :conversion_tag %>
  <%= f.input :render_conversion_tag_only_if_match %>
  <%= f.input :auto_sendable %>

  <%= f.button :submit %>
<% end %>

<h2>登録済みの経由元</h2>

<table class="table table-condensed table-striped table-hover">
  <thead>
    <tr>
      <th>ID</th>
      <th>パラメータ名</th>
      <th>表示名</th>
      <th>CV地点</th>
      <th>CVタグ</th>
      <th>CVタグ表示条件</th>
      <th>SSL対応</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <% @pr_tracking_parameters.each do |p| %>
      <tr>
        <td><%= p.id %></td>
        <td><%= p.name %></td>
        <td><%= p.display_name %></td>
        <td><%= p.enum_value_i18n(:cv_point) %></td>
        <td style="width: 300px"><%= p.conversion_tag %></td>
        <td><%= p.render_conversion_tag_only_if_match ? "経由元が一致する場合のみ" : "いつでも" %></td>
        <td><%= boolean_label p.support_ssl, true_label: "対応", false_label: "非対応" %></td>
        <td><%= link_to "編集", edit_admin_pr_tracking_parameter_path(p) %></td>
        <td><%= link_to "削除", admin_pr_tracking_parameter_path(p), data: {confirm: {title: '経由元のパラメータ名を正しく入力してください。', confirmField: "パラメータ名", confirmValue: p.name}, method: 'delete'} %></td>
      </tr>
    <% end %>
  </tbody>
</table>

<h2>更新履歴 (最新100件)</h2>

<table class="table table-condensed table-striped table-hover">
  <thead>
    <tr>
      <th>日時</th>
      <th>パラメータ名</th>
      <th>変更した管理者</th>
      <th>変更内容</th>
    </tr>
  </thead>
  <tbody>
    <% @pr_tracking_parameter_change_logs.each do |l| %>
      <tr>
        <td><%= format_datetime l.created_at %></td>
        <td><%= l.pr_tracking_parameter.name %></td>
        <td><%= l.admin_user.email %></td>
        <td>
          <%= l.diff.keys.include?('id') ? "新規" : "更新" %>:
          <% l.diff.each do |(k, v)| %>
            <% if k != 'last_update_admin_user_id' %>
              <%= PrTrackingParameter.human_attribute_name k %>(<%= v['old'] %> <i class="fa fa-arrow-right alert-text"></i> <%= v['new'] %>)
            <% end %>
          <% end %>
        </td>
      </tr>
    <% end %>
  </tbody>
</table>
