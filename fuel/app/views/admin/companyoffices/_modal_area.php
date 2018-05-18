<div class="modal fade" id="area" tabindex="-1" role="dialog" aria-labelledby="areaModalLabel" aria-hidden="true" data-prefecture-code="" data-office-id="<?= $office_id; ?>" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="areaModalLabel">カスタマーメール</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="progress mb-3">
          <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
        </div>
        <div id="area_row" class="row"></div>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-secondary send-btn" id="all_area_select">全選択</button>
        <button type="button" class="btn btn-success send-btn ladda-button" data-style="zoom-in" id="area_save_btn"><i class="fa fa-sitemap" aria-hidden="true"></i> 追加する</button>
      </div>
    </div>
  </div>
</div>
