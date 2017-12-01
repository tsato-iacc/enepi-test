if ($('#register_form').length) {
  var swiper = new Swiper('.steps-container', {
      simulateTouch: false,
      shortSwipes: false,
      longSwipes: false,
      autoHeight: true,
      effect: 'fade'
  });

  swiper.lockSwipes = function() {
    swiper.allowSlidePrev = false;
    swiper.allowSlideNext = false;
  };

  swiper.unlockSwipes = function() {
    swiper.allowSlidePrev = true;
    swiper.allowSlideNext = true;
  };

  swiper.lockSwipes();

  var route2 = false;
  var fadeSpeed = 0;
  var sending_form = false;

  var error_messages = {
    slide_1: {
      choice: '※いずれかを選択してください'
    },
    slide_2_1: {
      choice: '※どちらかを選択してください'
    },
    slide_2_2: {
      choice: '※物件の状況を入力してください'
    },
    slide_3: {
      input: '※ガスの利用先住所を入力してください'
    },
    slide_4: {
      input: '※ガスの使用状況を入力してください'
    },
    slide_5: {
      input: '※ご連絡先を入力してください'
    }
  };

  /*
   * STEP 1
   */
  $('#house_kind_btn').on('click', function() {
    var houseKind = $('input[name=lpgas_contact\\[house_kind\\]]:checked').val();
    if (houseKind) {
      isError(false, $(this));
      goToNextStep(2);

      if (houseKind == 'detached' || houseKind == 'store_ex') {
        route2 = false;
        $('.step2-2').addClass('invisible-slide');
        $('.step2-1').removeClass('invisible-slide');
        $('.slide-content-4 .can-hide').hide();
        $('.contact-type').hide();
        swiper.unlockSwipes();
        swiper.slideTo(1, fadeSpeed, true);
        swiper.lockSwipes();
        ga('send', 'event', 'goToStep2-1', 'btn-click', '', 0);
      } else if (houseKind == 'apartment') {
        route2 = true;
        $('.step2-1').addClass('invisible-slide');
        $('.step2-2').removeClass('invisible-slide');
        $('.slide-content-4 .can-hide').show();
        $('.contact-type').show();
        swiper.unlockSwipes();
        swiper.slideTo(2, fadeSpeed, true);
        swiper.lockSwipes();
        ga('send', 'event', 'goToStep2-2', 'btn-click', '', 0);
      }
    } else {
      isError(true, $(this), error_messages.slide_1.choice);
    }
  });

  /*
   * STEP 2-1
   */
  $('#estimate_kind_btn').on('click', function() {
    var estimateKind = $('input[name=lpgas_contact\\[estimate_kind\\]]:checked').val();

    if (estimateKind) {
      if (estimateKind == 'change_contract') {
        $('.slide-content-4 .can-hide').hide();
      } else if (estimateKind == 'new_contract') {
        $('.slide-content-4 .can-hide').show();
      }
      nextSlide($(this));
    } else {
      isError(true, $(this), error_messages.slide_2_1.choice);
    }
  });

  /*
   * STEP 2-2
   */
  $('#apartment_btn').on('click', function() {
    var roomsCount = isNumberValid('lpgas_contact\\[number_of_rooms\\]');
    var activeRooms = true;
    var activeRoomsPresent = $('input[name=lpgas_contact\\[number_of_active_rooms\\]]').val();

    if (activeRoomsPresent) {
      activeRooms = isNumberValid('lpgas_contact\\[number_of_active_rooms\\]');
    }

    if (roomsCount && activeRooms) {
      isError(false, $(this));
      nextSlide($(this));
      alignFormToTop();
    } else {
      isError(true, $(this), error_messages.slide_2_2.choice);
    }
  });

  /*
   * STEP 3
   */
  $('#address_btn').on('click', function() {
    // Check Address
    var error = false;

    var zip = isZipValid('zip');
    var pref = isSelectValid('pref');
    var addr = isInputValid('addr');

    error = !(zip && pref && addr);

    var zipA = $('input[name=zip]');
    zipA.val(convertNumber(zipA.val()));

    if (error === false) {
      isError(false, $(this));
      nextSlide($(this));
      alignFormToTop();
    } else {
      isError(true, $(this), error_messages.slide_3.input);
    }
  });

  /*
   * STEP 4
   */
  $('#gas_usage_btn').on('click', function() {
    var error = false;
    var estimateKind = $('input[name=lpgas_contact\\[estimate_kind\\]]:checked').val();

    if (route2) {
      estimateKind = '';
    }

    if (estimateKind == 'change_contract') {
      var gasMonth = isNumberValid('lpgas_contact\\[gas_meter_checked_month\\]');
      var gasUsedAmount = isFloatValid('lpgas_contact\\[gas_used_amount\\]');
      var gasBillingAmount = isNumberValid('lpgas_contact\\[gas_latest_billing_amount\\]');
      var gasCompany = isInputValid('lpgas_contact\\[gas_contracted_shop_name\\]');

      if (!gasMonth || !gasUsedAmount || !gasBillingAmount || !gasCompany) {
        error = true;
      }
    } else {
      var gasMonthPresent = $('input[name=lpgas_contact\\[gas_meter_checked_month\\]]').val();
      var gasUsedAmountPresent = $('input[name=lpgas_contact\\[gas_used_amount\\]]').val();
      var gasBillingAmountPresent = $('input[name=lpgas_contact\\[gas_latest_billing_amount\\]]').val();

      if (gasMonthPresent && !isNumberValid('lpgas_contact\\[gas_meter_checked_month\\]')) {
        error = true;
      }

      if (gasUsedAmountPresent && !isFloatValid('lpgas_contact\\[gas_used_amount\\]')) {
        error = true;
      }

      if (gasBillingAmountPresent && !isNumberValid('lpgas_contact\\[gas_latest_billing_amount\\]')) {
        error = true;
      }
    }

    if (error) {
      isError(true, $(this), error_messages.slide_4.input);
    } else {
      isError(false, $(this));
      nextSlide($(this));
      alignFormToTop();
    }
  });

  /*
   * STEP 5
   */
  $('#contact_btn').on('click', function() {
    // Check Contact
    var error = false;

    var name = isInputValid('lpgas_contact\\[name\\]');
    var tel = isTelValid('lpgas_contact\\[tel\\]');
    var mail = isEmailValid('lpgas_contact\\[email\\]');
    
    error = !(name && tel && mail);

    if (error === false) {
      isError(false, $(this));
      // POST FORM
      sendForm($(this));
    } else {
      isError(true, $(this), error_messages.slide_5.input);
    }
  });

  /*
   * TOGGLE ADDRESS 2
   */
  $('#establish_flg').on('click', function() {
    var slideContent = $(this).closest('.slide-content');
    if (slideContent.hasClass('height-up')) {
      slideContent.removeClass('height-up');
    } else {
      slideContent.addClass('height-up');
    }
    $(".address-diff").toggle();
    swiper.update(true);
  });

  /**
   * Remove errors on click
   */
  $('.remove-error label').on('click', function() {
    $(this).closest('.swiper-slide').find('.step-error').removeClass('show-error');
  });
  $('input[name=drawing_flg] + label').on('click', function() {
    $(this).closest('.house-plan').removeClass('input-error');
  });
  $('input[name=contact_type] + label').on('click', function() {
    $(this).closest('.contact-type').removeClass('input-error');
    isError(false, $(this));
  });
  $('input[type=text], input[type=tel]').on('click', function() {
    $(this).closest('.error-wrap').removeClass('input-error');
    isError(false, $(this));
  });
  $('select').on('click', function() {
    $(this).closest('.error-wrap').removeClass('input-error');
    isError(false, $(this));
  });

  // Go to previous slide
  $('.step-prev-btn').on('click', function() {
    var slide = route2 ? parseInt($(this).attr('data-go-to-slide-2')) : parseInt($(this).attr('data-go-to-slide'));
    var step = parseInt($(this).attr('data-cur-step'));
    goToPrevStep(step);
    swiper.unlockSwipes();
    swiper.slideTo(slide, fadeSpeed, true);
    swiper.lockSwipes();
  });

  /**
   * Hand navigation
   */
  $('.hand-navi-label').on('click', function() {
    $(this).closest('.step-hand-navi').find('.hand-navi-wrap').addClass('opacity-0');
    $(this).closest('.swiper-slide').find('.next-btn-hand-navi').removeClass('opacity-0');

  });

  /**
   * Convert kanji to furigana
   */
  $.fn.autoKana('input[name=lpgas_contact\\[name\\]]', 'input[name=lpgas_contact\\[furigana\\]]');

  /*
   * SEND FORM
   */
  function sendForm(el) {
    var form = el.closest('form');
    var estimateKind = $('input[name=lpgas_contact\\[estimate_kind\\]]:checked').val();

    var zip = $('input[name=zip]').val();
    var pref = $('select[name=pref]').val();
    var addr = $('input[name=addr]').val();

    if (route2) {
      var apartment = $('<input type="hidden" name="apartment_form" value="1">');
      form.append(apartment);
    }

    if (route2 || estimateKind == 'new_contract') {
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

    $('#contact_btn .btn-text').text('送信中...');
    if (sending_form !== true) {
      sending_form = true;
      ga('send', 'event', 'cv', 'btn-click', '', 0);
      form.submit();
    }
  }

  // Show/Hide error on top of the form
  function isError(is, el, msg) {
    if (is) {
      el.closest('.swiper-slide').find('.step-error').text(msg).addClass('show-error');
    } else {
      el.closest('.swiper-slide').find('.step-error').removeClass('show-error');
    }
  }

  function nextSlide(el) {
    var nextStep = parseInt(el.attr('data-next-step'));
    
    goToNextStep(nextStep);
    swiper.unlockSwipes();
    swiper.slideTo(nextStep, fadeSpeed, true);
    swiper.lockSwipes();

    ga('send', 'event', 'goToStep' + nextStep, 'btn-click', '', 0);
  }

  function goToNextStep(step) {
    $('#form_title_step_' + step).addClass('step-selected');

    if (step == '5') {
      $('.form-agreement').removeClass('invisible-slide');
    }
  }

  function goToPrevStep(step) {
    $('#form_title_step_' + step).removeClass('step-selected');

    if (step == '5') {
      $('.form-agreement').addClass('invisible-slide');
    }
  }

  function isInputValid(name) {
    var input = $('input[name=' + name + ']').val();

    if (input) {
      inputHideError(name);
    } else {
      inputShowError(name);
      return false;
    }

    return true;
  }

  function isNumberValid(name) {
    var numInput = $('input[name=' + name + ']');
    var num = numInput.val();
    var pattern = /^(\d{1,10})$/;

    if (num) {
      num = convertNumber(num);
      numInput.val(num);
    }

    if (num && num.match(pattern)) {
      inputHideError(name);

      return true;
    }
    else {
      inputShowError(name);

      return false;
    }
  }

  function isFloatValid(name) {
    var numInput = $('input[name=' + name + ']');
    var num = numInput.val();
    var pattern = /^[0-9]*[.]?[0-9]+$/;

    if (num) {
      num = convertNumber(num);
      numInput.val(num);
    }

    if (num && num.match(pattern)) {
      inputHideError(name);

      return true;
    }
    else {
      inputShowError(name);

      return false;
    }
  }

  function isSelectValid(name) {
    var select = $('#' + name).val();

    if (select) {
      $('#' + name).closest('.input-wrap').removeClass('input-error');
    } else {
      $('#' + name).closest('.input-wrap').addClass('input-error');
      return false;
    }

    return true;
  }

  function isTelValid(name) {
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

  function isEmailValid(name) {
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

  function isZipValid(name) {
    var zipInput = $('input[name=' + name + ']');
    var zip = zipInput.val();
    var pattern = /^(\d{7})$/;

    if (zip) {
      zip = convertNumber(zip);
      zipInput.val(zip);
    }

    if (zip && zip.match(pattern)) {
      inputHideError(name);
      return true;
    }
    else {
      inputShowError(name);
      return false;
    }
  }

  function inputShowError(name) {
    $('input[name=' + name + ']').closest('.error-wrap').addClass('input-error');
  }

  function inputHideError(name) {
    $('input[name=' + name + ']').closest('.error-wrap').removeClass('input-error');
  }

  function convertNumber(str) {
    return str.replace(/ー|－|−|-/g, '').replace(/[０-９]/g,function(s){return String.fromCharCode(s.charCodeAt(0)-0xFEE0);});
  }

  function convertZip(obj, pref, addr) {
    var cObj = $.extend(true, {}, obj);

    cObj.value = convertNumber(obj.value);
    AjaxZip3.zip2addr(cObj, '', pref, addr, '', '', false);
  }

  function alignFormToTop() {
    if ($('#register_form .form-align').length) {
      var speed = 400;
      var target = $('#register_form .form-align');
      var position = target.offset().top - 20;

      $('body,html').animate({scrollTop:position}, speed, 'swing');
    }
  }
}
