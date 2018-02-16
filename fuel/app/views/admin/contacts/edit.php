<?php
use JpPrefecture\JpPrefecture;
?>
<?php if ($contact->deleted_at): ?>
  <div class="card card-inverse card-danger text-center">
    <div class="card-block">
      <blockquote class="card-blockquote"><?= Helper\TimezoneConverter::convertFromString($contact->deleted_at, 'admin_datepicker'); ?> に個人情報削除済み</blockquote>
    </div>
  </div>
<?php endif; ?>

<?php if ($contact->original_contact_id): ?>
  <?php $original_contact = \Model_Contact::find($contact->original_contact_id); ?>
  <div class="card card-outline-warning mb-3 text-center">
    <div class="card-block">
      <blockquote class="card-blockquote">
        <i class="fa fa-info-circle" aria-hidden="true"></i> 問い合わせID: <?= $original_contact->id; ?> (<?= __('admin.contact.status.'.\Config::get('views.contact.status.'.$original_contact->status)); ?>)の再入力CVです&nbsp;&nbsp;<a href="<?= \Uri::create('admin/contacts/:id/edit', ['id' => $original_contact->id]); ?>" class="btn btn-secondary btn-sm">詳細</a>
      </blockquote>
    </div>
  </div>
<?php endif; ?>

<table class="table table-sm table-hover mt-4 th-left small-row">
  <tr>
    <th>ID</th>
    <td><?= $contact->id; ?></td>
    <th>端末</th>
    <td><?= __('admin.contact.terminal_types.'.$contact->terminal); ?></td>
  </tr>
  <tr>
    <th>価格</th>
    <td>
      <?php if ($contact->from_kakaku): ?>
        <span class="badge badge-success">TRUE</span>
      <?php else: ?>
        <span class="badge badge-default">FALSE</span>
      <?php endif; ?>
    </td>
    <th>経由元</th>
    <td><?= $contact->tracking ? $contact->tracking->display_name : '無し'; ?></td>
  </tr>
  <tr>
    <th>集合住宅オーナー</th>
    <td>
      <?php if ($contact->apartment_owner): ?>
        <span class="badge badge-success">TRUE</span>
      <?php else: ?>
        <span class="badge badge-default">FALSE</span>
      <?php endif; ?>
    </td>
    <th>推定基本料金</th>
    <td><?= number_format($contact->basicPrice()).'円'; ?></td>
  </tr>
  <tr>
    <th>自動見積もり</th>
    <td>
      <i class="fa <?= $contact->sent_auto_estimate_req ? 'fa-circle-o' : 'fa-times' ?>" aria-hidden="true"></i>
    </td>
    <th>推定単価</th>
    <td><?= number_format($contact->unitPrice()).'円'; ?></td>
  </tr>
  <tr>
    <th>提示画面閲覧済み</th>
    <td>
      <i class="fa <?= $contact->is_seen == \Config::get('models.contact.is_seen.seen') ? 'fa-circle-o' : 'fa-times' ?>" aria-hidden="true"></i>
    </td>
    <th>契約選択</th>
    <td><?= $contact->estimate_kind == \Config::get('models.contact.estimate_kind.new_contract') ? '新規開設' : '現在住居'; ?></td>
  </tr>
  <tr>
    <th>問い合わせステータス</th>
    <td>
      <div class="card card-outline-<?= \Config::get('views.contact.status.'.$contact->status); ?> text-center max-width">
        <div class="card-block p-0">
          <blockquote class="card-blockquote"><?= __('admin.contact.status.'.\Config::get('views.contact.status.'.$contact->status)) ?></blockquote>
        </div>
      </div>
    </td>
    <th>キャンセル理由</th>
    <td>
      <?= $contact->status_reason ? \Helper\CancelReasons::getNameByValue($contact->status_reason) : ''; ?>
    </td>
  </tr>
  <tr>
    <th>小ステータス</th>
    <td>
      <?php if ($contact->user_status != \Config::get('models.contact.user_status.no_action')): ?>
        <div class="card card-outline-<?= \Config::get('views.contact.status.'.$contact->status); ?> text-center max-width">
          <div class="card-block p-0">
            <blockquote class="card-blockquote"><?= __('admin.contact.user_status.'.\Config::get('views.contact.user_status.'.$contact->user_status)); ?></blockquote>
          </div>
        </div>
      <?php endif; ?>
    </td>
    <th>見積り進行状況</th>
    <td>
      <?php if ($progress = $contact->getEstimateProgress()): ?>
        <div class="card card-outline-<?= $progress == 'unknown' ? 'danger' : 'success'; ?> text-center max-width">
          <div class="card-block p-0">
            <blockquote class="card-blockquote"><?= __('admin.estimate.progress.'.$progress); ?></blockquote>
          </div>
        </div>
      <?php endif; ?>
    </td>
  </tr>
