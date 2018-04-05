<?php if ($is_mobile): ?>
  <div class="match-screen-notice-sp">
    <div class="notice-wrap shake-rotate">
      <?php if (isset($match_screen_notice['economy']) && $match_screen_notice['economy'] > 0): ?>
        <span class="count"><?= $match_screen_notice['count']; ?></span>
      <?php endif; ?>
      <a href="<?= $match_screen_notice['url']; ?>">
        <?= \Asset::img('layout/notice_balloon_sp.png'); ?>
      </a>
    </div>
  </div>
<?php else: ?>
  <div class="match-screen-notice-pc">
    <div class="contract-header">
      <span class="modal-open-header">あなたへのお知らせ</span>
      <span class="modal-close-btn">×</span>
      <span class="modal-balloon"><?= \Asset::img('layout/notice_balloon.png'); ?></span>
    </div>
    
    <div class="contract-body">
      <a href="<?= $match_screen_notice['url']; ?>">
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
      <a href="<?= $match_screen_notice['url']; ?>">今すぐチェック!!&nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
    </div>
  </div>
<?php endif; ?>
