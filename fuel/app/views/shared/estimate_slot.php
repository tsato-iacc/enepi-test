<?php if (isset($slots)): ?>
  <?php if ($is_mobile): ?>
  <div class="estimate-ticker">
    <div class="ticker-wrap<?= \Request::active()->controller == 'Controller_Front_Welcome' && \Request::active()->action == 'index' ? ' wrap-fixed' : ''; ?>">
      <div class="ticker">
        <?php foreach ($slots as $slot): ?>
          <div class="ticker__item"><span class="date"><?= \Helper\TimezoneConverter::convertFromString($slot->estimate_created_at, 'slot'); ?></span> <?= $slot->subject ?>で年間 <span class="price"><?= number_format($slot->price); ?></span> 円安くなるご提案が出ました</div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
  <?php else: ?>
    <div class="estimate-slot shake-slot<?= \Request::active()->controller == 'Controller_Front_Welcome' && \Request::active()->action == 'index' ? ' slot-target' : ''; ?>">
      <div class="slot-wrap">
        <div class="slot-container">
          <div class="swiper-wrapper">
            <?php foreach ($slots as $slot): ?>
              <div class="swiper-slide"><div><span class="date"><?= \Helper\TimezoneConverter::convertFromString($slot->estimate_created_at, 'slot'); ?></span> <?= $slot->subject ?>で<br>年間 <span class="price"><?= number_format($slot->price); ?></span> 円安くなる<br>ご提案が出ました</div></div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>
<?php endif; ?>
