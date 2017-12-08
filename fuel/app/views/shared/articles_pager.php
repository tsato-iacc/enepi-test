<div class="pager">
  <? if @articles['prev_page'] ?>
    <? if @category ?>
      <?= MyView::link_to("前へ", category_article_path(@category, page: @articles['prev_page']), rel: 'prev' ?>
    <? else ?>
      <?= MyView::link_to("前へ", articles_path(page: @articles['prev_page']), rel: 'prev' ?>
    <? } ?>
  <? } ?>

  <? @articles['total_pages'].times { |n| ?>
    <? if n + 1 == @articles['current_page'] ?>
      <span class="current page-link"><?= n + 1 ?></span>
    <? elsif n == @articles['current_page'] ?>
      <?if @category ?>
        <?= MyView::link_to(n + 1, category_article_path(@category, page: n + 1), ["class" => 'page-link', rel: 'prev' ?>
      <? else ?>
        <?= MyView::link_to(n + 1, articles_path(page: n + 1), ["class" => 'page-link' ?>
      <? } ?>
    <? elsif n + 2 == @articles['current_page'] ?>
      <?if @category ?>
        <?= MyView::link_to(n + 1, category_article_path(@category, page: n + 1), ["class" => 'page-link', rel: 'next' ?>
      <? else ?>
        <?= MyView::link_to(n + 1, articles_path(page: n + 1), ["class" => 'page-link' ?>
      <? } ?>
    <? else ?>
      <?if @category ?>
        <?= MyView::link_to(n + 1, category_article_path(@category, page: n + 1), ["class" => 'page-link' ?>
      <? else ?>
        <?= MyView::link_to(n + 1, articles_path(page: n + 1), ["class" => 'page-link' ?>
      <? } ?>
    <? } ?>
  <? } ?>

  <? if @articles['next_page'] ?>
    <? if @category ?>
      <?= MyView::link_to("次へ", category_article_path(@category, page: @articles['next_page']), rel: 'next' ?>
    <? else ?>
      <?= MyView::link_to("次へ", articles_path(page: @articles['next_page']), rel: 'next' ?>
    <? } ?>
  <? } ?>
</div>
