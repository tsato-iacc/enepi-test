<!-- NOTICE SP START -->
<div class="match-screen-notice-sp notice-invisible">
  <div class="notice-wrap shake-rotate">
    <span class="count"><?= $match_screen_notice['count']; ?></span>
    <a href="<?= $match_screen_notice['url']; ?>" onclick="caevent('右下サジェスト', {ch:'63912289'});">
      <?= \Asset::img('layout/notice_balloon_sp.png'); ?>
    </a>
  </div>
</div>
<!-- NOTICE SP END -->

<!-- NOTICE PC START -->
<div class="match-screen-notice-pc">
  <div class="contract-header">
    <span class="modal-open-header">あなたへのお知らせ</span>
    <span class="modal-close-btn">×</span>
    <span class="modal-balloon"><?= \Asset::img('layout/notice_balloon.png'); ?></span>
  </div>
  
  <div class="contract-body">
    <a href="<?= $match_screen_notice['url']; ?>" onclick="caevent('右下サジェスト', {ch:'63912289'});">
      <?php if (isset($match_screen_notice['economy']) && $match_screen_notice['economy'] > 0): ?>
        <p>年間最大 <span class="price"><?= number_format($match_screen_notice['economy']); ?></span> 円</p>
        <p>節約のご提案があります</p>
      <?php else: ?>
        <p>あなたへのご提案内容を</p>
        <p>確認出来ます</p>
      <?php endif; ?>
    </a>
  </div>
  <div class="contract-footer">
    <a href="<?= $match_screen_notice['url']; ?>" onclick="caevent('右下サジェスト', {ch:'63912289'});">今すぐチェック!!&nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
  </div>
</div>
<!-- NOTICE PC END -->
