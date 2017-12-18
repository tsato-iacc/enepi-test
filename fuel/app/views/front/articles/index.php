<? use Fuel\Core\Pagination ?>
<?= render ("shared/mini_nav") ?>
<div class="panel-inner">
  <div class="article-mainview">
    <div class="image">
      <?= MyView::image_tag("img_articles_top.png") ?>
    </div>
    <div class="text">
      <h1>プロパンガスすべての記事</h1>
      <p>プロパンガス（LPガス）に関する、全ての記事ページです。コラムや節約など色々なジャンルをまとめて読みたい方はこちらのページからが便利です。</p>
      <p>プロパンガスにまつわる、様々な情報をご紹介します。</p>
    </div>
  </div>
</div>

<div class="panel-inner clearfix">
  <div class="article-list-v3-panel">
    <div class="panel-inner article-list-v3-panel-container">
      <div class="main">
        <h2><?= \Asset::img('categories/article.png'); ?>すべての記事一覧</h2>
        <ul>
          <?= render('front/articles/partial/list_items', ['articles' => $articles['articles'], 'mini' => false]); ?>
        </ul>
        <?= \Pagination::instance('default')->render(); ?>
      </div>
      <?= Presenter::Forge('front/sidebar'); ?>
    </div>
  </div>
</div>
