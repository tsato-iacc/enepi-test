<div class="list-group sidebar">
  <li class="list-group-item list-group-item-heading"><i class="fa fa-fire"></i>問い合わせ管理</li>
  <a href="<?= \Uri::create('partner/estimates') ?>" class="list-group-item list-group-item-action<?= \Request::active()->controller == 'Controller_Partner_Estimates' && in_array(\Request::active()->action, ['index', 'show']) ? ' active' : ''; ?>"><i class="fa fa-handshake-o"></i>見積もり依頼一覧</a>
</div>
