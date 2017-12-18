<?= render('front/breadcrumb', ['breadcrumb' => $breadcrumb]); ?>


<div class="panel-inner" style="margin-top: 30px;" >
  <div class="article-mainview">
    <div  class="image">
      <img alt="<?= $category['name'] ?>のイメージ画像" src="<?= $category['article']['thumbnail_url'] ?>">
    </div>
    <div class="text">
      <h1><?= $category['article']['title'] ?></h1>
      <p><?= $category['article']['description'] ?></p>
    </div>
  </div>
</div>

<div class="panel-inner clearfix">
  <div class="article-list-v3-panel">
    <div class="panel-inner article-list-v3-panel-container">
      <div class="main">
        <h2><?= $category['name'] ?>の新着記事</h2>
        <ul>
          <?= render('front/articles/partial/list_items', ['articles' => $articles['articles'], 'mini' => false]); ?>
        </ul>
        <?= \Pagination::instance('')->render(); ?>
      </div>
      <?= Presenter::Forge('front/sidebar', 'category'); ?>
    </div>
  </div>
</div>
