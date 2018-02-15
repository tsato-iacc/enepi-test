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
}
