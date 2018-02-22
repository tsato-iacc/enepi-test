<div class="container">
  <?= \Form::open(['class' => 'form-signin']); ?>
    <?= \Form::csrf(); ?>
    <h2 class="form-signin-heading">enepi管理画面</h2>
    
    <label for="email" class="sr-only">メールアドレス</label>
    <input id="email" type="email" class="form-control" name="email" value="<?= $val->input('email', '') ?>" required autofocus placeholder="メールアドレス">
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
