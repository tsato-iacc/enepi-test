<?php use JpPrefecture\JpPrefecture; ?>

<?= render('front/breadcrumb', ['breadcrumb' => $breadcrumb]); ?>

<div class="simple-simulation-header">
  <div class="image"><?= \Asset::img('simulation/header_balloon.png'); ?></div>
  <div>
    <p class="header-title-1">いくら<span>安く</span>なる⁉</p>
    <p class="header-title-2"><span class="block"><span class="underline">プロパンガス料金</span><span class="small">を</span></span><span class="block"><span class="underline">診断</span>してみよう!</span></p>
  </div>
</div>

<?= \Form::open(['id' => 'simple_simulation', 'action' => \Uri::create('simple_simulations')]); ?>
  <?= \Form::csrf(); ?>
  <div class="simple-simulation-form">
    <div class="form-wrap">
      <div class="form-body">
        <div class="start-page">
          <div class="start-tr">
            <div class="start-td">
              <label for="prefecture_code">都道府県 <span class="small">※必須</span></label>
              <div class="select-arrow">
                <i class="fa fa-angle-down" aria-hidden="true"></i>
                <?= Form::select('prefecture_code', '', ['' => '選択してください'] + JpPrefecture::allKanjiAndCode(), ['id' => 'prefecture_code', 'required' => 'required']); ?>
              </div>
            </div>
            <div class="td">
              <label for="city_list">市区町村 <span class="small">※必須</span></label>
              <div class="select-arrow">
                <i class="fa fa-angle-down" aria-hidden="true"></i>
                <select name="city_code" id="city_list" class="form-control" disabled><option value="">都道府県を選択してください</option></select>
              </div>
            </div>
          </div>
          <div class="start-tr">
            <div class="start-td td-flex">
              <div>
                <label for="household">世帯人数</label>
                <div class="select-arrow">
                  <i class="fa fa-angle-down" aria-hidden="true"></i>
                  <?= Form::select('household', 'two_or_less_person_household', \Config::get('enepi.household.key_string'), ['id' => 'household']); ?>
                </div>
              </div>
              <div class="month-wrap">
                <div>
                  <label for="month">使用月</label>
                  <div class="select-arrow">
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                    <?= Form::select('month', $month_selected, \Config::get('enepi.simulation.month.key_string_short'), ['id' => 'month']); ?>
                  </div>
                </div>
                <p>月</p>
              </div>
            </div>
            <div class="td">
              <div class="bill-wrap">
                <div>
                  <label for="bill">だいたいのガス代／月 <span class="small">(分かれば)</span></label>
                  <input type="tel" name="bill" id="bill" placeholder="12345">
                </div>
                <p>円</p>
              </div>
            </div>
          </div>
          <div>
            <div class="simple-simulation-btn" id="simple_simulation_btn"><div class="image"><?= \Asset::img('simulation/calc.png'); ?></div><p>さっそく【無料】診断する!</p><i class="fa fa-angle-right" aria-hidden="true"></i></div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?= Form::close(); ?>
