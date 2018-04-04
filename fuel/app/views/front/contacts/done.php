<div class="contact-done">
  <div class="done-header">
    <div>
      <h1><span class="full">ご登録</span><span>ありがとうございました。</span></h1>
    </div>
    <div>
      <p><span class="block">担当者(下記番号)より折り返しご連絡致しますので、</span><span class="block">今しばらくお待ち頂けますようお願い申し上げます。</span></p>
      <p class="comment">※いきなりガス業者から電話がかかってくることはございません。</p>
    </div>
    <div class="tel-wrap">
      <?php if ($is_mobile): ?>
        <div>
          <?php if (\Uri::segment(1) == 'kakaku'): ?>
            <a href="tel:<?= \Config::get('enepi.service.tel_kakaku'); ?>">
              <?= Asset::img('done/tel_kakaku.png', ['alt' => \Config::get('enepi.service.name')]); ?>
            </a>
          <?php else: ?>
            <a href="tel:<?= \Config::get('enepi.service.tel'); ?>">
              <?= Asset::img('done/tel.png', ['alt' => \Config::get('enepi.service.name')]); ?>
            </a>
          <?php endif; ?>
        </div>
      <?php else: ?>
        <div>
          <?php if (\Uri::segment(1) == 'kakaku'): ?>
            <?= Asset::img('done/tel_kakaku.png', ['alt' => \Config::get('enepi.service.name')]); ?>
          <?php else: ?>
            <?= Asset::img('done/tel.png', ['alt' => \Config::get('enepi.service.name')]); ?>
          <?php endif; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <section class="done-form">
    <div class="section-wrap">
      <div class="done-content">
        <div class="title">
          <div><div class="free-mark"><span>無料</span></div></div>
          <div class="title-body">
            <h2><span>ご相談窓口</span><span> あなたのお悩みすべて無料サポート!</span></h2>
            <p>いつでもご連絡ください！私たち専門アドバイザーが、お客様のお悩みを解決致します。</p>
          </div>
        </div>
        <div class="subtitle-sp">
          <p>いつでもご連絡ください！<br>私たち専門アドバイザーが、お客様のお悩みを解決致します。</p>
          <div class="image"><?= \Asset::img('done/staff_sp.png', ['alt' => '私たちがご対応します！']); ?></div>
        </div>
        <div class="form-steps">
          <div>
            <div class="image"><?= \Asset::img('done/check.png'); ?></div><p><span class="block">第三者的な立場で、お客様の内容に合わせた</span><span class="block">お近くの<span class="decor">優良業者を無料でご紹介</span>します!</span></p>
          </div>
          <div>
            <div class="image"><?= \Asset::img('done/check.png'); ?></div><p><span class="block">ご紹介する業者は、エネピの</span><span class="block"><span class="decor">厳正な審査をクリアした認定業者</span>のみ!</span></p>
          </div>
          <div>
            <div class="image"><?= \Asset::img('done/check.png'); ?></div><p><span class="block">業者に直接言いにくい、<span class="decor">お断り連絡を</span></span><span class="block"><span class="decor">代行します！</span>お気軽にご相談ください!</span></p>
          </div>
        </div>
        <div class="form-wrap">
          <?= Form::open(); ?>
            <input type="hidden" name="conversion_id" value="<?= \Input::get('conversion_id'); ?>">

            <div class="order-wrap">
              <div class="form-title">
                <p>エネピでは一人ひとりにしっかり対応するため、1日にご利用いただける人数を制限しております。</p>
                <p><span class="block">ご対応人数が限られておりますので、<span class="decor">下記の質問項目に入力</span></span><span class="block"><span class="decor">いただけるとご案内がスムーズ</span>になります。</span></p>
              </div>

              <div class="form-header">
                <div class="header-wrap">
                  <div class="image"><?= \Asset::img('done/ok.png'); ?></div>
                  <div class="header-title"><span class="block"><?= Date::forge(null, 'Asia/Tokyo')->format('%H時%M分'); ?>現在、</span><span class="block">エネピ相談窓口をご利用可能です！</span></div>
                </div>
              </div>
            </div>

            <div class="form-body">
              <div>
                <div>
                  <label for="q_1">Q. お住いはどの様な形態でしょうか？</label>
                </div>
                <div class="select-arrow">
                  <i class="fa fa-caret-down" aria-hidden="true"></i>
                  <select name="q_1" id="q_1">
                    <option value="不明">以下選択してください</option>
                    <option value="集合住宅・賃貸入居者">集合住宅・賃貸入居者</option>
                    <option value="集合住宅・オーナー">集合住宅・オーナー</option>
                    <option value="一戸建・賃貸入居者">一戸建・賃貸入居者</option>
                    <option value="一戸建・オーナー">一戸建・オーナー</option>
                    <option value="店舗・賃貸入居者">店舗・賃貸入居者</option>
                    <option value="店舗・オーナー">店舗・オーナー</option>
                  </select>
                </div>
              </div>
              <div>
                <div>
                  <label for="q_2">Q. 現在ご使用ガスの種類は？</label>
                </div>
                <div class="select-arrow">
                  <i class="fa fa-caret-down" aria-hidden="true"></i>
                  <select name="q_2" id="q_2">
                    <option value="不明">以下選択してください</option>
                    <option value="プロパンガス（敷地のガスボンベから供給される）">プロパンガス（敷地のガスボンベから供給される）</option>
                    <option value="都市ガス（地下の配管から供給される）">都市ガス（地下の配管から供給される）</option>
                  </select>
                </div>
              </div>
              <div>
                <div>
                  <label for="q_3">Q. 新規でガスを開設される場合の物件は？</label>
                </div>
                <div class="select-arrow">
                  <i class="fa fa-caret-down" aria-hidden="true"></i>
                  <select name="q_3" id="q_3">
                    <option value="不明">以下選択してください</option>
                    <option value="築年数1年以内">築年数1年以内</option>
                    <option value="築年数1~10年">築年数1~10年</option>
                    <option value="築年数10~15年">築年数10~15年</option>
                    <option value="築年数20年以降">築年数20年以降</option>
                  </select>
                </div>
              </div>
            </div>
            
            <div class="done-submit-btn"><span>上記内容で送信する</span><i class="fa fa-caret-right" aria-hidden="true"></i></div>
          <?= Form::close(); ?>
        </div>
      </div>
      <div class="done-side"><?= Asset::img('done/staff_pc.png', ['alt' => '私たちがご対応します！']); ?></div>
    </div>
  </section>

  <div class="info">
    <div>
      <div>
        <p>エネピはあなたにぴったりの優良業者を完全無料でお探しします!</p>
        <p>このまま専門アドバイザーからの連絡をお待ちいただくか、<span class="follow-right">右記</span><span class="follow-bottom">下記</span>の連絡先まで直接ご連絡ください。</p>
      </div>
      <div>
        <?php if ($is_mobile): ?>
          <div>
            <?php if (\Uri::segment(1) == 'kakaku'): ?>
              <a href="tel:<?= \Config::get('enepi.service.tel_kakaku'); ?>">
                <?= Asset::img('done/tel_kakaku.png', ['alt' => \Config::get('enepi.service.name')]); ?>
              </a>
            <?php else: ?>
              <a href="tel:<?= \Config::get('enepi.service.tel'); ?>">
                <?= Asset::img('done/tel.png', ['alt' => \Config::get('enepi.service.name')]); ?>
              </a>
            <?php endif; ?>
          </div>
        <?php else: ?>
          <div>
            <?php if (\Uri::segment(1) == 'kakaku'): ?>
              <?= Asset::img('done/tel_kakaku.png', ['alt' => \Config::get('enepi.service.name')]); ?>
            <?php else: ?>
              <?= Asset::img('done/tel.png', ['alt' => \Config::get('enepi.service.name')]); ?>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <section class="steps">
    <div class="title">
      <div><div class="free-mark"><span>完全</span><span>無料</span></div></div>
      <div class="title-body">
        <h2><span class="h2-wrap"><span class="block"><span class="big-double">3</span><span class="big">ステップ</span><span class="small">で</span></span><span class="block">厳選業者を<span class="big">簡単比較!</span></span></span></h2>
        <p>たったの３STEPで、厳選された料金プランをすぐに比較できます</p>
      </div>
    </div>
    <p class="subtitle">たったの３STEPで、厳選された料金プランをすぐに比較できます</p>

    <div class="steps-wrap">
      <div>
        <div class="step-title">
          <div><?= Asset::img('done/step_1.png', ['alt' => 'step 1']); ?></div>
          <p>10秒でカンタン見積もり依頼♪</p>
        </div>
        <div class="step-image"><?= Asset::img('done/step_1_img.png', ['alt' => '10秒でカンタン見積もり依頼♪']); ?></div>
      </div>
      <div>
        <div class="step-title">
          <div><?= Asset::img('done/step_2.png', ['alt' => 'step 2']); ?></div>
          <p class="pr-6">専門アドバイザーに<br>ご要望や不明点をご相談</p>
        </div>
        <div class="step-image"><?= Asset::img('done/step_2_img.png', ['alt' => '専門アドバイザーにご要望や不明点をご相談']); ?></div>
      </div>
      <div>
        <div class="step-title">
          <div><?= Asset::img('done/step_3.png', ['alt' => 'step 3']); ?></div>
          <p class="pr-6">あなたに適切な優良業者を<br>ご紹介します！</p>
        </div>
        <div class="step-image"><?= Asset::img('done/step_3_img.png', ['alt' => 'あなたに適切な優良業者をご紹介します！']); ?></div>
      </div>
    </div>
  </section>

  <section class="voices">
    <h2><span class="h2-wrap"><span class="big">利用者</span>の<span class="big">声</span>をご紹介</span></h2>
    <p>実際にエネピをお使い頂いた利用者様の声をご紹介します</p>

    <div class="voices-wrap">
      <div><?= Asset::img('done/voice_1.png', ['alt' => '利用者の声をご紹介']); ?></div>
      <div><?= Asset::img('done/voice_2.png', ['alt' => '利用者の声をご紹介']); ?></div>
      <div><?= Asset::img('done/voice_3.png', ['alt' => '利用者の声をご紹介']); ?></div>
      <div><?= Asset::img('done/voice_4.png', ['alt' => '利用者の声をご紹介']); ?></div>
    </div>

    <p class="comment">※お客様の声はあくまでも個人の感想です。実際のサービスご利用にあたり、感じ方には個人差があります。</p>
  </section>

  <div class="info">
    <div>
      <div>
        <p>エネピはあなたにぴったりの優良業者を完全無料でお探しします!</p>
        <p>このまま専門アドバイザーからの連絡をお待ちいただくか、<span class="follow-right">右記</span><span class="follow-bottom">下記</span>の連絡先まで直接ご連絡ください。</p>
      </div>
      <div>
        <?php if ($is_mobile): ?>
          <div>
            <?php if (\Uri::segment(1) == 'kakaku'): ?>
              <a href="tel:<?= \Config::get('enepi.service.tel_kakaku'); ?>">
                <?= Asset::img('done/tel_kakaku.png', ['alt' => \Config::get('enepi.service.name')]); ?>
              </a>
            <?php else: ?>
              <a href="tel:<?= \Config::get('enepi.service.tel'); ?>">
                <?= Asset::img('done/tel.png', ['alt' => \Config::get('enepi.service.name')]); ?>
              </a>
            <?php endif; ?>
          </div>
        <?php else: ?>
          <div>
            <?php if (\Uri::segment(1) == 'kakaku'): ?>
              <?= Asset::img('done/tel_kakaku.png', ['alt' => \Config::get('enepi.service.name')]); ?>
            <?php else: ?>
              <?= Asset::img('done/tel.png', ['alt' => \Config::get('enepi.service.name')]); ?>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
