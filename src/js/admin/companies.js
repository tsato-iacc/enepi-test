/**
 * Controller_Callings
 */
if ($('.area-companies').length) {

  // See helper_functions.js
  cancelEstimateOrContact('estimate');
  introduceEstimate();

  /**
   * page admin/companies/:id/offices/:id/price/create
   */
  var unit_prices = $('#unit_prices');

  if (unit_prices.length) {

    $('#unit_price_add').on('click', function() {
      
      var error = false;
      var last_el = unit_prices.find('>div').last();
      var new_el = parseInt(last_el.attr('data-position')) + 1;
      var upper_limit = last_el.find('input[name=prices\\[' + (new_el - 1) + '\\]\\[upper_limit\\]]');
      var unit_price = last_el.find('input[name=prices\\[' + (new_el - 1) + '\\]\\[unit_price\\]]');

      if (!upper_limit.val()) {
        upper_limit.closest('.input-group').addClass('has-danger');
        error = true;
      }
      if (!unit_price.val()) {
        unit_price.closest('.input-group').addClass('has-danger');
        error = true;
      }

      if (error)
        return;

      upper_limit.closest('.input-group').removeClass('has-danger');
      unit_price.closest('.input-group').removeClass('has-danger');
      
      var template = $('#template_unit_price > div').clone().hide();

      template.attr('data-position', new_el)
      template.find('input[name=unit_price]').attr('name', 'prices[' + new_el + '][unit_price]');
      template.find('input[name=under_limit]').attr('name', 'prices[' + new_el + '][under_limit]').val(upper_limit.val());
      template.find('input[name=upper_limit]').attr('name', 'prices[' + new_el + '][upper_limit]');
      template.find('.step').text(new_el + 1);

      template.find('.btn-danger').on('click', function() {
        removeUnitPrice($(this));
      });

      last_el.find('.btn-danger').prop('disabled', true);
      last_el.find('input').prop('readonly', true);
      template.appendTo(unit_prices).show('fast');
    });

    unit_prices.find('.form-group .btn-danger').on('click', function() {
      removeUnitPrice($(this));
    });

    function removeUnitPrice(el) {
      var group = el.closest('.form-group');
      group.prev().find('.btn-danger').prop('disabled', false);
      group.prev().find('input').prop('readonly', false);
      group.hide('fast', function() {
        group.remove();
      });
    }
  }
}
