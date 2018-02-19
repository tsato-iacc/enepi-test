<? if($is_mobile){ ?>

  <header>
    <div class="container" style="max-width: 1296px;">
      <div class="logo-wrapper">
        <a <?= MyView::link_to('/', ["class" => "logo logo-position"]); ?> >
          <span>エネピ</span>
        </a>
        <a href="tel:0120771664">
          <span class="tel-link-img-sp">
            <?= MyView::image_tag("estimate_presentation/img_tel.png", ["class" => "tel", "alt" => "Img tel"]); ?>
          </span>
        </a>
      </div>

      <ul style="float: left;">
        <li class="m">
          <a href="/simple_simulations/new" class="<?= \Uri::segment(1) == 'simple_simulations' ? ' active' : ''?>">ガス料金<br>シミュレーション</a>
        </li>
        <li class="m">
          <a href="/local_contents" class="<?= \Uri::segment(1) == 'local_contents' ? ' active' : ''?>">地域別<br>ガス料金検索</a>
        </li>
        <li class="m" style="border-right: 1px solid #eeeeee; padding-left: 0; padding-top: 0; ">
          <a href="/categories/lpgas" class="<?= \Uri::segment(1) == 'categories' && \Uri::segment(2) == 'lpgas' ? ' active' : ''?>">プロパンガス<br>(LPガス)記事一覧</a>
        </li>
      </ul>
    </div>
  </header>

<? }else{ ?>

  <header>
    <div class="container-wrap">
      <div class="logo-wrap pos-left">
        <div class="logo">
          <div><a href="<?= \Uri::base(); ?>"><?= Asset::img('layout/logo.png'); ?></a></div>
        </div>
      </div>

      <div class="navi-wrap">
        <div class="navi">
          <a href="/simple_simulations/new" class="<?= \Uri::segment(1) == 'simple_simulations' ? ' active' : ''?>">ガス料金<br>シミュレーション</a>
        </div>
        <div class="navi">
          <a href="/local_contents" class="<?= \Uri::segment(1) == 'local_contents' ? ' active' : ''?>">地域別<br>ガス料金検索</a>
        </div>
        <div class="navi">
          <a href="/categories/lpgas" class="<?= \Uri::segment(1) == 'categories' && \Uri::segment(2) == 'lpgas' ? ' active' : ''?>">プロパンガス<br>(LPガス)記事一覧</a>
        </div>
      </div>
      
      <div class="logo-wrap pos-right">
        <div class="enepi-tel">
          <div><?= Asset::img('layout/enepi_tel.png', ['alt' => 'Enepi']); ?></div>
        </div>
      </div>
    </div>
  </header>

<? } ?>