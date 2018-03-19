<div class="estimates-match-form">
  <div class="match-progress">
    <?php if ($contact->status == \Config::get('models.contact.status.sent_estimate_req')): ?>
      <?= \Asset::img('estimate_presentation/new_step_img_02.png'); ?>
    <?php else: ?>
      <?= \Asset::img('estimate_presentation/new_step_img_03.png'); ?>
    <?php endif; ?>
  </div>

  <div class="match-header">
    <div class="header-wrap">
      <div class="image"><?= \Asset::img('estimates_match_screen/ok.png'); ?></div>
      <div class="title">あなたの条件にマッチしたガス会社が<?= count($contact->estimates); ?>社見つかりました！</div>
    </div>
    <p class="description">詳細が知りたいガス会社に <?= \Asset::img('estimates_match_screen/check.png'); ?> チェックを入れ、「詳細情報を希望する」ボタンを押してください。</p>
  </div>
  <?= Form::open(['action' => '']); ?>
    <?= \Form::csrf(); ?>
    <div class="match-table">
      <div class="tr th bb-orange">
        <div class="td td-1"></div>
        <div class="td td-2">12ヶ月合計額</div>
        <div class="td td-3">基本料金</div>
        <div class="td td-4">定量単価</div>
        <div class="td td-5">燃料調整費</div>
        <div class="td td-6">違約金</div>
        <div class="td td-7">セット割</div>
        <div class="td td-8">おすすめポイント</div>
      </div>
      <div class="tr bb-gray">
        <div class="td td-1 user-name"><p>LP <?= $contact->name; ?>様<br>現在の推定料金</p></div>
        <div class="td td-2 decorator user-amount"><p>23,000<span>円</span></p></div>
        <div class="td td-3 decorator"><div class="none"></div></div>
        <div class="td td-4 decorator"><div class="none"></div></div>
        <div class="td td-5 decorator"><div class="none"></div></div>
        <div class="td td-6 decorator"><div class="none"></div></div>
        <div class="td td-7 decorator"><div class="none"></div></div>
        <div class="td td-8 decorator"><div class="none"></div></div>
      </div>
      <?php foreach ($contact->estimates as $estimate): ?>
        <div class="tr bb-gray">
          <div class="td td-1 company-wrap">
            <div class="check">
              <input type="checkbox" name="" value="1" id="estimate_<?= $estimate->id; ?>">
              <label for="estimate_<?= $estimate->id; ?>">
                <div>
                  <div><img src="https://stg.new.enepi.jp/assets/images/estimate_form/check-blue.png?1521182664" alt=""></div>
                </div>
              </label>
            </div>
            <div class="main">
              <div class="logo">
                <?= S3::image_tag_s3(S3::makeImageUrl($estimate->company)); ?>
              </div>
              <div class="company-name"><?= $estimate->company->getCompanyName(); ?></div>
            </div>
          </div>
          <div class="td td-2"></div>
          <div class="td td-3"></div>
          <div class="td td-4"></div>
          <div class="td td-5"></div>
          <div class="td td-6"></div>
          <div class="td td-7"></div>
          <div class="td td-8"></div>
        </div>
      <?php endforeach; ?>
    </div>
  <?= Form::close(); ?>
</div>