<?php
use JpPrefecture\JpPrefecture;
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Cache-Control" content="max-age=7200">
<link rel="icon" href="<?= \Uri::create('favicon.ico?v=2'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<?= Html::meta($meta); ?>
<title><?= $title; ?></title>
<?= render('front/ga'); ?>
<?= render('shared/google_tag_manager'); ?>
<?= Asset::css('front.min.css'); ?>
</head>

<body id="top" class="lp-form" style="background: none transparent;">
  <form method="GET" action="https://enepi.jp/lpgas_contacts/new" target="_parent">
    <?php if ($iframe_pr = \Input::get('iframe_pr')): ?>
      <input type="hidden" name="pr" value="<?= $iframe_pr; ?>">
    <?php endif; ?>
    <section id="main" style="padding-top: 50px; background:none; width: 95%; margin: auto;">
      <div class="main_form">
        <div class="step_tit">入力は<span>10秒</span>で完了!</div>
        <ul>
          <li class="step1">
            <div class="select js-input_block">
              <select name="estimate_kind" id="estimate_kind" required="required" class="flashing">
                <option value="">希望の契約内容は？</option>
                <option value="change_contract">現在住居の見積もり</option>
                <option value="new_contract">新規開設の見積もり</option>
              </select>
            </div>
          </li>
          <li class="step2">
            <div class="select js-input_block">
              <?= Form::select('prefecture_code', '', ['' => '都道府県を選択してください'] + JpPrefecture::allKanjiAndCode(), ['required' => 'required', 'id' => 'prefecture_code']); ?>
            </div>
          </li>
          <li class="step3">
            <div class="input js-input_block">
              <input name="zip_code" type="text" placeholder="郵便番号は？" pattern="\d{3}-?\d{4}" required>
            </div>
          </li>
          <li class="step4" style="display: none;">
            <div class="input js-input_block">
              <input name="email" type="email" placeholder="メールアドレスは？">
            </div>
          </li>
          <li class="step5">
            <input alt="【無料】今すぐ相談する" type="image" src="/assets/images/lp/form/from_btn.png">
          </li>
        </ul>
      </div>
    </section>
  </form>

  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NCCZDM6"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

  <?= Asset::js('front.min.js'); ?>
</body>
</html>
