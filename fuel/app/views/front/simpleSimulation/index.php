<?php
use Fuel\Core\Form;
use JpPrefecture\JpPrefecture;

$simple_simulation = "";
?>

<?= render('front/breadcrumb', ['breadcrumb' => $breadcrumb]); ?>

<div id="message" hidden="">
  <div class="alert alert-success" style="color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; padding: 15px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 4px;">
    <i class="fa fa-info-circle"></i>
    <span id="targetText"></span>
    </script>
  </div>
</div>

<div class="article-page">
  <div class="article">
    <div class="article-list-v3-panel">
      <div class="panel-inner article-list-v3-panel-container">
        <div class="simulation-top-box">
          <div class="simulation-title">
            <span style="font-size: 120%;">＼</span>&nbsp;いくら安くなる?&nbsp;<span style="font-size: 120%;">／</span>
          </div>
          <h3 class="simulation-sub-title">
            プロパンガス料金の無料診断
          </h3>
          <p class="simulation-title-content">1.地域の料金相場と比較</p>
          <p class="simulation-title-content2">2.エネピ利用時の節約額</p>
        </div>
        <div class="simulation-form-box">
          <?= Form::open(array('name' => 'simple_simulations_form', 'action' => '/simple_simulations', 'method' => 'post', 'class' => 'form_class', 'onsubmit' => 'return check()')); ?>
          <?= Form::csrf(); ?>
            <div class="form-group" style="width: 70%; margin: 40px auto 20px auto ;">
              <div class="form-inline">
                <div class="simulation-address">
                  <label style="font-weight: bold;">都道府県</label>
                    <select name = "prefecture_code" id = "prefecture_code_id" onChange="simulation_search_city()" class="address-selector-prefecture">
                      <option class="provisional_label" value = "0"selected>選択してください</option>
                        <? for($i = 1; $i <= 47; $i++){
                          $p = JpPrefecture::findByCode($i); ?>
                          <option value="<?= $i  ?>"><?= $p->nameKanji ?></option>
                        <? } ?>
                      </select>
                    <label style="font-weight: bold;">市区町村</label>
                  <select name = "city_code" id="city_list" class="address-selector">
                    <option value="0" class="provisional_option">選択してください</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="simulation-extra-info">
              <label>世帯人数(必須)</label>
              <select name="household" class="household-selector">

                    <option value="two_or_less_person_household" selected >2人以下</option>
                    <option value="three_person_household">3人</option>
                    <option value="four_person_household">4人</option>
                    <option value="five_person_household">5人</option>
                    <option value="six_person_household">6人</option>
                    <option value="seven_or_more_person_household">7人以上</option>

              </select>
              <label>使用月</label>
              <select name="month" class="household-selector">
                  <option value="january">1月</option>
                  <option value="february">2月</option>
                  <option value="march">3月</option>
                  <option value="april">4月</option>
                  <option value="may">5月</option>
                  <option value="june">6月</option>
                  <option value="july">7月</option>
                  <option value="august">8月</option>
                  <option value="september">9月</option>
                  <option value="october">10月</option>
                  <option value="november" selected>11月</option>
                  <option value="december">12月</option>
              </select>
            </div>
            <div class="simulation-extra-info" style="margin-bottom: 40px;">
              <label>だいたいのガス代/月(わかれば)</label>
              <? if(true){ ?>
                <?//= text_field :simple_simulation, :bill :value => "#{@data.amount_billed}", :class => 'simulation-form', 'data-hyphen-digits': 1 ?>
                <? MyView::text_field($simple_simulation, [
                                                            "bill" => "",
                                                            "value" => "",
                                                            "class" => "simulation-form",
                                                            "data-hyphen-digits" => "1"]) ?>&nbsp;円

              <? }else{ ?>
                <?//= text_field :simple_simulation, :bill, :class => 'simulation-form', 'data-hyphen-digits': 1 ?>
                <? MyView::text_field($simple_simulation, [
                                                            "bill" => "",
                                                            "value" => "",
                                                            "class" => "simulation-form",
                                                            "data-hyphen-digits" => "1"]) ?>&nbsp;円
              <? } ?>
            </div>
            <div class="simulation-link-button-wrapper">
              <? MyView::submit_tag('さっそく無料診断をする！▶︎', [
                                                                  "class" => 'simple-simulation-button',
                                                                  "value" => 'さっそく無料診断をする！▶︎']) ?>
            </div>
          <?= Form::close(); ?>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
