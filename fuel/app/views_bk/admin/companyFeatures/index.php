<%= simple_form_for [:admin, @new_feature] do |f| %>
  <%= f.error_notification %>
  <div class="form-group">
    <div class="form-inline">
      <%= f.input :name %>
      <%= f.input :description %>
    </div>
  </div>

  <%= f.button :submit %>
<% end %>

<table class="table table-condensed table-striped table-hover">
  <thead>
    <tr>
      <th>ID</th>
      <th>表示名</th>
      <th>概要</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <% @features.select(&:persisted?).each do |o| %>
      <tr>
        <td><%= o.id %></td>
        <td><%= o.name %></td>
        <td><%= o.description %></td>
        <td><%= link_to '編集', edit_admin_lpgas_master_company_feature_path(o), class: 'btn btn-default btn-xs' %></td>
        <td><%= link_to '削除', admin_lpgas_master_company_feature_path(o), data: {method: 'delete', confirm: 1}, class: 'btn btn-danger btn-xs' %></td>
      </tr>
    <% end %>
  </tbody>
</table>
