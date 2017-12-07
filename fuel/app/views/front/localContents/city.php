<? MyView::title("【#{@prefecture_itself.name}#{@city_itself.city_name}】プロパンガス(LPガス)料金の適正価格と相場！" ?>
<? MyView::description("#{@prefecture_itself.name}#{@city_itself.city_name}のプロパンガス料金を知りたい方はこちらをチェック！お住まいの地域ごとに平均的なガス代を調べられます。プロパンガス(LPガス)は地域によって料金が異なるので、平均的なガス代を把握し、見直しに役立ててください。" ?>
<div class="article-maintitle-area">
  <div class="inner">
    <div class="image">
      <?= MyView::image_tag("japan-map.png", :class => "japan-map-img-small"?>
    </div>
    <div class="text">
      <h1 class="title" itemprop="headline"><?= @prefecture_itself.name ?><?= @city_itself.city_name ?>×プロパンガス(LPガス)の平均利用額はココでチェック!</h1>
      <ul class="categories">
        <li><i class="icon icon-tag"></i><?= MyView::link_to("LPガス/プロパンガス", "/categories/lpgas" ?></li>
      </ul>
      <p class="description" itemprop="description">
        エネピ完全オリジナル！<?= @prefecture_itself.name ?><?= @city_itself.city_name ?>のプロパンガス料金を調べることができます。石油情報センターより提供される金額を掛け合わせて算出しております。<br>
        ガス代が高いと感じている方は、このページで<?= @prefecture_itself.name ?><?= @city_itself.city_name ?>の適正料金を調べて安いガス会社へ切り替えましょう！
      </p>
    </div>
  </div>
</div>
<div class="article-page">
  <div class="article">
    <div class="article-list-v3-panel">
      <div class="panel-inner article-list-v3-panel-container">
        <div class="main">
        <div class="local-content-middle">
          <?= render "shared/social_buttons" ?>
          <div class="local-content-preface">
            <p class="local-content-middle-intro">
              <?= @prefecture_itself.name ?><?= @city_itself.city_name ?>でプロパンガスをご利用になられている方はこちらのページをご覧ください。<br>基本料金と従量単価、使用量別のガス料金を掲載しているので、ご自宅のガス料金明細書と比較することができます。<br>金額の見直しを検討される方はプロパンガス会社の無料お見積もり依頼をお試しください！<br>ページ下のボタンをクリックし、フォームに必要な情報を入力して頂くと、エネピに加盟している厳選ガス会社をご紹介致します。
            </p>
            <span>(2017年6月度更新のデータを参照)</span>
          </div>
          <div class="average-rate-box">
            <div class="average-rate-box-title">
               <h3><?= @prefecture_itself.name ?><?= @city_itself.city_name ?>のプロパンガス平均価格</h3>
            </div>
            <div class="average-rate-box-content">
              <div class="average-rate-box-basic">
                <dl>
                  <dt class="average-rate-box-data-title">基本料金</dt>
                  <? if @city.basic_rate != 0 ?>
                    <dd class="average-rate-box-data-detail"><?= @city.basic_rate.to_s(:delimited) ?>円</dd>
                  <? else ?>
                    <dd class="average-rate-box-data-detail">-</dd>
                  <? } ?>
                </dl>
              </div>
              <div class="average-rate-box-basic">
                <dl>
                  <dt class="average-rate-box-data-title">従量単価</dt>
                  <? if @city.commodity_charge != 0 ?>
                    <dd class="average-rate-box-data-detail"><?= @city.commodity_charge.to_s(:delimited) ?>円</dd>
                  <? elsif @prefecture.commodity_charge_criterion != 0 ?>
                    <dd class="average-rate-box-data-detail"><?= @prefecture.commodity_charge_criterion.to_s(:delimited) ?>円</dd>
                  <? else ?>
                    <dd class="average-rate-box-data-detail">-</dd>
                  <? } ?>
                </dl>
              </div>
            </div>
          </div>
          <span>※輸送費などにより、地域によっては全国平均と大きく異なる場合もございます。</span>
          <div class="average-usage-box">
            <h3 style=" margin: 0;"><?= @prefecture_itself.name ?><?= @city_itself.city_name ?>の人たちが使っている<br>プロパンガス(LPガス)の平均使用量</h3>
            <div class="average-usage-box-circle">
              <div class="average-usage-box-data">
                <? if @city.average_usage != 0 ?>
                  <?= @city.average_usage.round(1) ?>㎥
                <? else ?>
                  -
                <? } ?>
              </div>
            </div>
          </div>

          <div class="average-rate-list-box">
            <h3 class="average-monthly-rate-title"><?= @prefecture_itself.name ?><?= @city_itself.city_name ?>の使用量別<br>1ヶ月の平均プロパンガス料金</h3>
            <table summary="<?= @prefecture_itself.name ?><?= @city_itself.city_name ?>の使用量別1ヶ月の平均プロパンガス料金" border width="80%" height="200" cellspacing="0" cellpadding="0" style="margin: auto;">
              <tr align="center">
                <th class="usage-breakdown">ガス使用量</th>
                <th class="usage-breakdown">平均ガス代</th>
              </tr>
              <tr align="center">
                <td class="usage-breakdown-data">▼5㎥</td>
                <? if @city.five_cubic_meters_price != 0 ?>
                  <td class="usage-breakdown-data"><?= @city.five_cubic_meters_price.to_s(:delimited) ?>円/月</td>
                <? elsif @prefecture.five_cubic_meters_price != 0 ?>
                  <td class="usage-breakdown-data"><?= @prefecture.five_cubic_meters_price.to_s(:delimited) ?>円/月</td>
                <? else ?>
                  <td class="usage-breakdown-data">-</td>
                <? } ?>
              </tr>
              <tr align="center">
                <td class="usage-breakdown-data">▼10㎥</td>
                <? if @city.ten_cubic_meters_price != 0 ?>
                  <td class="usage-breakdown-data"><?= @city.ten_cubic_meters_price.to_s(:delimited) ?>円/月</td>
                <? elsif @prefecture.ten_cubic_meters_price != 0 ?>
                  <td class="usage-breakdown-data"><?= @prefecture.ten_cubic_meters_price.to_s(:delimited) ?>円/月</td>
                <? else ?>
                  <td class="usage-breakdown-data">-</td>
                <? } ?>
              </tr>
              <tr align="center">
                <td class="usage-breakdown-data">▼20㎥</td>
                <? if @city.twenty_cubic_meters_price != 0 ?>
                  <td class="usage-breakdown-data"><?= @city.twenty_cubic_meters_price.to_s(:delimited) ?>円/月</td>
                <? elsif @prefecture.twenty_cubic_meters_price != 0 ?>
                  <td class="usage-breakdown-data"><?= @prefecture.twenty_cubic_meters_price.to_s(:delimited) ?>円/月</td>
                <? else ?>
                  <td class="usage-breakdown-data">-</td>
                <? } ?>
              </tr>
              <tr align="center">
                <td class="usage-breakdown-data">▼50㎥</td>
                <? if @city.fifty_cubic_meters_price != 0 ?>
                  <td class="usage-breakdown-data"><?= @city.fifty_cubic_meters_price.to_s(:delimited) ?>円/月</td>
                <? elsif @prefecture.fifty_cubic_meters_price != 0 ?>
                  <td class="usage-breakdown-data"><?= @prefecture.fifty_cubic_meters_price.to_s(:delimited) ?>円/月</td>
                <? else ?>
                  <td class="usage-breakdown-data">-</td>
                <? } ?>
              </tr>
            </table>
          </div>
          
          <? if @prefecture.average_reduction_rate != 0 ?>
            <div class="average-reduction-rate-box">
              <h3 class="average-monthly-rate-title">そのガス代、もっとおトクに!?</h3>
              <div class="average-reduction-rate-head-title">
                エネピでガス会社を切り替えた<?= @prefecture_itself.name ?>の人たちの平均削減額は...
              </div>
              <div>
                <dl>
                  <dt class="average-reduction-rate-title">1ヶ月で</dt>
                  <dd class="average-reduction-rate-detail"><?= @prefecture.average_reduction_rate.div(12).to_s(:delimited) ?>円削減!</dd>
                </dl>
                <dl>
                  <dt class="average-reduction-rate-title">1年間にすると</dt>
                  <dd class="average-reduction-rate-detail"><?= @prefecture.average_reduction_rate.to_s(:delimited) ?>円削減!</dd>
                </dl>
              </div>
            </div>
          <? } ?>
          <?= MyView::link_to(Rails.application.config.form_path, ["class" => "estimate-link-button", style: "height: auto"]); { ?>
            <div class="estimate-link-button-text">
              <p>プロパンガスの切り替え見積もり依頼をする！</p>
            </div>
          <? } ?>

          <!-- CITY LIST START -->
          <div class="city-list-box">
            <h3 class="title-price-info"><?= @prefecture_name ?>の各市区町村</h3>
            <span>お住まいの市区町村をクリックすると、市区町村別の料金ページが見れます</span>
            <div class="city-list">
              <? if @regions.present? ?>
                <ul　style="padding-left: 0;">
                  <? @regions.each { |region| ?>
                    <li class="city-list-content"><?= MyView::link_to("・#{region.city_name}","/local_contents/city_show/#{region.id}" ?></li>
                  <? } ?>
                </ul>
              <? } ?>
            </div>
          </div>
          <!-- CITY LIST END -->

          <div class="average-rate-box" style="margin-bottom: 10px;">
            <div class="average-rate-box-title">
               <h3>全国のプロパンガス(LPガス)平均価格</h3>
            </div>
            <div class="average-rate-box-content">
              <div class="average-rate-box-basic">
                <dl>
                  <dt class="average-rate-box-data-title">基本料金</dt>
                  <dd class="average-rate-box-data-detail"><?= LpgasLocalContentPrefecture.average(:basic_rate).round.to_s(:delimited) ?>円</dd>
                </dl>
              </div>
              <div class="average-rate-box-basic">
                <dl>
                  <dt class="average-rate-box-data-title">従量単価</dt>
                  <dd class="average-rate-box-data-detail"><?= LpgasLocalContentPrefecture.average(:commodity_charge_criterion).round.to_s(:delimited) ?>円</dd>
                </dl>
              </div>
            </div>
          </div>
          <? if @reviews.present? ?>
            <div class="data-source">
              <span>※本ページの料金・価格情報は下記の情報及びデータをもとに算出しています</span>
              <ul>
                <li>一般財団法人日本エネルギー経済研究所 石油情報センターHPより価格情報 参照</li>
                <li>一般財団法人日本エネルギー経済研究所 石油情報センター『平成18年度プロパンガス消費実態調査』参照</li>
                <li>エネピ利用者見積もり金額より当社試算</li>
              </ul>
            </div>
            <div class="word-of-mouth-box">
              <div class="word-of-mouth-title"><h3 class="word-of-mouth-title-itself"><?= @prefecture_itself.name ?><?= @city_itself.city_name ?>の口コミ一覧</h3></div>
                <ul class="word-of-mouth-wrapper">
                  <? @reviews.each { |r| ?>
                    <li class="word-of-mouth-list">
                      <div class="word-of-mouth-header">
                        <div class="reviewer-info">
                          <i class="fa fa-user fa-lg"></i>
                          <span class="personal-info"><?= @prefecture_itself.name ?><?= @city_itself.city_name ?>在住/</span>
                          <span class="personal-info"><?= r.reviewer_gender ?></span>
                          <? if r.reviewer_age.present? ?>
                            <span class="personal-info"><?= r.reviewer_age ?>歳/</span>
                          <? } ?>
                          <span class="personal-info"><?= r.reviewer_occupation ?></span>
                        </div>
                        <ul class="detail-list">
                          <li><span>エネピの利用有無:
                          <? if r.with_enepi_or_not == 0 ?>利用した
                          <? else ?>
                            利用しなかった
                          <? } ?>
                          </span></li>
                          <li>
                          <? if r.contracted_or_considering == 0 ?>
                            <span>切り替えした人の声</span>
                          <? else ?>
                            <span>検討者の声</span>
                          <? } ?>
                          </li>
                        </ul>
                      </div>
                    </li>
                    <div class="word-of-mouth-content">
                      <p><?= r.word_of_mouth.gsub(/\r\n|\r|\n/, "<br />").html_safe ?></p>
                    </div>
                  <? } ?>
                </ul>
            </div>
          <? else ?>
            <div class="data-source">
              <span>※本ページの料金・価格情報は下記の情報及びデータをもとに算出しています</span>
              <ul>
                <li>一般財団法人日本エネルギー経済研究所 石油情報センターHPより価格情報 参照</li>
                <li>一般財団法人日本エネルギー経済研究所 石油情報センター『平成18年度プロパンガス消費実態調査』参照</li>
                <li>エネピ利用者見積もり金額より当社試算</li>
              </ul>
            </div>
          <? } ?>
        <?= render "shared/local_contents_bottom_part" ?>
        </div>
        </div>
        <?= render "shared/articles_sidebar" ?>
      </div>
    </div>
  </div>
</div>
