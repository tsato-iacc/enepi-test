<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <div class="estimate">
  <div class="container">


    <? if(Session::get_flash('estimate_verbal_ok_message')){ ?>
      <div class="alert alert-success">
        <i class="fa fa-info-circle"></i>
        <?= Session::get_flash('estimate_verbal_ok_message'); ?>
      </div>
    <? } ?>


      <div class="container pc">
        <?if($contact->status == \Config::get('models.contact.status.sent_estimate_req')){ ?>
          <?= MyView::image_tag("estimate_presentation/new_step_img_02.png"); ?>
        <? }else{ ?>
          <?= MyView::image_tag("estimate_presentation/new_step_img_03.png"); ?>
        <? } ?>
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
              <dd><?= number_format(MyView::null_check($contact->gas_used_amount), 1) ?>m3 (<?= $contact->gas_meter_checked_month ?>月)</dd>
            </dl>
            <dl class="currant_using_info">
              <dt>お支払い額(税込)</dt>
              <dd><?= number_format(MyView::null_check($contact->gas_latest_billing_amount)) ?>円</dd>
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
              <dd><?= number_format(MyView::null_check($contact->gas_used_amount), 1) ?>m3 (<?= $contact->gas_meter_checked_month ?>月)</dd>
            </dl>
            <dl class="currant_using_info">
              <dt>お支払い額(税込)</dt>
              <dd><?= number_format(MyView::null_check($contact->gas_latest_billing_amount)) ?>円</dd>
            </dl>
          </div>
          <div class="inner_right">
            <h3>エネピ推奨の会社の選び方</h3>
            <dl class="recommend_using_info">
              <dt><?= MyView::image_tag("estimate_presentation/img_track.png") ?></dt>
              <dd>30分以内で駆けつけ</dd>
            </dl>
            <dl class="recommend_using_info">
              <dt><?= MyView::image_tag("estimate_presentation/img_glaph.png") ?></dt>
              <dd>不当な値上げなし</dd>
            </dl>
            <dl class="recommend_using_info">
              <dt><?= MyView::image_tag("estimate_presentation/img_pc.png") ?></dt>
              <dd>切替費用・手続不要</dd>
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
        <h3 class="panel-title">
          <?= $estimate->company->getCompanyName() ?>
        </h3>
        <p class="invite_date">紹介日時:<?= \Helper\TimezoneConverter::convertFromString($estimate->created_at, 'front_presentation'); ?></p>
        </dl>
      </div>
      <div class="inner">
      <div class="info_estimates_area">
        <div class="info_l_estimates">
          <div class="thumb">
            <?= S3::image_tag_s3(S3::makeImageUrl($estimate->company), ["class" => "media-object", "alt" => mb_substr($estimate->company->lpgas_company_logo, 0, mb_strpos($estimate->company->lpgas_company_logo, "."))]); ?>
          </div>
        </div>
        <div class="info_r_estimates">
          <? if(!is_null($estimate->basic_price)){ ?>
            <table class="table yearly_saving_price_table">
              <tr>
                <th><?= MyView::image_tag("estimate_presentation/ico_fire.png", ["class" => "ico_fire"]); ?>年間節約費用</th>
                <td><span><?= number_format($estimate->total_savings_in_year($contact)) ?>円</span></td>
              </tr>
            </table>
          <? } ?>

          <h4 class="feature_ttl">特徴</h4>
          <ul class="tags" style="margin-bottom: 1em;">
            <?
              foreach($feature_all as $fa)
              {

                $on = " ";
                foreach($estimate->company->features as $f)
                {
                    if($f->id == $fa->id)
                    {
                        $on = " on";
                    }
                } ?>
              <button type="button" class="tag<?= $on ?>" data-placement="top" data-trigger="hover" data-toggle="popover" title="<?= $fa->name ?>" data-content="<?= $fa->description ?>">
                <?= $fa->name ?>
              </button>
            <? } ?>
          </ul>
        </div>
      </div>

        <div class="backto_list_area">
          <a<?= MyView::link_to("/lpgas/contacts/".$contact->id."?pin="."$contact->pin"."&token=".$contact->token, ["class" => "btn_list", ]); ?>>
            <?= MyView::image_tag('estimate_presentation/ico_arrow_left.png', ["class" => "ico_arrow"]); ?>マッチング会社一覧へ戻る
          </a>
        </div>

        <div class="lines">
          <? if(!is_null($estimate->basic_price)){ ?>
            <h3><i><?= MyView::image_tag("estimate_presentation/ico_glaph.png", ["class" => "ico_simulation_glaph"]); ?></i>年間節約シミュレーション</h3>
            <div id='chart'></div>
            <? if (!$this->is_mobile || !is_null($google_chart_json_data)): ?>
              <!-- GOOGLE CHART START -->
              <div id='simulation_chart'></div>
              <input type="hidden" name="google_chart_json_data" value="<?= $google_chart_json_data ?>">
              <!-- GOOGLE CHART END -->
            <? endif; ?>
            <div class="scrollable">
              <table class="table table-bordered simulation_table">
                <thead>
                  <tr>
                    <th></th>
                    <? foreach(range(1, 12) as $i){ ?>
                    <th class="monthly"><?= $i ?>月</th>
                    <? } ?>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th class="currant_plan">現在のプラン (円)</th>
                    <? foreach($estimate->savings_by_month($contact) as $sbm){ ?>
                      <td><?= number_format($sbm['before_price']) ?></td>
                    <? } ?>
                  </tr>
                  <tr>
                    <th class="proposal_plan">切り替え後 (円)</th>
                    <? foreach($estimate->savings_by_month($contact) as $sbm){ ?>
                      <td class="proposal_price"><?= number_format($sbm['after_price']) ?></td>
                    <? } ?>
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
              <?= Form::open(['action' => "lpgas/contacts/{$contact->id}/introduce"]); ?>
              <?= \Form::csrf(); ?>
                <input type="hidden" name="token" value="<?= $contact->token; ?>">
                <input type="hidden" name="pin" value="<?= $contact->pin; ?>">
                <input type='hidden' name='estimates[]' value="<?= $estimate->id; ?>">
                <?if($estimate->status == \Config::get('models.estimate.status.sent_estimate_to_user')){ ?>
                  <div class="text-center estimate_btn_area">
                    <div class="hidden_pc">
                      <?= MyView::submit_tag('commit',
                        [
                          'value' => 'この会社からの詳細を希望する', 
                          'class' => 'btn btn-primary', 
                          'rel' => 'nofollow', 
                          'data-method' => 'post', 
                          'onclick' => "ga('send', 'event', 'matching_company_detail', 'click', 'submit_btn', {'nonInteraction': 1});"
                        ]); ?>
                    </div>
                    <div class="hidden_sp">

                      <?= MyView::submit_tag('commit',
                        [
                          'value' => 'この会社からの詳細を希望する',
                          'class' => 'btn btn-primary', 
                          'rel' => 'nofollow', 
                          'data-method' => 'post', 
                          'onclick' => "ga('send', 'event', 'matching_company_detail', 'click', 'submit_btn_sp', {'nonInteraction': 1});"
                        ]); ?>
                    </div>
                  </div>
                <? } ?>
              <?= Form::close(); ?>
            </p>

            <? if(!is_null($estimate->basic_price)){ ?>
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
                  <td><?= number_format($contact->basicPrice()) ?>円</td>
                  <td><?= number_format($contact->unitPrice()) ?>円 x <?= number_format($contact->gas_used_amount, 1) ?>m3</td>
                  <td></td>
                  <td><?= number_format(($contact->basicPrice() + $contact->unitPrice() * $contact->gas_used_amount) * 1.08)  ?>円</td>
                </tr>
                <tr>
                  <th class="proposal_plan">ご提案の料金</th>
                  <td class="proposal_price"><?= number_format($estimate->basic_price) ?>円</td>
                  <td class="proposal_price">

                    <? $ondemand_cost_math_exprs = $estimate->ondemand_cost_math_exprs($contact) ?>
                    <? $exprs_count = 0; ?>
                    <? $exprs_add = 0; ?>
                    <? foreach($ondemand_cost_math_exprs as $exprs){ ?>
                      <? $exprs_add += $exprs[0] * $exprs[1]; ?>
                      <div>
                        <span style="<? if($exprs_count == 0){print('visibility: hidden');} ?>">+ </span>
                        <?= number_format(MyView::null_check($exprs[0])) ?>円 x <?= number_format($exprs[1], 1) ?>m3
                        <? $exprs_count++; ?>
                      </div>
                    <? } ?>
                  </td>
                  <td class="proposal_price">
                    <? if(!is_null($estimate->fuel_adjustment_cost)){ ?>
                      <?= number_format($estimate->fuel_adjustment_cost) ?>円/m3
                    <? } ?>
                  </td>
                  <td class="proposal_price">
                    <?= number_format($estimate->basic_price + $exprs_add + $estimate->fuel_adjustment_cost * $contact->gas_used_amount) ?>円


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
          <? } ?>

                <? if(!is_null($estimate->basic_price)){ ?>
                <div class="row">
                  <div class="col-md-6">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title estimates_subttl">お得な機器・配管セットプラン</h4>
                      </div>
                      <div class="panel-body">
                        <?= $estimate->set_plan ?>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title estimates_subttl">その他のセットプラン</h4>
                      </div>
                      <div class="panel-body">
                        <?= $estimate->other_set_plan ?>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title estimates_subttl">その他備考欄</h4>
                  </div>
                  <div class="panel-body">
                    <?= $estimate->notes ?>
                  </div>
                </div>
                <? } ?>
    
                <?= Form::open(['action' => "lpgas/contacts/{$contact->id}/introduce"]); ?>
                <?= \Form::csrf(); ?>
                  <input type="hidden" name="token" value="<?= $contact->token; ?>">
                  <input type="hidden" name="pin" value="<?= $contact->pin; ?>">
                  <input type='hidden' name='estimates[]' value="<?= $estimate->id; ?>">
                  <?if($estimate->status == \Config::get('models.estimate.status.sent_estimate_to_user')){ ?>
                    <div class="text-center estimate_btn_area">
                      <div class="hidden_pc">
                      <?= MyView::submit_tag('commit',
                        [
                          'value' => 'この会社からの詳細を希望する', 
                            'class' => 'btn btn-primary', 
                            'rel' => 'nofollow', 
                            'data-method' => 'post', 
                            'onclick' => "ga('send', 'event', 'matching_company_detail', 'click', 'submit_btn_sp', {'nonInteraction': 1});"
                        ]); ?>
                      </div>
                      <div class="hidden_sp">
                      <?= MyView::submit_tag('commit',
                        [
                          'value' => 'この会社からの詳細を希望する', 
                            'class' => 'btn btn-primary', 
                            'rel' => 'nofollow', 
                            'data-method' => 'post', 
                            'onclick' => "ga('send', 'event', 'matching_company_detail', 'click', 'submit_btn_sp', {'nonInteraction': 1});"
                        ]); ?>
                      </div>
                    </div>
                  <? }?>
                <?= Form::close(); ?>
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
              <? } ?>
            </div>
              <h3>
                <i><?= MyView::image_tag("estimate_presentation/ico_company.png", ["class" => "ico_company_info"]); ?></i>会社について
              </h3>
              <p><?= MyView::htbr($estimate->company->company_overview) ?></p>

              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title estimates_subttl">ピックアップ</h4>
                </div>
                <div class="panel-body pickup-list">
                  <? foreach($estimate->company->pickups as $feat){ ?>
                    <div class="pickup">
                      <h4 class="pickup-title"><?= $feat->title ?></h4>
                      <p class="pickup-body">
                        <?= MyView::htbr($feat->body) ?>
                      </p>
                    </div>
                  <? } ?>
                </div>
              </div>

              <h3>会社概要</h3>
              <div class="scrollable">
                <table class="table table-bordered company_info">
                  <tbody>
                    <tr>
                      <th>会社名</th>
                      <td><?= $estimate->company->getCompanyName() ?></td>
                      <th>グループ会社</th>
                      <td><?= $estimate->company->group_company_text ?></td>
                    </tr>
                    <tr>
                      <th>資本金</th>
                      <td><?= number_format(MyView::null_check($estimate->company->capital)) ?>円</td>
                      <th>売上高</th>
                      <td><?= number_format(MyView::null_check($estimate->company->amount_of_sales)) ?>円</td>
                    </tr>
                    <tr>
                      <th>設立年月日</th>
                      <td><?= date('Y/m/d', strtotime(MyView::null_check($estimate->company->established_date))) ?></td>
                      <th>従業員数</th>
                      <td><?= $estimate->company->number_of_employee ?>人</td>
                    </tr>
                    <tr>
                      <th>所在地</th>
                      <td colspan="5">〒 <?= $estimate->company->zip_code ?> <?= $prefecture_kanji[key($prefecture_kanji)] ?> <?= $estimate->company->address ?></td>
                    </tr>
                    <tr>
                      <th>供給エリア</th>
                      <td colspan="3"><?= $estimate->company->supply_area_text ?></td>
                    </tr>
                    <tr>
                      <th>事業概要</th>
                      <td colspan="3"><?= MyView::htbr($estimate->company->business_overview) ?></td>
                    </tr>
                    <? if(isset($estimate->company->pickups)){ ?>
                      <tr>
                        <th>サービスの特徴</th>
                        <td colspan="3">
                          <?= MyView::htbr($estimate->company->service_features) ?>
                        </td>
                      </tr>
                    <? } ?>
                  </tbody>
                </table>
              </div>
              <?= Form::open(['action' => "lpgas/contacts/{$contact->id}/introduce"]); ?>
              <?= \Form::csrf(); ?>
                <input type="hidden" name="token" value="<?= $contact->token; ?>">
                <input type="hidden" name="pin" value="<?= $contact->pin; ?>">
                <input type='hidden' name='estimates[]' value="<?= $estimate->id; ?>">
                <?if($estimate->status == \Config::get('models.estimate.status.sent_estimate_to_user')){ ?>
                  <div class="text-center estimate_btn_area">
                    <div class="hidden_pc">
                      <?= MyView::submit_tag('commit',
                        [
                          'value' => 'この会社からの詳細を希望する', 
                          'class' => 'btn btn-primary', 
                          'rel' => 'nofollow', 
                          'data-method' => 'post', 
                          'onclick' => "ga('send', 'event', 'matching_company_detail', 'click', 'submit_btn_bottom', {'nonInteraction': 1});"
                        ]); ?>
                    </div>
                    <div class="hidden_sp">
                      <?= MyView::submit_tag('commit',
                        [
                          'value' => 'この会社からの詳細を希望する', 
                          'class' => 'btn btn-primary', 
                          'rel' => 'nofollow', 
                          'data-method' => 'post', 
                          'onclick' => "ga('send', 'event', 'matching_company_detail', 'click', 'submit_btn_bottom_sp', {'nonInteraction': 1});"
                        ]); ?>
                    </div>
                  </div>
                <? } ?>
              <?= Form::close(); ?>
            </div>
          </div>
        </div>
      </div>

      <div class="highlighted section_second steps">
        <?= render("shared/estimate_flow") ?>

        <div class="text-center" style="width: 80%; margin: auto;">
          <?= Form::open(['action' => "lpgas/contacts/{$contact->id}/introduce"]); ?>
          <?= \Form::csrf(); ?>
            <input type="hidden" name="token" value="<?= $contact->token; ?>">
            <input type="hidden" name="pin" value="<?= $contact->pin; ?>">
            <input type='hidden' name='estimates[]' value="<?= $estimate->id; ?>">
            <?if($estimate->status == \Config::get('models.estimate.status.sent_estimate_to_user')){ ?>
              <div class="hidden_pc">
                <?= MyView::submit_tag('commit',
                  [
                    'value' => 'この会社からの詳細を希望する', 
                    'class' => 'btn btn-primary', 
                    'rel' => 'nofollow', 
                    'data-method' => 'post', 
                    'onclick' => "ga('send', 'event', 'matching_company_detail', 'click', 'submit_btn_foot', {'nonInteraction': 1});"
                  ]); ?>
              </div>
              <div class="hidden_sp">
                <?= MyView::submit_tag('commit',
                  [
                    'value' => 'この会社からの詳細を希望する', 
                    'class' => 'btn btn-primary', 
                    'rel' => 'nofollow', 
                    'data-method' => 'post', 
                    'onclick' => "ga('send', 'event', 'matching_company_detail', 'click', 'submit_btn_foot_sp', {'nonInteraction': 1});"
                  ]); ?>
              </div>
            <? } ?>
          <?= Form::close(); ?>
        </div>
      </div>
      </div>

  <script type='text/javascript'>
    google.load('visualization', '1.0', {packages: ['corechart'], callback: draw_chart});
    function draw_chart() {
      var data_table = new google.visualization.DataTable();
      data_table.addColumn({"type":"string","label":"月"});
      data_table.addColumn({"type":"number","label":"現在料金"});
      data_table.addColumn({"type":"number","label":"提案料金"});
      data_table.addRow([{v: "1月"}, {v: 9261}, {v: 5831}]);
      data_table.addRow([{v: "2月"}, {v: 8947}, {v: 5650}]);
      data_table.addRow([{v: "3月"}, {v: 8515}, {v: 5402}]);
      data_table.addRow([{v: "4月"}, {v: 8044}, {v: 5132}]);
      data_table.addRow([{v: "5月"}, {v: 7180}, {v: 4635}]);
      data_table.addRow([{v: "6月"}, {v: 6356}, {v: 4162}]);
      data_table.addRow([{v: "7月"}, {v: 5570}, {v: 3711}]);
      data_table.addRow([{v: "8月"}, {v: 5217}, {v: 3508}]);
      data_table.addRow([{v: "9月"}, {v: 5178}, {v: 3485}]);
      data_table.addRow([{v: "10月"}, {v: 6041}, {v: 3981}]);
      data_table.addRow([{v: "11月"}, {v: 6944}, {v: 4500}]);
      data_table.addRow([{v: "12月"}, {v: 8240}, {v: 5244}]);
      var chart = new google.visualization.ColumnChart(document.getElementById('chart'));
      chart.draw(data_table, {width: "100%", height: 300, title: "月別LPガス料金シミュレーション"});
    };
  </script>