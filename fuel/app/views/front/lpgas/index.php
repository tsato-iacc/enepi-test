<?= render "front/lpgas/panel" ?>

<div class="panel">
  <div class="panel-inner">
    <h2 class="long">ガス料金、気付いたら値上りしてませんか？</h2>
    <div class="lpgas-strange-price-up">
      <p>
        LPガス（プロパンガス）は、小売自由化されており、2万社を超えるLPガス販売会社が自由料金で、販売・供給しています。<br>
        そのため、ガス会社によって、ガスの価格は全く異なり、中には、頻繁にガス料金を値上げするガス会社もあるため、気づかないうちに高いガス料金を支払い続けてしまっていることもあります。enepiでは、ガス料金を比較することで、より安い会社を見つけることができます。
      </p>
      <?= MyView::image_tag(asset_url("strange-price-up.png") ?>
    </div>
  </div>
</div>
<div class="panel-r">
  <div class="panel-inner-middle">
    <h2 class="long">enepiでガス料金比較をする4つのメリット</h2>

    <div class="merit-grid-list">
      <ul>
        <li>
          <div class="image">
            <?= image_tag("lpgas-merit-compare.png") ?>
          </div>
          <p>ガス料金を複数のガス会社と比較することで、現在の料金を値下げできます。</p>
        </li>
        <li>
          <div class="image">
            <?= image_tag("lpgas-merit-cs.png") ?>
          </div>
          <p>enepiは、カスタマーサポートによる完全個別対応！複数のガス会社から見積もりを受け取り、お客様にご納得いただける意思決定をしていただくまで様々なご相談に親身にお受けしています。</p>
        </li>
        <li>
          <div class="image">
            <?= image_tag("lpgas-merit-check.png") ?>
          </div>
          <p>加盟しているLPガス（プロパンガス）会社は厳しい審査基準をクリアした会社のみで安心！enepiでご紹介するガス会社は理不尽な値上げはされません。</p>
        </li>
        <li>
          <div class="image">
            <?= image_tag("lpgas-merit-set.png") ?>
          </div>
          <p>電気とのセット割や、多様な会員サービスなどの、各会社の様々なプランを検討した上で選択できます。</p>
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
      <h3>人気記事ランキング</h3>
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

      <h3>enepiおすすめ記事</h3>
        <ul>
          <? if pickup_articles_module_type(CMS_LPGAS) ?>
            <?= render(
              partial: 'front/articles/list_item',
              collection: pickup_articles_module_type(CMS_LPGAS)['items'],
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
    <?= MyView::link_to("LPガスに関する記事を詳しくみる", category_path(CMS_LPGAS) ?>
  </div>
</div>

<?= render "front/lpgas/panel" ?>
