/**
 * Simple simulation new [simple_simulations/new]
 */
if ($('.iframe-simulation-form').length) {
  /*
   * ANONYMOUS FUNCTIONS START
   */
  
  // API Get cities list
  var getCities = function (prefecture_code) {
    var city_code_select = $('select[name=city_code]');

    if (!prefecture_code) {
      $('select[name=city_code]').prop('disabled', true);
      city_code_select.empty();
      city_code_select.append($('<option>').html("選択してください").val(''));

      return;
    }

    $.ajax({
      url: '/front/api/v1/simulation/cities',
      type: 'GET',
      data: {
        // csrf_token_key: "<?= \Security::fetch_token();?>",
        prefecture_code: prefecture_code
      },
      success: function (data) {
        if (data.errors) {
          console.log(data.errors);
          alert('Error');
        }
        else if (data.result) {
          city_code_select.empty();
          city_code_select.append($('<option>').html("選択してください").val(''));
          
          $.each(data.result.cities, function(k, v) {
            city_code_select.append($('<option>').html(v).val(k));
          });

          $('select[name=city_code]').prop('disabled', false);
        }
      },
      error: function() {
        alert('An error has occurred!');
      }
    });
  }

  var isNumberValid = function (name) {
      var numInput = $('input[name=' + name + ']');
      var num = numInput.val();
      var pattern = /^(\d{1,10})$/;

      if (num) {
        num = convertNumber(num);
        numInput.val(num);
      }

      if (num && num.match(pattern)) {
        return true;
      }

      return false;
    }

  var convertNumber = function (str) {
    return str.replace(/ー|－|−|-/g, '').replace(/[０-９]/g,function(s){return String.fromCharCode(s.charCodeAt(0)-0xFEE0);});
  }

  /*
   * ANONYMOUS FUNCTIONS END
   */

  var sending_form = false;
  
  /**
   * If prefecture code alredy setted up when page loaded
   */
  if ($('select[name=prefecture_code]').val()) {
    getCities($('select[name=prefecture_code]').val());
  }

  /*
   * Check Fields on click
   */
  $('#iframe_simulation_btn').on('click', function() {
    var error = false;
    var error_msg = [];

    var prefecture_code = $('select[name=prefecture_code]').val();
    var city_code = $('select[name=city_code]').val();
    var household = $('select[name=household]').val();
    var month = $('select[name=month]').val();
    var bill = $('input[name=bill]').val();

    if (!prefecture_code) {
      error = true;
      error_msg.push('※都道府県を選択してください');
    }

    if (!city_code) {
      error = true;
      error_msg.push('※市区町村を選択してください');
    }

    if (bill && !isNumberValid('bill')) {
      error = true;
      error_msg.push('※ガス代を正しく入力してください');
    }

    if (error === false) {
      // SEND FORM
      if (sending_form === true) {
        return;
      }

      sending_form = true;

      $('#iframe_simulation_btn p').text('送信中...');
      ga('send', 'event', 'simulation-iframe', 'btn-click', '', 0);
      cacv('シミュレーション「外部」', {ch:'63912289'});

      $.ajax({
        url: '/front/api/v1/simulation',
        type: 'GET',
        data: {
          // csrf_token_key: "<?= \Security::fetch_token();?>",
          prefecture_code: prefecture_code,
          city_code: city_code,
          household: household,
          month: month,
          bill: bill
        },
        success: function (data) {
          var result = JSON.parse(data)

          if (result.status == 'success') {
            $('.start-page').addClass('page-hidden');
            $('.result-page').removeClass('page-hidden');

            sending_form = false;
            $('#iframe_simulation_btn p').text('さっそく【無料】診断する!');
          }
          else {
            sending_form = false;
            $('#iframe_simulation_btn p').text('さっそく【無料】診断する!');
            console.error(result.errors);
            alert('An error has occurred!');
          }
        },
        error: function() {
          alert('An error has occurred!');
        }
      });
    } else {
      alert(error_msg[0]);
      return false;
    }
  });

  $('select[name=prefecture_code]').change(function() {
    var prefecture_code = $(this).val();

    getCities(prefecture_code);
  });
}
