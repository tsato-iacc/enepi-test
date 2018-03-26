if ($('.estimates-match-form').length) {
  var table = $('.match-table-sp');

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
}
