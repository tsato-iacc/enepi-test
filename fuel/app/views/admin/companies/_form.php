<div class="btn-group" role="group">
  <%= link_to fa_text('list', '見積もり依頼一覧'), admin_lpgas_company_estimates_path(@company), class: 'btn btn-default' %>
  <%= link_to fa_text('exclamation-triangle', 'NG企業'), admin_lpgas_company_ng_companies_path(@company), class: 'btn btn-default' %>
  <%= link_to fa_text('map-marker', '営業拠点一覧'), admin_lpgas_company_offices_path(@company), class: 'btn btn-default' %>
  <%= link_to fa_text('edit', '編集'), edit_admin_lpgas_company_path(@company), class: 'btn btn-default' %>
</div>

<h3>提携会社情報</h3>

<table class="table table-condensed table-striped table-hover">
  <tr>
    <th>メールアドレス</th>
    <td><%= @company.partner_company.email %></td>
  </tr>
  <tr>
    <th>会社名</th>
    <td><%= @company.company_name %></td>
  </tr>
</table>

<h3>ガス会社情報</h3>

<%= simple_form_for [:admin, @company] do |f| %>
  <% if f.object.company_geocode.have_invalid_geocode_error? %>
    <div class="alert alert-danger">緯度経度が正しく取得できませんでした。住所を確認してください</div>
  <% end %>

  <%= f.error_notification %>
  <div class="form-group">
    <div class="form-inline">
      <%= f.input :display_name %>
      <%= f.input :zip_code %>
      <%= f.input :prefecture_code, collection: JpPrefecture::Prefecture.all, value_method: :code %>
      <%= f.input :address %>
    </div>
  </div>

  <div class="form-group">
    <div class="form-inline">
      <%= f.input :tel, placeholder: "00-000-0000" %>
      <%= f.input :fax, placeholder: "00-000-0001" %>
      <%= f.input :homepage, placeholder: "http://" %>
    </div>
  </div>

  <div class="form-group">
    <div class="form-inline">
      <%= f.input :default_contracted_commission_s, as: :currency %>
      <%= f.input :default_contracted_commission_w, as: :currency %>
      <%= f.input :default_contracted_commission_sw, as: :currency %>
    </div>
  </div>

  <div class="form-group">
    <div class="form-inline">
      <%= f.input :established_date, as: :string, input_html: {class: 'datepicker'} %>
      <%= f.input :capital, as: :currency %>
      <%= f.input :group_company_text %>
      <%= f.input :amount_of_sales, as: :currency %>
      <%= f.input :number_of_employee %>
    </div>
  </div>
  <%= f.input :supply_area_text, as: :text %>
  <%= f.input :company_overview, as: :text %>
  <%= f.input :business_overview, as: :text %>
  <%= f.input :service_features, as: :text %>

  <%= f.input :estimate_req_sendable %>

  <%= f.button :submit %>
<% end %>

<% if @company.persisted? %>
  <p>
    登録されている緯度・経度が正しいかGoogleマップ上で確認してみましょう。
  </p>
  <iframe src="https://maps.google.co.jp/maps?output=embed&q=loc:<%= @company.company_geocode.lat %>,<%= @company.company_geocode.lng %>&output=embed" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
<% end %>
