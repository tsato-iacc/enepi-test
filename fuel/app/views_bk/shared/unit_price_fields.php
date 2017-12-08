<div class="nested-fields">
  <div class="field"></div>
  <div class="field">
    <%= f.currency_field :unit_price, required: true, readonly: !@estimate.pending? %>
  </div>
  <div class="field">
    <%= f.number_field :under_limit, required: true, tabindex: -1, readonly: !@estimate.pending? %>
  </div>
  <div class="field">
    <%= f.number_field :upper_limit, readonly: !@estimate.pending? %>
  </div>
  <div class="field">
    <%= link_to_remove_association fa_text("trash", "削除"), f, class: "btn btn-danger btn-xs cocoon-remove" if @estimate.pending? %>
  </div>
</div>
