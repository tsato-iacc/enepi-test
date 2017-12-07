<table class="table table-condensed table-striped table-hover">
  <thead>
    <tr>
      <th></th>
      <th>問い合わせ/見積り</th>
      <th>関連する変更/日時</th>
    </tr>
  </thead>
  <tbody>
    <? format = -> k, v {
      case k
      when "status"
        I18n.t("enums.#{Lpgas::Estimate.to_s.underscore}.status.#{v}")
      when "status_reason"
        I18n.t("enums.#{Lpgas::Estimate.to_s.underscore}.status_reason.#{v}")
      else
        begin
          format_datetime DateTime.parse(v)
        rescue
          v
        end
      end
    } ?>
    <? @actions.each { |act| ?>
      <? act.estimate.force_privacy_unlocked_mode ?>
      <tr>
        <td><?= act.note ?></td>
        <td>
          <ul>
            <li><?= MyView::link_to("#{act.estimate.name}", admin_lpgas_contact_path(act.estimate.contact_id) ?></li>
            <li><?= MyView::link_to("#{act.estimate.company.name}", admin_lpgas_estimate_path(act.estimate_id) ?></li>
          </ul>
        </td>
        <td>
          <ul>
            <li>
              <? j = JSON.parse(act.estimate_change_log.diff_json) ?>
              <? j.each { |(k, v)| ?>
                <? next if [
                  'last_update_partner_company_id',
                  'last_update_admin_user_id',
                  'status_updated_at',
                  'updated_at'
                ].include? k ?>
                <? _old = format.call k, v['old'] ?>
                <? _new = format.call k, v['new'] ?>
                <?= Lpgas::Estimate.human_attribute_name k ?>(<?= _old ?> <i class="fa fa-arrow-right alert-text"></i> <?= _new ?>)<br>
              <? } ?>
            </li>
            <li>
              <b><?= time_ago_in_words act.at ?>前</b>
            </li>
          </ul>
        </td>
        <td>
          <?= MyView::link_to(admin_lpgas_after_sending_action_archive_path(act), ["method" => 'post', ["class" => 'btn btn-xs btn-warning' { ?>
            <i class="fa fa-archive" aria-hidden="true"></i>
            アーカイブ
          <? } ?>
        </td>
      </tr>
    <? } ?>
  </tbody>
</table>

<?= paginate @actions ?>
