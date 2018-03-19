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
      <div class="title">あなたの条件にマッチしたガス会社が<?= count($estimates); ?>社見つかりました！</div>
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
      <?php foreach ($estimates as $estimate): ?>
        <div class="tr bb-gray">
          <div class="td td-1 company-wrap">
            <div class="check">
              <input type="checkbox" name="" value="1" id="estimate_<?= $estimate->id; ?>">
              <label for="estimate_<?= $estimate->id; ?>">
                <div>
                  <i class="fa fa-check" aria-hidden="true"></i>
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
          <div class="td td-2 column-centred">
            <?php if ($estimate->basic_price): ?>
              <div class="year-amount"><p><?= '????'; ?><span>円</span></p></div>
              <div class="year-saving"><p><?= number_format($estimate->total_savings_in_year($contact)); ?><span>円節約!</span></p></div>
            <?php else: ?>
              <div class="year-unpublished">
                <p>料金非公開<br>（お問い合わせください）</p>
              </div>
            <?php endif; ?>
          </div>
          <div class="td td-3">
            <?php if ($estimate->basic_price): ?>
              <div class="basic-price"><p><?= number_format($estimate->basic_price); ?>円</p></div>
            <?php else: ?>
              <div class="none"></div>
            <?php endif; ?>
          </div>
          <div class="td td-4 column-centred">
            <?php if ($estimate->prices): ?>
              <?php foreach ($estimate->prices as $price): ?>
                <div class="unit-price">
                  <div><?= $price->getRangeLabel(); ?>:</div>
                  <div><?= $price->unit_price; ?>円</div>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <div class="none"></div>
            <?php endif; ?>
          </div>
          <div class="td td-5">
            <?php if ($estimate->fuel_adjustment_cost): ?>
              <div class="basic-price"><p><?= number_format($estimate->fuel_adjustment_cost); ?>円</p></div>
            <?php else: ?>
              <div class="none"></div>
            <?php endif; ?>
          </div>
          <?php $features = \Arr::pluck($estimate->company->features, 'name'); ?>
          <div class="td td-6">
            <?= in_array('違約金なし', $features) ? 'なし' : 'あり'; ?>
          </div>
          <div class="td td-7">
            <?= in_array('セット割', $features) ? 'あり' : 'なし'; ?>
          </div>
          <div class="td td-8 pickup">
            <?php foreach ($estimate->company->pickups as $pickup): ?>
              <div>
                <i class="fa fa-circle" aria-hidden="true"></i> <?= $pickup->title; ?>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="match-submit">
      <div class="match-header">
        <div class="header-wrap">
          <div class="image"><?= \Asset::img('estimates_match_screen/ok.png'); ?></div>
          <div class="title">あなたの条件にマッチしたガス会社が<?= count($estimates); ?>社見つかりました！</div>
        </div>
        <p class="description">詳細が知りたいガス会社に <?= \Asset::img('estimates_match_screen/check.png'); ?> チェックを入れ、「詳細情報を希望する」ボタンを押してください。</p>
      </div>
    </div>
  <?= Form::close(); ?>
</div>