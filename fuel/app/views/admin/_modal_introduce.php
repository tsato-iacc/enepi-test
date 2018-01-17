<div class="modal fade" id="estimateIntroduce" tabindex="-1" role="dialog" aria-labelledby="estimateIntroduceLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <?= \Form::open(['action' => '']); ?>
        <?= \Form::csrf(); ?>
        <div class="modal-header">
          <h4 class="modal-title" id="callLogLabel"><i class="fa fa-question-circle-o" aria-hidden="true"></i> 本当に送客にしますか?</h4>
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
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">やめる</button>
          <button class="btn btn-success">送客する</button>
        </div>
      <?= Form::close(); ?>
    </div>
  </div>
</div>
