<header>
  <div class="container-wrap">
    <div class="logo-wrap pos-left">
      <div class="logo">
        <div><a href="<?= \Uri::base(); ?>"><?= Asset::img('layout/logo.png'); ?></a></div>
      </div>
    </div>

    
    <div class="navi-wrap">
      <?php if (\Uri::segment(2) != 'new_form'): ?>
        <div class="navi">
          <a href="/simple_simulations/new" class="<?= \Uri::segment(1) == 'simple_simulations' ? ' active' : ''?>">ガス料金<br>シミュレーション</a>
        </div>
        <div class="navi">
          <a href="/local_contents" class="<?= \Uri::segment(1) == 'local_contents' ? ' active' : ''?>">地域別<br>ガス料金検索</a>
        </div>
        <div class="navi">
          <a href="/categories/lpgas" class="<?= \Uri::segment(1) == 'categories' && \Uri::segment(2) == 'lpgas' ? ' active' : ''?>">プロパンガス<br>(LPガス)記事一覧</a>
        </div>
      <?php endif; ?>
    </div>
    
    <div class="logo-wrap pos-right">
      <div class="enepi-tel">
        <?php if ($is_mobile): ?>
          <div>
            <a href="tel:<?= \Config::get('enepi.service.tel'); ?>">
              <?= Asset::img('layout/enepi_tel.png', ['alt' => 'Enepi']); ?>
            </a>
          </div>
        <?php else: ?>
          <div><?= Asset::img('layout/enepi_tel.png', ['alt' => 'Enepi']); ?></div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</header>
