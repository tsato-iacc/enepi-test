<div class="article_navigation_area">
  <div class="inner">
    <div class="mini-nav">
      <div class="category-ttl-tab">
        <div class="category_ttl"><span class="name">記事カテゴリ</span></div>
        <div class="category_ttl-sp"><span class="name">記事カテゴリ</span></div>
      </div>

      <div class="category-link-tab">
        <ul class="stickup">
          <li><?= MyView::link_to('節約術', "/categories/lpgas/saving") ?></li>
          <li><?= MyView::link_to('会社一覧', "/categories/lpgas/company_list") ?></li>
          <li><?= MyView::link_to('基礎知識', "/categories/lpgas/knowledge") ?></li>
          <li><?= MyView::link_to('見積もりのコツ', "/categories/lpgas/estimate") ?></li>
          <li><?= MyView::link_to('コラム',  "/categories/lpgas/column") ?></li>
          <li class="special"><?= MyView::link_to('すべての記事', "/articles") ?></li>
        </ul>
      </div>
    </div>
  </div>
</div>
