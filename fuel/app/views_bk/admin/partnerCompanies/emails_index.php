<%= simple_form_for [:admin, @company.notification_emails.build], url: admin_partner_company_emails_path(@company) do |f| %>
  <%= f.error_notification %>
  <div class="form-group">
    <div class="form-inline">
      <%= f.input :email %>
    </div>
  </div>
  <%= f.button :submit %>
<% end %>

<table class="table table-condensed table-striped table-hover">
  <thead>
    <th>メールアドレス</th>
  </thead>
  <tbody>
    <tr>
      <td>
        <%= @company.email %>
      </td>
      <td></td>
    </tr>
    <% @company.notification_emails.select { |e| e.persisted? }.each do |email| %>
      <tr>
        <td>
          <%= email.email %>
        </td>
        <td>
          <%= link_to "削除", admin_partner_company_email_path(@company, email), data: {confirm: 1, method: 'delete'}, class: 'btn btn-danger btn-xs' %>
        </td>
      </tr>
    <% end %>
  </tbody>
</table>
