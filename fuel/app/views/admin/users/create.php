<?= \Form::open(['action' => \Uri::create('admin/users')]); ?>
  <?= \Form::csrf(); ?>
  <div class="form-group<?= $val->error('email') ? ' has-danger' : ''?>">
    <label class="form-control-label" for="email"><h6>Email <span class="badge badge-default">必須</span></h6></label>
    <input type="text" name="email" value="<?= $val->input('email', '') ?>" class="form-control form-control-danger" id="email">
    <?php if ($val->error('email')): ?>
      <div class="form-control-feedback"><?= e($val->error('email')) ?></div>
    <?php endif; ?>
  </div>
  <button type="submit" class="btn btn-primary">登録する</button>
<?= Form::close(); ?>
