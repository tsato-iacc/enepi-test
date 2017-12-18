<?php if (isset($slots)): ?>
  <? if smart_phone? ?>
  <div class="estimate-ticker">
    <div class="ticker-wrap<?= ' wrap-fixed' if controller.controller_name == "welcome" && controller.action_name == "index" ?>">
      <div class="ticker">
        <? @slots.each { |slot| ?>
          <div class="ticker__item"><span class="date"><?= slot.estimate_created_at.strftime("%m/%d") ?></span> <?= slot.subject ?>で年間 <span class="price"><?= number_to_currency slot.price ?></span> 安くなるご提案が出ました</div>
        <? } ?>
      </div>
    </div>
  </div>
  <? else ?>
    <div class="estimate-slot shake-slot<?= ' slot-target' if controller.controller_name == "welcome" && controller.action_name == "index" ?>">
      <div class="slot-wrap">
        <div class="slot-container">
          <div class="swiper-wrapper">
            <? @slots.each { |slot| ?>
              <div class="swiper-slide"><div><span class="date"><?= slot.estimate_created_at.strftime("%m/%d") ?></span> <?= slot.subject ?>で<br>年間 <span class="price"><?= number_to_currency slot.price ?></span> 安くなる<br>ご提案が出ました</div></div>
            <? } ?>
          </div>
        </div>
      </div>
    </div>
  <? } ?>
<?php endif; ?>
