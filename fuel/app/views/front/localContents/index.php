<?php
$smart_phone = false;
?>
<?= render('front/breadcrumb', ['breadcrumb' => $breadcrumb]); ?>

<div class="article-maintitle-area">
  <div class="inner">
    <div class="image">
      <?= MyView::image_tag("japan-map.png", ["class" => "japan-map-img-small"]) ?>
    </div>
    <div class="text">
      <h1 class="title" itemprop="headline">全国のプロパンガス(LPガス)の平均利用額はココでチェック!</h1>
      <ul class="categories">
        <li><i class="icon icon-tag"></i><?= MyView::link_to("LPガス/プロパンガス", "/categories/lpgas"); ?></li>
      </ul>
      <p class="description" itemprop="description">
        エネピ完全オリジナル！全国47都道府県のプロパンガス料金を調べることができます。石油情報センターより提供される金額を掛け合わせて算出しております。<br>
        ガス代が高いと感じている方は、このページで適正料金を調べて安いガス会社へ切り替えましょう！
      </p>
    </div>
  </div>
</div>
<div class="article-page">
  <div class="article">
    <div class="article-list-v3-panel">
      <div class="panel-inner article-list-v3-panel-container">
        <div class="main">
        <div class="local-content-middle">
          <?= render("shared/social_buttons") ?>
          <p class="local-content-middle-intro">プロパンガス料金は各業者によって自由に設定ができるため、価格がまちまちです。
        中にはぼったくりとも思われる悪徳業者も存在しますが、そもそも自分の家のガス代は高いのか安いのかが分からなくて困っている方も多いのではないでしょうか。
        そこでエネピではプロパンガスの平均利用額を独自で算出し、都道府県ごとに公開をしました。
        ぜひガス料金の見直しにご活用ください。</p>
          <div class="japan-map">
            <? if($smart_phone){ ?>
              <div class="japan-map-box-sh">
                <h3 class="title-price-info">【地域別プロパンガス料金情報】</h3>
                <?= render("shared/local_contents") ?>
              </div>
            <?}else{?>
              <h3 class="title-price-info">【地域別プロパンガス料金情報】</h3>
              <span class="description-of-map">お住まいの地域をクリックすると、地域別の料金ページが見れます</span>
              <div class="japan-map-background">
                <?= MyView::image_tag("japan-map.png", ["class" => "japan-map-img"]) ?>
                <div class="japan-map-box">
                  <?= render("shared/local_contents") ?>
                </div>
              </div>
            </div>
          <? } ?>
          <div class="popular-articles">
            <? View::set_global('result',$result); ?>
            <? View::set_global('code',$code); ?>
            <? View::set_global('prefecture_prev',$prefecture_prev); ?>
            <? View::set_global('prefecture_next',$prefecture_next); ?>
            <?= View::forge('front/local_contents_bottom_part',$result); ?>
          </div>
        </div>
        </div>
        <?= Presenter::Forge('front/sidebar'); ?>
      </div>
    </div>
  </div>
</div>
