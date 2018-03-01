<div class="container">
  <?= \Form::open(['class' => 'form-signin']); ?>
    <?= \Form::csrf(); ?>
    <h2 class="form-signin-heading"><?= \Uri::segment(1) == 'partner' ? 'enepiパートナー様管理画面' : 'enepi管理画面'; ?></h2>
    
    <?php if (\Uri::segment(1) == 'partner'): ?>
      <label for="login_id" class="sr-only">ログインID</label>
      <input id="login_id" type="text" class="form-control auth-bottom-clear" name="login_id" value="<?= $val->input('login_id', '') ?>" required autofocus placeholder="ログインID">
      <?php if ($val->error('login_id')): ?>
        <span class="help-block">
          <strong><?= e($val->error('login_id')) ?></strong>
        </span>
      <?php endif;?>
    <?php endif;?>

    <label for="email" class="sr-only">メールアドレス</label>
    <input id="email" type="email" class="form-control<?= \Uri::segment(1) == 'partner' ? ' rounded-0' : '' ?>" name="email" value="<?= $val->input('email', '') ?>" required<?= \Uri::segment(1) == 'partner' ? '' : ' autofocus' ?> placeholder="メールアドレス">
    <?php if ($val->error('email')): ?>
      <span class="help-block">
        <strong><?= e($val->error('email')) ?></strong>
      </span>
    <?php endif;?>

    <label for="password" class="sr-only">パスワード</label>
    <input id="password" type="password" class="form-control" name="password" required placeholder="パスワード">
    <?php if ($val->error('password')): ?>
      <span class="help-block">
        <strong><?= e($val->error('password')) ?></strong>
      </span>
    <?php endif;?>

    <div class="checkbox">
      <label>
        <input type="checkbox" name="remember"<?= $val->input('remember') ? 'checked="checked"' : '' ?>> ログイン状態を保存する
      </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">ログイン</button>
  <?= Form::close(); ?>
</div>
