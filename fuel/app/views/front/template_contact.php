<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="Cache-Control" content="max-age=7200">
  <link rel="icon" href="<?= \Uri::create('favicon.ico?v=2'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?= Html::meta($meta); ?>
  <title><?= $title; ?></title>
  <script
  src="https://code.jquery.com/jquery-1.12.4.min.js"
  integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
  crossorigin="anonymous"></script>
  <?= render('front/ga'); ?>
</head>
<body>

<? if(strcmp($header_decision,'done') == 0){ ?>
  <?= Asset::css('application.css'); ?>
  <?= Asset::css('front.min.css'); ?>
<header>
  <div class="container">
        <div class="header_area">
          <div class="inner" style="height: 70px;">
            <div class="logo"></div>
            <span>エネピ</span>
            <h1>プロパンガスの料金一括比較サービス</h1>
            <div class="header-catch">
              <img src="/assets/images/lpgas_contacts/header-catch.png" alt="Header catch" />
            </div>
          </div>
        </div>
  </div>
</header>
<? }elseif(strcmp($header_decision,'sms_confirm') == 0 || strcmp($header_decision,'details') == 0 || strcmp($header_decision,'estimate_presentation') == 0){ ?>
  <?= Asset::css('estimate_presentation.css'); ?>
<header>
  <nav class="navbar" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <span class="logo"></span>
      </div>
      <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
          <li class="navbar-item">
            <div class="hidden_pc">
              <img class="tel" src="/assets/images/estimate_presentation/img_tel.png" alt="Img tel" />
            </div>
            <div class="hidden_sp">
            <span class="tel_nav"><i class="fa fa-hand-o-down" aria-hidden="true"></i>ここをタッチしてお電話できます！</span>
              <div class="btn_tel">
                <a href="tel:0120771664"  onclick="ga('send', 'event', 'tel', 'click', 'contact_btn_sp', {'nonInteraction': 1});">
                  <img class="tel" src="/assets/images/estimate_presentation/img_tel-.png" alt="Img tel" />
                </a>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>

<? } ?>

        <?= $content; ?>

<footer>
  <div class="footer">
    <div class="container">
      <div class="clearfix">
        <div class="footer-logo text-center"></div>
      </div>
      <div class="footer-copyright text-center">© 2016 enepi</div>
    </div>
  </div>
</footer>

  <?php if ($this->pr_tracking_name == "xmarke"): ?>
    <img width="1" height="1" border="0" alt="成果報告タグ" src="https://rsch.jp/common/prom/connectlpimg.php?eqid=8def6277d77504dbc3b8bbaf8e447c56546cb41c&po=0023">
  <?php endif; ?>

  <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
  <?= Asset::js('front.min.js'); ?>
</body>
</html>
