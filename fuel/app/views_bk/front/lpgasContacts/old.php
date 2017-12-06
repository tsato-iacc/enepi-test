<script type="text/javascript">
    window._pt_lt = new Date().getTime();
    window._pt_sp_2 = [];
    _pt_sp_2.push('setAccount,1498b80c');
    var _protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
    (function() {
        var atag = document.createElement('script'); atag.type = 'text/javascript'; atag.async = true;
        atag.src = _protocol + 'js.ptengine.jp/pta.js';
        var stag = document.createElement('script'); stag.type = 'text/javascript'; stag.async = true;
        stag.src = _protocol + 'js.ptengine.jp/pts.js';
        var s = document.getElementsByTagName('script')[0]; 
        s.parentNode.insertBefore(atag, s); s.parentNode.insertBefore(stag, s);
    })();
</script>

<% if from_kakaku? && smart_phone? %>
　<script src="//assets.adobedtm.com/3687940b53f7a560587a33c8bb748b9253ff5ea9/satelliteLib-2baf9a6b9fae7a21c0cfb818c33122e38669f89d.js"></script>
<% elsif from_kakaku? %>
  <script src="//assets.adobedtm.com/3687940b53f7a560587a33c8bb748b9253ff5ea9/satelliteLib-29577dfd7f420978cd93f3d1b2d6ee3a7d40cf53.js"></script>
<% end %>

<% if @previewing %>
  <% title "エネピ - お見積もり情報確認" %>
<% else %>
  <% title "エネピ - お見積もり情報入力" %>
<% end %>

