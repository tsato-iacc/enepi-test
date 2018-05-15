/**
 * Controller_Callings
 */
if ($('.area-companies').length) {

  // See helper_functions.js
  cancelEstimateOrContact('estimate', 'admin');
  introduceEstimate();

  /**
   * page admin/companies/:id/offices/:id/price/create
   */
  setUpUnitPrice();

  if ($('.area-companies').hasClass('area_index')) {
    $('select[name=prefecture_code]').change(function() {
      var prefecture_code = $(this).val();

      getCitiesByPrefectureCode(prefecture_code);
    });

    $('select[name=city_code]').change(function() {
      var prefecture_code = $('select[name=prefecture_code]').val();
      var city_name = $(this).val();

      getCityZipCodes(prefecture_code, city_name);
    });

    // Delete selected items
    $('#select_all_zip').on('click', function() {
      if ($(this).find('input[name=select_all_zip]').prop('checked')) {
        $(this).closest('.table').find('input[name=zip_codes\\[\\]]').attr('checked', true);
      } else {
        $(this).closest('.table').find('input[name=zip_codes\\[\\]]').attr('checked', false);
      }
    });

    // Get area of prefecture and show modal
    $('.area-modal-btn').on('click', function() {
      var l = Ladda.create(this);
      var prefecture_code = $(this).attr('data-code');
      var prefecture_name = $(this).text();

      l.start();
      $.ajax({
        url: '/admin/api/cities_by_prefecture_code',
        type: 'GET',
        data: {
          // csrf_token_key: "<?= \Security::fetch_token();?>",
          prefecture_code: prefecture_code
        },
        success: function (data) {
          if (data.errors) {
            console.log(data.errors);
          }
          else if (data.result) {
            var area = $('#area');
            var area_row = area.find('#area_row');
            $('#all_area_select').removeClass('selected').removeClass('btn-primary').addClass('btn-secondary');
            area.find('.progress .progress-bar').width(0);
            
            area.find('#areaModalLabel').text(prefecture_name + 'の市区町村');
            area.attr('data-prefecture-code', prefecture_code);
            area_row.empty();

            $.each(data.result.cities, function(k, v) {
              var button = $('<button type="button" class="btn city_btn btn-sm btn-secondary w-100 mb-2" data-city-name="' + v.city_name + '">' + v.city_name + '</button>');

              button.on('click', function() {
                if ($(this).hasClass('selected')) {
                  $(this).removeClass('selected');
                  $(this).removeClass('btn-primary');
                  $(this).addClass('btn-secondary');
                } else {
                  $(this).addClass('selected');
                  $(this).removeClass('btn-secondary');
                  $(this).addClass('btn-primary');
                }
              });

              var area_col = $('<div class="col-3"></div>').append(button);
              area_row.append(area_col);
            });

            area.modal('show');
          }

          l.stop();
        },
        error: function() {
          alert('An error has occurred!');
          l.stop();
        }
      });
    });

    $('#all_area_select').on('click', function() {
      if ($(this).hasClass('selected')) {
        $(this).removeClass('selected');
        $(this).removeClass('btn-primary');
        $(this).addClass('btn-secondary');
        $('.city_btn').removeClass('btn-primary');
        $('.city_btn').addClass('btn-secondary');
        $('.city_btn').removeClass('selected');
      } else {
        $(this).removeClass('btn-secondary');
        $(this).addClass('btn-primary');
        $(this).addClass('selected');
        $('.city_btn').removeClass('btn-secondary');
        $('.city_btn').addClass('btn-primary');
        $('.city_btn').addClass('selected');
      }
    });

    $('#area_save_btn').on('click', function() {
      var selected_area = $('button.city_btn.selected');
      var area_modal = $('#area');
      var prefecture_code = area_modal.attr('data-prefecture-code');
      var office_id = area_modal.attr('data-office-id');

      if (selected_area.length && prefecture_code) {
        area_modal.find('button[data-dismiss="modal"]').prop('disabled', true);
        area_modal.find('#all_area_select').prop('disabled', true);
        area_modal.find('.city_btn').prop('disabled', true);
        
        var ajaxes = [];
        var ajax_error = false;
        
        var l = Ladda.create(this);
        var progress = 0;
        var delta = 1 / selected_area.length;
        var saved_count = 0;

        selected_area.each(function() {
          var city_name = $(this).attr('data-city-name');

          if (!city_name) {
            alert('City name is not present in checked button!');
            return false;
          }
          
          var request = $.ajax({
            url: '/admin/api/city_zip_codes',
            type: 'POST',
            data: {
              // csrf_token_key: "<?= \Security::fetch_token();?>",
              office_id: office_id,
              prefecture_code: prefecture_code,
              city_name: city_name
            },
            success: function (data) {
              if (data.errors) {
                console.log(data.errors);
              }
              else if (data.result) {
                var count = parseInt(data.result.count);
                saved_count += count;
                progress = progress + delta;
                area_modal.find('button[data-city-name=' + data.result.city_name + ']').removeClass('btn-primary').addClass('btn-success');
                area_modal.find('.progress .progress-bar').width((progress * 100) + '%');
                l.setProgress(progress);
              }
            },
            error: function() {
              ajax_error = true;
            }
          });
          ajaxes.push(request);
        });

        l.start();
        l.setProgress(progress);

        $.when.apply(null, ajaxes).done(function(){
          area_modal.find('button[data-dismiss="modal"]').prop('disabled', false);
          area_modal.find('#all_area_select').prop('disabled', false);
          l.stop();
          area_modal.modal('hide');

          if (ajax_error) {
            alert('An error has occurred!');
          } else {
            var alert = $('<div class="alert alert-success alert-dismissible fade show" role="alert">' + 
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                  '<span aria-hidden="true">×</span>' +
                '</button>' + saved_count + '件を保存しました</div>');
            $('.main-wrap .alert').remove();
            $('.main-wrap').prepend(alert);
          }
        });
      }
    });
  }
}
