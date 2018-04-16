<?php use JpPrefecture\JpPrefecture; ?>
<div class="iframe-simulation-form">
  <div class="form-wrap">
    <div class="form-header">
      <div class="first logo-pc">
        <div class="logo"><div class="image"><?= \Asset::img('iframe/simulation/logo_pc.png'); ?></div>で</div>
        <div class="logo-title">いくら安くなる⁉</div>
      </div>
      <div class="first logo-sp">
        <div class="image"><?= \Asset::img('iframe/simulation/logo_sp.png'); ?></div>
        <div class="logo-title"><span class="small">で</span>いくら<span class="underline">安くなる</span>？？</div>
      </div>
      <div class="last"><p class="header-title"><span class="underline">プロパンガス料金</span><span class="small">を</span><span class="underline">診断</span>してみよう!</p></div>
    </div>
    <div class="form-body">
      <div class="start-page">
        <div class="start-tr">
          <div class="start-td">
            <label for="prefecture_code">都道府県</label>
            <div class="select-arrow">
              <i class="fa fa-angle-down" aria-hidden="true"></i>
              <?= Form::select('prefecture_code', '', ['' => '選択してください'] + JpPrefecture::allKanjiAndCode(), ['id' => 'prefecture_code', 'required' => 'required']); ?>
            </div>
          </div>
          <div class="td">
            <label for="city_list">市区町村</label>
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
                <label for="bill">だいたいのガス代／月</label>
                <input type="tel" name="bill" id="bill">
              </div>
              <p>㎥</p>
            </div>
          </div>
        </div>
        <div>
          <div class="iframe-simulation-btn" id="iframe_simulation_btn"><div class="image"><?= \Asset::img('iframe/simulation/calc.png'); ?></div><p><span class="button-pc">さっそく</span>【無料】診断する!</p><i class="fa fa-angle-right" aria-hidden="true"></i></div>
        </div>
      </div>
      <div class="result-page page-hidden">
        <div>
          <div class="result-wrap">
            <div class="result-content">
              <div>
                <p class="label">推定使用量</p>
                <p class="gas-usage underline simulation-counter" data-start="0" data-end="0" data-dec="1" data-skip="false" id="household_average_rate"><span>0</span>㎥</p>
              </div>
              <div>
                <div class="content-wrap underline">
                  <p class="label">地域平均</p>
                  <div class="basic-wrap">
                    <p class="price-title">基本料金</p>
                    <p class="price simulation-counter" data-start="0" data-end="0" data-dec="0" data-skip="false" id="city_average_basic_rate"><span>0</span>円</p>
                  </div>
                  <div class="unit-wrap">
                    <p class="unit-price-title">従量単価</p>
                    <p class="unit-price simulation-counter" data-start="0" data-end="0" data-dec="0" data-skip="false" id="city_average_commodity_charge"><span>0</span>円/㎥</p>
                  </div>
                </div>
                <div class="content-wrap underline">
                  <p class="label">現在の料金</p>
                  <div class="basic-wrap">
                    <p class="price-title">基本料金</p>
                    <p class="price simulation-counter" data-start="0" data-end="0" data-dec="0" data-skip="false" id="basic_rate"><span>0</span>円</p>
                  </div>
                  <div class="unit-wrap">
                    <p class="unit-price-title">従量単価</p>
                    <p class="unit-price simulation-counter" data-start="0" data-end="0" data-dec="0" data-skip="false" id="commodity_charge"><span>0</span>円/㎥</p>
                  </div>
                </div>
              </div>
            </div>
            <p class="comment"><span>※基本料金は地域平均と同額として推算しています。</span><span>※従量単価250円以下で表示された場合は間違えている場合がございます。</span></p>
          </div>
        </div>
        <div class="economy-wrap">
          <div>
            <p><span class="decorator"><span id="prefecture_name"></span>でenepiを</span></p>
            <p>ご利用の場合</p>
          </div>
          <div>
            <div><p class="year-economy simulation-counter" data-start="0" data-end="0" data-dec="0" data-skip="false" id="year_economy">年間<span>0</span>円</p></div>
            <div><p class="year-title"><span>節約の提案実績あり!</span></p></div>
          </div>
        </div>
        <div>
          <div class="iframe-resimulation-btn" id="iframe_resimulation_btn"><i class="fa fa-angle-left" aria-hidden="true"></i><p>もう一度診断する</p><div class="image"><?= \Asset::img('iframe/simulation/calc.png'); ?></div></div>
        </div>
      </div>
    </div>
  </div>
</div>
