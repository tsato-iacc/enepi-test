<?= render partial: "front/electricity/panel", locals: {kind: :top} ?>

<div class="panel">
  <div class="panel-inner">
    <h2 class="long">電力自由化で何ができるようになるの？</h2>
    <div class="electricity-catch">
      <p>
        2016年4月から、電力自由化が始まりました。<br>
        これまでは、契約する電力会社は住んでいる地域によって決まっていましたが、これからは他地域の電力会社や他のサービスを展開している新電力を選択することもできるようになりました。
        多様な料金プランや、携帯・ガスなどとのセット割、ポイント還元などの割引プランを比較して、ライフスタイルにあうものを選ぶことで、電気代を節約できるかもしれません。<br>
        また、料金以外にも、再生可能エネルギーによる発電を行う電力会社や、サポート・契約のわかりやすさなどを比較して、ぴったりの電力会社を見つけることができます。
        <br><br>
        電気料金比較サービス【enepi】は電気料金シミュレーションにより、ライフスタイルにあうプランを探すことができます。
      </p>
      <?= MyView::image_tag(asset_url("select-electricity.png") ?>
    </div>
  </div>
</div>
<div class="panel-r">
  <div class="panel-inner-middle">
    <h2 class="long">電力自由化で多様な生活スタイルを</h2>

    <div class="merit-grid-list">
      <ul>
        <li>
          <div class="image">
            <?= image_tag("electricity-merit-clock.png") ?>
          </div>
          <p>電力を使用する時間帯などに、プランを最適化することで、電気代の無駄が無くなります。</p>
        </li>
        <li>
          <div class="image">
            <?= image_tag("electricity-merit-house.png") ?>
          </div>
          <p>地産地消、電源構成、再生可能エネルギーなど、自分の価値観やライフスタイルにあった電力会社、プランを選択できます。</p>
        </li>
        <li>
          <div class="image">
            <?= image_tag("electricity-merit-set.png") ?>
          </div>
          <p>携帯・ガスなどと組み合わせたセット割や各社のポイント還元などを選んで、料金の割引を受けられます。</p>
        </li>
        <li>
          <div class="image">
            <?= image_tag("electricity-merit-present.png") ?>
          </div>
          <p>料金比較だけでなく、サポート体制や特典、契約期間などに注目することで、各社の個性的な特典も比較できます。</p>
        </li>
      </ul>
    </div>
  </div>
</div>

<div class="article-list-v2-panel">
  <div class="panel-inner article-list-v2-panel-container">
    <ul>
      <?= render(
        partial: 'front/articles/list_item',
        collection: @news['articles'],
        as: :article,
        locals: {
          mini: false
        })
      ?>
    </ul>
    <div class="sidebar">
      <h3><?= image_tag("crown.png") ?> 人気記事ランキング</h3>
      <ul class="ranked">
        <?= render(
          partial: 'front/articles/list_item',
          collection: @populars['articles'],
          as: :article,
          locals: {
            mini: true
          })
        ?>
      </ul>

      <h3><?= image_tag("fav.png") ?> enepiおすすめ記事</h3>
      <ul>
        <? if pickup_articles_module_type(CMS_ELECTRICITY) ?>
          <?= render(
            partial: 'front/articles/list_item',
            collection: pickup_articles_module_type(CMS_ELECTRICITY)['items'],
            as: :article,
            locals: {
              mini: true
            })
          ?>
        <? } ?>
      </ul>

      <?= MyView::image_tag(asset_url("merit-banner.png") ?>

      <div class="fb-page" data-href="https://www.facebook.com/enepijp" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/enepijp"><a href="https://www.facebook.com/enepijp">エネピ（enepi）</a></blockquote></div></div>
    </div>
  </div>
  <div class="more_link">
    <?= MyView::link_to("電気に関する記事を詳しくみる", category_path(CMS_ELECTRICITY) ?>
  </div>
</div>

<?= render partial: "front/electricity/panel", locals: {kind: :bottom} ?>