<div class="skinny">
  <% if !(from_kakaku? || from_enechange?) %>
    <div class="step-container">
      <div>
      <%= image_tag "estimate_presentation/new_step_img_01.png", class: 'lpgas-form-step-image' %>
      <p class="step-supply-txt">入力頂いた内容によっては、STEP2で完了する場合がございます。</p>
      </div>
    </div>
  <% end %>

  <% if from_kakaku? %>
    <% if NewYearHoliday.holiday?(@now) %>
      <p class="warning-paragraph">
        <%= NewYearHoliday.holiday_text %>
      </p>
    <% end %>
  <% elsif from_enechange? %>
  <% else %>
    <h2 class="page-title center">
      エネピなら、お客様にピッタリの<br>プロパンガス会社を簡単ネット見積もり。
    </h2>
  <% end %>

  <% if from_kakaku? %>
    <% if @previewing %>
      <p class="confirm_txt">入力いただいた内容をご確認のうえ「上記の内容で送信する」ボタンを押してください</p>
    <% else %>
      <div class="step">
        <h3 class="step-heading">プロパンガス料金 お見積もりまでの流れ</h3>
        <%= image_tag("kakaku/step.png") %>
      </div>
    <% end %>
  <% elsif from_enechange? %>
    <div class="ene-quo-banner-pc"><%= image_tag("enechange/eneQUOheader-5000-pc.png") %></div>
    <div class="ene-quo-banner-sp"><%= image_tag("enechange/eneQUOheader-5000-sp.png") %></div>
    <div class="step">
      <h3 class="step-heading">プロパンガス料金 お見積もりまでの流れ</h3>
      <%= image_tag("enechange/step.png") %>
    </div>
  <% end %>

  <% unless @previewing %>
    <% if @apartment_form %>
      <p class="center">このお見積もりフォームは、集合住宅のオーナー様（大家様）専用のものです。ご入居者様からのお問い合わせには対応致しかねますので、ご了承ください。</p>
    <% end %>
  <% end %>



  <%
      to_obj = if from_kakaku?
                 [:kakaku, @lpgas_contact]
               elsif from_enechange?
                 [:enechange, @lpgas_contact]
               else
                 @lpgas_contact
               end
  %>

  <%= form_for to_obj, html: {class: 'table-form'} do |f| %>
    <%= hidden_field_tag :token, params[:token] if params[:token].present? %>
    <%= hidden_field_tag :contact_id, params[:contact_id] if params[:contact_id].present? %>
    <% if from_kakaku? %>
      <%= hidden_field_tag :previewed, 1 if @previewing %>
    <% end %>
    <% if @apartment_form %>
      <%= hidden_field_tag :apartment_form, 1 if @apartment_form %>
    <% end %>

    <h3 class="table-form-header"><i class="fa fa-building" aria-hidden="true"></i>ガスを見直したい物件</h3>

    <div class="form-bg">
    <table>
      <% unless @apartment_form %>
        <tr>
          <th><i class="fa fa-pencil" aria-hidden="true"></i><%= f.label :estimate_kind, 'ガスを見直したい物件は', class: 'required' %></th>
          <td>
            <% f.object.as_enum_collection_i18n(:estimate_kind).each do |ek| %>
              <% if ek.first == "現在住居の見積もり" %>
                <%= f.radio_button :estimate_kind, ek.last, {:checked => true} %>
                <%= f.label :estimate_kind, ek.first, value: ek.last, class: "checkbox_label_margin" %>
              <% else %>
                <%= f.radio_button :estimate_kind, ek.last %>
                <%= f.label :estimate_kind, ek.first, value: ek.last, class: "checkbox_label_margin" %>
              <% end %>
            <% end %>
            <%= error_tag f.object, :estimate_kind %>
          </td>
        </tr>
      <% end %>
      <% unless @apartment_form %>
        <tr>
          <th><i class="fa fa-pencil" aria-hidden="true"></i><%= f.label :zip_code, '現在お住まいの郵便番号は？', class: 'required' %></th>
          <td>
            〒 <%= f.text_field :zip_code, 'data-hyphen-digits': 1 %> <span class="example">(例: 1500022)</span>
            <%= error_tag f.object, :zip_code %>
            <% unless @previewing %>
              <p class="notice_txt"><i class="fa fa-info-circle" aria-hidden="true"></i>郵便番号を入力すると、下の住所が自動で途中まで入力されます。</p>
            <% end %>
          </td>
        </tr>
        <tr>
          <th><i class="fa fa-pencil" aria-hidden="true"></i><%= f.label :prefecture_code, '現在お住まいの住所は？', class: 'required' %></th>
          <td>
          <% unless @previewing %>
          <div class="select-wrap styled-select">
          <% end %>
          <div><%= f.collection_select :prefecture_code, JpPrefecture::Prefecture.all, :code, :name, include_blank: '選択してください', class: 'select-right' %></div>
          <% unless @previewing %>
          </div>
        　<% end %>
            <%= error_tag f.object, :prefecture_code %>
            <%= f.text_field :address, placeholder: '例）港区新橋' %>
            <%= error_tag f.object, :address %>
            <%= f.text_field :address2, placeholder: '例）1-18-16' %>
            <%= error_tag f.object, :address2 %>
          </td>
        </tr>
      <% end %>
      <tr class="<%= @apartment_form ? '' : 'js-show-on-estimate-type-new-contract' %>">
        <% if @apartment_form %>
          <th><i class="fa fa-pencil" aria-hidden="true"></i><%= f.label :new_zip_code, '物件の郵便番号は？', class: 'required' %></th>
        <% else %>
          <th><i class="fa fa-pencil" aria-hidden="true"></i><%= f.label :new_zip_code, '開設先の郵便番号は？', class: 'required' %></th>
        <% end %>
        <td>
          〒 <%= f.text_field :new_zip_code, 'data-hyphen-digits': 1 %> <span class="example">(例: 1500022)</span>
          <%= error_tag f.object, :new_zip_code %>
          <% unless @previewing %>
            <p class="notice_txt"><i class="fa fa-info-circle" aria-hidden="true"></i>郵便番号を入力すると、下の住所が自動で途中まで入力されます。</p>
          <% end %>
        </td>
      </tr>
      <tr class="<%= @apartment_form ? '' : 'js-show-on-estimate-type-new-contract' %>">
        <% if @apartment_form %>
          <th><i class="fa fa-pencil" aria-hidden="true"></i><%= f.label :new_prefecture_code, '物件の住所は？', class: 'required' %></th>
        <% else %>
          <th><i class="fa fa-pencil" aria-hidden="true"></i><%= f.label :new_prefecture_code, '開設先の住所は？', class: 'required' %></th>
        <% end %>
        <td>
        <% unless @previewing %>
          <div class="select-wrap styled-select">
        <% end %>
          <div><%= f.collection_select :new_prefecture_code, JpPrefecture::Prefecture.all, :code, :name, include_blank: '選択してください', class: 'select-right' %></div>
        <% unless @previewing %>
        </div>
        <% end %>
          <%= error_tag f.object, :new_prefecture_code %>
          <%= f.text_field :new_address, placeholder: '例）港区新橋' %>
          <%= error_tag f.object, :new_address %>
          <!--<%= f.text_field :new_address2 %>
          <%= error_tag f.object, :new_address2 %>-->
        </td>
      </tr>

      <% unless @apartment_form %>
        <tr>
          <th><i class="fa fa-pencil" aria-hidden="true"></i><%= f.label :ownership_kind, '住居の種類は?', class: 'required' %></th>
          <td>
            <div class="house-kind-area">
              <div class="select-area">
              <% if !@previewing %>
                <p style="margin: 0; font-weight: bold;">一戸建ての場合</p>
              <% end %>
              <% if @previewing &&  @lpgas_contact.house_kind == "detached" %>
                <p style="margin: 0; font-weight: bold;">一戸建て</p>
              <% end %>
              <% f.object.as_enum_collection_i18n(:ownership_kind).each do |ok| %>
                <% if ok.last == "owner" %>
                   <%= f.radio_button :ownership_kind, ok.last, {:checked => true} %>
                   <%= f.label :ownership_kind, ok.first, value: ok.last, class: "checkbox_label_margin" %>
                <% end %>
              <% end %>
              <% if !@previewing %>
                <p style="margin: 0; font-weight: bold;">店舗(業務用)の場合</p>
              <% end %>
              <% if @previewing &&  @lpgas_contact.house_kind == "store_ex" %>
                <p style="margin: 0; font-weight: bold;">店舗(業務用)</p>
              <% end %>
              <% f.object.as_enum_collection_i18n(:ownership_kind).each do |ok| %>
                <% if ok.last != "owner" %>
                  <%= f.radio_button :ownership_kind, ok.last %>
                  <%= f.label :ownership_kind, ok.first, value: ok.last, class: "checkbox_label_margin" %>
                <% end %>
              <% end %>
              </div>
              <div class="btn-link" style="margin-left: 50px; padding-top: 35px;">
                <% if !(@previewing) %>
                  <% if from_kakaku? %>
                    <%=  link_to "マンションオーナーの方はこちら", new_kakaku_lpgas_contact_path({apartment_form: "1"}), class: 'owner-form-link-btn' %>
                  <% elsif from_enechange? %>
                    <%=  link_to "マンションオーナーの方はこちら", new_enechange_lpgas_contact_path({apartment_form: "1"}), class: 'owner-form-link-btn' %>
                  <% else %>
                    <%=  link_to "マンションオーナーの方はこちら", new_lpgas_contact_path({apartment_form: "1"}), class: 'owner-form-link-btn' %>
                  <% end %>
                <% end %>
              </div>
              <% if !@previewing %>
                <p class="notice_txt"><i class="fa fa-info-circle" aria-hidden="true"></i>マンション・アパートにお住まいの方はご登録頂けません。</p>
              <% end %>
            </div>
            <%= error_tag f.object, :ownership_kind %>
          </td>
        </tr>
      <% end %>

      <tr>
        <th><i class="fa fa-pencil" aria-hidden="true"></i><%= f.label :house_age, '築年数は？' %></th>
        <td>
          <%= f.text_field :house_age, 'data-hyphen-digits': 1 %> <span class="unit">年</span>
          <%= error_tag f.object, :house_age %>
          <% unless @previewing %>
            <p class="notice_txt"><i class="fa fa-info-circle" aria-hidden="true"></i>だいたいでOKです。</p>
          <% end %>
        </td>
      </tr>

      <% if @apartment_form %>
        <tr>
          <th><i class="fa fa-pencil" aria-hidden="true"></i><%= f.label :number_of_rooms, class: 'required' %></th>
          <td>
            <%= f.text_field :number_of_rooms, 'data-hyphen-digits': 1 %>
            <%= error_tag f.object, :number_of_rooms %>
          </td>
        </tr>
        <tr>
          <th><i class="fa fa-pencil" aria-hidden="true"></i><%= f.label :number_of_active_rooms %></th>
          <td>
            <%= f.text_field :number_of_active_rooms, 'data-hyphen-digits': 1 %>
            <%= error_tag f.object, :number_of_active_rooms %>
          </td>
        </tr>
        <tr>
          <th><i class="fa fa-pencil" aria-hidden="true"></i><%= f.label :estate_management_company_name %></th>
          <td>
            <%= f.text_field :estate_management_company_name %>
            <%= error_tag f.object, :estate_management_company_name %>
          </td>
        </tr>
      <% end %>

      <% unless @apartment_form %>
        <tr class="js-show-on-estimate-type-new-contract">
          <th><i class="fa fa-pencil" aria-hidden="true"></i><%= f.label :moving_scheduled_date, '引越し予定日は？' %></th>
          <td>
            <%= f.text_field :moving_scheduled_date, class: 'datepicker' %>
            <%= error_tag f.object, :moving_scheduled_date %>
            <% unless @previewing %>
              <p class="notice_txt"><i class="fa fa-info-circle" aria-hidden="true"></i>だいたいでOKです。</p>
            <% end %>
          </td>
        </tr>
      <% end %>
    </table>
    </div>

    <h3 class="table-form-header"><i class="fa fa-home" aria-hidden="true"></i>ガスの使用状況</h3>

    <div class="form-bg">
    <table>
      <tr>
        <th>
          <i class="fa fa-pencil" aria-hidden="true"></i><%= f.label :gas_contracted_shop_name, '契約中のガス会社は？' %>
          <% unless @previewing %>
            <a href="#my-modal" class="md-btn one"><i class="fa fa-question" aria-hidden="true"></i></a>
          <% end %>
        </th>
        <td>
          <%= f.text_field :gas_contracted_shop_name %>
          <%= error_tag f.object, :gas_contracted_shop_name %>
        </td>
      </tr>
      <tr>
        <th>
          <% if @apartment_form %>
            <i class="fa fa-pencil" aria-hidden="true"></i><%= f.label :gas_meter_checked_month, '最近のガス使用量・料金は？'%>
          <% else %>
            <i class="fa fa-pencil" aria-hidden="true"></i><%= f.label :gas_meter_checked_month, '最近のガス使用量・料金は？', class: 'required' %>
          <% end %>
          <% unless @previewing %>
            <a href="#my-modal" class="md-btn one adjustment-box"><i class="fa fa-question" aria-hidden="true"></i></a>
          <% end %>
        </th>
        <td>
          <%= f.text_field :gas_meter_checked_month, 'data-hyphen-digits': 1 %>  <span class="unit">月のガス使用量が</span>
          <%= f.text_field :gas_used_amount, 'data-hyphen-digits': 1 %>  <span class="unit">m³で</span>
          <%= f.text_field :gas_latest_billing_amount, 'data-hyphen-digits': 1 %> <span class="unit">円(税込)</span>
          <%= error_tag f.object, :gas_meter_checked_month %>
          <%= error_tag f.object, :gas_used_amount %>
          <%= error_tag f.object, :gas_latest_billing_amount %>
          <% unless @previewing %>
            <p class="notice_txt"><i class="fa fa-info-circle" aria-hidden="true"></i>わからない方はだいたいでOKです。</p>
          <% end %>
        </td>
      </tr>
      <tr>
        <th><i class="fa fa-pencil" aria-hidden="true"></i><%= f.label :gas_used_years, '今のガス会社の使用年数は？' %></th>
        <td>
          <%= f.text_field :gas_used_years, 'data-hyphen-digits': 1 %>  <span class="unit">年</span>
          <%= error_tag f.object, :gas_used_years %>
        </td>
      </tr>

      <tr>
        <th><i class="fa fa-pencil" aria-hidden="true"></i><%= f.label :gas_machines, 'ガスを利用するものは？' %></th>
        <td>
          <%= f.check_box :using_cooking_stove %>
          <%= f.label :using_cooking_stove, class: "checkbox_label_margin" %>

          <%= f.check_box :using_bath_heater_with_gas_hot_water_supply %>
          <%= f.label :using_bath_heater_with_gas_hot_water_supply, class: "checkbox_label_margin" %>

          <%= f.check_box :using_other_gas_machine %>
          <%= f.label :using_other_gas_machine %>
          <% unless @previewing %>
            <p class="notice_txt"><i class="fa fa-info-circle" aria-hidden="true"></i>当てはまる全ての選択肢にチェックしてください。</p>
          <% end %>
        </td>
      </tr>

      <tr>
        <th><i class="fa fa-pencil" aria-hidden="true"></i><%= f.label :body, 'ご相談・ご要望は？' %></th>
        <td>
          <%= f.text_area :body, placeholder: '例）ガス会社の変更希望、適正料金の相談など' %>
          <%= error_tag f.object, :body %>
        </td>
      </tr>
    </table>
    </div>

    <% unless @previewing %>
      <p class="notice_info_txt"><i class="fa fa-info-circle" aria-hidden="true"></i>お客様の情報が一般に公開されることはありませんのでご安心ください。</p>
    <% end %>

    <h3 class="table-form-header"><i class="fa fa-user" aria-hidden="true"></i>お客様の情報</h3>

    <div class="form-bg">
    <table>
      <tr>
        <th><i class="fa fa-pencil" aria-hidden="true"></i><%= f.label :name, 'お名前は？', class: 'required' %></th>
        <td>
          <%= f.text_field :name %> <span class="example">(例: 山田 太郎)</span>
          <%= error_tag f.object, :name %>
        </td>
      </tr>

      <tr>
        <th><i class="fa fa-pencil" aria-hidden="true"></i><%= f.label :tel, '電話番号は？', class: 'required' %></th>
        <td>
          <%= f.text_field :tel, 'data-hyphen-digits': 1 %> <span class="example">(例: 09011112222)</span>
          <% if !@previewing %>
            <p class="notice_txt"><i class="fa fa-info-circle" aria-hidden="true"></i>繋がりやすい電話番号をご記入ください。</p>
          <% end %>
          <%= error_tag f.object, :tel %>
        </td>
      </tr>

      <tr>
        <th><i class="fa fa-pencil" aria-hidden="true"></i><%= f.label :email, 'メールアドレスは？', class: 'required' %></th>
        <td>
          <%= f.text_field :email %> <span class="example">(例: info@enepi.jp)</span>
          <%= error_tag f.object, :email %>
        </td>
      </tr>

      <% if @apartment_form %>
        <tr>
          <th><i class="fa fa-pencil" aria-hidden="true"></i><%= f.label :zip_code, '郵便番号は？', class: 'required' %></th>
          <td>
            〒 <%= f.text_field :zip_code %>
            <span class="example">(例: 1500022)</span>

            <%= error_tag f.object, :zip_code %>
            <% unless @previewing %>
            <p class="notice_txt"><i class="fa fa-info-circle" aria-hidden="true"></i>郵便番号を入力すると、下の住所が自動で途中まで入力されます。</p>
            <% end %> 
          </td>
        </tr>
        <tr>
          <th><i class="fa fa-pencil" aria-hidden="true"></i><%= f.label :prefecture_code, '都道府県は？', class: 'required' %></th>
          <td>
          <% unless @previewing %>
            <div class="select-wrap styled-select">
          <% end %>
            <%= f.collection_select :prefecture_code, JpPrefecture::Prefecture.all, :code, :name, include_blank: '選択してください' %>
          <% unless @previewing %>
          </div>
          <% end %>   
            <%= error_tag f.object, :prefecture_code %>
            <%= f.text_field :address, placeholder: '例）港区新橋' %>
            <%= error_tag f.object, :address %>
            <%= f.text_field :address2, placeholder: '例）1-18-16' %>
            <%= error_tag f.object, :address2 %>
          </td>
        </tr>
      <% end %>
    </table>
    </div>

    <% if @previewing %>
      <%# 送信 %>
      <% if from_kakaku? %>
        <%= image_submit_tag(
          "kakaku/btn-estimate-submit.jpg",
          onmouseover: "this.src='#{asset_path("kakaku/btn-estimate-submit-on.jpg")}'",
          onmouseout: "this.src='#{asset_path("kakaku/btn-estimate-submit.jpg")}'",
          onclick: "DisableButton(this);",
        ) %>
      <% end %>
    <% else %>
      <%# 確認画面へ %>
      <% if from_kakaku? %>
        <p style="font-size: 0.9em">
          プロパンガス料金見積もりサービスは、株式会社アイアンドシー・クルーズが運営するサービスです。ご入力いただいた内容を株式会社カカクコムは保持せず、株式会社アイアンドシー・クルーズが取得し、同社がプライバシーポリシーに基づき管理いたします。
        </p>

        <h3 style="font-size: 1rem">「利用規約」・「個人情報の取り扱いについて」</h3>
        <div class="agreement-iframe">
          <iframe src="https://enepi.jp/agreement?iframe=1"></iframe>
        </div>
        <%= image_submit_tag(
          "kakaku/btn-estimate.jpg",
          onmouseover: "this.src='#{asset_path("kakaku/btn-estimate-on.jpg")}'",
          onmouseout: "this.src='#{asset_path("kakaku/btn-estimate.jpg")}'",
        ) %>
      <% else %>
        <%= f.submit '登録する', data: {disable_with: '送信中...'} %>
      <% end %>

      <% unless from_kakaku? %>
        <p class="before_preview">
          当サービスをご利用頂くにあたり、<%= link_to '「enepi」利用規約',  'http://enepi.jp/agreement', target: '_blank' %>に同意したものとみなします。同意いただけない場合、相談を利用することはできません。
        </p>
      <% end %>
    <% end %>

    <% if from_kakaku? %>
      <div style="margin-top: 20px">
        <%= image_tag("kakaku/tel.png") %>
      </div>
    <% end %>
  <% end %>
