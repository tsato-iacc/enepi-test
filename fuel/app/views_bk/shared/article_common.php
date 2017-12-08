<% title article['meta_title'] %>
<% description article['meta_description'] %>
<% keywords article['meta_keywords'] %>
<% if article['meta_robots'].present? %>
  <% set_meta_tags robots: article['meta_robots'] %>
<% end %>

<% ogp :type, :article %>
<% ogp :title, article['meta_title'] %>
<% ogp :description, article['meta_description'] %>
<% ogp :image, article['thumbnail_url'] %>
<% ogp :url, url %>

<%= content_for :head do %>
  <style>
    <%= raw article['body_style'] %>
  </style>
<% end %>
