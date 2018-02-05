/**
 * Controller_Callings
 */
if ($('.area-estimates').length) {
  
  // See helper_functions.js
  cancelEstimateOrContact('estimate');
  introduceEstimate();
  presentEstimate();

  /**
   * page admin/estimates/:id
   */
  setUpUnitPrice();
}
