<table class="table table-sm table-hover small-row">
  <thead>
    <tr>
      <th></th>
      <th>問い合わせ/見積り</th>
      <th>関連する変更/日時</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($activity as $item): ?>
      <tr>
        <td><?= $item->note; ?></td>
        <td>
          <div><a href="<? \Uri::create('admin/contacts/:id', ['id' => $item->estimate->contact->id]); ?>"><?= $item->estimate->contact->name; ?></a></div>
          <div><a href="<? \Uri::create('admin/contacts/:id', ['id' => $item->estimate->contact->id]); ?>"><?= $item->estimate->company->getCompanyName(); ?></a></div>
        </td>
        <td>
          <?= $item->history->getActivityChanges() ;?>
        </td>
        <td></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?= \Pagination::instance('activity')->render(); ?>
