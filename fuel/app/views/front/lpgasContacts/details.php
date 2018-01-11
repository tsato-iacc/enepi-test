<div class="estimate">
<div class="container">

<div class="container pc">
  <?= MyView::image_tag("estimate_presentation/new_step_img_03.png", ["alt" => "New step img 03"]); ?>
</div>
<div class="hidden_pc">
  <div class="catch_area">
    <h1>連絡を希望する会社を選びましょう！</h1>
  </div>
</div>
<div class="hidden_sp">
  <h1>連絡を希望する会社を選びましょう！</h1>
</div>

<script type="text/javascript">
    window._pt_lt = new Date().getTime();
    window._pt_sp_2 = [];
    _pt_sp_2.push('setAccount,1498b80c');
    var _protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
    (function() {
        var atag = document.createElement('script'); atag.type = 'text/javascript'; atag.async = true;
        atag.src = _protocol + 'js.ptengine.jp/pta.js';
        var stag = document.createElement('script'); stag.type = 'text/javascript'; stag.async = true;
        stag.src = _protocol + 'js.ptengine.jp/pts.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(atag, s); s.parentNode.insertBefore(stag, s);
    })();
</script>

<?// _est = @contact.sent_estimates.to_a ?>
<?// est = (_est.select(&:has_price?) + _est.reject(&:has_price?)) ?>

<?= var_dump($company_feature); ?>
<?// foreach ($contact->estimate as $e){ ?>
<?//= var_dump($e); ?>
<?// } ?>

<div class="hidden_sp">
  <div class="planning_box-sp">
    <h2 class="ttl_mypage"><?= $contact->name ?>様専用のマイページ</h2>
    <div class="inner">
      <div class="inner_left">
        <h3>現在のガスの使い方</h3>
          <dl class="currant_using_info">
            <dt>地域</dt>
            <dd><?= $prefecture_kanji[key($prefecture_kanji)] ?></dd>
          </dl>
          <dl class="currant_using_info">
            <dt>ガス使用量</dt>
            <dd><?= number_format($contact->gas_used_amount, 1) ?>m3 (<?= $contact->gas_meter_checked_month ?>月)</dd>
          </dl>
          <dl class="currant_using_info">
            <dt>お支払い額(税込)</dt>
            <dd><?= number_format($contact->gas_latest_billing_amount) ?>円</dd>
          </dl>
        </div>
        <div class="inner_right">
          <h3>エネピ推奨の会社の選び方</h3>
          <dl class="recommend_using_info">
            <dt><?= MyView::image_tag("estimate_presentation/img_track.png") ?></dt>
            <dd>30分以内<br>で駆けつけ</dd>
          </dl>
          <dl class="recommend_using_info">
            <dt><?= MyView::image_tag("estimate_presentation/img_glaph.png") ?></dt>
            <dd>不当な<br>値上げなし</dd>
          </dl>
          <dl class="recommend_using_info">
            <dt><?= MyView::image_tag("estimate_presentation/img_pc.png") ?></dt>
            <dd>切替費用<br>手続不要</dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

