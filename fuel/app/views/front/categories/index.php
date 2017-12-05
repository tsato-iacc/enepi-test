<%= render 'shared/article_common', article: @category['article'], url: category_url(@category) %>

<div itemscope itemtype="http://schema.org/Article">
  <meta itemprop="datePublished" content="<?= $category['article']['created_at'] ?>">
  <meta itemprop="dateModified" content="<?= $category['article']['updated_at'] ?>">
  <meta itemprop="image" content="<?= $category['article']['thumbnail_url'] ?>">
  <%= render "shared/mini_nav" %>
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
        <?php foreach ($sub_categories as $cat): ?>
        
          <?php if ($cat['content']['articles']): ?>
            <h2><?= $cat['name'] ?> <span class="article-count">(記事数: <?= $cat['article_count'] ?>)</span></h2>
            <ul>
              <%= render(
                partial: 'front/articles/list_item',
                collection: cd_articles['articles'],
                as: :article,
                locals: {
                  mini: false
                })
                %>
              </ul>
              <div class="more_link">
                <%= link_to "もっと見る", category_article_path(cat) %>
              </div>
            <?php endif; ?>
          <?php endforeach; ?>

          <% if @articles['articles'].size > 0 %>
          <h2><%= image_tag("article.png") %><%= @category['name'] %>の新着記事 <span class="article-count">(記事数: <%= @category['article_count'] %>)</span></h2>
          <ul>
            <%= render(
              partial: 'front/articles/list_item',
              collection: @articles['articles'],
              as: :article,
              locals: {
                mini: false
              })
              %>
            </ul>

            <div class="more_link">
              <%= link_to "もっと見る", category_article_path(@category) %>
            </div>
            <% end %>
          </div>
          <%= render "shared/articles_sidebar" %>
        </div>
      </div>
    </div>

    <%# https://iacc.backlog.jp/view/RSD-1132 %>
    <%= content_for :tail do %>
    <% if @category['path_name_prog'] == 'lpgas/column' %>
    <%= render 'shared/yahoo_retargeting' %>
    <%= render 'shared/google_remarketing' %>
    <% end %>
    <% end %>
