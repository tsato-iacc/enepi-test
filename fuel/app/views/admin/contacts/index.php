<?php
use JpPrefecture\JpPrefecture;
?>

<!-- SEARCH FORM START -->
<?= \Form::open(['method' => 'GET', 'class' => 'mb-4']); ?>
  <div class="form-group row mb-0">
    <div class="col-2">
      <div class="form-group<?= $val->error('name_equal') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="name_equal"><h6>名前が等しい</h6></label>
        <input type="text" name="name_equal" value="<?= $val->input('name_equal', '') ?>" class="form-control" id="name_equal">
      </div>
    </div>
    <div class="col-2">
      <div class="form-group<?= $val->error('name_like') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="name_like"><h6>名前を含む</h6></label>
        <input type="text" name="name_like" value="<?= $val->input('name_like', '') ?>" class="form-control" id="name_like">
      </div>
    </div>
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
      <div class="form-group<?= $val->error('house_kind') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="house_kind"><h6>物件種別</h6></label>
        <?= Form::select('house_kind', $val->input('house_kind', ''), ['' => 'none'] + __('admin.contact.house_kind'), ['class' => 'form-control', 'id' => 'house_kind']); ?>
      </div>
    </div>
  </div>

  <div class="form-group row mb-0">
    <div class="col-2">
      <div class="form-group<?= $val->error('pref_code') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="pref_code"><h6>都道府県</h6></label>
        <?= Form::select('pref_code', $val->input('pref_code', ''), ['' => 'none'] + JpPrefecture::allKanjiAndCode(), ['class' => 'form-control', 'id' => 'pref_code']); ?>
      </div>
    </div>
    <div class="col-2">
      <div class="form-group<?= $val->error('new_pref_code') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="new_pref_code"><h6>都道府県(開設先)</h6></label>
        <?= Form::select('new_pref_code', $val->input('new_pref_code', ''), ['' => 'none'] + JpPrefecture::allKanjiAndCode(), ['class' => 'form-control', 'id' => 'new_pref_code']); ?>
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

  <div class="form-group row mb-0">
    <div class="col-2">
      <div class="form-group<?= $val->error('ownership_kind') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="ownership_kind"><h6>所有種別</h6></label>
        <?= Form::select('ownership_kind', $val->input('ownership_kind', ''), ['' => 'none'] + __('admin.contact.ownership_kind'), ['class' => 'form-control', 'id' => 'ownership_kind']); ?>
      </div>
    </div>
    <div class="col-2 pr-0">
      <div class="form-group<?= $val->error('introduced_from') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="introduced_from"><h6>紹介日</h6></label>
        <input type="text" name="introduced_from" value="<?= $val->input('introduced_from', '') ?>" class="form-control datepicker" id="introduced_from">
      </div>
    </div>
    <div class="px-1 text-center">
      <div class="form-group">
        <label class="form-control-label"><h6>&nbsp;</h6></label>
        <p class="form-control-static">~</p>
      </div>
    </div>
    <div class="col-2 pl-0">
      <div class="form-group<?= $val->error('introduced_to') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="introduced_to"><h6>&nbsp;</h6></label>
        <input type="text" name="introduced_to" value="<?= $val->input('introduced_to', '') ?>" class="form-control datepicker" id="introduced_to">
      </div>
    </div>

    <div class="col-2 pr-0">
      <div class="form-group<?= $val->error('created_from') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="created_from"><h6>問い合わせ日</h6></label>
        <input type="text" name="created_from" value="<?= $val->input('created_from', '') ?>" class="form-control datepicker" id="created_from">
      </div>
    </div>
    <div class="px-1 text-center">
      <div class="form-group">
        <label class="form-control-label"><h6>&nbsp;</h6></label>
        <p class="form-control-static">~</p>
      </div>
    </div>
    <div class="col-2 pl-0">
      <div class="form-group<?= $val->error('created_to') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="created_to"><h6>&nbsp;</h6></label>
        <input type="text" name="created_to" value="<?= $val->input('created_to', '') ?>" class="form-control datepicker" id="created_to">
      </div>
    </div>
  </div>

  <button type="submit" class="btn btn-secondary">検索</button>