</div>

<section class="modal-area" id="my-modal">
  <div class="modal one">
    <img src="/images/img_receipt.png"/>
    <div class="close"><span>close</span></div>
  </div>
</section>

<script>
  function DisableButton(b)
  {
    b.disabled = true;
    b.form.submit();
  }
</script>

<script>
$(function() {
  <% if !@previewing %>
    var houseKindSelect = $('[name="lpgas_contact\[house_kind\]"]');
    var ownershipKindSelect = $('[name="lpgas_contact\[ownership_kind\]"]');
    houseKindSelect.on('change', function(e) {
      var v = $(e.target).val();
      var txt = ownershipKindSelect.parent().find(".js-text");
      if (v === "detached") {
        ownershipKindSelect.val("owner").hide();
        txt.text(ownershipKindSelect.find('option:selected').text());
      } else {
        ownershipKindSelect.val('').show();
        txt.text('');
      }
    });
    houseKindSelect.trigger('change');
  <% end %>
  var estimateTypeRadio = $('input[name="lpgas_contact\[estimate_kind\]"]');
  estimateTypeRadio.on('change', estimateTypeChanged);
  estimateTypeRadio.trigger('change');

  function estimateTypeChanged(evt) {
    var $node = $(evt.target);

    var val = $node.prop('checked') && $node.val();
    switch(val) {
    case "change_contract": // 現住所の見積もり
      $('.js-show-on-estimate-type-new-contract').hide();
      $('label[for="lpgas_contact_gas_contracted_shop_name"]').addClass('required');
      $('label[for="lpgas_contact_gas_meter_checked_month"]').addClass('required');
      break;
    case "new_contract": // 新規契約
      $('.js-show-on-estimate-type-new-contract').show();
      $('label[for="lpgas_contact_gas_contracted_shop_name"]').removeClass('required');
      $('label[for="lpgas_contact_gas_meter_checked_month"]').removeClass('required');
      break;
    default:
      $('.js-show-on-estimate-type-new-contract').hide();
      $('label[for="lpgas_contact_gas_contracted_shop_name"]').addClass('required');
      $('label[for="lpgas_contact_gas_meter_checked_month"]').addClass('required');
    }
  }
});
</script>

