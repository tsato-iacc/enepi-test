<% if from_kakaku? && smart_phone? %>
  <script src="//assets.adobedtm.com/3687940b53f7a560587a33c8bb748b9253ff5ea9/satelliteLib-2baf9a6b9fae7a21c0cfb818c33122e38669f89d.js"></script>
<% elsif from_kakaku? %>
  <script src="//assets.adobedtm.com/3687940b53f7a560587a33c8bb748b9253ff5ea9/satelliteLib-29577dfd7f420978cd93f3d1b2d6ee3a7d40cf53.js"></script>
<% end %>

<% title "エネピ -  お見積もりの問い合わせ完了" %>

<div class="skinny">

  <% if !(from_kakaku? || from_enechange?) %>
    <div class="step-container">
      <%= image_tag "estimate_presentation/new_step_img_02.png", class: 'lpgas-form-step-image' %>
    </div>
  <% end %>

  <h2 class="page-title center">お問い合わせが完了しました</h2>

  <div class="thanks center">
    <p>
      この度は、お問合せいただきありがとうございます。<br>
      <br>
      お問合せ頂いた内容につきましては3営業日以内に担当者より折り返しご連絡致しますので、<br>
      今しばらくお待ち頂けますようお願い申し上げます。
    </p>

    <% if from_kakaku? %>
      <p>
        ご不明な点などありましたら、下記連絡先までお問い合わせください。<br>
      </p>
      <div style="margin-bottom: 20px">
        <%= image_tag("kakaku/tel.png") %>
      </div>
      <p>
        株式会社カカクコムではお答えできかねますので、ご了承ください。
      </p>
    <% end %>

    <% if from_kakaku? %>
      <%= link_to 'enepiヘ', 'https://enepi.jp', class: 'submit' %>
    <% else %>
      <%= link_to 'ホームへ戻る', root_path, class: 'submit' %>
    <% end %>
  </div>

  <% if !@contact.sent_auto_estimate_req? %>
    <%= content_for :tail do %>
      <% render "cv_tags", contact: @contact, cv_point: :cv_point_done_estimate %>
    <% end %>
  <% end %>
</div>

<% if from_kakaku? %>
  <script type="text/javascript">
      if(typeof _satellite !== "undefined"){
          _satellite.pageBottom();
      }
  </script>
<% end %>

<script src="https://ca.iacc.tokyo/js/ca.js"></script>
<script>
cacv('見積もり完了(手動送客)', {ch:'63912289', link:'<%= @contact.id %>', tel:'<%= @contact.tel %>', name:'<%= @contact.name %>', mail:'<%= @contact.email %>', zip:'<%= @contact.zip_code %>', address:'<%= @contact.address %>'});
</script>

