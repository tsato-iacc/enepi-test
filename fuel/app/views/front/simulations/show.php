<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<?= render('front/breadcrumb', ['breadcrumb' => $breadcrumb]); ?>

<div class="simple-simulation-header">
  <div class="image"><?= \Asset::img('simulation/header_balloon.png'); ?></div>
  <div>
    <p class="header-title-1 header-title-hidden" style="visibility:hidden;">いくら<span>安く</span>なる⁉</p>
    <p class="header-title-3"><span class="block"><span class="underline">プロパンガス料金</span></span><span class="block"><span class="underline"> <span class="short">シミュレーション</span>結果</span></span></p>
  </div>
</div>

<div class="simple-simulation-result">
  <div class="simple-simulation-wrap">
    <div>
      <div>
        <p class="label">推定使用状況</p>
      </div>
      <div class="flex-tr">
        <div>
          <p class="input-data"><span class="round">地域</span><?= $simulation_helper->getPrefectureName(); ?><?= $simulation_helper->getRegion()->city_name; ?></p>
          <p class="input-data simulation-counter" data-start="0" data-end="<?= $simulation_helper->getHouseholdAverageRate(); ?>" data-dec="1" data-skip="false" id="household_average_rate"><span class="round">ガス使用量</span><span class="target">0</span>㎥</p>
        </div>
        <div>
          <p class="input-data"><span class="round">世帯人数</span><?= \Config::get('enepi.household.key_numeric.'.$simulation_helper->getHousehold()); ?></p>
          <?php $bill = $simulation_helper->getBill() ? $simulation_helper->getBill() : $simulation_helper->getEstimatedBill(); ?>
          <p class="input-data simulation-counter" data-start="0" data-end="<?= $bill; ?>" data-dec="0" data-skip="false" id="bill"><span class="round">月々のお支払い金額</span><span class="target">0</span>円(税込)</p>
        </div>
      </div>
    </div>
    <div>
      <div>
        <p class="label">地域平均</p>
      </div>
      <div class="flex-tr flex-tr-padding">
        <div>
          <p class="result-data simulation-counter" data-start="0" data-end="<?= $simulation_helper->getBasicRate(); ?>" data-dec="0" data-skip="false" id="city_average_basic_rate"><span class="inner-label">基本料金</span><span class="pl"><span class="digit target">0</span>円</span></p>
        </div>
        <div>
          <p class="result-data simulation-counter" data-start="0" data-end="<?= $simulation_helper->getCityAverageCommodityCharge(); ?>" data-dec="0" data-skip="false" id="city_average_commodity_charge"><span class="inner-label">従量単価</span><span class="pl"><span class="digit target">0</span>円/㎥</span></p>
        </div>
      </div>
    </div>
    <div>
      <div>
        <p class="label">現在の料金</p>
      </div>
      <div class="flex-tr flex-tr-padding">
        <?php if ($simulation_helper->getBill()): ?>
          <div>
            <p class="result-data simulation-counter" data-start="0" data-end="<?= $simulation_helper->getBasicRate(); ?>" data-dec="0" data-skip="false" id="basic_rate"><span class="inner-label">基本料金</span><span class="pl"><span class="digit target">0</span>円</span></p>
          </div>
          <div>
            <p class="result-data simulation-counter" data-start="0" data-end="<?= $simulation_helper->getCommodityCharge(); ?>" data-dec="0" data-skip="false" id="commodity_charge"><span class="inner-label">従量単価</span><span class="pl"><span class="digit target">0</span>円/㎥</span></p>
          </div>
        <?php else: ?>
          <div>
            <p class="result-data simulation-counter" data-start="0" data-end="0" data-dec="0" data-skip="true" id="basic_rate"><span class="inner-label">基本料金</span><span class="pl"><span class="digit target">-</span>円</span></p>
          </div>
          <div>
            <p class="result-data simulation-counter" data-start="0" data-end="0" data-dec="0" data-skip="true" id="commodity_charge"><span class="inner-label">従量単価</span><span class="pl"><span class="digit target">-</span>円/㎥</span></p>
          </div>
        <?php endif; ?>
      </div>
    </div>
    <p class="comment"><span>※基本料金は地域平均と同額として推算しています。</span><span>※従量単価250円以下で表示された場合は間違えている場合がございます。</span></p>
  </div>
  <div class="economy-wrap">
    <div class="left">
      <p><span class="decorator"><?= $simulation_helper->getPrefectureName(); ?>でenepiを</span></p>
      <p>ご利用の場合</p>
    </div>
    <div class="center">
      <p class="simulation-counter" data-start="0" data-end="<?= $simulation_helper->getAverageReductionRate() ? $simulation_helper->getAverageReductionRate() : $simulation_helper->getNationwideReduction(); ?>" data-dec="0" data-skip="false" id="year_economy">年間<span class="target">0</span>円</p>
    </div>
    <div class="right">
      <p><span>節約の提案実績あり!</span></p>
    </div>
  </div>
