<?php
use JpPrefecture\JpPrefecture;
?>

<?= \Form::open(['method' => 'GET', 'class' => 'mb-4']); ?>
  <div class="form-group row mb-0">
    <div class="col-2">
      <div class="form-group<?= $val->error('contact_name_equal') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="contact_name_equal"><h6>名前が等しい</h6></label>
        <input type="text" name="contact_name_equal" value="<?= $val->input('contact_name_equal', '') ?>" class="form-control" id="contact_name_equal">
      </div>
    </div>
    <div class="col-2">
      <div class="form-group<?= $val->error('contact_name_like') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="contact_name_like"><h6>名前を含む</h6></label>
        <input type="text" name="contact_name_like" value="<?= $val->input('contact_name_like', '') ?>" class="form-control" id="contact_name_like">
      </div>
    </div>
    <div class="col-2">
      <div class="form-group<?= $val->error('contact_tel_equal') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="contact_tel_equal"><h6>電話番号が等しい</h6></label>
        <input type="text" name="contact_tel_equal" value="<?= $val->input('contact_tel_equal', '') ?>" class="form-control" id="contact_tel_equal">
      </div>
    </div>
    <div class="col-3">
      <div class="form-group<?= $val->error('contact_email_equal') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="contact_email_equal"><h6>メールアドレスが等しい</h6></label>
        <input type="text" name="contact_email_equal" value="<?= $val->input('contact_email_equal', '') ?>" class="form-control" id="contact_email_equal">
      </div>
    </div>
  </div>

  <div class="form-group row mb-0">
    <div class="col-2">
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

  <div class="form-group row mb-0">
    <div class="col-2 pr-0">
      <div class="form-group<?= $val->error('created_from') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="created_from"><h6>紹介日</h6></label>
        <input type="text" name="created_from" value="<?= $val->input('created_from', '') ?>" class="form-control datepicker" id="created_from">
      </div>
    </div>
    <div class="px-1 text-center">
      <div class="form-group">
        <label class="form-control-label"><h6>　</h6></label>
        <p class="form-control-static">~</p>
      </div>
    </div>
    <div class="col-2 pl-0">
      <div class="form-group<?= $val->error('created_to') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="created_to"><h6>　</h6></label>
        <input type="text" name="created_to" value="<?= $val->input('created_to', '') ?>" class="form-control datepicker" id="created_to">
      </div>
    </div>
    <div class="col-2">
      <div class="form-group<?= $val->error('preferred_time') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="preferred_time"><h6>希望連絡時間</h6></label>
        <?= Form::select('preferred_time', $val->input('preferred_time', ''), ['' => 'none'] + __('admin.contact.preferred_contact_time_between'), ['class' => 'form-control', 'id' => 'preferred_time']); ?>
      </div>
    </div>
  </div>

  <button type="submit" class="btn btn-secondary">検索</button>
<?= Form::close(); ?>

<!-- FIX ME -->
<div class="btn-group mb-4" role="group" aria-label="CSV">
  <button type="button" class="btn btn-secondary" disabled="disabled">検索結果: 219件</button>
  <button type="button" class="btn btn-secondary" disabled="disabled">現在の検索条件でCSVをダウンロード</button>
  <button type="button" class="btn btn-secondary" disabled="disabled">変更履歴をCSVでダウンロード</button>
</div>

