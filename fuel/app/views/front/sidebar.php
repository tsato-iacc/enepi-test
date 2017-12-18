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

  <form method="GET" action="/new_simple_simulation_path">
    <div class="cta3">
      <div class="cta3-1-min">
        <span>＼ かんたん1分・もちろん無料 ／</span>
      </div>
      <h3 class="cta3-title">LPガス料金比較</h3>
      <div class="cta3-description">現在のガス料金が適正価格か<br>知りたい方は、今すぐ診断！</div>

      <div class="cta3-zip-form">
        <select name="prefecture_code" id="prefecture_code">
          <option class="provisional_label" selected>都道府県を選択してください</option>
          <option value="1">北海道</option>
          <option value="2">青森県</option>
          <option value="3">岩手県</option>
          <option value="4">宮城県</option>
          <option value="5">秋田県</option>
          <option value="6">山形県</option>
          <option value="7">福島県</option>
          <option value="8">茨城県</option>
          <option value="9">栃木県</option>
          <option value="10">群馬県</option>
          <option value="11">埼玉県</option>
          <option value="12">千葉県</option>
          <option value="13">東京都</option>
          <option value="14">神奈川県</option>
          <option value="15">新潟県</option>
          <option value="16">富山県</option>
          <option value="17">石川県</option>
          <option value="18">福井県</option>
          <option value="19">山梨県</option>
          <option value="20">長野県</option>
          <option value="21">岐阜県</option>
          <option value="22">静岡県</option>
          <option value="23">愛知県</option>
          <option value="24">三重県</option>
          <option value="25">滋賀県</option>
          <option value="26">京都府</option>
          <option value="27">大阪府</option>
          <option value="28">兵庫県</option>
          <option value="29">奈良県</option>
          <option value="30">和歌山県</option>
          <option value="31">鳥取県</option>
          <option value="32">島根県</option>
          <option value="33">岡山県</option>
          <option value="34">広島県</option>
          <option value="35">山口県</option>
          <option value="36">徳島県</option>
          <option value="37">香川県</option>
          <option value="38">愛媛県</option>
          <option value="39">高知県</option>
          <option value="40">福岡県</option>
          <option value="41">佐賀県</option>
          <option value="42">長崎県</option>
          <option value="43">熊本県</option>
          <option value="44">大分県</option>
          <option value="45">宮崎県</option>
          <option value="46">鹿児島県</option>
          <option value="47">沖縄県</option>
        </select>
        <input type="submit" value="診断" class="primary-button narrow">
      </div>
    </div>
  </form>

  <h3 class="mtclear"><?= MyView::image_tag("crown.png") ?> 人気記事ランキング</h3>
  <ul class="ranked">
    <?= render('front/articles/partial/list_items', ['articles' => $popular['articles'], 'mini' => true]); ?>
  </ul>
  <h3><?= MyView::image_tag("fav.png") ?> enepiおすすめ記事</h3>
  <ul>
    <?= render('front/articles/partial/list_items', ['articles' => $pickup['items'], 'mini' => true]); ?>
  </ul>

  <div class="align-content">
    <div><?= MyView::image_tag("merit-banner.png") ?></div>
    <div class="fb-page" data-href="https://www.facebook.com/enepijp" data-small-header="false" data-width="500" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/enepijp"><a href="https://www.facebook.com/enepijp">エネピ（enepi）</a></blockquote></div></div>
  </div>

</div>