</table>

<?php if ($contact->reason_not_auto_sendable): ?>
  <div class="card">
    <div class="card-header"><i class="fa fa-info-circle" aria-hidden="true"></i> CV時に紹介前になった理由</div>
    <div class="card-block">
      <blockquote class="card-blockquote"><?= $contact->reason_not_auto_sendable; ?></blockquote>
    </div>
  </div>
<?php endif; ?>

<?php if (!$contact->deleted_at): ?>
<hr>
<?= \Form::open(['action' => \Uri::create('admin/contacts/:id', ['id' => $contact->id])]); ?>
  <?= \Form::csrf(); ?>
  <?= render('admin/contacts/_form_edit', ['contact' => $contact, 'val' => $val]); ?>
<?= Form::close(); ?>
<?php endif; ?>

<hr>
<h2>対応履歴</h2>
<?php if (!$contact->deleted_at): ?>
<?= \Form::open(['action' => \Uri::create('admin/history')]); ?>
  <?= \Form::csrf(); ?>
  <input type="hidden" name="contact_id" value="<?= $contact->id; ?>">
  <div class="form-group row">
    <div class="col-2">
      <div class="form-group<?= $val_c->error('calling_method') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="calling_method"><h6>連絡手段</h6></label>
        <?= Form::select('calling_method', $val_c->input('calling_method', 0), __('admin.calling_history.calling_method'), ['class' => 'form-control', 'id' => 'calling_method']); ?>
      </div>
    </div>
    <div class="col-3">
      <div class="form-group<?= $val_c->error('note') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="note"><h6><i class="fa fa-asterisk" aria-hidden="true"></i> 備考(理由など)</h6></label>
        <input type="text" required="required" name="note" class="form-control" id="note" value="">
      </div>
    </div>
    <div class="col-3">
      <div class="form-group">
        <label class="form-control-label"><h6>&nbsp;</h6></label>
        <p class="form-control-static p-0"><button type="submit" class="btn btn-primary">架電履歴に追加する</button></p>
      </div>
    </div>
  </div>
<?= Form::close(); ?>
<?php endif; ?>

<table class="table table-sm table-hover small-row">
  <thead>
    <tr>
      <th>日時</th>
      <th>架電した人</th>
      <th>連絡方法</th>
      <th>備考</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($contact->calling_histories as $history): ?>
      <tr>
        <td><?= Helper\TimezoneConverter::convertFromString($history->created_at, 'admin_table'); ?></td>
        <td><?= $history->admin_user->email; ?></td>
        <td><?= __('admin.calling_history.calling_method.'.\Config::get('views.calling_history.calling_method.'.$history->calling_method)); ?></td>
        <td><?= $history->note; ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<div class="btn-group mb-4" role="group" aria-label="Company">
  <?php if (!$contact->deleted_at): ?>
    <a class="btn btn-secondary" href="<?= \Uri::create('admin/contacts/:id/estimates/create', ['id' => $contact->id]); ?>" role="button"><i class="fa fa-paper-plane"></i> ガス会社に見積もり依頼を送る</a>
  <?php endif; ?>
  <a class="btn btn-secondary" href="<?= \Uri::create('admin/contacts/:id/estimates', ['id' => $contact->id]); ?>" role="button"><i class="fa fa-handshake-o"></i> 見積もり依頼一覧</a>
  <a target="_blank" class="btn btn-secondary" href="<?= \Uri::create('lpgas/contacts/:id?'.http_build_query(['token' => $contact->token, 'pin' => $contact->pin]), ['id' => $contact->id]); ?>" role="button"><i class="fa fa-external-link"></i> 提示画面を見る</a>
</div>

<div>
  <?php if (!$contact->deleted_at): ?>
    <a href="#" class="btn-delete btn btn-danger" role="button" data-contact-id="<?= $contact->id; ?>"><i class="fa fa-trash"></i> 個人情報削除</a>
  <?php endif; ?>
  <?php if (!$contact->isCancelled()): ?>
    <a href="#" class="btn-cancel btn btn-danger" role="button" data-contact-id="<?= $contact->id; ?>" data-contact-name="<?= $contact->name; ?>" data-contact-pref="<?= JpPrefecture::findByCode($contact->getPrefectureCode())->nameKanji; ?>" data-contact-tel="<?= $contact->tel; ?>"><i class="fa fa-fire" aria-hidden="true"></i> キャンセル</a>
  <?php endif; ?>
</div>

<!-- MODAL DELETE START -->
<?= render('admin/_modal_delete'); ?>
<!-- MODAL DELETE END -->

<!-- MODAL CANCEL START -->
<?= render('admin/_modal_cancel'); ?>
<!-- MODAL CANCEL END -->
