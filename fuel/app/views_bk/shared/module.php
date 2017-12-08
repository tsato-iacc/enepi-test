<div class="side-item pickup">
  <div class="heading">
    <h2 class="name"><%= mod['name'] %></h2>
    <span class="description"><%= mod['description'] %></span>
  </div>
  <ol class="articles article-list content">
    <% if mod['module_type'] == 'article' %>
      <%= render(
        partial: 'front/articles/list_item',
        collection: mod['items'],
        as: :article,
        locals: {
          mini: true
        })
      %>
    <% elsif mod['module_type'] == 'category' %>
      <%= render(
        partial: 'front/categories/list_item',
        collection: mod['items'],
        as: :category,
        locals: {
          mini: true
        })
      %>
    <% end %>
  </ol>
</div>
