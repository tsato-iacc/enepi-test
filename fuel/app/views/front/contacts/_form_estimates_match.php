<div class="estimates-match-screen">
  <div class="match-header">
    <div class="match-title">
      <?= \Asset::img('estimates_match_screen/ok.png'); ?>
    </div>
  </div>
  <?= Form::open(['action' => '/lpgas/contacts/'.$contact->id.'/estimates/ok_tentatively']); ?>
    <?= \Form::csrf(); ?>
  
  <?= Form::close(); ?>
</div>