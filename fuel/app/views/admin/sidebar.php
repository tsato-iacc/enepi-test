<div class="list-group sidebar">
  <li class="list-group-item list-group-item-heading"><i class="fa fa-sitemap"></i>サイト管理</li>
  <a href="<?= \Uri::create('admin/users') ?>" class="list-group-item list-group-item-action<?= \Uri::segment(2) == 'users' ? ' active' : ''; ?>"><i class="fa fa-user-secret"></i>管理者一覧</a>
  <a href="<?= \Uri::create('admin/tracking') ?>" class="list-group-item list-group-item-action<?= \Uri::segment(2) == 'tracking' ? ' active' : ''; ?>"><i class="fa fa-code"></i>経由元一覧</a>
</div>

<div class="list-group sidebar">
  <li class="list-group-item list-group-item-heading"><i class="fa fa-group"></i>提携会社管理</li>
  <a href="<?= \Uri::create('admin/partner_companies') ?>" class="list-group-item list-group-item-action<?= \Uri::segment(2) == 'partner_companies' ? ' active' : ''; ?>"><i class="fa fa-building"></i>会社一覧</a>
</div>

<div class="list-group sidebar">
  <li class="list-group-item list-group-item-heading"><i class="fa fa-fire"></i>LPガス関連管理</li>
  <a href="<?= \Uri::create('admin/callings') ?>" class="list-group-item list-group-item-action<?= \Uri::segment(2) == 'callings' ? ' active' : ''; ?>"><i class="fa fa-phone"></i>架電リスト</a>
  <a href="<?= \Uri::create('admin/companies') ?>" class="list-group-item list-group-item-action<?= \Uri::segment(2) == 'companies' ? ' active' : ''; ?>"><i class="fa fa-building"></i>会社一覧</a>
  <a href="<?= \Uri::create('admin/contacts') ?>" class="list-group-item list-group-item-action<?= \Uri::segment(2) == 'contacts' ? ' active' : ''; ?>"><i class="fa fa-user"></i>問い合わせ一覧</a>
  <a href="<?= \Uri::create('admin/estimates') ?>" class="list-group-item list-group-item-action<?= \Request::active()->controller == 'Controller_Admin_Estimates' && in_array(\Request::active()->action, ['index', 'show']) ? ' active' : ''; ?>"><i class="fa fa-handshake-o"></i>見積もり依頼一覧</a>
  <a href="<?= \Uri::create('admin/activity') ?>" class="list-group-item list-group-item-action<?= \Uri::segment(2) == 'activity' ? ' active' : ''; ?>"><i class="fa fa-bullhorn"></i>対応リスト</a>
  <a href="<?= \Uri::create('admin/estimates/history') ?>" class="list-group-item list-group-item-action<?= \Request::active()->controller == 'Controller_Admin_Estimates' && \Request::active()->action == 'history' ? ' active' : ''; ?>"><i class="fa fa-table"></i>見積もり依頼変更履歴</a>
  <a href="<?= \Uri::create('admin/behavior') ?>" class="list-group-item list-group-item-action<?= \Uri::segment(2) == 'behavior' ? ' active' : ''; ?>"><i class="fa fa-history"></i>見積もり提示閲覧履歴</a>
  <a href="<?= \Uri::create('admin/tracking/statistics') ?>" class="list-group-item list-group-item-action<?= \Uri::segment(2) == 'tracking' ? ' active' : ''; ?>"><i class="fa fa-pie-chart"></i>経由元別集客状況</a>
  <a href="<?= \Uri::create('admin/bills') ?>" class="list-group-item list-group-item-action<?= \Uri::segment(2) == 'bills' ? ' active' : ''; ?>"><i class="fa fa-jpy"></i>請求額</a>
  <a href="<?= \Uri::create('admin/unsupported') ?>" class="list-group-item list-group-item-action<?= \Uri::segment(2) == 'unsupported' ? ' active' : ''; ?>"><i class="fa fa-map-marker"></i>非対応都道府県</a>
  <a href="<?= \Uri::create('admin/company_features') ?>" class="list-group-item list-group-item-action<?= \Uri::segment(2) == 'company_features' ? ' active' : ''; ?>"><i class="fa fa-hand-pointer-o"></i>会社特徴マスタ</a>
  <a href="<?= \Uri::create('admin/holiday') ?>" class="list-group-item list-group-item-action<?= \Uri::segment(2) == 'holiday' ? ' active' : ''; ?>"><i class="fa fa-bed"></i>年末年始休業設定</a>
</div>

<div class="list-group sidebar">
  <li class="list-group-item list-group-item-heading"><i class="fa fa-comment"></i>口コミ管理</li>
  <a href="<?= \Uri::create('admin/reviews') ?>" class="list-group-item list-group-item-action<?= \Uri::segment(2) == 'reviews' ? ' active' : ''; ?>"><i class="fa fa-newspaper-o"></i>口コミ一覧</a>
</div>
