<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
  <div class="navbar-brand" href="#">
    <?= Asset::img('admin/fire.png', ['height' => '30', 'class' => 'd-inline-block align-top']); ?>&nbsp;&nbsp;enepi <?= $auth_user->company_name; ?>様 管理画面
  </div>
  <div class="collapse navbar-collapse">
    <ul class="navbar-nav mr-auto"></ul>
    <span class="navbar-text">(ID: <?= $auth_user->id; ?>) <?= $auth_user->email; ?></span>
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="<?= \Uri::create('partner/logout'); ?>"><i class="fa fa-sign-out"></i>ログアウト</a>
      </li>
    </ul>
  </div>
</nav>
