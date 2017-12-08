<?php
class nData{

    var $a;
    var $b;
    var $amount_billed;
}


$hash["name"] = "ABC";
$hash["key"] = "xxx";
$hash["age"] = "12";
$hash["address"] = "xxxx";
$hash["address"] = "yyy";



//$hash = ["name" => "ABC", "key" => "xxx", "age" => "12"];  // hash


$bill = "";

$simple_simulations_path = "";
$simple_simulation = "ABC";

$data = new nData();
$data->a;


?>

<?= render('front/breadcrumb', ['breadcrumb' => $breadcrumb]); ?>

<? //if flash[:notice] ?>
<!-- <div class="alert alert-success" style="color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; padding: 15px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 4px;">
	<i class="fa fa-info-circle"></i>
	<?//= "flash[:notice]" ?>
</div> -->

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
					<?= Form::open('simple_simulations'); ?>
					<?= Form::csrf(); ?>
					<form action="/simple_simulations" accept-charset="UTF-8" method="post">
						<div class="form-group" style="width: 70%; margin: 40px auto 20px auto ;">
							<div class="form-inline">
								<div class="simulation-address">
									<label style="font-weight: bold;">都道府県</label>
									<select name="prefecture_code" onChange="simulation_search_city(this)" class="address-selector-prefecture">
										<option class="provisional_label" selected>選択してください</option>
										<option value="1">北海道</option>
										<option value="2">青森県</option>
										<option value="3">岩手県</option>
										<option value="4">宮城県</option>
										<option value="5">秋田県</option>
										<option value="6">山形県</option>
										<option value="7">福島県</option>
										<option value="8">茨城県</option>
										<option value="9">栃木県</option>
										<option value="10">群馬県</option>
										<option value="11">埼玉県</option>
										<option value="12">千葉県</option>
										<option value="13">東京都</option>
										<option value="14">神奈川県</option>
										<option value="15">新潟県</option>
										<option value="16">富山県</option>
										<option value="17">石川県</option>
										<option value="18">福井県</option>
										<option value="19">山梨県</option>
										<option value="20">長野県</option>
										<option value="21">岐阜県</option>
										<option value="22">静岡県</option>
										<option value="23">愛知県</option>
										<option value="24">三重県</option>
										<option value="25">滋賀県</option>
										<option value="26">京都府</option>
										<option value="27">大阪府</option>
										<option value="28">兵庫県</option>
										<option value="29">奈良県</option>
										<option value="30">和歌山県</option>
										<option value="31">鳥取県</option>
										<option value="32">島根県</option>
										<option value="33">岡山県</option>
										<option value="34">広島県</option>
										<option value="35">山口県</option>
										<option value="36">徳島県</option>
										<option value="37">香川県</option>
										<option value="38">愛媛県</option>
										<option value="39">高知県</option>
										<option value="40">福岡県</option>
										<option value="41">佐賀県</option>
										<option value="42">長崎県</option>
										<option value="43">熊本県</option>
										<option value="44">大分県</option>
										<option value="45">宮崎県</option>
										<option value="46">鹿児島県</option>
										<option value="47">沖縄県</option>
										<?// foreach(JpPrefecture::Prefecture->$all as $p)| ?>
											<?// if ($data->present && $data->prefecture_code == $p->code){ ?>
												<!-- <option value="<?//= $p->code ?>" selected id="selected-prefecture"><?//= $p->name ?></option> -->
											<?// }elseif($prefecture_code->present && $prefecture_code->to_i == $p->code){ ?>
												<!-- <option value="<?//= $p->code ?>" selected id="selected-prefecture"><?//= $p->name ?></option> -->
											<?// }else{ ?>
												<!-- <option value="<?//= $p->code ?>" ><?//= $p->name ?></option> -->
											<?// } ?>

									</select>
									<label style="font-weight: bold;">市区町村</label>
									<select name="city_code" id="city_list" class="address-selector">
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
						</div>
						<div class="simulation-extra-info" style="margin-bottom: 40px;">
							<label>だいたいのガス代/月(わかれば)</label>
							<? if(true){ ?>
								<?//= text_field :simple_simulation, :bill :value => "#{@data.amount_billed}", :class => 'simulation-form', 'data-hyphen-digits': 1 ?>
								<? MyView::text_field($simple_simulation, [
                                        								    "bill" => "",
								                                            "value" => $data->amount_billed,
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
