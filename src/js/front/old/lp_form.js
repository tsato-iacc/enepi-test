if ($('#top.lp-form').length) {
  var INPUT_WRAP_CLASS = ".js-input_block";
  var INPUT_TAGS = "input, select";
  var SELECTING_CLASS = "flashing";

  $(INPUT_TAGS).on('blur, change', function(e) {
    var $target = $(e.target).closest(INPUT_WRAP_CLASS);
    var $form = $target.closest("form");
    var $inputs = $(INPUT_WRAP_CLASS, $form);
    var currentIndex = $inputs.index($target);
    if ($target.find(INPUT_TAGS).hasClass(SELECTING_CLASS)) {
      $target.find(INPUT_TAGS).removeClass(SELECTING_CLASS);
      if ($inputs.eq(currentIndex+1)) {
        $inputs.eq(currentIndex+1).find(INPUT_TAGS).addClass(SELECTING_CLASS);
      }
    }
  });
}
