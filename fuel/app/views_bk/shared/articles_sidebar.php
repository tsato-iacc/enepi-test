<div class="sidebar mtclear">

  <script>
    (function() {
      var cx = '001327874523604773855:q4sz2gsare8';
      var gcse = document.createElement('script');
      gcse.type = 'text/javascript';
      gcse.async = true;
      gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
      var s = document.getElementsByTagName('script')[0];
      s.parentNode.insertBefore(gcse, s);
    })();
  </script>
  <div id="gsc">
  <gcse:search></gcse:search>
  </div>

  <form method="GET" action="<%= new_simple_simulation_path %>">
    <div class="cta3">
      <div class="cta3-1-min">
        <span>＼ かんたん1分・もちろん無料 ／</span>
      </div>
      <h3 class="cta3-title">LPガス料金比較</h3>
      <div class="cta3-description">現在のガス料金が適正価格か<br>知りたい方は、今すぐ診断！</div>

      <div class="cta3-zip-form">
        <%= select_tag :prefecture_code, options_from_collection_for_select(JpPrefecture::Prefecture.all, :code, :name), include_blank: '都道府県を選択してください' %>
        <input type="submit" value="診断" class="primary-button narrow">
      </div>
    </div>
  </form>

  <h3 class="mtclear"><%= image_tag("crown.png") %> 人気記事ランキング</h3>
  <ul class="ranked">
    <%= render(
      partial: 'front/articles/list_item',
      collection: @populars['articles'],
      as: :article,
      locals: {
        mini: true
      })
    %>
  </ul>
  <h3><%= image_tag("fav.png") %> enepiおすすめ記事</h3>
  <ul>
    <%= render(
      partial: 'front/articles/list_item',
      collection: @pickup['articles'],
      as: :article,
      locals: {
        mini: true
      })
    %>
  </ul>

  <div class="align-content">
    <div><%= image_tag asset_url("merit-banner.png") %></div>
    <div class="fb-page" data-href="https://www.facebook.com/enepijp" data-small-header="false" data-width="500" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/enepijp"><a href="https://www.facebook.com/enepijp">エネピ（enepi）</a></blockquote></div></div>
  </div>

</div>