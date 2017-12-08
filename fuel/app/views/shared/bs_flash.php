<? if flash[:notice] ?>
  <div class="alert alert-success">
    <i class="fa fa-info-circle"></i>
    <?= flash[:notice] ?>
  </div>
<? } ?>
<? if flash[:warning] ?>
  <div class="alert alert-warning">
    <i class="fa fa-info-danger"></i>
    <?= flash[:warning] ?>
  </div>
<? } ?>
<? if flash[:alert] ?>
  <div class="alert alert-danger">
    <i class="fa fa-info-danger"></i>
    <?// FIXME ?>
    <?= raw flash[:alert] ?>
  </div>
<? } ?>
<? flash[:error] = flash[:alert] = flash[:warning] = flash[:notice] = nil ?>
