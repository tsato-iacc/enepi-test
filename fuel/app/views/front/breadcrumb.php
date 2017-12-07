<div class="breadcrumb">
  <div class="container">
    <ol itemscope itemtype="http://schema.org/BreadcrumbList">
      <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
        <a itemprop="item" href="<?= \Uri::base(); ?>">トップ</a>
        <meta itemprop="position" content="1">
      </li>
      <?php foreach($breadcrumb as $k => $v): ?>
        <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
          <a itemprop="item" href="<?= $v['url']; ?>"> » <?= $v['name']; ?></a>
          <meta itemprop="position" content="<?= $k + 2 ?>">
        </li>
      <?php endforeach;?>
    </ol>
  </div>
</div>
