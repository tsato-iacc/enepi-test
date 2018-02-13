<? if(Session::get_flash('notice')){ ?>
  <div class="alert alert-success">
    <i class="fa fa-info-circle"></i>
    <?= Session::get_flash('notice'); ?>
  </div>
<? } ?>
<? if(Session::get_flash('warning')){ ?>
  <div class="alert alert-warning">
    <i class="fa fa-info-danger"></i>
    <?= Session::get_flash('warning'); ?>
  </div>
<? } ?>
<? if(Session::get_flash('alert')){ ?>
  <div class="alert alert-danger">
    <i class="fa fa-info-danger"></i>
    <?= Session::get_flash('alert'); ?>
  </div>
<? } ?>

<? Session::delete_flash('error'); ?>
<? Session::delete_flash('alert'); ?>
<? Session::delete_flash('warning'); ?>
<? Session::delete_flash('notice'); ?>
