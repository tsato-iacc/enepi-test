<?= render('shared/estimate_form', ['contact' => $contact, 'month_selected' => $month_selected]); ?>
<?php if (\Uri::segment(1) != 'kakaku'): ?>
  <?= render('shared/estimate_slot', ['slots' => $slots]); ?>
<?php endif; ?>
