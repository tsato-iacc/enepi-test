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

    $('#select_all_zip').on('click', function() {
      if ($(this).find('input[name=select_all_zip]').prop('checked')) {
        console.log('aaaa');
        $(this).closest('.table').find('input[name=zip_codes\\[\\]]').attr('checked', true);
      } else {
        $(this).closest('.table').find('input[name=zip_codes\\[\\]]').attr('checked', false);
      }
    });
  }
}
