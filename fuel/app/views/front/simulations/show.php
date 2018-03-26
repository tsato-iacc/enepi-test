<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<?= render('front/breadcrumb', ['breadcrumb' => $breadcrumb]); ?>

<div class="article-page">
  <div class="article">
    <div class="article-list-v3-panel">
      <div class="panel-inner article-list-v3-panel-container">
        <div class="simulation-top-box">
          <div class="simulation-result-title">
            <div class="simulation-result-paragraph">プロパンガス料金 シミュレーション結果</div>
          </div>
            <div class="simulation-result-top-wrapper" style="<?= $estimated_bill != 0 ? 'margin-bottom: 30px;' : ''?>">
            <div class="usage-status">
              <div class="usage-status-title-box">
                <h4 class="usage-status-title">推定使用状況</h4>
              </div>
              <table class="usage-status-content-table-left" style="height: 9em;">
                <tr class="usage-status-content">
                  <th>■地域</th>
                  <td><?= $prefecture_name ?><?= $city_name ?></td>
                </tr>
                <tr class="usage-status-content">
                  <th>■ガス使用量</th>
                  <td><?= $household_average_rate; ?>㎥</td>
                </tr>
                <tr class="usage-status-content">
                  <th>■世帯人数</th>
                  <td><?= \Config::get('enepi.household.key_numeric.'.$household) ?></td>
                </tr>
                <tr class="usage-status-content">
                  <?php if ($bill): ?>
                    <th>■月々のお支払い金額</th>
                    <td><?= number_format((int) $bill) ?>円(税込)</td>
                  <?php endif; ?>
                  <?php if ($estimated_bill != 0): ?>
                    <th>■月々のお支払い金額(推算)</th>
                    <td><?= number_format($estimated_bill); ?>円(税込)</td>
                  <?php endif; ?>
                </tr>
              </table>
            </div>
            <div class="current-price">
              <?php if ($bill): ?>
                <div class="current-price-top" style="height: 80px;">
                  <div class="usage-status-title-box">
                    <h4 class="current-price-title">地域平均</h4>
                  </div>
                  <table class="usage-status-content-table">
                    <tr class="usage-status-content">
                      <th>基本料金</th>
                      <td><?= $basic_rate ?>円</td>
                      <th>従量単価</th>
                      <td style="font-size: 215%;"><?= $city_average_commodity_charge ?><span class="small">円/㎥</span></td>
                    </tr>
                  </table>
                </div>
                <div class="current-price-bottom">
                  <div class="usage-status-title-box">
                    <h4 class="current-price-title">現在の料金(推算)</h4>
                  </div>
                  <table class="usage-status-content-table">
                    <tr class="usage-status-content">
                      <th>基本料金</th>
                      <td><?= $basic_rate ?>円</td>
                      <th>従量単価</th>
                      <td style="font-size: 215%; color: red;"><?= number_format($commodity_charge); ?><span class="small">円/㎥</span></td>
                    </tr>
                  </table>
                </div>
                <div style="font-size: 11px;font-weight: 100;clear:both;text-align:right;">
                  ※基本料金は地域平均と同額として推算しています。
                </div>
              <?php endif; ?>
              <?php if ($estimated_bill != 0): ?>
  　            <h4 class="current-price-title" style="margin: 0;float: left;">地域平均</h4>
                <table class="usage-status-content-table-smaller">
                  <tr class="usage-status-content">
                    <th>基本料金</th>
                    <td><?= $basic_rate ?>円</td>
                  </tr>
                  <tr class="usage-status-content">
                    <th>従量単価</th>
                    <td><?= number_format($commodity_charge); ?>円/㎥</td>
                  </tr>
                </table>
              <?php endif; ?>
            </div>
          </div>
          <?php if ($bill): ?>
            <div class="simulation-result-arrow">↓</div>
            <div class="simulation-result-box">
              <?php if ($commodity_charge < 250): ?>
                相場に比べて十分安い料金です。
              <?php elseif (250 < $commodity_charge && $commodity_charge < $city_average_commodity_charge): ?>
                相場より安い料金ですが、<?php if ($this->is_mobile): ?><br><?php endif; ?><span style="font-size: 150%; color: red;">エネピではもっと安くなる</span><?php if ($this->is_mobile): ?><br><?php endif; ?>可能性があります。
              <?php elseif ($commodity_charge == $city_average_commodity_charge): ?>
                相場と同じ料金です。<?php if ($this->is_mobile): ?><br><?php endif; ?><span style="font-size: 150%; color: red;">エネピではもっと安くなる</span><?php if ($this->is_mobile): ?><br><?php endif; ?>可能性があります。
              <?php elseif ($city_average_commodity_charge < $commodity_charge): ?>
                相場より高い料金です。<?php if ($this->is_mobile): ?><br><?php endif; ?><span style="font-size: 150%; color: red;">エネピではもっと安くなる</span><?php if ($this->is_mobile): ?><br><?php endif; ?>可能性があります。
              <?php endif; ?>
            </div>
          <?php endif; ?>
          
          <!-- SIMULATION ESTIMATE FORM START -->
          <?= render('front/simulations/_form_estimate', ['zip' => $zip, 'household' => $household, 'month' => $month, 'household_average_rate' => $household_average_rate, 'bill' => $bill, 'estimated_bill' => $estimated_bill]); ?>
          <!-- SIMULATION ESTIMATE FORM END -->
          
          <div class="simulation-result-title" style="margin-top: 3em;">
            <div class="simulation-result-paragraph">エネピ利用時の節約額</div>
          </div>
          <div class="reduction-rate-box" style="color: black;">
            <?php if ($average_reduction_rate != 0): ?>
              <?= $prefecture_name ?>でエネピをご利用の場合<br>
                <span style="color: red; font-size: 150%;">年間<?= $average_reduction_rate ?>円</span><br>
            <?php else: ?>
              エネピをご利用の場合<br>
              <span style="color: red; font-size: 150%;">年間<?= $nationwide_reduction ?>円</span><br>
            <?php endif; ?>
            ガス料金の<span style="color: red; font-size: 150%;">節約</span>が期待できます!!
          </div>
          <?php if (!$this->is_mobile): ?>
            <!-- GOOGLE CHART START -->
            <div id='simulation_chart'></div>
            <input type="hidden" name="google_chart_json_data" value="<?= $google_chart_json_data ?>">
            <!-- GOOGLE CHART END -->

            <div class="simulation-table-wrapper">
              <table class="simulation-table" border="1" style="color: black; font-size: 90%;">
                <thead>
                  <tr>
                    <th></th>
                    <?php foreach (\Config::get('enepi.simulation.month.key_numeric') as $k => $v): ?>
                    <th class="monthly"><?= $k ?>月</th>  
                    <?php endforeach; ?>
                    <th>平均</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th class="simulation-table-first-row">地域平均(円)</th>
                    <?php foreach ($monthly_average_price as $m): ?>
                      <td><?= number_format(round($m, 0)) ?></td>
                    <?php endforeach; ?>
                    <td><?= number_format($monthly_average_price_average) ?></td>
                  </tr>
                  <tr>
                    <th class="simulation-table-second-row">エネピ平均削減額(円)</th>
                    <?php foreach ($new_enepi_reduction as $e): ?>
                      <td class="simulation-table-second-data"><?= number_format(round($e, 0)) ?></td>
                    <?php endforeach; ?>
                    <td class="simulation-table-second-data"><?= number_format($new_enepi_reduction_average) ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          <?php endif; ?>
          <?php if (!$this->is_mobile): ?>
            <div class="data-source" style="text-align: left; color: black;">
              <span>※本ページの料金・価格情報は下記の情報及びデータをもとに算出しています</span>
              <ul>
                <li>一般財団法人日本エネルギー経済研究所 石油情報センターHPより価格情報 参照</li>
                <li>一般財団法人日本エネルギー経済研究所 石油情報センター『平成18年度プロパンガス消費実態調査』参照</li>
                <li>エネピ利用者見積もり金額より当社試算</li>
              </ul>
            </div>
          <?php endif; ?>
          <div class="simulation-again-button">
            <a href="<?= \Uri::create('simple_simulations/new') ?>" style="height: auto">
              <p style=" font-size: 110%;">もう一度シミュレーションをする →</p>
            </a>
          </div>
          <h4 class="simulation-bottom-link"><span style="font-size: 120%;">＼</span>　　今すぐおトクになるかも　　<span style="font-size: 120%;">／</span></h4>
          <a href="#" class="simulation-page-button" style="height: auto;">
            <div class="simulation-page-button-itself">
              <div class="free-img"><?= Asset::img('simulations/free-tooltip.png'); ?></div>
              <p>Webで提案を見てみる→</p>
            </div>
          </a>
          <?php if ($this->is_mobile): ?>
            <a href="tel:0120771664" class="simulation-page-button-tell" style="height: auto">
              <div class="simulation-page-button-itself">
                <p style=" font-size: 150%;">今すぐ電話で相談する</p>
              </div>
            </a>
          <?php else: ?>
            <h4 class="simulation-bottom-link"><span style="font-size: 120%;">＼</span>&nbsp;&nbsp;今すぐ電話する&nbsp;&nbsp;<span style="font-size: 120%;">／</span></h4>
            <?= Asset::img('estimate_presentation/img_tel.png', ['class' => 'tel']); ?>
          <?php endif; ?>
          <?php if ($this->is_mobile): ?>
            <div class="data-source" style="text-align: left; color: black; margin-top: 1em;">
              <span>※本ページの料金・価格情報は下記の情報及びデータをもとに算出しています</span>
              <ul>
                <li>一般財団法人日本エネルギー経済研究所 石油情報センターHPより価格情報 参照</li>
                <li>一般財団法人日本エネルギー経済研究所 石油情報センター『平成18年度プロパンガス消費実態調査』参照</li>
                <li>エネピ利用者見積もり金額より当社試算</li>
              </ul>
            </div>
          <?php endif; ?>
          <div class="simulation-result-title scroll-info" style="margin: 60px 0 20px 0;">
            <div class="simulation-result-paragraph">エネピの料金プラン イメージ</div>
          </div>
          <div style="font-size: 120%; color: black;">追加情報を入力していただくと、エネピ加盟会社の料金プランが見れます。</div>
          <div class="simulation-image-background">
            <div class="simulation-sample-image">
              <?= Asset::img('simulations/simulation1.png', ['class' => 'simulation-img']); ?>
            </div>
          </div>
          <div class="simulation-sample-point-box">
            <p class="simulation-sample-point">POINT１ 地域の厳選した会社をご提示!</p>
          </div>
          <div class="simulation-image-background">
            <div class="simulation-sample-image">
              <?= Asset::img('simulations/simulation2.png', ['class' => 'simulation-img']); ?>
            </div>
          </div>
          <div class="simulation-sample-point-box">
            <p class="simulation-sample-point">POINT２ 提案会社をわかりやすく比較！</p>
          </div>
          <div class="simulation-image-background">
            <div class="simulation-sample-image">
              <?= Asset::img('simulations/simulation3.png', ['class' => 'simulation-img']); ?>
            </div>
          </div>
          <a href="#" class="simulation-page-button" style="height: auto; margin-top: 60px;">
            <div class="simulation-page-button-itself">
              <div class="free-img"><?= Asset::img('simulations/free-tooltip.png'); ?></div>
              <p>Webで提案を見てみる→</p>
            </div>
          </a>
          <?php if ($this->is_mobile): ?>
            <a href="tel:0120771664" class="simulation-page-button-tell" style="height: auto">
              <div class="simulation-page-button-itself">
                <p style=" font-size: 150%;">今すぐ電話で相談する</p>
              </div>
            </a>
          <?php else: ?>
            <h4 class="simulation-bottom-link"><span style="font-size: 120%;">＼</span>&nbsp;&nbsp;今すぐ電話する&nbsp;&nbsp;<span style="font-size: 120%;">／</span></h4>
            <?= Asset::img('estimate_presentation/img_tel.png', ['class' => 'tel']); ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
