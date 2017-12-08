<div class="formula-box">
  <h3 class="title-formula">プロパンガス(LPガス)料金の算出方法</h3>
  <div class="formula-itself">
    ガス料金＝基本料金＋(従量単価×使用量)＋消費税
  </div>
  <p>※多くのプロパンガス会社で採用されている「二部料金制」を用いて算出</p>
</div>
<div class="explanation-of-calculation" style="background:#EEE8AA; padding:10px; border:1px solid #EEE8AA; border-radius:10px;">
  <h4 style="font-size: 18px; font-weight: bold;">各地域のプロパンガス料金はどうやって計算しているのか？</h4>
    <p style="font-size: 15px; font-weight: bold;">石油情報センターより提供される一般小売価格のプロパンガス情報を基に平均値を算出しております。各地域ごとに表示されるガスの料金には基本料金が含まれており、税込みの金額が表示されます。
    </p>
</div>
<?= MyView::link_to("Rails.application.config.form_path", ["class" => "estimate-link-button", "style" => "height: auto"]); { ?>
  <div class="estimate-link-button-text">
    <p>プロパンガスの切り替え見積もり依頼をする！</p>
  </div>
<? } ?>
<div class="social-recommends-area">
  <div class="image">
    <?= MyView::image_tag("japan-map.png", ["class" => "japan-map-img-small"]); ?>
  </div>
  <div class="text">
    <div class="recommend-ttl">この記事はいかがでしたか？</div>
    <div class="fb-like" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div>
    <p>この記事が役にたったり気にいったら、いいね！で友達にも勧めてみましょう</p>
  </div>
</div>
<?= render("shared/social_buttons") ?>

