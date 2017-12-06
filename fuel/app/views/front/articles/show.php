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
      <h1 class="title" itemprop="headline"><%= @article['title'] %></h1>
      <ul class="categories">
        <% @article['categories'].each do |category| %>
        <li><i class="icon icon-tag"></i><%= link_to category['full'].map { |c| c['name'] }.join("/"), category_path(category) %></li>
        <% end %>
      </ul>
      <p class="description" itemprop="description">
          <?= $article['description'] ?></p>
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
                <span>前の記事</span> <%= link_to article_path(@article['prev_article']['id']) do %>
                  <?= $article['prev_article']['title'] ?>
                <% end %>
              <?php endif; ?>
            </div>

            <div class="next">
              <?php if ($article['next_article']): ?>
                <span>次の記事</span> <%= link_to article_path(@article['next_article']['id']) do %>
                  <?= $article['next_article']['title'] ?>
                <% end %>
              <?php endif; ?>
            </div>
          </div>
        <?php endif; ?>

        <% if @article['related_to_articles'].size > 0 %>
            <h2 class="page-title">この記事と関連する記事</h2>
            <div class="article-list">
              <ul>
                <% @article['related_to_articles'].each do |article| %>
                  <%= render 'front/articles/list_item', article: article, mini: true %>
                <% end %>
              </ul>
            </div>
        <% end %>

        </div>
        <%= render "shared/articles_sidebar" %>
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
