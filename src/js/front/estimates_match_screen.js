if ($('.estimates-match-form').length) {
  var sending_form = false;
  var table = $('.match-table-sp');

  var form = $('.estimates-match-form form');
  var submut_btn = form.find('.match-submit-btn');

  table.find('.table-tabs > div').on('click', function() {
    if ($(this).hasClass('active'))
      return;

    var slide_num = parseInt($(this).attr('data-slide'));
    var slide = '.slide-wrap-' + slide_num;
    var tab = '.tab-' + slide_num;

    if (slide_num == 3) {
      table.find('.slide-th-1-2').hide();
      table.find('.slide-th-3').show();
    } else {
      table.find('.slide-th-1-2').show();
      table.find('.slide-th-3').hide();
    }

    table.find('.table-tabs > div').removeClass('active');
    table.find('.slide-wrap-1,.slide-wrap-2,.slide-wrap-3').removeClass('active');

    table.find(slide).addClass('active');
    table.find(tab).addClass('active');
  });

  submut_btn.on('click', function() {
    if (sending_form === true) {
      return;
    }

    sending_form = true;

    $(this).html('<span class="block">送信中...</span>');
    form.submit();
  });
}
