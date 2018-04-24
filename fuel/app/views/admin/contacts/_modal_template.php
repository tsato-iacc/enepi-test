<div class="modal fade" id="mail_template" tabindex="-1" role="dialog" aria-labelledby="mailTemplateModalLabel" aria-hidden="true" data-contact-id="<?= $contact->id; ?>" data-contact-email="<?= $contact->email; ?>">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="mailTemplateModalLabel">カスタマーメール</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body template-modal">
        <div class="template-wrap">
          <div class="form-group">
            <label for="recipient-name" class="form-control-label">テンプレート:</label>
            <?= Form::select('template_name', '', ['' => '選択してください'] + \Model_Customer_Template::getSelectOptions(), ['class' => 'form-control', 'id' => 'template_name']); ?>
          </div>
          <div class="form-group">
            <label for="template_subject" class="form-control-label">件名:</label>
            <input type="text" class="form-control" id="template_subject">
          </div>
          <div class="form-group mb-0">
            <label for="template_body" class="form-control-label">内容:</label>
            <textarea class="form-control" id="template_body" rows="12" style="resize: none;"></textarea>
          </div>
          <div class="button-area text-center mt-3">
            <button type="button" class="btn btn-primary preview-btn ladda-button" data-style="zoom-in"><i class="fa fa-television" aria-hidden="true"></i> プレビュー</button>
          </div>
        </div>
        <div class="preview-wrap smooth-hide">
          <div class="template-body-wrap">
            <p class="mb-1"><b>宛先:</b> <span class="template-email"></span></p>
            <p class="mb-1"><b>件名:</b> <span class="template-subject"></span></p>
            <p class="mb-1"><b>内容:</b></p>
            <div class="template-body"></div>
          </div>
          <div class="button-area text-center mt-3">
            <button type="button" class="btn btn-secondary back-btn"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 修正</button>
            <button type="button" class="btn btn-success send-btn ladda-button" data-style="zoom-in"><i class="fa fa-bomb" aria-hidden="true"></i> 送信</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
