<%= form_for [ns, @estimate] do |f| %>
  <% @root_form = f %>
  <table class="table table-striped table-hover" style="margin-bottom: 0">
    <tr>
      <th>基本料金</th>
      <td>
        <% if @estimate.pending? %>
          <%= f.currency_field :basic_price, required: true %>
        <% else %>
          <%= number_to_currency @estimate.basic_price %>
        <% end %>
      </td>
    </tr>
    <tr>
      <th>燃料調整費</th>
      <td>
        <% if @estimate.pending? %>
          <%= f.currency_field :fuel_adjustment_cost, {} %>/m3
        <% else %>
          <%= number_to_currency @estimate.fuel_adjustment_cost %>/m3
        <% end %>
      </td>
    </tr>
  </table>

  <% if @estimate.pending? %>
    <div id="unit_prices">
      <div class="fields">
        <div class="field"></div>
        <div class="field">
          <%= f.label :unit_price, "従量単価(円)" %>
        </div>
        <div class="field">
          <%= f.label :under_limit, "下限(m3)" %>
        </div>
        <div class="field">
          <%= f.label :upper_limit, "上限(m3)" %>
        </div>
        <div class="field"><%= link_to_add_association fa_text('plus', '追加'), f, :unit_prices, partial: 'shared/unit_price_fields', class: "btn btn-primary btn-xs cocoon-add" %></div>
      </div>

      <%= f.fields_for :unit_prices do |uf| %>
        <%= uf.hidden_field :id %>
        <%= render "shared/unit_price_fields", f: uf %>
      <% end %>
    </div>
  <% else %>
    <div id="unit_prices">
      <div class="fields">
        <div class="field"></div>
        <div class="field">
          <%= f.label :unit_price, "従量単価(円)" %>
        </div>
        <div class="field">
          <%= f.label :under_limit, "下限(m3)" %>
        </div>
        <div class="field">
          <%= f.label :upper_limit, "上限(m3)" %>
        </div>
        <div class="field"></div>
      </div>
      <%= f.fields_for :unit_prices do |uf| %>
        <%= render "shared/unit_price_fields", f: uf %>
      <% end %>
    </div>
  <% end %>

  <table class="table table-striped table-hover">
    <tr style="background-color: #FFF">
      <th>備考</th>
      <td>
        <% if @estimate.pending? %>
          <%= f.text_area :notes, rows: 3, cols: 100 %>
        <% else %>
          <%= newline_to_br @estimate.notes %>
        <% end %>
      </td>
    </tr>
    <tr style="background-color: #FFF">
      <th>機器・配管セットプラン</th>
      <td>
        <% if @estimate.pending? %>
          <%= f.text_area :set_plan, rows: 3, cols: 100 %>
        <% else %>
          <%= newline_to_br @estimate.set_plan %>
        <% end %>
      </td>
    </tr>
    <tr style="background-color: #FFF">
      <th>その他セットプラン</th>
      <td>
        <% if @estimate.pending? %>
          <%= f.text_area :other_set_plan, rows: 3, cols: 100 %>
        <% else %>
          <%= newline_to_br @estimate.other_set_plan %>
        <% end %>
      </td>
    </tr>
  </table>

  <% if @estimate.pending? %>
    <%= f.submit "送信", class: 'btn btn-block btn-primary', style: "width: 50%; margin: 2em auto" %>
  <% end %>
<% end %>
