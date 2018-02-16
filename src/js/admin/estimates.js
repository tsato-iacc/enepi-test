/**
 * Controller_Callings
 */
if ($('.area-estimates').length) {
  
  // See helper_functions.js
  cancelEstimateOrContact('estimate', 'admin');
  introduceEstimate();
  presentEstimate();

  /**
   * page admin/estimates/:id
   */
  setUpUnitPrice();
}
