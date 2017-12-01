<%= simple_form_for [:admin, @new_prefecture] do |f| %>
  <%= f.error_notification %>
  <%= f.input :prefecture_code, collection: JpPrefecture::Prefecture.all, value_method: :code %>
  <%= f.input :pr_tracking_parameter_id, collection: PrTrackingParameter.all, hint: '選択しなかった場合は経由元によらず非対応になります' %>
  <%= f.button :submit %>
<% end %>

<% @unsupported_prefectures.keys.each do |pr_param_id| %>
  <h2><%= pr_param_id ? PrTrackingParameter.find(pr_param_id).display_name : "全体" %>に対する非対応都道府県</h2>
  <table class="table table-condensed table-striped table-hover">
    <thead>
      <tr>
        <th>都道府県</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <% @unsupported_prefectures[pr_param_id].each do |p| %>
        <tr>
          <td><%= p.prefecture_name %></td>
          <td><%= link_to '削除', admin_lpgas_unsupported_prefecture_path(p), class: 'btn btn-xs btn-danger', data: {confirm: 1, method: 'delete'} %></td>
        </tr>
      <% end %>
    </tbody>
  </table>
<% end %>
