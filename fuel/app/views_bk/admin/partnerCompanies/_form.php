<%= simple_form_for [:admin, @company] do |f| %>
  <h3>提携会社情報</h3>

  <%= f.error_notification %>
  <div class="form-group">
    <div class="form-inline">
      <%= f.input :company_name %>
      <%= f.input :email %>
    </div>
  </div>

  <h3>ガス会社情報</h3>
  <%= f.simple_fields_for :lpgas_company, @company.lpgas_company || @company.build_lpgas_company do |f| %>
    <% if f.object.company_geocode.have_invalid_geocode_error? %>
      <div class="alert alert-danger">緯度経度が正しく取得できませんでした。住所を確認してください</div>
    <% end %>

    <div class="form-group">
      <div class="form-inline">
        <%= f.input :display_name %>
        <%= f.input :zip_code %>
        <%= f.input :prefecture_code, collection: JpPrefecture::Prefecture.all, value_method: :code %>
        <%= f.input :address %>
      </div>
    </div>

    <div id="company_service_features">
      <h3>ピックアップ ※ 3つまで登録可能</h3>
      <%= f.fields_for :company_service_features do |uf| %>
        <%= uf.hidden_field :id %>
        <%= render "company_service_feature_fields", f: uf %>
      <% end %>
      <div class="form-group">
        <%= link_to_add_association fa_text('plus', '追加'), f, :company_service_features, class: "btn btn-primary btn-xs cocoon-add" %>
      </div>
    </div>
    <script>
      var csfCocoonAdd = $('#company_service_features .cocoon-add');
      var csfCocoonLength = $('#company_service_features .nested-fields').length;
      if (csfCocoonLength >= 4) {
        csfCocoonAdd.hide();
      } else {
        csfCocoonAdd.show();
      }
      $('#company_service_features').on('cocoon:after-insert cocoon:after-remove', function(e, insertedItem) {
        switch (e.type) {
          case "cocoon:after-insert":
            csfCocoonLength++;
            break;
          case "cocoon:after-remove":
            csfCocoonLength--;
            break;
        }
        if (csfCocoonLength >= 3) {
          csfCocoonAdd.hide();
        } else {
          csfCocoonAdd.show();
        }
      });
    </script>

    <%= f.input :lpgas_company_image %>
    <div class="form-group">
      <% if f.object.persisted? %>
        <% if f.object.lpgas_company_image.try!(:url) %>
          <%= image_tag f.object.lpgas_company_image.url, style: "max-height: 200px; border: 1px solid #CCC;" %>
        <% end %>
      <%end %>
    </div>
    <%= f.input :lpgas_company_logo %>
    <div class="form-group">
      <% if f.object.persisted? %>
        <% if f.object.lpgas_company_logo.try!(:url) %>
          <%= image_tag f.object.lpgas_company_logo.url, style: "max-height: 200px; border: 1px solid #CCC;" %>
        <% end %>
      <%end %>
    </div>

    <div class="form-group">
      <div class="form-inline">
        <%= f.input :tel, placeholder: "00-000-0000" %>
        <%= f.input :fax, placeholder: "00-000-0001" %>
        <%= f.input :homepage, placeholder: "http://" %>
      </div>
    </div>

    <div class="inline-checkboxes">
      <%= f.association(
        :master_company_features,
        as: :check_boxes,
        label_method: :name,
        value_method: :id,
      ) %>
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
    <% if f.object.persisted? && f.object.company_service_features.empty? %>
      <%= f.input :service_features, as: :text %>
    <% end %>
  <% end %>

  <%= f.button :submit %>
<% end %>

<% if @company.lpgas_company && @company.lpgas_company.persisted? %>
  <p>
    登録されている緯度・経度が正しいかGoogleマップ上で確認してみましょう。
  </p>
  <iframe src="https://maps.google.co.jp/maps?output=embed&q=loc:<%= @company.lpgas_company.company_geocode.lat %>,<%= @company.lpgas_company.company_geocode.lng %>&output=embed" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
<% end %>
