<?php
use JpPrefecture\JpPrefecture;
?>

<?= render('front/breadcrumb', ['breadcrumb' => $breadcrumb]); ?>

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
					<?= \Form::open(['id' => 'simple_simulation', 'action' => \Uri::create('simple_simulations')]); ?>
    			<?= \Form::csrf(); ?>
						<div class="form-group" style="width: 70%; margin: 40px auto 20px auto ;">
							<div class="form-inline">
								<div class="simulation-address">
									<label style="font-weight: bold;">都道府県</label>
									<?= Form::select('prefecture_code', '', ['' => '選択してください'] + JpPrefecture::allKanjiAndCode(), ['class' => 'address-selector-prefecture']); ?>
									<label style="font-weight: bold;">市区町村</label>
									<select name="city_code" id="city_list" class="address-selector" disabled="disabled">
										<option value="" class="provisional_option">選択してください</option>
									</select>
								</div>
							</div>
						</div>
						<div class="simulation-extra-info">
							<label>世帯人数(必須)</label>
							<?= Form::select('household', 'two_or_less_person_household', $household, ['class' => 'household-selector']); ?>
							<label>使用月</label>
							<?= Form::select('month', $month_selected, $month, ['class' => 'household-selector']); ?>
						</div>
						<div class="simulation-extra-info" style="margin-bottom: 40px;">
							<label for="bill">だいたいのガス代/月(わかれば)</label>
							<input class="simulation-form" data-hyphen-digits="1" type="tel" name="bill" id="bill">&nbsp;円
						</div>
						<div class="simulation-link-button-wrapper">
							<input type="submit" name="さっそく無料診断をする！▶︎" value="さっそく無料診断をする！▶︎" class="simple-simulation-button" id="simple_simulation_btn">
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
