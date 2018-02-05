<div class="modal fade" id="contactDelete" tabindex="-1" role="dialog" aria-labelledby="contactDeleteLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <?= \Form::open(['action' => '']); ?>
        <?= \Form::csrf(); ?>
        <div class="modal-header">
          <h4 class="modal-title"><i class="fa fa-question-circle-o" aria-hidden="true"></i> 本当に個人情報削除しますか?</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="card card-inverse card-danger mb-3 text-center">
            <div class="card-block">
              <blockquote class="card-blockquote">
                <p>この操作は取り消しができません。</p>
                <footer>また、見積り依頼は全てキャンセルされます。</footer>
              </blockquote>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">やめる</button>
          <button class="btn btn-danger">削除</button>
        </div>
      <?= Form::close(); ?>
    </div>
  </div>
</div>
