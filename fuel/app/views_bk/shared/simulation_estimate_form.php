<div class="simulation-register-form" id="simulation_register_form">
  <h3>↓↓このままガス会社の料金プランを見る↓↓<div class="info scroll"><i class="fa fa-info-circle" aria-hidden="true"></i><span>詳しくはことら</span></div></h3>

  <div class="form-wrap">
    <%= form_for @lpgas_contact, url: @form_url, method: 'POST' do |f| %>
      <input type="hidden" name="new_form" value="true">
      <input type="hidden" name="simple_simulation" value="true">
      <input type="hidden" name="zip" value="<%= @zip.zip_code %>">
      <input type="hidden" name="pref" value="<%= @zip.prefecture_code %>">
      <input type="hidden" name="addr" value="<%= @zip.city_name %>">

      <input type="hidden" name="lpgas_contact[house_kind]" value="detached">
      <input type="hidden" name="lpgas_contact[house_hold]" value="<%= @hh %>">
      <input type="hidden" name="lpgas_contact[gas_meter_checked_month]" value="<%= @month %>">
      <input type="hidden" name="lpgas_contact[gas_used_amount]" value="<%= @household_average_rate.round(1) %>">
      <input type="hidden" name="lpgas_contact[gas_latest_billing_amount]" value="<%= defined?(@bill) ? @bill : @estimated_bill %>">

      <input type="hidden" name="lpgas_contact[zip_code]">
      <input type="hidden" name="lpgas_contact[prefecture_code]">
      <input type="hidden" name="lpgas_contact[address]">
      <input type="hidden" name="lpgas_contact[new_zip_code]">
      <input type="hidden" name="lpgas_contact[new_prefecture_code]">
      <input type="hidden" name="lpgas_contact[new_address]">

      <div class="content-title hidden-field">
        <div class="step-error"></div>
        <p>※お客様の情報が一般に公開されることはありません</p>
      </div>

      <!-- KONTRACT KIND START -->
      <div class="content-box">
        <div class="house-kind input-wrap remove-error error-wrap">
          <input type="radio" name="lpgas_contact[estimate_kind]" value="change_contract" id="change_contract">
          <label class="image-wrap hand-navi-label" for="change_contract">
            <div class="normal"><%= image_tag asset_url("estimate_form/off-btn-current.png") %></div>
            <div class="invert"><%= image_tag asset_url("estimate_form/on-btn-current.png") %></div>
            <div><p class="pl-new">現在のお住まい</p></div>
          </label>
        </div>
        <div class="house-kind input-wrap remove-error error-wrap">
          <input type="radio" name="lpgas_contact[estimate_kind]" value="new_contract" id="new_contract">
          <label class="image-wrap hand-navi-label" for="new_contract">
            <div class="normal"><%= image_tag asset_url("estimate_form/off-btn-move.png") %></div>
            <div class="invert"><%= image_tag asset_url("estimate_form/on-btn-move.png") %></div>
            <div><p>引越し先</p></div>
          </label>
        </div>
      </div>
      <!-- KONTRACT KIND END -->

      <!-- OTHER KIND START -->
      <div class="other-kind-wrap">
        <%= link_to '戸建以外の方はこちら', '/lpgas_contacts/new_form', onclick: "ga('send', 'event', 'simulation-other-contract', 'btn-click', '', 0);" %>
      </div>
      <!-- OTHER KIND END -->

      <!-- GAS USAGE START -->
      <div class="gas-usage-wrap hidden-field">
        <div class="input-wrap2">
          <div class="label label-left">使用設備<span class="optional">(任意)</span></div>
          <div class="row-wrap">
            <div class="remove-error">
              <input type="checkbox" name="lpgas_contact[using_cooking_stove]" value="1" id="cooking_stove">
              <label for="cooking_stove">
                <div>
                  <%= image_tag asset_url("estimate_form/check-blue.png") %>
                </div>
                <span>ガスコンロ</span>
              </label>
            </div>
            <div class="remove-error">
              <input type="checkbox" name="lpgas_contact[using_bath_heater_with_gas_hot_water_supply]" value="1" id="bath_heater">
              <label for="bath_heater">
                <div>
                  <%= image_tag asset_url("estimate_form/check-blue.png") %>
                </div>
                <span>給湯器</span>
              </label>
            </div>
            <div class="remove-error">
              <input type="checkbox" name="lpgas_contact[using_other_gas_machine]" value="1" id="other_gas_machine">
              <label for="other_gas_machine">
                <div>
                  <%= image_tag asset_url("estimate_form/check-blue.png") %>
                </div>
                <span>ストーブその他</span>
              </label>
            </div>
          </div>
        </div>
      </div>
      <!-- GAS USAGE END -->

      <!-- GAS DETAIL START -->
      <div class="gas-detail-wrap hidden-field">
        <div class="gas-detail-input-wrap">
          <div class="input-wrap left-column month-left-column">
            <div class="label label-left">使用月</div>
            <div class="field-month"><%= @month %>月</div>
          </div>

          <div class="input-wrap error-wrap">
            <div class="label label-right">ガス会社名<span class="optional can-hide">(任意)</span></div>
            <div class="field-contracted-shop">
              <input type="text" name="lpgas_contact[gas_contracted_shop_name]" value="" placeholder="例) 株式会社えねぴ">
            </div>
          </div>
        </div>
      </div>
      <!-- GAS DETAIL END -->

      <!-- CONTACT NAME START -->
      <div class="contact-name-wrap hidden-field">
        <div class="input-wrap error-wrap left-column">
          <div class="label label-left">お名前</div>
          <div class="field-name">
            <input type="text" name="lpgas_contact[name]" value="" placeholder="例） 山田 太郎">
          </div>
        </div>
        <div class="input-wrap error-wrap">
          <div class="label label-right">ふりがな</div>
          <div class="field-name">
            <input type="text" name="lpgas_contact[furigana]" value="" placeholder="例） やまだ たろう">
          </div>
        </div>
      </div>
      <!-- CONTACT NAME END -->

      <!-- CONTACT DETAIL START -->
      <div class="contact-detail-wrap hidden-field">
        <div class="input-wrap error-wrap left-column">
          <div class="label label-left">電話番号</div>
          <div class="field-name">
            <input type="tel" name="lpgas_contact[tel]" value="" placeholder="例） 09001230123">
          </div>
        </div>
        <div class="input-wrap error-wrap">
          <div class="label label-right">メールアドレス</div>
          <div class="field-name">
            <input type="text" name="lpgas_contact[email]" value="" placeholder="例） info@enepi.jp">
          </div>
        </div>
      </div>
      <!-- CONTACT DETAIL END -->

      <div class="btn-wrap">
        <div class="simulation-page-button color-gray" id="contact_btn">
          <div class="simulation-page-button-itself">
            <div class="free-img img-hide"><%= image_tag asset_url("simulations/free-tooltip.png") %></div>
            <p>どちらかを選んでください</p>
          </div>
        </div>
      </div>
    <% end %>
  </div>
</div>