<table class="table table-sm table-hover small-row">
  <thead>
    <tr>
      <th>
        <div><i class="fa fa-hashtag" aria-hidden="true"></i> ID</div>
        <div>経由元</div>
        <div>価格</div>
      </th>
      <th>
        <div><i class="fa fa-user-circle-o" aria-hidden="true"></i> お名前</div>
        <div><i class="fa fa-phone" aria-hidden="true"></i> 電話番号</div>
        <div><i class="fa fa-clock-o" aria-hidden="true"></i> 問い合わせ日時</div>
      </th>
      <th>
        <div><i class="fa fa-home" aria-hidden="true"></i> 種別</div>
        <div><i class="fa fa-globe" aria-hidden="true"></i> 都道府県</div>
        <div><i class="fa fa-globe" aria-hidden="true"></i> 開設先都道府県</div>
      </th>
      <th>
        <div>自動見積もり</div>
        <div>提示画面閲覧済み</div>
        <div><i class="fa fa-tachometer" aria-hidden="true"></i> 見積もり数</div>
      </th>
      <th>問い合わせ<br>ステータス</th>
      <th>見積もり<br>進行状況</th>
      <th>管理者メモ</th>
      <th>対応履歴</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($contacts as $contact): ?>
      <tr>
        <td>
          <div><i class="fa fa-hashtag" aria-hidden="true"></i> <?= $contact->id; ?></div>
          <div><?= $contact->tracking ? $contact->tracking->display_name : '無し'; ?></div>
          <div>
            <?php if ($contact->from_kakaku): ?>
              <span class="badge badge-success">TRUE</span>
            <?php else: ?>
              <span class="badge badge-default">FALSE</span>
            <?php endif; ?>
          </div>
        </td>
        <td>
          <div><i class="fa fa-user-circle-o" aria-hidden="true"></i> <?= $contact->name; ?></div>
          <div class="text-primary"><i class="fa fa-phone" aria-hidden="true"></i> <?= $contact->tel; ?></div>
          <div><i class="fa fa-clock-o" aria-hidden="true"></i> <?= \Helper\TimezoneConverter::convertFromString($contact->created_at, 'admin_table'); ?></div>
        </td>
        <td>
          <div class="text-success"><i class="fa fa-home" aria-hidden="true"></i>
            <?php if ($contact->estimate_kind == \Config::get('models.contact.estimate_kind.new_contract')): ?>
              新規開設
            <?php else: ?>
              現在住居
            <?php endif; ?>
          </div>
          <div><i class="fa fa-globe" aria-hidden="true"></i> <?= $contact->prefecture_code ? JpPrefecture::findByCode($contact->prefecture_code)->nameKanji : '-'; ?></div>
          <div><i class="fa fa-globe" aria-hidden="true"></i> <?= $contact->new_prefecture_code ? JpPrefecture::findByCode($contact->new_prefecture_code)->nameKanji : '-'; ?></div>
        </td>
        <td>
          <div class="d-flex justify-content-around align-items-center">
            <div><i class="fa <?= $contact->sent_auto_estimate_req ? 'fa-circle-o' : 'fa-times' ?>" aria-hidden="true"></i></div>
            <div><i class="fa <?= $contact->sent_auto_estimate_req ? 'fa-circle-o' : 'fa-times' ?>" aria-hidden="true"></i></div>
            <div><i class="fa fa-tachometer" aria-hidden="true"></i> <?= count($contact->estimates); ?></div>
          </div>
          <div>&nbsp;</div>
          <div>集合住宅
            <?php if ($contact->apartment_owner): ?>
              <span class="badge badge-success">TRUE</span>
            <?php else: ?>
              <span class="badge badge-default">FALSE</span>
            <?php endif; ?>
          </div>
        </td>
        <td class="align-middle">
          <div class="card card-outline-<?= \Config::get('views.contact.status.'.$contact->status); ?> text-center">
            <div class="card-block p-0">
              <blockquote class="card-blockquote">
                <?= __('admin.contact.status.'.\Config::get('views.contact.status.'.$contact->status)) ?>
                <?php if ($contact->user_status != \Config::get('models.contact.user_status.no_action')): ?>
                  <br>(<?= __('admin.contact.user_status.'.\Config::get('views.contact.user_status.'.$contact->user_status)); ?>)
                <?php endif; ?>
              </blockquote>
            </div>
          </div>
        </td>
        <td class="align-middle">
          <?php if ($progress = $contact->getEstimateProgress()): ?>
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
          <?php if ($contact->admin_memo): ?>
            <div class="note-box" data-container="body" data-toggle="popover" data-placement="top" data-content="<?= $contact->admin_memo; ?>">
              <?= \Str::truncate($contact->admin_memo, 25); ?>
            </div>
          <?php endif; ?>
        </td>
        <td class="align-middle">
          <?php if ($histories = $contact->getCallingHistories()): ?>
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
          <div><a href="<?= \Uri::create('admin/contacts/:id/edit', ['id' => $contact->id]); ?>" class="btn btn-secondary btn-sm px-1 py-0 w-100" role="button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 編集</a></div>
          <div><a target="_blank" href="<?= \Uri::create('lpgas/contacts/:id?'.http_build_query(['pin' => $contact->pin, 'token' => $contact->token]), ['id' => $contact->id]); ?>" class="btn btn-secondary btn-sm px-1 py-0 w-100" role="button"><i class="fa fa-external-link" aria-hidden="true"></i> 提示画面</a></div>
          <div><a href="#" class="btn-cancel btn btn-danger btn-sm px-1 py-0 w-100" role="button" data-contact-id="<?= $contact->id; ?>" data-contact-name="<?= $contact->name; ?>" data-contact-pref="<?= JpPrefecture::findByCode($contact->getPrefectureCode())->nameKanji; ?>" data-contact-tel="<?= $contact->tel; ?>"><!-- <i class="fa fa-times-circle-o" aria-hidden="true"></i>  -->キャンセル</a></div>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?= \Pagination::instance('contacts')->render(); ?>
