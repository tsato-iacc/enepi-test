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
    
    $('select[name=city_code]').prop('disabled', true);

    if (!prefecture_code) {
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
      caevent('シミュレーション「外部」', {ch:'63912289'});

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
          var result = JSON.parse(data);

          var counterOptions = {
            useEasing : true,
            useGrouping : true,
            separator : ',',
            decimal : '.',
          };

          if (result.status == 'success') {
            $('.start-page').addClass('page-hidden');
            $('.result-page').removeClass('page-hidden');

            // Set prefecture name
            $('#prefecture_name').text(result.prefecture_name);

            // Set 推定使用量
            var household_average_rate = $('#household_average_rate');
            household_average_rate.attr('data-start', household_average_rate.attr('data-end'));
            household_average_rate.attr('data-end', result.household_average_rate);

            // Set 地域平均 基本料金
            var city_average_basic_rate = $('#city_average_basic_rate');
            city_average_basic_rate.attr('data-start', city_average_basic_rate.attr('data-end'));
            city_average_basic_rate.attr('data-end', result.basic_rate);
            
            // Set 地域平均 従量単価
            var city_average_commodity_charge = $('#city_average_commodity_charge');
            city_average_commodity_charge.attr('data-start', city_average_commodity_charge.attr('data-end'));
            city_average_commodity_charge.attr('data-end', result.city_average_commodity_charge);
            
            var basic_rate = $('#basic_rate');
            var commodity_charge = $('#commodity_charge');

            if (result.bill != '') {
              // Set 現在の料金 基本料金
              basic_rate.attr('data-start', basic_rate.attr('data-end'));
              basic_rate.attr('data-end', result.basic_rate);
              basic_rate.attr('data-skip', 'false');
              
              // Set 現在の料金 従量単価
              commodity_charge.attr('data-start', commodity_charge.attr('data-end'));
              commodity_charge.attr('data-end', result.commodity_charge);
              commodity_charge.attr('data-skip', 'false');
            } else {              
              // Set 現在の料金 基本料金 to [-]
              basic_rate.attr('data-start', 0);
              basic_rate.attr('data-end', 0);
              basic_rate.attr('data-skip', 'true');
              basic_rate.find('span').text('-');
              
              // Set 現在の料金 従量単価 to [-]
              commodity_charge.attr('data-start', 0);
              commodity_charge.attr('data-end', 0);
              commodity_charge.attr('data-skip', 'true');
              commodity_charge.find('span').text('-');
            }

            // Set 年間節約
            var year_economy = $('#year_economy');
            var average_reduction_rate = parseInt(result.average_reduction_rate);
            
            if (average_reduction_rate == 0) {
              average_reduction_rate = result.nationwide_reduction;
            }

            year_economy.attr('data-start', year_economy.attr('data-end'));
            year_economy.attr('data-end', average_reduction_rate);

            var cId = 1;

            // Run counting
            $('.simulation-counter').each(function() {
              var start = $(this).attr('data-start');
              var end   = $(this).attr('data-end');
              var dec   = $(this).attr('data-dec');
              var skip  = $(this).attr('data-skip');

              $(this).find('span').attr('id', 'cId-' + cId);

              if (skip == 'false') {
                new CountUp('cId-' + cId, start, end, dec, 1, counterOptions).start();
              }

              cId++;
            });

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

  $('#iframe_resimulation_btn').on('click', function() {
    $('.result-page').addClass('page-hidden');
    $('.start-page').removeClass('page-hidden');
    caevent('reシミュレーション「外部」', {ch:'63912289'});
  });

  $('select[name=prefecture_code]').change(function() {
    var prefecture_code = $(this).val();

    getCities(prefecture_code);
  });
}
