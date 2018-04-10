<? if($contact->sent_auto_estimate_req){ ?>
	<? if (\Input::get('conversion_id')){  ?>
		<? if($contact->pr_tracking_parameter_id){ ?>

		    <? $conversion_tag_estimate = $contact->tracking->conversion_tags_for(\Config::get('models.tracking.cv_point.estimate'), \Input::get('conversion_id')); ?>
		    <?= $conversion_tag_estimate ?>

			<? if($cv_point == \Config::get('models.tracking.cv_point.estimate')){ ?>
			  <? if($from_kakaku && $_SERVER['FUEL_ENV'] == \Fuel::PRODUCTION){ ?>
			    <?= render('shared/kakaku_tracking_done'); ?>
			  <? } ?>
			<? } ?>

		<? }else{ ?>
		    <? $conversion_tag = $contact->conversion_tags_all(\Config::get('models.tracking.cv_point.estimate'), \Input::get('conversion_id')); ?>
		    <?= $conversion_tag ?>

		<? } ?>
	<? } ?>
<? } ?>

<? if($from_kakaku){ ?>
  <script type="text/javascript">
      if(typeof _satellite !!= "undefined"){
          _satellite.pageBottom();
      }
  </script>
<? } ?>

<script src="https://ca.iacc.tokyo/js/ca.js"></script>
<script>
cacv('見積もり完了(自動見積もり)', {ch:'63912289', link:'<?= $contact->id ?>', tel:'<?= $contact->tel ?>', name:'<?= $contact->name ?>', mail:'<?= $contact->email ?>', zip:'<?= $contact->zip_code ?>', address:'<?= $contact->address ?>'});
</script>
