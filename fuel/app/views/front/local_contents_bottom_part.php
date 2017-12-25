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

<a class="estimate-link-button" style="height: auto" href="/lpgas_contacts/new_form">
  <div class="estimate-link-button-text">
    <p>プロパンガスの切り替え見積もり依頼をする！</p>
  </div>
</a>

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

<div class="popular-articles">
  <h2 class="popular-article-titles">このページに関連する記事一覧</h2>
  <div class="article-list">
    <ul>
      <?//= render('front/articles/partial/list_items', ['articles' => $result['articles'], 'mini' => true]); ?>


    <li class="article">
      <div class="image">
        <img src="/assets/images/area_contents.png" alt="Area contents" />
      </div>
      <div class="text">
        <h3 class="title mini">
          <a data-block-link=".article" href="/simple_simulations/new">いくら安くなる？プロパンガス料金の無料シミュレーション</a>
        </h3>
      </div>
    </li>
    <li class="article">
      <div class="image">
        <img src="/assets/images/japan-map.png" alt="Japan map" />
      </div>
      <div class="text">
        <h3 class="title mini">
          <a data-block-link=".article" href="/local_contents">適正価格をチェック！都道府県別プロパンガス料金検索</a>
        </h3>
      </div>
    </li>
    <? foreach($result as $value){ ?>
        <li class="article">
          <div class="image">
            <img src="<?= $value['thumbnail_cover_256_url'] ?>" />
          </div>
          <div class="text">
            <h3 class="title mini">
              <a data-block-link=".article" href="/articles/<?= $value['id'] ?>"><?= $value['title'] ?></a>
            </h3>
          </div>
        </li>
    <? } ?>
    </ul>
  </div>
</div>
