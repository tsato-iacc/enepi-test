<? use Fuel\Core\Asset;
   use Fuel\Core\Form; ?>
<header>
  <div class="container-wrap">
    <div class="logo-wrap pos-left">
      <div class="logo">
        <div><?= Asset::img('layout/logo.png'); ?></div>
      </div>
    <div class="logo-wrap pos-right">
      <div class="enepi-tel">
        <div><?= Asset::img('layout/enepi_tel.png'); ?></div>
      </div>
    </div>
  </div>
</header>
<div class="register-form" id="register_form">
  <div class="mainform-top-text">
    <div class="mainform-text-box">プロパンガスの料金比較で年間<span class="mainform-top-text-catch">8万円</span><span class="mainform-top-note">(※)</span>も安くなる!!</div>
    <span class="mainform-top-note-bottom">※条件により異なります。</span>
  </div>

  <div class="mainform-topimg">
    <div class="sp"><?= Asset::img('estimate_form/sp/title.png'); ?></div>
    <div class="pc"><?= Asset::img('estimate_form/title.png'); ?></div>
  </div>

  <div class="form-wrap">
    <?= Form::open('lpgas_contacts'); ?>
    <?= Form::csrf(); ?>
      <input type="hidden" name="new_form" value="true">
      <input type="hidden" name="lpgas_contact[zip_code]">
      <input type="hidden" name="lpgas_contact[prefecture_code]">
      <input type="hidden" name="lpgas_contact[address]">
      <input type="hidden" name="lpgas_contact[new_zip_code]">
      <input type="hidden" name="lpgas_contact[new_prefecture_code]">
      <input type="hidden" name="lpgas_contact[new_address]">
      <div class="form-step form-align">
        <div class="step-selected" id="form_title_step_1">① 物件種別</div>
        <div id="form_title_step_2">② 物件状況</div>
        <div id="form_title_step_3">③ 場所</div>
        <div id="form_title_step_4">④ 使用状況</div>
        <div id="form_title_step_5">⑤ 連絡先</div>
        <div class="step-check pc"><span>見積もりゲット!!</span></div>
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
                <div class="hand-navi-wrap">
                  <div><?= Asset::img('estimate_form/hand-navi.png'); ?></div>
                  <div><?= Asset::img('estimate_form/hand-navi.png'); ?></div>
                  <div><?= Asset::img('estimate_form/hand-navi.png'); ?></div>
                </div>
                <div class="house-kind input-wrap remove-error">
                  <input type="radio" name="lpgas_contact[house_kind]" value="detached" id="detached">
                  <label class="image-wrap hand-navi-label" for="detached">
                    <div class="normal sp"><?= Asset::img('estimate_form/sp/off-btn-home.png'); ?></div>
                    <div class="invert sp"><?= Asset::img('estimate_form/sp/on-btn-home.png'); ?></div>
                    <div class="normal pc"><?= Asset::img('estimate_form/off-btn-home.png'); ?></div>
                    <div class="invert pc"><?= Asset::img('estimate_form/on-btn-home.png'); ?></div>
                    <p>戸建・持ち家</p>
                  </label>
                </div>
                <div class="house-kind input-wrap remove-error">
                  <input type="radio" name="lpgas_contact[house_kind]" value="store_ex" id="store_ex">
                  <label class="image-wrap hand-navi-label" for="store_ex">
                    <div class="normal sp"><?= Asset::img('estimate_form/sp/off-btn-store.png'); ?></div>
                    <div class="invert sp"><?= Asset::img('estimate_form/sp/on-btn-store.png'); ?></div>
                    <div class="normal pc"><?= Asset::img('estimate_form/off-btn-store.png'); ?></div>
                    <div class="invert pc"><?= Asset::img('estimate_form/on-btn-store.png'); ?></div>
                    <p>店舗</p>
                  </label>
                </div>
                <div class="house-kind input-wrap remove-error">
                  <input type="radio" name="lpgas_contact[house_kind]" value="apartment" id="apartment">
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
              <div class="next-btn-hand-navi opacity-0"><div><?= Asset::img('estimate_form/hand-navi.png'); ?></div></div>
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
                <div class="hand-navi-wrap">
                  <div><?= Asset::img('estimate_form/hand-navi.png'); ?></div>
                  <div><?= Asset::img('estimate_form/hand-navi.png'); ?></div>
                </div>
                <div class="house-kind input-wrap remove-error error-wrap">
                  <input type="radio" name="lpgas_contact[estimate_kind]" value="change_contract" id="change_contract">
                  <label class="image-wrap hand-navi-label" for="change_contract">
                    <div class="normal sp"><?= Asset::img('estimate_form/sp/off-btn-current.png'); ?></div>
                    <div class="invert sp"><?= Asset::img('estimate_form/sp/on-btn-current.png'); ?></div>
                    <div class="normal pc"><?= Asset::img('estimate_form/off-btn-current.png'); ?></div>
                    <div class="invert pc"><?= Asset::img('estimate_form/on-btn-current.png'); ?></div>
                    <p>現在のお住まい</p>
                  </label>
                </div>
                <div class="house-kind input-wrap remove-error error-wrap">
                  <input type="radio" name="lpgas_contact[estimate_kind]" value="new_contract" id="new_contract">
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
              <div class="next-btn-hand-navi opacity-0"><div><?= Asset::img('estimate_form/hand-navi.png'); ?></div></div>
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
                  <input type="tel" name="lpgas_contact[number_of_rooms]" value="" placeholder="例） 18">
                </div>
              </div>
              <div class="address-box input-wrap apartment-box error-wrap">
                <div class="label2">入居済み部屋数</div>
                <div class="reference-wrap">
                  <div class="field-phone">
                    <input type="tel" name="lpgas_contact[number_of_active_rooms]" value="" placeholder="例） 10">
                  </div>
                  <div class="reference pc">(※任意)</div>
                </div>
              </div>
              <!-- <div class="reference sp">(日中繋がりやすい番号を入力してください)</div> -->
              <div class="address-box input-wrap apartment-box error-wrap">
                <div class="label2">管理会社名</div>
                <div class="field-phone">
                  <input type="text" name="lpgas_contact[estate_management_company_name]" value="" placeholder="例） 株式会社えねぴ">
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
                  <input type="tel" name="zip" value="" placeholder="1230000" onkeyup="convertZip(this, 'pref', 'addr')">
                </div>
              </div>
              <div class="address-box input-wrap error-wrap">
                <div class="label">住所</div>
                <div class="field-prefecture">
                  <?= render('test/prefectures'); ?>
                  <!-- <? /* f.collection_select :new_prefecture_code, JpPrefecture::Prefecture.all, :code, :name, {include_blank: '選択してください'}, {id: 'pref', name: 'pref'} */ ?> -->
                </div>
              </div>
              <div class="address-box input-wrap error-wrap">
                <div class="label"></div>
                <div class="field-address">
                  <input type="text" name="addr" value="" placeholder="例） 港区新橋1-1-1" id="addr">
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
                <div class="step-next-btn" id="address_btn" data-next-step="4">
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

              <div class="address-box input-wrap2 gas-usage-box gas-wrap mb-0">
                <div class="label3">使用設備<span class="optional">(任意)</span></div>
                <div class="row-wrap">
                  <div class="remove-error">
                    <input type="checkbox" name="lpgas_contact[using_cooking_stove]" value="1" id="cooking_stove">
                    <label for="cooking_stove">
                      <div><?= Asset::img('estimate_form/check-blue.png'); ?></div>
                      <span>ガスコンロ</span>
                    </label>
                  </div>
                  <div class="remove-error">
                    <input type="checkbox" name="lpgas_contact[using_bath_heater_with_gas_hot_water_supply]" value="1" id="bath_heater">
                    <label for="bath_heater">
                      <div><?= Asset::img('estimate_form/check-blue.png'); ?></div>
                      <span>給湯器</span>
                    </label>
                  </div>
                  <div class="remove-error">
                    <input type="checkbox" name="lpgas_contact[using_other_gas_machine]" value="1" id="other_gas_machine">
                    <label for="other_gas_machine">
                      <div><?= Asset::img('estimate_form/check-blue.png'); ?></div>
                      <span>ストーブその他</span>
                    </label>
                  </div>
                </div>
              </div>

              <div class="address-box input-wrap gas-wrap mb-0">
                <div class="label3">使用量・料金<span class="optional can-hide">(任意)</span></div>

                <div class="row-wrap">
                  <div class="field-capacity error-wrap remove-error">
                    <input type="tel" name="lpgas_contact[gas_meter_checked_month]" value="">
                  </div>
                  <div class="reference">月のガス使用量が</div>
                </div>

                <div class="row-wrap">
                  <div class="field-capacity error-wrap remove-error">
                    <input type="tel" name="lpgas_contact[gas_used_amount]" value="">
                  </div>
                  <div class="reference">m³で</div>
                  <div class="field-bill error-wrap remove-error">
                    <input type="tel" name="lpgas_contact[gas_latest_billing_amount]" value="">
                  </div>
                  <div class="reference">円(税込)</div>
                </div>
              </div>
              <div class="address-box input-wrap email-box remove-error error-wrap gas-wrap">
                <div class="label3">ガス会社名<span class="optional can-hide">(任意)</span></div>
                <div class="field-contracted-shop">
                  <input type="text" name="lpgas_contact[gas_contracted_shop_name]" value="" placeholder="例) 株式会社えねぴ">
                </div>
              </div>
            </div>
            <div class="slide-navi">
              <div>
                <div class="step-prev-btn" data-go-to-slide="3" data-go-to-slide-2="3" data-cur-step="4">
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
                  <input type="text" name="lpgas_contact[name]" value="" placeholder="例） 山田 太郎">
                </div>
              </div>
              <div class="address-box input-wrap error-wrap contact-wrap">
                <div class="label2">ふりがな</div>
                <div class="field-mail">
                  <input type="text" name="lpgas_contact[furigana]" value="" placeholder="例） やまだ たろう">
                </div>
              </div>
              <div class="address-box input-wrap error-wrap contact-wrap">
                <div class="label2">電話番号</div>
                <div class="field-mail">
                  <input type="tel" name="lpgas_contact[tel]" value="" placeholder="例） 09001230123">
                </div>
              </div>
              <div class="address-box input-wrap error-wrap contact-wrap">
                <div class="label2">メールアドレス</div>
                <div class="field-mail">
                  <input type="text" name="lpgas_contact[email]" value="" placeholder="例） info@enepi.jp">
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
        </div>
      </div>
    <?= Form::close(); ?>
  </div>
  <div class="form-agreement invisible-slide">
    <p class="terms pc">当サービスをご利用頂くにあたり、<a href="<?= \Uri::create('agreement'); ?>" target="_blank">「enepi」利用規約</a>に同意したものとみなします。</p>
    <p class="terms sp">当サービスをご利用頂くにあたり、<br><a href="<?= \Uri::create('agreement'); ?>" target="_blank">「enepi」利用規約</a> に同意したものとみなします。</p>
  </div>
</div>
<footer>
  <div class="container">
    <ul>
      <li><a href="/agreement">利用規約</a></li>
      <li><a href="http://www.iacc.co.jp/privacy" target="_blank">プライバシーポリシー</a></li>
      <li><a href="http://www.iacc.co.jp" target="_blank">運営会社</a></li>
    </ul>
  </div>
</footer>
