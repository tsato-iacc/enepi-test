if ($('.contact-done').length) {
  var sending_form = false;

  var form = $('.done-form');
  var submut_btn = form.find('.done-submit-btn');

  submut_btn.on('click', function() {
    var q_1 = form.find('select[name=q_1]').val();
    var q_2 = form.find('select[name=q_2]').val();
    var q_3 = form.find('select[name=q_3]').val();

    
    var conversion_id = form.find('input[name=conversion_id]').val();
    // var fuel_csrf_token = form.find('input[name=fuel_csrf_token]').val();
    
    submut_btn.find('span').text('送信中...');

    $.ajax({
      url: '/front/api/v1/contact/done_form',
      type: 'POST',
      data: {
        // fuel_csrf_token: fuel_csrf_token,
        conversion_id: conversion_id,
        q_1: q_1,
        q_2: q_2,
        q_3: q_3
      },
      success: function (data) {
        if (data.result == 'success') {
          alert('ご対応ありがとうございました。');
        }
        else if (data.errors) {
          alert("エラーが発生しました。\nもう一度試してみてください");
          console.log(data.errors);
        }
        submut_btn.find('span').text('上記内容で送信する');
      },
      error: function() {
        alert('An error has occurred!');
        submut_btn.find('span').text('上記内容で送信する');
      }
    });
  });
}
