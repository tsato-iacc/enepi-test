<div class="modal fade" id="estimatePresent" tabindex="-1" role="dialog" aria-labelledby="estimatePresentLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <?= \Form::open(['action' => '']); ?>
        <?= \Form::csrf(); ?>
        <div class="modal-header">
          <h4 class="modal-title"><i class="fa fa-question-circle-o" aria-hidden="true"></i> 本当に見積もりを送信しますか?</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="card mb-2">
            <ul class="list-group list-group-flush">
              <li class="list-group-item justify-content-between">見積もり作成会社:<span class="company-name"></span></li>
              <li class="list-group-item justify-content-between">氏名:<span class="contact-name"></span></li>
              <li class="list-group-item justify-content-between">都道府県:<span class="contact-pref"></span></li>
              <li class="list-group-item justify-content-between">電話番号:<span class="contact-tel"></span></li>
            </ul>
          </div>
          <p class="card-text"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> 料金を入力せずに送信する</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">やめる</button>
          <button class="btn btn-info">ユーザーに送信する</button>
        </div>
      <?= Form::close(); ?>
    </div>
  </div>
</div>
