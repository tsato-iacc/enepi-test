/**
 * Controller_Contacts
 */
if ($('.area-contacts').length) {
  
  // See helper_functions.js
  if ($('.area-contacts').hasClass('estimate_index')) {
    cancelEstimateOrContact('estimate', 'admin');
  } else {
    cancelEstimateOrContact('contact', 'admin');
  }
  
  introduceEstimate();
  deleteContact();
  mailTemplate();
}
