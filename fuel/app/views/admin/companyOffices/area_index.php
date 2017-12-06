<?= MyView::form_tag admin_lpgas_company_company_geocode_zip_codes_path(@company, @geocode), ["method" => 'POST' { ?>
  <p>
    改行して複数の郵便番号を登録できます。
  </p>
  <p>
    市区町村からも選べます。
    <?= collection_select(
      'pref',
      :code,
      JpPrefecture::Prefecture.all,
      :code,
      :name,
      include_blank: '選択してください',
    ) ?>
    <select id="city_name">
    </select>
  </p>
  <div class="form-group">
    <?= text_area_tag :zip_code, "", ["class" => "form-control", rows: "10" ?>
  </div>
  <div class="form-group">
    <?= submit_tag "追加", ["class" => 'btn btn-primary' ?>
  </div>
<? } ?>

<table class="table table-striped table-hover" style="margin-bottom: 0">
  <thead>
    <tr>
      <th>郵便番号</th>
      <th>備考</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <? @zip_codes.each { |z| ?>
      <tr>
        <td><?= z.zip_code ?></td>
        <td><?= z.notes ?></td>
        <td>
          <?= link_to(
            "削除",
            admin_lpgas_company_company_geocode_zip_code_path(@geocode.company, @geocode, z),
            data: {["method" => 'delete', confirm: 1}, ["class" => 'btn btn-danger btn-xs'
          ) ?>
        </td>
      </tr>
    <? } ?>
  </tbody>
</table>

<?= paginate @zip_codes ?>

<script>
  var cityName = document.querySelector('#city_name');
  var prefCode = document.querySelector('#pref_code');

  cityName.addEventListener('change', function(e) {
    e.preventDefault();
    var target = e.target;
    if (!target.value) {
      return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open("GET", "/admin/zip_codes?prefecture_code="+prefCode.value+"&city_name="+target.value);
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4) {
        var j = JSON.parse(xhr.responseText);
        var zip = document.querySelector("#zip_code");
        zip.innerHTML = j.map(function(z) {
          return z.zip_code + " (" + [z.prefecture_name, z.city_name, z.town_area_name].join(" ") + ")"
        }).join("\n")
      }
    };
    xhr.send(JSON.stringify(null));
  });
  prefCode.addEventListener('change', function(e) {
    e.preventDefault();

    cityName.innerHTML = '';

    var target = e.target;
    if (!target.value) {
      return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open("GET", "/admin/zip_codes/cities?prefecture_code="+target.value);
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4) {
        var o = document.createElement("option");
        o.value = "";
        o.textContent = "選択してください";
        cityName.appendChild(o);

        var j = JSON.parse(xhr.responseText);
        j.forEach(function(z) {
          var o = document.createElement("option");
          o.value = z.city_name;
          o.textContent = z.city_name;
          cityName.appendChild(o);
        });
      }
    };

    xhr.send(JSON.stringify(null));
  });
</script>
