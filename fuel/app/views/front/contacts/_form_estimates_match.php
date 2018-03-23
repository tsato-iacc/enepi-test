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
      <div class="title"><span class="block">あなたの条件にマッチした</span><span class="block">ガス会社が<span class="title-red"><span><?= count($estimates); ?></span>社</span>見つかりました！</span></div>
    </div>
    <p class="description"><span class="block">詳細が知りたいガス会社に <?= \Asset::img('estimates_match_screen/check.png'); ?> チェックを入れ、</span><span class="block">「詳細情報を希望する」ボタンを押してください。</span></p>
  </div>
  <?= Form::open(['action' => "lpgas/contacts/{$contact->id}/introduce"]); ?>
    <?= \Form::csrf(); ?>
    <input type="hidden" name="token" value="<?= $contact->token?>">
    <input type="hidden" name="pin" value="<?= $contact->pin?>">
    <div class="match-table-pc">
      <div class="tr th bb-orange th-th">
        <div class="td td-1">
          <div><?= \Asset::img('estimates_match_screen/memo.png'); ?></div>
          <div>
            <p>LP <?= $contact->name; ?>様専用</p>
            <p>料金プラン</p>
          </div>
        </div>
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
        <div class="td td-2 decorator user-amount"><p><?= number_format($contact->getYearGasUsage()); ?><span>円</span></p></div>
        <div class="td td-3 decorator"><div class="none"></div></div>
        <div class="td td-4 decorator"><div class="none"></div></div>
        <div class="td td-5 decorator"><div class="none"></div></div>
        <div class="td td-6 decorator"><div class="none"></div></div>
        <div class="td td-7 decorator"><div class="none"></div></div>
        <div class="td td-8 decorator"><div class="none"></div></div>
      </div>
      <?php foreach ($estimates as $estimate): ?>
        <div class="tr relative bb-gray<?= $estimate->status != \Config::get('models.estimate.status.sent_estimate_to_user') ? ' introduced' : ''; ?>">
          <div class="introduced-wrap">
            <p class="description">詳細情報を依頼済み</p>
          </div>
          <div class="td td-1 company-wrap">
            <div class="check">
              <?php if ($estimate->status == \Config::get('models.estimate.status.sent_estimate_to_user')): ?>
                <input type="checkbox" name="estimates[]" value="<?= $estimate->id; ?>" id="estimate_<?= $estimate->id; ?>">
                <label for="estimate_<?= $estimate->id; ?>">
                  <div>
                    <i class="fa fa-check" aria-hidden="true"></i>
                  </div>
                </label>
              <?php endif; ?>
            </div>
            <div class="main">
              <div class="logo">
                <?= S3::image_tag_s3(S3::makeImageUrl($estimate->company)); ?>
              </div>
              <div class="company-name"><?= $estimate->company->getCompanyName(); ?></div>
              <div class="details">
                <a href="<?= \Uri::create('/lpgas/contacts/:contact_id/estimates/:uuid'.'?'.http_build_query(['pin' => $contact->pin, 'token' => $contact->token]), ['contact_id' => $contact->id, 'uuid' => $estimate->uuid]); ?>" class="btn_detail">詳しく見る <i class="fa fa-caret-right" aria-hidden="true"></i></a>
              </div>
            </div>
          </div>
          <div class="td td-2 column-centred">
            <?php if ($estimate->basic_price): ?>
              <?php $saving = $estimate->total_savings_in_year($contact); ?>
              <div class="year-amount"><p><?= number_format(\Arr::sum($estimate->savings_by_month($contact), 'after_price')); ?><span>円</span></p></div>
              <div class="<?= $saving > 0 ? ' year-saving' : ' no-year-saving'; ?>"><p><?= number_format(abs($saving)); ?><span><?= $saving > 0 ? '円節約!' : '円割高'; ?></span></p></div>
            <?php else: ?>
              <div class="year-unpublished">
                <p>料金非公開</p>
                <p>（お問い合わせください）</p>
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
          <div class="td td-4 column-centred-unit">
            <?php if ($estimate->prices): ?>
              <?php foreach ($estimate->prices as $price): ?>
                <div class="unit-price">
                  <div><?= $price->getRangeLabel() ? $price->getRangeLabel().':' : ''; ?></div>
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

    <div class="match-table-sp">
      <div class="table-tabs">
        <div class="tab-1 active" data-slide="1">合計額の比較</div>
        <div class="tab-2" data-slide="2">料金内訳</div>
        <div class="tab-3" data-slide="3">その他</div>
      </div>
      <div class="table-body">
        <div class="tr bb-gray">
          <div class="td th">
            <p>LP <?= $contact->name; ?>様<br>現在の推定料金</p>
          </div>
          <div class="td decorator">
            <div class="slide-wrap-1 active">
              <div class="slide-content user-amount">
                <div class="slide-header">12ヶ月合計額</div>
                <div class="slide-body"><p><?= number_format($contact->getYearGasUsage()); ?><span>円</span></p></div>
              </div>
            </div>
            <div class="slide-wrap-2"></div>
            <div class="slide-wrap-3"></div>
          </div>
        </div>
        <?php foreach ($estimates as $estimate): ?>
          <div class="tr bb-gray<?= $estimate->status != \Config::get('models.estimate.status.sent_estimate_to_user') ? ' introduced' : ''; ?>">
            <div class="td company-wrap">
              <div class="check">
                <?php if ($estimate->status == \Config::get('models.estimate.status.sent_estimate_to_user')): ?>
                  <input type="checkbox" name="estimates[]" value="<?= $estimate->id; ?>" id="estimate_sp_<?= $estimate->id; ?>">
                  <label for="estimate_sp_<?= $estimate->id; ?>">
                    <div>
                      <i class="fa fa-check" aria-hidden="true"></i>
                    </div>
                  </label>
                <?php endif; ?>
              </div>
              <div class="main">
                <div class="logo">
                  <?= S3::image_tag_s3(S3::makeImageUrl($estimate->company)); ?>
                </div>
                <div class="company-name"><?= $estimate->company->getCompanyName(); ?></div>
                <div class="details">
                  <a href="<?= \Uri::create('/lpgas/contacts/:contact_id/estimates/:uuid'.'?'.http_build_query(['pin' => $contact->pin, 'token' => $contact->token]), ['contact_id' => $contact->id, 'uuid' => $estimate->uuid]); ?>" class="btn_detail">詳しく見る <i class="fa fa-caret-right" aria-hidden="true"></i></a>
                </div>
              </div>
            </div>
            <div class="td">
              <div class="slide-wrap-1 column-centred active">
                <?php if ($estimate->basic_price): ?>
                  <?php $saving = $estimate->total_savings_in_year($contact); ?>
                  <div class="year-amount"><p><?= number_format(\Arr::sum($estimate->savings_by_month($contact), 'after_price')); ?><span>円</span></p></div>
                  <div class="<?= $saving > 0 ? ' year-saving' : ' no-year-saving'; ?>"><p><?= number_format(abs($saving)); ?><span><?= $saving > 0 ? '円節約!' : '円割高'; ?></span></p></div>
                <?php else: ?>
                  <div class="year-unpublished">
                    <p>料金非公開</p>
                    <p>（お問い合わせください）</p>
                  </div>
                <?php endif; ?>
              </div>
              <div class="slide-wrap-2"></div>
              <div class="slide-wrap-3"></div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      
    </div>

    <div class="match-submit">
      <div class="match-header">
        <div class="header-wrap">
          <div class="image"><?= \Asset::img('estimates_match_screen/ok.png'); ?></div>
          <div class="title">あなたの条件にマッチしたガス会社が<span class="title-red"><span><?= count($estimates); ?></span>社</span>見つかりました！</div>
        </div>
        <p class="description">詳細が知りたいガス会社に <?= \Asset::img('estimates_match_screen/check.png'); ?> チェックを入れ、「詳細情報を希望する」ボタンを押してください。</p>
      </div>

      <div class="match-select">
        <div class="input-wrap">
          <div><label for="preferred_time">希望連絡時間帯：</label></div>
          <div>
            <div class="select-wrap select-arrow">
              <i class="fa fa-caret-down" aria-hidden="true"></i>
              <?= Form::select('preferred_time', $contact->preferred_contact_time_between, __('admin.contact.preferred_contact_time_between'), ['id' => 'preferred_time']); ?>
            </div>
          </div>
        </div>
        <div class="input-wrap">
          <div><label>緊急度：</label></div>
          <div class="radio-wrap">
            <label><input type="radio" name="priority_degree" value="0"<?= $contact->priority_degree == 0 ? ' checked' : ''; ?>> 通常</label>
            <label><input type="radio" name="priority_degree" value="1"<?= $contact->priority_degree == 1 ? ' checked' : ''; ?>> 至急</label>
          </div>
        </div>
        <div class="input-wrap">
          <div>電気料金セットを希望する：</div>
          <div class="radio-wrap">
            <label><input type="radio" name="desired_option" value="1"<?= $contact->desired_option == 1 ? ' checked' : ''; ?>> する</label>
            <label><input type="radio" name="desired_option" value="0"<?= $contact->desired_option == 0 ? ' checked' : ''; ?>> しない</label>
          </div>
        </div>
      </div>
      
      <input type="submit" name="commit" value="チェックを入れた会社からの連絡を希望する" class="btn btn-primary" onclick="ga('send', 'event', 'matching', 'click', 'submit_btn', {'nonInteraction': 1});">

      <p class="comment">※お客様専用に開示する情報も含まれますので、内容やURLの第三者への提供・転送は禁止とさせていただきます。</p>
    </div>
  <?= Form::close(); ?>
</div>
