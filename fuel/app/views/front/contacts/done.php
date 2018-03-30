<div class="contact-done">
  <div class="done-header">
    <div>
      <h1>ご登録ありがとうございました。</h1>
    </div>
    <div>
      <p>担当者(下記番号)より折り返しご連絡致しますので、今しばらくお待ち頂けますようお願い申し上げます。</p>
      <p class="comment">※いきなりガス業者から電話がかかってくることはございません。</p>
    </div>
    <div class="tel-wrap">
      <?php if (\Uri::segment(1) == 'kakaku'): ?>
        <?= Asset::img('done/tel_kakaku.png', ['alt' => \Config::get('enepi.service.name')]); ?>
      <?php else: ?>
        <?= Asset::img('done/tel.png', ['alt' => \Config::get('enepi.service.name')]); ?>
      <?php endif; ?>
    </div>
  </div>
</div>
