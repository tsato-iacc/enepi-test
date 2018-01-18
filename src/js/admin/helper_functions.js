function cancelEstimateOrContact(type) {
  $('.btn-cancel').each(function() {
    $(this).on('click', function() {
      
      var id = $(this).attr('data-' + type + '-id');
      var name = $(this).attr('data-contact-name');
      var pref = $(this).attr('data-contact-pref');
      var tel = $(this).attr('data-contact-tel');
      var modal = $('#contactCancel');

      modal.find('form').attr('action', '/admin/' + type + 's/' + id + '/cancel');
      modal.find('span.contact-name').text(name);
      modal.find('span.contact-pref').text(pref);
      modal.find('span.contact-tel').text(tel);
      modal.modal('show');

      return false;
    });
  });

  $('#contactCancel select[name=reason_groups]').change(function() {
    var group = $(this).val();
    var reasons = $('#contactCancel select[name=status_reason]');
    reasons.prop('disabled', true);

    if (!group) {
        reasons.empty();
        reasons.append($('<option>').html("変更理由のカテゴリを選択してください").val(""));
        return;
    }

    $.get("/admin/api/contact_cancel_reasons", {
        group: group
    }).done(function (data, status, xhr) {
        if (data.result) {
            reasons.empty();
            reasons.append($('<option>').html("").val(""));

            $.each(data.result, function(v, k) {
                reasons.append($('<option>').html(k).val(v));
            });
            reasons.prop('disabled', false);
        }
    }).fail(function (xhr, status, error) {
        console.log(error);
    });
  });
}

function introduceEstimate() {
  $('.btn-introduce').each(function() {
    $(this).on('click', function() {
      
      var id = $(this).attr('data-estimate-id');
      var company = $(this).attr('data-company-name');
      var name = $(this).attr('data-contact-name');
      var pref = $(this).attr('data-contact-pref');
      var tel = $(this).attr('data-contact-tel');
      var modal = $('#estimateIntroduce');

      modal.find('form').attr('action', '/admin/estimates/' + id + '/introduce');
      modal.find('span.company-name').text(company);
      modal.find('span.contact-name').text(name);
      modal.find('span.contact-pref').text(pref);
      modal.find('span.contact-tel').text(tel);
      modal.modal('show');

      return false;
    });
  });
}
