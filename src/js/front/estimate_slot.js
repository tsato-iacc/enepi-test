if ($('.estimate-slot').length) {
  var estimate_slot = new Swiper('.slot-container', {
    direction: 'vertical',
    simulateTouch: false,
    shortSwipes: false,
    longSwipes: false,
    loop: true,
    autoplay: {
      delay: 5000,
    }
  });

  estimate_slot.on('slideChangeTransitionStart', function () {
    $('.estimate-slot').addClass('shake-constant');
  });
  estimate_slot.on('slideChangeTransitionEnd', function () {
    $('.estimate-slot').removeClass('shake-constant');
  });

  if ($('.estimate-slot').hasClass('slot-target')) {
    $('.slot-wrap').on('click', function() {
      var speed = 400;
      var target = $('#register_form');
      var position = target.offset().top - 50;

      $('body,html').animate({scrollTop:position}, speed, 'swing');
    });
  }
}

if ($('.estimate-ticker .wrap-fixed').length) {
  var ticker = $('.estimate-ticker');
  var is_visible = true;

  $(window).scroll(function() {
     if(($(window).scrollTop() + $(window).height()) > ($(document).height() - 150)) {
        if (is_visible) {
          is_visible = false;
          ticker.addClass('ticker-invisible');
        }
      } else {
        if (!is_visible) {
          is_visible = true;
          ticker.removeClass('ticker-invisible');
        }
      }
  });
}
