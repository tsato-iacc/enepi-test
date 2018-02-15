<div class="modal fade" id="contactCancel" tabindex="-1" role="dialog" aria-labelledby="contactCancelLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <?= \Form::open(['action' => '']); ?>
        <?= \Form::csrf(); ?>
        <div class="modal-header">
          <h4 class="modal-title"><i class="fa fa-question-circle-o" aria-hidden="true"></i> 本当に問い合わせをキャンセルしますか？</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="card mb-2">
            <ul class="list-group list-group-flush">
              <li class="list-group-item justify-content-between">氏名:<span class="contact-name"></span></li>
              <li class="list-group-item justify-content-between">都道府県:<span class="contact-pref"></span></li>
              <li class="list-group-item justify-content-between">電話番号:<span class="contact-tel"></span></li>
            </ul>
          </div>
          <div class="form-group mb-1">
            <label for="cancel_groups"><i class="fa fa-asterisk" aria-hidden="true"></i> 変更理由のカテゴリ</label>
            <?php if (\Uri::segment(1) == 'admin'): ?>
              <?= Form::select('reason_groups', '', ['' => ''] + \Helper\CancelReasons::getAdminGroups(), ['class' => 'form-control', 'id' => 'cancel_groups', 'required' => 'required']); ?>
            <?php else: ?>
              <?= Form::select('reason_groups', '', ['' => ''] + \Helper\CancelReasons::getPartnerGroups(), ['class' => 'form-control', 'id' => 'cancel_groups', 'required' => 'required']); ?>
            <?php endif; ?>
          </div>
          <div class="form-group mb-0">
            <label for="status_reason"><i class="fa fa-asterisk" aria-hidden="true"></i> キャンセル理由</label>
            <?= Form::select('status_reason', '', ['' => '変更理由のカテゴリを選択してください'], ['class' => 'form-control', 'id' => 'status_reason', 'required' => 'required', 'disabled' => 'disabled']); ?>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">やめる</button>
          <button class="btn btn-danger">キャンセルする</button>
        </div>
      <?= Form::close(); ?>
    </div>
  </div>
</div>
