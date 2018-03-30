if ($('#simulation_register_form').length) { 
  /*
   * ANONYMOUS FUNCTIONS START
   */
  
  // SEND FORM
  var sendForm = function (el) {
    var form = el.closest('form');
    var estimateKind = $('input[name=lpgas_contact\\[estimate_kind\\]]:checked').val();

    var zip = $('input[name=zip]').val();
    var pref = $('input[name=pref]').val();
    var addr = $('input[name=addr]').val();

    if (estimateKind == 'new_contract') {
      var zipNewHidden = form.find('input[name=lpgas_contact\\[new_zip_code\\]]');
      var prefNewHidden = form.find('input[name=lpgas_contact\\[new_prefecture_code\\]]');
      var addrNewHidden = form.find('input[name=lpgas_contact\\[new_address\\]]');

      zipNewHidden.val(zip);
      prefNewHidden.val(pref);
      addrNewHidden.val(addr);
    } else {
      var zipHidden = form.find('input[name=lpgas_contact\\[zip_code\\]]');
      var prefHidden = form.find('input[name=lpgas_contact\\[prefecture_code\\]]');
      var addrHidden = form.find('input[name=lpgas_contact\\[address\\]]');

      zipHidden.val(zip);
      prefHidden.val(pref);
      addrHidden.val(addr);
    }

    $('#contact_btn p').text('送信中...');
    if (sending_form !== true) {
      sending_form = true;
      ga('send', 'event', 'simulation-cv', 'btn-click', '', 0);
      form.submit();
    }
  }

  // Show/Hide error on top of the form
  var isError = function (is, el, msg) {
    if (is) {
      el.closest('form').find('.step-error').text(msg).addClass('show-error');
    } else {
      el.closest('form').find('.step-error').removeClass('show-error');
    }
  }

  var isInputValid = function (name) {
    var input = $('input[name=' + name + ']').val();

    if (input) {
      inputHideError(name);
    } else {
      inputShowError(name);
      return false;
    }

    return true;
  }

  var isSelectValid = function (name) {
    var select = $('#' + name).val();

    if (select) {
      $('#' + name).closest('.error-wrap').removeClass('input-error');
    } else {
      $('#' + name).closest('.error-wrap').addClass('input-error');
      return false;
    }

    return true;
  }

  var isTelValid = function (name) {
    var telInput = $('input[name=' + name + ']');
    var tel = telInput.val();
    var pattern = /^(\d{10,11})$/;

    if (tel) {
      tel = convertNumber(tel);
      telInput.val(tel);
    }

    if (tel && tel.match(pattern)) {
      inputHideError(name);
      return true;
    }
    else {
      inputShowError(name);
      return false;
    }
  }

  var isEmailValid = function (name) {
    var mail = $('input[name=' + name + ']').val();
    var pattern = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+(?:[A-Z]{2}|com|org|net|gov|biz|info|jp)\b/;

    if (mail && mail.match(pattern)) {
      inputHideError(name);
      return true;
    }
    else {
      inputShowError(name);
      return false;
    }
  }

  var inputShowError = function (name) {
    $('input[name=' + name + ']').closest('.error-wrap').addClass('input-error');
  }

  var inputHideError = function (name) {
    $('input[name=' + name + ']').closest('.error-wrap').removeClass('input-error');
  }

  var convertNumber = function (str) {
    return str.replace(/ー|－|−|-/g, '').replace(/[０-９]/g,function(s){return String.fromCharCode(s.charCodeAt(0)-0xFEE0);});
  }

  var scrollTo = function (target, offset) {
    var speed = 400;
    var tg = target;
    var position = tg.offset().top - offset;

    $('body,html').animate({scrollTop:　position}, speed, 'swing');
  }

  /*
   * ANONYMOUS FUNCTIONS END
   */

  var sending_form = false;
  var form_hidden = true;

  /*
   * Check Contact
   */
  $('#contact_btn').on('click', function() {

    if (form_hidden)
      return false;

    var error = false;
    var error_msg = [];

    var estimateKind = $('input[name=lpgas_contact\\[estimate_kind\\]]:checked').val();
    var name = isInputValid('lpgas_contact\\[name\\]');
    var tel = isTelValid('lpgas_contact\\[tel\\]');
    var mail = isEmailValid('lpgas_contact\\[email\\]');

    if (!estimateKind) {
      error = true;
      error_msg.push('※どちらかを選択してください');
    }

    if (estimateKind && estimateKind == 'change_contract') {
      var gasCompany = isInputValid('lpgas_contact\\[gas_contracted_shop_name\\]');

      if (!gasCompany) {
        error = true;
        error_msg.push('※ガス会社名を入力してください');
      }
    }

    if (!name) {
      error = true;
      error_msg.push('※お名前を入力してください');
    }

    if (!tel) {
      error = true;
      error_msg.push('※電話番号を入力してください');
    }

    if (!mail) {
      error = true;
      error_msg.push('※メールアドレスを入力してください');
    }

    if (error === false) {
      isError(false, $(this));
      // POST FORM
      sendForm($(this));
    } else {
      isError(true, $(this), error_msg[0]);
    }
  });

  /**
   * Remove errors on click
   */
  $('.remove-error label').on('click', function() {
    $(this).closest('form').find('.step-error').removeClass('show-error');
  });
  $('input[type=text], input[type=tel]').on('click', function() {
    $(this).closest('.error-wrap').removeClass('input-error');
    isError(false, $(this));
  });
  $('select').on('click', function() {
    $(this).closest('.error-wrap').removeClass('input-error');
    isError(false, $(this));
  });

  /**
   * Show or hide optional label
   */
  $('.can-hide').hide();

  $('input[name=lpgas_contact\\[estimate_kind\\]]').on('click', function() {
    if (form_hidden) {
      $('.hidden-field').removeClass('hidden-field');
      $('.simulation-page-button').removeClass('color-gray');
      $('.simulation-page-button p').text('WEBで料金プランを見る');
      $('.simulation-page-button .free-img').removeClass('img-hide');
      form_hidden = false;
    }

    var estimate = $(this).val();
    if ($(this).val() == 'new_contract') {
      $('.can-hide').show();
      inputHideError('lpgas_contact\\[gas_contracted_shop_name\\]');
      ga('send', 'event', 'simulation-new-contract', 'btn-click', '', 0);
    } else {
      $('.can-hide').hide();
      ga('send', 'event', 'simulation-change-contract', 'btn-click', '', 0);
    }
  });

  /**
   * Scroll to...
   */
  $('h3 .scroll').on('click', function() {
    scrollTo($('.scroll-info'), 0);
  });

  $('.simulation-page-button').on('click', function() {
    scrollTo($('.simulation-register-form'), 20);
  });

  /**
   * Convert kanji to furigana
   */
  $.fn.autoKana('input[name=lpgas_contact\\[name\\]]', 'input[name=lpgas_contact\\[furigana\\]]');
}