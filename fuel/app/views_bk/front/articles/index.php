<%= render "shared/mini_nav" %>
<div class="panel-inner">
  <div class="article-mainview">
    <div class="image">
      <%= image_tag("img_articles_top.png") %>
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
        <h2><%= image_tag("article.png") %>すべての記事一覧</h2>
        <ul>
        <% @articles['articles'].each do |article| %>
          <%= render 'front/articles/list_item', article: article, mini: false %>
        <% end %>
        <%= render "shared/articles_pager" %>
        </ul>
      </div>
      <%= render "shared/articles_sidebar" %>
    </div>
  </div>
</div>
