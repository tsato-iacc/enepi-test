<p>
  今月の請求額: <%= number_to_currency @comissions.values.reduce(&:+) %>
</p>

<table class="table table-condensed table-striped table-hover">
  <thead>
    <tr>
      <th>LPガス会社</th>
      <th>見積もり数</th>
      <th>成約手数料</th>
    </tr>
  </thead>
  <tbody>
    <% @company_names.keys.each do |c_id| %>
      <tr>
        <td><%= link_to @company_names[c_id], admin_lpgas_company_path(c_id) %>
        <td><%= link_to @estimate_request_counts[c_id], admin_lpgas_company_estimates_path(c_id) %>
        <td><%= number_to_currency @comissions[c_id] %>
      </tr>
    <% end %>
  </tbody>
</table>
