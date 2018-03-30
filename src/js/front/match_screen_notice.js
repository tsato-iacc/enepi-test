if ($('.match-screen-notice').length) {
  var modal = $('.match-screen-notice');
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
