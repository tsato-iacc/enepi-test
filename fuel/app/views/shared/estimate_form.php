<div class="register-form" id="register_form">
  <div class="mainform-top-text">
    <div class="mainform-text-box">プロパンガスの料金比較で年間<span class="mainform-top-text-catch">8万円</span><span class="mainform-top-note">(※)</span>も安くなる!!</div>
    <span class="mainform-top-note-bottom">※条件により異なります。</span>
  </div>

  <div class="mainform-topimg">
    <? if smart_phone? ?>
      <?= MyView::image_tag(asset_url("estimate_form/sp/title.png") ?>
    <? else ?>
      <?= MyView::image_tag(asset_url("estimate_form/title.png") ?>
    <? } ?>    
  </div>

  <div class="form-wrap">
    <?= form_for @lpgas_contact, url: @form_url, ["method" => 'POST' { |f| ?>
      <? if !@lpgas_contact.id.nil? ?>
      <input type="hidden" name="contact_id" value="<?= @lpgas_contact.id ?>">
      <input type="hidden" name="token" value="<?= @lpgas_contact.token ?>">
      <? } ?>
      <?= hidden_field_tag :previewed, 1 if from_kakaku? ?>
      <input type="hidden" name="new_form" value="true">
      <input type="hidden" name="lpgas_contact[zip_code]">
      <input type="hidden" name="lpgas_contact[prefecture_code]">
      <input type="hidden" name="lpgas_contact[address]">
      <input type="hidden" name="lpgas_contact[new_zip_code]">
      <input type="hidden" name="lpgas_contact[new_prefecture_code]">
      <input type="hidden" name="lpgas_contact[new_address]">
      <input type="hidden" name="lpgas_contact[house_hold]">
      <div class="form-step<? if smart_phone? ?> form-align<? } ?>">
        <div class="step-selected" id="form_title_step_1">① 物件種別</div>
        <div id="form_title_step_2">② 物件状況</div>
        <div id="form_title_step_3">③ 場所</div>
        <? if @lp_005.present? ?>
        <div id="form_title_step_6">④ 検針票</div>
        <div id="form_title_step_4">⑤ 使用状況</div>
        <div id="form_title_step_5">⑥ 連絡先</div>
        <? else ?>
        <div id="form_title_step_4">④ 使用状況</div>
        <div id="form_title_step_5">⑤ 連絡先</div>
        <? } ?>
        <div class="step-check pc<?= ' fs-12px' if @lp_005.present? ?>"><span>見積もりゲット!!</span></div>
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
                <div class="hand-navi-wrap<?= ' opacity-0' if @lpgas_contact.house_kind.present? ?>">
                  <div><?= MyView::image_tag(asset_url("estimate_form/hand-navi.png") ?></div>
                  <div><?= MyView::image_tag(asset_url("estimate_form/hand-navi.png") ?></div>
                  <div><?= MyView::image_tag(asset_url("estimate_form/hand-navi.png") ?></div>
                </div>
                <div class="house-kind input-wrap remove-error">
                  <input type="radio" name="lpgas_contact[house_kind]" value="detached" id="detached"<?= ' checked="checked"' if @lpgas_contact.house_kind == 'detached' ?>>
                  <label class="image-wrap hand-navi-label" for="detached">
                    <div class="normal sp"><?= MyView::image_tag(asset_url("estimate_form/sp/off-btn-home.png") ?></div>
                    <div class="invert sp"><?= MyView::image_tag(asset_url("estimate_form/sp/on-btn-home.png") ?></div>
                    <div class="normal pc"><?= MyView::image_tag(asset_url("estimate_form/off-btn-home.png") ?></div>
                    <div class="invert pc"><?= MyView::image_tag(asset_url("estimate_form/on-btn-home.png") ?></div>
                    <p>戸建・持ち家</p>
                  </label>
                </div>
                <div class="house-kind input-wrap remove-error">
                  <input type="radio" name="lpgas_contact[house_kind]" value="store_ex" id="store_ex"<?= ' checked="checked"' if @lpgas_contact.house_kind == 'store_ex' ?>>
                  <label class="image-wrap hand-navi-label" for="store_ex">
                    <div class="normal sp"><?= MyView::image_tag(asset_url("estimate_form/sp/off-btn-store.png") ?></div>
                    <div class="invert sp"><?= MyView::image_tag(asset_url("estimate_form/sp/on-btn-store.png") ?></div>
                    <div class="normal pc"><?= MyView::image_tag(asset_url("estimate_form/off-btn-store.png") ?></div>
                    <div class="invert pc"><?= MyView::image_tag(asset_url("estimate_form/on-btn-store.png") ?></div>
                    <p>店舗</p>
                  </label>
                </div>
                <div class="house-kind input-wrap remove-error">
                  <input type="radio" name="lpgas_contact[house_kind]" value="apartment" id="apartment"<?= ' checked="checked"' if @lpgas_contact.house_kind == 'apartment' ?>>
                  <label class="image-wrap hand-navi-label" for="apartment">
                    <div class="normal sp"><?= MyView::image_tag(asset_url("estimate_form/sp/off-btn-land.png") ?></div>
                    <div class="invert sp"><?= MyView::image_tag(asset_url("estimate_form/sp/on-btn-land.png") ?></div>
                    <div class="normal pc"><?= MyView::image_tag(asset_url("estimate_form/off-btn-land.png") ?></div>
                    <div class="invert pc"><?= MyView::image_tag(asset_url("estimate_form/on-btn-land.png") ?></div>
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
                  <span class="next-arrow pc"><?= MyView::image_tag(asset_url("estimate_form/next-arrow.png") ?></span>
                  <span class="next-arrow sp"><?= MyView::image_tag(asset_url("estimate_form/sp/next-arrow.png") ?></span>
                </div>
              </div>
              <div class="next-btn-hand-navi<?= ' opacity-0' if !@lpgas_contact.house_kind.present? ?>"><div><?= MyView::image_tag(asset_url("estimate_form/hand-navi.png") ?></div></div>
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
                <div class="hand-navi-wrap<?= ' opacity-0' if @lpgas_contact.estimate_kind.present? ?>">
                  <div><?= MyView::image_tag(asset_url("estimate_form/hand-navi.png") ?></div>
                  <div><?= MyView::image_tag(asset_url("estimate_form/hand-navi.png") ?></div>
                </div>
                <div class="house-kind input-wrap remove-error error-wrap">
                  <input type="radio" name="lpgas_contact[estimate_kind]" value="change_contract" id="change_contract"<?= ' checked="checked"' if @lpgas_contact.estimate_kind == 'change_contract' ?>>
                  <label class="image-wrap hand-navi-label" for="change_contract">
                    <div class="normal sp"><?= MyView::image_tag(asset_url("estimate_form/sp/off-btn-current.png") ?></div>
                    <div class="invert sp"><?= MyView::image_tag(asset_url("estimate_form/sp/on-btn-current.png") ?></div>
                    <div class="normal pc"><?= MyView::image_tag(asset_url("estimate_form/off-btn-current.png") ?></div>
                    <div class="invert pc"><?= MyView::image_tag(asset_url("estimate_form/on-btn-current.png") ?></div>
                    <p>現在のお住まい</p>
                  </label>
                </div>
                <div class="house-kind input-wrap remove-error error-wrap">
                  <input type="radio" name="lpgas_contact[estimate_kind]" value="new_contract" id="new_contract"<?= ' checked="checked"' if @lpgas_contact.estimate_kind == 'new_contract' ?>>
                  <label class="image-wrap hand-navi-label" for="new_contract">
                    <div class="normal sp"><?= MyView::image_tag(asset_url("estimate_form/sp/off-btn-move.png") ?></div>
                    <div class="invert sp"><?= MyView::image_tag(asset_url("estimate_form/sp/on-btn-move.png") ?></div>
                    <div class="normal pc"><?= MyView::image_tag(asset_url("estimate_form/off-btn-move.png") ?></div>
                    <div class="invert pc"><?= MyView::image_tag(asset_url("estimate_form/on-btn-move.png") ?></div>
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
                  <span class="prev-arrow pc"><?= MyView::image_tag(asset_url("estimate_form/prev-arrow.png") ?></span>
                  <span class="prev-arrow sp"><?= MyView::image_tag(asset_url("estimate_form/sp/prev-arrow.png") ?></span>
                </div>
              </div>
              <div>
                <div class="step-next-btn" id="estimate_kind_btn" data-next-step="3">
                  <span>次へ</span>
                  <span class="next-arrow pc"><?= MyView::image_tag(asset_url("estimate_form/next-arrow.png") ?></span>
                  <span class="next-arrow sp"><?= MyView::image_tag(asset_url("estimate_form/sp/next-arrow.png") ?></span>
                </div>
              </div>
              <div class="next-btn-hand-navi<?= ' opacity-0' if !@lpgas_contact.estimate_kind.present? ?>"><div><?= MyView::image_tag(asset_url("estimate_form/hand-navi.png") ?></div></div>
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
                  <input type="tel" name="lpgas_contact[number_of_rooms]" value="<?= @lpgas_contact.number_of_rooms ?>" placeholder="例） 18">
                </div>
              </div>
              <div class="address-box input-wrap apartment-box error-wrap">
                <div class="label2">入居済み部屋数</div>
                <div class="reference-wrap">
                  <div class="field-phone">
                    <input type="tel" name="lpgas_contact[number_of_active_rooms]" value="<?= @lpgas_contact.number_of_active_rooms ?>" placeholder="例） 10">
                  </div>
                  <div class="reference pc">(※任意)</div>
                </div>
              </div>
              <!-- <div class="reference sp">(日中繋がりやすい番号を入力してください)</div> -->
              <div class="address-box input-wrap apartment-box error-wrap">
                <div class="label2">管理会社名</div>
                <div class="field-phone">
                  <input type="text" name="lpgas_contact[estate_management_company_name]" value="<?= @lpgas_contact.estate_management_company_name ?>" placeholder="例） 株式会社えねぴ">
                </div>
                <div class="reference pc">(※任意)</div>
              </div>
            </div>
            <div class="slide-navi">
              <div>
                <div class="step-prev-btn" data-go-to-slide="0" data-go-to-slide-2="0" data-cur-step="2">
                  <span class="under">戻る</span>
                  <span class="prev-arrow pc"><?= MyView::image_tag(asset_url("estimate_form/prev-arrow.png") ?></span>
                  <span class="prev-arrow sp"><?= MyView::image_tag(asset_url("estimate_form/sp/prev-arrow.png") ?></span>
                </div>
              </div>
              <div>
                <div class="step-next-btn" id="apartment_btn" data-next-step="3">
                  <span>次へ</span>
                  <span class="next-arrow pc"><?= MyView::image_tag(asset_url("estimate_form/next-arrow.png") ?></span>
                  <span class="next-arrow sp"><?= MyView::image_tag(asset_url("estimate_form/sp/next-arrow.png") ?></span>
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
                  <input type="tel" name="zip" value="<?= @lpgas_contact.zip_code.present? ? @lpgas_contact.zip_code : @lpgas_contact.new_zip_code ?>" placeholder="1230000" onkeyup="convertZip(this, 'pref', 'addr')">
                </div>
              </div>
              <div class="address-box input-wrap error-wrap">
                <div class="label">住所</div>
                <div class="field-prefecture select-arrow">
                  <i class="fa fa-sort" aria-hidden="true"></i>
                  <? if @lpgas_contact.zip_code.present? ?>
                  <?= f.collection_select :prefecture_code, JpPrefecture::Prefecture.all, :code, :name, {include_blank: '選択してください'}, {id: 'pref', name: 'pref'} ?>
                  <? else @lpgas_contact.new_zip_code.present? ?>
                  <?= f.collection_select :new_prefecture_code, JpPrefecture::Prefecture.all, :code, :name, {include_blank: '選択してください'}, {id: 'pref', name: 'pref'} ?>
                  <? } ?>
                </div>
              </div>
              <div class="address-box input-wrap error-wrap">
                <div class="label"></div>
                <div class="field-address">
                  <input type="text" name="addr" value="<?= @lpgas_contact.address.present? ? @lpgas_contact.address : @lpgas_contact.new_address ?>" placeholder="例） 港区新橋1-1-1" id="addr">
                </div>
              </div>
            </div>
            <div class="slide-navi">
              <div>
                <div class="step-prev-btn" data-go-to-slide="1" data-go-to-slide-2="2" data-cur-step="3">
                  <span class="under">戻る</span>
                  <span class="prev-arrow pc"><?= MyView::image_tag(asset_url("estimate_form/prev-arrow.png") ?></span>
                  <span class="prev-arrow sp"><?= MyView::image_tag(asset_url("estimate_form/sp/prev-arrow.png") ?></span>
                </div>
              </div>
              <div>
                <div class="step-next-btn" id="address_btn" data-next-step="<?= @lp_005.present? ? '6' : '4' ?>">
                  <span>次へ</span>
                  <span class="next-arrow pc"><?= MyView::image_tag(asset_url("estimate_form/next-arrow.png") ?></span>
                  <span class="next-arrow sp"><?= MyView::image_tag(asset_url("estimate_form/sp/next-arrow.png") ?></span>
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

              <div class="address-box input-wrap2 gas-usage-box gas-wrap mb-0">
                <div class="label3">使用設備<span class="optional">(任意)</span></div>
                <div class="row-wrap">
                  <div class="remove-error">
                    <input type="checkbox" name="lpgas_contact[using_cooking_stove]" value="1" id="cooking_stove"<?= ' checked="checked"' if @lpgas_contact.using_cooking_stove ?>>
                    <label for="cooking_stove">
                      <div>
                        <?= MyView::image_tag(asset_url("estimate_form/check-blue.png") ?>
                      </div>
                      <span>ガスコンロ</span>
                    </label>
                  </div>
                  <div class="remove-error">
                    <input type="checkbox" name="lpgas_contact[using_bath_heater_with_gas_hot_water_supply]" value="1" id="bath_heater"<?= ' checked="checked"' if @lpgas_contact.using_bath_heater_with_gas_hot_water_supply ?>>
                    <label for="bath_heater">
                      <div>
                        <?= MyView::image_tag(asset_url("estimate_form/check-blue.png") ?>
                      </div>
                      <span>給湯器</span>
                    </label>
                  </div>
                  <div class="remove-error">
                    <input type="checkbox" name="lpgas_contact[using_other_gas_machine]" value="1" id="other_gas_machine"<?= ' checked="checked"' if @lpgas_contact.using_other_gas_machine ?>>
                    <label for="other_gas_machine">
                      <div>
                        <?= MyView::image_tag(asset_url("estimate_form/check-blue.png") ?>
                      </div>
                      <span>ストーブその他</span>
                    </label>
                  </div>
                </div>
              </div>

              <div class="address-box input-wrap gas-wrap mb-0">
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
                    <select id="house_hold">
                      <option value="" selected >選択</option>
                      <option value="2">2人以下</option>
                      <option value="3">3人</option>
                      <option value="4">4人</option>
                      <option value="5">5人</option>
                      <option value="6">6人</option>
                      <option value="7">7人以上</option>
                    </select>
                  </div>
                  <div class="reference have-bill-no hidden">で</div>

                  <div class="field-month error-wrap remove-error select-arrow">
                    <i class="fa fa-sort" aria-hidden="true"></i>
                    <?= select(:lpgas_contact, :gas_meter_checked_month, [['1'], ['2'], ['3'], ['4'], ['5'], ['6'], ['7'], ['8'], ['9'], ['10'], ['11'], ['12']], {include_blank: '選択'}) ?>
                  </div>
                  <!-- IF DON'T HAVE A GAS BILL -->
                  <div class="reference have-bill-no hidden">月のガス料金が</div>
                  <div class="reference have-bill-yes">月のガス使用量が</div>
                </div>

                <div class="row-wrap">
                  <!-- IF DON'T HAVE A GAS BILL -->
                  <div class="reference have-bill-no hidden">約</div>
                  <div class="field-capacity error-wrap remove-error have-bill-yes">
                    <input type="tel" name="lpgas_contact[gas_used_amount]" value="<?= @lpgas_contact.gas_used_amount ?>">
                  </div>
                  <div class="reference have-bill-yes">m³で</div>
                  <div class="field-bill error-wrap remove-error">
                    <input type="tel" name="lpgas_contact[gas_latest_billing_amount]" value="<?= @lpgas_contact.gas_latest_billing_amount ?>">
                  </div>
                  <div class="reference">円(税込)</div>
                </div>
              </div>
              <div class="address-box input-wrap email-box remove-error error-wrap gas-wrap">
                <div class="label3">ガス会社名<span class="optional can-hide">(任意)</span></div>
                <div class="field-contracted-shop">
                  <input type="text" name="lpgas_contact[gas_contracted_shop_name]" value="<?= @lpgas_contact.gas_contracted_shop_name ?>" placeholder="例) 株式会社えねぴ">
                </div>
              </div>
              <div class="comment-usage">※使用状況が分からない方は、だいたいでOKです。</div>
            </div>
            <div class="slide-navi">
              <div>
                <div class="step-prev-btn" data-go-to-slide="<?= @lp_005.present? ? '6' : '3' ?>" data-go-to-slide-2="<?= @lp_005.present? ? '6' : '3' ?>" data-cur-step="4">
                  <span class="under">戻る</span>
                  <span class="prev-arrow pc"><?= MyView::image_tag(asset_url("estimate_form/prev-arrow.png") ?></span>
                  <span class="prev-arrow sp"><?= MyView::image_tag(asset_url("estimate_form/sp/prev-arrow.png") ?></span>
                </div>
              </div>
              <div>
                <div class="step-next-btn" id="gas_usage_btn" data-next-step="5">
                  <span>次へ</span>
                  <span class="next-arrow pc"><?= MyView::image_tag(asset_url("estimate_form/next-arrow.png") ?></span>
                  <span class="next-arrow sp"><?= MyView::image_tag(asset_url("estimate_form/sp/next-arrow.png") ?></span>
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
                  <input type="text" name="lpgas_contact[name]" value="<?= @lpgas_contact.name ?>" placeholder="例） 山田 太郎">
                </div>
              </div>
              <div class="address-box input-wrap error-wrap contact-wrap">
                <div class="label2">ふりがな</div>
                <div class="field-mail">
                  <input type="text" name="lpgas_contact[furigana]" value="<?= @lpgas_contact.furigana ?>" placeholder="例） やまだ たろう">
                </div>
              </div>
              <div class="address-box input-wrap error-wrap contact-wrap">
                <div class="label2">電話番号</div>
                <div class="field-mail">
                  <input type="tel" name="lpgas_contact[tel]" value="<?= @lpgas_contact.tel ?>" placeholder="例） 09001230123">
                </div>
              </div>
              <div class="address-box input-wrap error-wrap contact-wrap">
                <div class="label2">メールアドレス</div>
                <div class="field-mail">
                  <input type="text" name="lpgas_contact[email]" value="<?= @lpgas_contact.email ?>" placeholder="例） info@enepi.jp">
                </div>
              </div>
            </div>
            <div class="slide-navi-last">
              <div>
                <div class="step-prev-btn" data-go-to-slide="4" data-go-to-slide-2="4" data-cur-step="5">
                  <span class="under">戻る</span>
                  <span class="prev-arrow pc"><?= MyView::image_tag(asset_url("estimate_form/prev-arrow.png") ?></span>
                  <span class="prev-arrow sp"><?= MyView::image_tag(asset_url("estimate_form/sp/prev-arrow.png") ?></span>
                </div>
              </div>
              <div class="last-btn">
                <div class="step-next-btn" id="contact_btn">
                  <span class="btn-text"><span class="up">理想のガス会社</span><span class="down">を</span>探しに行く！</span>
                  <span class="next-arrow pc"><?= MyView::image_tag(asset_url("estimate_form/next-arrow.png") ?></span>
                  <span class="next-arrow sp"><?= MyView::image_tag(asset_url("estimate_form/sp/next-arrow.png") ?></span>
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
                  <span class="prev-arrow pc"><?= MyView::image_tag(asset_url("estimate_form/prev-arrow.png") ?></span>
                  <span class="prev-arrow sp"><?= MyView::image_tag(asset_url("estimate_form/sp/prev-arrow.png") ?></span>
                </div>
              </div>
              <div>
                <div class="step-next-btn" id="have_bill_btn" data-next-step="4">
                  <span>次へ</span>
                  <span class="next-arrow pc"><?= MyView::image_tag(asset_url("estimate_form/next-arrow.png") ?></span>
                  <span class="next-arrow sp"><?= MyView::image_tag(asset_url("estimate_form/sp/next-arrow.png") ?></span>
                </div>
              </div>
              <div class="next-btn-hand-navi"><div><?= MyView::image_tag(asset_url("estimate_form/hand-navi.png") ?></div></div>
            </div>
          </div>
          <!-- SLIDE 6 END -->
        </div>
      </div>
    <? } ?>
  </div>
  <? if from_kakaku? ?>
  <div class="form-kakaku">
    <p class="terms pc">プロパンガス料金見積もりサービスは、株式会社アイアンドシー・クルーズが運営するサービスです。<br>ご入力いただいた内容を株式会社カカクコムは保持せず、株式会社アイアンドシー・クルーズが取得し、<br>同社がプライバシーポリシーに基づき管理いたします。</p>
    <p class="terms sp">プロパンガス料金見積もりサービスは、株式会社アイアンドシー・クルーズが運営するサービスです。ご入力いただいた内容を株式会社カカクコムは保持せず、株式会社アイアンドシー・クルーズが取得し、同社がプライバシーポリシーに基づき管理いたします。</p>
  </div>
  <? } ?>
  <div class="form-agreement invisible-slide">
    <p class="terms pc">当サービスをご利用頂くにあたり、 <?= MyView::link_to('「enepi」利用規約', from_kakaku? ? 'https://enepi.jp/agreement' : '/agreement', target: '_blank' ?> に同意したものとみなします。</p>
    <p class="terms sp">当サービスをご利用頂くにあたり、<br><?= MyView::link_to('「enepi」利用規約', from_kakaku? ? 'https://enepi.jp/agreement' : '/agreement', target: '_blank' ?> に同意したものとみなします。</p>
  </div>
</div>
