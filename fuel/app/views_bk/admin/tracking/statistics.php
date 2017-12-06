<%= simple_form_for :q, method: 'get' do |f| %>
  <div class="form-group">
    <div class="form-inline">
      <%= f.input :beg_at, input_html: {class: 'datepicker', value: @beg_at} %>
      <%= f.input :end_at, input_html: {class: 'datepicker', value: @end_at} %>
    </div>
  </div>
  <%= f.button :submit, "検索する" %>
<% end %>

<table class="table table-condensed table-striped table-hover">
  <thead>
    <tr>
      <th>媒体</th>
      <th>問い合わせ数</th>
      <th>紹介数</th>
      <th>成約</th>
    </tr>
  </thead>
  <tbody>
    <% (PrTrackingParameter.all + [PrTrackingParameter.null_object]).each do |pr| %>
      <tr>
        <td><%= pr.display_name %></td>
        <td><%= @contact_count_by_pr[pr.id] %></td>
        <td><%= @estimate_count_by_pr[pr.id] %></td>
        <td><%= @contracted_estimate_count_by_pr[pr.id] %></td>
      </tr>
    <% end %>
  </tbody>
</table>
