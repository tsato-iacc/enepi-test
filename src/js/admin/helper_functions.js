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

function presentEstimate() {
  $('.btn-present').each(function() {
    $(this).on('click', function() {
      
      var id = $(this).attr('data-estimate-id');
      var company = $(this).attr('data-company-name');
      var name = $(this).attr('data-contact-name');
      var pref = $(this).attr('data-contact-pref');
      var tel = $(this).attr('data-contact-tel');
      var modal = $('#estimatePresent');

      modal.find('form').attr('action', '/admin/estimates/' + id + '/present');
      modal.find('span.company-name').text(company);
      modal.find('span.contact-name').text(name);
      modal.find('span.contact-pref').text(pref);
      modal.find('span.contact-tel').text(tel);
      modal.modal('show');

      return false;
    });
  });
}

function deleteContact() {
  $('.btn-delete').each(function() {
    $(this).on('click', function() {

      var id = $(this).attr('data-contact-id');
      var modal = $('#contactDelete');

      modal.find('form').attr('action', '/admin/contacts/' + id + '/delete');
      modal.modal('show');

      return false;
    });
  });
}

function setUpUnitPrice() {
  var unit_prices = $('#unit_prices');

  if (unit_prices.length) {

    $('#unit_price_add').on('click', function() {
      
      var error = false;
      var last_el = unit_prices.find('>div').last();
      var new_el = parseInt(last_el.attr('data-position')) + 1;
      var upper_limit = last_el.find('input[name=prices\\[' + (new_el - 1) + '\\]\\[upper_limit\\]]');
      var unit_price = last_el.find('input[name=prices\\[' + (new_el - 1) + '\\]\\[unit_price\\]]');

      if (!upper_limit.val()) {
        upper_limit.closest('.input-group').addClass('has-danger');
        error = true;
      }
      if (!unit_price.val()) {
        unit_price.closest('.input-group').addClass('has-danger');
        error = true;
      }

      if (error)
        return;

      upper_limit.closest('.input-group').removeClass('has-danger');
      unit_price.closest('.input-group').removeClass('has-danger');
      
      var template = $('#template_unit_price > div').clone().hide();

      template.attr('data-position', new_el)
      template.find('input[name=unit_price]').attr('name', 'prices[' + new_el + '][unit_price]');
      template.find('input[name=under_limit]').attr('name', 'prices[' + new_el + '][under_limit]').val(upper_limit.val());
      template.find('input[name=upper_limit]').attr('name', 'prices[' + new_el + '][upper_limit]');
      template.find('.step').text(new_el + 1);

      template.find('.btn-danger').on('click', function() {
        removeUnitPrice($(this));
      });

      last_el.find('.btn-danger').prop('disabled', true);
      last_el.find('input').prop('readonly', true);
      template.appendTo(unit_prices).show('fast');
    });

    unit_prices.find('.form-group .btn-danger').on('click', function() {
      removeUnitPrice($(this));
    });

    function removeUnitPrice(el) {
      var group = el.closest('.form-group');
      group.prev().find('.btn-danger').prop('disabled', false);
      group.prev().find('input').prop('readonly', false);
      group.hide('fast', function() {
        group.remove();
      });
    }
  }
}
