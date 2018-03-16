<? if (\Input::get('conversion_id')){  ?>

  <?# 見積り完了時 ?>
  <? if($contact->status == \Config::get('models.contact.status.sent_estimate_req')){ ?>
    <? if($contact->sent_auto_estimate_req && $contact->pr_tracking_parameter_id){ ?>

      <? $conversion_tag_estimate = $contact->tracking->conversion_tags_for(\Config::get('models.tracking.cv_point.estimate'), \Input::get('conversion_id')); ?>
      <?= $conversion_tag_estimate ?>

      <? if($cv_point == \Config::get('models.tracking.cv_point.estimate')){ ?>
        <? if($from_kakaku && $_SERVER['FUEL_ENV'] == \Fuel::PRODUCTION){ ?>
          <?= render('shared/kakaku_tracking_done'); ?>
        <? } ?>
      <? } ?>

      <script src="https://ca.iacc.tokyo/js/ca.js"></script>
      <script>
        cacv('見積もり完了(自動見積もり)', {ch:'63912289', link:'<?= $contact->id ?>', tel:'<?= $contact->tel ?>', name:'<?= $contact->name ?>', mail:'<?= $contact->email ?>', zip:'<?= $contact->zip_code ?>', address:'<?= $contact->address ?>'});
      </script>

    <? } ?>
  <? } ?>


  <?//# 送客時 ?>
  <? if($contact->status == \Config::get('models.contact.status.verbal_ok')){ ?>
    <? if($contact->pr_tracking_parameter_id){ ?>

      <? $conversion_tag_verbal_ok = $contact->tracking->conversion_tags_for(\Config::get('models.tracking.cv_point.verbal_ok'), \Input::get('conversion_id')); ?>
      <?= $conversion_tag_verbal_ok ?>

      <? if($cv_point == \Config::get('models.tracking.cv_point.estimate')){ ?>
        <? if($from_kakaku && $_SERVER['FUEL_ENV'] == \Fuel::PRODUCTION){ ?>
          <?= render('shared/kakaku_tracking_done'); ?>
        <? } ?>
      <? } ?>

      <script src="https://ca.iacc.tokyo/js/ca.js"></script>
      <script>
        cacv('送客完了！', {link:'<?= $contact->id ?>', tel:'<?= $contact->tel ?>', name:'<?= $contact->name ?>', mail:'<?= $contact->email ?>', zip:'<?= $contact->zip_code ?>', address:'<?= $contact->address ?>'});
      </script>

    <? } ?>
  <? } ?>


<? } ?>
<?= render("shared/contact_parts") ?>