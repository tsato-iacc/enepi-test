<div class="form-group<?= $val->error('name') ? ' has-danger' : ''; ?>">
  <label class="form-control-label" for="name"><h6><i class="fa fa-asterisk" aria-hidden="true"></i> テンプレート名:</h6></label>
  <input name="name" class="form-control" id="name" value="<?= $val->input('name', $template->name); ?>">
  <?php if ($val->error('name')): ?>
    <div class="form-control-feedback"><?= e($val->error('name')); ?></div>
  <?php endif; ?>
</div>
<div class="form-group<?= $val->error('subject') ? ' has-danger' : ''; ?>">
  <label class="form-control-label" for="subject"><h6><i class="fa fa-asterisk" aria-hidden="true"></i> 件名:</h6></label>
  <input name="subject" class="form-control" id="subject" value="<?= $val->input('subject', $template->subject); ?>">
  <?php if ($val->error('subject')): ?>
    <div class="form-control-feedback"><?= e($val->error('subject')); ?></div>
  <?php endif; ?>
</div>
<div class="form-group<?= $val->error('body') ? ' has-danger' : ''; ?>">
  <label class="form-control-label" for="body"><h6><i class="fa fa-asterisk" aria-hidden="true"></i> 内容:</h6></label>
  <textarea name="body" class="form-control" id="body" rows="15"><?= $val->input('body', $template->body); ?></textarea>
  <?php if ($val->error('body')): ?>
    <div class="form-control-feedback"><?= e($val->error('body')); ?></div>
  <?php endif; ?>
</div>