<% if !@previewing && !from_kakaku? && !from_enechange? %>
  <% if Rails.env.staging? %>
    <script src="//app.gorilla-efo.com/js/efo.158_test.js" type="text/javascript"></script>
  <% end %>
  <% if Rails.env.production? %>
    <script src="//app.gorilla-efo.com/js/efo.158.js" type="text/javascript"></script>
  <% end %>
<% end %>

<script type="text/javascript">
$(function(){
  var target = '';
  $(".md-btn").on('click', function(e){
    e.preventDefault();

    // Get the second class of "btn" class
    target = $(this).get(0).className.split(" ")[1];
    // Set the target modal window
    target = $(".modal." + target);
    // Show modal window
    if ( target.is(":hidden") ) {
      target.fadeIn(600);
      // $(".container").addClass("bg-blur");
    } else {
      target.hide();
      // $(".container").removeClass("bg-blur");
    }
  });
  
  // Hide modal window
  $(".close, .modal").on('click', function(){
    $(".modal").hide();
    // $(".container").removeClass("bg-blur");
  });
});
</script>

<% if @previewing %>
  <script>
    $('input, textarea').attr('readonly', true);
    $('input, textarea').attr('placeholder', '');

    $('input[type="text"][readonly]').each(function(i, node) {
      var $textField = $(node);
      if (!$textField.val()) {
        $textField.closest('td').find('.unit').hide();
      } else {
        var $span = $("<span>").text($textField.val());
        $span.insertBefore($textField);
        $textField.hide();
      }
    });


    $('input[type="radio"][readonly], input[type="checkbox"][readonly]').each(function(_, n) {
      var $n = $(n);
      // チェックボックスは隠す
      $n.css({display: 'none'});

      // チェックされていないチェックボックスに対応するラベルは隠す
      if (!$n.prop('checked')) {
        $('label[for="' + $n.attr('id') + '"]').css({display: 'none'})
      }
    });

    $('td .example').hide();

    $('select').hide();
    $('select').each(function(i, node) {
      var $select = $(node);
      if ($select.val()) {
        var selectedOptionLabel = $select.find("option:selected").text();
        var $el = $("<span>");
        $el.text(selectedOptionLabel);
        $select.parent().append($el);
      }
    });
  </script>
