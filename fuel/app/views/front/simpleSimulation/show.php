<? MyView::title("プロパンガス料金シミュレーション 結果") ?>
<? MyView::description("プロパンガス料金のシミュレーション結果ページです。ご入力頂いた内容を元に、今のガス代がどれくらい安くなるか算出しています。ガスの見直しにお役立てください。") ?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<div class="article-page">
  <div class="article">
    <div class="article-list-v3-panel">
      <div class="panel-inner article-list-v3-panel-container">
        <div class="simulation-top-box">
          <div class="simulation-result-title">
            <div class="simulation-result-paragraph">プロパンガス料金 シミュレーション結果</div>
          </div>
          <?// if defined?(@estimated_bill) ?>
          <? if(true){ ?>
            <div class="simulation-result-top-wrapper" style="margin-bottom: 30px;">
          <? }else{ ?>
            <div class="simulation-result-top-wrapper">
          <? } ?>
            <div class="usage-status">
              <div class="usage-status-title-box">
                <h4 class="usage-status-title">推定使用状況</h4>
              </div>
              <table class="usage-status-content-table-left" style="height: 9em;">
                <tr class="usage-status-content">
                  <th>■地域</th>
                  <td><?//= JpPrefecture::Prefecture.find(@city.prefecture_code).name ?><?//= Region.find(@city.city_code).city_name ?></td>
                </tr>
                <tr class="usage-status-content">
                  <th>■ガス使用量</th>
                  <td><?//= @household_average_rate.round(1) ?>㎥</td>
                </tr>
                <tr class="usage-status-content">
                  <th>■世帯人数</th>
                  <?// if @household == "two_or_less_person_household" ?>
                  <? if(true){ ?>
                    <td>2人以下</td>
<!--
                  <?// elsif @household == "three_person_household" ?>
                    <td>3人</td>
                  <?// elsif @household == "four_person_household" ?>
                    <td>4人</td>
                  <?// elsif @household == "five_person_household" ?>
                    <td>5人</td>
                  <?// elsif @household == "six_person_household" ?>
                    <td>6人</td>
                  <?// elsif @household == "seven_or_more_person_household" ?>
                    <td>7人以上</td>
 -->
                  <? } ?>
                </tr>
                <tr class="usage-status-content">
                  <?// if defined?(@bill) ?>
                  <? if(true){ ?>
                    <th>■月々のお支払い金額</th>
                    <td><?//= @bill.round.to_s(:delimited) ?>円(税込)</td>
                  <? } ?>
                  <?// if defined?(@estimated_bill) ?>
                  <? if(true){ ?>
                    <th>■月々のお支払い金額(推算)</th>
                    <td><?//= @estimated_bill.round.to_s(:delimited) ?>円(税込)</td>
                  <? } ?>
                </tr>
              </table>
            </div>
            <div class="current-price">
              <?// if defined?(@bill) ?>
              <? if(true){ ?>
                <div class="current-price-top" style="height: 80px;">
                  <div class="usage-status-title-box">
                    <h4 class="current-price-title">地域平均</h4>
                  </div>
                  <table class="usage-status-content-table">
                    <tr class="usage-status-content">
                      <th>基本料金</th>
                      <td><?//= @basic_rate.to_s(:delimited)?>円</td>
                      <th>従量料金</th>
                      <td style="font-size: 215%;"><?//= @city_average_commodity_charge.to_s(:delimited) ?>円</td>
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
                      <td><?//= @basic_rate.to_s(:delimited)?>円</td>
                      <th>従量料金</th>
                      <td style="font-size: 215%; color: red;"><?//= @commodity_charge.to_s(:delimited) ?>円</td>
                    </tr>
                  </table>
                </div>
                <div style="font-size: 10%; clear: both; text-align: right;">
                  ※基本料金は地域平均と同額として推算しています。
                </div>
              <? } ?>
              <?// if defined?(@estimated_bill) ?>
              <? if(true){ ?>
                <h4 class="current-price-title" style="margin: 0;float: left;">地域平均</h4>
                <table class="usage-status-content-table-smaller">
                  <tr class="usage-status-content">
                    <th>基本料金</th>
                    <td><?//= @basic_rate.to_s(:delimited) ?>円</td>
                  </tr>
                  <tr class="usage-status-content">
                    <th>従量料金</th>
                    <td><?//= @commodity_charge.to_s(:delimited) ?>円</td>
                  </tr>
                </table>
              <? } ?>
            </div>
          </div>
          <?// if defined?(@bill) ?>
          <? if(true){ ?>
            <div class="simulation-result-arrow">↓</div>
            <div class="simulation-result-box">
              <?//if @commodity_charge < 250 ?>
              <? if(true){ ?>
                相場に比べて十分安い料金です。
<!--
              <?//elsif 250 < @commodity_charge && @commodity_charge < @city_average_commodity_charge ?>
                相場より安い料金ですが、<?// if smart_phone? ?><br><?// } ?><span style="font-size: 150%; color: red;">エネピではもっと安くなる</span><?// if smart_phone? ?><br><?// } ?>可能性があります。
              <?//elsif @commodity_charge == @city_average_commodity_charge ?>
                相場と同じ料金です。<?// if smart_phone? ?><br><?// } ?><span style="font-size: 150%; color: red;">エネピではもっと安くなる</span><?// if smart_phone? ?><br><?// } ?>可能性があります。
              <?//elsif @city_average_commodity_charge < @commodity_charge ?>
                相場より高い料金です。<?// if smart_phone? ?><br><?// } ?><span style="font-size: 150%; color: red;">エネピではもっと安くなる</span><?// if smart_phone? ?><br><?// } ?>可能性があります。
 -->
              <? } ?>
            </div>
          <? } ?>
          <?//= MyView::link_to(Rails.application.config.form_path, ["class" => "simulation-page-button", style: "height: auto;"]); { ?>
            <div class="simulation-page-button-itself">
              <p style=" font-size: 150%;">Webで提案を見てみる→</p>
            </div>
          <?// } ?>
          <div class="simulation-result-title" style="margin-top: 3em;">
            <div class="simulation-result-paragraph">エネピ利用時の節約額</div>
          </div>
          <div class="reduction-rate-box" style="color: black;">
            <?// if @prefecture.average_reduction_rate != 0 ?>
            <? if(true){ ?>
              <?//= JpPrefecture::Prefecture.find(@city.prefecture_code).name ?>でエネピをご利用の場合<br>
                <span style="color: red; font-size: 150%;">年間<?//= @prefecture.average_reduction_rate.to_s(:delimited) ?>円</span><br>
            <? }else{ ?>
              エネピをご利用の場合<br>
              <span style="color: red; font-size: 150%;">年間<?//= @nationwide_reduction.round.to_s(:delimited) ?>円</span><br>
            <? } ?>
            ガス料金の<span style="color: red; font-size: 150%;">節約</span>が期待できます!!
          </div>
          <?// unless smart_phone? ?>
            <div id='chart'></div>
            <?//= render_chart(@chart, 'chart') ?>
            <div class="simulation-table-wrapper">
              <table class="simulation-table" border="1" style="color: black; font-size: 90%;">
                <thead>
                  <tr>
                    <th></th>
                    <?// 12.times { |t| ?>
                    <th class="monthly"><?//= t + 1 ?>月</th>
                    <?// } ?>
                    <th>平均</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th class="simulation-table-first-row">地域平均(円)</th>
                    <?// @monthly_average_price.each { |m| ?>
                      <td><?//= m.round.to_s(:delimited) ?></td>
                    <?// } ?>
                    <td><?//= @monthly_average_price_average.round.to_s(:delimited) ?></td>
                  </tr>
                  <tr>
                    <th class="simulation-table-second-row">エネピ平均削減額(円)</th>
                    <?// @new_enepi_reduction.each { |e| ?>
                      <td class="simulation-table-second-data"><?//= e.round.to_s(:delimited) ?></td>
                    <?// } ?>
                    <td class="simulation-table-second-data"><?//= @new_enepi_reduction_average.round.to_s(:delimited) ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          <?// } ?>
          <?// unless smart_phone? ?>
            <div class="data-source" style="text-align: left; color: black;">
              <span>※本ページの料金・価格情報は下記の情報及びデータをもとに算出しています</span>
              <ul>
                <li>一般財団法人日本エネルギー経済研究所 石油情報センターHPより価格情報 参照</li>
                <li>一般財団法人日本エネルギー経済研究所 石油情報センター『平成18年度プロパンガス消費実態調査』参照</li>
                <li>エネピ利用者見積もり金額より当社試算</li>
              </ul>
            </div>
          <?// } ?>
          <div class="simulation-again-button">
            <?//= MyView::link_to(new_simple_simulation_path, style: "height: auto"]); { ?>
              <p style=" font-size: 110%;">もう一度シミュレーションをする →</p>
            <?// } ?>
          </div>
          <h4 class="simulation-bottom-link"><span style="font-size: 120%;">＼</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;今すぐおトクになるかも&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size: 120%;">／</span></h4>
          <?//= MyView::link_to(Rails.application.config.form_path, ["class" => "simulation-page-button", style: "height: auto"]); { ?>
            <div class="simulation-page-button-itself">
              <p style=" font-size: 150%;">Webで提案を見てみる→</p>
            </div>
          <?// } ?>
          <?// if smart_phone? ?>
            <?//= MyView::link_to("tel:0120771664", ["class" => "simulation-page-button-tell", style: "height: auto"]); { ?>
              <div class="simulation-page-button-itself">
                <p style=" font-size: 150%;">今すぐ電話で相談する</p>
              </div>
            <?// } ?>
          <?// }else{ ?>
            <h4 class="simulation-bottom-link"><span style="font-size: 120%;">＼</span>&nbsp;&nbsp;今すぐ電話する&nbsp;&nbsp;<span style="font-size: 120%;">／</span></h4>
            <img class="tel" src="/assets/estimate_presentation/img_tel-433e3731f9d14120439bb47e16830c4fc6876dc02cf87f73ea30c0fb489bff66.png" alt="img tel 433e3731f9d14120439bb47e16830c4fc6876dc02cf87f73ea30c0fb489bff66">
          <?// } ?>
          <?// if smart_phone? ?>
            <div class="data-source" style="text-align: left; color: black; margin-top: 1em;">
              <span>※本ページの料金・価格情報は下記の情報及びデータをもとに算出しています</span>
              <ul>
                <li>一般財団法人日本エネルギー経済研究所 石油情報センターHPより価格情報 参照</li>
                <li>一般財団法人日本エネルギー経済研究所 石油情報センター『平成18年度プロパンガス消費実態調査』参照</li>
                <li>エネピ利用者見積もり金額より当社試算</li>
              </ul>
            </div>
          <?// } ?>
          <div class="simulation-result-title" style="margin: 60px 0 20px 0;">
            <div class="simulation-result-paragraph">エネピご登録後のご提案画面イメージ (例)</div>
          </div>
          <div style="font-size: 120%; color: black;">
            エネピにご登録いただくと、エネピに加盟しているプロパンガス会社から下記のようなご提案を受けることができます。
          </div>
          <div class="simulation-image-background">
            <div class="simulation-sample-image">
              <//?= MyView::image_tag("simulation1.png", :class => "simulation-img"?>
            </div>
          </div>
          <div class="simulation-sample-point-box">
            <p class="simulation-sample-point">POINT１ 地域の厳選した会社をご提示!</p>
          </div>
          <div class="simulation-image-background">
            <div class="simulation-sample-image">
              <?//= MyView::image_tag("simulation2.png", :class => "simulation-img"?>
            </div>
          </div>
          <div class="simulation-sample-point-box">
            <p class="simulation-sample-point">POINT２ 提案会社をわかりやすく比較！</p>
          </div>
          <div class="simulation-image-background">
            <div class="simulation-sample-image">
              <?//= MyView::image_tag("simulation3.png", :class => "simulation-img"?>
            </div>
          </div>
          <?//= MyView::link_to(Rails.application.config.form_path, ["class" => "simulation-page-button", style: "height: auto; margin-top: 60px;"]); { ?>
            <div class="simulation-page-button-itself">
              <p style=" font-size: 150%;">Webで提案を見てみる→</p>
            </div>
          <?// } ?>
          <?// if smart_phone? ?>
            <?//= MyView::link_to("tel:0120771664", ["class" => "simulation-page-button-tell", style: "height: auto"]); { ?>
              <div class="simulation-page-button-itself">
                <p style=" font-size: 150%;">今すぐ電話で相談する</p>
              </div>
            <?// } ?>
          <?// }else{ ?>
            <h4 class="simulation-bottom-link"><span style="font-size: 120%;">＼</span>&nbsp;&nbsp;今すぐ電話する&nbsp;&nbsp;<span style="font-size: 120%;">／</span></h4>
            <img class="tel" src="/assets/estimate_presentation/img_tel-433e3731f9d14120439bb47e16830c4fc6876dc02cf87f73ea30c0fb489bff66.png" alt="img tel 433e3731f9d14120439bb47e16830c4fc6876dc02cf87f73ea30c0fb489bff66">
          <?// } ?>
        </div>
      </div>
    </div>
  </div>
</div>
