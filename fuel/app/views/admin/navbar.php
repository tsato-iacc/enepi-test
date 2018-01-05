<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
  <a class="navbar-brand" href="#">
    <?= Asset::img('admin/fire.png', ['height' => '30', 'class' => 'd-inline-block align-top']); ?>&nbsp;&nbsp;Enepi 管理画面
  </a>
  <div class="collapse navbar-collapse">
    <ul class="navbar-nav mr-auto"></ul>
    <span class="navbar-text">email@iacc.co.jp</span>
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="<?= \Uri::create('admin/logout'); ?>"><i class="fa fa-sign-out"></i>ログアウト</a>
      </li>
    </ul>
  </div>
</nav>
