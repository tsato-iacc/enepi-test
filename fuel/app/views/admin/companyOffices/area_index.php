<?php
use JpPrefecture\JpPrefecture;
?>
<div class="row">
  <?php foreach (JpPrefecture::allKanjiAndCode() as $key => $name):?>
    <div class="btn-group col-2 mb-4" role="group" aria-label="Basic example">
      <button type="button" class="btn btn-secondary w-100"><?= $name; ?></button>
      <button type="button" class="btn btn-secondary"><i class="fa fa-cogs" aria-hidden="true"></i></button>
    </div>
    <!-- <div class="btn-group col-2 mb-4">
      <button type="button" class="btn btn-secondary w-100"><?= $name; ?></button>
      <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="sr-only">Toggle Dropdown</span>
      </button>
      <div class="dropdown-menu dropdown-menu-left">
        <a class="dropdown-item" href="#">Custom</a>
      </div>
    </div> -->
  <?php endforeach; ?>
</div>