</div>

<section class="simple-simulation-chart">
  <div class="h3-wrap">
    <h3><span class="block">地域平均と<span class="underline">enepi利用時の</span></span><span class="block">削減シミュレーション</span></h3>
  </div>

  <!-- GOOGLE CHART START -->
  <div class="google-chart-wrap">
    <div id='simulation_chart'></div>
    <input type="hidden" name="google_chart_json_data" value='<?= $simulation_helper->getGoogleChartJsonData(); ?>'>
  </div>
  <!-- GOOGLE CHART END -->

  <div class="super-wrap">
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th></th>
            <?php foreach (\Config::get('enepi.simulation.month.key_string_short') as $k): ?>
              <th class="th-blue"><?= $k; ?>月</td>
            <?php endforeach; ?>
            <th>平均</th>
          </tr>
        </thead>
        <tbody>
          <tr class="tr-wide">
            <td class="th-blue">地域平均(円)</th>
            <?php foreach ($simulation_helper->getMonthlyAveragePrice() as $m): ?>
              <td><?= number_format(round($m, 0)); ?></td>
            <?php endforeach; ?>
            <td><?= number_format($simulation_helper->getMonthlyAveragePriceAverage()); ?></td>
          </tr>
          <tr class="tr-wide">
            <td class="th-orange">エネピ平均削減額(円)</td>
            <?php foreach ($simulation_helper->getNewEnepiReduction() as $r): ?>
              <td class="td-orange"><?= number_format(round($r, 0)); ?></td>
            <?php endforeach; ?>
            <td class="td-orange"><?= number_format($simulation_helper->getNewEnepiReductionAverage()); ?></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <div class="comment">
    <p>※本ページの料金・価格情報は下記の情報及びデータをもとに算出しています</p>
    <ul>
      <li>一般財団法人日本エネルギー経済研究所 石油情報センターHPより価格情報 参照</li>
      <li>一般財団法人日本エネルギー経済研究所 石油情報センター『平成18年度プロパンガス消費実態調査』参照</li>
      <li>エネピ利用者見積もり金額より当社試算</li>
    </ul>
  </div>

  <a class="simple-resimulation-btn" href="<?= \Uri::create('simple_simulations/new'); ?>" onclick="caevent('reシミュレーション「外部」', {ch:'63912289'});ga('send', 'event', 'resimulation-iframe', 'btn-click', '', 0);">
    <i class="fa fa-angle-left" aria-hidden="true"></i>
    <p>もう一度診断する</p>
    <div class="image"><?= \Asset::img('simulation/calc.png'); ?></div>
  </a>
</section>

<div class="simulation-register-form-header">
  <div class="image"><?= \Asset::img('simulation/header_form_balloon.png'); ?></div>
  <div>
    <h3 class="header-title-3"><span class="block">今すぐ</span><span class="block underline">ガス会社の料金プラン</span><span class="block">を確認しよう！</span></h3>
  </div>
</div>

<!-- SIMULATION ESTIMATE FORM START -->
<?= render('front/simulations/_form_estimate', ['zip' => $zip, 'household' => $simulation_helper->getHousehold(), 'month' => $simulation_helper->getMonth(), 'household_average_rate' => $simulation_helper->getHouseholdAverageRate(), 'bill' => $simulation_helper->getBill(), 'estimated_bill' => $simulation_helper->getEstimatedBill()]); ?>
<!-- SIMULATION ESTIMATE FORM END -->

<section class="simple-simulation-more">
  <div class="more-wrap">
    <div class="bg-transform"></div>
    <div class="content">
      <div class="image"><?= \Asset::img('simulation/more.png'); ?></div>
      <p>上記の追加情報を入力すると、</p>
      <p>
        <span class="block"><span class="underline"><span class="dot">あ</span><span class="dot">な</span><span class="dot">た</span><span class="dot">だ</span><span class="dot">け</span>の</span></span>
        <span class="block">enepi加盟会社プラン一覧が見れる！</span>
      </p>
    </div>
  </div>
</section>

<section class="simple-simulation-point">
  <div class="image-wrap">
    <div class="image point-bg"><?= \Asset::img('simulation/point_bg.png'); ?></div>
    <div class="image point-bg-sp"><?= \Asset::img('simulation/point_bg_sp.png'); ?></div>
    <div class="point-left"><?= \Asset::img('simulation/point_1.png'); ?></div>
    <div class="point-right"><?= \Asset::img('simulation/point_2.png'); ?></div>
    <div class="point-right-sp"><?= \Asset::img('simulation/point_2_sp.png'); ?></div>
    <p>※画像はイメージです</p>
  </div>


  <div class="call-banner"><?= \Asset::img('simulation/call_banner.png'); ?></div>
  <div class="call-banner-sp"><a href="tel:<?= \Config::get('enepi.service.tel'); ?>"><?= \Asset::img('simulation/call_banner_sp.png'); ?></a></div>
</section>
