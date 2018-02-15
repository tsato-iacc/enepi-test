<? if($contact->sent_auto_estimate_req){ ?>

  <?//= render "cv_tags", contact: $contact, cv_point: :cv_point_done_estimate ?>
  <? $conversion_tag_estimate = $contact->tracking->conversion_tags_for(\Config::get('models.tracking.cv_point.estimate'), \Input::get('conversion_id'), $pr_tracking_parameter); ?>
  <?= $conversion_tag_estimate ?>

  <? if($cv_point == \Config::get('models.tracking.cv_point.estimate')){ ?>
    <? if($from_kakaku){ ?>
      <?= render('shared/kakaku_tracking_done'); ?>
    <? } ?>
  <? } ?>

<? } ?>

<? if($from_kakaku != null){ ?>
  <script type="text/javascript">
      if(typeof _satellite !!= "undefined"){
          _satellite.pageBottom();
      }
  </script>
<? } ?>

<script src="https://ca.iacc.tokyo/js/ca.js"></script>
<script>
  cacv('見積もり完了(手動送客)', {ch:'63912289', link:'<?= $contact->id ?>', tel:'<?= $contact->tel ?>', name:'<?= $contact->name ?>', mail:'<?= $contact->email ?>', zip:'<?= $contact->zip_code ?>', address:'<?= $contact->address ?>'});
</script>