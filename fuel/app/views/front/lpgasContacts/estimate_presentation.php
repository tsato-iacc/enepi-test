<style>
.checkbox-big input[type="checkbox"]+label {
  background-image: url(/assets/images/checkbox2.png);
}
</style>



<?

Mail::mail_send("");

?>



<div class="estimate">
  <div class="container">

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

      <div class="container section">
        <?= Form::open(['action' => '/lpgas/contacts/'.$contact->id.'/estimates/ok_tentatively']); ?>
        <?= \Form::csrf(); ?>
        <input type="hidden" name="token" value="<?= $contact->token ?>" />

        <div class="hidden_sp">
          <div class="planning_box-sp">
            <h2 class="ttl_mypage"><?= $contact->name ?>様専用のマイページ</h2>
            <div class="inner">
              <div class="inner_left">
                <h3>推定使用状況</h3>
                <dl class="currant_info_list">
                  <dt>地域:</dt>
                  <dd><?= $prefecture_kanji[key($prefecture_kanji)] ?></dd>
                </dl>
                <dl class="currant_info_list">
                  <dt>ガス使用量:</dt>
                  <dd><?= number_format(MyView::null_check($contact->gas_used_amount), 1) ?>m3 (<?= $contact->gas_meter_checked_month ?>月)</dd>
                </dl>
                <dl class="currant_info_list">
                  <dt>お支払い額(税込):</dt>
                  <dd><?= number_format(MyView::null_check($contact->gas_latest_billing_amount)) ?>円</dd>
                </dl>
              </div>
              <div class="inner_right">
                <h3>エネピの紹介会社条件</h3>
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
            <?if($contact->status == \Config::get('models.contact.status.sent_estimate_req')){ ?>
              <div class="text-center estimate_btn_area">
                <div class="hidden_pc">
                  <p class="big">
                    上記をクリアした<span style="color: #f93f3f"><?= $est_count ?>社</span>のプランをご提案します<br>
                  </p>
                </div>
                <div class="hidden_sp">
                  <p class="big">
                    上記をクリアした<span style="color: #f93f3f"><?= $est_count ?>社</span>の<br>プランをご提案します
                  </p>
                </div>
                <div class="hidden_pc">
                  <?= MyView::submit_tag("commit", ["value" => "チェックを入れた会社からの連絡を希望する", "class" => "btn btn-primary", "onclick" => "ga('send', 'event', 'matching', 'click', 'submit_btn', {'nonInteraction': 1});"]) ?>
                </div>
                <div class="hidden_sp">
                  <?= MyView::submit_tag("commit", ["value" => "チェック済会社の連絡希望", "class" => "btn btn-primary", "onclick" => "ga('send', 'event', 'matching', 'click', 'submit_btn_sp', {'nonInteraction': 1});"]) ?>
                </div>
              </div>
            <? }else{ ?>
              <div class="text-center estimate_btn_area">
                <ul class="big" style="color: #f93f3f">
                  <? foreach ($est as $e) { ?>
                  <? if($e->status == 3){ ?>
                  <li><?= $e->company->display_name ?>への連絡希望を承りました。</li>
                  <? } ?>
                  <? } ?>
                </ul>
                <? if($est_count_sent_estimate_to_user > 0){ ?>
                <p class="big">追加の連絡希望がございましたら以下よりお選びください。</p>
                <div class="hidden_pc">
                  <?= MyView::submit_tag("commit", ["value" => "チェックを入れた会社からの連絡を希望する", "class" => "btn btn-primary", "onclick" => "ga('send', 'event', 'matching', 'click', 'submit_btn', {'nonInteraction': 1});"]) ?>
                </div>
                <div class="hidden_sp">
                  <?= MyView::submit_tag("commit", ["value" => "チェック済会社の連絡希望", "class" => "btn btn-primary", "onclick" => "ga('send', 'event', 'matching', 'click', 'submit_btn_sp', {'nonInteraction': 1});"]) ?>
                </div>
                <? } ?>
              </div>
            <? } ?>
          </div>
        </div>

        <div class="hidden_pc">
          <div class="planning_box">
            <h2 class="ttl_mypage"><?= $contact->name ?>様専用のマイページ</h2>
            <div class="inner">
              <div class="inner_left">
                <h3>推定使用状況</h3>
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
                <h3>エネピの紹介会社条件</h3>
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
            <div class="case_btn_area">
              <a href="#case-contents" class="btn_cases" onclick="ga('send', 'event', 'matching', 'click', 'howto_choose_link_btn', {'nonInteraction': 1});"><i class="fa fa-flag" aria-hidden="true"></i>どう選べばいいの？</a>
            </div>
            <?if($contact->status == \Config::get('models.contact.status.sent_estimate_req')){ ?>
              <div class="text-center estimate_btn_area">
                <p class="big">
                  上記をクリアした<span style="color: #f93f3f"><?= $est_count ?>社</span>のプランをご提案します<br>
                </p>
                <div class="hidden_pc">
                  <?= MyView::submit_tag("commit", ["value" => "チェックを入れた会社からの連絡を希望する", "class" => "btn btn-primary", "onclick" => "ga('send', 'event', 'matching', 'click', 'submit_btn', {'nonInteraction': 1});"]) ?>
                </div>
                <p class="big" style="margin: 1% 0 1% 0;">ご希望条件がありましたら下記を選択の上、希望ボタンを押してください</p>
                <div>
                  <label>希望連絡時間帯:</label>
                  <select name="preferred_contact_time_between">
                    <option value="0" selected>いつでも</option>
                    <option value="1">9:00~12:00</option>
                    <option value="2">12:00~15:00</option>
                    <option value="3">15:00~18:00</option>
                    <option value="4">18:00~21:00</option>
                  </select>
                </div>
                <div>
                  <label>緊急度:</label>
                  <label class="radio-inline"><input type="radio" name="priority_degree" value="0" checked>通常</label>
                  <label class="radio-inline"><input type="radio" name="priority_degree" value="1">至急</label>
                </div>
                <div>
                  <label>電気料金セットを希望する:</label>
                  <label class="radio-inline"><input type="radio" name="desired_option" value="1">する</label>
                  <label class="radio-inline"><input type="radio" name="desired_option" value="0" checked>しない</label>
                </div>
                <div class="hidden_sp">
                  <?= MyView::submit_tag("commit", ["value" => "チェック済会社の連絡希望", "class" => "btn btn-primary", "onclick" => "ga('send', 'event', 'matching', 'click', 'submit_btn_sp', {'nonInteraction': 1});"]) ?>
                </div>
              </div>
            <? }else{ ?>
              <div class="text-center estimate_btn_area">
                <ul class="big" style="color: #f93f3f">
                  <? foreach ($est as $e) { ?>
                    <? if($e->status == 3){ ?>
                      <li><?= $e->company->display_name ?>への連絡希望を承りました。</li>
                    <? } ?>
                  <? } ?>
                </ul>
                <? if($est_count_sent_estimate_to_user > 0){ ?>
                  <p class="big">追加の連絡希望がございましたら以下よりお選びください。</p>
                  <div class="hidden_sp">
                    <?= MyView::submit_tag("commit", ["value" => "チェックを入れた会社からの連絡を希望する", "class" => "btn btn-primary", "onclick" => "ga('send', 'event', 'matching', 'click', 'submit_btn', {'nonInteraction': 1});"]) ?>
                  </div>
                  <div class="hidden_sp">
                    <?= MyView::submit_tag("commit", ["value" => "チェック済会社の連絡希望", "class" => "btn btn-primary", "onclick" => "ga('send', 'event', 'matching', 'click', 'submit_btn_sp', {'nonInteraction': 1});"]) ?>
                  </div>
                <? } ?>
              </div>
            <? } ?>
          </div>
        </div>

        <div class="hidden_pc">
          <h2>ご希望にマッチした会社一覧<span class="check_assist">（<span>左側にあるチェックボックス</span>にチェックを入れ、ボタンを押してください）</span></h2>
        </div>
        <div class="hidden_sp">
          <h2 class="ttl_matching_main">ご希望にマッチした会社一覧</h2>
        </div>

          <?$count = 0; ?>
          <? foreach ($est as $e) { ?>
            <div class="hidden_sp">
              <div class="panel matching-list-area estimate <? if(!is_null($e->basic_price)){print "has-price";} ?>">
                <div class="matching-list-heading">
                  <div class="company-name-ttl">
                    <div class="checkbox-big-sp">
                      <input type="checkbox">
                      <?if($e->status ==\Config::get('models.estimate.status.sent_estimate_to_user')){ ?>
                        <?=  MyView::checkbox_tag("estimate_ids[".$count."]", ["id" => "estimate_ids_".$count, "value" => $e->uuid, "class" => "form-control",]) ?>
                      <? } ?>
                      <label role="button" for="estimate_ids_<?= $count ?>"></label>
                    </div>
                    <h3><?= $e->company->display_name ?></h3>
                    <? if($e->status == 3){ ?>
                      <span class="label label_matching_done">連絡希望チェック済み</span>
                    <? } ?>
                  </div>
                  <p class="invite_date">紹介日時:<?= date('Y/m/d H:i', strtotime(MyView::null_check($e->created_at))) ?></p>
                </div>

                <div class="inner">
                  <div style="clear:both;">
                    <div class="company-logo">
                      <?= S3::image_tag_s3($e->company->lpgas_company_logo, ["class" => "media-object", "alt" => mb_substr($e->company->lpgas_company_logo, 0, mb_strpos($e->company->lpgas_company_logo, "."))]); ?>
                    </div>
                    <div style="width: 50%; float:right;">
                      <table class="table yearly_saving_price_table">
                        <tr>
                          <th>年間節約費用</th>
                        </tr>
                        <tr>
                          <td>
                            <? if(!is_null($e->basic_price)){ ?>
                              <span><?= number_format($e->total_savings_in_year($contact)) ?>円</span>
                            <? }else{ ?>
                              <p class="privacy_price">料金非公開</p>
                            <? } ?>
                          </td>
                        </tr>
                      </table>
                    </div>
                  </div>

                  <table class="table relation_price_table <? if(!is_null($e->basic_price)){print "has-price";} ?>">
                    <tr>
                      <th>
                        違約金
                        <a href="#" data-toggle="tooltip" title="契約後、解約した場合、違約金が発生する期間・料金がない会社かどうかを表示しています。">
                          <?= MyView::image_tag("estimate_presentation/ico_question.png", ["class" => "ico_question"]); ?>
                        </a>
                      </th>
                      <td>
                        <? $penalty = 'あり'; ?>
                        <? foreach($e->company->features as $f){ ?>
                        <? if($f->name == '違約金なし'){$penalty = 'なし';} ?>
                        <? } ?>
                        <?= $penalty ?>
                      </td>
                      <th>
                        セット割
                        <a href="#" data-toggle="tooltip" title="プロパンガスの契約の際に、セットで契約するとお得になるプランがある会社を表示しています。">
                          <?= MyView::image_tag("estimate_presentation/ico_question.png", ["class" => "ico_question"]); ?>
                        </a>
                      </th>
                      <td>
                        <? $set_discount = 'なし'; ?>
                        <? foreach($e->company->features as $f){ ?>
                        <? if($f->name == 'セット割'){$set_discount = 'あり';} ?>
                        <? } ?>
                        <?= $set_discount ?>
                      </td>
                    </tr>
                  </table>

                  <? if(!is_null($e->basic_price)){ ?>
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title accordion-toggle">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne-<?= $count ?>">おすすめポイント</a>
                        </h4>
                      </div>
                      <div id="collapseOne-<?= $count ?>" class="panel-collapse collapse">
                        <div class="panel-body">
                          <ul class="recommend_point">
                            <? foreach($e->company->company_service_features as $sf){ ?>
                              <li><?= MyView::image_tag("estimate_presentation/ico_checkpoint.png", ["class" => "ico_checkpoint"]); ?><?= $sf->title ?></li>
                            <? } ?>
                          </ul>
                        </div>
                      </div>
                    </div>

                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title accordion-toggle">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo-<?= $count ?>">ご提案料金（概算）</a>
                        </h4>
                      </div>
                      <div id="collapseTwo-<?= $count ?>" class="panel-collapse collapse">
                        <div class="panel-body">
                          <table class="table table-bordered proposal_price_table">
                            <thead>
                              <tr>
                                <th>基本料金</th>
                                <th>従量単価</th>
                                <th>燃料調整費</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>
                                  <?= number_format(MyView::null_check($e->basic_price)); ?>円
                                </td>
                                <td>
                                  <? if(count($e->prices) == 1){ ?>
                                    <? foreach($e->prices as $p){ ?>
                                      <?= number_format(MyView::null_check($p->unit_price)); ?>円
                                    <? } ?>
                                  <? }else{ ?>
                                    <ul>
                                      <? foreach($e->prices as $p){ ?>
                                        <li>
                                          <b><?= $p->getRangeLabel() ?>:</b>
                                          <?= number_format(MyView::null_check($p->unit_price)); ?>円
                                        </li>
                                      <? } ?>
                                    </ul>
                                  <? } ?>
                                </td>
                                <td>
                                  <?= number_format(MyView::null_check($e->fuel_adjustment_cost)); ?>円
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  <? }else{ ?>
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title accordion-toggle">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo-<?= $count ?>">ご提案料金（概算）
                          </a>
                        </h4>
                      </div>
                      <div id="collapseTwo-<?= $count ?>" class="panel-collapse collapse">
                        <div class="panel-body">
                          <table class="table table-bordered proposal_price_table">
                            <thead>
                              <tr>
                                <th>基本料金</th>
                                <th>従量単価</th>
                                <th>燃料調整費</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  <? } ?>
                  <div class="bt_company_detail">
                      <a<?= MyView::link_to(
                        "/lpgas/contacts/".$contact->id."/estimates/"."$e->uuid"."?pin="."$contact->pin"."&amp;token="."$contact->token",
                        ["class" => "btn_detail", ]
                      ); ?>>
                      詳しく見る<?= MyView::image_tag("estimate_presentation/ico_arrow.png", ["class" => "ico_arrow"]); ?>
                      </a>
                  </div>
                </div>
              </div>
            </div>

            <div class="hidden_pc">
              <div class="panel panel-default estimate <? if(!is_null($e->basic_price)){print "has-price";} ?>">
                <div class="panel-heading">
                  <h3>
                    <?= $e->company->display_name ?>
                    <? if($e->status == 3){ ?>
                    <span class="label label_matching">連絡希望チェック済み</span>
                    <? } ?>
                  </h3>

                  <dl class="invite_date">
                    <dt>紹介日時:</dt>
                    <dd><?= date('Y/m/d H:i', strtotime(MyView::null_check($e->created_at))) ?></dd>
                  </dl>
                </div>

                <dl class="contacts_list_area">
                  <dt>
                    <div class="checkbox-big">
                      <?if($e->status ==\Config::get('models.estimate.status.sent_estimate_to_user')){ ?>
                        <?=  MyView::checkbox_tag("estimate_ids[".$count."]", ["id" => "estimate_ids_".$count, "value" => $e->uuid, "class" => "form-control",]) ?>
                      <? } ?>
                      <label role="button" for="estimate_ids_<?= $count ?>"></label>
                    </div>
                  </dt>
                  <dd>
                    <div class="info_l">
                      <div class="thumb">
                        <?= S3::image_tag_s3(S3::makeImageUrl($e), ["class" => "media-object", "alt" => mb_substr($e->company->lpgas_company_logo, 0, mb_strpos($e->company->lpgas_company_logo, "."))]); ?>
                      </div>
                    </div>

                    <div class="info_r">
                      <table class="table yearly_saving_price_table">
                        <tr>
                          <th><?= MyView::image_tag("estimate_presentation/ico_fire.png", ["class" => "ico_fire"]); ?>年間節約費用</th>
                          <td>
                            <? if(!is_null($e->basic_price)){ ?>
                              <span><?= number_format($e->total_savings_in_year($contact)) ?>円</span>
                            <? }else{ ?>
                              <p class="privacy_price">料金非公開<br>（お問い合わせください）</p>
                            <? } ?>
                          </td>
                        </tr>
                      </table>

                      <table class="table relation_price_table <? if(!is_null($e->basic_price)){print "has-price";} ?>">
                        <tr>
                          <th>
                            <?= MyView::image_tag("estimate_presentation/ico_money.png", ["class" => "ico_money"]); ?>違約金<a href="#" data-toggle="tooltip" title="契約後、解約した場合、違約金が発生する期間・料金がない会社かどうかを表示しています。"><?= MyView::image_tag("estimate_presentation/ico_question.png", ["class" => "ico_question"]); ?></a>
                          </th>
                          <td>
                            <? $penalty = 'あり'; ?>
                            <? foreach($e->company->features as $f){ ?>
                              <? if($f->name == '違約金なし'){$penalty = 'なし';} ?>
                            <? } ?>
                            <?= $penalty ?>
                          </td>
                          <th>
                            <?= MyView::image_tag("estimate_presentation/ico_discount_tag.png", ["class" => "ico_discount_tag"]); ?>セット割<a href="#" data-toggle="tooltip" title="プロパンガスの契約の際に、セットで契約するとお得になるプランがある会社を表示しています。"><?= MyView::image_tag("estimate_presentation/ico_question.png", ["class" => "ico_question"]); ?></a>
                          </th>
                          <td>
                            <? $set_discount = 'なし'; ?>
                            <? foreach($e->company->features as $f){ ?>
                              <? if($f->name == 'セット割'){$set_discount = 'あり';} ?>
                            <? } ?>
                            <?= $set_discount ?>
                          </td>
                        </tr>
                      </table>
                    </div>
                    <? if(!is_null($e->basic_price)){ ?>
                      <div class="info_area">
                       <div class="info_l" >
                         <h4 class="subttl">おすすめポイント</h4>
                         <ul class="recommend_point">
                           <? foreach($e->company->company_service_features as $sf){ ?>
                             <li><?= MyView::image_tag("estimate_presentation/ico_checkpoint.png", ["class" => "ico_checkpoint"]); ?><?= $sf->title ?></li>
                           <? } ?>
                         </ul>
                       </div>
                      </div>

                      <div class="info_r">
                        <h4 class="subttl">ご提案料金（概算）</h4>
                        <table class="table table-bordered proposal_price_table">
                          <thead>
                            <tr>
                              <th>基本料金</th>
                              <th>従量単価</th>
                              <th>燃料調整費</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>
                                <?= number_format(MyView::null_check($e->basic_price)); ?>円
                              </td>
                              <td>
                                <? if(count($e->prices) == 1){ ?>
                                <? foreach($e->prices as $p){ ?>
                                <?= number_format(MyView::null_check($p->unit_price)); ?>円
                                <? } ?>
                                <? }else{ ?>
                                <ul>
                                  <? foreach($e->prices as $p){ ?>
                                  <li>
                                    <b><?= $p->getRangeLabel() ?>:</b>
                                    <?= number_format(MyView::null_check($p->unit_price)); ?>円
                                  </li>
                                  <? } ?>
                                </ul>
                                <? } ?>
                              </td>
                              <td>
                                <?= number_format(MyView::null_check($e->fuel_adjustment_cost)); ?>円
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    <? }else{ ?>
                      <div class="info_area">
                        <div class="info_l" >
                          <h4 class="subttl">おすすめポイント</h4>
                          <ul class="recommend_point">
                            <? foreach($e->company->company_service_features as $sf){ ?>
                            <li><?= MyView::image_tag("estimate_presentation/ico_checkpoint.png", ["class" => "ico_checkpoint"]); ?><?= $sf->title ?></li>
                            <? } ?>
                          </ul>
                        </div>

                        <div class="info_r">
                          <h4 class="subttl">ご提案料金（概算）</h4>
                          <table class="table table-bordered proposal_price_table">
                            <thead>
                              <tr>
                                <th>基本料金</th>
                                <th>従量単価</th>
                                <th>燃料調整費</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    <? } ?>
                    <div class="bt_company_detail">
                      <a<?= MyView::link_to("/lpgas/contacts/".$contact->id."/estimates/"."$e->uuid"."?pin="."$contact->pin"."&amp;token="."$contact->token", ["class" => "btn_detail", ]); ?>>
                      詳しく見る<?= MyView::image_tag("estimate_presentation/ico_arrow.png", ["class" => "ico_arrow"]); ?>
                      </a>
                    </div>
                  </dd>
                </dl>
              </div>
            </div>
            <?$count++; ?>
         <? } ?>

        <? if($est_count_sent_estimate_to_user > 0){ ?>
          <div class="text-center estimate_btn_area_bt">
            <div class="hidden_pc">
              <?= MyView::submit_tag("commit", ["value" => "チェックを入れた会社からの連絡を希望する", "class" => "btn btn-primary", "onclick" => "ga('send', 'event', 'matching', 'click', 'submit_btn_bottom', {'nonInteraction': 1});"]) ?>
            </div>
            <div class="hidden_sp">
              <?= MyView::submit_tag("commit", ["value" => "チェック済会社の連絡希望", "class" => "btn btn-primary", "onclick" => "ga('send', 'event', 'matching', 'click', 'submit_btn_bottom_sp', {'nonInteraction': 1});"]) ?>
            </div>
          </div>
        <? } ?>
        <?= Form::close(); ?>

        <p class="resource_info_txt">お客様専用に開示する情報も含まれますので、内容やURLの第三者への提供・転送は禁止とさせていただきます。</p>

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
          <div class="price_increasing_info_box">
            <h2 class="text-center"><?= MyView::image_tag("estimate_presentation/ico_moneycost.png", ["class" => "ico_moneycost"]); ?>エネピ紹介会社は、適正な価格でのガス供給を約束します</h2>
            <h3>世の中には料金を不当に上げる悪質な業者がいます</h3>
            <p>プロパンガスの原料は石油で輸入価格が大きく上がるとガス会社は大きく打撃を受けるので、それを保護するために「原油価格に基づく料金の値上げ」が法律で認められております。しかしその制度を口実として、「輸入価格とは関わりない不当な値上げ」をする・「輸入価格が上下した際、下がった場合はそのまま高止まり」をする悪質な業者があり、「プロパンガスは高い」「徐々に値上げする」というイメージがついてしまっています。</p>

            <h3>エネピは「料金の不当な値上げをしない」会社のみ紹介します</h3>
            <p>上記の理由により、ご自身でガス会社を探した場合、値上げのリスクがあるまま使い続けることになります。また今の会社に交渉したとしても、その後数年でまた元の料金に戻る「再値上げ」のケースが非常に多く報告されています。そこで、エネピでは「不当な値上げなし」の会社の特価プランをご紹介いたします。</p>

            <h3>万が一の時も安心！エネピから不当な値上げを是正するよう交渉いたします</h3>
            <p>エネピでは原則料金を適正な価格で供給することが前提として、万が一輸入価格の変動とは関わりない不当な値上げが起きた場合、ご連絡いただければ調査させていただきます。それが不当な値上げであると判断した場合、料金を適正な価格で供給するよう交渉させていただきます。</p>
          </div>
        </div>
        <div class="hidden_pc">
          <div class="container faq section_second">
            <h2 class="ttl-case-contents">お問い合わせ目的別ガイド</h2>
            <ul class="nav nav-tabs" style="margin-top: 0;" id="case-contents">
              <li class="active"><a href="#tab1" data-toggle="tab" onclick="ga('send', 'event', 'matching', 'click', 'howto_choose_tab1', {'nonInteraction': 1});">今の家で切り替え予定の方</a></li>
              <li><a href="#tab2" data-toggle="tab" onclick="ga('send', 'event', 'matching', 'click', 'howto_choose_tab2', {'nonInteraction': 1});">新築物件へお引越しの方</a></li>
              <li><a href="#tab3" data-toggle="tab" onclick="ga('send', 'event', 'matching', 'click', 'howto_choose_tab3', {'nonInteraction': 1});">中古物件へお引越しの方</a></li>
              <li><a href="#tab4" data-toggle="tab" onclick="ga('send', 'event', 'matching', 'click', 'howto_choose_tab4', {'nonInteraction': 1});">店舗で切り替え予定の方</a></li>
              <li><a href="#tab5" data-toggle="tab" onclick="ga('send', 'event', 'matching', 'click', 'howto_choose_tab5', {'nonInteraction': 1});">集合住宅のオーナー様</a></li>
            </ul>

            <div class="tab-content">
              <div class="tab-pane active" id="tab1" style="overflow: hidden;">
                <div class="case-contents">
                  <div class="box">
                    <h3>より安く安心できる<br>ガス会社に切り替えましょう</h3>
                    <p class="clear">プロパンガス会社は千差万別あります。エネピでは優良ガス会社の前提として「30分以内の駆けつけ」「不当な値上げなし」「切替費用不要」の３つの条件をクリアしている会社のみを厳選してご紹介しています。その上でお得になる会社が多数あるのは事実です。</p>
                  </div>
                  <div class="box">
                    <h3>料金やセット割<br>エネピ紹介基準をチェック</h3>
                    <p>年間節約額とセットプラン・会社情報などをご確認の上、興味のあるガス会社への「連絡希望ボタン」を押しましょう。その後、ガス会社の担当者よりご連絡が入ります。なお、料金非公開となっている会社はお客様に合わせて個別で料金やプランの設定を行っているため、連絡希望の上、直接提案を受けましょう。</p>
                  </div>
                  <div class="box">
                    <h3>今の会社の違約金が<br>ある方も大丈夫</h3>
                    <p>今の会社から給湯器や配管などを無償で設置してもらっている場合、あるいはその契約期間が残っている場合、その違約金(機器設置代の残額)を新しいガス会社にて補填してくれるプランも多くあります。詳細は会社によって異なりますので連絡を希望して自分にあったガス会社を選びましょう。</p>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab2">
                <div class="case-contents">
                  <div class="box">
                    <h3>注文住宅と建売住宅で<br>異なる決め方</h3>
                    <p class="clear">新築の注文住宅の場合は、着工前の段階でガス会社を決めなければいけない場合がほとんどです。また建売住宅では既に決まったガス会社の工事が終わっている場合もあります。いつ頃までにガス会社を決めないといけないのか把握しましょう。</p>
                  </div>
                  <div class="box">
                    <h3>配管や設備の<br>支払い方をチェック</h3>
                    <p>新築の場合、給湯器や配管の設備代の支払いを導入時に一括で支払うケースと、月々のガス料金に少し上乗せして支払うケースの大きく２つがあります。エネピ紹介の会社はどちらも対応しておりますので、料金の詳細は「連絡希望ボタン」を押してガス会社にお聞きください。（下記のご提案料金は貸与がない場合を想定しています）</p>
                  </div>
                  <div class="box">
                    <h3>既に決まっている<br>ガス会社は高い場合も</h3>
                    <p>ハウスメーカーや不動産会社からガス会社の紹介を受けた場合、料金が高いことが多くあります。新しく契約する際は、各社のプランを比較していい会社を選びましょう。(※削減額がマイナスの場合、シミュレーションが正しくない場合があります。お手数ですがご連絡ください。)</p>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab3">
                <div class="case-contents">
                  <div class="box">
                    <h3>引越しまでの<br>段取りも重要</h3>
                    <p class="clear">プロパンガスの新規開設をする際、ガスを使いたい当日に連絡するのでは間に合いません。引越し日時が決まっている方は遅くても１週間前までにはガス会社を決めるようにしましょう。引越しまで1週間切っている場合は、すぐにでもエネピ運営事務局あるいはガス会社に相談することをおすすめします。</p>
                  </div>
                  <div class="box">
                    <h3>料金やセット割<br>エネピ紹介基準をチェック</h3>
                    <p>入力情報に合わせて年間節約額とセットプラン・会社情報などを表示しているので気になる会社に連絡希望をしましょう。なお、料金非公開となっている会社はお客様に合わせて個別で料金やプランの設定を行っているため、連絡希望の上、直接提案を受けましょう。</p>
                  </div>
                  <div class="box">
                    <h3>既存のプロパンガス<br>会社は高い場合も</h3>
                    <p>中古物件への引越しの場合、既存のガス会社のボンベやメーターが置きっぱなしになっている場合があります。ただし、そのままのガス会社からは、高い料金の提案を受けてしまうことが大半です。当シミュレーションを通じて、比較してより良い会社を選びましょう。(※削減額がマイナスの場合、シミュレーションが正しくない場合がありますのでご連絡いただければ修正いたします)</p>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab4">
                <div class="case-contents">
                  <div class="box">
                    <h3>店舗、業務用のガス料金は<br>安くなります</h3>
                    <p class="clear">プロパンガス会社によって、店舗のガス料金プランは大きく異なります。各社のガス料金プランを比較検討することで、ガス料金がより安くならないかチェックしてみましょう。</p>
                  </div>
                  <div class="box">
                    <h3>設備費用を無償で<br>貸与するプランも</h3>
                    <p>建物の配管や給湯器などの設備を交換したい方もいらっしゃるかと思います。エネピで紹介するガス会社の多くでは、設備の無償交換あるいは新築での施工なども対応を行うことができます。お得な料金プランを選ぶとともに、設備についても相談してみましょう。</p>
                  </div>
                  <div class="box">
                    <h3>お気軽にエネピスタッフに<br>ご相談ください</h3>
                    <p>業態や店舗規模によっても料金プランの内容は大きく変わることがあります。より詳しい内容について知りたい場合は、ご自身で判断が難しい場合はお気軽にエネピ運営事務局にご連絡ください。電話やメール、チャットでご相談に対応させていただきます。</p>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab5">
                <div class="case-contents">
                  <div class="box">
                    <h3>集合住宅のガス料金は<br>安くなります。</h3>
                    <p class="clear">プロパンガス会社によって、集合住宅のガス料金プランは大きく異なります。各社のガス料金プランを比較検討することで、お持ちの物件のガス料金がより安くならないかチェックしてみましょう。</p>
                  </div>
                  <div class="box">
                    <h3>設備費用を無償で<br>貸与するプランも</h3>
                    <p>建物の配管や給湯器などの設備を交換したい方もいらっしゃるかと思います。エネピで紹介するガス会社の多くでは、設備の無償交換あるいは新築での施工なども対応を行うことができます。お得な料金プランを選ぶとともに、設備についても相談してみましょう。</p>
                  </div>
                  <div class="box">
                    <h3>入居者にもガス料金の内訳を<br>公開することに</h3>
                    <p>プロパンガスに関する法律が改正され、2017年6月より入居者に対してプロパンガス料金の内訳を公開することが義務づけられました。ガス料金・ガス設備も、入居率向上の重要なポイントの1つになることが予想されます。入居者にも選ばれるガス会社を選びましょう。</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <div class="container faq section_second">
      <div class="row">
        <h2 class="header">よくあるご質問</h2>
        <div class="faq" id="accordion" role="tablist" aria-multiselectable="true">
          <dl>
            <?
            $faq = [
             'faq0' => [
               'q'  => 'LPガスは、電気代や都市ガスのような公共料金ではないの？',
               'a'  => '公共料金ではありません。',
               'answer' => [
                 'a1' => '電気料金や都市ガス料金は、いわゆる公共料金という位置づけになるので、契約会社によって極端に料金が高くなったり安くなったりはせず、料金が値上げする場合もちゃんと事前に告知され、使用単価も明確に表記されています。',
                 'a2' => '一方LPガスの料金は、ガス会社によって、基本料金も使用する単価もすべて自由に決められるので、地域や業者によって、料金に開きがあり、安い単価と比較すると、3倍以上の料金になる場合もあります。',
               ],
             ],
             'faq1' => [
               'q'  => 'うちのガス料金って高いと思うけど、相場はいくらくらいなの？',
               'a'  => '地域や使用量によって異なります。',
               'answer' => [
                 'a1' => 'ガス料金には、基本料金＋従量料金（使った分だけ払う料金）で構成されていますが、基本料金も従量料金も業者によってかなり開きがあります。全国平均で見ると基本料金は一戸建て住宅の場合1,600～1,800円前後で、従量単価は300～500円前後になっていて、これが集合住宅の場合は、基本料金、従量料金共に１割程度高くなります。',
                 'a2' => '配送コストが安い関東方面の料金は平均値よりも安めで、逆に配送コストがかかる北海道・東北・九州などは高めになっている傾向があります。基本料金や従量料金の単価は、料金表には記載していない業者が実際はかなり多いので、はっきり内訳がわからない場合は、まずはenepiお客様サポートにお問い合わせください。',
               ],
             ],
             'faq2' => [
               'q'  => '他の業者さんに変えると料金は安くなるの？',
               'a'  => '安くなる可能性が高いです。',
               'answer' => [
                 'a1' => 'もともとＬＰガス料金は自由化されていて、適正価格を知らずに高い料金を払っていたり、気づかないうちに値上げされていたりするケースは非常に多くあり、それが業者を変えることで適正価格よりもさらに安く契約する事が出来ます。',
               ],
             ],
             'faq3' => [
               'q'  => '今の業者さんに価格交渉して安くしてもらってはダメなの？',
               'a'  => '信頼できるガス会社かどうか、見極めが必要です。',
               'answer' => [
                 'a1' => '価格交渉すれば、業者さんによっては安くしてくれるところはありますが、業者さんの料金に対する考え方や、他のお客さんへの公平性を考えると、あまり好んでは値下げには応じてくれないケースが多くあります。一次出来に料金が値下げされたとしても、途中から様々な理由によって値上げされる可能性は高く、はじめから長期的に安い料金で提供してくれる業者さんとの契約の方がお得です。',
               ],
             ],
             'faq4' => [
               'q'  => '集合住宅に住んでいる場合も簡単に変更できるの？',
               'a'  => '大家さんの了承が必要です。',
               'answer' => [
                 'a1' => 'アパートやマンションなどの集合住宅の場合は、大家さんがまとめて業者さんと契約している場合がほとんどなので、まずは大家さんに相談してみることが必要です。直接個人が安い業者さんとの契約は出来なくても、大家さんに安い業者さんと契約するように勧めてみて、うまく安い業者さんと大家さんが契約してくれれば、自分の所のガス料金が安くなることも可能です。',
               ],
             ],
             'faq5' => [
               'q'  => 'ガス会社を変更すると設備の変更などは必要なの？',
               'a'  => 'ガスボンベとメーターのみ変更します。',
               'answer' => [
                 'a1' => '建物の外にあるガスボンベと、使用量を確認するメーターの差し替えの作業が必要になります。ガス給湯器やガスコンロを使用している場合は、今使っている物を継続してそのまま使うことが出来るので、長時間の作業や大がかりの工事などは不要です。差し替えの工事の時間もおよそ30分程度なので、その間に契約書の記載をしていると、すべての手続きはそれだけで完了します。',
               ],
             ],
             'faq6' => [
               'q'  => '都市ガスは切替することができるの？',
               'a'  => '申し訳ございません。現時点ではできません。',
               'answer' => [
                 'a1' => 'LPガス（プロパンガス）は既に小売自由化されていますが、都市ガスは2017年4月より小売全面自由化される予定です。enepiでは、そのタイミングで都市ガスの切替サービスを開始する予定ですので、ご期待ください。',
               ],
             ],
           ];
           $faq_count = 0;
           ?>
           <? foreach ($faq as $f) { ?>
           <dt id="heading-<?= $faq_count ?>"  role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-<?= $faq_count ?>" aria-expanded="true" aria-controls="collapse-<?= $faq_count ?>">
            <h3>
              <a class="q">
                <?= $f["q"] ?>
              </a>
            </h3>
          </dt>
          <dd id="collapse-<?= $faq_count ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-<?= $faq_count ?>">
            <h4 class="a"><?= $f["a"] ?></h4>
            <? foreach ($f["answer"] as $a) { ?>
            <p><?= $a ?></p>
            <? } ?>
          </dd>
          <? $faq_count++; ?>
          <? } ?>

        </dl>
      </div>
    </div>
  </div>
</div>

<div class="highlighted section_second steps">
  <?= render("shared/estimate_flow") ?>
</div>

<?= $estimate_presentation_tail ?>