<div class="hidden_pc">
  <div class="planning_box">
    <h2 class="ttl_mypage"><?= $contact->name ?>様専用のマイページ</h2>
    <div class="inner">
      <div class="inner_left">
        <h3>現在のガスの使い方</h3>
          <dl class="currant_using_info">
            <dt>地域</dt>
            <dd><?= $prefecture_kanji[key($prefecture_kanji)] ?></dd>
          </dl>
          <dl class="currant_using_info">
            <dt>ガス使用量</dt>
            <dd><?= number_format($contact->gas_used_amount, 1) ?>m3 (<?= $contact->gas_meter_checked_month ?>月)</dd>
          </dl>
          <dl class="currant_using_info">
            <dt>お支払い額(税込)</dt>
            <dd><?= number_format($contact->gas_latest_billing_amount) ?>円</dd>
          </dl>
        </div>
        <div class="inner_right">
          <h3>エネピ推奨の会社の選び方</h3>
          <dl class="recommend_using_info">
            <dt><?= MyView::image_tag("estimate_presentation/img_track.png") ?></dt>
            <dd>30分以内<br>で駆けつけ</dd>
          </dl>
          <dl class="recommend_using_info">
            <dt><?= MyView::image_tag("estimate_presentation/img_glaph.png") ?></dt>
            <dd>不当な<br>値上げなし</dd>
          </dl>
          <dl class="recommend_using_info">
            <dt><?= MyView::image_tag("estimate_presentation/img_pc.png") ?></dt>
            <dd>切替費用<br>手続不要</dd>
          </dl>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container section">
  <div class="hidden_pc">
    <h2>ご提案内容</h2>
  </div>
  <div class="hidden_sp">
    <h2 class="ttl_matching_main">ご提案内容</h2>
  </div>
  <div class="panel panel-default estimate">
    <div class="panel-heading">
      <h3 class="panel-title"><?//= link_to @estimate.company.name, lpgas_contact_estimate_path(@contact, @estimate, token: @contact.token) ?></h3>
      <p class="invite_date">紹介日時:<?//= format_datetime @estimate.created_at ?></p>
      </dl>
    </div>
    <div class="inner">
    <div class="info_estimates_area">
      <div class="info_l_estimates">
        <div class="thumb">
           <?= MyView::image_tag($company["lpgas_company_logo"], ["class" => "media-object"]); ?>
          <?//= image_tag @estimate.company.lpgas_company_logo.try!(:url), class: "media-object" ?>
        </div>
      </div>
      <div class="info_r_estimates">
        <?// if @estimate.has_price? ?>
        <table class="table yearly_saving_price_table">
          <tr>
            <th><?= MyView::image_tag("estimate_presentation/ico_fire.png", ["class" => "ico_fire"]); ?>年間節約費用</th>
            <td>
              <span><?//= number_to_currency @estimate.total_savings_in_year ?>円</span></td>
            </tr>
          </table>
          <?// end ?>

          <h4 class="feature_ttl">特徴</h4>
          <ul class="tags" style="margin-bottom: 1em;">
            <?// ::Lpgas::MasterCompanyFeature.all.each do |feat| ?>
            <button
            type="button"
            class="tag <?//= 'on' if @estimate.company.master_company_features.include?(feat) ?>"
            data-placement="top"
            data-trigger="hover"
            data-toggle="popover"
            title="<?//= feat.name ?>"
            data-content="<?//= feat.description ?>">
            <?//= feat.name ?>
          </button>
          <?// end ?>
        </ul>
      </div>
      </div>

      <div class="backto_list_area">
        <?//= link_to lpgas_contact_path(@contact, token: @contact.token, pin: params[:pin]), class: 'btn_list' do ?><?//= image_tag 'estimate_presentation/ico_arrow_left.png', :class => 'ico_arrow' ?>マッチング会社一覧へ戻る
        <?// end ?>
      </div>

      <div class="lines">
        <?// if @estimate.has_price? ?>
        <h3><i><?= MyView::image_tag("estimate_presentation/ico_glaph.png", ["class" => "ico_simulation_glaph"]); ?></i>年間節約シミュレーション</h3>
        <div id='chart'></div>
        <?//= render_chart(@chart, 'chart') ?>
        <div class="scrollable">
          <table class="table table-bordered simulation_table">
            <thead>
              <tr>
                <th></th>
                <?// 12.times do |t| ?>
                <th class="monthly"><?//= t + 1 ?>月</th>
                <?// end ?>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th class="currant_plan">現在のプラン (円)</th>
                <?// @savings_data_table.values.each do |row| ?>
                <td><?//= number_with_delimiter row[:before_price] ?></td>
                <?// end ?>
              </tr>
              <tr>
                <th class="proposal_plan">切り替え後 (円)</th>
                <?// @savings_data_table.values.each do |row| ?>
                <td class="proposal_price"><?//= number_with_delimiter row[:after_price] ?></td>
                <?// end ?>
              </tr>
            </tbody>
          </table>
        </div>

        <ul>
          <li>本シミュレーションは概算見積書になりますので、現地調査の結果で提示料金に変更がある場合も稀にございます。</li>
          <li>推定使用料については、平成18年度プロパンガス消費実態調査(財団法人日本エネルギー掲載研究所)のデータより試算しています。</li>
          <li>現在のガス会社様との間に、配管設備・ガス器具（給湯器等）の貸与契約があり、残存設備として同社が買取る必要がある場合には料金を変更させていただく場合がございます。</li>
        </ul>

        <p>
          <?// if @contact.sent_estimate_req? ?>
          <div class="text-center estimate_btn_area">
            <div class="hidden_pc">
              <?//= link_to 'この会社からの連絡を希望する', lpgas_contact_estimate_ok_tentatively_path(@contact, @estimate.uuid, token: @contact.token), method: 'post', class: 'btn btn-primary', onclick: "ga('send', 'event', 'matching_company_detail', 'click', 'submit_btn', {'nonInteraction': 1});" ?>
            </div>
            <div class="hidden_sp">
              <?//= link_to 'この会社からの連絡を希望する', lpgas_contact_estimate_ok_tentatively_path(@contact, @estimate.uuid, token: @contact.token), method: 'post', class: 'btn btn-primary', onclick: "ga('send', 'event', 'matching_company_detail', 'click', 'submit_btn_sp', {'nonInteraction': 1});" ?>
            </div>
          </div>
          <?// end ?>
        </p>

        <?// if @estimate.has_price? ?>
        <h3><i><?= MyView::image_tag("estimate_presentation/ico_simulation.png", ["class" => "ico_simulation_plan"]); ?></i>料金プラン</h3>
        <table class="table table-bordered simulation_table">
          <thead>
            <tr>
              <th></th>
              <th class="monthly">基本料金</th>
              <th class="monthly">従量料金</th>
              <th class="monthly">燃料調整費</th>
              <th class="monthly">月合計額(税込)</th>
            </tr>
          </thead>

          <tbody>
            <tr>
              <th class="currant_plan">現在の推定料金</th>
              <td><?//= number_to_currency @contact.basic_price ?></td>
              <td>
                <?//= number_to_currency @contact.unit_price ?> x <?//= @contact.gas_used_amount ?>m3
              </td>
              <td>
              </td>
              <td>
                <?//=