<% end %>

<% if from_kakaku? %>
  <script type="text/javascript">
    if(typeof _satellite !== "undefined"){
        _satellite.pageBottom();
    }
  </script>
<% end %>

<%= content_for :tail do %>
  <% if pr_tracking_parameter.try(:name) == "xmarke" %>
    <%# 入力画面でクロスマーケのCVタグを表示 %>
    <% if @previewing %>
      <%# 確認画面はなし %>
    <% else %>
      <%= conversion_image_tag "https://rsch.jp/common/prom/connectlpimg.php?eqid=8def6277d77504dbc3b8bbaf8e447c56546cb41c&po=0023" %>
    <% end %>
  <% end %>
<% end %>

<%= content_for :tail do %>
  <script>
    window.onbeforeunload = function(e){
      e.returnValue = 'このサイトを離れてもよろしいですか？';
    }

    $('input[type="submit"], input[type="image"], input[type="button"]').on('click', function() {
      window.onbeforeunload = null;
    });
  </script>

  <% unless @previewing %>
    <%= render 'shared/yahoo_retargeting' %>
    <%= render 'shared/google_remarketing' %>
  <% end %>

  <% if from_kakaku? && Rails.env.production? %>
    <% if @previewing %>
      <%= render 'shared/kakaku/tracking_preview' %>
    <% else %>
      <%= render 'shared/kakaku/tracking_new' %>
    <% end %>
  <% end %>
<% end %>
