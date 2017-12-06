<%= render 'shared/article_common', article: @article, url: article_url(@article['id']) %>

<div itemscope itemtype="http://schema.org/Article">
<meta itemprop="datePublished" content="<?= $article['created_at'] ?>">
<meta itemprop="dateModified" content="<?= $article['updated_at'] ?>">
<meta itemprop="image" content="<?= $article['thumbnail_url'] ?>">

<div class="article-maintitle-area">
  <div class="inner">
    <div class="image">
      <img src="<?= $article['thumbnail_cover_256_url']; ?>" alt="<?= $article['title']; ?>">
    </div>
    <div class="text">
      <h1 class="title" itemprop="headline"><?= $article['title'] ?></h1>
      <ul class="categories">
        <?php foreach($article['categories'] as $category): ?>
          <li><i class="icon icon-tag"></i>
            <a href="<?= \Uri::create('categories/:prog', ['prog' => implode('/', \Arr::pluck($category['full'], 'name_prog'))]); ?>"><?= implode('/', \Arr::pluck($category['full'], 'name')); ?></a>
          </li>
        <?php endforeach; ?>
      </ul>
      <p class="description" itemprop="description"><?= $article['description'] ?></p>
    </div>
  </div>
</div>

<div class="article-page">
  <div class="article">
    <div class="article-list-v3-panel">
      <div class="panel-inner article-list-v3-panel-container">
        <div class="main">
          <%= render "shared/social_buttons" %>

        <div class="toc">
          <p class="toc-title accordion">この記事の目次</p>
          <div class="accordion-box">
            <?= $article['toc_html'] ?>
          </div>
        </div>

        <div class="body" itemprop="articleBody">
          <?= $article['body_html'] ?>
        </div>

        <div class="social-recommends-area">
          <div class="image">
            <img src="<?= $article['thumbnail_cover_256_url']; ?>" alt="<?= $article['title']; ?>">
          </div>
          <div class="text">
            <div class="recommend-ttl">この記事はいかがでしたか？</div>
            <div class="fb-like" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div>
            <p>この記事が役にたったり気にいったら、いいね！で友達にも勧めてみましょう</p>
          </div>
        </div>

        <%= render "shared/social_buttons" %>

        <?php if ($article['prev_article'] || $article['next_article']): ?>
          <div class="around_articles">
            <div class="prev">
              <?php if ($article['prev_article']): ?>
                <span>前の記事</span> <a href="<?= \Uri::create("articles/{$article['prev_article']['id']}") ?>"><?= $article['prev_article']['title'] ?></a>
              <?php endif; ?>
            </div>

            <div class="next">
              <?php if ($article['next_article']): ?>
                <span>次の記事</span> <a href="<?= \Uri::create("articles/{$article['next_article']['id']}") ?>"><?= $article['next_article']['title'] ?></a>
              <?php endif; ?>
            </div>
          </div>
        <?php endif; ?>

        <?php if (count($article['related_to_articles'])): ?>
          <h2 class="page-title">この記事と関連する記事</h2>
          <div class="article-list">
            <ul>
              <?= render('front/articles/partial/list_items', ['articles' => $article['related_to_articles'], 'mini' => true]); ?>
            </ul>
          </div>
        <?php endif; ?>

        </div>
        <?php $view = View::forge('front/sidebar', ['pickup' => $pickup]); ?>
        <?= Presenter::Forge('front/sidebar', 'popular', null, $view); ?>
      </div>
    </div>
  </div>
</div>

<%# https://iacc.backlog.jp/view/RSD-1132 %>
<%= content_for :tail do %>
<% if @article['categories'].map { |cate| cate['path_name_prog'] }.include?('lpgas/column') %>
<%= render 'shared/yahoo_retargeting' %>
<%= render 'shared/google_remarketing' %>
<% end %>
<% end %>