function simulation_search_city(){
	var prefecture_code = document.forms.simple_simulations_form.prefecture_code;
	var city_code = document.forms.simple_simulations_form.city_code;
	document.getElementById("prefecture_code_id").remove(0);
	if (prefecture_code.options[prefecture_code.selectedIndex].value == "1"){
		city_code.options[1] = new Option("札幌市");
		city_code.options[2] = new Option("江別市");
		city_code.options[3] = new Option("恵庭市");
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "2"){
		city_code.options[1] = new Option("五所川原市");
		city_code.options[2] = new Option("つがる市");
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "3"){
		city_code.options[1] = new Option("盛岡市");
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "4"){
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "5"){
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "6"){
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "7"){
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "8"){
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "9"){
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "10"){
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "11"){
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "12"){
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "13"){
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "14"){
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "15"){
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "16"){
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "17"){
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "18"){
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "19"){
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "20"){
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "21"){
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "22"){
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "23"){
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "24"){
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "25"){
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "26"){
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "27"){
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "28"){
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "29"){
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "30"){
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "31"){
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "32"){
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "33"){
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "34"){
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "35"){
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "36"){
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "37"){
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "38"){
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "39"){
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "40"){
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "41"){
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "42"){
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "43"){
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "44"){
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "45"){
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "46"){
	}else if (prefecture_code.options[prefecture_code.selectedIndex].value == "47"){
	}
}

function check(){
	var prefecture_code = document.forms.simple_simulations_form.prefecture_code;
	var city_code = document.forms.simple_simulations_form.city_code;
	var message_display = document.getElementById("message");

	if(prefecture_code.value == "0"){
		message_display.removeAttribute("hidden");
		document.getElementById('targetText').innerHTML ="都道府県を選択してください";
		return false;
	}else if(city_code.value == "0"){
		message_display.removeAttribute("hidden");
		document.getElementById('targetText').innerHTML ="市区町村を選択してください";
		return false;
	}
}

/*
  function simulation_search_city(obj){
    var idx = obj.selectedIndex;
    var value = obj.options[idx].value;
    if($('option').hasClass('city_option')){
      $('.city_option').remove();
    }
    $.ajax({
        type: 'GET',
        url: '/simple_simulations/search_city',
        data: {
          prefecture_code: value
        },
        dataType: 'json'
    })

    .done(function(data) {
      $.each(data, function(i , city) {
        var city_name = city.city_name
        var city_code = city.id
        var city_select = $('<option class="city_option" value= '+ city_code +'>'+ city_name + '</option>');
        $('#city_list').append(city_select);
      });
      $('.provisional_label').remove();
    })
    .fail(function() {
      alert('error');
    });
  }
  */
</script>
<script type="text/javascript">
/*
  window.onload = function() {
    var value = $('.address-selector-prefecture').val()
    if (value != "選択してください") {
      if($('option').hasClass('city_option')){
        $('.city_option').remove();
      }
      $.ajax({
          type: 'GET',
          url: '/simple_simulations/search_city',
          data: {
            prefecture_code: value
          },
          dataType: 'json'
      })

      .done(function(data) {
        $.each(data, function(i , city) {
          var city_name = city.city_name
          var city_code = city.id
          var city_select = $('<option class="city_option" value= '+ city_code +'>'+ city_name + '</option>');
          $('#city_list').append(city_select);
        });
        $('.provisional_label').remove();
      })
      .fail(function() {
        alert('error');
      });
    }
  };
  */
</script>
<?// if(!$data->present && $data->prefecture_code){ ?>
  <script type="text/javascript">
  /*
    $(document).ready(function(){
      var value = this.getElementById( "selected-prefecture" ).value ;
      if($('option').hasClass('city_option')){
      $('.city_option').remove();
      }
      $.ajax({
          type: 'GET',
          url: '/simple_simulations/search_city',
          data: {
            prefecture_code: value
          },
          dataType: 'json'
      })

      .done(function(data) {
        $.each(data, function(i , city) {
          var city_name = city.city_name
          var city_code = city.id
          var city_select = $('<option class="city_option" value= '+ city_code +'>'+ city_name + '</option>');
          $('#city_list').append(city_select);
        });
        $('.provisional_label').remove();
      })
      .fail(function() {
        alert('error');
      });
    });
    */
  </script>
<?// } ?>
