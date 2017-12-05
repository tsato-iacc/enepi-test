<div class="panel-inner" style="margin-top: 30px;" >
  <div class="article-mainview">
    <div  class="image">
      <img alt="<%= @category['name'] %>のイメージ画像" src="<%= @category['article']['thumbnail_url'] %>">
    </div>
    <div class="text">
      <h1><%= @category['article']['title'] %></h1>
      <p><%= @category['article']['description'] %></p>
    </div>
  </div>
</div>

<div class="panel-inner clearfix">
  <div class="article-list-v3-panel">
    <div class="panel-inner article-list-v3-panel-container">
      <div class="main">
        <!--<% if @category_dancestors.count > 0 %>
          <ul class="dancestors">
            <% @category_dancestors.each do |category| %>
              <li><%= link_to category['name'], category_path(category['path_name_prog']) %></li>
            <% end %>
          </ul>
        <% end %>-->

        <h2><%= @category['name'] %>の新着記事</h2>
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
        <%= render "shared/articles_pager" %>
      </div>
        <%= render "shared/articles_sidebar" %>
      </div>
    </div>
  </div>
</div>
<?= \Pagination::instance()->render() ?>
