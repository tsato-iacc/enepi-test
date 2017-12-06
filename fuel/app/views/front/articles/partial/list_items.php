<?php foreach ($articles as $article): ?>
  <li class="article">
    <div class="image">
      <img src="<?= $article['thumbnail_cover_256_url']; ?>" alt="<?= $article['title']; ?>">
    </div>
    <div class="text">
      <h3 class="title<?= $mini ? ' mini' : '' ?>">
        <a href="<?= isset($article['url']) ? $article['url'] : \Uri::create("articles/{$article['id']}") ?>" data-block_link=".article"><?= $article['title']; ?></a>
      </h3>
      <?php if (!$mini): ?>
        <p class="description"><?= $article['description'] ?></p>
      <?php endif; ?>
    </div>
  </li>
<?php endforeach; ?>
