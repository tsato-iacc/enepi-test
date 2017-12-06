<div class="btn-group" role="group" aria-label="...">
  <%= link_to '新規作成', new_admin_review_path, class: "btn btn-default" %>
</div>
<% if @reviews.present? %>
  <table class="table table-condensed table-striped table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th>都道府県</th>
        <th>市区町村</th>
        <th>年齢</th>
        <th>性別</th>
        <th>職業</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <% @reviews.each do |rv| %>
        <tr>
          <td><%= rv.id %></td>
          <td><%= JpPrefecture::Prefecture.find(rv.prefecture_code).name %></td>
          <% if rv.city_code == 0 %>
            <td></td>
          <% else %>
            <td><%= Region.find(rv.city_code).city_name %></td>
          <% end %>
          <td><%= rv.reviewer_age %></td>
          <td><%= rv.reviewer_gender %></td>
          <td><%= rv.reviewer_occupation %></td>
          <td>
            <ul>
              <li><%= link_to '詳細', admin_review_path(rv) %></li>
              <li><%= link_to '編集', edit_admin_review_path(rv) %></li>
              <li><%= link_to '削除', admin_review_path(rv), data: {method: 'delete', confirm: 1} %></li>
            </ul>
          </td>
        </tr>
      <% end %>
    </tbody>
  </table>
<% end %>
