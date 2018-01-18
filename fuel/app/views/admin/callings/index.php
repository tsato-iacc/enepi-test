<?php
use JpPrefecture\JpPrefecture;
?>

<?= \Form::open(['method' => 'GET']); ?>
  <div class="form-group row mb-0">
    <div class="col-3">
      <div class="form-group<?= $val->error('name_equal') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="name_equal"><h6>名前が等しい</h6></label>
        <input type="text" name="name_equal" value="<?= $val->input('name_equal', '') ?>" class="form-control" id="name_equal">
      </div>
    </div>
    <div class="col-3">
      <div class="form-group<?= $val->error('name_like') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="name_like"><h6>名前を含む</h6></label>
        <input type="text" name="name_like" value="<?= $val->input('name_like', '') ?>" class="form-control" id="name_like">
      </div>
    </div>
  </div>
  <div class="form-group row mb-0">
    <div class="col-2">
      <div class="form-group<?= $val->error('tel_equal') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="tel_equal"><h6>電話番号が等しい</h6></label>
        <input type="text" name="tel_equal" value="<?= $val->input('tel_equal', '') ?>" class="form-control" id="tel_equal">
      </div>
    </div>
    <div class="col-3">
      <div class="form-group<?= $val->error('email_equal') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="email_equal"><h6>メールアドレスが等しい</h6></label>
        <input type="text" name="email_equal" value="<?= $val->input('email_equal', '') ?>" class="form-control" id="email_equal">
      </div>
    </div>
    <div class="col-3">
      <div class="form-group<?= $val->error('status') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="status"><h6>ステータスが等しい</h6></label>
        <?= Form::select('status', $val->input('status', ''), ['' => 'none'] + __('admin.contact.status'), ['class' => 'form-control', 'id' => 'status']); ?>
      </div>
    </div>
    <div class="col-2">
      <div class="form-group<?= $val->error('user_status') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="user_status"><h6>小ステータス</h6></label>
        <?= Form::select('user_status', $val->input('user_status', ''), ['' => 'none'] + __('admin.contact.user_status'), ['class' => 'form-control', 'id' => 'user_status']); ?>
      </div>
    </div>
    <div class="col-2">
      <div class="form-group<?= $val->error('estimate_progress') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="estimate_progress"><h6>見積り進行状況</h6></label>
        <?= Form::select('estimate_progress', $val->input('estimate_progress', ''), ['' => 'none'] + __('admin.estimate.progress'), ['class' => 'form-control', 'id' => 'estimate_progress']); ?>
      </div>
    </div>
  </div>
  
  <div class="form-check mb-3">
    <label class="form-check-label">
      <input class="form-check-input" type="checkbox" name="include_archive" value="1"<?= $val->input('include_archive') ? ' checked="checked"' : '' ?>>
      アーカイブされているものも含む
    </label>
  </div>

  <button type="submit" class="btn btn-secondary">検索</button>
<?= Form::close(); ?>

<div class="card card-outline-success mb-3 mt-3 text-center">
  <div class="card-block">
    <blockquote class="card-blockquote">追加日時、問い合わせ日時でソート可能です。</blockquote>
  </div>
</div>

