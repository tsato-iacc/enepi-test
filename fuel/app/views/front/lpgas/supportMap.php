<h2>対応エリア検索</h2>

<form style="margin-bottom: 1em; margin-top: 0.5em">
  <label style="margin-right: 0.5em;">郵便番号</label>
  <?= text_field_tag :zip_code, params[:zip_code], ["class" => 'form-control' ?>

  <input id="submit" type="submit" value="検索" style="margin-right: 0.5em;">

  <? if params[:zip_code].present? ?>
    <? if @exists ?>
      <strong style="color: green">対応可能</strong>
    <? else ?>
      <strong style="color: red">対応不可</strong>
    <? } ?>
  <? } ?>
</form>
