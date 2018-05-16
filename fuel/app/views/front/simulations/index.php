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
    				<input type="hidden" name="tr" value="<?= \Input::get('tr'); ?>">
						<div class="form-group" style="width: 70%; margin: 40px auto 20px auto ;">
							<div class="form-inline">
								<div class="simulation-address">
									<label style="font-weight: bold;">都道府県</label>
									<?= Form::select('prefecture_code', $prefecture_code, ['' => '選択してください'] + JpPrefecture::allKanjiAndCode(), ['class' => 'address-selector-prefecture']); ?>
									<label style="font-weight: bold;">市区町村</label>
									<select name="city_code" id="city_list" class="address-selector" disabled="disabled">
										<option value="" class="provisional_option">選択してください</option>
									</select>
								</div>
							</div>
						</div>
						<div class="simulation-extra-info">
							<label>世帯人数(必須)</label>
							<?= Form::select('household', 'two_or_less_person_household', \Config::get('enepi.household.key_string'), ['class' => 'household-selector']); ?>
							<label>使用月</label>
							<?= Form::select('month', $month_selected, \Config::get('enepi.simulation.month.key_string'), ['class' => 'household-selector']); ?>
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
