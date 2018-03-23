if ($('.estimates-match-form').length) {
  var table = $('.match-table-sp');

  table.find('.table-tabs > div').on('click', function() {
    if ($(this).hasClass('active'))
      return;

    var slide = '.slide-wrap-' + $(this).attr('data-slide');
    var tab = '.tab-' + $(this).attr('data-slide');

    table.find('.table-tabs > div').removeClass('active');
    table.find('.slide-wrap-1,.slide-wrap-2,.slide-wrap-3').removeClass('active');

    table.find(slide).addClass('active');
    table.find(tab).addClass('active');
  });
}
