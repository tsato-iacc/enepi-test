<title>簡単入力！プロパンガス料金シミュレーション | エネピ</title>
<meta name="description" content="プロパンガス料金シミュレーションは、使用量やガス料金などを入力するだけで切り替え後の料金イメージをラクラク算出できます！さらにガス代が高くてお悩みのお客様には今よりおトクになるガス会社をネット上で無料ご提案します。" />
<meta name="charset" content="utf-8" />
<%- if flash[:notice] %>
	<div class="alert alert-success" style="color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; padding: 15px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 4px;">
		<i class="fa fa-info-circle"></i>
		<%= flash[:notice] %>
	</div>
<% end %>
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
					<%= form_tag(simple_simulations_path, method: 'POST') do %>
						<div class="form-group" style="width: 70%; margin: 40px auto 20px auto ;">
							<div class="form-inline">
								<div class="simulation-address">
									<label style="font-weight: bold;">都道府県</label>
									<select name="prefecture_code" onChange="simulation_search_city(this)" class="address-selector-prefecture">
										<option class="provisional_label" >選択してください</option>
										<% JpPrefecture::Prefecture.all.each do |p| %>
											<% if @data.present? && @data.prefecture_code == p.code %>
												<option value="<%= p.code %>" selected id="selected-prefecture"><%= p.name %></option>
											<% elsif	params[:prefecture_code].present? && params[:prefecture_code].to_i == p.code %>
												<option value="<%= p.code %>" selected id="selected-prefecture"><%= p.name %></option>
											<% else %>
												<option value="<%= p.code %>" ><%= p.name %></option>
											<% end %>
										<% end %>
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
								<% if @data.present? %>
										<option value="two_or_less_person_household" selected >2人以下</option>
										<option value="three_person_household">3人</option>
										<option value="four_person_household">4人</option>
										<option value="five_person_household">5人</option>
										<option value="six_person_household">6人</option>
										<option value="seven_or_more_person_household">7人以上</option>
								<% end %>
							</select>
						</div>
						<div class="simulation-extra-info" style="margin-bottom: 40px;">
							<%= label_tag(:bill, "だいたいのガス代/月(わかれば)") %>
							<% if @data.present? && @data.amount_billed.present? %>
								<%= text_field :simple_simulation, :bill,:value => "#{@data.amount_billed}", :class => 'simulation-form', 'data-hyphen-digits': 1 %>&nbsp;円
							<% else %>
								<%= text_field :simple_simulation, :bill, :class => 'simulation-form', 'data-hyphen-digits': 1 %>&nbsp;円
							<% end %>
						</div>
						<div class="simulation-link-button-wrapper">
							<%= submit_tag 'さっそく無料診断をする！▶︎', class: 'simple-simulation-button' %>
						</div>
					<% end %>
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
<% if @data.present? && @data.prefecture_code? %>
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
<% end %>