//                 number_to_currency(
//                   (
//                     @contact.basic_price +
//                     @contact.unit_price * @contact.gas_used_amount
//                     ) * 1.08
//                   )
                  ?>
                </td>
              </tr>
              <tr>
                <th class="proposal_plan">ご提案の料金</th>
                <td class="proposal_price"><?//= number_to_currency @estimate.basic_price ?></td>
                <td class="proposal_price">
                  <?// @estimate.ondemand_cost_math_exprs.each.with_index do |expr, idx| ?>
                  <div>
                    <span style="<?//= "visibility: hidden" if idx == 0 ?>">+ </span>
                    <?//= format_math_expr expr, left_formatter: -> x { number_to_currency x }, right_formatter: -> x { "%#0.1fm3" % x } ?>
                  </div>
                  <?// end ?>
                </td>
                <td class="proposal_price">
                  <?// if @estimate.fuel_adjustment_cost ?>
                  <?//= number_to_currency @estimate.fuel_adjustment_cost ?>/m3
                  <?// end ?>
                </td>
                <td class="proposal_price">
                  <?//=
//                   number_to_currency(
//                     @estimate.basic_price +
//                     @estimate.ondemand_cost_math_exprs.reduce(0) { |acc, expr| acc += expr[1].send(expr[0], expr[2]) } +
//                     (@estimate.fuel_adjustment_cost || 0) * @contact.gas_used_amount
//                     )
                    ?>
                  </td>
                </tr>
              </tbody>
            </table>
            <?// end ?>

            <?// if @estimate.has_price? ?>
            <div class="row">
              <div class="col-md-6">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title estimates_subttl">お得な機器・配管セットプラン</h4>
                  </div>
                  <div class="panel-body">
                    <?//= @estimate.set_plan ?>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title estimates_subttl">その他のセットプラン</h4>
                  </div>
                  <div class="panel-body">
                    <?//= newline_to_br @estimate.other_set_plan ?>
                  </div>
                </div>
              </div>
            </div>

            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title estimates_subttl">その他備考欄</h4>
              </div>
              <div class="panel-body">
                <?//= newline_to_br @estimate.notes ?>
              </div>
            </div>
            <?// end ?>

            <?// if @contact.sent_estimate_req? ?>
            <div class="text-center estimate_btn_area">
              <div class="hidden_pc">
                <?//= link_to 'この会社からの連絡を希望する', lpgas_contact_estimate_ok_tentatively_path(@contact, @estimate.uuid, token: @contact.token), method: 'post', class: 'btn btn-primary', onclick: "ga('send', 'event', 'matching_company_detail', 'click', 'submit_btn_middle', {'nonInteraction': 1});" ?>
              </div>
              <div class="hidden_sp">
                <?//= link_to 'この会社からの連絡を希望する', lpgas_contact_estimate_ok_tentatively_path(@contact, @estimate.uuid, token: @contact.token), method: 'post', class: 'btn btn-primary', onclick: "ga('send', 'event', 'matching_company_detail', 'click', 'submit_btn_middle_sp', {'nonInteraction': 1});" ?>
              </div>
            </div>
            <?// end ?>
        <div class="hidden_sp">
          <div class="price_increasing_info_box-sp">
            <h2 class="text-center">エネピ紹介会社は、適正な価格でのガス供給を約束します</h2>
            <h3>世の中には料金を不当に上げる悪質な業者がいます</h3>
            <p>プロパンガスの原料は石油で輸入価格が大きく上がるとガス会社は大きく打撃を受けるので、それを保護するために「原油価格に基づく料金の値上げ」が法律で認められております。しかしその制度を口実として、「輸入価格とは関わりない不当な値上げ」をする・「輸入価格が上下した際、下がった場合はそのまま高止まり」をする悪質な業者があり、「プロパンガスは高い」「徐々に値上げする」というイメージがついてしまっています。</p>

            <h3>エネピは「料金の不当な値上げをしない」会社のみ紹介します</h3>
            <p>上記の理由により、ご自身でガス会社を探した場合、値上げのリスクがあるまま使い続けることになります。また今の会社に交渉したとしても、その後数年でまた元の料金に戻る「再値上げ」のケースが非常に多く報告されています。そこで、エネピでは「不当な値上げなし」の会社の特価プランをご紹介いたします。</p>

            <h3>万が一の時も安心！エネピから不当な値上げを是正するよう交渉いたします</h3>
            <p>エネピでは原則料金を適正な価格で供給することが前提として、万が一輸入価格の変動とは関わりない不当な値上げが起きた場合、ご連絡いただければ調査させていただきます。それが不当な値上げであると判断した場合、料金を適正な価格で供給するよう交渉させていただきます。</p>
          </div>
        </div>

          <div class="hidden_pc">
            <div class="price_increasing_info_box">エネピ紹介会社は、適正な価格でのガス供給を約束します</h2>
              <h3>世の中には料金を不当に上げる悪質な業者がいます</h3>
              <p>プロパンガスの原料は石油で輸入価格が大きく上がるとガス会社は大きく打撃を受けるので、それを保護するために「原油価格に基づく料金の値上げ」が法律で認められております。しかしその制度を口実として、「輸入価格とは関わりない不当な値上げ」をする・「輸入価格が上下した際、下がった場合はそのまま高止まり」をする悪質な業者があり、「プロパンガスは高い」「徐々に値上げする」というイメージがついてしまっています。</p>

              <h3>エネピは「料金の不当な値上げをしない」会社のみ紹介します</h3>
              <p>上記の理由により、ご自身でガス会社を探した場合、値上げのリスクがあるまま使い続けることになります。また今の会社に交渉したとしても、その後数年でまた元の料金に戻る「再値上げ」のケースが非常に多く報告されています。そこで、エネピでは「不当な値上げなし」の会社の特価プランをご紹介いたします。</p>

              <h3>万が一の時も安心！エネピから不当な値上げを是正するよう交渉いたします</h3>
              <p>エネピでは原則料金を適正な価格で供給することが前提として、万が一輸入価格の変動とは関わりない不当な値上げが起きた場合、ご連絡いただければ調査させていただきます。それが不当な値上げであると判断した場合、料金を適正な価格で供給するよう交渉させていただきます。</p>
            </div>
            <?// end ?>
          </div>

            <h3><i><?//= image_tag "estimate_presentation/ico_company.png", :class => 'ico_company_info' ?></i>会社について</h3>
            <p><?//= @estimate.company.company_overview ?></p>

            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title estimates_subttl">ピックアップ</h4>
              </div>
              <div class="panel-body pickup-list">
                <?// @estimate.company.company_service_features.each do |feat| ?>
                <div class="pickup">
                  <h4 class="pickup-title"><?//= feat.title ?></h4>
                  <p class="pickup-body">
                    <?//= feat.body ?>
                  </p>
                </div>
                <?// end ?>
              </div>
            </div>

            <h3>会社概要</h3>
            <div class="scrollable">
              <table class="table table-bordered company_info">
                <tbody>
                  <tr>
                    <th>会社名</th>
                    <td><?//= @estimate.company.name ?></td>
                    <th>グループ会社</th>
                    <td><?//= @estimate.company.group_company_text ?></td>
                  </tr>
                  <tr>
                    <th>資本金</th>
                    <td><?//= number_to_currency @estimate.company.capital ?></td>
                    <th>売上高</th>
                    <td><?//= number_to_currency @estimate.company.amount_of_sales ?></td>
                  </tr>
                  <tr>
                    <th>設立年月日</th>
                    <td><?//= format_date! @estimate.company.established_date ?></td>
                    <th>従業員数</th>
                    <td><?//= @estimate.company.number_of_employee ?>人</td>
                  </tr>
                  <tr>
                    <th>所在地</th>
                    <td colspan="5">〒 <?//= @estimate.company.zip_code ?> <?//= @estimate.company.prefecture_name ?> <?//= @estimate.company.address ?></td>
                  </tr>
                  <tr>
                    <th>供給エリア</th>
                    <td colspan="3"><?//= @estimate.company.supply_area_text ?></td>
                  </tr>
                  <tr>
                    <th>事業概要</th>
                    <td colspan="3"><?//= newline_to_br @estimate.company.business_overview ?></td>
                  </tr>
                  <?// if @estimate.company.company_service_features.empty? ?>
                  <tr>
                    <th>サービスの特徴</th>
                    <td colspan="3"><?//= newline_to_br @estimate.company.service_features ?></td>
                  </tr>
                  <?// end ?>
                </tbody>
              </table>
            </div>
            <?// if @estimate.sent_estimate_to_user? ?>
            <div class="text-center estimate_btn_area">
              <div class="hidden_pc">
                <?//= link_to 'この会社からの連絡を希望する', lpgas_contact_estimate_ok_tentatively_path(@contact, @estimate.uuid, token: @contact.token), method: 'post', class: 'btn btn-primary', onclick: "ga('send', 'event', 'matching_company_detail', 'click', 'submit_btn_bottom', {'nonInteraction': 1});" ?>
              </div>
              <div class="hidden_sp">
                <?//= link_to 'この会社からの連絡を希望する', lpgas_contact_estimate_ok_tentatively_path(@contact, @estimate.uuid, token: @contact.token), method: 'post', class: 'btn btn-primary', onclick: "ga('send', 'event', 'matching_company_detail', 'click', 'submit_btn_bottom_sp', {'nonInteraction': 1});" ?>
              </div>
            </div>
            <?// end ?>
          </div>
        </div>
      </div>
    </div>

    <div class="highlighted section_second steps">
      <?//= render "shared/estimate_flow" ?>

      <div class="text-center" style="width: 80%; margin: auto;">
        <?// if @estimate.sent_estimate_to_user? ?>
        <div class="hidden_pc">
          <?//= link_to 'この会社からの連絡を希望する', lpgas_contact_estimate_ok_tentatively_path(@contact, @estimate.uuid, token: @contact.token), method: 'post', class: 'btn btn-primary', onclick: "ga('send', 'event', 'matching_company_detail', 'click', 'submit_btn_foot', {'nonInteraction': 1});" ?>
        </div>
        <div class="hidden_sp">
          <?//= link_to 'この会社からの連絡を希望する', lpgas_contact_estimate_ok_tentatively_path(@contact, @estimate.uuid, token: @contact.token), method: 'post', class: 'btn btn-primary', onclick: "ga('send', 'event', 'matching_company_detail', 'click', 'submit_btn_foot_sp', {'nonInteraction': 1});" ?>
        </div>
        <?// end ?>
      </div>
    </div>
    </div>