<table class="table table-sm table-hover small-row">
  <thead>
    <tr>
      <th>
        <div><i class="fa fa-hashtag" aria-hidden="true"></i> 問い合わせID</div>
        <div><i class="fa fa-phone" aria-hidden="true"></i> 追加日時</div>
        <div><i class="fa fa-clock-o" aria-hidden="true"></i> 問い合わせ日時</div>
      </th>
      <th>
        <div><i class="fa fa-user-circle-o" aria-hidden="true"></i> お名前</div>
        <div><i class="fa fa-phone" aria-hidden="true"></i> 電話番号</div>
        <div><i class="fa fa-globe" aria-hidden="true"></i> 都道府県</div>
      </th>
      <th>
        <div><i class="fa fa-reply" aria-hidden="true"></i> 自動見積もり</div>
        <div><i class="fa fa-eye" aria-hidden="true"></i> 提示画面閲覧済み</div>
        <div><i class="fa fa-tachometer" aria-hidden="true"></i> 見積もり数</div>
      </th>
      <th>問い合わせステータス</th>
      <th>見積もり進行状況</th>
      <th>管理者メモ</th>
      <th>対応履歴</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($callings as $call): ?>
      <tr>
        <td>
          <div><i class="fa fa-hashtag" aria-hidden="true"></i> <?= $call->contact->id; ?></div>
          <div><i class="fa fa-phone" aria-hidden="true"></i> <?= \Helper\TimezoneConverter::convertFromString($call->created_at, 'admin_table'); ?></div>
          <div><i class="fa fa-clock-o" aria-hidden="true"></i> <?= \Helper\TimezoneConverter::convertFromString($call->contact->created_at, 'admin_table'); ?></div>
        </td>
        <td>
          <div><i class="fa fa-user-circle-o" aria-hidden="true"></i> <?= $call->contact->name; ?></div>
          <div><i class="fa fa-phone" aria-hidden="true"></i> <?= $call->contact->tel; ?></div>
          <div><i class="fa fa-globe" aria-hidden="true"></i> <?= JpPrefecture::findByCode($call->contact->getPrefectureCode())->nameKanji; ?></div>
        </td>
        <td>
          <div class="d-flex justify-content-around align-items-center">
            <div><i class="fa fa-reply" aria-hidden="true"></i> <i class="fa <?= $call->contact->sent_auto_estimate_req ? 'fa-circle-o' : 'fa-times' ?>" aria-hidden="true"></i></div>
            <div><i class="fa fa-eye" aria-hidden="true"></i> <i class="fa <?= $call->contact->sent_auto_estimate_req ? 'fa-circle-o' : 'fa-times' ?>" aria-hidden="true"></i></div>
            <div><i class="fa fa-tachometer" aria-hidden="true"></i> <?= count($call->contact->estimates); ?></div>
          </div>
        </td>
        <td class="align-middle">
          <div class="card card-outline-<?= $call->contact->getStatusColor(); ?> text-center">
            <div class="card-block p-0">
              <blockquote class="card-blockquote">
                <?= __('admin.contact.status.'.\Config::get('views.contact.status.'.$call->contact->status)) ?>
                <?php if ($call->contact->user_status != \Config::get('models.contact.user_status.no_action')): ?>
                  <br>(<?= __('admin.contact.user_status.'.\Config::get('views.contact.user_status.'.$call->contact->user_status)); ?>)
                <?php endif; ?>
              </blockquote>
            </div>
          </div>
        </td>
        <td class="align-middle">
          <?php if ($progress = $call->contact->getEstimateProgress()): ?>
            <div class="card card-outline-<?= $progress == 'unknown' ? 'danger' : 'success'; ?> text-center">
              <div class="card-block p-0">
                <blockquote class="card-blockquote">
                  <?= __('admin.estimate.progress.'.$progress) ?>
                </blockquote>
              </div>
            </div>
          <?php endif; ?>
        </td>
        <td class="align-middle">
          <?php if ($call->contact->admin_memo): ?>
            <div class="note-box" data-container="body" data-toggle="popover" data-placement="top" data-content="<?= $call->contact->admin_memo; ?>">
              <?= \Str::truncate($call->contact->admin_memo, 25); ?>
            </div>
          <?php endif; ?>
        </td>
        <td class="align-middle">
          <?php if ($histories = $call->contact->getCallingHistories()): ?>
            <?php $output = []; ?>
            <?php foreach ($histories as $h): ?>
              <?php $output[] = $h->oneLineString(); ?>
            <?php endforeach; ?>
            <div class="note-box" data-container="body" data-toggle="popover" data-placement="top" data-content="<?= implode("\n", $output); ?>">
              <?= implode('<br>', $output); ?>
            </div>
          <?php endif; ?>
        </td>
        <td class="p-0">
          <div><a href="<?= \Uri::create('admin/contacts/:id/edit', ['id' => $call->contact->id]); ?>" class="btn btn-link btn-sm px-1 py-0" role="button">編集</a></div>
          <div><a href="#" class="btn-cancel btn btn-danger btn-sm px-1 py-0" role="button" data-contact-id="<?= $call->contact->id; ?>" data-contact-name="<?= $call->contact->name; ?>" data-contact-pref="<?= JpPrefecture::findByCode($call->contact->getPrefectureCode())->nameKanji; ?>" data-contact-tel="<?= $call->contact->tel; ?>"><!-- <i class="fa fa-times-circle-o" aria-hidden="true"></i>  -->キャンセル</a></div>
          <?php if (!$call->archived): ?>
            <div><a href="<?= \Uri::create('admin/callings/:id/archive', ['id' => $call->id]); ?>" class="btn btn-warning btn-sm px-1 py-0" role="button"><!-- <i class="fa fa-archive" aria-hidden="true"></i>  -->アーカイブ</a></div>
          <?php endif; ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<!-- MODAL CANCEL START -->
<?= render('admin/_modal_cancel'); ?>
<!-- MODAL CANCEL END -->

<?= \Pagination::instance('callings')->render(); ?>
