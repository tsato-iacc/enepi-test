<?php
use JpPrefecture\JpPrefecture;
?>

<div class="register-form" id="register_form">

  <div class="mainform-topimg">
    <div class="sp"><?= Asset::img('estimate_form/sp/title.png'); ?></div>
    <div class="pc"><?= Asset::img('estimate_form/title.png'); ?></div>
  </div>

  <div class="form-wrap">
    <?= \Form::open(['action' => $estimate_post_url]); ?>
    <?= \Form::csrf(); ?>
      <?php if (!$contact->is_new()): ?>
      <input type="hidden" name="contact_id" value="<?= $contact->id ?>">
      <input type="hidden" name="token" value="<?= $contact->token ?>">
      <?php endif; ?>
      <input type="hidden" name="new_form" value="true">
      <input type="hidden" name="lpgas_contact[zip_code]">
      <input type="hidden" name="lpgas_contact[prefecture_code]">
      <input type="hidden" name="lpgas_contact[address]">
      <input type="hidden" name="lpgas_contact[new_zip_code]">
      <input type="hidden" name="lpgas_contact[new_prefecture_code]">
      <input type="hidden" name="lpgas_contact[new_address]">
      <input type="hidden" name="lpgas_contact[house_hold]">
      <div class="form-step<?php $this->is_mobile ? ' form-align' : '' ?>">
        <div class="step-selected" id="form_title_step_1">① 物件種別</div>
        <div id="form_title_step_2">② 物件状況</div>
        <div id="form_title_step_3">③ 場所</div>
        <?php if (isset($lp_005)): ?>
        <div id="form_title_step_6">④ 検針票</div>
        <div id="form_title_step_4">⑤ 使用状況</div>
        <div id="form_title_step_5">⑥ 連絡先</div>
        <?php else: ?>
        <div id="form_title_step_4">④ 使用状況</div>
        <div id="form_title_step_5">⑤ 連絡先</div>
        <?php endif; ?>
        <div class="step-check pc<?= isset($lp_005) ? ' fs-12px' : ''; ?>"><span>見積もりゲット!!</span></div>
        <div class="step-check sp"><span>見積もり</span><span>ゲット!!</span></div>
      </div>
      <!-- Swiper -->
      <div class="steps-container">
        <div class="swiper-wrapper">

          <!-- SLIDE 1 START -->
          <div class="swiper-slide">
            <div class="slide-content slide-content-1">
              <div class="content-title">
                <div class="step-error"></div>
                <h3>ガスの料金比較をしたい物件はどちらですか？</h3>
              </div>
              <div class="content-box sep-two step-hand-navi">
                <div class="hand-navi-wrap<?= !$contact->is_new() ? ' opacity-0' : '' ?>">
                  <div><?= Asset::img('estimate_form/hand-navi.png'); ?></div>
                  <div><?= Asset::img('estimate_form/hand-navi.png'); ?></div>
                  <div><?= Asset::img('estimate_form/hand-navi.png'); ?></div>
                </div>
                <div class="house-kind input-wrap remove-error">
                  <input type="radio" name="lpgas_contact[house_kind]" value="detached" id="detached"<?= !$contact->is_new() && $contact->house_kind == \Config::get('models.contact.house_kind.detached') ? ' checked="checked"' : '' ?>>
                  <label class="image-wrap hand-navi-label" for="detached">
                    <div class="normal sp"><?= Asset::img('estimate_form/sp/off-btn-home.png'); ?></div>
                    <div class="invert sp"><?= Asset::img('estimate_form/sp/on-btn-home.png'); ?></div>
                    <div class="normal pc"><?= Asset::img('estimate_form/off-btn-home.png'); ?></div>
                    <div class="invert pc"><?= Asset::img('estimate_form/on-btn-home.png'); ?></div>
                    <p>戸建・持ち家</p>
                  </label>
                </div>
                <div class="house-kind input-wrap remove-error">
                  <input type="radio" name="lpgas_contact[house_kind]" value="store_ex" id="store_ex"<?= !$contact->is_new() && $contact->house_kind == \Config::get('models.contact.house_kind.store_ex') ? ' checked="checked"' : '' ?>>
                  <label class="image-wrap hand-navi-label" for="store_ex">
                    <div class="normal sp"><?= Asset::img('estimate_form/sp/off-btn-store.png'); ?></div>
                    <div class="invert sp"><?= Asset::img('estimate_form/sp/on-btn-store.png'); ?></div>
                    <div class="normal pc"><?= Asset::img('estimate_form/off-btn-store.png'); ?></div>
                    <div class="invert pc"><?= Asset::img('estimate_form/on-btn-store.png'); ?></div>
                    <p>店舗</p>
                  </label>
                </div>
                <div class="house-kind input-wrap remove-error">
                  <input type="radio" name="lpgas_contact[house_kind]" value="apartment" id="apartment"<?= !$contact->is_new() && $contact->house_kind == \Config::get('models.contact.house_kind.apartment') ? ' checked="checked"' : '' ?>>
                  <label class="image-wrap hand-navi-label" for="apartment">
                    <div class="normal sp"><?= Asset::img('estimate_form/sp/off-btn-land.png'); ?></div>
                    <div class="invert sp"><?= Asset::img('estimate_form/sp/on-btn-land.png'); ?></div>
                    <div class="normal pc"><?= Asset::img('estimate_form/off-btn-land.png'); ?></div>
                    <div class="invert pc"><?= Asset::img('estimate_form/on-btn-land.png'); ?></div>
                    <p>集合住宅オーナー</p>
                  </label>
                </div>
              </div>
              <div class="comment">※集合住宅(マンション・アパート)にお住まいの方はご登録頂けません。<br>※賃貸物件にお住まいの方はご登録頂けません。</div>
            </div>
            <div class="slide-navi">
              <div></div>
              <div>
                <div class="step-next-btn" id="house_kind_btn">
                  <span>次へ</span>
                  <span class="next-arrow pc"><?= Asset::img('estimate_form/next-arrow.png'); ?></span>
                  <span class="next-arrow sp"><?= Asset::img('estimate_form/sp/next-arrow.png'); ?></span>
                </div>
              </div>
              <div class="next-btn-hand-navi<?= $contact->is_new() ? ' opacity-0' : '' ?>"><div><?= Asset::img('estimate_form/hand-navi.png'); ?></div></div>
            </div>
          </div>
          <!-- SLIDE 1 END -->

          <!-- SLIDE 2-1 START -->
          <div class="swiper-slide step2-1">
            <div class="slide-content slide-content-2-1">
              <div class="content-title">
                <div class="step-error"></div>
                <h3>どちらでガスを利用しますか？</h3>
              </div>
              <div class="content-box sep-two step-hand-navi">
                <div class="hand-navi-wrap<?= !$contact->is_new() ? ' opacity-0' : '' ?>">
                  <div><?= Asset::img('estimate_form/hand-navi.png'); ?></div>
                  <div><?= Asset::img('estimate_form/hand-navi.png'); ?></div>
                </div>
                <div class="house-kind input-wrap remove-error error-wrap">
                  <input type="radio" name="lpgas_contact[estimate_kind]" value="change_contract" id="change_contract"<?= !$contact->is_new() && $contact->estimate_kind == \Config::get('models.contact.estimate_kind.change_contract') ? ' checked="checked"' : '' ?>>
                  <label class="image-wrap hand-navi-label" for="change_contract">
                    <div class="normal sp"><?= Asset::img('estimate_form/sp/off-btn-current.png'); ?></div>
                    <div class="invert sp"><?= Asset::img('estimate_form/sp/on-btn-current.png'); ?></div>
                    <div class="normal pc"><?= Asset::img('estimate_form/off-btn-current.png'); ?></div>
                    <div class="invert pc"><?= Asset::img('estimate_form/on-btn-current.png'); ?></div>
                    <p>現在のお住まい</p>
                  </label>
                </div>
                <div class="house-kind input-wrap remove-error error-wrap">
                  <input type="radio" name="lpgas_contact[estimate_kind]" value="new_contract" id="new_contract"<?= !$contact->is_new() && $contact->estimate_kind == \Config::get('models.contact.estimate_kind.new_contract') ? ' checked="checked"' : '' ?>>
                  <label class="image-wrap hand-navi-label" for="new_contract">
                    <div class="normal sp"><?= Asset::img('estimate_form/sp/off-btn-move.png'); ?></div>
                    <div class="invert sp"><?= Asset::img('estimate_form/sp/on-btn-move.png'); ?></div>
                    <div class="normal pc"><?= Asset::img('estimate_form/off-btn-move.png'); ?></div>
                    <div class="invert pc"><?= Asset::img('estimate_form/on-btn-move.png'); ?></div>
                    <p>引越し先</p>
                  </label>
                </div>
              </div>
              <div class="comment">※集合住宅(マンション・アパート)にお住まいの方はご登録頂けません。<br>※賃貸物件にお住まいの方はご登録頂けません。</div>
            </div>
            <div class="slide-navi">
              <div>
                <div class="step-prev-btn" data-go-to-slide="0" data-cur-step="2">
                  <span class="under">戻る</span>
                  <span class="prev-arrow pc"><?= Asset::img('estimate_form/prev-arrow.png'); ?></span>
                  <span class="prev-arrow sp"><?= Asset::img('estimate_form/sp/prev-arrow.png'); ?></span>
                </div>
              </div>
              <div>
                <div class="step-next-btn" id="estimate_kind_btn" data-next-step="3">
                  <span>次へ</span>
                  <span class="next-arrow pc"><?= Asset::img('estimate_form/next-arrow.png'); ?></span>
                  <span class="next-arrow sp"><?= Asset::img('estimate_form/sp/next-arrow.png'); ?></span>
                </div>
              </div>
              <div class="next-btn-hand-navi<?= $contact->is_new() ? ' opacity-0' : '' ?>"><div><?= Asset::img('estimate_form/hand-navi.png'); ?></div></div>
            </div>
          </div>
          <!-- SLIDE 2-1 END -->

          <!-- SLIDE 2-2 START -->
          <div class="swiper-slide step2-2">
            <div class="slide-content slide-content-1">
              <div class="content-title content-title-apartment">
                <div class="step-error"></div>
                <h3>物件の状況を教えてください</h3>
              </div>

              <div class="address-box input-wrap apartment-box error-wrap">
                <div class="label2">部屋数</div>
                <div class="field-phone">
                  <input type="tel" name="lpgas_contact[number_of_rooms]" value="<?= $contact->number_of_rooms ?>" placeholder="例） 18">
                </div>
              </div>
              <div class="address-box input-wrap apartment-box error-wrap">
                <div class="label2">入居済み部屋数</div>
                <div class="reference-wrap">
                  <div class="field-phone">
                    <input type="tel" name="lpgas_contact[number_of_active_rooms]" value="<?= $contact->number_of_active_rooms ?>" placeholder="例） 10">
                  </div>
                  <div class="reference pc">(※任意)</div>
                </div>
              </div>
              <!-- <div class="reference sp">(日中繋がりやすい番号を入力してください)</div> -->
              <div class="address-box input-wrap apartment-box error-wrap">
                <div class="label2">管理会社名</div>
                <div class="field-phone">
                  <input type="text" name="lpgas_contact[estate_management_company_name]" value="<?= $contact->estate_management_company_name ?>" placeholder="例） 株式会社えねぴ">
                </div>
                <div class="reference pc">(※任意)</div>
              </div>
            </div>
            <div class="slide-navi">
              <div>
                <div class="step-prev-btn" data-go-to-slide="0" data-go-to-slide-2="0" data-cur-step="2">
                  <span class="under">戻る</span>
                  <span class="prev-arrow pc"><?= Asset::img('estimate_form/prev-arrow.png'); ?></span>
                  <span class="prev-arrow sp"><?= Asset::img('estimate_form/sp/prev-arrow.png'); ?></span>
                </div>
              </div>
              <div>
                <div class="step-next-btn" id="apartment_btn" data-next-step="3">
                  <span>次へ</span>
                  <span class="next-arrow pc"><?= Asset::img('estimate_form/next-arrow.png'); ?></span>
                  <span class="next-arrow sp"><?= Asset::img('estimate_form/sp/next-arrow.png'); ?></span>
                </div>
              </div>
              <div></div>
            </div>
          </div>
          <!-- SLIDE 2-2 END -->

          <!-- SLIDE 3 START -->
          <div class="swiper-slide">
            <div class="slide-content slide-content-3">
              <div class="content-title">
                <div class="step-error"></div>
                <h3>ガスの利用先住所を教えてください</h3>
                <p>※お客様の情報が一般に公開されることはありません</p>
              </div>
              <div class="address-box input-wrap error-wrap">
                <div class="label">〒</div>
                <div class="field-zip">
                  <input type="tel" name="zip" value="<?= $contact->getZipCode(); ?>" placeholder="1230000" onkeyup="convertZip(this, 'pref', 'addr')">
                </div>
              </div>
              <div class="address-box input-wrap error-wrap">
                <div class="label">住所</div>
                <div class="field-prefecture select-arrow">
                  <i class="fa fa-sort" aria-hidden="true"></i>
                  <?= Form::select('pref', $contact->prefecture_code, ['' => '選択してください'] + JpPrefecture::allKanjiAndCode(), ['id' => 'pref']); ?>
                </div>
              </div>
              <div class="address-box input-wrap error-wrap">
                <div class="label"></div>
                <div class="field-address">
                  <input type="text" name="addr" value="<?= $contact->getAddress(); ?>" placeholder="例） 港区新橋1-1-1" id="addr">
                </div>
              </div>
            </div>
            <div class="slide-navi">
              <div>
                <div class="step-prev-btn" data-go-to-slide="1" data-go-to-slide-2="2" data-cur-step="3">
                  <span class="under">戻る</span>
                  <span class="prev-arrow pc"><?= Asset::img('estimate_form/prev-arrow.png'); ?></span>
                  <span class="prev-arrow sp"><?= Asset::img('estimate_form/sp/prev-arrow.png'); ?></span>
                </div>
              </div>
              <div>
                <div class="step-next-btn" id="address_btn" data-next-step="<?= isset($lp_005) ? '6' : '4' ?>">
                  <span>次へ</span>
                  <span class="next-arrow pc"><?= Asset::img('estimate_form/next-arrow.png'); ?></span>
                  <span class="next-arrow sp"><?= Asset::img('estimate_form/sp/next-arrow.png'); ?></span>
                </div>
              </div>
              <div></div>
            </div>
          </div>
          <!-- SLIDE 3 END -->

          <!-- SLIDE 4 START -->
          <div class="swiper-slide">
            <div class="slide-content slide-content-4">
              <div class="content-title">
                <div class="step-error"></div>
                <h3>ガスの使用状況を教えてください</h3>
                <p>※お客様の情報が一般に公開されることはありません</p>
              </div>

              <div class="address-box input-wrap2 gas-usage-box gas-wrap">
                <div class="label3">使用設備<span class="optional">(任意)</span></div>
                <div class="row-wrap">
                  <div class="remove-error">
                    <input type="checkbox" name="lpgas_contact[using_cooking_stove]" value="1" id="cooking_stove"<?= $contact->using_cooking_stove ? ' checked="checked"' : '' ?>>
                    <label for="cooking_stove">
                      <div>
                        <div><?= Asset::img('estimate_form/check-blue.png'); ?></div>
                      </div>
                      <span>ガスコンロ</span>
                    </label>
                  </div>
                  <div class="remove-error">
                    <input type="checkbox" name="lpgas_contact[using_bath_heater_with_gas_hot_water_supply]" value="1" id="bath_heater"<?= $contact->using_bath_heater_with_gas_hot_water_supply ? ' checked="checked"' : '' ?>>
                    <label for="bath_heater">
                      <div>
                        <div><?= Asset::img('estimate_form/check-blue.png'); ?></div>
                      </div>
                      <span>給湯器</span>
                    </label>
                  </div>
                  <div class="remove-error">
                    <input type="checkbox" name="lpgas_contact[using_other_gas_machine]" value="1" id="other_gas_machine"<?= $contact->using_other_gas_machine ? ' checked="checked"' : '' ?>>
                    <label for="other_gas_machine">
                      <div>
                        <div><?= Asset::img('estimate_form/check-blue.png'); ?></div>
                      </div>
                      <span>ストーブその他</span>
                    </label>
                  </div>
                </div>
              </div>

              <div class="address-box input-wrap gas-wrap">
                <div class="label3">
                  <!-- IF DON'T HAVE A GAS BILL -->
                  <span class="have-bill-no hidden">世帯人数・料金</span>
                  <span class="have-bill-yes">使用量・料金</span>
                  <span class="optional can-hide">(任意)</span>
                </div>

                <div class="row-wrap">
                  <!-- IF DON'T HAVE A GAS BILL -->
                  <div class="field-house-hold error-wrap remove-error have-bill-no hidden select-arrow">
                    <i class="fa fa-sort" aria-hidden="true"></i>
                    <?= Form::select('house_hold', 'two_or_less_person_household', \Config::get('enepi.household.key_numeric'), ['id' => 'house_hold']); ?>
                  </div>
                  <div class="reference have-bill-no hidden">で</div>

                  <div class="field-month error-wrap remove-error select-arrow">
                    <i class="fa fa-sort" aria-hidden="true"></i>
                    <?= Form::select('lpgas_contact[gas_meter_checked_month]', $month_selected, ['' => '選択'] + \Config::get('enepi.simulation.month.key_string'), ['id' => 'lpgas_contact_gas_meter_checked_month']); ?>
                  </div>
                  <!-- IF DON'T HAVE A GAS BILL -->
                  <div class="reference have-bill-no hidden">のガス料金が</div>
                  <div class="reference have-bill-yes">のガス使用量が</div>
                </div>

                <div class="row-wrap">
                  <!-- IF DON'T HAVE A GAS BILL -->
                  <div class="reference have-bill-no hidden">約</div>
                  <div class="field-capacity error-wrap remove-error have-bill-yes">
                    <input type="tel" name="lpgas_contact[gas_used_amount]" value="<?= $contact->gas_used_amount ?>">
                  </div>
                  <div class="reference have-bill-yes">m³で</div>
                  <div class="field-bill error-wrap remove-error">
                    <input type="tel" name="lpgas_contact[gas_latest_billing_amount]" value="<?= $contact->gas_latest_billing_amount ?>">
                  </div>
                  <div class="reference">円(税込)</div>
                </div>
              </div>
              <div class="address-box input-wrap email-box remove-error error-wrap gas-wrap">
                <div class="label3">ガス会社名<span class="optional can-hide">(任意)</span></div>
                <div class="field-contracted-shop">
                  <input type="text" name="lpgas_contact[gas_contracted_shop_name]" value="<?= $contact->gas_contracted_shop_name ?>" placeholder="例) 株式会社えねぴ">
                </div>
              </div>
              <div class="comment-usage">※使用状況が分からない方は、だいたいでOKです。</div>
            </div>
            <div class="slide-navi">
              <div>
                <div class="step-prev-btn" data-go-to-slide="<?= isset($lp_005) ? '6' : '3' ?>" data-go-to-slide-2="<?= isset($lp_005) ? '6' : '3' ?>" data-cur-step="4">
                  <span class="under">戻る</span>
                  <span class="prev-arrow pc"><?= Asset::img('estimate_form/prev-arrow.png'); ?></span>
                  <span class="prev-arrow sp"><?= Asset::img('estimate_form/sp/prev-arrow.png'); ?></span>
                </div>
              </div>
              <div>
                <div class="step-next-btn" id="gas_usage_btn" data-next-step="5">
                  <span>次へ</span>
                  <span class="next-arrow pc"><?= Asset::img('estimate_form/next-arrow.png'); ?></span>
                  <span class="next-arrow sp"><?= Asset::img('estimate_form/sp/next-arrow.png'); ?></span>
                </div>
              </div>
              <div></div>
            </div>
          </div>
          <!-- SLIDE 4 END -->

          <!-- SLIDE 5 START -->
          <div class="swiper-slide">
            <div class="slide-content slide-content-5">
              <div class="content-title">
                <div class="step-error"></div>
                <h3>ご連絡先を教えてください</h3>
                <p>※お客様の情報が一般に公開されることはありません</p>
              </div>

              <div class="address-box input-wrap error-wrap contact-wrap">
                <div class="label2">お名前</div>
                <div class="field-mail">
                  <input type="text" name="lpgas_contact[name]" value="<?= $contact->name ?>" placeholder="例） 山田 太郎">
                </div>
              </div>
              <div class="address-box input-wrap error-wrap contact-wrap">
                <div class="label2">ふりがな</div>
                <div class="field-mail">
                  <input type="text" name="lpgas_contact[furigana]" value="<?= $contact->furigana ?>" placeholder="例） やまだ たろう">
                </div>
              </div>
              <div class="address-box input-wrap error-wrap contact-wrap">
                <div class="label2">電話番号</div>
                <div class="field-mail">
                  <input type="tel" name="lpgas_contact[tel]" value="<?= $contact->tel ?>" placeholder="例） 09001230123">
                </div>
              </div>
              <div class="address-box input-wrap error-wrap contact-wrap">
                <div class="label2">メールアドレス</div>
                <div class="field-mail">
                  <input type="text" name="lpgas_contact[email]" value="<?= $contact->email ?>" placeholder="例） info@enepi.jp">
                </div>
              </div>
            </div>
            <div class="slide-navi-last">
              <div>
                <div class="step-prev-btn" data-go-to-slide="4" data-go-to-slide-2="4" data-cur-step="5">
                  <span class="under">戻る</span>
                  <span class="prev-arrow pc"><?= Asset::img('estimate_form/prev-arrow.png'); ?></span>
                  <span class="prev-arrow sp"><?= Asset::img('estimate_form/sp/prev-arrow.png'); ?></span>
                </div>
              </div>
              <div class="last-btn">
                <div class="step-next-btn" id="contact_btn">
                  <span class="btn-text"><span class="up">理想のガス会社</span><span class="down">を</span>探しに行く！</span>
                  <span class="next-arrow pc"><?= Asset::img('estimate_form/next-arrow.png'); ?></span>
                  <span class="next-arrow sp"><?= Asset::img('estimate_form/sp/next-arrow.png'); ?></span>
                </div>
              </div>
              <div class="pc"></div>
            </div>
          </div>
          <!-- SLIDE 5 END -->

          <!-- SLIDE 6 START -->
          <div class="swiper-slide step6">
            <div class="slide-content slide-content-6">
              <div class="content-title">
                <div class="step-error"></div>
                <h3>ガスの利用明細を今お持ちですか？</h3>
                <p>今手元に無くても目安で調べられます！</p>
              </div>
              <div class="content-box sep-two">
                <div class="house-kind input-wrap remove-error error-wrap">
                  <input type="radio" name="lpgas_contact[have_bill]" value="yes" id="have_bill_yes"<?// ' checked="checked"' if @lpgas_contact.have_bill ?>>
                  <label class="image-wrap hand-navi-label" for="have_bill_yes">
                    <div class="awesome-img"><i class="fa fa-check-circle-o" aria-hidden="true"></i></div>
                    <p>手元にある</p>
                  </label>
                </div>
                <div class="house-kind input-wrap remove-error error-wrap">
                  <input type="radio" name="lpgas_contact[have_bill]" value="no" id="have_bill_no"<?// ' checked="checked"' if @lpgas_contact.have_bill ?>>
                  <label class="image-wrap hand-navi-label" for="have_bill_no">
                    <div class="awesome-img"><i class="fa fa-times-circle-o" aria-hidden="true"></i></div>
                    <p>手元にはない</p>
                  </label>
                </div>
              </div>
            </div>
            <div class="slide-navi">
              <div>
                <div class="step-prev-btn" data-go-to-slide="3" data-go-to-slide-2="3" data-cur-step="6">
                  <span class="under">戻る</span>
                  <span class="prev-arrow pc"><?= Asset::img('estimate_form/prev-arrow.png'); ?></span>
                  <span class="prev-arrow sp"><?= Asset::img('estimate_form/sp/prev-arrow.png'); ?></span>
                </div>
              </div>
              <div>
                <div class="step-next-btn" id="have_bill_btn" data-next-step="4">
                  <span>次へ</span>
                  <span class="next-arrow pc"><?= Asset::img('estimate_form/next-arrow.png'); ?></span>
                  <span class="next-arrow sp"><?= Asset::img('estimate_form/sp/next-arrow.png'); ?></span>
                </div>
              </div>
            </div>
          </div>
          <!-- SLIDE 6 END -->
        </div>
      </div>
    <?= Form::close(); ?>
  </div>

  <?php if (isset($from_kakaku)): ?>
    <?php if ($from_kakaku): ?>
      <div class="form-kakaku">
        <p class="terms pc">プロパンガス料金見積もりサービスは、株式会社アイアンドシー・クルーズが運営するサービスです。<br>ご入力いただいた内容を株式会社カカクコムは保持せず、株式会社アイアンドシー・クルーズが取得し、<br>同社がプライバシーポリシーに基づき管理いたします。</p>
        <p class="terms sp">プロパンガス料金見積もりサービスは、株式会社アイアンドシー・クルーズが運営するサービスです。ご入力いただいた内容を株式会社カカクコムは保持せず、株式会社アイアンドシー・クルーズが取得し、同社がプライバシーポリシーに基づき管理いたします。</p>
      </div>
    <?php endif; ?>
  <?php endif; ?>
  <?php $agree_url = isset($from_kakaku) ? 'https://enepi.jp/agreement' : '/agreement'; ?>
  <div class="form-agreement invisible-slide">
    <p class="terms pc">当サービスをご利用頂くにあたり、 <a href="<?= $agree_url ?>" target="_blank">「enepi」利用規約</a> に同意したものとみなします。</p>
    <p class="terms sp">当サービスをご利用頂くにあたり、<br><a href="<?= $agree_url ?>" target="_blank">「enepi」利用規約</a> に同意したものとみなします。</p>
  </div>
</div>
