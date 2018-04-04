<div class="match-screen-notice">
  <div class="contract-header">
    <span class="modal-open-header">あなたへのお知らせ</span>
    <span class="modal-close-btn">×</span>
    <span class="modal-balloon"><?= \Asset::img('layout/notice_balloon.png'); ?></span>
  </div>
  
  <?php if (isset($match_screen_notice['economy'])): ?>
    <div class="contract-body">
      <a href="<?= \Uri::create('lpgas/contacts/:id', ['id' => $match_screen_notice['id']]).'?'.http_build_query(['conversion_id' => "LPGAS-{$match_screen_notice['id']}", 'token' => $match_screen_notice['token'], 'pin' => $match_screen_notice['pin']]); ?>">
        <?php if ($match_screen_notice['economy'] > 0): ?>
          <p>年間最大 <span class="price"><?= number_format($match_screen_notice['economy']); ?></span> 円</p>
          <p>節約のご提案があります</p>
        <?php else: ?>
          <p>あなたへのご提案内容を確認出来ます</p>
        <?php endif; ?>
      </a>
    </div>
    <div class="contract-footer">
      <a href="<?= \Uri::create('lpgas/contacts/:id', ['id' => $match_screen_notice['id']]).'?'.http_build_query(['conversion_id' => "LPGAS-{$match_screen_notice['id']}", 'token' => $match_screen_notice['token'], 'pin' => $match_screen_notice['pin']]); ?>">今すぐチェック!!&nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
    </div>
  <?php else: ?>
    <div class="contract-body">
      <a href="<?= \Uri::create('lpgas/contacts/:id', ['id' => $match_screen_notice['id']]).'?'.http_build_query(['conversion_id' => "LPGAS-{$match_screen_notice['id']}", 'token' => $match_screen_notice['token']]); ?>">
        <p>あなたへのご提案内容を確認出来ます</p>
      </a>
    </div>
    <div class="contract-footer">
      <a href="<?= \Uri::create('lpgas/contacts/:id', ['id' => $match_screen_notice['id']]).'?'.http_build_query(['conversion_id' => "LPGAS-{$match_screen_notice['id']}", 'token' => $match_screen_notice['token']]); ?>">今すぐチェック!!&nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
    </div>
  <?php endif; ?>

</div>
