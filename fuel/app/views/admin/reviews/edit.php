<?= simple_form_for [:admin, @review] { |f| ?>
  <h3>レビュアー情報</h3>
  <div class="form-group">
    <div class="form-inline">
      <p style="font-weight: bold;">住所</p>
      <select name="prefecture_code" onChange="search_city(this)">
        <?= @prefectures.each { |p| ?>
          <? if p.code == @review.prefecture_code ?>
            <option value="<?= p.code ?>" selected ><?= p.name ?></option>
          <? else ?>
            <option value="<?= p.code ?>"><?= p.name ?></option>
          <? } ?>
        <? } ?>
      </select>
      <select name="city_code" id="city_list">
        <option value="0" class="provisional_option">市区町村は指定しない</option>
        <?= @cities.each { |city| ?>
          <? if city.id == @review.city_code ?>
            <option value="<?= city.id ?>" class="city_option" selected ><?= city.city_name ?></option>
          <? else ?>
            <option value="<?= city.id ?>" class="city_option"><?= city.city_name ?></option>
          <? } ?>
        <? } ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <div class="form-inline">
      <?= f.label :年齢, style: 'margin-top: 10px;' ?>
      <?= f.text_field :reviewer_age, style: 'margin-bottom: 10px;' ?>
      <?= f.label :職業, style: 'margin-top: 10px;' ?>
      <?= f.text_field :reviewer_occupation, style: 'margin-bottom: 10px;' ?>
    </div>
  </div>
  <div style="margin-bottom: 10px;">
    <p style="font-weight: bold;">性別</p>
    <?= f.radio_button :reviewer_gender, "男性" ?><?= f.label :reviewer_gender, "男性", {:style => "margin: 0 5px 0 5px;"} ?>
    <?= f.radio_button :reviewer_gender, "女性" ?><?= f.label :reviewer_gender, "女性", {:style => "margin-left: 5px;"} ?>
  </div>
  <div style="margin-bottom: 10px;">
    <?= f.radio_button :contracted_or_considering, "0" ?><?= f.label :contracted_or_considering, "切り替えした人の声", {:style => "margin: 0 5px 0 5px;"} ?>
    <?= f.radio_button :contracted_or_considering, "1" ?><?= f.label :contracted_or_considering, "検討した人の声", {:style => "margin-left: 5px;"} ?>
  </div>
  <div style="margin-bottom: 10px;">
    <?= f.radio_button :with_enepi_or_not, "0" ?><?= f.label :with_enepi_or_not, "エネピを利用した", {:style => "margin: 0 5px 0 5px;"} ?>
    <?= f.radio_button :with_enepi_or_not, "1" ?><?= f.label :with_enepi_or_not, "エネピを利用しなかった", {:style => "margin-left: 5px;"} ?>
  </div>
  <h3 class="test">口コミ本文</h3>
  <?= f.input :word_of_mouth, label: false, maxlength: 1000, placeholder: "600文字程度まで入力できます",:input_html => { :rows => 8 } ?>
  <?= f.button :submit ?>
<? } ?>
