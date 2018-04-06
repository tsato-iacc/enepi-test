if ($('.match-screen-notice-pc').length) {
  var modal = $('.match-screen-notice-pc');
  var c = Cookies.get('notice_state');

  if (typeof c === 'undefined')
    modal.addClass('match-screen-notice-show');

  modal.find('.modal-close-btn').on('click', function() {
    modal.removeClass('match-screen-notice-show');

    var exp = new Date();
    exp.setDate(exp.getDate() + 1);
    Cookies.set('notice_state', 'dismiss', {expires: exp});
  });

  modal.find('.modal-open-header').on('click', function() {
    modal.addClass('match-screen-notice-show');

    Cookies.remove('notice_state');
  });
}

if ($('.match-screen-notice-sp').length) { 
  var notice = $('.match-screen-notice-sp');
  var is_visible = true;

  var shake = function() {
    $('.match-screen-notice-sp .shake-rotate').addClass('shake-constant');
    
    setTimeout(function(){
      $('.match-screen-notice-sp .shake-rotate').removeClass('shake-constant');
    }, 300);
  }

  setTimeout(function(){
    notice.removeClass('notice-invisible');
  }, 3000);

  setInterval(shake, 5000);

  // Hide when achieve bottom
  $(window).scroll(function() {
     if(($(window).scrollTop() + $(window).height()) > ($(document).height() - 150)) {
        if (is_visible) {
          is_visible = false;
          notice.addClass('notice-invisible');
        }
      } else {
        if (!is_visible) {
          is_visible = true;
          notice.removeClass('notice-invisible');
        }
      }
  });
}