<?= Form::close(); ?>
<!-- SEARCH FORM END -->

<!-- FIX ME -->
<?php if ($auth_user->isAdmin()): ?>
<div class="btn-group mb-4" role="group" aria-label="CSV">
  <button type="button" class="btn btn-secondary">検索結果: <?= $total_items; ?>件</button>
  <a class="btn btn-secondary<?= $total_items > 1000 ? ' disabled' : ''; ?>"<?= $total_items > 1000 ? ' aria-disabled="true"' : ''; ?> href="<?= \Uri::create('admin/csv/contacts.csv').'?'.$_SERVER["QUERY_STRING"]; ?>" role="button">現在の検索条件でCSVをダウンロード</a>
  <a class="btn btn-secondary" href="<?= \Uri::create('admin/csv/calling_histories.csv').'?'.$_SERVER["QUERY_STRING"]; ?>" role="button">変更履歴をCSVでダウンロード</a>
</div>
<?php else: ?>
<h4>検索結果: <?= $total_items; ?>件</h4>
<?php endif; ?>

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
      <tr<?= $contact->deleted_at ? ' class="table-danger"' : ''; ?>>
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
            <div><i class="fa <?= $contact->sent_auto_estimate_req ? 'fa-circle-o text-success' : 'fa-times' ?>" aria-hidden="true"></i></div>
            <div><i class="fa <?= $contact->is_seen == \Config::get('models.contact.is_seen.seen') ? 'fa-circle-o text-success' : 'fa-times' ?>" aria-hidden="true"></i></div>
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
          <?php $status_reason = $contact->status_reason ? \Helper\CancelReasons::getNameByValue($contact->status_reason) : ''; ?>
          <?php if ($status_reason): ?>
            <div class="card card-outline-cancelled text-center mt-2" data-toggle="tooltip" data-placement="top" title="<?= $status_reason; ?>">
              <div class="card-block p-0">
                <blockquote class="card-blockquote">理由 <i class="fa fa-commenting" aria-hidden="true"></i></blockquote>
              </div>
            </div>
          <?php endif; ?>
        </td>
        <td class="align-middle">
          <?php if ($progress = $contact->getEstimateProgress()): ?>
            <div class="card card-outline-<?= $progress == 'unknown' ? 'danger' : 'success'; ?> text-center">
              <div class="card-block p-0">
                <blockquote class="card-blockquote">
                  <?= __('admin.estimate.progress.'.$progress); ?>
                </blockquote>
              </div>
            </div>
          <?php endif; ?>
        </td>
        <td class="align-middle">
          <?php if ($contact->admin_memo): ?>
            <div class="note-box" data-container="body" data-toggle="popover" data-placement="top" data-content="<?= $contact->admin_memo; ?>">
              <?= \Str::truncate($contact->admin_memo, 70); ?>
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
        <td class="align-middle p-0">
          <div><a href="<?= \Uri::create('admin/contacts/:id/edit', ['id' => $contact->id]); ?>" class="btn btn-secondary btn-sm px-1 py-0 w-100" role="button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 編集</a></div>
          <div><a target="_blank" href="<?= \Uri::create('lpgas/contacts/:id?'.http_build_query(['pin' => $contact->pin, 'token' => $contact->token]), ['id' => $contact->id]); ?>" class="btn btn-secondary btn-sm px-1 py-0 w-100" role="button"><i class="fa fa-external-link" aria-hidden="true"></i> 提示画面</a></div>
          <?php if (!$contact->isCancelled() && !$contact->isContracted()): ?>
            <div><a href="#" class="btn-cancel btn btn-danger btn-sm px-1 py-0 w-100" role="button" data-contact-id="<?= $contact->id; ?>" data-contact-name="<?= $contact->name; ?>" data-contact-pref="<?= JpPrefecture::findByCode($contact->getPrefectureCode())->nameKanji; ?>" data-contact-tel="<?= $contact->tel; ?>"><i class="fa fa-fire" aria-hidden="true"></i> キャンセル</a></div>
          <?php endif; ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<!-- MODAL CANCEL START -->
<?= render('admin/_modal_cancel'); ?>
<!-- MODAL CANCEL END -->

<?= \Pagination::instance('contacts')->render(); ?>
