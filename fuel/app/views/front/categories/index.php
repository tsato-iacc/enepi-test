<?= render('front/breadcrumb', ['breadcrumb' => $breadcrumb]); ?>

<div itemscope itemtype="http://schema.org/Article">
  <meta itemprop="datePublished" content="<?= $category['article']['created_at'] ?>">
  <meta itemprop="dateModified" content="<?= $category['article']['updated_at'] ?>">
  <meta itemprop="image" content="<?= $category['article']['thumbnail_url'] ?>">

  <?= render ("shared/mini_nav") ?>

  <div class="panel-inner">
    <div class="article-mainview">
      <div  class="image">
        <img alt="<?= $category['name'] ?>のイメージ画像" src="<?= $category['article']['thumbnail_url'] ?>">
      </div>
      <div class="text">
        <h1 itemprop="headline"><?= $category['article']['title'] ?></h1>
        <p itemprop="description">
          <?= $category['article']['description'] ?>
        </p>
      </div>
    </div>
  </div>

<div class="panel-inner clearfix">
  <div class="article-list-v3-panel">
    <div class="panel-inner article-list-v3-panel-container">
      <div class="main">
        <?php foreach ($category_content as $cat): ?>

          <?php if ($cat['content']['articles']): ?>
            <h2><?= $cat['name'] ?> <span class="article-count">(記事数: <?= $cat['article_count'] ?>)</span></h2>
            <ul>
              <?= render('front/articles/partial/list_items', ['articles' => $cat['content']['articles'], 'mini' => false]); ?>
            </ul>
            <div class="more_link">
              <?= MyView::link_to("もっと見る", $cat["path_name_prog"]) ?>
            </div>
          <?php endif; ?>
        <?php endforeach; ?>

        <?php if ($articles['articles']): ?>
          <h2><?= \Asset::img('categories/article.png'); ?><?= $category['name'] ?>の新着記事 <span class="article-count">(記事数: <?= $category['article_count'] ?>)</span></h2>
          <ul>
            <?= render('front/articles/partial/list_items', ['articles' => $articles['articles'], 'mini' => false]); ?>
          </ul>

          <div class="more_link">
            <?=  MyView::link_to("もっと見る", $category["path_name_prog"]."/articles") ?>
          </div>
        <?php endif; ?>
      </div>
      <?= Presenter::Forge('front/sidebar', 'category'); ?>
    </div>
  </div>
</div>
